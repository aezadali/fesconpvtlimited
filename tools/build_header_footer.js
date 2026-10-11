const fs = require('fs');
const path = require('path');

const servicesFile = path.join(__dirname, '..', 'services.php');
const html = fs.readFileSync(servicesFile, 'utf8');

// 1. Extract Head and Header Section
const headStart = html.indexOf('<!DOCTYPE html>');
const titleStart = html.indexOf('<title>');
const titleEnd = html.indexOf('</title>') + 8;

const sHeaderStart = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-a059c72');
const sHeaderEnd = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-4d1d875');

const beforeTitle = html.substring(headStart, titleStart);
const afterTitle = html.substring(titleEnd, sHeaderStart);
const headerSection = html.substring(sHeaderStart, sHeaderEnd);

const fullHeaderContent = `<?php
require_once __DIR__ . '/config.php';
$page_title = $page_title ?? 'Fescon (Pvt.) Ltd';
?>
` + beforeTitle + `<title><?php echo htmlspecialchars($page_title); ?></title>` + afterTitle + headerSection;

// 2. Extract Footer Section and Body End
const sFooterStart = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-90e2bd6');
const footerContent = `<?php
require_once __DIR__ . '/config.php';
?>
` + html.substring(sFooterStart);

// Write to includes/header.php and includes/footer.php
const headerPath = path.join(__dirname, '..', 'includes', 'header.php');
const footerPath = path.join(__dirname, '..', 'includes', 'footer.php');

fs.writeFileSync(headerPath, fullHeaderContent);
fs.writeFileSync(footerPath, footerContent);

console.log('Successfully written full header.php (size:', fullHeaderContent.length, ') and footer.php (size:', footerContent.length, ')');
