<?php
require 'config/database.php';

if (isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    
    // Update category_id of Post that belong to this category to the id of 
    // Uncategorized Category
    $update_query = "UPDATE `posts` SET `category_id` = 6 WHERE `category_id` = '$id'";
    $update_result = mysqli_query($conn,$update_query);

    if (!mysqli_errno($conn)){
          // delete the category
         $query = "DELETE FROM `categories` WHERE `id`='$id' LIMIT 1;";
         $result = mysqli_query($conn,$query);
         $_SESSION['delete_category_success'] = "Category deleted Successfully";
    }


    // delete the category
    // $query = "DELETE FROM `categories` WHERE `id`='$id';";
    // $result = mysqli_query($conn,$query);
    // $_SESSION['delete_category_success'] = "Category deleted Successfully";
}
header('location:'.ROOT_URL.'admin/manage-categories.php');