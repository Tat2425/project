<?php
require_once 'db.php';
require_once 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Initialize the question counter if not already set
if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
}

// Check if the user has answered 10 questions
if ($_SESSION['question_count'] >= 10) {
    // Redirect to results page
    header("Location: results.php");
    exit;
}

// Delete previous answers when starting a new game
if ($_SESSION['question_count'] === 0) {
    $stmt = $pdo->prepare("DELETE FROM user_answers WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Clear residual feedback on new game start
if ($_SESSION['question_count'] === 0) {
    unset($_SESSION['last_answer']);
    $_SESSION['score'] = 0; // Redundant safety
}

// Get user-selected category (default to General)
$category = $_GET['category'] ?? 'General';

// Fetch random question based on category only
$stmt = $pdo->prepare("SELECT * FROM questions WHERE category = ? ORDER BY RAND() LIMIT 1");
$stmt->execute([$category]);
$question = $stmt->fetch();

// If no question found, fallback to default category
if (!$question) {
    $stmt = $pdo->prepare("SELECT * FROM questions ORDER BY RAND() LIMIT 1");
    $stmt->execute();
    $question = $stmt->fetch();
}

// Process answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $is_correct = ($answer === $question['correct_answer']) ? 1 : 0;
    $_SESSION['score'] += $is_correct;
    $_SESSION['question_count']++; // Increment the question counter

    // Save answer record
    $stmt = $pdo->prepare("INSERT INTO user_answers (user_id, question_id, answer) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $question['id'], $answer]);

    // Add feedback to session
    $_SESSION['last_answer'] = [
        'correct' => $is_correct,
        'question' => $question['question_text'],
        'your_answer' => $answer,
    ];

    header("Location: game.php?category=" . urlencode($category));
    exit;
}


// Clear old answers on new game
if ($_SESSION['question_count'] === 0) {
    $stmt = $pdo->prepare("DELETE FROM user_answers WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}





// Fetch categories
$categories = $pdo->query("SELECT DISTINCT category FROM questions")->fetchAll(PDO::FETCH_COLUMN);
?>

<!-- Audio Feedback -->
<audio id="correct-sound" src="assets/sfx/correct.mp3"></audio>
<audio id="wrong-sound" src="assets/sfx/wrong.mp3"></audio>

<div class="game-box">
    <div class="question-card">
        <!-- Category Selector -->
        <div class="category-selector mb-4">
            <div class="btn-group">
                <?php foreach ($categories as $cat): ?>
                    <?php if (trim($cat) === 'General')
                        continue; // Explicitly exclude General ?>
                    <a href="game.php?category=<?= urlencode($cat) ?>"
                        class="btn btn-<?= $cat === $category ? 'primary' : 'outline-secondary' ?>">
                        <?= htmlspecialchars($cat) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Score and Progress -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Score: <span id="current-score"><?= $_SESSION['score'] ?></span></h3>
            <div class="progress" style="width: 200px; height: 20px">
                <div class="progress-bar" role="progressbar" style="width: <?= min(100, $_SESSION['score'] * 10) ?>%"
                    aria-valuenow="<?= $_SESSION['score'] ?>" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>

        <!-- Question Area -->
        <div
            class="question-content <?= isset($_SESSION['last_answer']) ? 'animate__animated animate__bounceIn' : '' ?>">
            <?php if (isset($_SESSION['last_answer'])): ?>
                <div class="alert alert-<?= $_SESSION['last_answer']['correct'] ? 'success' : 'danger' ?>">
                    <?php if ($_SESSION['last_answer']['correct']): ?>
                        ✅ Correct!
                    <?php else: ?>
                        ❌ Wrong! The correct answer was <?= $question['correct_answer'] ?>
                    <?php endif; ?>
                </div>
                <?php unset($_SESSION['last_answer']); ?>
            <?php endif; ?>

            <h4 class="mb-4"><?= htmlspecialchars($question['question_text']) ?></h4>
        </div>

        <!-- Countdown Timer and Buttons -->
        <div class="game-controls">
            <div class="timer mb-3">
                <div class="text-center text-muted">Time Left:</div>
                <div class="countdown" id="countdown">10</div>
            </div>

            <form method="POST" id="answer-form">
                <div class="btn-group w-100">
                    <button type="submit" name="answer" value="Y" class="btn btn-success btn-lg py-3 answer-btn">
                        👍 Yes
                    </button>
                    <button type="submit" name="answer" value="N" class="btn btn-danger btn-lg py-3 answer-btn">
                        👎 No
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .countdown {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        color: #dc3545;
    }

    .answer-btn {
        transition: transform 0.1s;
    }

    .answer-btn:active {
        transform: scale(0.95);
    }

    .animate__animated {
        animation-duration: 0.5s;
    }
</style>

<script>
    let timeLeft = 10;
    const timerElement = document.getElementById('countdown');
    const form = document.getElementById('answer-form');

    const timer = setInterval(() => {
        timeLeft--;
        timerElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timer);
            const fakeInput = document.createElement('input');
            fakeInput.type = 'hidden';
            fakeInput.name = 'answer';
            fakeInput.value = 'TIMEOUT';
            form.appendChild(fakeInput);
            form.submit();
        }
    }, 1000);

    document.querySelectorAll('.answer-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const isCorrect = btn.value === '<?= $question['correct_answer'] ?>';
            const sound = document.getElementById(isCorrect ? 'correct-sound' : 'wrong-sound');
            sound.currentTime = 0;
            sound.play();
        });
    });
</script>

<?php require_once 'footer.php'; ?>