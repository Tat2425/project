<?php
require_once 'db.php';
require_once 'header.php';

// Fetch top players based on score
$stmt = $pdo->query("SELECT username, score FROM users ORDER BY score DESC LIMIT 10");
$leaders = $stmt->fetchAll();
?>

<div class="game-box">
    <h2>Leaderboard</h2>
    <table class="table">
        <tr>
            <th>Rank</th>
            <th>Username</th>
            <th>Score</th>
        </tr>
        <?php foreach ($leaders as $index => $leader): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($leader['username']) ?></td>
                <td><?= htmlspecialchars($leader['score']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="game.php" class="btn btn-primary">Play Again</a>
    <a href="logout.php" class="btn btn-outline-danger">logout</a>
</div>
<?php require_once 'footer.php'; ?>