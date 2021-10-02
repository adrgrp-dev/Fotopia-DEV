<?php 
ob_start();
session_start();
include "connection.php";
$uid=$_SESSION["loggedin_id"];
mysqli_query($con,"update online_now=0 where id='$uid'");
session_destroy();

header("location:login.php?logout=1");

?>