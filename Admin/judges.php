<?php 
require_once '../Config/db.php';
require_once '../includes/admin_functions.php';
require_once '../Auth/includes/auth_check.php';

$judges = getAllJudges();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Judges</title>
    <link rel="stylesheet" href="./includes/judges.css">
</head>
<body>
    <h2>Manage Judges</h2>
    
    <div class="card">
        <form action="../Admin/Actions/save_judges.php" method="post" class="form-grid">
            <div>
                <label for="username" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Username</label>
                <input type="text" id="username" name="username" placeholder="judge123" required>
            </div>
            <div>
                <label for="display_name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Display Name</label>
                <input type="text" id="display_name" name="display_name" placeholder="John Smith" required>
            </div>
            <button type="submit">Add Judge</button>
        </form>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Display Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($judges as $judge): ?>
                <tr>
                    <td><?= $judge['id'] ?></td>
                    <td><?= htmlspecialchars($judge['username'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($judge['display_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="edit_judge.php?id=<?= $judge['id'] ?>" class="action-link edit-link">Edit</a>
                            <a href="actions/delete_judge.php?id=<?= $judge['id'] ?>" 
                               class="action-link delete-link"
                               onclick="return confirm('Permanently delete <?= htmlspecialchars(addslashes($judge['display_name']), ENT_QUOTES, 'UTF-8') ?>?')">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>