const fs = require('fs');
const path = require('path');

const headerPath = path.join(__dirname, '..', 'includes', 'header.php');
let content = fs.readFileSync(headerPath, 'utf8');

// Ensure helper function is defined at the top of header.php
const helperCode = `<?php
require_once __DIR__ . '/config.php';
$page_title = $page_title ?? 'Fescon (Pvt.) Ltd';
$active_cur_page = $current_page ?? '';
if (!function_exists('hfe_active_class')) {
    function hfe_active_class($pages, $current) {
        if (is_string($pages)) $pages = [$pages];
        return in_array($current, $pages) ? 'current-menu-item page_item current_page_item' : '';
    }
}
?>
`;

// Replace top php tag in header.php
const topPhpEnd = content.indexOf('?>') + 2;
content = helperCode + content.substring(topPhpEnd);

// Replace hardcoded active class on Services
content = content.replace(
  'id="menu-item-237" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-162 current_page_item menu-item-has-children parent hfe-has-submenu hfe-creative-menu"',
  'id="menu-item-237" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'services\', \'service-detail\', \'planning-and-designing\', \'epc-projects\', \'energy-transmission-distribution\', \'operation-maintenance\', \'mep-solutions\', \'civil-works\'], $active_cur_page); ?> menu-item-has-children parent hfe-has-submenu hfe-creative-menu"'
);

// Add dynamic active class to Home
content = content.replace(
  'id="menu-item-231" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home parent hfe-creative-menu"',
  'id="menu-item-231" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home <?php echo hfe_active_class([\'index\', \'home\'], $active_cur_page); ?> parent hfe-creative-menu"'
);

// Add dynamic active class to About
content = content.replace(
  'id="menu-item-232" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children parent hfe-has-submenu hfe-creative-menu"',
  'id="menu-item-232" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'about-us\', \'our-story\', \'our-values\', \'the-founder\', \'certifications\', \'collaborations\', \'blogs\'], $active_cur_page); ?> menu-item-has-children parent hfe-has-submenu hfe-creative-menu"'
);

// Add dynamic active class to Projects
content = content.replace(
  'id="menu-item-236" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"',
  'id="menu-item-236" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'projects\', \'project-detail\', \'client-projects\'], $active_cur_page); ?> parent hfe-creative-menu"'
);

// Add dynamic active class to Policies
content = content.replace(
  'id="menu-item-454" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children parent hfe-has-submenu hfe-creative-menu"',
  'id="menu-item-454" class="menu-item menu-item-type-custom menu-item-object-custom <?php echo hfe_active_class([\'policies\', \'hse-policy\', \'welfare-policy\', \'csr-policy\'], $active_cur_page); ?> menu-item-has-children parent hfe-has-submenu hfe-creative-menu"'
);

// Add dynamic active class to Team
content = content.replace(
  'id="menu-item-1213" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"',
  'id="menu-item-1213" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'team\', \'team-detail\', \'management-team\'], $active_cur_page); ?> parent hfe-creative-menu"'
);

// Add dynamic active class to Contact Us
content = content.replace(
  'id="menu-item-235" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"',
  'id="menu-item-235" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'contact-us\'], $active_cur_page); ?> parent hfe-creative-menu"'
);

// Add dynamic active class to Careers
content = content.replace(
  'id="menu-item-1030" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"',
  'id="menu-item-1030" class="menu-item menu-item-type-post_type menu-item-object-page <?php echo hfe_active_class([\'careers\'], $active_cur_page); ?> parent hfe-creative-menu"'
);

fs.writeFileSync(headerPath, content);
console.log('includes/header.php navigation menu active classes made 100% dynamic!');
