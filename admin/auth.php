<?php
/**
 * Admin Authentication & Session Management Helper
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

function is_admin_logged_in() {
    return !empty($_SESSION['fescon_admin_logged_in']) && !empty($_SESSION['fescon_admin_id']);
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
?>
