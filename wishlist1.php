<?php
include "connection.php";

$loggedin_id=$_GET['R_id'];
$CSR_id=$_GET['CSR_id'];

$wish=mysqli_query($con,"INSERT INTO `wishlist` (`realtor_id`, `super_csr_id`)
        VALUES ('$loggedin_id','$CSR_id')");

 ?>
