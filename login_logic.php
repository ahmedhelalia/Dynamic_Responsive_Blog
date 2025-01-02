<?php
include('config/database.php');
if(isset($_POST['submit'])){
    // get form data 
    $username_email = filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$username_email){
        $_SESSION['login_errors'] = "Username Or Email Required";
    }elseif(!$password){
        $_SESSION['login_errors'] = "Password Required";
    }else{
        // Fetch User From data base
        $fetch_user_query = "SELECT * FROM `users` WHERE `username` = '$username_email'
        OR `email` = '$username_email'";
        $fetch_user_result = mysqli_query($conn,$fetch_user_query);
        if (mysqli_num_rows($fetch_user_result)==1){
            // Convert the Record into an assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // Compare form password with hashed password from data base
            if (password_verify($password,$db_password)){
                // Set Session for Access Control
                $_SESSION["user_id"] = $user_record['id'];
                // Set session if user is an admin
                if ($user_record['admin'] == 1){
                    $_SESSION['user_is_admin'] = true;
                }
                
                // Log the user In
                header("location:".ROOT_URL.'admin/');
            }else{
                $_SESSION['login_errors'] = "Please Check Your Input";
            }
        }else{
            $_SESSION['login_errors'] = "User Not Found";
        }
    }

    /// If any error redirect back to login page with login data
    if (isset($_SESSION['login_errors'])){
        $_SESSION['login_data'] = $_POST;
        header("location:".ROOT_URL.'login.php');
        die();
    }


}else{
    header("location:".ROOT_URL.'login.php');
    die();
}