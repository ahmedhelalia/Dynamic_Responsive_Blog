<?php include 'config/constants.php';
  
$username_email = $_SESSION['login_data']['username_email'] ?? null;
$password = $_SESSION['login_data']['password'] ?? null;
unset($_SESSION['login_data']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- Custom StyleeSheet-->
    <link rel="stylesheet" href="css/style.css">
    <!-- ICONSCOUNT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- Google Font (MONTSERRAT)-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    
</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Log In</h2>
        <?php
        if (isset($_SESSION['signup_success'])):
         ?>
        <div class="alert__message success">
            <p> <?= $_SESSION['signup_success'];
            unset($_SESSION['signup_success']);
              ?></p>
        </div>
        <?php elseif(isset($_SESSION['login_errors'])): ?>
        <div class="alert__message error">
            <p> <?= $_SESSION['login_errors'];
            unset($_SESSION['login_errors']);
              ?></p>
        </div>
        <?php endif; ?>
        <form action="<?=ROOT_URL?>login_logic.php" method="post">
   
            <input type="text" name="username_email"  placeholder="Username Or Email" value="<?= $username_email ?>">
            <input type="password" name="password" placeholder="Password" value="<?= $password ?>">
           
            <button type="submit" name="submit" class="btn">Log In</button>
            <small>Don't have an acc? <a href="signup.php"> Sign Up</a></small>
        </form>
    </div>
</section>
<script src="js/main.js"></script>
</body>
</html>