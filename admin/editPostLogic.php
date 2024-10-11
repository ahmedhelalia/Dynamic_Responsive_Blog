<?php 
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];
    
    // set is featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?:0;

    // check and validate input values
    if (!$title){
        $_SESSION['edit_post'] = "Couldn't Update post. Invalid form data on edit post page.";
    }elseif(!$category_id){
        $_SESSION['edit_post'] = "Couldn't Update post. Invalid form data on edit post page.";

    }elseif(!$body){
        $_SESSION['edit_post'] = "Couldn't Update post. Invalid form data on edit post page.";

    }else{
        // delete existing thumbnail if new thumbnail is available
        if ($thumbnail['name']){
            $previous_thumbnail_path = '../images/'.$previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            // Work on new Thumbnail
            // work on image 
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_path = '../images/' .$thumbnail_name;

            // make sure if the file is an image
            $allowed_files = ['png','jpg','jpeg'];
            $extension = explode('.',$thumbnail_name);
            $extension = end($extension);
            if (in_array($extension,$allowed_files)){
                // make sure is not larger than 2mb
                if($thumbnail['size']<2000000){
                    move_uploaded_file($thumbnail_tmp_name,$thumbnail_path);

                }else{
                $_SESSION['edit_post'] = "Couldn't update post. thumbnail is to large";
                }
            }else{
                $_SESSION['edit_post'] = "Couldn't update post.thumbnail should be png, jpg or jpeg";

            }
        }

    }
}

if (isset($_SESSION['edit_post'])){
    // redirect to manage form page if form was invalid
    header("location:".ROOT_URL.'admin/');
    die();
}else{
    // set is featured of all posts to 0 if is_featured for this post is 1
    if ($is_featured == 1){
        $zero_all_is_featured = "UPDATE `posts` SET `is_featured`=0";
        $zero_all_is_featured_result = mysqli_query($conn,$zero_all_is_featured);

    }

    // set thumbnail name if a new one was uploaded,else keep the old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

    $query = "UPDATE `posts` SET `title`='$title',`body`='$body',`thumbnail`='$thumbnail_to_insert',
             `category_id`='$category_id' ,`is_featured`='$is_featured' WHERE  id ='$id' LIMIT 1;";
     $result = mysqli_query($conn,$query);  
     if (!mysqli_errno($conn)){
        $_SESSION['edit_post_success'] = "Post Updated Successfully";
     }
}

header("location:".ROOT_URL.'admin/');
die();