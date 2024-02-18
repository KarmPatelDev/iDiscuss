<?php
   
   $showError = false;

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include '_dbconnect.php';

    $user_email = $_POST['signup_email'];
    $user_password = $_POST['signup_password'];
    $user_confirmpassword = $_POST['signup_confirmpassword'];

    //check email exist or not
    $existEmail = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $existEmail_result = mysqli_query($conn, $existEmail);
    $existEmailRows = mysqli_num_rows($existEmail_result);

    if($existEmailRows > 0){
        $showError = 'Username already exists.';
        header("Location: /iDiscuss/index.php?signup=false&error=$showError");
    }
    else{

        if($user_password == $user_confirmpassword){
           
            $hash = password_hash($user_password, PASSWORD_DEFAULT);
            $insertSignup = "INSERT INTO `users` (`user_email`, `user_password`) VALUES ('$user_email', '$hash');";
            $insertSignup_result = mysqli_query($conn, $insertSignup);
    
            if($insertSignup_result){
                if(!isset($_SESSION)){ session_start(); }
                $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $user_email;
                
                $getUser = "SELECT `user_id` FROM `users` WHERE `user_email` = '$user_email'";
                $getUser_result = mysqli_query($conn, $getUser);
                $user_row = mysqli_fetch_assoc($getUser_result);
                $_SESSION['user_id'] = $user_row['user_id'];

                header("Location: /iDiscuss/index.php?signup_success=true");
                exit();
            }
            else{
                $showError = 'Something went wrong. Please try letter.';
            }
        }
        else{
            $showError = 'Password not matched.';
        }
    }

    header("Location: /iDiscuss/index.php?signup_success=false&error=$showError");

    }

?>