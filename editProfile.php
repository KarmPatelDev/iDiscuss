<?php 
    if(!isset($_SESSION)){ session_start(); }
    include 'partials/_dbconnect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php 
        include 'partials/_header.php'; 
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $user_old_email = $_SESSION['user_email'];
            $user_email = $_POST['edit_email'];
            $user_old_password = $_POST['edit_old_password'];
            $user_new_password = $_POST['edit_new_password'];
            $user_new_confirmpassword = $_POST['edit_new_confirmpassword'];
        
            //old password verify
            $existEmail = "SELECT * FROM `users` WHERE `user_email` = '$user_old_email'";
            $existEmail_result = mysqli_query($conn, $existEmail);
            $existEmailRows = mysqli_num_rows($existEmail_result);
        
            if($existEmailRows == 1){
                $row = mysqli_fetch_assoc($existEmail_result);
                if((password_verify($user_old_password, $row['user_password'])) && ($user_new_password == $user_new_confirmpassword)){
        
                    $hash = password_hash($user_new_password, PASSWORD_DEFAULT);
                    if($user_email == ""){
                        $sql = "UPDATE `users` SET `user_password` = '$hash' WHERE `users`.`user_email` = '$user_old_email'";
                    }
                    else{
                        //check email exist or not
                        $existNewEmail = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
                        $existNewEmail_result = mysqli_query($conn, $existNewEmail);
                        $existNewEmailRows = mysqli_num_rows($existNewEmail_result);
        
                        if($existNewEmailRows > 0){
                            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                            <strong>Sorry!</strong> Something went wrong. Username already exists.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <a class="btn btn-primary m-4" href="/iDiscuss/editProfile.php">Go Back</a>
                            ';
                            exit;
                        }
                        else{
                            $sql = "UPDATE `users` SET `user_email` = '$user_email', `user_password` = '$hash' WHERE `users`.`user_email` = '$user_old_email'";
                        }
                    }
        
                    $editUser_result = mysqli_query($conn, $sql);
                    if($editUser_result){
                        if($user_email != "")$_SESSION['user_email'] = $user_email;
                        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                        <strong>Success!</strong> Details is changed.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                        <strong>Sorry!</strong> Something went wrong. Details is not changed.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Sorry!</strong> Something went wrong. Password Problem.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Sorry!</strong> Something went wrong.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>


    <!--Section: Profile v.2-->
<section class="mb-4" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        echo '<!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Edit Profile - '.$_SESSION['user_email'].'</h2>
        <div class="row" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">

            <!--Grid column-->
            <div class="col-md-9 mb-md-0 mb-5">
                <form action="/iDiscuss/editProfile.php" method="POST">

                    <!--Grid row-->
                    <div class="row my-3">
                        <!--Grid column-->
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                            <label for="edit_email">New Email</label>
                            <input type="email" class="form-control" id="edit_email" maxlength="56" aria-describedby="emailHelp" placeholder="Enter a New Email" name="edit_email"/>
                            <small id="emailHelp" class="form-text text-muted">Note: If you have to change email then fill this field.</small>
                            </div>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                            <label for="edit_old_password">Old Password</label>
                            <input type="password" class="form-control" id="edit_old_password" maxlength="32" placeholder="Enter Old Password" name="edit_old_password" required/>
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                            <label for="edit_new_password">New Password</label>
                            <input type="password" class="form-control" id="edit_new_password" maxlength="32" placeholder="Enter New Password" name="edit_new_password" required/>
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row my-3">
                        <!--Grid column-->
                        <div class="col-md-12">
                            <div class="md-form">
                            <label for="edit_new_confirmpassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="edit_new_confirmpassword" maxlength="32" placeholder="Enter Confirm Password" name="edit_new_confirmpassword" required/>
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <button type="submit" class="btn btn-primary">Send</button>

                </form>
            </div>
            <!--Grid column-->
        </div>';
    }
    else{
        echo '<h2 class="h1-responsive font-weight-bold text-center my-4">Edit Profile</h2>
        <div class="alert alert-warning" role="alert">
                      <h5 class="card-title">Login / Signup to Edit Profile</h5>
                    </div>
            ';
    }
    ?>

    

</section>
<!--Section: Profile v.2-->


    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>

