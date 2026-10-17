<?php
/**
 * Static Site Compiler for Fescon (Pvt.) Ltd
 * Renders all PHP pages into production-ready static HTML files.
 */

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors', '0');

putenv('VERCEL=1');
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';
$_SERVER['HTTP_HOST'] = 'fescon.com.pk';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['HTTPS'] = 'on';

$rootDir = dirname(__DIR__);
chdir($rootDir);

require_once $rootDir . '/includes/config.php';
require_once $rootDir . '/includes/db.php';

// Helper to post-process links: change .php extensions to clean URLs
function clean_html($html) {
    // Replace internal links like href="/about-us.php" with href="/about-us"
    $html = preg_replace('/href="\/([a-zA-Z0-9_-]+)\.php"/i', 'href="/$1"', $html);
    $html = preg_replace('/href="([a-zA-Z0-9_-]+)\.php"/i', 'href="/$1"', $html);
    // Replace href="/service-detail.php?service=..." with href="/$1"
    $html = preg_replace('/href="\/service-detail\.php\?service=([a-zA-Z0-9_-]+)"/i', 'href="/$1"', $html);
    return $html;
}

function write_page($slug, $content, $rootDir) {
    $content = clean_html($content);
    if ($slug === 'index') {
        file_put_contents($rootDir . '/index.html', $content);
        echo "Generated: index.html (" . strlen($content) . " bytes)\n";
    } else {
        file_put_contents($rootDir . '/' . $slug . '.html', $content);
        $dir = $rootDir . '/' . $slug;
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        file_put_contents($dir . '/index.html', $content);
        echo "Generated: {$slug}.html and {$slug}/index.html (" . strlen($content) . " bytes)\n";
    }
}

function render_php_file($file, $getParams = []) {
    global $rootDir, $base_url, $site_name, $admin_email, $contact_phone, $contact_address;
    $_GET = $getParams;
    ob_start();
    try {
        include $rootDir . '/' . $file;
        return ob_get_clean();
    } catch (Throwable $e) {
        ob_end_clean();
        echo "Error rendering $file: " . $e->getMessage() . "\n";
        return null;
    }
}

echo "Starting static build...\n";

// 1. Primary Pages
$mainPages = [
    'index' => 'index.php',
    'about-us' => 'about-us.php',
    'our-story' => 'our-story.php',
    'our-values' => 'our-values.php',
    'the-founder' => 'the-founder.php',
    'management-team' => 'management-team.php',
    'team' => 'team.php',
    'services' => 'services.php',
    'projects' => 'projects.php',
    'client-projects' => 'client-projects.php',
    'gallery' => 'gallery.php',
    'awards' => 'awards.php',
    'certifications' => 'certifications.php',
    'collaborations' => 'collaborations.php',
    'blogs' => 'blogs.php',
    'contact-us' => 'contact-us.php',
    'careers' => 'careers.php',
    'hse-policy' => 'hse-policy.php',
    'welfare-policy' => 'welfare-policy.php',
    'csr-policy' => 'csr-policy.php',
    'service-detail' => 'service-detail.php',
    'project-detail' => 'project-detail.php',
];

foreach ($mainPages as $slug => $file) {
    $_SERVER['REQUEST_URI'] = ($slug === 'index') ? '/' : '/' . $slug;
    $content = render_php_file($file);
    if ($content !== null) {
        write_page($slug, $content, $rootDir);
    }
}

// 2. Specialized Service Pages (planning-and-designing, epc-projects, etc.)
$serviceSlugs = [
    'planning-and-designing',
    'epc-projects',
    'energy-transmission-distribution',
    'operation-maintenance',
    'mep-solutions',
    'civil-works',
];

foreach ($serviceSlugs as $sSlug) {
    $_SERVER['REQUEST_URI'] = '/' . $sSlug;
    $content = render_php_file('service-detail.php', ['service' => $sSlug]);
    if ($content !== null) {
        write_page($sSlug, $content, $rootDir);
    }
}

echo "Static compilation completed successfully.\n";
