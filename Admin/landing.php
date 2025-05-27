<?php
require_once '../Auth/includes/auth_check.php';
if (!isAdmin()) die("Admin access required");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        .dashboard-card {
            padding: 20px; margin: 20px; 
            background: #f8f9fa; border-radius: 8px;
            text-align: center; width: 200px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <div class="dashboard-card">
        <h3>Manage Judges</h3>
        <a href="judges.php">Go to Judges</a>
    </div>
    
    <div class="dashboard-card">
        <h3>Manage Participants</h3>
        <a href="participants.php">Go to Participants</a>
    </div>
    
    <p><a href="../auth/logout.php">Logout</a></p>
</body>
</html>