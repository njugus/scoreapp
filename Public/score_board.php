<?php
// Security headers
header("X-Frame-Options: DENY");
header("Content-Security-Policy: default-src 'self'");
header("Referrer-Policy: no-referrer");

// Disable caching for real-time data
header("Cache-Control: no-store, must-revalidate");

require_once '../Config/db.php';

try {
    $stmt = $pdo->query("
        SELECT 
            p.id,
            p.name,
            COALESCE(SUM(s.score), 0) AS total_score,
            COUNT(s.score) AS vote_count
        FROM participants p
        LEFT JOIN scores s ON p.id = s.participant_id
        GROUP BY p.id
        ORDER BY total_score DESC
    ");
    $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Scoreboard error: " . $e->getMessage());
    die("System temporarily unavailable");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Scoreboard</title>
    <link rel="stylesheet" href="includes/scoreboard.css">
</head>
<body>
    <h1>Live Rankings</h1>
    <div id="scoreboard">
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Participant</th>
                    <th>Total Score</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $i => $participant): ?>
                <tr class="<?= $i < 3 ? 'podium-' . ($i + 1) : '' ?>">
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($participant['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= (int)$participant['total_score'] ?></td>
                    <td><?= (int)$participant['vote_count'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./includes/auto_refresh.js"></script>
</body>
</html>