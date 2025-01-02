<?php

require 'config/constants.php';
/// get back form data if there was a registration error
$first_name = $_SESSION['signup_data']['first_name'] ?? null;
$last_name = $_SESSION['signup_data']['last_name']?? null;
$username = $_SESSION['signup_data']['username']?? null;
$email = $_SESSION['signup_data']['email']?? null;
$password = $_SESSION['signup_data']['password'] ?? null;
$confirmPassword = $_SESSION['signup_data']['confirm_password']?? null;
// Unset Session signup-data
unset($_SESSION['signup_data']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- Custom StyleSheet-->
    <link rel="stylesheet" href="css/style.css">
    <!-- ICONSCOUNT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- Google Font (MONTSERRAT)-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    
</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
       
        <?php if (isset($_SESSION['signup'])): ?>
        <div class="alert__message error">
            <p> <?= $_SESSION['signup'];
              unset($_SESSION['signup']);
            ?></p>
        </div>
        <?php endif;?>
        <form action="<?= ROOT_URL?>signup_logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="first_name"  placeholder="First Name" value="<?= $first_name ?>">
            <input type="text" name="last_name"  placeholder="Last Name" value="<?= $last_name ?>">
            <input type="text" name="username" placeholder="User Name" value="<?= $username ?>">
            <input type="text" name="email"  placeholder="Email" value="<?= $email ?>">
            <input type="text" name="password"  placeholder="Password" value="<?= $password ?>">
            <input type="text" name="confirm_password"  placeholder="Confirm Password" value="<?= $confirmPassword ?>">
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an acc? <a href="login.php">Log In</a></small>
        </form>
    </div>
</section>
<script src="js/main.js"></script>
</body>
</html>