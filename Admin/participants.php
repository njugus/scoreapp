<?php 
require_once '../Config/db.php';
require_once '../includes/admin_functions.php';

$participants = getAllParticipants();
?>

<h2>Manage Participants</h2>

<form action="../Admin/Actions/save_participants.php" method="post">
    <input type="text" name="name" placeholder="Participant Name" required>
    <input type="text" name="category" placeholder="Category (optional)">
    <button type="submit">Add Participant</button>
</form>

<!-- Participants List Table To dispplay participants -->
<table>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>category</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($participants as $participant): ?>
    <tr>
        <td><?= $participant['id'] ?></td>
        <td><?= htmlspecialchars($participant['name']) ?></td>
        <td><?= htmlspecialchars($participant['category']) ?></td>
        <td>
            <a href="edit_judge.php?id=<?= $participant['id'] ?>">Edit</a>
            <a href="actions/delete_judge.php?id=<?= $participant['id'] ?>" 
               onclick="return confirm('Delete this judge?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
