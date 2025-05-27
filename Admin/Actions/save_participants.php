<?php
require_once '../../Config/db.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    // Validate
    if (empty($name) || empty($category)) {
        die("All fields are required");
    }

    // Save to database
    $stmt = $pdo->prepare("INSERT INTO participants (name, category) VALUES (?, ?)");
    if ($stmt->execute([$name, $category])) {
        header("Location: ../participants.php?success=1");
    } else {
        header("Location: ../participants.php?error=1");
    }
    exit;
}
