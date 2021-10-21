<?php
include "connection1.php";

$chat_message=$_REQUEST['chattext'];
$order_id=$_REQUEST['order_id'];

$from_user_type=$_SESSION['admin_loggedin_type'];
$from_user_id=$_SESSION['admin_loggedin_id'];

//echo "insert into chat_message(to_user_id,from_user_id,chat_message,timestamp,order_id)values('$created_by_id','$from_user_id','$chat_message',now(),'$order_id'";exit;
mysqli_query($con,"insert into chat_message(from_user_id,from_user_type,chat_message,timestamp,order_id)values('$from_user_id','$from_user_type','$chat_message',now(),'$order_id')");
?>
