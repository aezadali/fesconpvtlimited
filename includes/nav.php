<?php
/**
 * Navigation Component for Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/config.php';

$active_page = $current_page ?? '';

function is_active($page, $active_page) {
    if (is_array($page)) {
        return in_array($active_page, $page) ? 'current-menu-item current_page_item' : '';
    }
    return ($active_page === $page) ? 'current-menu-item current_page_item' : '';
}
?>
<div class="hfe-nav-menu hfe-layout-horizontal hfe-nav-menu-layout horizontal hfe-pointer__underline hfe-animation__slide" data-layout="horizontal">
    <div role="button" class="hfe-nav-menu__toggle elementor-clickable" tabindex="0" aria-label="Menu Toggle">
        <span class="screen-reader-text">Menu</span>
        <div class="hfe-nav-menu-icon">
            <svg aria-hidden="true" class="e-font-icon-svg e-fas-align-justify" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" style="width:23px;height:23px;fill:currentColor;"><path d="M432 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
        </div>
    </div>
    <nav class="hfe-nav-menu__layout-horizontal hfe-nav-menu__submenu-arrow" data-full-width="yes">
        <ul id="menu-main-nav" class="hfe-nav-menu">
            <li class="menu-item parent hfe-creative-menu <?php echo is_active('index', $active_page); ?>">
                <a href="<?php echo $base_url; ?>/" class="hfe-menu-item">Home</a>
            </li>
            <li class="menu-item menu-item-has-children parent hfe-has-submenu hfe-creative-menu <?php echo is_active(['about-us', 'our-story', 'our-values', 'management-team', 'the-founder', 'certifications', 'collaborations', 'blogs'], $active_page); ?>">
                <div class="hfe-has-submenu-container" tabindex="0" role="button" aria-haspopup="true" aria-expanded="false">
                    <a href="<?php echo $base_url; ?>/about-us/" class="hfe-menu-item">About<span class='hfe-menu-toggle sub-arrow'><i class='fa'></i></span></a>
                </div>
                <ul class="sub-menu">
                    <li class="menu-item hfe-creative-menu <?php echo is_active('our-story', $active_page); ?>"><a href="<?php echo $base_url; ?>/our-story/" class="hfe-sub-menu-item">Our Story</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('our-values', $active_page); ?>"><a href="<?php echo $base_url; ?>/our-values/" class="hfe-sub-menu-item">Our Values</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('management-team', $active_page); ?>"><a href="<?php echo $base_url; ?>/management-team/" class="hfe-sub-menu-item">Management Team</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('the-founder', $active_page); ?>"><a href="<?php echo $base_url; ?>/the-founder/" class="hfe-sub-menu-item">The Founder</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('certifications', $active_page); ?>"><a href="<?php echo $base_url; ?>/certifications/" class="hfe-sub-menu-item">Certifications</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('collaborations', $active_page); ?>"><a href="<?php echo $base_url; ?>/collaborations/" class="hfe-sub-menu-item">Collaborations</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('blogs', $active_page); ?>"><a href="<?php echo $base_url; ?>/blogs/" class="hfe-sub-menu-item">Blogs</a></li>
                </ul>
            </li>
            <li class="menu-item menu-item-has-children parent hfe-has-submenu hfe-creative-menu <?php echo is_active(['services', 'planning-and-designing', 'epc-projects', 'energy-transmission-distribution', 'operation-maintenance', 'mep-solutions', 'civil-works'], $active_page); ?>">
                <div class="hfe-has-submenu-container" tabindex="0" role="button" aria-haspopup="true" aria-expanded="false">
                    <a href="<?php echo $base_url; ?>/services/" class="hfe-menu-item">Services<span class='hfe-menu-toggle sub-arrow'><i class='fa'></i></span></a>
                </div>
                <ul class="sub-menu">
                    <li class="menu-item hfe-creative-menu <?php echo is_active('planning-and-designing', $active_page); ?>"><a href="<?php echo $base_url; ?>/planning-and-designing/" class="hfe-sub-menu-item">Planning and Designing</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('epc-projects', $active_page); ?>"><a href="<?php echo $base_url; ?>/epc-projects/" class="hfe-sub-menu-item">EPC Projects</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('energy-transmission-distribution', $active_page); ?>"><a href="<?php echo $base_url; ?>/energy-transmission-distribution/" class="hfe-sub-menu-item">Energy Transmission &amp; Distribution</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('operation-maintenance', $active_page); ?>"><a href="<?php echo $base_url; ?>/operation-maintenance/" class="hfe-sub-menu-item">Operation &amp; Maintenance</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('mep-solutions', $active_page); ?>"><a href="<?php echo $base_url; ?>/mep-solutions/" class="hfe-sub-menu-item">MEP Solutions</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('civil-works', $active_page); ?>"><a href="<?php echo $base_url; ?>/civil-works/" class="hfe-sub-menu-item">Civil Works</a></li>
                </ul>
            </li>
            <li class="menu-item parent hfe-creative-menu <?php echo is_active('projects', $active_page); ?>">
                <a href="<?php echo $base_url; ?>/projects/" class="hfe-menu-item">Projects</a>
            </li>
            <li class="menu-item menu-item-has-children parent hfe-has-submenu hfe-creative-menu <?php echo is_active(['hse-policy', 'welfare-policy', 'csr-policy'], $active_page); ?>">
                <div class="hfe-has-submenu-container" tabindex="0" role="button" aria-haspopup="true" aria-expanded="false">
                    <a class="hfe-menu-item" style="cursor:pointer;">Policies<span class='hfe-menu-toggle sub-arrow'><i class='fa'></i></span></a>
                </div>
                <ul class="sub-menu">
                    <li class="menu-item hfe-creative-menu <?php echo is_active('hse-policy', $active_page); ?>"><a href="<?php echo $base_url; ?>/hse-policy/" class="hfe-sub-menu-item">HSE Policy</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('welfare-policy', $active_page); ?>"><a href="<?php echo $base_url; ?>/welfare-policy/" class="hfe-sub-menu-item">Welfare Policy</a></li>
                    <li class="menu-item hfe-creative-menu <?php echo is_active('csr-policy', $active_page); ?>"><a href="<?php echo $base_url; ?>/csr-policy/" class="hfe-sub-menu-item">CSR Policy</a></li>
                </ul>
            </li>
            <li class="menu-item parent hfe-creative-menu <?php echo is_active('team', $active_page); ?>">
                <a href="<?php echo $base_url; ?>/team/" class="hfe-menu-item">Team</a>
            </li>
            <li class="menu-item parent hfe-creative-menu <?php echo is_active('contact-us', $active_page); ?>">
                <a href="<?php echo $base_url; ?>/contact-us/" class="hfe-menu-item">Contact Us</a>
            </li>
            <li class="menu-item parent hfe-creative-menu <?php echo is_active('careers', $active_page); ?>">
                <a href="<?php echo $base_url; ?>/careers/" class="hfe-menu-item">Careers</a>
            </li>
        </ul>
    </nav>
</div>
