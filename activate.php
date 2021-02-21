<?php

//the user is re-directed to this file after clicking the activation link
//signup link contains two GET parameters: email and activation key
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Activation</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <style>
        h1 {
            color: purple;
        }

        .contactForm {
            border: 1px solid #7c73f6;
            margin-top: 50px;
            border-radius: 15px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 contactForm">
                <h1>Account Activation</h1>

                <?php

                //if email or activation key is missing show an error
                if (!isset($_GET['email']) || !isset($_GET['key'])) {
                    echo '<div class="alert alert-danger">There was an error. Please click on the activation link you received by email.</div>';
                    exit;
                }

                //store them in two variables
                $email = $_GET['email'];
                $key = $_GET['key'];

                // prepare variables for the query
                $email = mysqli_real_escape_string($link, $email);
                $key = mysqli_real_escape_string($link, $key);

                //run query: set activation field to "activated" for the provided email
                $sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
                $result = mysqli_query($link, $sql);

                //if query is successful, show success message and invite user to login
                if (mysqli_affected_rows($link) == 1) {
                    echo '<div class="alert alert-success">Your account has been activated.</div>';
                    echo '<a href="index.php" type="button" class="btn-lg btn-sucess">Log in<a/>';
                } else {
                    //show error message
                    echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
                    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
                }
                ?>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>