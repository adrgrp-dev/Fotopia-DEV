<?php
include "connection.php";

$super_csr_id=$_GET['super_csr_id'];
$sub_csr_id=$_GET['sub_csr_id'];

$wish=mysqli_query($con,"delete from `csr_wishlist` where `super_csr_id`='$super_csr_id' and `sub_csr_id`='$sub_csr_id'"); 

 ?> 
