<?php
include "connection1.php";

$Products_List_options="";
$order_id=$_REQUEST['id'];
//$get_Product_query="select * from order where id='$order_id' ";
$get_order=mysqli_query($con,"select * from orders where id='$order_id' ");
$order=mysqli_fetch_array($get_order);
$product=$order['product_id'];
$product_array=explode(",",$product);
$lenth=count($product_array);

$photographer_id=$order["photographer_id"];
//$Products_query="select * from products where photographer_id='$photographer_id' ";
$Products_query="select * from products where id in($product)";
$Products=mysqli_query($con,$Products_query);
while($Products_list=mysqli_fetch_array($Products))
{

       $sum=$Products_list['total_price']+$Products_list['photographer_bata']+$Products_list['other_cost'];
       $Products_List_options.="<option value=\"".$Products_list['id']."\" selected >".$Products_list['title']."-Total Value : $". $sum."</option>";

   }
  $Products_query1="select * from products where id not in($product) and photographer_id='$photographer_id'";
$Products1=mysqli_query($con,$Products_query1);
while($Products_list1=mysqli_fetch_array($Products1))
{
  
       $sum1=$Products_list1['total_price']+$Products_list1['photographer_bata']+$Products_list1['other_cost'];
       $Products_List_options.="<option value=\"".$Products_list1['id']."\">".$Products_list1['title']."-Total Value : $". $sum1."</option>";

   }
 
// $Products_List_options.="<option value=\"".$Products_list['id']."\"  >".$Products_list['title']."(Total Value : $562)</option>";





echo $Products_List_options;
 ?>
