<?php
/**
 * Admin Login Page - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/auth.php';

if (is_admin_logged_in()) {
    header("Location: " . $base_url . "/admin/index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        try {
            $db = get_db();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Login successful
                $_SESSION['fescon_admin_logged_in'] = true;
                $_SESSION['fescon_admin_id'] = $user['id'];
                $_SESSION['fescon_admin_username'] = $user['username'];
                $_SESSION['fescon_admin_name'] = $user['name'];
                $_SESSION['fescon_admin_email'] = $user['email'];

                header("Location: " . $base_url . "/admin/index.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } catch (Exception $e) {
            $error = "Authentication system error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Fescon (Pvt.) Ltd</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/admin/assets/css/admin.css">
    <style>
        body.login-body {
            background: linear-gradient(135deg, #0d0d0f 0%, #1a1a1e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            overflow: hidden;
            border-top: 4px solid var(--admin-primary);
        }
        .login-header {
            padding: 35px 30px 20px;
            text-align: center;
            background: #fafafa;
            border-bottom: 1px solid #eee;
        }
        .login-header img {
            max-height: 52px;
            margin-bottom: 12px;
        }
        .login-header h2 {
            font-size: 20px;
            color: #111;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .login-header p {
            font-size: 13px;
            color: #666;
            margin: 0;
        }
        .login-body-content {
            padding: 30px;
        }
        .login-credentials-hint {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            padding: 12px 14px;
            font-size: 12.5px;
            color: #475569;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .login-credentials-hint i {
            color: var(--admin-primary);
            font-size: 16px;
        }
    </style>
</head>
<body class="login-body">

<div class="login-card">
    <div class="login-header">
        <a href="<?php echo $base_url; ?>/">
            <img src="<?php echo $base_url; ?>/assets/images/logo.png" alt="Fescon">
        </a>
        <h2>Admin Management Portal</h2>
        <p>Sign in to manage projects, services &amp; partners</p>
    </div>

    <div class="login-body-content">
        <?php if (!empty($error)): ?>
            <div class="admin-alert danger">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter admin username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter admin password" required>
            </div>

            <button type="submit" class="btn-admin btn-admin-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 15px; margin-top: 10px;">
                <i class="fas fa-sign-in-alt"></i> Sign In to Dashboard
            </button>
        </form>

        <div class="login-credentials-hint">
            <i class="fas fa-key"></i>
            <div>
                <strong>Default Credentials:</strong><br>
                Username: <code>admin</code> &bull; Password: <code>admin123</code>
            </div>
        </div>

        <div style="text-align: center; margin-top: 20px; font-size: 13px;">
            <a href="<?php echo $base_url; ?>/" style="color: #64748b; text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Return to Fescon Website
            </a>
        </div>
    </div>
</div>

</body>
</html>
