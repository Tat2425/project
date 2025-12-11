<?php
require_once 'db.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "User does not exist. <a href='register.php'>Register here</a>";
    } elseif (!password_verify($password, $user['password'])) {
        $error = "Invalid password";
    } else {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['score'] = 0;
        header("Location: game.php");
        exit;
    } 
}
?>

<div class="game-box card p-4">
    <h2 class="mb-4 text-center">Login</h2>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="mt-3 text-center">
        <a href="register.php">Create new account</a>
    </div>

<div class="mt-3 text-center">
    <a href="reset_password.php">Reset Password</a>
</div>

</div>

<?php require_once 'footer.php'; ?>