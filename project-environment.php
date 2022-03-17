<?php
$_SESSION['project_url']="http://fotopia.adrgrp.com/photo-dev/";
$application_url="http://fotopia.adrgrp.com/photo-dev";
$support_team_email="support@fotopia.no";
$support_team_phone="";

//Database Credentials
$dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "photography_app";
 
  $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
  
  $configuration=mysqli_query($con,"select * from configuration where config_type='email'");
 $configuration1=mysqli_fetch_array($configuration);
 
// Email credentials
$emailHost=$configuration1['url'];
$emailUserID=$configuration1['userid'];
$emailPassword=$configuration1['pass'];
$emailPort = $configuration1['port'];;
$googleMapApiKey="AIzaSyCTPPWUkcYXU_s0Qelncs3GKrKW_kQDUIs";



if(!isset($_SESSION['Selected_Language_Session']))
 {
 $_SESSION['Selected_Language_Session']="en";
 }


//$emailHost='smtp.gmail.com';
//$emailUserID='test.deve@adrgrp.com';
//$emailPassword='adrgrp@123';
$_SESSION['googleMapApiKey']=$googleMapApiKey;
$_SESSION['emailHost']=$emailHost;
$_SESSION['emailUserID']=$emailUserID;
$_SESSION['emailPassword']=$emailPassword;
$_SESSION['emailPort']=$emailPort;
$_SESSION['support_team_email']=$support_team_email;
$_SESSION['support_team_phone']=$support_team_phone;


?>
