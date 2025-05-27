<?php
// Local XAMPP defaults
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'scoreapp');

// Create PDO connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] //throw an exception incase of an error
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}