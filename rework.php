<?php

include "connection1.php";

    echo $file =$_REQUEST['id'];
    $file_exp=explode("/",$file);
    $order_id=$_REQUEST['od'];
		$directory="./rework_images/order_$order_id";
		mkdir($directory);
		$directory="./rework_images/order_$order_id/$file_exp[3]";
		mkdir($directory);

    // print_r($file_exp);
    $destinationFilePath ="./rework_images/".$file_exp[2]."/".$file_exp[3]."/".$file_exp[4];
    if($file_exp[3]=="standard_photos")
    {
     $service=1;
    }
    elseif ($file_exp[3]=="floor_plans") {
    $service=2;
    }
    else {
    $service=3;
    }
    if(rename($file,$destinationFilePath) ) {

      mysqli_query($con,"UPDATE `orders` SET status_id=6 WHERE id=$order_id");
      mysqli_query($con,"UPDATE `img_upload` SET `raw_images`=2,`finished_images`=0 WHERE img='$file_exp[4]'");


     }

    ?>
