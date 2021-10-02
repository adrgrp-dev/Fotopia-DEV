<?php
include "connection.php";

$loggedin_id=$_GET['Super_CSR_id'];
$phoID=$_GET['P_id'];
$type=$_REQUEST['type'];

if($type=="SuperCSR")
{
$wish=mysqli_query($con,"INSERT INTO `csr_wishlist` (`super_csr_id`, `photographer_id`) 
        VALUES ('$loggedin_id','$phoID')");
}
else
{
$wish=mysqli_query($con,"INSERT INTO `csr_wishlist` (`sub_csr_id`, `photographer_id`) 
        VALUES ('$loggedin_id','$phoID')");
}
 ?> 
