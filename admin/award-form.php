<?php
/**
 * Add / Edit Award & Certificate - Fescon Admin
 * Supports title, category, year/status, issuer, certificate image upload/path, and description
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$award = null;

if ($is_edit) {
    $award = get_award_by_id($id);
    if (!$award) {
        set_flash_message('danger', 'Award credential not found.');
        header("Location: " . $base_url . "/admin/awards.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Award / Certificate' : 'Add New Award / Certificate';
$active_tab = 'awards';

$errors = [];

// Handle POST save
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Statutory Registration');
    $year = trim($_POST['year'] ?? 'Active');
    $issuer = trim($_POST['issuer'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Handle Certificate Image File Upload
    if (!empty($_FILES['image_file']['name'])) {
        $file = $_FILES['image_file'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_exts = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts)) {
                $upload_dir = __DIR__ . '/../assets/images';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $filename = 'cert_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    if (sanitize_uploaded_image($dest, $ext)) {
                        $image_url = 'assets/images/' . $filename;
                    } else {
                        $errors[] = "Uploaded file failed image verification.";
                    }
                }
            } else {
                $errors[] = "Certificate image format not supported. Allowed: PNG, JPG, WebP.";
            }
        }
    }

    if (empty($title)) {
        $errors[] = "Award or certificate title is required.";
    }

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE awards SET title = ?, category = ?, year = ?, issuer = ?, image_url = ?, description = ?, sort_order = ?, is_active = ? WHERE id = ?");
            $stmt->execute([$title, $category, $year, $issuer, $image_url, $description, $sort_order, $is_active, $id]);
            set_flash_message('success', 'Award credential updated successfully.');
        } else {
            $stmt = $db->prepare("INSERT INTO awards (title, category, year, issuer, image_url, description, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $category, $year, $issuer, $image_url, $description, $sort_order, $is_active]);
            set_flash_message('success', 'New award credential added successfully.');
        }
        header("Location: " . $base_url . "/admin/awards.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';

// Form values
$form_title = $award['title'] ?? '';
$form_category = $award['category'] ?? 'Statutory Registration';
$form_year = $award['year'] ?? 'Active';
$form_issuer = $award['issuer'] ?? '';
$form_desc = $award['description'] ?? '';
$form_img = $award['image_url'] ?? '';
$form_order = $award['sort_order'] ?? 0;
$form_active = $is_edit ? ($award['is_active'] ?? 1) : 1;

$categories = [
    'Statutory Registration',
    'International Certification',
    'Environmental Standards',
    'Workplace Safety',
    'National Enlistment',
    'Client Appreciation Letter',
    'Industry Excellence Award'
];
?>

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Award / Certificate' : 'Add New Award / Certificate'; ?></h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">Upload scans or specify image paths for official certifications, awards, and appreciation letters.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/awards.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Awards List
        </a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" style="margin: 20px 24px 0;">
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($errors as $e): ?>
                    <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="admin-form" style="padding: 24px;">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group">
            <label for="title" class="form-label">Award / Certificate Title <span style="color: #dc2626;">*</span></label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($form_title); ?>" required placeholder="e.g. ISO 9001:2015 — Quality Management System">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-control">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $form_category === $cat ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="year" class="form-label">Status / Year</label>
                <input type="text" id="year" name="year" class="form-control" value="<?php echo htmlspecialchars($form_year); ?>" placeholder="e.g. Certified, Active, or 2025">
            </div>

            <div class="form-group">
                <label for="issuer" class="form-label">Issuing Authority / Client</label>
                <input type="text" id="issuer" name="issuer" class="form-control" value="<?php echo htmlspecialchars($form_issuer); ?>" placeholder="e.g. Pakistan Engineering Council / ISO">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Detailed Scope / Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Describe the authority scope, authorization limits, or specific project excellence recognized..."><?php echo htmlspecialchars($form_desc); ?></textarea>
        </div>

        <!-- Certificate Image -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px; margin-bottom: 20px;">
            <label class="form-label" style="margin-bottom: 6px; font-weight: 700;">Certificate / Award Image</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; align-items: center;">
                <div>
                    <label style="font-size: 12px; color: #64748b; display: block; margin-bottom: 4px;">Upload Certificate Scan:</label>
                    <input type="file" name="image_file" class="form-control" accept="image/*">
                </div>
                <div>
                    <label style="font-size: 12px; color: #64748b; display: block; margin-bottom: 4px;">Or Image Path / URL:</label>
                    <input type="text" name="image_url" class="form-control" value="<?php echo htmlspecialchars($form_img); ?>" placeholder="assets/images/cer.png">
                </div>
            </div>
            <?php if (!empty($form_img)): ?>
                <div style="margin-top: 14px; display: flex; align-items: center; gap: 14px; background: #fff; padding: 10px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <img src="<?php echo asset_url($form_img); ?>" alt="" style="height: 70px; border-radius: 4px; object-fit: contain;">
                    <div style="font-size: 12px; color: #64748b;">
                        <div>Current Image: <code><?php echo htmlspecialchars($form_img); ?></code></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
                <label for="sort_order" class="form-label">Display Order (Lower = First)</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?php echo $form_order; ?>">
            </div>

            <div class="form-group" style="display: flex; align-items: center; padding-top: 28px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; font-weight: 600; color: #0f172a;">
                    <input type="checkbox" name="is_active" value="1" <?php echo $form_active ? 'checked' : ''; ?> style="width: 18px; height: 18px;">
                    <span>Visible on Live Website</span>
                </label>
            </div>
        </div>

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0; display: flex; gap: 12px; justify-content: flex-end;">
            <a href="<?php echo $base_url; ?>/admin/awards.php" class="btn-admin btn-admin-secondary">Cancel</a>
            <button type="submit" class="btn-admin btn-admin-primary">
                <i class="fas fa-save"></i> <?php echo $is_edit ? 'Update Award Credential' : 'Save & Publish Award'; ?>
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
