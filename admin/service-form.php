<?php
/**
 * Add / Edit Service - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$service = null;

if ($is_edit) {
    $service = get_service_by_id($id);
    if (!$service) {
        set_flash_message('danger', 'Service not found.');
        header("Location: " . $base_url . "/admin/services.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Service' : 'Add New Service Discipline';
$active_tab = 'services';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $icon_class = trim($_POST['icon_class'] ?? 'fas fa-cogs');
    $image_url = trim($_POST['image_url'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $full_description = trim($_POST['full_description'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);

    // Handle file upload
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
                $filename = 'service_' . time() . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    if (sanitize_uploaded_image($dest, $ext)) {
                        $image_url = $base_url . '/assets/images/' . $filename;
                    } else {
                        $errors[] = "Uploaded service image failed verification.";
                    }
                }
            } else {
                $errors[] = "Invalid image file format. Allowed: JPG, PNG, WEBP.";
            }
        }
    }

    if (empty($name)) {
        $errors[] = "Service name is required.";
    }

    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    }

    // Slug uniqueness
    $slugSql = "SELECT COUNT(*) FROM services WHERE slug = ?" . ($is_edit ? " AND id != ?" : "");
    $slugParams = $is_edit ? [$slug, $id] : [$slug];
    $stmt = $db->prepare($slugSql);
    $stmt->execute($slugParams);
    if ($stmt->fetchColumn() > 0) {
        $slug = $slug . '-' . time();
    }

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE services SET name = ?, slug = ?, icon_class = ?, image_url = ?, short_description = ?, full_description = ?, sort_order = ? WHERE id = ?");
            $stmt->execute([$name, $slug, $icon_class, $image_url, $short_description, $full_description, $sort_order, $id]);
            set_flash_message('success', 'Service updated successfully.');
        } else {
            $stmt = $db->prepare("INSERT INTO services (name, slug, icon_class, image_url, short_description, full_description, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $icon_class, $image_url, $short_description, $full_description, $sort_order]);
            set_flash_message('success', 'New service added successfully.');
        }
        header("Location: " . $base_url . "/admin/services.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-card" style="max-width: 850px; margin: 0 auto;">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Service Discipline' : 'Add Engineering Service'; ?></h3>
        <a href="<?php echo $base_url; ?>/admin/services.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Services
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
                <label for="name">Service Name *</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Energy Transmission &amp; Distribution" value="<?php echo htmlspecialchars($_POST['name'] ?? ($service['name'] ?? '')); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="slug">URL Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="e.g. energy-transmission-distribution" value="<?php echo htmlspecialchars($_POST['slug'] ?? ($service['slug'] ?? '')); ?>">
                    <div class="form-text-help">Access URL: <code>/service-detail.php?service=[slug]</code></div>
                </div>

                <div class="form-group">
                    <label for="icon_class">FontAwesome Icon Class</label>
                    <input type="text" id="icon_class" name="icon_class" class="form-control" placeholder="e.g. fas fa-bolt, fas fa-hard-hat" value="<?php echo htmlspecialchars($_POST['icon_class'] ?? ($service['icon_class'] ?? 'fas fa-cogs')); ?>">
                    <div class="form-text-help">Supports any FontAwesome icon (e.g. <code>fas fa-bolt</code>, <code>fas fa-tools</code>)</div>
                </div>
            </div>

            <div class="form-group">
                <label>Featured Service Image</label>
                <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 240px;">
                        <input type="text" id="image_url" name="image_url" class="form-control" placeholder="Enter image URL" value="<?php echo htmlspecialchars($_POST['image_url'] ?? ($service['image_url'] ?? '')); ?>">
                    </div>
                    <div style="flex: 1; min-width: 240px;">
                        <input type="file" id="image_file" name="image_file" class="form-control" accept="image/*">
                    </div>
                </div>
                <?php if (!empty($service['image_url'])): ?>
                    <div style="margin-top: 10px;">
                        <span style="font-size: 12px; color: #64748b;">Current image:</span><br>
                        <img src="<?php echo htmlspecialchars($service['image_url']); ?>" alt="" style="max-height: 80px; border-radius: 6px; border: 1px solid #ddd; margin-top: 4px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="short_description">Short Teaser Summary</label>
                <textarea id="short_description" name="short_description" class="form-control" rows="2" placeholder="Brief 1-sentence tagline shown on cards"><?php echo htmlspecialchars($_POST['short_description'] ?? ($service['short_description'] ?? '')); ?></textarea>
            </div>

            <div class="form-group">
                <label for="full_description">Detailed Engineering Scope &amp; Capabilities</label>
                <textarea id="full_description" name="full_description" class="form-control" rows="6" placeholder="In-depth description of engineering standards, team capabilities, and testing protocols"><?php echo htmlspecialchars($_POST['full_description'] ?? ($service['full_description'] ?? '')); ?></textarea>
            </div>

            <div class="form-group" style="max-width: 200px;">
                <label for="sort_order">Display Order</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?php echo htmlspecialchars($_POST['sort_order'] ?? ($service['sort_order'] ?? 0)); ?>">
            </div>

            <div style="display: flex; gap: 12px; border-top: 1px solid var(--admin-border); padding-top: 20px; margin-top: 25px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> <?php echo $is_edit ? 'Save Service' : 'Create Service'; ?>
                </button>
                <a href="<?php echo $base_url; ?>/admin/services.php" class="btn-admin btn-admin-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
