<?php
include "connection.php";

$id=$_REQUEST["id"];

$type=$_REQUEST["type"];
$Validate_email_query="";
if($type=='Photographer')
{
  $Validate_email_query="select * from user_login where email='$id'";
}
else if ($type=='realtor') {
  $Validate_email_query="select * from user_login where email='$id'";
}
// else if ($type=='PCAdminUser') {
//  // $q1="select * from photo_company_admin where email='$id'";
//   $Validate_email_query="SELECT id,first_name FROM `photo_company_admin` where email='$id' union select id,first_name from admin_users WHERE email='$id'";
// }
else
{
$Validate_email_query="SELECT id,first_name FROM `photo_company_admin` where email='$id' union select id,first_name from admin_users WHERE email='$id'";
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
