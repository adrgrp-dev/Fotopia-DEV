<?php
include "connection.php";

$loggedin_id=$_GET['Super_CSR_id'];
$phoID=$_GET['P_id'];

$type=$_REQUEST['type'];

if($type=="SuperCSR")
{
$wish=mysqli_query($con,"delete from `csr_wishlist` where `super_csr_id`='$loggedin_id' and `photographer_id`=$phoID");
}
else
{
$wish=mysqli_query($con,"delete from `csr_wishlist` where `sub_csr_id`='$loggedin_id' and `photographer_id`=$phoID");

}
 ?> 
