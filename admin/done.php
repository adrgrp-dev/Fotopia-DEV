<?php

include "connection1.php";
$order_id=$_REQUEST['id'];
$invoice_check_query=mysqli_query($con,"select * from orders where id=$order_id");
$invoice_check=mysqli_fetch_assoc($invoice_check_query);

mysqli_query($con,"UPDATE `orders` SET status_id=3 WHERE id=$order_id");
mysqli_query($con,"UPDATE `raw_images` SET status=3 WHERE order_id=$order_id");


 ?>
