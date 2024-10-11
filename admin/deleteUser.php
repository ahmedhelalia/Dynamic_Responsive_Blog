<?php
require 'config/database.php';
if (isset($_GET['id'])){
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    // fetch user from data base
    $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_assoc($result);

    // make sure we get back only one user
    if (mysqli_num_rows($result)==1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/'.$avatar_name;
        // delete image if available
        if ($avatar_path){
            unlink($avatar_path);
        }
    }
    // for later
    // fetch all thumbnails of user posts and delete them

    $thumbnail_query = "SELECT `thumbnail` FROM `posts` WHERE `author_id`='$id'";
    $thumbnail_result = mysqli_query($conn,$thumbnail_query);
    if(mysqli_num_rows($thumbnail_result)>0){
        while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
            $thumbnail_path = '../images/'.$thumbnail['thumbnail'];
            // delete thumbnail from images folder if exits
            if ($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }






    // delete user from data base
    $delete_user_query = "DELETE FROM `users` WHERE `id` = '$id';";
    $delete_user_result = mysqli_query($conn,$delete_user_query);
    if (mysqli_errno($conn)){
        $_SESSION['delete_user'] = "Couldn't delete user";
    }else{
        $_SESSION['delete_user_success'] = "User Deleted Successfully";
    }
}

header("location:".ROOT_URL.'admin/manage-users.php');