<?php
require 'config/database.php';
if (isset($_POST['submit'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // validate input

    if (!$title || !$description){
        $_SESSION['edit_category'] = "Invalid Form Input";
    }else{
        $query = "UPDATE `categories` SET `title` = '$title',`description`='$description'
        WHERE `id` = '$id' LIMIT 1;
        ";
        $result = mysqli_query($conn,$query);
        if (mysqli_errno($conn)){
            $_SESSION['edit_category'] = "Couldn't Update category";
        }else{
            $_SESSION['edit_category_success'] = "Category $title Updated Successfully";

        }
        header("location:".ROOT_URL.'admin/manage-categories.php');
        die();
    }
}