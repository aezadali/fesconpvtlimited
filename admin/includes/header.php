<?php
/**
 * Admin Shared Header & Sidebar Component
 */
require_once __DIR__ . '/../auth.php';
require_admin_login();

$current_admin = get_current_admin();
$flash = get_flash_message();

// Unread inquiries count for badge
$db = get_db();
$unread_count = $db->query("SELECT COUNT(*) FROM inquiries WHERE is_read = 0")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($admin_page_title ?? 'Dashboard'); ?> | Fescon Admin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Cardo:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/admin/assets/css/admin.css">
</head>
<body class="admin-body">

<!-- Sidebar Navigation -->
<aside class="admin-sidebar" id="adminSidebar">
    <a href="<?php echo $base_url; ?>/admin/index.php" class="sidebar-brand">
        <img src="<?php echo $base_url; ?>/assets/images/logo.png" alt="Fescon">
        <span>Admin Portal</span>
    </a>

    <ul class="sidebar-menu">
        <li class="sidebar-menu-title">Main</li>
        <li class="<?php echo ($active_tab ?? '') === 'dashboard' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/index.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-menu-title">Portfolio &amp; Solutions</li>
        <li class="<?php echo ($active_tab ?? '') === 'projects' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/projects.php">
                <i class="fas fa-project-diagram"></i>
                <span>Projects</span>
            </a>
        </li>
        <li class="<?php echo ($active_tab ?? '') === 'services' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/services.php">
                <i class="fas fa-cogs"></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php echo ($active_tab ?? '') === 'clients' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/clients.php">
                <i class="fas fa-handshake"></i>
                <span>Partner Logos</span>
            </a>
        </li>
        <li class="<?php echo ($active_tab ?? '') === 'team' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/team.php">
                <i class="fas fa-users"></i>
                <span>Team &amp; Employees</span>
            </a>
        </li>

        <li class="sidebar-menu-title">Communication</li>
        <li class="<?php echo ($active_tab ?? '') === 'inquiries' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/inquiries.php">
                <i class="fas fa-envelope-open-text"></i>
                <span>Inquiries</span>
                <?php if ($unread_count > 0): ?>
                    <span class="badge"><?php echo $unread_count; ?></span>
                <?php endif; ?>
            </a>
        </li>

        <li class="sidebar-menu-title">Configuration</li>
        <li class="<?php echo ($active_tab ?? '') === 'profile' ? 'active' : ''; ?>">
            <a href="<?php echo $base_url; ?>/admin/profile.php">
                <i class="fas fa-user-shield"></i>
                <span>Admin Profile</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?php echo $base_url; ?>/" target="_blank">
            <i class="fas fa-external-link-alt"></i> Live Website
        </a>
        <a href="<?php echo $base_url; ?>/admin/logout.php" title="Sign Out" style="color:#ef4444;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>

<!-- Main Wrapper -->
<div class="admin-main">
    <!-- Topbar -->
    <header class="admin-topbar">
        <div class="topbar-left">
            <button class="topbar-toggle-btn" id="sidebarToggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-page-title">
                <?php echo htmlspecialchars($admin_page_title ?? 'Dashboard'); ?>
            </div>
        </div>

        <div class="topbar-right">
            <a href="<?php echo $base_url; ?>/admin/project-form.php" class="btn-admin btn-admin-primary btn-admin-sm">
                <i class="fas fa-plus"></i> New Project
            </a>
            <div class="topbar-user">
                <div class="topbar-avatar">
                    <?php echo strtoupper(substr($current_admin['name'], 0, 1)); ?>
                </div>
                <div style="font-size: 13px; font-weight: 600; display: none;" class="d-md-block">
                    <?php echo htmlspecialchars($current_admin['name']); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="admin-content">
        <?php if ($flash): ?>
            <div class="admin-alert <?php echo htmlspecialchars($flash['type']); ?>">
                <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <span><?php echo htmlspecialchars($flash['message']); ?></span>
            </div>
        <?php endif; ?>
