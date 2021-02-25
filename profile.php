<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
} else {
    echo "There was an error retrieving the username and email from the database";   
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Profile</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="css/styles.css" type="text/css"> -->
  <style><?php require("css/styles.css");?></style>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

  <style>
      #container {
          margin-top: 100px;
      }

      #notePad, #allNotes, #done {
          display: none;
      }

      .buttons {
          margin-bottom: 20px;
      }

      textarea {
          width: 100%;
          max-width: 100%;
          font-size: 16px;
          line-height: 1.5em;
          border-left-width: 20px;
          border-color: #CA3DD9;
          color: #CA3DD9;
          background-color: #FBEFFF;
          padding: 10px;
      }

      tr {
          cursor: pointer;
      }
  </style>

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
          <li class="active"><a href="#">Profile</a></li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="mainpageloggedin.php">My Notes</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Logged in as <b><?php echo $username; ?></b></a></li>
          <li><a href="index.php?logout=1">Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Container -->
  <div class="container" id="container">
      <div class="row">
          <div class="col-md-offset-3 col-md-6">
              <h2>Account Settings:</h2>
              <div class="table-responsive">
                  <table class="table table-hover table-condensed table-bordered">
                      <tr data-target="#updateusername" data-toggle="modal">
                          <td>Username</td>
                          <td><?php echo $username; ?></td>
                      </tr>
                      <tr data-target="#updateemail" data-toggle="modal">
                          <td>Email</td>
                          <td>value</td>
                      </tr>
                      <tr data-target="#updatepassword" data-toggle="modal">
                          <td>Password</td>
                          <td>hidden</td>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
  </div>


  <!-- Update username -->
  <form method="post" id="updateusernameform">
    <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Edit Username:</h4>
          </div>
          <div class="modal-body">

            <!-- update username message from PHP file -->
            <div id="updateusernamemessage">

            </div>

            <div class="form-group">
              <label for="username">Username:</label>
              <input class="form-control" type="text" name="username" id="username"
                maxlength="30" value="<?php echo $username; ?>">
            </div>
            
          </div>

          <div class="modal-footer">
            <input class="btn green" name="updateusername" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Update email -->
  <form method="post" id="updateemailform">
    <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Enter new email:</h4>
          </div>
          <div class="modal-body">

            <!-- update email message from PHP file -->
            <div id="update">

            </div>

            <div class="form-group">
              <label for="loginemail">Email:</label>
              <input class="form-control" type="email" name="email" id="email"
                maxlength="50" value="email value">
            </div>
            
          </div>

          <div class="modal-footer">
            <input class="btn green" name="updateemail" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Update password -->
  <form method="post" id="updatepasswordform">
    <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h4 id="myModalLabel">Enter current and new password:</h4>
          </div>
          <div class="modal-body">

            <!-- update password message from PHP file -->
            <div id="updatepasswordmessage">

            </div>

            <div class="form-group">
                <label for="currentpassword" class="sr-only">Your current password:</label>
                <input class="form-control" type="password" name="currentpassword" id="currentpassword"
                  maxlength="30" placeholder="Your current password">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Choose a password:</label>
                <input class="form-control" type="password" name="password" id="password"
                  maxlength="30" placeholder="Choose a password">
              </div>
              <div class="form-group">
                <label for="password2" class="sr-only">Confirm password:</label>
                <input class="form-control" type="password" name="password2" id="password2"
                  maxlength="30" placeholder="Confirm password">
              </div>
            
          </div>

          <div class="modal-footer">
            <input class="btn green" name="updateusername" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  

  <!-- FOOTER -->
  <div class="footer">
    <div class="container">
      <p>Shane Wilson Copyright &copy; 2021.</p> <!-- use this if past 2021, <?php $today = date("Y"); echo $today?> -->
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
    crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
    integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
    crossorigin="anonymous"></script>
    <script src="profile.js"></script>
</body>

</html>