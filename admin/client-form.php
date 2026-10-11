<?php
/**
 * Add / Edit Partner Client Logo - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$client = null;

if ($is_edit) {
    $client = get_client_by_id($id);
    if (!$client) {
        set_flash_message('danger', 'Partner client not found.');
        header("Location: " . $base_url . "/admin/clients.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Partner Logo' : 'Add New Partner Logo';
$active_tab = 'clients';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $logo_url = trim($_POST['logo_url'] ?? '');
    $website_url = trim($_POST['website_url'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);

    // Handle file upload
    if (!empty($_FILES['logo_file']['name'])) {
        $file = $_FILES['logo_file'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_exts = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts)) {
                $upload_dir = __DIR__ . '/../assets/images';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $filename = 'client_' . time() . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $logo_url = $base_url . '/assets/images/' . $filename;
                }
            } else {
                $errors[] = "Invalid logo file format. Allowed: PNG, JPG, WEBP, SVG.";
            }
        }
    }

    if (empty($name)) {
        $errors[] = "Partner / Client organization name is required.";
    }

    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    }

    if (empty($logo_url)) {
        $errors[] = "Please provide a logo image URL or upload an image file.";
    }

    // Slug uniqueness
    $slugSql = "SELECT COUNT(*) FROM clients WHERE slug = ?" . ($is_edit ? " AND id != ?" : "");
    $slugParams = $is_edit ? [$slug, $id] : [$slug];
    $stmt = $db->prepare($slugSql);
    $stmt->execute($slugParams);
    if ($stmt->fetchColumn() > 0) {
        $slug = $slug . '-' . time();
    }

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE clients SET name = ?, slug = ?, logo_url = ?, website_url = ?, description = ?, sort_order = ? WHERE id = ?");
            $stmt->execute([$name, $slug, $logo_url, $website_url, $description, $sort_order, $id]);
            set_flash_message('success', 'Partner client logo updated.');
        } else {
            $stmt = $db->prepare("INSERT INTO clients (name, slug, logo_url, website_url, description, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $logo_url, $website_url, $description, $sort_order]);
            set_flash_message('success', 'New partner logo added to the slider.');
        }
        header("Location: " . $base_url . "/admin/clients.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Partner Organization' : 'Add Partner Logo for Slider'; ?></h3>
        <a href="<?php echo $base_url; ?>/admin/clients.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Partners
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
                <label for="name">Organization Name *</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="e.g. WAPDA, NTDC, IESCO" value="<?php echo htmlspecialchars($_POST['name'] ?? ($client['name'] ?? '')); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="slug">URL Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="e.g. wapda" value="<?php echo htmlspecialchars($_POST['slug'] ?? ($client['slug'] ?? '')); ?>">
                    <div class="form-text-help">Used in URLs: <code>/client-projects.php?client=[slug]</code></div>
                </div>

                <div class="form-group">
                    <label for="sort_order">Display Order in Slider</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?php echo htmlspecialchars($_POST['sort_order'] ?? ($client['sort_order'] ?? 0)); ?>">
                    <div class="form-text-help">Lower numbers appear first in the infinite slider</div>
                </div>
            </div>

            <div class="form-group">
                <label>Logo Image *</label>
                <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 240px;">
                        <input type="text" id="logo_url" name="logo_url" class="form-control" placeholder="Enter logo image URL" value="<?php echo htmlspecialchars($_POST['logo_url'] ?? ($client['logo_url'] ?? '')); ?>">
                    </div>
                    <div style="flex: 1; min-width: 240px;">
                        <input type="file" id="logo_file" name="logo_file" class="form-control" accept="image/*">
                    </div>
                </div>
                <?php if (!empty($client['logo_url'])): ?>
                    <div style="margin-top: 12px; background: #f8fafc; padding: 10px 16px; border-radius: 6px; display: inline-flex; align-items: center; gap: 12px; border: 1px solid #e2e8f0;">
                        <span style="font-size: 12px; color: #64748b;">Current logo:</span>
                        <img src="<?php echo htmlspecialchars($client['logo_url']); ?>" alt="" style="max-height: 40px; max-width: 120px; object-fit: contain;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="website_url">Official Website URL (Optional)</label>
                <input type="url" id="website_url" name="website_url" class="form-control" placeholder="https://example.com" value="<?php echo htmlspecialchars($_POST['website_url'] ?? ($client['website_url'] ?? '')); ?>">
            </div>

            <div class="form-group">
                <label for="description">Partnership Overview / Notes</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Brief summary of engineering collaborations and project history with this client"><?php echo htmlspecialchars($_POST['description'] ?? ($client['description'] ?? '')); ?></textarea>
            </div>

            <div style="display: flex; gap: 12px; border-top: 1px solid var(--admin-border); padding-top: 20px; margin-top: 25px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> <?php echo $is_edit ? 'Save Changes' : 'Add Logo to Slider'; ?>
                </button>
                <a href="<?php echo $base_url; ?>/admin/clients.php" class="btn-admin btn-admin-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
