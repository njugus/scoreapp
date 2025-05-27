<?php
require_once '../../Config/db.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $display_name = trim($_POST['display_name']);
    
    // Validate
    if (empty($username) || empty($display_name)) {
        die("All fields are required");
    }

    // Save to database
    $stmt = $pdo->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
    if ($stmt->execute([$username, $display_name])) {
        header("Location: ../judges.php?success=1");
    } else {
        header("Location: ../judges.php?error=1");
    }
    exit;
}
