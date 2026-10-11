<?php
/**
 * Download all external images from fescon.com.pk to assets/images
 * and update code + database references.
 */
$rootDir = dirname(__DIR__);
$targetImgDir = $rootDir . '/assets/images';

if (!is_dir($targetImgDir)) {
    mkdir($targetImgDir, 0755, true);
}

echo "Target directory: $targetImgDir\n";

function get_url_content($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($httpCode === 200 && !empty($data)) ? $data : false;
}

// Collect all remote image URLs
$foundUrls = [];

$files1 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootDir));
foreach ($files1 as $file) {
    if ($file->isDir()) continue;
    $path = $file->getPathname();
    if (strpos($path, '.git') !== false || strpos($path, 'vendor') !== false || strpos($path, 'tools') !== false) continue;
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($ext, ['php', 'css', 'js', 'html', 'json'])) {
        $content = file_get_contents($path);
        preg_match_all('/https?:\/\/fescon\.com\.pk\/wp-content\/uploads\/[^\s"\'\)><]+/i', $content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $u) {
                $u = rtrim($u, '.,;');
                $foundUrls[$u] = true;
            }
        }
    }
}

$dbPath = $rootDir . '/storage/database.sqlite';
if (file_exists($dbPath)) {
    $db = new PDO('sqlite:' . $dbPath);
    $tables = ['team_members', 'projects', 'services', 'blogs', 'client_projects'];
    foreach ($tables as $t) {
        try {
            $stmt = $db->query("SELECT * FROM $t");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $r) {
                foreach ($r as $col => $val) {
                    if (is_string($val)) {
                        preg_match_all('/https?:\/\/fescon\.com\.pk\/wp-content\/uploads\/[^\s"\'\)><]+/i', $val, $matches);
                        if (!empty($matches[0])) {
                            foreach ($matches[0] as $u) {
                                $u = rtrim($u, '.,;');
                                $foundUrls[$u] = true;
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {}
    }
}

echo "Found " . count($foundUrls) . " unique external image URLs.\n";

$urlMap = [];

foreach (array_keys($foundUrls) as $url) {
    $basename = basename(parse_url($url, PHP_URL_PATH));
    if (empty($basename)) continue;

    $localPath = $targetImgDir . '/' . $basename;

    if (file_exists($localPath) && filesize($localPath) > 0) {
        echo "[EXISTS] $basename\n";
        $urlMap[$url] = $basename;
    } else {
        echo "[DOWNLOADING] $basename ... ";
        $data = get_url_content($url);
        if ($data !== false) {
            file_put_contents($localPath, $data);
            echo "OK (" . strlen($data) . " bytes)\n";
            $urlMap[$url] = $basename;
        } else {
            echo "FAILED -> using placeholder.svg\n";
            $urlMap[$url] = 'placeholder.svg';
        }
    }
}

// Update Database
if (file_exists($dbPath)) {
    $db = new PDO('sqlite:' . $dbPath);
    foreach ($tables as $t) {
        try {
            $stmt = $db->query("SELECT * FROM $t");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $r) {
                $id = $r['id'];
                $updates = [];
                $params = [];
                foreach ($r as $col => $val) {
                    if ($col === 'id' || !is_string($val)) continue;
                    $newVal = $val;
                    foreach ($urlMap as $remoteUrl => $basename) {
                        if (strpos($newVal, $remoteUrl) !== false) {
                            $newVal = str_replace($remoteUrl, 'http://localhost/FesconPvtLimited/assets/images/' . $basename, $newVal);
                        }
                    }
                    if ($newVal !== $val) {
                        $updates[] = "$col = ?";
                        $params[] = $newVal;
                    }
                }
                if (!empty($updates)) {
                    $params[] = $id;
                    $sql = "UPDATE $t SET " . implode(', ', $updates) . " WHERE id = ?";
                    $uStmt = $db->prepare($sql);
                    $uStmt->execute($params);
                    echo "Updated DB table $t ID $id\n";
                }
            }
        } catch (Exception $e) {}
    }
}

// Update files
$files2 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootDir));
$count = 0;
foreach ($files2 as $file) {
    if ($file->isDir()) continue;
    $path = $file->getPathname();
    if (strpos($path, '.git') !== false || strpos($path, 'vendor') !== false || strpos($path, 'tools') !== false || strpos($path, 'database.sqlite') !== false) continue;
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($ext, ['php', 'css', 'js', 'html', 'json'])) {
        $content = file_get_contents($path);
        $orig = $content;
        foreach ($urlMap as $remoteUrl => $basename) {
            if (strpos($content, $remoteUrl) !== false) {
                $content = str_replace($remoteUrl, '<?php echo $base_url; ?>/assets/images/' . $basename, $content);
            }
        }
        $content = str_replace('<?php echo $base_url; ?>/<?php echo $base_url; ?>/', '<?php echo $base_url; ?>/', $content);
        if ($content !== $orig) {
            file_put_contents($path, $content);
            $count++;
            echo "Updated file: " . basename($path) . "\n";
        }
    }
}

echo "Script completed successfully. $count files updated.\n";
