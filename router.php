<?php
// ===============================
// File: router.php
// PHP Built-in Server Router
// Handles all requests and routes to appropriate PHP files
// ===============================

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Remove leading slash
$requestPath = ltrim($requestPath, '/');

// If it's a file that exists, serve it
if (file_exists(__DIR__ . '/' . $requestPath) && is_file(__DIR__ . '/' . $requestPath)) {
    // Check if it's a PHP file
    if (pathinfo($requestPath, PATHINFO_EXTENSION) === 'php') {
        return false; // Let PHP handle it
    }
    // For static files (CSS, JS, images, etc.)
    return false;
}

// If it's a directory, look for index.php
if (is_dir(__DIR__ . '/' . $requestPath)) {
    $indexFile = __DIR__ . '/' . $requestPath . '/index.php';
    if (file_exists($indexFile)) {
        include $indexFile;
        return true;
    }
}

// Default: try to serve index.php for root
if ($requestPath === '' || $requestPath === '/') {
    if (file_exists(__DIR__ . '/index.php')) {
        include __DIR__ . '/index.php';
        return true;
    }
}

// If file doesn't exist, return 404
http_response_code(404);
echo "404 - File Not Found: " . htmlspecialchars($requestPath);
return true;


