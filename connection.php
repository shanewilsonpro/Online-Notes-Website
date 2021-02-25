<?php 
$link = mysqli_connect("localhost", "DATABASE_NAME", "PASSWORD", "SQL_NAME");
if(mysqli_connect_error()) {
    die("ERROR: Unable to connect:" . mysqli_connect_error());
    echo "<script>window.alert('Hi!')</script>";
}
?>