<?php
include "connection1.php";
$created_by_id=$_REQUEST['created_by_id'];
$from_user_id=$_REQUEST["logged_id"];
$chat_message=$_REQUEST['chattext'];
$order_id=$_REQUEST['order_id'];

$from_user_type=$_SESSION['user_type'];
$from_user_id=$_SESSION['loggedin_id'];
$loggedin_name=$_SESSION['loggedin_name'];
//echo "insert into chat_message(to_user_id,from_user_id,chat_message,timestamp,order_id)values('$created_by_id','$from_user_id','$chat_message',now(),'$order_id'";exit;
mysqli_query($con,"insert into chat_message(from_user_id,from_user_type,chat_message,timestamp,order_id)values('$from_user_id','$from_user_type','$chat_message',now(),'$order_id')");

$realtorID=0;
if($from_user_type=='')
{
$realtorID=$_SESSION['loggedin_id'];
}

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`order_id`, `action_date`) VALUES ('Chat Message','Received','$loggedin_name',$loggedin_id,'$from_user_type','$realtorID','$order_id',now())");
?>

