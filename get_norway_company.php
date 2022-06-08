<?php 

include "connection.php";

$get_option="";

$get_company_value=$_REQUEST['company_name'];
 
$get_comapny_query=mysqli_query($con,"select * from norway_companies where company_name like '$get_company_value%'");

while($get_company=mysqli_fetch_array($get_comapny_query))
{

$get_option.="<option value='".$get_company['company_name']."'>".$get_company['company_name']."</option>";

}

echo $get_option;
?>