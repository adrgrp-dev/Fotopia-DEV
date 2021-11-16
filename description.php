<?php
include "connection.php";
$id=$_REQUEST['id'];
$data=$_REQUEST['id1'];
$type=$_REQUEST['type'];
$user=@$_REQUEST['user'];
$get_imagenaming_query=mysqli_query($con,"select * from image_naming where id=$id");
$get_imagenaming=mysqli_fetch_array($get_imagenaming_query);
$image_name=$get_imagenaming['image_name'];
$order_id=$get_imagenaming['order_id'];
$new_image_name_fordb="";
if($user=="photographer"||$user=="adminraw")
{
 $old_image_name="./".str_replace("../","",$get_imagenaming['dynamic_folder'])."/".$image_name;

$new_image_name="./".str_replace("../","",$get_imagenaming['dynamic_folder'])."/".strtoupper($data)."_".$image_name;

 $new_image_name_fordb=strtoupper($data)."_".$image_name;
rename($old_image_name,$new_image_name);
}
elseif($user=="editor"||$user=="photo"||$user=="adminfinish")
{
  $old_image_name="finished_images/order_".$order_id."/$type/".$image_name;
  $new_image_name="finished_images/order_".$order_id."/$type/".strtoupper($data)."_".$image_name;
  $new_image_name_fordb=strtoupper($data)."_".$image_name;
  rename($old_image_name,$new_image_name);
}
@$data=strtoupper($data);
mysqli_query($con,"UPDATE `image_naming` SET `description`='$data',image_name='$new_image_name_fordb' WHERE id=$id");
mysqli_query($con,"UPDATE `img_upload` SET `img`='$new_image_name_fordb' where img='$image_name'");
echo "true";

?>
