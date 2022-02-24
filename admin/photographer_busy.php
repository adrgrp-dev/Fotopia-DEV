<?php

//Set the Content-Type header to application/json.
header('Content-Type: application/json');

//	error_reporting(0);
include("connection.php");
$photographer_id=$_REQUEST['photographer_id'];
$pc_admin_id=$_REQUEST['pc_admin_id'];
$csr_id=0;
if(@$_REQUEST['csr_id'])
{
$csr_id=@$_REQUEST['csr_id'];
}
//$sql = "SELECT a.property_address as title,b.id,b.from_datetime as start,b.to_datetime as end,b.gmail_cal_event as gmailEvent FROM orders a join appointments b on  a.id=b.order_id where b.photographer_id='$photographer_id'";
$sql="";
if($csr_id!=0)
{
$sql = "select ' Busy' as address,'BUSY' as title, id as orderId,'' as id, from_datetime as start, to_datetime as end,gmail_cal_event as gmailEvent,'BUSY' as status from appointments where photographer_id in(select id from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id' and csr_id='$csr_id' and id='$photographer_id') and status=0";
}
else if($photographer_id!=0 && $csr_id==0)
{
$sql = "select ' Busy' as address,'BUSY' as title, id as orderId,'' as id, from_datetime as start, to_datetime as end,gmail_cal_event as gmailEvent,'BUSY' as status from appointments where photographer_id in(select id from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id' and id='$photographer_id') and status=0";
}
else
{
//$sql = "select ' Busy' as address,'BUSY' as title, '' as orderId,'' as id, from_datetime as start, to_datetime as end,'' as gmailEvent,'BUSY' as status from appointments where photographer_id in(select id from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id' and csr_id='$csr_id') and status=0";
}
//echo $sql;
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
