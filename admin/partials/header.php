<?php
require '../inc/blog-header.php';

// Fetch Current User From Data base
// if (isset($_SESSION['user_id'])){
//     $id = $_SESSION['user_id'];
//     $sql = "SELECT `avatar` FROM `users` WHERE `id` = '$id';";
//     $result = mysqli_query($conn,$sql);
//     $avatar = mysqli_fetch_assoc($result);
// }
/// ===> Check login status
if (!isset($_SESSION['user_id'])){
    header('location:'.ROOT_URL.'login.php');
    die();
}
