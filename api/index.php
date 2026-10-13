<?php
/**
 * Vercel Serverless Function Single Entrypoint & Front-Controller
 * Consolidates all dynamic PHP routes into ONE Serverless Function
 * Resolving Vercel Hobby plan 12-function limit and fixing Content-Type headers.
 */

// Set working directory to project root
chdir(__DIR__ . '/..');

// Default Content-Type header to ensure browser renders HTML instead of downloading file
header('Content-Type: text/html; charset=UTF-8');

// Parse request path
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$parsedPath = parse_url($requestUri, PHP_URL_PATH);
$path = trim($parsedPath, '/');

// Base directory (project root)
$rootDir = realpath(__DIR__ . '/..');

// 1. Homepage
if ($path === '' || $path === 'index' || $path === 'index.php') {
    require $rootDir . '/index.php';
    exit;
}

// 2. Direct PHP file (e.g. "about-us.php", "contact-handler.php", "service-detail.php")
$targetFile = $rootDir . '/' . $path;
if (is_file($targetFile) && strtolower(substr($path, -4)) === '.php') {
    require $targetFile;
    exit;
}

// 3. Page without .php extension (e.g. "about-us", "services", "projects", "gallery", "awards")
if (is_file($targetFile . '.php')) {
    require $targetFile . '.php';
    exit;
}

// 4. Directory index (e.g. "gallery/", "awards/", "about-us/", "admin/")
if (is_file($targetFile . '/index.php')) {
    require $targetFile . '/index.php';
    exit;
}

// 5. Admin subpages without extension (e.g. "admin/gallery", "admin/projects")
if (strpos($path, 'admin/') === 0 && is_file($rootDir . '/' . $path . '.php')) {
    require $rootDir . '/' . $path . '.php';
    exit;
}

// 6. Static asset fallback (if static file wasn't caught by Vercel CDN routes)
if (is_file($targetFile)) {
    $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $mimes = [
        'css'   => 'text/css; charset=UTF-8',
        'js'    => 'application/javascript; charset=UTF-8',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'webp'  => 'image/webp',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'pdf'   => 'application/pdf',
    ];
    $contentType = $mimes[$ext] ?? 'application/octet-stream';
    header('Content-Type: ' . $contentType);
    header('Content-Length: ' . filesize($targetFile));
    header('Cache-Control: public, max-age=31536000, immutable');
    readfile($targetFile);
    exit;
}

// 7. Route not found: serve homepage with 404
http_response_code(404);
require $rootDir . '/index.php';
exit;
