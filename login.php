<?php

//start session
session_start();

//connect to the database
include "connection.php";

//Define error messages
$missingEmail = '<p><stong>Please enter your email address!</strong></p>';
$missingPassword = '<p><stong>Please enter your password!</strong></p>';

//get email and password
//store errors in errors variable
if (empty($_POST["loginemail"])) {
    $errors .= $missingEmail;
} else {
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
}
if (empty($_POST["loginpassword"])) {
    $errors .= $missingPassword;
} else {
    $password = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);
}

//if there are any errors
if ($errors) {
    //print error message
    $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultMessage;

//no errors
} else {
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);

    //run query: check combinaton of email & password exists
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }

    //if email & password don't match print error
    $count = mysqli_num_rows($result);
    if ($count !== 1) {
        echo '<div class="alert alert-danger">Wrong username or password</div>';
    } else {
        //log the user in: Set session variables
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        //if remember me is not checked
        if (empty($_POST['rememberme'])) {
            
            echo "success";
        } else {
            
            $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
            $authentificator2 = openssl_random_pseudo_bytes(20);

            //store them in a cookie
            function f1($a, $b)
            {
                $c = $a . "," . bin2hex($b);
                return $c;
            }
            $cookieValue = f1($authentificator1, $authentificator2);
            setcookie(
                "rememberme",
                $cookieValue,
                time() + 1296000
            );

            //run query to store them in rememberme table
            function f2($a)
            {
                $b = hash('sha256', $a);
                return $b;
            }
            $f2authentificator2 = f2($authentificator2);
            $user_id = $_SESSION['user_id'];
            $expiration = date('Y-m-d H:i:s', time() + 1296000);

            $sql = "INSERT INTO rememberme
        (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
        VALUES
        ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                echo '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
            } else {
                echo "success";
            }
        }
    }
}
?>
