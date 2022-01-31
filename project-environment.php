<?php
 $_SESSION['project_url']="http://fotopia.adrgrp.com/photo-dev/";
$application_url="http://fotopia.adrgrp.com/photo-dev";

//Database Credentials
$dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "photography_app";
 
// Email credentials
$emailHost='smtp.office365.com';
$emailUserID='test.deve@adrgrp.com';
$emailPassword='ADRgroup@2022';
$emailPort = 587;
$googleMapApiKey="AIzaSyDMLLrgGfzVEqV_xISKSQQbPG3mnADwmuI";

//$emailHost='smtp.gmail.com';
//$emailUserID='test.deve@adrgrp.com';
//$emailPassword='adrgrp@123';
$_SESSION['googleMapApiKey']=$googleMapApiKey;
$_SESSION['emailHost']=$emailHost;
$_SESSION['emailUserID']=$emailUserID;
$_SESSION['emailPassword']=$emailPassword;
$_SESSION['emailPort']=$emailPort;


?>
