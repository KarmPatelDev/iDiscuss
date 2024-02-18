<?php

// mysqli_report(MYSQLI_REPORT_OFF);

$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

// //Create a custom error handler
// function customErrorHandler($errno, $errstr, $errfile, $errline){

//     //Display a user-friendly error message
//     echo "Oops, something went wrong Please try letter.";

//     //Prevent the default error handler from running
//     return true;
// }

// //Register the custom error handler
// set_error_handler("customErrorHandler");

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    //Trigger a user error and let the custom error handle it
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Something went wrong. Please try letter.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

?>