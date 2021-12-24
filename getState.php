<?php 
include "connection.php";

$city=$_REQUEST["city"];

$stateQry=mysqli_query($con,"select * from norway_states_cities where Cities='$city'");
$stateIs=mysqli_fetch_array($stateQry);
$StateResult=$stateIs['States'];
$Zipcode=$stateIs['Zipcode'];

 echo "<option value='".$StateResult."'>".$StateResult."</option>"."zipcode".$Zipcode;
?>