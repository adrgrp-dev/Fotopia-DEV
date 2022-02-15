<?php 
session_start();
include "../project-environment.php";
// $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 if(!isset($_SESSION['Selected_Language_Session']))
 {
 $_SESSION['Selected_Language_Session']="en";
 }
if(!isset($_SESSION['admin_loggedin_email']))
{
	header("location:index.php?sessexp=1");
}
?>