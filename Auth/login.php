<?php
require_once './auth_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (loginUser($username, $password)) {
        // Redirect based on role
        if (isAdmin()) {
            header("Location: ../Admin/judges.php");
        } else {
            header("Location: ../Judge/dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; padding: 20px; }
        .error { color: red; margin-bottom: 15px; }
        input { width: 100%; padding: 8px; margin: 8px 0; }
        button { background: #4CAF50; color: white; padding: 10px; border: none; width: 100%; }
    </style>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>