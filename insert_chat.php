<?php
include "connection1.php";
$created_by_id=$_REQUEST['created_by_id'];
$from_user_id=$_REQUEST["logged_id"];
$loggedin_id=$_REQUEST["logged_id"];
$chat_message=$_REQUEST['chattext'];
$order_id=$_REQUEST['order_id'];

$GetOrderDetails=mysqli_query($con,"select * from orders where id='$order_id'");
$GetOrderDetails1=mysqli_fetch_array($GetOrderDetails);
 $realtorID=$GetOrderDetails1['realtor_id'];
$pc_admin_id=$GetOrderDetails1['pc_admin_id'];
$csr_id=$GetOrderDetails1['csr_id'];
$photographer_id=$GetOrderDetails1['photographer_id'];

$from_user_type=$_SESSION['user_type'];
$from_user_id=$_SESSION['loggedin_id'];
$loggedin_name=$_SESSION['loggedin_name'];
//echo "insert into chat_message(to_user_id,from_user_id,chat_message,timestamp,order_id)values('$created_by_id','$from_user_id','$chat_message',now(),'$order_id'";exit;
mysqli_query($con,"insert into chat_message(from_user_id,from_user_type,chat_message,timestamp,order_id)values('$from_user_id','$from_user_type','$chat_message',now(),'$order_id')");

//$realtorID=0;
if($from_user_type=='Realtor')
{
$realtorID=$_SESSION['loggedin_id'];
}

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`order_id`,`pc_admin_id`,`csr_id`,`photographer_id`, `action_date`) VALUES ('Chat Message','Received','$loggedin_name',$loggedin_id,'$from_user_type','$realtorID','$order_id','$pc_admin_id','$csr_id','$photographer_id',now())");


?>
