<?php
include "connection.php";

$super_csr_id=$_GET['super_csr_id'];
$sub_csr_id=$_GET['sub_csr_id'];

$wish=mysqli_query($con,"INSERT INTO `csr_wishlist` (`super_csr_id`, `sub_csr_id`) 
        VALUES ('$super_csr_id','$sub_csr_id')");

 ?> 
