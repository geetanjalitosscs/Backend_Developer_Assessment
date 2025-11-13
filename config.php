<?php
// ===============================
// File: config.php
// Environment Configuration for Ubuntu VPS
// ===============================

// Server Configuration
define('SERVER_HOST', '0.0.0.0'); // Listen on all interfaces
define('SERVER_PORT', '8087');     // Port for the API

// Database Configuration
// For local development (XAMPP)
if (file_exists(__DIR__ . '/.env.local')) {
    // Local development settings
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'all_assessment_quiz';
} else {
    // Production VPS settings - Update these with your actual database credentials
    $db_host = 'localhost';  // Change if database is on different server
    $db_user = 'root';        // Change to your database username
    $db_pass = '';            // Change to your database password
    $db_name = 'all_assessment_quiz';
}

// You can also use environment variables (recommended for production)
if (getenv('DB_HOST')) {
    $db_host = getenv('DB_HOST');
}
if (getenv('DB_USER')) {
    $db_user = getenv('DB_USER');
}
if (getenv('DB_PASS')) {
    $db_pass = getenv('DB_PASS');
}
if (getenv('DB_NAME')) {
    $db_name = getenv('DB_NAME');
}

// Export database config
$GLOBALS['db_config'] = [
    'host' => $db_host,
    'user' => $db_user,
    'pass' => $db_pass,
    'name' => $db_name
];
?>


