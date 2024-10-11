<?php
include 'config/database.php';

// Fetch Current User From Data base
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $sql = "SELECT `avatar` FROM `users` WHERE `id` = '$id';";
    $result = mysqli_query($conn,$sql);
    $avatar = mysqli_fetch_assoc($result);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MYSQL BLOG APP With Admin Panel</title>
    <!-- Custom StyleeSheet-->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/style.css">

    <!-- ICONSCOUNT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- Google Font (MONTSERRAT)-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    
</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">Helo</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL?>about.php">About</a></li>
                <li><a href="<?=ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
               
                <?php if(isset($_SESSION['user_id'])): ?>
                <li class="nav__profile">
                    <div class="avatar">
                    <img src="<?= ROOT_URL . 'images/'.$avatar['avatar']?>" alt="alt"> 
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Log Out</a></li>
                    </ul>
                </li>
                <?php else: ?>
                    <li><a href="<?= ROOT_URL ?>login.php">Log In</a></li>
                <?php endif;?>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

  <!--  ======================== END OF NAV ==============================================-->
