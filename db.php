<?php
// ===============================
// File: db.php
// ===============================

if (!isset($GLOBALS['db_config'])) {
    require_once __DIR__ . '/config.php';
}

$host = $GLOBALS['db_config']['host'] ?? 'localhost';
$user = $GLOBALS['db_config']['user'] ?? 'root';
$pass = $GLOBALS['db_config']['pass'] ?? '';
$db   = $GLOBALS['db_config']['name'] ?? '';

$conn = @new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    error_log("Database connection failed ({$conn->connect_errno}): {$conn->connect_error}");
    http_response_code(500);
    exit('Database connection error. Please contact the administrator.');
}

$conn->set_charset('utf8mb4');
?> 
