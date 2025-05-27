<?php
require_once '../Config/db.php';
require_once './config/session.php';

function loginUser($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        
        // Regenerate session ID to prevent fixation
        session_regenerate_id(true);
        
        return true;
    }
    
    return false;
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isJudge() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'judge';
}

function requireAuth() {
    if (!isset($_SESSION['logged_in'])) {
        header("Location: ./login.php");
        exit;
    }
}