<?php
include "connection1.php";

$photographer_id=$_REQUEST['photographer_id'];
$fromDate=$_REQUEST['fromDate'];

$toDate=$_REQUEST['toDate'];
$check_from=$_SESSION['from'];
$fromDate1=$_REQUEST['fromDate1'];
$fromDate1=$_REQUEST['toDate1'];
$check_to=$_SESSION['to'];



 if(($check_from==$fromDate1)&&($check_to==$toDate1))
{
  $number=0;
}
else {

echo "SELECT * FROM `appointments` where photographer_id=12 and (from_datetime BETWEEN '$fromDate' and '$toDate') and (to_datetime BETWEEN '$fromDate' and '$toDate')";
$get_appointment=mysqli_query($con,"SELECT * FROM `appointments` where photographer_id=$photographer_id and (from_datetime BETWEEN '$fromDate' and '$toDate') OR (to_datetime BETWEEN '$fromDate' and '$toDate')");
$number=mysqli_num_rows($get_appointment);
}
echo $number;
?>
