<?php
session_start();

//connect to database
include('connection.php');

//log out
include('logout.php');

//remember me
include('remember.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Online Notes</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="css/styles.css" type="text/css"> -->
  <style><?php require("css/styles.css");?></style>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

</head>

<body>
  <!-- Navigation Bar -->
  <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand">Online Notes</a>
        <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#loginModal" data-toggle="modal">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sign up Button-->
  <div class="jumbotron" id="myContainer">
    <h1>Online Notes App</h1>
    <p>Your notes with you wherever you go!</p>
    <p>Easy to use, protects all your notes!</p>
    <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up - It's
      free</button>
  </div>

  <!-- Login form -->
  <form method="post" id="loginform">
    <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Login:</h4>
          </div>
          <div class="modal-body">

            <!-- Login  message from PHP file -->
            <div id="loginmessage">

            </div>

            <div class="form-group">
              <label for="loginemail" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
            </div>
            <div class="form-group">
              <label for="loginpassword" class="sr-only">Password:</label>
              <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
            </div>
            <div class="checkbox">
              <label for="">
                <input type="checkbox" name="rememberme" id="rememberme">Remember me
              </label>
              <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forgot Password?</a>
            </div>
          </div>

          <div class="modal-footer">
            <input class="btn green" name="login" type="submit" value="Login">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">Register</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Sign up Form-->
  <form method="post" id="signupform">
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Sign up today and start using our Online Notes app!</h4>
          </div>
          <div class="modal-body">

            <!-- Sign up message from PHP file -->
            <div id="signupmessage">

            </div>

            <div class="form-group">
              <label for="username" class="sr-only">Username:</label>
              <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
            </div>
            <div class="form-group">
              <label for="email" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Choose a password:</label>
              <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">Confirm password:</label>
              <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
            </div>
          </div>

          <div class="modal-footer">
            <input class="btn green" name="signup" type="submit" value="Sign up">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Forgot password form -->
  <form method="post" id="forgotpasswordform">
    <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Forgot password? Enter your email address:</h4>
          </div>
          <div class="modal-body">

            <!-- Forgot password message from PHP file -->
            <div id="forgotpasswordmessage">

            </div>

            <div class="form-group">
              <label for="forgotemail" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
            </div>

          </div>

          <div class="modal-footer">
            <input class="btn green" name="forgotpassword" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">Register</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- FOOTER -->
  <div class="footer">
    <div class="container">
      <p>Shane Wilson Copyright &copy; 2021.</p> <!-- use this if past 2021, <?php $today = date("Y");
                                                                              echo $today ?> -->
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script src="index.js"></script>
</body>

</html>