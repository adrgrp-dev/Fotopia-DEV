<?php
include "connection.php";

$id=$_REQUEST["id"];

  $Validate_email_query="select * from editor where email='$id'";

$res=mysqli_query($con,$Validate_email_query);
if(mysqli_num_rows($res)>0)
{
  echo "true";
}
else {
  echo "false";
}

 ?>
