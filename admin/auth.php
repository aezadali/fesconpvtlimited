<?php
/**
 * Admin Authentication & Session Management Helper
 */

if (ob_get_level() === 0) {
    ob_start();
}

if (session_status() === PHP_SESSION_NONE) {
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => $is_https,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    } else {
        session_set_cookie_params(0, '/; samesite=Lax', '', $is_https, true);
    }
    session_start();
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

function is_admin_logged_in() {
    if (empty($_SESSION['fescon_admin_logged_in']) || empty($_SESSION['fescon_admin_id'])) {
        return false;
    }
    // Inactivity timeout: 2 hours (7200 seconds)
    if (!empty($_SESSION['fescon_last_activity']) && (time() - $_SESSION['fescon_last_activity'] > 7200)) {
        unset($_SESSION['fescon_admin_logged_in'], $_SESSION['fescon_admin_id'], $_SESSION['fescon_last_activity']);
        return false;
    }
    $_SESSION['fescon_last_activity'] = time();
    return true;
}

function require_admin_login() {
    global $base_url;
    if (!is_admin_logged_in()) {
        header("Location: " . $base_url . "/admin/login.php");
        exit;
    }
}

function get_current_admin() {
    if (!is_admin_logged_in()) return null;
    return [
        'id' => $_SESSION['fescon_admin_id'],
        'username' => $_SESSION['fescon_admin_username'] ?? 'admin',
        'name' => $_SESSION['fescon_admin_name'] ?? 'Administrator',
        'email' => $_SESSION['fescon_admin_email'] ?? 'admin@fescon.com.pk'
    ];
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf() {
    $token = $_POST['csrf_token'] ?? '';
    if (empty($token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        die("Security validation failed (Invalid CSRF Token). Please refresh and try again.");
    }
}

function set_flash_message($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

function get_flash_message() {
    if (!empty($_SESSION['flash_message'])) {
        $msg = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $msg;
    }
    return null;
}

/**
 * Sanitize and validate uploaded image files
 */
function sanitize_uploaded_image($filePath, $ext) {
    if (!file_exists($filePath)) return false;
    $ext = strtolower($ext);
    if ($ext === 'svg') {
        $content = file_get_contents($filePath);
        // Strip script tags
        $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $content);
        // Strip inline event handlers
        $content = preg_replace('/\bon[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $content);
        // Strip javascript: hrefs
        $content = preg_replace('/href\s*=\s*("javascript:[^"]*"|\'javascript:[^\']*\'|javascript:[^\s>]+)/i', 'href="#"', $content);
        file_put_contents($filePath, $content);
    } else {
        // For raster images, verify valid image structure with getimagesize
        if (function_exists('getimagesize')) {
            $info = @getimagesize($filePath);
            if ($info === false) {
                @unlink($filePath);
                return false;
            }
        }
    }
    return true;
}
?>
