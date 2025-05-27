<?php
require_once '../../Config/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judge_id = (int)$_POST['judge_id'];
    $participant_id = (int)$_POST['participant_id'];
    $score = (int)$_POST['score'];

    // Validate score range
    if ($score < 1 || $score > 100) {
        die("Score must be between 1-100");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO scores (judge_id, participant_id, score) VALUES (?, ?, ?)");
        $stmt->execute([$judge_id, $participant_id, $score]);
        header("Location: ../dashboard.php?success=1");
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) { // Duplicate entry error code
            header("Location: ../dashboard.php?error=duplicate");
        } else {
            header("Location: ../dashboard.php?error=1");
        }
    }
    exit;
}