<?php
// Simple router for PHP built-in server to support WordPress pretty permalinks.
// Serves static files directly; otherwise falls back to index.php.
if (php_sapi_name() !== 'cli-server') {
    return false;
}
$url = parse_url($_SERVER['REQUEST_URI']);
$file = __DIR__ . ($url['path'] ?? '');
if ($url && isset($url['path']) && is_file($file)) {
    // Let the built-in server serve the static resource.
    return false;
}
require_once __DIR__ . '/index.php';