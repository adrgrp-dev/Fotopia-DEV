<?php
include "connection.php";

$photographer_id=$_REQUEST['photographer_id'];
$fromDate=$_REQUEST['fromDate'];
$toDate=$_REQUEST['toDate'];
$od=@$_REQUEST['od'];
//$get_appointment=mysqli_query($con,"SELECT * FROM `appointments` where photographer_id=$photographer_id and (from_datetime BETWEEN '$fromDate' and '$toDate') OR (to_datetime BETWEEN '$fromDate' and '$toDate')");

//echo "SELECT * FROM appointments WHERE photographer_id=$photographer_id and ((from_datetime <= '$fromDate' AND to_datetime > '$fromDate') OR (from_datetime < '$toDate' AND to_datetime >= '$toDate'))";
$get_appointment="";
if($od!='')
{
$get_appointment=mysqli_query($con,"SELECT * FROM appointments WHERE photographer_id=$photographer_id and order_id!='$od' and ((from_datetime <= '$fromDate' AND to_datetime > '$fromDate') OR (from_datetime < '$toDate' AND to_datetime >= '$toDate'))");
}
else
{
$get_appointment=mysqli_query($con,"SELECT * FROM appointments WHERE photographer_id=$photographer_id and ((from_datetime <= '$fromDate' AND to_datetime > '$fromDate') OR (from_datetime < '$toDate' AND to_datetime >= '$toDate'))");
}

$number=mysqli_num_rows($get_appointment);

echo $number;
 ?>
