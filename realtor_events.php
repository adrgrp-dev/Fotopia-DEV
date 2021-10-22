<?php

//Set the Content-Type header to application/json.
header('Content-Type: application/json');

//	error_reporting(0);
include("connection.php");
$realtor_id=$_REQUEST["realtor_id"];

$sql = "SELECT CONCAT(c.city,',',c.state) address,a.property_address as title,a.id as orderId,b.id,b.from_datetime as start,b.to_datetime as end,b.gmail_cal_event as gmailEvent,a.status_id as status FROM orders a inner join appointments b on a.id=b.order_id inner join home_seller_info c on c.id=a.home_seller_id where a.realtor_id='$realtor_id'";


$arr = array();
if ($result = mysqli_query($con,$sql)) {
    $counter = 0;
    while ($row = $result->fetch_assoc()) {

        $arr[$counter]=$row;
        $counter++;
    }

	echo json_encode($arr);
} else {
    printf("Error: %s\n", $con->sqlstate);
    exit;
}
?>
