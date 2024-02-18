<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php 
        include 'partials/_header.php'; 
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $category_name = $_POST['cat_name'];
            $category_name = str_replace("<", "&lt;", $category_name);
            $category_name = str_replace(">", "&gt;", $category_name);
            $category_description = $_POST['cat_description'];
            $category_description = str_replace("<", "&lt;", $category_description);
            $category_description = str_replace(">", "&gt;", $category_description);
        
            //check Category exist or not
            $existCategory = "SELECT * FROM `categories` WHERE `category_name` = '$category_name'";
            $existCategory_result = mysqli_query($conn, $existCategory);
            $existCategoryRows = mysqli_num_rows($existCategory_result);
        
            if($existCategoryRows > 0){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong> Topic Already Exists.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
            else{
                $sql = "INSERT INTO `categories` (`category_name`, `category_description`) VALUES ('$category_name', '$category_description');";
                $sql_result = mysqli_query($conn, $sql);
            
                if($sql_result){
        
                    if(isset(($_FILES['cat_image']))){
        
                        $tmp_name = explode('.',$_FILES['cat_image']['name']);
                        $file_ext=strtolower(end($tmp_name));
                        $extensions= array("jpeg","jpg","png");
        
                        if((in_array($file_ext,$extensions)) && ($_FILES['cat_image']['size'] < 2097152)){
                            move_uploaded_file($_FILES['cat_image']['tmp_name'],"categories_image/".$category_name.".".$file_ext);
                        }
                        else{
                            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                            <strong>Sorry!</strong> Something went wrong. Image is not uploaded.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    }
        
                    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Success!</strong> Topic is Created.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else{
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Sorry!</strong> Something went wrong. Topic is not Created.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            }
            
        }

    ?>


    <!--Section: Thread v.2-->
<section class="mb-4" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Create Category</h2>
    <!--Section description-->
    <p class="text-center mx-auto mb-5">Do you have any new topic to Discuss? Enter Details For Topic...</p>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_id'] == 1){
        echo '<div class="row" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form action="/iDiscuss/createCategory.php" method="POST" enctype="multipart/form-data">  
                <!--Grid row-->
                <div class="row my-3">
                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="cat_image" class="">Select image to upload:</label>
                            <input type="file" id="cat_image" name="cat_image" class="form-control"/>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row my-3">
                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="cat_name" class="">Category Name</label>
                            <input type="text" id="cat_name" name="cat_name" class="form-control" maxlength="56">
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row my-3">
                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="cat_description">Category Description</label>
                            <textarea type="text" id="cat_description" name="cat_description" rows="6" class="form-control md-textarea" maxlength="1024"></textarea>
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
        echo '<div class="alert alert-warning" role="alert">
                      <h5 class="card-title">Admin only add category with their Credentials.</h5>
                    </div>
            ';
    }
    ?>
    
</section>
<!--Section: Thread v.2-->


    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>