<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

$page_title = $page_title ?? 'Fescon (Pvt.) Ltd | Engineering, Infrastructure & Turnkey EPC Solutions';
$current_page = $current_page ?? 'index';

function is_nav_active($pages, $current) {
    if (is_array($pages)) {
        return in_array($current, $pages) ? 'active' : '';
    }
    return ($current === $pages) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="Fescon (Pvt.) Ltd is a premier engineering, power transmission, high-voltage substation, civil works, and turnkey EPC contractor in Pakistan, registered with the Pakistan Engineering Council (PEC) Category C-A.">
    
    <!-- Favicons -->
    <link rel="icon" href="<?php echo $base_url; ?>/assets/images/cropped-con-32x32.png" sizes="32x32">
    <link rel="icon" href="<?php echo $base_url; ?>/assets/images/cropped-con-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo $base_url; ?>/assets/images/cropped-con-180x180.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons (Local & CDN for 100% Reliable Icon Rendering) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/solid.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/brands.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/swiper.min.css">
    
    <!-- Core & Modern Design Theme -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/animations.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/modern-theme.css">
</head>
<body>

<!-- Header Component -->
<header class="site-header" id="site-header">
    <!-- Top Utility Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <span class="top-badge-pec"><i class="fas fa-certificate"></i> PEC Licensed: Category C-A (No Limit)</span>
                <span class="top-bar-item"><i class="fas fa-map-marker-alt"></i> Islamabad, Pakistan</span>
                <span class="top-bar-item"><i class="fas fa-clock"></i> Mon - Sat: 9:00 AM - 6:00 PM</span>
            </div>
            <div class="top-bar-right">
                <span class="top-bar-item"><i class="fas fa-phone-alt"></i> <a href="tel:+923008815488">+92 300 8815488</a></span>
                <span class="top-bar-item"><i class="fas fa-envelope"></i> <a href="mailto:info@fescon.com.pk">info@fescon.com.pk</a></span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="main-nav-wrapper">
        <div class="container">
            <div class="nav-container">
                <!-- Brand Identity (Exact Logo) -->
                <a href="<?php echo $base_url; ?>/" class="brand-logo-link" aria-label="Fescon Homepage">
                    <img src="<?php echo $base_url; ?>/assets/images/logo.png" alt="Fescon (Pvt.) Ltd" class="brand-logo-img">
                </a>

                <!-- Desktop / Mobile Nav Menu -->
                <nav class="main-nav" aria-label="Main Navigation">
                    <ul class="nav-menu">
                        <li class="nav-item <?php echo is_nav_active('index', $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/" class="nav-link">Home</a>
                        </li>

                        <li class="nav-item has-dropdown <?php echo is_nav_active(['about-us', 'our-story', 'our-values', 'management-team', 'the-founder', 'certifications', 'collaborations', 'blogs', 'gallery', 'awards'], $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/about-us/" class="nav-link">
                                About <i class="fas fa-chevron-down arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $base_url; ?>/our-story/" class="dropdown-link"><i class="fas fa-history"></i> Our Story</a></li>
                                <li><a href="<?php echo $base_url; ?>/our-values/" class="dropdown-link"><i class="fas fa-bullseye"></i> Our Values</a></li>
                                <li><a href="<?php echo $base_url; ?>/management-team/" class="dropdown-link"><i class="fas fa-users-cog"></i> Management Team</a></li>
                                <li><a href="<?php echo $base_url; ?>/the-founder/" class="dropdown-link"><i class="fas fa-user-tie"></i> The Founder</a></li>
                                <li><a href="<?php echo $base_url; ?>/certifications/" class="dropdown-link"><i class="fas fa-award"></i> Certifications</a></li>
                                <li><a href="<?php echo $base_url; ?>/collaborations/" class="dropdown-link"><i class="fas fa-handshake"></i> Collaborations</a></li>
                                <li><a href="<?php echo $base_url; ?>/gallery/" class="dropdown-link"><i class="fas fa-images"></i> Gallery &amp; Events</a></li>
                                <li><a href="<?php echo $base_url; ?>/awards/" class="dropdown-link"><i class="fas fa-trophy"></i> Awards &amp; Certificates</a></li>
                                <li><a href="<?php echo $base_url; ?>/blogs/" class="dropdown-link"><i class="fas fa-newspaper"></i> Engineering Insights</a></li>
                            </ul>
                        </li>

                        <li class="nav-item has-dropdown <?php echo is_nav_active(['services', 'service-detail', 'planning-and-designing', 'epc-projects', 'energy-transmission-distribution', 'operation-maintenance', 'mep-solutions', 'civil-works'], $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/services/" class="nav-link">
                                Services <i class="fas fa-chevron-down arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=planning-and-designing" class="dropdown-link"><i class="fas fa-drafting-compass"></i> Planning &amp; Designing</a></li>
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=epc-projects" class="dropdown-link"><i class="fas fa-hard-hat"></i> EPC Projects</a></li>
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=energy-transmission-distribution" class="dropdown-link"><i class="fas fa-bolt"></i> Energy Transmission &amp; Distribution</a></li>
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=operation-maintenance" class="dropdown-link"><i class="fas fa-tools"></i> Operation &amp; Maintenance</a></li>
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=mep-solutions" class="dropdown-link"><i class="fas fa-cogs"></i> MEP Solutions</a></li>
                                <li><a href="<?php echo $base_url; ?>/service-detail.php?service=civil-works" class="dropdown-link"><i class="fas fa-building"></i> Civil Works</a></li>
                            </ul>
                        </li>

                        <li class="nav-item <?php echo is_nav_active(['projects', 'project-detail', 'client-projects'], $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/projects/" class="nav-link">Projects</a>
                        </li>

                        <li class="nav-item has-dropdown <?php echo is_nav_active(['hse-policy', 'welfare-policy', 'csr-policy'], $current_page); ?>">
                            <a class="nav-link" style="cursor:pointer;">
                                Policies <i class="fas fa-chevron-down arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $base_url; ?>/hse-policy/" class="dropdown-link"><i class="fas fa-shield-alt"></i> HSE Policy</a></li>
                                <li><a href="<?php echo $base_url; ?>/welfare-policy/" class="dropdown-link"><i class="fas fa-heart"></i> Welfare Policy</a></li>
                                <li><a href="<?php echo $base_url; ?>/csr-policy/" class="dropdown-link"><i class="fas fa-leaf"></i> CSR Policy</a></li>
                            </ul>
                        </li>

                        <li class="nav-item <?php echo is_nav_active('team', $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/team/" class="nav-link">Team</a>
                        </li>

                        <li class="nav-item <?php echo is_nav_active('careers', $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/careers/" class="nav-link">Careers</a>
                        </li>

                        <li class="nav-item <?php echo is_nav_active('contact-us', $current_page); ?>">
                            <a href="<?php echo $base_url; ?>/contact-us/" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </nav>

                <!-- Action Button & Mobile Toggle -->
                <div class="nav-actions">
                    <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane"></i> Request Quote
                    </a>
                    <button class="mobile-toggle-btn" aria-label="Toggle navigation menu" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
