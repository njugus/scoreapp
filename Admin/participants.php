<?php 
require_once '../Config/db.php';
require_once '../includes/admin_functions.php';
require_once '../Auth/includes/auth_check.php';

$participants = getAllParticipants();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Participants</title>
    <link rel="stylesheet" href="./includes/participants.css">
</head>
<body>
    <h2>Manage Participants</h2>
    
    <div class="form-container">
        <form action="../Admin/Actions/save_participants.php" method="post">
            <div>
                <label for="name">Participant Name</label>
                <input type="text" id="name" name="name" placeholder="Enter full name" required>
            </div>
            <div>
                <label for="category">Category</label>
                <input type="text" id="category" name="category" placeholder="e.g. Solo, Team">
            </div>
            <button type="submit">Add Participant</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $participant): ?>
            <tr>
                <td><?= $participant['id'] ?></td>
                <td><?= htmlspecialchars($participant['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= !empty($participant['category']) ? htmlspecialchars($participant['category'], ENT_QUOTES, 'UTF-8') : '—' ?></td>
                <td class="actions">
                    <a href="edit_participant.php?id=<?= $participant['id'] ?>" class="edit-btn">Edit</a>
                    <a href="actions/delete_participant.php?id=<?= $participant['id'] ?>" 
                       class="delete-btn" 
                       onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars(addslashes($participant['name']), ENT_QUOTES, 'UTF-8') ?>?')">
                        Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>