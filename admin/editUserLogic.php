<?php 
require 'config/database.php';
if (isset($_POST['submit'])){
    // get Updated form data
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $firstName = filter_var($_POST['first_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_var($_POST['last_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['user_role'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // Check For Valid Inputs
    if (!$firstName || !$lastName){
        $_SESSION['edit_user_err'] = "Invalid Form Input";
    }else{
        // Update User
        $query = "UPDATE `users` SET `firstname` = '$firstName', `lastname` = '$lastName', 
                                     `admin` = '$is_admin' WHERE `id` = '$id' LIMIT 1;
        ";
        $result = mysqli_query($conn,$query);
        if(mysqli_errno($conn)){
            $_SESSION['edit_user_err'] = "Failed To Update User.";
        }else{
            $_SESSION['edit_user_success'] = "Updated Successfully";
        }
    }
}
header("location:".ROOT_URL.'admin/manage-users.php');