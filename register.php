<?php
require_once 'db.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) { // MySQL 重复键错误代码
            $error = "Username already exists";
        } else {
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<div class="game-box card p-4">
    <h2 class="mb-4 text-center">Register</h2>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password (min 6 chars)" required minlength="6">
        </div>
        <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <div class="mt-3 text-center">
        <a href="login.php">Already have an account?</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>