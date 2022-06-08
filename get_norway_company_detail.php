<?php 

include "connection.php";

$get_company_value=$_REQUEST['company_name'];

 
$get_comapny_query=mysqli_query($con,"select * from norway_companies where company_name like '$get_company_value%'");

$get_company=mysqli_fetch_assoc($get_comapny_query);
$data=json_encode($get_company);
echo $data;
?>