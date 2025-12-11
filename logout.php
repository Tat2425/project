<?php
require_once 'db.php'; // Include the database connection
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Prepare and execute the delete statement
    $stmt = $pdo->prepare("DELETE FROM user_answers WHERE user_id = ?");
    $stmt->execute([$userId]);
}

// Clear session variables and destroy the session
session_unset();
session_destroy();

// Redirect to index.php after logout
header("Location: index.php");
exit;
?>