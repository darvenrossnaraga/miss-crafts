<?php 

include 'functions/authentication.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

   
    Authentication::login($username, $password);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miss Crafts Login</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&family=Rouge+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <img src="assets/images/Logo.jpg" alt="Miss Crafts Logo" class="logo">
        <h1 class="title">Miss Crafts</h1>
        <p class="subtitle">Login to your account</p>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<p class='error'>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);

                }
            ?>

        <form method="POST">
            <div class="input-container">
                <span class="icon">👤</span>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input-container">
                <span class="icon">🔒</span>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
