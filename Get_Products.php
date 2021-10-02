<?php
include "connection.php";

$photographer_id=$_REQUEST["photographer_id"];
$get_super_csr_query=mysqli_query($con,"select * from user_login WHERE id='$photographer_id'");
$get_super_csr=mysqli_fetch_assoc($get_super_csr_query);
$Products_List_options="";
$superCSR_ID=$get_super_csr['super_csr_id'];
$subCSR_ID = $get_super_csr['sub_csr_id'];
$Products_query = "";
if($superCSR_ID==0 && $subCSR_ID==0)
{
 $Products_query="select * from products where photographer_id=$photographer_id and super_csr_id=0";
}
else
{
 $Products_query="select * from products where photographer_id='$photographer_id' or super_csr_id='$superCSR_ID' ";
}
$Products=mysqli_query($con,$Products_query);
while($Products_list=mysqli_fetch_array($Products))
{
$sum=$Products_list['total_price']+$Products_list['photographer_bata']+$Products_list['other_cost'];
$Products_List_options.="<option value=\"".$Products_list['id']."\">".$Products_list['title']." - <span style=\"font-size:10px;\">Total Value : $". $sum."</span></option>";

}



echo $Products_List_options;
 ?>
