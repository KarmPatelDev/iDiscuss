<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php include 'partials/_header.php'; ?>
    
        <!-- slide -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="./images/banner_1.jpg" class="d-block w-100 h-400" alt="..." width="1280" height="400">
            </div>
            <div class="carousel-item">
            <img src="./images/banner_2.jpg" class="d-block w-100" alt="..." width="1280" height="400">
            </div>
            <div class="carousel-item">
            <img src="./images/banner_3.jpg" class="d-block w-100" alt="..." width="1280" height="400">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- categories -->
    <div class="container">
      <h2 class="text-center my-5">WelCome To iDiscuss - Categories</h2>
      <div class="d-flex flex-wrap text-center justify-content-center">
        
        <!-- Cateories Fetch -->
        <?php   
            $getCategories = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $getCategories);

            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    
                    $id = $row['category_id'];
                    $title = $row['category_name'];
                    $desc = $row['category_description'];

                    echo '
                    <div class="card mx-3 my-4" style="width: 25rem;">
                        <img src="./categories_image/' . $title . '.jpg" class="card-img-top" alt="' . $title . '" width="200" height="250" style="padding:10px;">
                        <div class="card-body">
                          <h5 class="card-title"><a href="threadlist.php?catid=' .$id .'" style="text-decoration:none;">' . $title . '</a></h5>
                          <p class="card-text" maxlength="32">' . substr($desc, 0, 128) . '...</p>
                          <a href="threadlist.php?catid=' .$id .'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                    ';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Sorry!</strong> Something went wrong. Categories not displayed yet.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        ?>
      </div>

      
    </div> 


    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>