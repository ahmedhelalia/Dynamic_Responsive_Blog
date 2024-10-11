<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_SPECIAL_CHARS);


    // fetch post from the data base in order to delete thumbnail from images folder
    $query = "SELECT * FROM `posts` WHERE `id` = $id";
    $result = mysqli_query($conn,$query);

    // make sure only 1 record/post was fetched
    if(mysqli_num_rows($result)== 1){
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/'.$thumbnail_name;

        if($thumbnail_path){
            unlink($thumbnail_path);
            // delete from database
            $sql = "DELETE FROM `posts` WHERE `id`=$id LIMIT 1";
            $result = mysqli_query($conn,$sql);

            if(!mysqli_errno($conn)){
                $_SESSION['delete_post_success'] = "Post Deleted Successfully";
            }
        }
    }
}
header("location:".ROOT_URL.'admin/');