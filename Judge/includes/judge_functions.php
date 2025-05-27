<?php
require_once '../Config/db.php'; 
function getAllParticipants() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM participants ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getScoredParticipants($judge_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT participant_id, score FROM scores WHERE judge_id = ?");
    $stmt->execute([$judge_id]);
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Returns [participant_id => score]
}