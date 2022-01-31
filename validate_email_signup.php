<?php
include "connection.php";

$id=$_REQUEST["id"];


$type=$_REQUEST["type"];

if($type=="realtor"){

$Validate_email_query="SELECT id,first_name FROM `user_login` where email='$id' union select id,first_name from user_login_temp WHERE email='$id'";

}

else{

  $Validate_email_query="SELECT id,first_name FROM `admin_users` where email='$id' union select id,first_name from admin_users_temp WHERE email='$id' union select id,first_name from photo_company_admin WHERE email='$id'";
}
$res=mysqli_query($con,$Validate_email_query);
if(mysqli_num_rows($res)>0)
{
  echo "true";
}
else {
  echo "false";
}

 ?>
