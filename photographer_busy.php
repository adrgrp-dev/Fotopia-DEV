<?php

//Set the Content-Type header to application/json.
header('Content-Type: application/json');

//	error_reporting(0);
include("connection.php");
$photographer_id=$_REQUEST['photographer_id'];
//$sql = "SELECT a.property_address as title,b.id,b.from_datetime as start,b.to_datetime as end,b.gmail_cal_event as gmailEvent FROM orders a join appointments b on  a.id=b.order_id where b.photographer_id='$photographer_id'";
$sql = "select ' Busy ' as address,'BUSY' as title, id as orderId,id, from_datetime as start, to_datetime as end,gmail_cal_event as gmailEvent,'BUSY' as status from appointments where photographer_id='$photographer_id' and status=0";

$arr = array();
if ($result = mysqli_query($con,$sql)) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {

        $arr[$counter]=$row;
        $counter++;
    }

	echo json_encode($arr);

} else {
    printf("Error: %s\n", $mysqli->sqlstate);
    exit;
}
?>
