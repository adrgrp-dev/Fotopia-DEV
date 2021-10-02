<?php
include "connection.php";

 $order_id=$_REQUEST["order_id"];
 $date=$_REQUEST["date"];
$getid1=mysqli_query($con,"select id from appointments where order_id=$order_id");
$getid=mysqli_fetch_array($getid1);
$id=$getid['id'];

$query="update `appointments` set `from_datetime`=concat('$date ',time(`from_datetime`)),`to_datetime`=concat('$date ',time(`to_datetime`)) where id=?";

$stmt = $con->prepare($query);
$stmt->bind_param("s",$id);
$stmt->execute();
$stmt->close();


 ?>
