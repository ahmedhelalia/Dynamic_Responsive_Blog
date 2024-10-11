<?php 
session_start();
require 'config/database.php';

// Get sign-up form data if signup button clicked

if (isset($_POST['submit'])){
    $firstName = filter_var($_POST['first_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName  = filter_var($_POST['last_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $userName = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirm_password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // Validate Input Values
    if (!$firstName){
        $_SESSION['signup'] = "Please Enter Your First Name";
    }elseif(!$lastName){
        $_SESSION['signup'] = "Please Enter Your Last Name";
    }elseif(!$userName){
        $_SESSION['signup'] = "Please Enter Your User Name";
    }elseif(!$email){
        $_SESSION['signup'] = "Please Enter A Valid Email";
    }elseif(strlen($password)<8 || strlen($confirmPassword) < 8){
        $_SESSION['signup'] = "Password Should be Greater than 8 ";
    }elseif(!$avatar['name']){
        $_SESSION['signup'] = "Please Add An Avatar";
    }else{
        // Check Password Matching
        if($confirmPassword !== $password){
            $_SESSION['signup'] = "Password do no match";
        }else{
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            // Check if the userName or email already in the database
            $user_check_query = "SELECT * FROM `users` WHERE  `username` = '$userName' OR `email` = '$email'";
            $user_check_query  = mysqli_query($conn,$user_check_query);
            if(mysqli_num_rows($user_check_query)>0){
                $_SESSION['signup'] = "Username Or Email Already Exists";
            }else{
                // Work On Avatar
                // Rename Avatar
                $time = time(); // make each image unique using current time stamp
                $avatar_name = $time.$avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/'.$avatar_name;

                // Make sure file is an image
                $allowedFiles = ['png','jpg','jpeg'];
                $extension = explode('.',$avatar_name);
                $extension = end($extension);
                // Check if In Allowed files
                if (in_array($extension,$allowedFiles)){
                    // make Sure image is not too large
                    if ($avatar['size']<1000000){
                        // Upload Avatar
                        move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
                    }else{
                        $_SESSION['signup'] = "File size Should be less than 1mb";
                    }
                }else{
                    $_SESSION['signup'] = "File Should be png or jpg or jpeg";
                }

            }
        }
    }
    // Redirect Back to Sign Up if there is an error
    if(isset($_SESSION['signup'])){
        // pass form back to  the sign up 
        $_SESSION['signup_data']=$_POST;
        header('location:'.ROOT_URL.'signup.php');
        exit();
    }else{
        // Insert Into users table
        $sql = "INSERT INTO `users`(`firstname`,`lastname`,`username`,`email`,`password`,`avatar`)
                            VALUES(?,?,?,?,?,?);
        ";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            die(mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt,'ssssss',$firstName,$lastName,$userName,$email,$hashedPassword,$avatar_name);
        mysqli_stmt_execute($stmt);
        if(!mysqli_errno($conn)){
            // Redirect to login page with success message
            $_SESSION['signup_success'] = "Registered Successfully, Please Log In";
            header('location:'.ROOT_URL.'login.php');
            exit();
        }
    }
    
}else{
    // if button wasn't clicked redirect back to signup page
    header("location:".ROOT_URL."signup.php");
    die();
}