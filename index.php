<?php
require_once 'header.php';

// Destroy any residual session data
if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    session_start(); // Restart fresh session
}

// Redirect to game.php only if valid session exists
if (isset($_SESSION['user_id'])) {
    header("Location: game.php");
    exit;
}

?>

<div class="game-box">
    <div class="question-card text-center">
        <h1 class="mb-4">Welcome to Yes/No Game! 🎮</h1>
        <p class="lead">Test your knowledge with simple true/false questions</p>

        <div class="row mt-5">
            <!-- Login/Register Section -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">Existing Player</h3>
                        <p class="card-text">Already have an account? Login to continue your game.</p>
                        <a href="login.php" class="btn btn-primary btn-lg w-100">Login Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">New Player</h3>
                        <p class="card-text">Join our community and start playing in 30 seconds!</p>
                        <a href="register.php" class="btn btn-success btn-lg w-100">Register Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Game Features -->
        <div class="mt-5">
            <h3 class="mb-4">🌟 Game Features</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>📚 1000+ Questions</h5>
                            <p>Wide range of topics from science to pop culture</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>🏆 Ranking</h5>
                            <p>Compete with players</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>⏱ Time Challenge</h5>
                            <p>10-second limit per question</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="mt-5 text-center">
            <div class="btn-group">
                <a href="reset_password.php" class="btn btn-primary">Reset Password</a>
                <a href="leaderboard.php" class="btn btn-outline-info">
                    <i class="fas fa-trophy"></i> Leaderboard
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>