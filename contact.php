<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php 
    
        include 'partials/_header.php'; 

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $contact_name = $_POST['con_name'];
            $contact_name = str_replace("<", "&lt;", $contact_name);
            $contact_name = str_replace(">", "&gt;", $contact_name);
            $contact_email = $_POST['con_email'];
            $contact_email = str_replace("<", "&lt;", $contact_email);
            $contact_email = str_replace(">", "&gt;", $contact_email);
            $contact_subject = $_POST['con_subject'];
            $contact_subject = str_replace("<", "&lt;", $contact_subject);
            $contact_subject = str_replace(">", "&gt;", $contact_subject);
            $contact_message = $_POST['con_message'];
            $contact_message = str_replace("<", "&lt;", $contact_message);
            $contact_message = str_replace(">", "&gt;", $contact_message);
        
            $sql = "INSERT INTO `contacts` (`contact_name`, `contact_email`, `contact_subject`,`contact_message`) VALUES ('$contact_name', '$contact_email', '$contact_subject','$contact_message');";
            $sql_result = mysqli_query($conn, $sql);
        
            if($sql_result){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You message was sent.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            else{
            echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Sorry!</strong> Something went wrong. You message was not sent.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
    
    ?>


    <!--Section: Contact v.2-->
<section class="mb-4" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form action="/iDiscuss/contact.php" method="POST">

                <!--Grid row-->
                <div class="row my-3">
                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="con_name" class="">Your name</label>
                            <input type="text" id="con_name" name="con_name" class="form-control" maxlength="56">
                            <label for="con_email" class="">Your email</label>
                            <input type="text" id="con_email" name="con_email" class="form-control" maxlength="56">
                            <label for="con_subject" class="">Subject</label>
                            <input type="text" id="con_subject" name="con_subject" class="form-control" maxlength="256">
                            <label for="con_message">Your message</label>
                            <textarea type="text" id="con_message" name="con_message" rows="6" class="form-control md-textarea" maxlength="1024"></textarea>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->

                <button type="submit" class="btn btn-primary">Send</button>

            </form>
        </div>
        <!--Grid column-->



    </div>

</section>
<!--Section: Contact v.2-->


    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>