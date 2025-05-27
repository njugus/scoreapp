<?php
function getAllJudges() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM judges ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllParticipants() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM participants ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
