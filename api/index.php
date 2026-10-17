<?php
/**
 * Vercel Serverless Function Single Entrypoint & Front-Controller
 * Consolidates all dynamic PHP routes into ONE Serverless Function
 * Resolving Vercel Hobby plan 12-function limit and fixing Content-Type headers.
 */

// Buffer output so headers and redirects operate smoothly without premature output
ob_start();

// Base directory (project root) - dirname avoids realpath failure on serverless
$rootDir = dirname(__DIR__);
chdir($rootDir);

// Ensure session files use writable /tmp in serverless environment
if (session_status() === PHP_SESSION_NONE) {
    @ini_set('session.save_path', sys_get_temp_dir());
}

// Default Content-Type header to ensure browser renders HTML instead of downloading file
if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}

try {
    // Diagnostics endpoint for debugging Vercel deployment environment
    if (isset($_GET['diag'])) {
        header('Content-Type: text/plain; charset=UTF-8');
        echo "PHP VERSION: " . PHP_VERSION . "\n";
        echo "ROOT DIR: " . $rootDir . "\n";
        echo "DIR EXISTS: " . (is_dir($rootDir) ? 'YES' : 'NO') . "\n";
        echo "INDEX EXISTS: " . (file_exists($rootDir . '/index.php') ? 'YES' : 'NO') . "\n";
        echo "INCLUDES EXISTS: " . (is_dir($rootDir . '/includes') ? 'YES' : 'NO') . "\n";
        echo "STORAGE EXISTS: " . (is_dir($rootDir . '/storage') ? 'YES' : 'NO') . "\n";
        echo "FILES IN ROOT: " . json_encode(@scandir($rootDir)) . "\n";
        exit;
    }

    // Parse request path
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $parsedPath = parse_url($requestUri, PHP_URL_PATH);
    $path = trim($parsedPath, '/');

    // 1. Homepage
    if ($path === '' || $path === 'index' || $path === 'index.php') {
        if (is_file($rootDir . '/index.php')) {
            require $rootDir . '/index.php';
        } else {
            throw new Exception("Application entry file 'index.php' was not found in: " . $rootDir);
        }
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
        if (!headers_sent()) {
            header('Content-Type: ' . $contentType);
            header('Content-Length: ' . filesize($targetFile));
            header('Cache-Control: public, max-age=31536000, immutable');
        }
        readfile($targetFile);
        exit;
    }

    // 7. Route not found: serve homepage with 404
    http_response_code(404);
    require $rootDir . '/index.php';
    exit;

} catch (Throwable $e) {
    error_log('Vercel Request Error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/html; charset=UTF-8');
    }
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>System Notice - Fescon (Pvt.) Ltd</title>';
    echo '<style>body{font-family:system-ui,-apple-system,Segoe UI,Roboto,sans-serif;background:#0b1329;color:#e2e8f0;padding:60px 20px;text-align:center;}';
    echo '.card{max-width:560px;margin:0 auto;background:#141f3d;padding:36px;border-radius:12px;border:1px solid #1e293b;box-shadow:0 10px 30px rgba(0,0,0,0.4);}';
    echo 'h1{font-size:22px;color:#f8fafc;margin:0 0 12px;}p{font-size:14px;color:#94a3b8;line-height:1.6;margin:0 0 24px;}';
    echo 'a{display:inline-block;background:#0d9488;color:#fff;text-decoration:none;font-weight:600;padding:10px 20px;border-radius:6px;font-size:14px;}</style></head>';
    echo '<body><div class="card"><h1>Fescon (Pvt.) Ltd</h1><p>The requested page is temporarily initializing. Please refresh or return to the homepage.</p>';
    echo '<a href="/">Return to Homepage</a>';
    if (!empty($_GET['debug'])) {
        echo '<pre style="text-align:left;background:#0b1329;padding:14px;border-radius:6px;margin-top:20px;overflow:auto;font-size:12px;color:#fca5a5;">' . htmlspecialchars($e->getMessage() . "\n" . $e->getTraceAsString()) . '</pre>';
    }
    echo '</div></body></html>';
    exit;
}
