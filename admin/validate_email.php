<?php
include "connection.php";

$id=$_REQUEST["id"];

$type=$_REQUEST["type"];
$ql="";
if($type=='Photographer')
{

  $q1="select * from user_login where email='$id'";

}
elseif ($type=='realtor') {
  $q1="select * from user_login where email='$id'";
}
elseif ($type=='PCAdminUser') {
 // $q1="select * from photo_company_admin where email='$id'";
 $ql="SELECT id FROM `photo_company_admin` where email='$id' union select id from admin_users WHERE email='$id'";
}
else
{
$ql="SELECT id FROM `photo_company_admin` where email='$id' union select id from admin_users WHERE email='$id'";
}
$res=mysqli_query($con,$q1);
if(mysqli_num_rows($res)>0)
{
  echo "true";
}
else {
  echo "false";
}

 ?>
