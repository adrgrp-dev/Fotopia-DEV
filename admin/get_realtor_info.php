<?php
include "connection.php";
$realtor_id=$_REQUEST['realtor_id'];
$stmt = $con->prepare("SELECT first_name,address_line1,email,contact_number,realtor_employer_id from realtor_profile where realtor_id='$realtor_id'");
//$stmt->bind_param("sssii", $obj->limit);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
 ?>
