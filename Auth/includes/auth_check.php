<?php
require_once '../config/session.php';
require_once '../auth_functions.php';

// Redirect to login if not authenticated
requireAuth();

// Admin pages should include:
if (strpos($_SERVER['REQUEST_URI'], '/Admin/') !== false && !isAdmin()) {
    header("HTTP/1.1 403 Forbidden");
    die("Admin access required");
}

// Judge pages should include:
if (strpos($_SERVER['REQUEST_URI'], '/Judge/') !== false && !isJudge()) {
    header("HTTP/1.1 403 Forbidden");
    die("Judge access required");
}