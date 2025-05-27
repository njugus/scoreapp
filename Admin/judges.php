<?php 
require_once '../config/db.php';
require_once '../includes/admin_functions.php';

// Fetch all judges in the system
$judges = getAllJudges(); // Function from admin_functions.php in actions folder
?>

<h2>Manage Judges</h2>

<!-- Add New Judge Form -->
<form action="actions/save_judge.php" method="post">
    <input type="text" name="username" placeholder="Judge Username" required>
    <input type="text" name="display_name" placeholder="Display Name" required>
    <button type="submit">Add Judge</button>
</form>

<!-- Judges List -->
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Display Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($judges as $judge): ?>
    <tr>
        <td><?= $judge['id'] ?></td>
        <td><?= htmlspecialchars($judge['username']) ?></td>
        <td><?= htmlspecialchars($judge['display_name']) ?></td>
        <td>
            <a href="edit_judge.php?id=<?= $judge['id'] ?>">Edit</a>
            <a href="actions/delete_judge.php?id=<?= $judge['id'] ?>" 
               onclick="return confirm('Delete this judge?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>