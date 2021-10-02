<?php
include "connection.php";

 $order_id=$_REQUEST["order_id"];
 $startDay=$_REQUEST["startDay"];
  $endDay=$_REQUEST["endDay"];
 
$getid1=mysqli_query($con,"select id from appointments where order_id=$order_id");
$getid=mysqli_fetch_array($getid1);
$id=$getid['id'];

$query="update `appointments` set `from_datetime`='$startDay',`to_datetime`='$endDay' where id=?";

$stmt = $con->prepare($query);
$stmt->bind_param("s",$id);
$stmt->execute();
$stmt->close();


 ?>
