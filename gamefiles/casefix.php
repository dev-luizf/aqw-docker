<?php
/**
 * Case-insensitive asset resolver for Linux hosts.
 *
 * Flash/Ruffle often requests mixed-case paths in all-lowercase
 * (e.g. maps/greenguard/awwest.swf → Greenguard/AWWest.swf).
 * Serves the real file in-place (no redirect) so loaders keep working.
 */
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

$uri = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH);
if (!is_string($uri) || $uri === '') {
    http_response_code(400);
    exit;
}

$prefix = '/gamefiles/';
if (stripos($uri, $prefix) !== 0) {
    http_response_code(404);
    exit;
}

$rel = substr($uri, strlen($prefix));
$rel = str_replace('\\', '/', $rel);
$rel = ltrim($rel, '/');
if ($rel === '' || strpos($rel, "\0") !== false || strcasecmp($rel, 'casefix.php') === 0) {
    http_response_code(404);
    exit;
}

$base = realpath(__DIR__);
if ($base === false) {
    http_response_code(500);
    exit;
}

$resolved = casefix_resolve($base, $rel);
if ($resolved === null) {
    // Missing beard/stache packs etc. — same fallback as hair/*/ .htaccess.
    if (preg_match('#^hair/([^/]+)/[^/]+\.swf$#i', $rel, $m)) {
        $resolved = casefix_resolve($base, 'hair/' . $m[1] . '/Default.swf');
    }
}
if ($resolved === null) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Not Found';
    exit;
}

$real = realpath($resolved);
if ($real === false || strpos($real, $base . DIRECTORY_SEPARATOR) !== 0 && $real !== $base) {
    http_response_code(404);
    exit;
}

if (!is_file($real) || !is_readable($real)) {
    http_response_code(404);
    exit;
}

$ext = strtolower(pathinfo($real, PATHINFO_EXTENSION));
$types = [
    'swf' => 'application/vnd.adobe.flash.movie',
    'xml' => 'application/xml',
    'json' => 'application/json',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'mp3' => 'audio/mpeg',
];
header('Content-Type: ' . (isset($types[$ext]) ? $types[$ext] : 'application/octet-stream'));
header('Content-Length: ' . filesize($real));
readfile($real);
exit;

/**
 * Walk $rel under $base, matching each path segment case-insensitively.
 */
function casefix_resolve($base, $rel)
{
    $parts = explode('/', $rel);
    $current = $base;
    foreach ($parts as $part) {
        if ($part === '' || $part === '.') {
            continue;
        }
        if ($part === '..') {
            return null;
        }
        $direct = $current . DIRECTORY_SEPARATOR . $part;
        if (file_exists($direct)) {
            $current = $direct;
            continue;
        }
        if (!is_dir($current)) {
            return null;
        }
        $entries = @scandir($current);
        if ($entries === false) {
            return null;
        }
        $found = null;
        $needle = strtolower($part);
        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            if (strtolower($entry) === $needle) {
                $found = $entry;
                break;
            }
        }
        if ($found === null) {
            return null;
        }
        $current = $current . DIRECTORY_SEPARATOR . $found;
    }
    return $current;
}
