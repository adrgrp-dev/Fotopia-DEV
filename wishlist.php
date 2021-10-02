<?php
include "connection.php";

$loggedin_id=$_GET['R_id'];
$phoID=$_GET['P_id'];

$wish=mysqli_query($con,"INSERT INTO `wishlist` (`realtor_id`, `photographer_id`) 
        VALUES ('$loggedin_id','$phoID')");

 ?> 
