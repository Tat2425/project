<?php
session_start();
require_once 'header.php';
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Display the user's score
$score = $_SESSION['score'] ?? 0;
$question_count = $_SESSION['question_count'] ?? 0;

// Update high_score if current score is higher
$stmt = $pdo->prepare("SELECT score FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$current_high = $stmt->fetchColumn();

if ($score > $current_high) {
    $update_high = $pdo->prepare("UPDATE users SET score = ? WHERE id = ?");
    $update_high->execute([$score, $_SESSION['user_id']]);
}

// Reset the game state
$_SESSION['score'] = 0;
$_SESSION['question_count'] = 0;

// Fetch answer history
$stmt = $pdo->prepare("
    SELECT q.question_text, ua.answer, q.correct_answer 
    FROM user_answers ua
    JOIN questions q ON ua.question_id = q.id
    WHERE ua.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$history = $stmt->fetchAll();
?>

<div class="results">
    <h2>Your Results</h2>
    <p>You answered <?= $question_count ?> questions.</p>
    <p>Your score: <?= $score ?> / <?= $question_count ?></p> <!-- Dynamic denominator -->
    <a href="game.php?category=General" class="btn btn-primary">Play Again</a>

    <h3 class="mt-4">Your Answer History</h3>
    <?php if (empty($history)): ?>
        <div class="alert alert-info">No records found.</div>
    <?php else: ?>
        <table class="table">
            <tr>
                <th>Question</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
            </tr>
            <?php foreach ($history as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['question_text']) ?></td>
                    <td><?= htmlspecialchars($row['answer']) ?></td>
                    <td><?= htmlspecialchars($row['correct_answer']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>