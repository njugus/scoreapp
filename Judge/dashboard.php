<?php
require_once '../Config/db.php';
require_once './includes/judge_functions.php';
require_once '../Auth/includes/auth_check.php';

$judge_id = 1; // Hardcoded for demo (replace with session variable later)
$participants = getAllParticipants();
$scored_participants = getScoredParticipants($judge_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judge Portal | Scoring System</title>
    <link rel="stylesheet" href="./includes/dashboard.css">
</head>
<body>
    <h1>Score Participants</h1>
    
    <table class="scoring-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Participant</th>
                <th>Status</th>
                <th>Your Score</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $participant): ?>
            <tr class="<?= isset($scored_participants[$participant['id']]) ? 'scored' : '' ?>">
                <td><?= $participant['id'] ?></td>
                <td><?= htmlspecialchars($participant['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <span class="status-badge <?= isset($scored_participants[$participant['id']]) ? 'scored-badge' : 'not-scored-badge' ?>">
                        <?= isset($scored_participants[$participant['id']]) ? 'Scored' : 'Pending' ?>
                    </span>
                </td>
                <td>
                    <?= isset($scored_participants[$participant['id']]) ? $scored_participants[$participant['id']] : '—' ?>
                </td>
                <td>
                    <?php if (!isset($scored_participants[$participant['id']])): ?>
                    <form class="score-form" action="./actions/submit_score.php" method="post">
                        <input type="hidden" name="judge_id" value="<?= $judge_id ?>">
                        <input type="hidden" name="participant_id" value="<?= $participant['id'] ?>">
                        <input type="number" 
                               class="score-input"
                               name="score" 
                               min="1" 
                               max="100" 
                               required
                               title="Enter score between 1-100">
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                    <?php else: ?>
                    <span class="already-scored">Evaluation completed</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>