<?php
require_once '../../config/database.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    
    // Validate
    if (empty($name)) {
        die("All fields are required");
    }

    // Save to database
    $stmt = $pdo->prepare("INSERT INTO participants (name) VALUES (?)");
    if ($stmt->execute([$name])) {
        header("Location: ../participants.php?success=1");
    } else {
        header("Location: ../participants.php?error=1");
    }
    exit;
}
