<?php
/**
 * Add / Edit Project - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$project = null;

if ($is_edit) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    if (!$project) {
        set_flash_message('danger', 'Project not found.');
        header("Location: " . $base_url . "/admin/projects.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Project' : 'Add New Project';
$active_tab = 'projects';

$all_services = get_all_services(false);
$all_clients = get_all_clients(false);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $service_id = !empty($_POST['service_id']) ? intval($_POST['service_id']) : null;
    $client_id = !empty($_POST['client_id']) ? intval($_POST['client_id']) : null;
    $image_url = trim($_POST['image_url'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $completion_year = trim($_POST['completion_year'] ?? '');
    $status = trim($_POST['status'] ?? 'Completed');
    $summary = trim($_POST['summary'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $featured = !empty($_POST['featured']) ? 1 : 0;

    // Handle file upload if provided
    if (!empty($_FILES['image_file']['name'])) {
        $file = $_FILES['image_file'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts)) {
                $upload_dir = __DIR__ . '/../assets/images';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file['name'], PATHINFO_FILENAME)) . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    if (sanitize_uploaded_image($dest, $ext)) {
                        $image_url = $base_url . '/assets/images/' . $filename;
                    } else {
                        $errors[] = "Uploaded project image failed verification.";
                    }
                }
            } else {
                $errors[] = "Invalid image file format. Allowed: JPG, PNG, WEBP, GIF.";
            }
        }
    }

    if (empty($title)) {
        $errors[] = "Project title is required.";
    }

    // Auto-generate slug if empty
    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    }

    if (empty($image_url)) {
        $image_url = '<?php echo $base_url; ?>/assets/images/DJI_0400-scaled.jpg';
    }

    // Check slug uniqueness
    $slugCheckSql = "SELECT COUNT(*) FROM projects WHERE slug = ?" . ($is_edit ? " AND id != ?" : "");
    $slugCheckParams = $is_edit ? [$slug, $id] : [$slug];
    $slugStmt = $db->prepare($slugCheckSql);
    $slugStmt->execute($slugCheckParams);
    if ($slugStmt->fetchColumn() > 0) {
        $slug = $slug . '-' . time();
    }

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE projects SET 
                title = ?, slug = ?, client_id = ?, service_id = ?, image_url = ?,
                location = ?, completion_year = ?, status = ?, summary = ?, description = ?, featured = ?
                WHERE id = ?");
            $stmt->execute([
                $title, $slug, $client_id, $service_id, $image_url,
                $location, $completion_year, $status, $summary, $description, $featured,
                $id
            ]);
            set_flash_message('success', 'Project updated successfully.');
        } else {
            $stmt = $db->prepare("INSERT INTO projects 
                (title, slug, client_id, service_id, image_url, location, completion_year, status, summary, description, featured)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $title, $slug, $client_id, $service_id, $image_url,
                $location, $completion_year, $status, $summary, $description, $featured
            ]);
            set_flash_message('success', 'New project added successfully.');
        }
        header("Location: " . $base_url . "/admin/projects.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-card" style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Project Details' : 'Create New Engineering Project'; ?></h3>
        <a href="<?php echo $base_url; ?>/admin/projects.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <div class="admin-card-body">
        <?php if (!empty($errors)): ?>
            <div class="admin-alert danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <?php foreach ($errors as $e): ?>
                        <div><?php echo htmlspecialchars($e); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Project Title *</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="e.g. 220kV Grid Station Turnkey Augmentation" value="<?php echo htmlspecialchars($_POST['title'] ?? ($project['title'] ?? '')); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="slug">URL Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="auto-generated-from-title" value="<?php echo htmlspecialchars($_POST['slug'] ?? ($project['slug'] ?? '')); ?>">
                    <div class="form-text-help">Unique URL identifier (leave empty to generate automatically)</div>
                </div>

                <div class="form-group">
                    <label for="status">Execution Status</label>
                    <select id="status" name="status" class="form-control">
                        <?php 
                        $curStatus = $_POST['status'] ?? ($project['status'] ?? 'Completed');
                        ?>
                        <option value="Completed" <?php echo $curStatus === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="Ongoing" <?php echo $curStatus === 'Ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="Planned" <?php echo $curStatus === 'Planned' ? 'selected' : ''; ?>>Planned</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="service_id">Service Category *</label>
                    <select id="service_id" name="service_id" class="form-control" required>
                        <option value="">Select Service Discipline</option>
                        <?php 
                        $curService = $_POST['service_id'] ?? ($project['service_id'] ?? '');
                        foreach ($all_services as $s): ?>
                            <option value="<?php echo $s['id']; ?>" <?php echo $curService == $s['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text-help">Categorizes the project under the respective service page</div>
                </div>

                <div class="form-group">
                    <label for="client_id">Client / Partner Organization</label>
                    <select id="client_id" name="client_id" class="form-control">
                        <option value="">Select Partner Client (Optional)</option>
                        <?php 
                        $curClient = $_POST['client_id'] ?? ($project['client_id'] ?? '');
                        foreach ($all_clients as $c): ?>
                            <option value="<?php echo $c['id']; ?>" <?php echo $curClient == $c['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($c['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text-help">Associates project with client logo in the slider</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" class="form-control" placeholder="e.g. Rawat, Punjab" value="<?php echo htmlspecialchars($_POST['location'] ?? ($project['location'] ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label for="completion_year">Completion Year</label>
                    <input type="text" id="completion_year" name="completion_year" class="form-control" placeholder="e.g. 2024" value="<?php echo htmlspecialchars($_POST['completion_year'] ?? ($project['completion_year'] ?? '')); ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Featured Image</label>
                <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <input type="text" id="image_url" name="image_url" class="form-control" placeholder="Enter image URL or upload below" value="<?php echo htmlspecialchars($_POST['image_url'] ?? ($project['image_url'] ?? '')); ?>">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <input type="file" id="image_file" name="image_file" class="form-control" accept="image/*">
                    </div>
                </div>
                <?php if (!empty($project['image_url'])): ?>
                    <div style="margin-top: 10px;">
                        <span style="font-size: 12px; color: #64748b;">Current image:</span><br>
                        <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="" style="max-height: 90px; border-radius: 6px; border: 1px solid #ddd; margin-top: 4px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="summary">Short Summary / Highlights</label>
                <textarea id="summary" name="summary" class="form-control" rows="2" placeholder="Brief 1-2 sentence overview shown in project cards"><?php echo htmlspecialchars($_POST['summary'] ?? ($project['summary'] ?? '')); ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Detailed Description &amp; Technical Scope</label>
                <textarea id="description" name="description" class="form-control" rows="6" placeholder="Comprehensive breakdown of engineering deliverables, testing, equipment, and specs"><?php echo htmlspecialchars($_POST['description'] ?? ($project['description'] ?? '')); ?></textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
                    <input type="checkbox" name="featured" value="1" <?php echo (!empty($_POST['featured']) || (!empty($project['featured']) && !isset($_POST['title']))) ? 'checked' : ''; ?> style="width: 18px; height: 18px;">
                    <span>Highlight as Featured Project on Homepage Showcase</span>
                </label>
            </div>

            <div style="display: flex; gap: 12px; border-top: 1px solid var(--admin-border); padding-top: 20px; margin-top: 25px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> <?php echo $is_edit ? 'Save Changes' : 'Publish Project'; ?>
                </button>
                <a href="<?php echo $base_url; ?>/admin/projects.php" class="btn-admin btn-admin-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
