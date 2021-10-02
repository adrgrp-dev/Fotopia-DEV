<?php
include "connection.php";

$loggedin_id=$_GET['R_id'];
$phoID=$_GET['P_id'];

$wish=mysqli_query($con,"delete from `wishlist` where `realtor_id`='$loggedin_id' and `photographer_id`='$phoID'") 

 ?> 
