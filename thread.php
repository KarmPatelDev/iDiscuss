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
        
        $id = $_GET['threadid'];
        $co_content = $_POST['co_content'];
        $co_id = $_POST['co_id'];
      
        $co_content = str_replace("<", "&lt;", $co_content);
        $co_content = str_replace(">", "&gt;", $co_content);
      
        $insertComment = "INSERT INTO `comments` (`comment_thread_id`, `comment_content`, `comment_user_id`) VALUES ('$id', '$co_content', '$co_id');";
      
        $insertComment_result = mysqli_query($conn, $insertComment);
      
        if($insertComment_result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Comment is posted.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong> Something went wrong. Comment is not posted.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
      
      }
    ?>

    <?php   
            $thread_id = $_GET['threadid'];
            $getThread = "SELECT * FROM `threads` WHERE `thread_id` = $thread_id;";
            $thread_result = mysqli_query($conn, $getThread);

            if($thread_result){
                while($thread_row = mysqli_fetch_assoc($thread_result)){

                    $thread_name = $thread_row['thread_name'];
                    $thread_description = $thread_row['thread_description'];
                    $thread_user_id = $thread_row['thread_user_id'];

                    $getUser = "SELECT `user_email` FROM `users` WHERE `user_id` = '$thread_user_id'";
                    $getUser_result = mysqli_query($conn, $getUser);
                    $user_row = mysqli_fetch_assoc($getUser_result);
                    $user_email = $user_row['user_email'];

                    echo '
                    <div class="text-bg-danger text-center mb-4" style="width: 100%;height: 15rem;display:flex;align-items:center;justify-content:center;flex-direction: column;">
                      <h1 class="card-title my-3" style="width:80%">' . $thread_name . ' - <span style="font-size: 70%;">' . $user_email . '</span></h1>
                      <p class="card-text" style="width:70%">' . $thread_description . '</p>
                    </div>
                ';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Sorry!</strong> Something went wrong. Thread not displayed yet.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        ?>
    
    <!-- comments -->
    <div class="container">
    <h2 class="card-title my-5">Browse Comments</h2>

    <?php   
            $comment_thread_id = $_GET['threadid'];
            $getComments = "SELECT * FROM `comments` WHERE `comment_thread_id` = $comment_thread_id;";
            $comment_result = mysqli_query($conn, $getComments);
            $noResult = true;
            if($comment_result){
                while($comment_row = mysqli_fetch_assoc($comment_result)){
                    $noResult = false;
                    $comment_id = $comment_row['comment_id'];
                    $comment_content = $comment_row['comment_content'];
                    $comment_user_id = $comment_row['comment_user_id'];
                    $comment_doc = $comment_row['comment_doc'];

                    $getUser = "SELECT `user_email` FROM `users` WHERE `user_id` = '$comment_user_id'";
                    $getUser_result = mysqli_query($conn, $getUser);
                    $user_row = mysqli_fetch_assoc($getUser_result);
                    $user_email = $user_row['user_email'];

                    echo '
                    <div class="media" style="display:flex; flex-direction: row; gap: 1rem; margin: 2rem 0;">
                      <img width="90px" height="90px;" src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="Generic placeholder image">
                      <div class="media-body column">
                        <p class="font-weight-bold my-0">Answered By -: ' . $user_email . ' at ' . $comment_doc . '</p>
                        <p>' . $comment_content . '</p>
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

        <h2 class="card-title my-3">Post a Comment</h2>
          <!-- <form action="/iDiscuss/threadlist.php?catid=<?php //$id = $_GET['catid']; echo $id;?>" method="POST"> -->

          <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
           echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
              <label for="th_desc" class="form-label">Type Your Comment</label>
              <textarea class="form-control" id="co_content" name="co_content" maxlength="1024" rows="5" required></textarea>
              <input type="hidden" name="co_id" value="' . $_SESSION['user_id'] . '"/>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
          </form>';
          }
          else{
            echo '<div class="alert alert-warning" role="alert">
                      <h5 class="card-title">Login / Signup to comment</h5>
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