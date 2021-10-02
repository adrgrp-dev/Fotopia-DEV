<?php

include "connection.php";

$realtor_id=$_REQUEST['realtor_id'];
$pc_admin_id=$_REQUEST['pc_admin_id'];

mysqli_query($con,"DELETE FROM `company_favourite_realtor` WHERE realtor_id='$realtor_id'");

echo "true";
 ?>
