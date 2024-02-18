<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Threads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php 
      include 'partials/_header.php'; 
      
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = $_GET['catid'];
        $th_title = $_POST['th_title'];
        $th_desc = $_POST['th_desc'];
        $th_id = $_POST['th_id'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        
        $insertThread = "INSERT INTO `threads` (`thread_category_id`, `thread_name`, `thread_description`, `thread_user_id`) VALUES ('$id', '$th_title', '$th_desc', '$th_id');";
        $insertThread_result = mysqli_query($conn, $insertThread);

        if($insertThread_result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Discussion is started.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong> Something went wrong. Discussion is not start.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

    }
   ?>

    <?php   
            $category_id = $_GET['catid'];
            $getCategory = "SELECT * FROM `categories` WHERE `category_id` = $category_id;";
            $category_result = mysqli_query($conn, $getCategory);

            if($category_result){
                while($category_row = mysqli_fetch_assoc($category_result)){

                    $category_name = $category_row['category_name'];
                    $category_description = $category_row['category_description'];

                    echo '
                    <div class="text-bg-danger text-center mb-4" style="width: 100%;height: 15rem;display:flex;align-items:center;justify-content:center;flex-direction: column;">
                      <h1 class="card-title my-3">WelCome To ' . $category_name . ' - Threads</h1>
                      <p class="card-text" style="width:70%">' . $category_description . '</p>
                    </div>
                ';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Sorry!</strong> Something went wrong. Category not displayed yet.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
    ?>
    
    <!-- threads -->
    <div class="container">
    <h2 class="card-title my-5">Browse Questions</h2>

    <?php   
            $thread_category_id = $_GET['catid'];
            $getThreads = "SELECT * FROM `threads` WHERE `thread_category_id` = $thread_category_id;";
            $thread_result = mysqli_query($conn, $getThreads);
            $noResult = true;
            if($thread_result){
                while($thread_row = mysqli_fetch_assoc($thread_result)){
                    $noResult = false;
                    $thread_id = $thread_row['thread_id'];
                    $thread_name = $thread_row['thread_name'];
                    $thread_description = $thread_row['thread_description'];
                    $thread_user_id = $thread_row['thread_user_id'];
                    $thread_doc = $thread_row['thread_doc'];

                    $getUser = "SELECT `user_email` FROM `users` WHERE `user_id` = '$thread_user_id'";
                    $getUser_result = mysqli_query($conn, $getUser);
                    $user_row = mysqli_fetch_assoc($getUser_result);
                    $user_email = $user_row['user_email'];

                    echo '
                    <div class="media" style="display:flex; flex-direction: row; gap: 1rem; margin: 2rem 0;">
                      <img width="90px" height="90px;" src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="Generic placeholder image">
                      <div class="media-body column">
                        <p class="font-weight-bold my-0">Asked By -: ' . $user_email . ' at ' . $thread_doc . '</p>
                        <h5 class="mt-0"><a href="thread.php?threadid=' .$thread_id .'" style="text-decoration:none;">' . $thread_name . '</a></h5>
                        <p>' . $thread_description . '</p>
                      </div>
                    </div> 
                ';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Sorry!</strong> Something went wrong. Threads are not displayed yet.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }

            if($noResult){
              echo '<div class="alert alert-info" role="alert">
                      <h4 class="card-title my-2">Be The First One To Start Discussion</h4>
                    </div>
                    ';
            }

        ?>

        <h2 class="card-title my-3">Ask a Questions</h2>
          <!-- <form action="/iDiscuss/threadlist.php?catid=<?php //$id = $_GET['catid']; echo $id;?>" method="POST"> -->
        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
              <label for="th_title" class="form-label">Problem Title</label>
              <input type="text" class="form-control" id="th_title" name="th_title" maxlength="256" placeholder="Enter a Title" required>
            </div>
            <div class="mb-3">
              <label for="th_desc" class="form-label">Explaination of Question</label>
              <textarea class="form-control" id="th_desc" name="th_desc" maxlength="512" rows="5" required></textarea>
              <input type="hidden" name="th_id" value="' . $_SESSION['user_id'] . '"/>
            </div>
            <button type="submit" class="btn btn-primary">Start Discussion</button>
          </form>';
          }
          else{
            echo '<div class="alert alert-warning" role="alert">
                      <h5 class="card-title">Login / Signup to join the discussion</h5>
                    </div>
            ';
          }
        ?>

    </div>

    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>