<?php
include "connection.php";

$logged_in_id=$_REQUEST["id"];
$title=$_REQUEST["con"];

$email_template=mysqli_query($con,"select * from email_template WHERE pc_admin_id='$logged_in_id' and template_title= '$title'");

$row_found = mysqli_num_rows($email_template);

if ($row_found > 0){


$get_email_template=mysqli_fetch_array($email_template);


echo $get_email_template['template_body_text'];

}

else{

	echo '';
}

 ?>
