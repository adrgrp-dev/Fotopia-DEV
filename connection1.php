<?php
session_start();
include "project-environment.php";


 if(!isset($_SESSION['Selected_Language_Session']))
 {
 $_SESSION['Selected_Language_Session']="en";
 }
 //echo $_SESSION['Selected_Language_Session'];

if(!isset($_SESSION['loggedin_email'])) {
    session_destroy();
	header("location:login.php?sessexp=1");
}


?>
