<?php

include "connection.php";

$realtor_id=$_REQUEST['realtor_id'];
$pc_admin_id=$_REQUEST['pc_admin_id'];

mysqli_query($con,"INSERT INTO `company_favourite_realtor` ( `pc_admin_id`, `realtor_id`) VALUES ( '$pc_admin_id', '$realtor_id')");

echo "true";
 ?>
