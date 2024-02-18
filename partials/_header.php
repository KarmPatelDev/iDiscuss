<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/iDiscuss">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/iDiscuss">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <?php 
               
               $getCategories = "SELECT `category_name`, `category_id` FROM `categories`";
               $getCategories_result = mysqli_query($conn, $getCategories);

               if($getCategories_result){
                while($getCategory_row = mysqli_fetch_assoc($getCategories_result)){
                  echo'
                  <li><a class="dropdown-item" href="threadlist.php?catid=' . $getCategory_row['category_id'] .'">' . $getCategory_row['category_name'] . '</a></li>';
                }
               }
               else{
                echo'
                <li><a class="dropdown-item" href="#">Category</a></li>';
               }
            ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <div class="d-flex flex-row mx-2">
      
      <form class="d-flex" action="search.php" role="search">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mx-2" type="submit">Search</button>
      </form>
      
      <?php 
      if(!isset($_SESSION)){ session_start(); }
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        if($_SESSION['user_id'] == 1){
          echo '<a class="btn btn-primary mx-2" href="/iDiscuss/createCategory.php">Add Category</a>';
        }
        echo '<a class="btn btn-primary mx-2" href="/iDiscuss/editProfile.php">Edit Profile</a><a class="btn btn-primary mx-2" href="/iDiscuss/partials/_handle_logout.php">Logout</a>';
      }
      else{
        echo '<button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
      }
      ?>

      </div>
    </div>
  </div>
</nav>

<?php

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

$showAlert = false;
$showError = false;

if(isset($_GET['signup_success'])){
  if(isset($_GET['signup_success']) && $_GET['signup_success'] == 'true'){
    $showAlert = true;
    $showError = false;
  }
  else if(isset($_GET['error']) && $_GET['signup_success'] == 'false'){
    $showAlert = true;
    $showError = true;
    $error = $_GET['error'];
  }
}

if(isset($_GET['login_success'])){
  if(isset($_GET['login_success']) && $_GET['login_success'] == 'true'){
    $showAlert = true;
    $showError = false;
  }
  else if($_GET['error'] && $_GET['login_success'] == 'false'){
    $showAlert = true;
    $showError = true;
    $error = $_GET['error'];
  }
}

if($showAlert){
  if(!$showError){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You account is loggedin.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Sorry!</strong> ' . $error . 
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}

?>
