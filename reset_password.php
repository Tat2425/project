<?php
require_once 'db.php';
require_once 'header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $new_password = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);

    // Reset password directly via username (simple version)
    try {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->execute([$new_password, $username]);
        
        if ($stmt->rowCount() > 0) {
            $success = "Password reset successfully! <a href='login.php'>Login now</a>";
        } else {
            $error = "User not found";
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<div class="game-box card p-4">
    <h2 class="mb-4 text-center">Reset Password</h2>
    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="new_password" placeholder="New Password (min 6 chars)" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
    </form>
    <div class="mt-3 text-center">
        <a href="login.php">Back to Login</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>