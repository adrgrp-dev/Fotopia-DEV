<?php
include "connection.php";

 $order_id=$_REQUEST["order_id"];
 $date=$_REQUEST["date"];
$app=mysqli_query($con,"select id,order_id,created_by_id,time(from_datetime) as fromTime,time(to_datetime) as toTime,photographer_id from appointments where order_id=$order_id");
$app1=mysqli_fetch_array($app);
$id=$getid['id'];
$ph_id=$app1['photographer_id'];
$chk_from=$date." ".$app1['fromTime'];
$chk_to=$date." ".$app1['toTime'];


$order=mysqli_query($con,"select * from orders where id='$order_id'");
$order1=mysqli_fetch_array($order);
$due_date=$order1['order_due_date'];
$notes=$order1['booking_notes'];
$product=$order1['product_id'];



mysqli_query($con,"delete from appointment_updates where order_id=$order_id");

mysqli_query($con,"insert into appointment_updates (order_id,from_datetime,to_datetime,due_date,booking_notes,photographer_id,products)values('$order_id','$chk_from','$chk_to','$due_date','$notes','$ph_id','$product')");


 ?>
