<?php
include "connection.php";

$id=$_REQUEST["id"];
$q1="select * from user_login where email='$id' ";
$res=mysqli_query($con,$q1);
if(mysqli_num_rows($res)>0)
{
  echo "true";
}
else {
  echo "false";
}

 ?>
