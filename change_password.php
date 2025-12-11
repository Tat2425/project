<?php
require_once 'db.php';
require_once 'header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);

    // Basic validation
    if (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters long.";
    } else {
        try {
            // Fetch the current password hash from the database
            $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($current_password, $user['password'])) {
                // Password matches, proceed to update
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
                $update_stmt->execute([$hashed_password, $username]);

                if ($update_stmt->rowCount() > 0) {
                    // Updated success message with a login link
                    $success = "Password change successfully! <a href='login.php'>Login now</a>";
                } else {
                    $error = "Error updating password.";
                }
            } else {
                $error = "Current password is incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<div class="game-box card p-4">
    <h2 class="mb-4 text-center">Change Password</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="new_password" placeholder="New Password (min 6 chars)" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary w-100">Change Password</button>
    </form>
    <div class="mt-3 text-center">
        <a href="login.php">Back to Login</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>