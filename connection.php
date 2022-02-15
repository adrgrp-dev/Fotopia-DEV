<?php
include "project-environment.php";
 //$con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 session_start();
 if(!isset($_SESSION['Selected_Language_Session']))
 {
 $_SESSION['Selected_Language_Session']="en";
 }
?>
