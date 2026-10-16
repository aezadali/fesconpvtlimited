<?php
/**
 * Admin Profile & Password Settings - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();
$current_admin = get_current_admin();
$admin_id = $current_admin['id'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($name) || empty($email)) {
        $errors[] = "Name and Email are required.";
    }

    if (!empty($new_password)) {
        if (strlen($new_password) < 6) {
            $errors[] = "New password must be at least 6 characters long.";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }
    }

    if (empty($errors)) {
        if (!empty($new_password)) {
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, password_hash = ? WHERE id = ?");
            $stmt->execute([$name, $email, $hash, $admin_id]);
        } else {
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $admin_id]);
        }

        $_SESSION['fescon_admin_name'] = $name;
        $_SESSION['fescon_admin_email'] = $email;

        set_flash_message('success', 'Profile and security settings updated successfully.');
        header("Location: " . $base_url . "/admin/profile.php");
        exit;
    }
}

// Fetch fresh user
$userStmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$admin_id]);
$user = $userStmt->fetch();

$admin_page_title = 'Admin Profile & Security';
$active_tab = 'profile';
require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-card" style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Security &amp; Account Settings</h3>
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

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" disabled style="background:#f1f5f9; cursor:not-allowed;">
                <div class="form-text-help">Username cannot be changed</div>
            </div>

            <div class="form-group">
                <label for="name">Display Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'] ?? $user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Admin Email *</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? $user['email']); ?>" required>
            </div>

            <div style="border-top: 1px solid var(--admin-border); margin: 25px 0 20px; padding-top: 20px;">
                <h4 style="font-size: 15px; margin-bottom: 14px; color:#111;">Change Password (Optional)</h4>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Leave blank to keep current password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Re-enter new password">
            </div>

            <div style="margin-top: 25px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fas fa-save"></i> Save Account Settings
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
