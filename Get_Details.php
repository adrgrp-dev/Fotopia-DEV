<?php
include "connection.php";

$Photographer_id=$_REQUEST["id"];
$contact="";


if($res=mysqli_query($con,"select email,contact_number from user_login where id='$Photographer_id' "))
{
$res1=mysqli_fetch_array($res);
$contact="Email : ".$res1['email']."<br> Contact No. : ".$res1['contact_number'];


$profile_query="select * from photographer_profile where photographer_id='$Photographer_id'";
$profile_result=mysqli_query($con,$profile_query);
$profile_result1=mysqli_fetch_array($profile_result);
if(!empty($profile_result1['about_me']))
{
  $about=$profile_result1['about_me'];
}
else {
  $about=" ";
}
if(!empty($profile_result1['skills']))
{
  $skills=$profile_result1['skills'];
}
else {
  $skills=" ";
}
if(!empty($profile_result1['portfolio']))
{
  $portfolio=$profile_result1['portfolio'];
}
else {
  $portfolio=" ";
}

}
if($product_result=mysqli_query($con,"SELECT * FROM `products` WHERE photographer_id='$Photographer_id'"))

$product=" ";
while($product_result1=mysqli_fetch_array($product_result))
{

$product.=$product_result1['title']."-$".$product_result1['total_price']."<br>";
}

echo $result="<div class=\"panel active\" id=\"aboutmeDiv\" style=\"height:203px;\">
                              ".$about."
                            </div>
                            <div class=\"panel\" id=\"myskillsDiv\" style=\"height:203px;\">
                               ".$skills."
                            </div>
							<div class=\"panel\" id=\"portfolioDiv\" style=\"height:203px;\">
                              ".$portfolio."
                            </div>
                            <div class=\"panel\" id=\"contactDiv\" style=\"height:203px;\">
                               ".$contact."
                            </div>
                            <div class=\"panel\" id=\"contactDiv\" style=\"height:203px;\">
                               ".$product."<br>
                            </div>
							<hr class=\"space s\">
<p align=\"center\">

<a class=\"anima-button circle-button btn-sm btn adr-cancel\" adr_trans=\"label_check_availability\" href=\"./photographerCalendar1.php?Photographer_id=$Photographer_id\"><i class=\"fa fa-calendar-o\"></i>Check Availability</a>&nbsp;&nbsp;&nbsp;
<a class=\"anima-button circle-button btn-sm btn adr-save\" adr_trans=\"label_book_now\" href=\"./photographerCalendar1.php?Photographer_id=$Photographer_id\" ><i class=\"fa fa-check\"></i>Book Now</a></p>
							";


 ?>
