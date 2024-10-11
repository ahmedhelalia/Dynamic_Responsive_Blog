<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    $author_id = $_SESSION['user_id'];
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ? : 0;
    // validate form data
    if (!$title){
        $_SESSION['add_post'] = "Enter Post Title";
    }elseif(!$category_id){
        $_SESSION['add_post'] = "Select Post Category";
    }elseif(!$body){
        $_SESSION['add_post'] = "Enter the post body";
    }elseif(!$thumbnail['name']){
        $_SESSION['add_post'] = "Choose a thumbnail";
    }else{
        // WORK ON thumbnail
        // rename the image
        $time = time();
        $thumbnail_name = $time.$thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_path = '../images/'.$thumbnail_name;
        // make sure the file is really an image
        $allowedFiles = ['png','jpg','jpeg'];
        $extension = explode('.',$thumbnail_name);
        $extension = end($extension);
        if (in_array($extension,$allowedFiles)){
            // image is not larger than 2mb
            if($thumbnail['size']<2000000){
                move_uploaded_file($thumbnail_tmp_name,$thumbnail_path);
            }else{
                $_SESSION['add_post'] = "File size is too big";
            }

        }else{
            $_SESSION['add_post'] = "File should be png,jpg,or jpeg";
        }
    }
   
    // redirect back to add-post page with form data if there any problem
    if(isset($_SESSION['add_post'])){
        $_SESSION['add_post_data'] = $_POST;
        header("location:".ROOT_URL.'admin/add-post.php');
        die();
    }else{
        // set is_featured of all posts to 0 if is_featured for this post is 1
        if ($is_featured == 1){
            $zero_all_is_featured = "UPDATE `posts` SET `is_featured`=0";
            $zero_all_is_featured_result = mysqli_query($conn,$zero_all_is_featured);

        }
        // INSERT Post into data base
        $query = "INSERT INTO `posts` (`title`,`body`,`thumbnail`,`category_id`,`author_id`,`is_featured`)
        VALUES ('$title','$body','$thumbnail_name','$category_id','$author_id','$is_featured')
        ";
        $result = mysqli_query($conn,$query);
        if (!mysqli_errno($conn)){
            $_SESSION['add_post_success'] = "New Post Added Successfully";
            header("location: ".ROOT_URL.'admin/');
            die();
        }
    }


}
header("location:".ROOT_URL."admin/add-post.php");