<?php

include "connection.php";

$order_id=$_REQUEST['id'];
$data=$_REQUEST['data'];

mysqli_query($con,"UPDATE `img_upload` SET `comments`='$data' WHERE id=$order_id");

echo $data;

?>
