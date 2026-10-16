<?php
/**
 * Add / Edit Gallery Event - Fescon Admin
 * Supports title, category, date, location, description, cover image, and multiple photo uploads/URLs
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$event = null;

if ($is_edit) {
    $event = get_gallery_event_by_id($id);
    if (!$event) {
        set_flash_message('danger', 'Gallery event not found.');
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Gallery Event' : 'Add New Gallery Event';
$active_tab = 'gallery';

$errors = [];

// Handle Delete Event
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    if ($is_edit) {
        $stmt = $db->prepare("DELETE FROM gallery_events WHERE id = ?");
        $stmt->execute([$id]);
        set_flash_message('success', 'Gallery event removed successfully.');
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

// Handle POST save
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'EPC Projects');
    $event_date = trim($_POST['event_date'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $cover_image = trim($_POST['cover_image'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Existing photos or manual URLs
    $existing_images = !empty($_POST['existing_images']) ? $_POST['existing_images'] : [];
    if (!is_array($existing_images)) {
        $existing_images = [];
    }

    // Manual photo URLs (one per line)
    $manual_urls_text = trim($_POST['manual_image_urls'] ?? '');
    if (!empty($manual_urls_text)) {
        $lines = preg_split('/[\r\n]+/', $manual_urls_text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && !in_array($line, $existing_images)) {
                $existing_images[] = $line;
            }
        }
    }

    // Handle Cover Image Upload
    if (!empty($_FILES['cover_file']['name'])) {
        $file = $_FILES['cover_file'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_exts = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts)) {
                $upload_dir = __DIR__ . '/../assets/images';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $filename = 'gallery_cover_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $cover_image = 'assets/images/' . $filename;
                }
            } else {
                $errors[] = "Cover image format not supported. Use JPG, PNG, or WebP.";
            }
        }
    }

    // Handle Multiple Additional Photos Upload
    if (!empty($_FILES['photo_files']['name'][0])) {
        $allowed_exts = ['png', 'jpg', 'jpeg', 'webp'];
        $upload_dir = __DIR__ . '/../assets/images';
        if (!is_dir($upload_dir)) {
            @mkdir($upload_dir, 0755, true);
        }

        foreach ($_FILES['photo_files']['name'] as $k => $fname) {
            if (empty($fname)) continue;
            if ($_FILES['photo_files']['error'][$k] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                if (in_array($ext, $allowed_exts)) {
                    $filename = 'event_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                    $dest = $upload_dir . '/' . $filename;
                    if (move_uploaded_file($_FILES['photo_files']['tmp_name'][$k], $dest)) {
                        $existing_images[] = 'assets/images/' . $filename;
                    }
                }
            }
        }
    }

    // Validate required fields
    if (empty($title)) {
        $errors[] = "Event title is required.";
    }

    // Default cover to first image if empty
    if (empty($cover_image) && !empty($existing_images)) {
        $cover_image = $existing_images[0];
    }

    $images_json = json_encode(array_values(array_filter($existing_images)));

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE gallery_events SET title = ?, category = ?, event_date = ?, location = ?, description = ?, cover_image = ?, image_url = ?, images = ?, sort_order = ?, is_active = ? WHERE id = ?");
            $stmt->execute([$title, $category, $event_date, $location, $description, $cover_image, $cover_image, $images_json, $sort_order, $is_active, $id]);
            set_flash_message('success', 'Gallery event updated successfully.');
        } else {
            $stmt = $db->prepare("INSERT INTO gallery_events (title, category, event_date, location, description, cover_image, image_url, images, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $category, $event_date, $location, $description, $cover_image, $cover_image, $images_json, $sort_order, $is_active]);
            set_flash_message('success', 'New gallery event created successfully.');
        }
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';

// Prepare data for form
$form_title = $event['title'] ?? '';
$form_category = $event['category'] ?? 'EPC Projects';
$form_date = $event['event_date'] ?? date('Y');
$form_location = $event['location'] ?? '';
$form_desc = $event['description'] ?? '';
$form_cover = $event['cover_image'] ?? '';
$form_order = $event['sort_order'] ?? 0;
$form_active = $is_edit ? ($event['is_active'] ?? 1) : 1;
$form_images = !empty($event['images']) ? json_decode($event['images'], true) : [];
if (!is_array($form_images)) $form_images = [];

$categories = ['EPC Projects', 'Transmission', 'Planning', 'Civil Works', 'Electrical', 'HSE', 'Corporate Events', 'Certifications'];
?>

<div class="admin-card" style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Gallery Event' : 'Add New Event / Photo Collection'; ?></h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">Upload photos, assign an event category, and specify site details.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/gallery.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Gallery List
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
            <label for="title" class="form-label">Event Title <span style="color: #dc2626;">*</span></label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($form_title); ?>" required placeholder="e.g. 500kV Grid Station Equipment Erection">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
            <div class="form-group">
                <label for="category" class="form-label">Activity Category</label>
                <select id="category" name="category" class="form-control">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $form_category === $cat ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="event_date" class="form-label">Date / Year</label>
                <input type="text" id="event_date" name="event_date" class="form-control" value="<?php echo htmlspecialchars($form_date); ?>" placeholder="e.g. October 2026 or 2025">
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Location / Site</label>
                <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($form_location); ?>" placeholder="e.g. Lahore, Punjab / Field Site">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Event Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Provide a detailed summary of the engineering work, milestone, or corporate gathering..."><?php echo htmlspecialchars($form_desc); ?></textarea>
        </div>

        <!-- Cover Image -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px; margin-bottom: 20px;">
            <label class="form-label" style="margin-bottom: 6px; font-weight: 700;">Cover Image</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; align-items: center;">
                <div>
                    <label style="font-size: 12px; color: #64748b; display: block; margin-bottom: 4px;">Upload Cover File:</label>
                    <input type="file" name="cover_file" class="form-control" accept="image/*">
                </div>
                <div>
                    <label style="font-size: 12px; color: #64748b; display: block; margin-bottom: 4px;">Or Image Path / URL:</label>
                    <input type="text" name="cover_image" class="form-control" value="<?php echo htmlspecialchars($form_cover); ?>" placeholder="assets/images/photo.jpg">
                </div>
            </div>
            <?php if (!empty($form_cover)): ?>
                <div style="margin-top: 12px; display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 12px; color: #64748b;">Current Cover:</span>
                    <img src="<?php echo asset_url($form_cover); ?>" alt="" style="height: 50px; border-radius: 4px; border: 1px solid #cbd5e1;">
                </div>
            <?php endif; ?>
        </div>

        <!-- Existing Photos in Collection -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px; margin-bottom: 20px;">
            <label class="form-label" style="margin-bottom: 6px; font-weight: 700;">Event Photo Collection (<?php echo count($form_images); ?> photos)</label>
            
            <?php if (!empty($form_images)): ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 12px; margin-bottom: 16px;">
                    <?php foreach ($form_images as $idx => $img_path): ?>
                        <div style="position: relative; border-radius: 6px; overflow: hidden; border: 1px solid #cbd5e1; background: #fff;">
                            <img src="<?php echo asset_url($img_path); ?>" alt="" style="width: 100%; height: 90px; object-fit: cover; display: block;">
                            <input type="hidden" name="existing_images[]" value="<?php echo htmlspecialchars($img_path); ?>">
                            <button type="button" onclick="this.parentElement.remove()" style="position: absolute; top: 4px; right: 4px; background: rgba(220,38,38,0.9); color: #fff; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 11px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Remove this photo">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div style="margin-top: 12px;">
                <label style="font-size: 13px; font-weight: 600; color: #0f172a; display: block; margin-bottom: 4px;">
                    <i class="fas fa-upload"></i> Upload Additional Photos (Multiple Select):
                </label>
                <input type="file" name="photo_files[]" class="form-control" multiple accept="image/*">
                <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Hold Ctrl to select multiple JPG, PNG, or WebP files simultaneously.</span>
            </div>

            <div style="margin-top: 14px;">
                <label style="font-size: 13px; font-weight: 600; color: #0f172a; display: block; margin-bottom: 4px;">
                    <i class="fas fa-link"></i> Or Add Image Paths (One per line):
                </label>
                <textarea name="manual_image_urls" class="form-control" rows="3" placeholder="assets/images/photo1.jpg&#10;assets/images/photo2.jpg"></textarea>
            </div>
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

        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0; display: flex; gap: 12px; justify-content: space-between; align-items: center;">
            <div>
                <?php if ($is_edit): ?>
                    <button type="button" class="btn-admin btn-admin-danger" onclick="if(confirm('Are you sure you want to delete this event and all its photos?')) { document.getElementById('formDeleteAction').submit(); }">
                        <i class="fas fa-trash-alt"></i> Delete Event
                    </button>
                <?php endif; ?>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="<?php echo $base_url; ?>/admin/gallery.php" class="btn-admin btn-admin-secondary">Cancel</a>
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> <?php echo $is_edit ? 'Update Gallery Event' : 'Save & Publish Event'; ?>
                </button>
            </div>
        </div>
    </form>
</div>

<?php if ($is_edit): ?>
<form id="formDeleteAction" method="POST" action="" style="display: none;">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="delete">
</form>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
