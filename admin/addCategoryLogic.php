<?php
require 'config/database.php';
if (isset($_POST['submit'])){
    // get form data
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title){
        $_SESSION['add_category'] = "Enter Title";
    }elseif(!$description){
        $_SESSION['add_category'] = "Enter Description";
    }
   // redirect back to add category with form data if there was a problem
    if (isset($_SESSION['add_category'])){
        $_SESSION['add_category_data'] = $_POST;
        header("location:".ROOT_URL.'admin/add-category.php');
    }else{
        // insert category into data base
        $sql = "INSERT INTO `categories` (`title`,`description`) VALUES (?,?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            die(mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt,'ss',$title,$description);
        mysqli_stmt_execute($stmt);
         $_SESSION['add_category_success'] = "Category $title Added Successfully";
        header("location:".ROOT_URL.'admin/manage-categories.php');
        exit();
    }
}