<?php
   
   $showError = false;

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include '_dbconnect.php';

    $user_email = $_POST['login_email'];
    $user_password = $_POST['login_password'];

    //check email exist or not
    $existEmail = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $existEmail_result = mysqli_query($conn, $existEmail);
    $existEmailRows = mysqli_num_rows($existEmail_result);

    if($existEmailRows == 1){
        $row = mysqli_fetch_assoc($existEmail_result);
        if(password_verify($user_password, $row['user_password'])){
  
            if(!isset($_SESSION)){ session_start(); }
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_id'] = $row['user_id'];
      
            header("Location: /iDiscuss/index.php?login_success=true");
            exit();

        }
        else{
            $showError = 'Password is not matched.';
        }
    }
    else{
        $showError = 'Email is not registered.';
    }

    header("Location: /iDiscuss/index.php?login_success=false&error=$showError");

    }

?>