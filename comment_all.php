<?php
include "connection1.php";

$order_id=$_REQUEST['id'];
$service=$_REQUEST['id1'];
$comment=$_REQUEST['comments'];

mysqli_query($con,"UPDATE `raw_images` SET `comments`='$comment' WHERE order_id=$order_id and service_name=$service");
 ?>
