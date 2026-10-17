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
$max_attempts = 5;
$lockout_time = 900; // 15 minutes

// Check lockout
if (!empty($_SESSION['login_lockout']) && time() < $_SESSION['login_lockout']) {
    $remaining = ceil(($_SESSION['login_lockout'] - time()) / 60);
    $error = "Too many failed login attempts. Please try again in {$remaining} minute(s).";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset lockout if expired
    if (!empty($_SESSION['login_lockout']) && time() >= $_SESSION['login_lockout']) {
        unset($_SESSION['login_lockout'], $_SESSION['login_attempts']);
    }

    $token = $_POST['csrf_token'] ?? '';
    if (empty($token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        $error = "Security validation expired. Please refresh the page and try again.";
    } else {
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
                    // Reset attempt counters
                    unset($_SESSION['login_attempts'], $_SESSION['login_lockout']);

                    // Regenerate session ID to prevent session fixation
                    session_regenerate_id(true);

                    // Login successful
                    $_SESSION['fescon_admin_logged_in'] = true;
                    $_SESSION['fescon_admin_id'] = $user['id'];
                    $_SESSION['fescon_admin_username'] = $user['username'];
                    $_SESSION['fescon_admin_name'] = $user['name'];
                    $_SESSION['fescon_admin_email'] = $user['email'];
                    $_SESSION['fescon_last_activity'] = time();

                    header("Location: " . $base_url . "/admin/index.php");
                    exit;
                } else {
                    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
                    if ($_SESSION['login_attempts'] >= $max_attempts) {
                        $_SESSION['login_lockout'] = time() + $lockout_time;
                        $error = "Too many failed login attempts. Account locked for 15 minutes.";
                    } else {
                        $remaining = $max_attempts - $_SESSION['login_attempts'];
                        $error = "Invalid username or password. ({$remaining} attempt(s) remaining)";
                    }
                }
            } catch (Exception $e) {
                error_log("Authentication system error: " . $e->getMessage());
                $error = "Unable to process login at this time. Please try again later.";
            }
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
    <link rel="icon" type="image/png" href="<?php echo $base_url; ?>/assets/images/cropped-con-32x32.png" sizes="32x32">
    <link rel="shortcut icon" href="<?php echo $base_url; ?>/favicon.ico">
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
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter admin username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter admin password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-admin btn-admin-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 15px; margin-top: 10px;">
                <i class="fas fa-sign-in-alt"></i> Sign In to Dashboard
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px; font-size: 13px;">
            <a href="<?php echo $base_url; ?>/" style="color: #64748b; text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Return to Fescon Website
            </a>
        </div>
    </div>
</div>

</body>
</html>
