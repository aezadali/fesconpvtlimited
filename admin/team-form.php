<?php
/**
 * Add / Edit Team Member / Employee - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$id = intval($_GET['id'] ?? 0);
$is_edit = $id > 0;
$member = null;

if ($is_edit) {
    $member = get_team_member_by_id($id);
    if (!$member) {
        set_flash_message('danger', 'Team member not found.');
        header("Location: " . $base_url . "/admin/team.php");
        exit;
    }
}

$admin_page_title = $is_edit ? 'Edit Employee Details' : 'Add New Team Member';
$active_tab = 'team';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim($_POST['name'] ?? '');
    $designation = trim($_POST['designation'] ?? '');
    $department = trim($_POST['department'] ?? 'Engineering');
    $image_url = trim($_POST['existing_image_url'] ?? ($member['image_url'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $linkedin_url = trim($_POST['linkedin_url'] ?? '');
    $education = trim($_POST['education'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);
    $is_active = !empty($_POST['is_active']) ? 1 : 0;

    // Handle photo upload
    if (!empty($_FILES['photo_file']['name'])) {
        $file = $_FILES['photo_file'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed_exts)) {
                $upload_dir = __DIR__ . '/../assets/images';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $filename = 'team_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file['name'], PATHINFO_FILENAME)) . '.' . $ext;
                $dest = $upload_dir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    if (sanitize_uploaded_image($dest, $ext)) {
                        $image_url = $base_url . '/assets/images/' . $filename;
                    } else {
                        $errors[] = "Uploaded member photo failed verification.";
                    }
                }
            } else {
                $errors[] = "Invalid image file format. Allowed: JPG, PNG, WEBP.";
            }
        }
    }

    if (empty($name)) {
        $errors[] = "Employee full name is required.";
    }

    if (empty($designation)) {
        $errors[] = "Designation / Job title is required.";
    }

    if (empty($image_url)) {
        $image_url = $base_url . '/assets/images/placeholder.svg';
    }

    if (empty($errors)) {
        if ($is_edit) {
            $stmt = $db->prepare("UPDATE team_members SET 
                name = ?, designation = ?, department = ?, image_url = ?, email = ?, 
                phone = ?, linkedin_url = ?, education = ?, bio = ?, sort_order = ?, is_active = ?
                WHERE id = ?");
            $stmt->execute([
                $name, $designation, $department, $image_url, $email,
                $phone, $linkedin_url, $education, $bio, $sort_order, $is_active,
                $id
            ]);
            set_flash_message('success', 'Employee profile updated successfully.');
        } else {
            $stmt = $db->prepare("INSERT INTO team_members 
                (name, designation, department, image_url, email, phone, linkedin_url, education, bio, sort_order, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $name, $designation, $department, $image_url, $email,
                $phone, $linkedin_url, $education, $bio, $sort_order, $is_active
            ]);
            set_flash_message('success', 'New team member added to roster.');
        }
        header("Location: " . $base_url . "/admin/team.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-card" style="max-width: 850px; margin: 0 auto;">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><?php echo $is_edit ? 'Edit Employee Details' : 'Add New Team Member'; ?></h3>
        <a href="<?php echo $base_url; ?>/admin/team.php" class="btn-admin btn-admin-secondary">
            <i class="fas fa-arrow-left"></i> Back to Team List
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

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Engr. Abdul Mutlib" value="<?php echo htmlspecialchars($_POST['name'] ?? ($member['name'] ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="designation">Designation / Role *</label>
                    <input type="text" id="designation" name="designation" class="form-control" placeholder="e.g. Sr. Engineer – Civil" value="<?php echo htmlspecialchars($_POST['designation'] ?? ($member['designation'] ?? '')); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="department">Department</label>
                    <select id="department" name="department" class="form-control">
                        <?php 
                        $curDept = $_POST['department'] ?? ($member['department'] ?? 'Engineering');
                        $deptOptions = [
                            'Executive Leadership',
                            'Business Development',
                            'Engineering',
                            'Civil Infrastructure',
                            'Electrical Engineering',
                            'EPC Projects',
                            'Technical & Planning',
                            'Commercial & Contracts',
                            'Finance & Accounts',
                            'Operations & Maintenance'
                        ];
                        foreach ($deptOptions as $d): ?>
                            <option value="<?php echo htmlspecialchars($d); ?>" <?php echo $curDept === $d ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($d); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_order">Display Hierarchy / Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?php echo htmlspecialchars($_POST['sort_order'] ?? ($member['sort_order'] ?? 0)); ?>">
                    <div class="form-text-help">Lower numbers appear first on the team page (e.g. 1 for CEO)</div>
                </div>
            </div>

            <div class="form-group">
                <label for="photo_file">Profile Photo Upload *</label>
                <input type="hidden" name="existing_image_url" value="<?php echo htmlspecialchars($_POST['existing_image_url'] ?? ($member['image_url'] ?? '')); ?>">
                <input type="file" id="photo_file" name="photo_file" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp">
                <div class="form-text-help">Select a photo file from your computer (JPG, PNG, or WEBP).</div>
                <?php 
                    $currentPhoto = $_POST['existing_image_url'] ?? ($member['image_url'] ?? '');
                    if (!empty($currentPhoto) && strpos($currentPhoto, 'placeholder.svg') === false): 
                ?>
                    <div style="margin-top: 12px; display: flex; align-items: center; gap: 14px; background: #f8fafc; padding: 10px 14px; border-radius: 6px; border: 1px solid #e2e8f0; width: fit-content;">
                        <img src="<?php echo htmlspecialchars($currentPhoto); ?>" onerror="this.onerror=null; this.src='<?php echo $base_url; ?>/assets/images/placeholder.svg';" alt="" style="width: 54px; height: 54px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;">
                        <div>
                            <div style="font-size: 13px; font-weight: 600; color: #334155;">Current Profile Photo</div>
                            <div style="font-size: 11.5px; color: #64748b;">Upload a new file above to replace it.</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Work Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="employee@fescon.com.pk" value="<?php echo htmlspecialchars($_POST['email'] ?? ($member['email'] ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Phone / Extension</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="+92 51 1234567" value="<?php echo htmlspecialchars($_POST['phone'] ?? ($member['phone'] ?? '')); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="education">Education &amp; Professional Certifications</label>
                    <input type="text" id="education" name="education" class="form-control" placeholder="e.g. B.Sc. Civil Engineering, PEC Professional Engineer, PMP" value="<?php echo htmlspecialchars($_POST['education'] ?? ($member['education'] ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label for="linkedin_url">LinkedIn Profile URL</label>
                    <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" placeholder="https://linkedin.com/in/username" value="<?php echo htmlspecialchars($_POST['linkedin_url'] ?? ($member['linkedin_url'] ?? '')); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="bio">Professional Biography &amp; Technical Background</label>
                <textarea id="bio" name="bio" class="form-control" rows="5" placeholder="Detail their engineering accomplishments, project leadership, key credentials, and years of experience"><?php echo htmlspecialchars($_POST['bio'] ?? ($member['bio'] ?? '')); ?></textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
                    <input type="checkbox" name="is_active" value="1" <?php echo (!isset($member) || !empty($member['is_active']) || !empty($_POST['is_active'])) ? 'checked' : ''; ?> style="width: 18px; height: 18px;">
                    <span>Active Team Member (visible on public website)</span>
                </label>
            </div>

            <div style="display: flex; gap: 12px; border-top: 1px solid var(--admin-border); padding-top: 20px; margin-top: 25px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> <?php echo $is_edit ? 'Save Employee Details' : 'Add to Team'; ?>
                </button>
                <a href="<?php echo $base_url; ?>/admin/team.php" class="btn-admin btn-admin-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
