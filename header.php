<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>




<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yes/No Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">




    <div class="mt-3 text-center">

    </div>

    <div class="container mt-5">
        <nav class="mb-4 d-flex justify-content-between">

            <?php if (isset($_SESSION['user_id'])): ?>
                <div>
                    <a href="change_password.php" class="btn btn-outline-warning me-2">Change Password</a>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                </div>

                <!-- Add after the Change Password link -->
                <a href="leaderboard.php" class="btn btn-outline-info me-2">Leaderboard</a>


            <?php endif; ?>
        </nav>
    </div>
</head>

<body>
    <div class="container mt-5"></div>