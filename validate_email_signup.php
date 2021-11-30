<?php
include "connection.php";

$id=$_REQUEST["id"];

$Validate_email_query="SELECT id,first_name FROM `photo_company_admin` where email='$id' union select id,first_name from admin_users WHERE email='$id' union select id,first_name from user_login WHERE email='$id'";

$res=mysqli_query($con,$Validate_email_query);
if(mysqli_num_rows($res)>0)
{
  echo "true";
}
else {
  echo "false";
}

 ?>
