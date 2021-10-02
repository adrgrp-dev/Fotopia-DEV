<?php
include "connection.php";

$loggedin_id=$_GET['R_id'];
$CSR_id=$_GET['CSR_id'];

$wish=mysqli_query($con,"delete from `wishlist` where `realtor_id`='$loggedin_id' and `super_csr_id`='$CSR_id'") 

 ?> 
