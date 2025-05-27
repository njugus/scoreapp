<?php
require_once '../Config/db.php';
require_once  './includes/judge_functions.php';

$judge_id = 1; // Hardcoded for demo 
$participants = getAllParticipants();
$scored_participants = getScoredParticipants($judge_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Judge Portal</title>
    <style>
        .scored { background-color: #e6ffe6; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Score Participants</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Participant</th>
            <th>Your Score</th>
            <th>Action</th>
        </tr>
        <?php foreach ($participants as $participant): ?>
        <tr class="<?= isset($scored_participants[$participant['id']]) ? 'scored' : '' ?>">
            <td><?= $participant['id'] ?></td>
            <td><?= htmlspecialchars($participant['name']) ?></td>
            <td>
                <?= $scored_participants[$participant['id']] ?? 'Not scored' ?>
            </td>
            <td>
                <?php if (!isset($scored_participants[$participant['id']])): ?>
                <form action="./actions/submit_score.php" method="post">
                    <input type="hidden" name="judge_id" value="<?= $judge_id ?>">
                    <input type="hidden" name="participant_id" value="<?= $participant['id'] ?>">
                    <input type="number" name="score" min="1" max="100" required>
                    <button type="submit">Submit</button>
                </form>
                <?php else: ?>
                <em>Already scored</em>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>