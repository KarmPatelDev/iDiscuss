<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php 
    
    include 'partials/_dbconnect.php';
    
    include 'partials/_header.php'; 
    
    $search = $_GET['search'];

    echo '<div class="container">
      <h3 class="card-title my-5">Search Results for <em>"' . $search . '"</em></h3>';
       
$searchThreads = "SELECT * FROM `threads` WHERE MATCH (thread_name, thread_description) AGAINST ('$search')";
       $searchThreads_result = mysqli_query($conn, $searchThreads);
       $searchNo = mysqli_num_rows($searchThreads_result);

       if($searchNo != 0){

        while($searchThread_row = mysqli_fetch_assoc($searchThreads_result)){
          echo '
              <div class="media" style="display:flex; flex-direction: row; gap: 1rem; margin: 2rem 0;">
              <img width="90px" height="90px;" src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png" alt="Generic placeholder image">
              <div class="media-body column">
                <h5 class="mt-0"><a href="thread.php?threadid=' . $searchThread_row['thread_id'] .'">' . $searchThread_row['thread_name'] . '</a></h5>
                <p>' . $searchThread_row['thread_description'] . '</p>
              </div>
            </div>
          ';
        }
       }
       else{
        echo '<h4 class="text-center my-4">Sorry! Result Not Found</h4>';
       }

    echo '</div>';

    include 'partials/_footer.php';
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>