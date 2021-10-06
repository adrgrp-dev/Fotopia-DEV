<?php

include "connection1.php";
$order_id=$_REQUEST['id'];
$invoice_check_query=mysqli_query($con,"select * from orders where id=$order_id");
$invoice_check=mysqli_fetch_assoc($invoice_check_query);

mysqli_query($con,"UPDATE `orders` SET status_id=3 WHERE id=$order_id");
mysqli_query($con,"UPDATE `raw_images` SET status=3 WHERE order_id=$order_id");
$photographer_id=$invoice_check['photographer_id'];
$get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
$get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
$pc_admin_id = $get_name['pc_admin_id'];
$csr_id = @$get_name['csr_id'];
$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$invoice_check['photographer_id'];
$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `photographer_id`,`pc_admin_id`,`csr_id`, `action_date`) VALUES ('Order','completed','$loggedin_name',$loggedin_id,'Photographer',$loggedin_id,$pc_admin_id,$csr_id,now())");
// $dir="./raw_images/order_$order_id";
// rmdir($dir);
 ?>
