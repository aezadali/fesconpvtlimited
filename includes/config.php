<?php
/**
 * Configuration & Global Setup for Fescon (Pvt.) Ltd Website
 */

// Error reporting: Log errors securely without displaying sensitive internals to visitors
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');

// Base URL Auto-Detection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
$currentDir = str_replace('\\', '/', __DIR__ . '/..');

// Calculate relative path from DOCUMENT_ROOT to site directory
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$scriptDir = dirname($scriptName);
if ($scriptDir === '/' || $scriptDir === '\\') {
    $base_url = '';
} else {
    // If inside a subfolder, e.g., /FesconPvtLimited or /FesconPvtLimited/about-us
    // Check if the current script is in a subdirectory page or admin folder
    $parts = explode('/', trim($scriptDir, '/'));
    $knownPages = [
        'about-us', 'our-story', 'our-values', 'management-team', 'the-founder',
        'certifications', 'collaborations', 'blogs', 'gallery', 'awards', 'services', 'planning-and-designing',
        'epc-projects', 'energy-transmission-distribution', 'operation-maintenance',
        'mep-solutions', 'civil-works', 'projects', 'hse-policy', 'welfare-policy',
        'csr-policy', 'team', 'contact-us', 'careers', 'client-projects',
        'project-detail', 'service-detail', 'admin', 'api'
    ];
    if (!empty($parts) && in_array(end($parts), $knownPages)) {
        array_pop($parts);
    }
    $base_url = !empty($parts) ? '/' . implode('/', $parts) : '';
}

// Site Settings
$site_name = "Fescon (Pvt.) Ltd";
$admin_email = "info@fescon.com.pk";
$contact_phone = "+92 304 1112766";
$contact_address = "#1238, C Block, LDA Avenue 1, Lahore, Pakistan";

// Helper for asset URLs
if (!function_exists('asset_url')) {
    function asset_url($path) {
        global $base_url;
        if (empty($path)) return '';
        if (preg_match('#^https?://#i', $path)) return $path;
        return ($base_url ? $base_url : '') . '/' . ltrim($path, '/');
    }
}
?>
