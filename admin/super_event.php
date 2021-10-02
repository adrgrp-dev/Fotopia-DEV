<?php

//Set the Content-Type header to application/json.
header('Content-Type: application/json');

//	error_reporting(0);
include("connection.php");
if(@$_REQUEST["super_csr_id"])
{
$super_csr_id=$_REQUEST["super_csr_id"];
$sql = "SELECT CONCAT(a.property_city,',',a.property_state) address,a.property_address as title,a.id as orderId,b.id,b.from_datetime as start,b.to_datetime as end,b.gmail_cal_event as gmailEvent,a.status_id as status FROM orders a inner join appointments b on a.id=b.order_id inner join home_seller_info c on c.id=a.home_seller_id where b.photographer_id in (select id from user_login where type_of_user='Photographer' and pc_admin_id='$super_csr_id')";
}
if(@$_REQUEST["csr_id"])
{
$csr_id=$_REQUEST["csr_id"];
$sql = "SELECT CONCAT(a.property_city,',',a.property_state) address,a.property_address as title,a.id as orderId,b.id,b.from_datetime as start,b.to_datetime as end,b.gmail_cal_event as gmailEvent,a.status_id as status FROM orders a inner join appointments b on a.id=b.order_id inner join home_seller_info c on c.id=a.home_seller_id where b.photographer_id in (select id from user_login where type_of_user='Photographer' and csr_id='$csr_id')";
}

//$sql = "SELECT order_id as title,id,from_datetime as start,to_datetime as end FROM appointments where created_by_id='$realtor_id'";

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
