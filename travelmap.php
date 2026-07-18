<?php
/**
 * AQW travel-map data — Flash runs JSON.decode() on the response body
 * (see Game/onTravelMapComplete). XML stubs cause: Unexpected < encountered.
 */
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$path = __DIR__ . '/travelmap.json';
if (is_readable($path)) {
    readfile($path);
    exit;
}

// Minimal valid fallback if the snapshot is missing.
echo '{}';
