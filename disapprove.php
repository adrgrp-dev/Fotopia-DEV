<?php

include "connection1.php";


    $file =$_REQUEST['id'];
    $file_exp=explode("/",$file);
    $order_id=$_REQUEST['od'];


    // print_r($file_exp);
    $destinationFilePath ="./finished_images/".$file_exp[2]."/".$file_exp[3]."/".$file_exp[4];
    if($file_exp[3]=="standard_photos")
    {
     $service=1;
    }
    elseif ($file_exp[3]=="floor_plans") {
    $service=2;
    }
    else if($file_exp[3]=="Drone_photos"){
    $service=3;
    }
		else{
			  $service=4;
		}
    @rename($file,$destinationFilePath);
     $data=0;
     mysqli_query($con,"UPDATE `img_upload` SET `raw_images`=0,`finished_images`=1,`disapprove`=1  WHERE img='$file_exp[4]'");
      // echo  $file3="./rework_images/order_".$order_id."/".$file_exp[3];

      if(count(glob("./rework_images/order_".$order_id."/".$file_exp[3]."/"."*"))!=0)
      {
        $data=3;
      }
      else{
      if(count(glob("./raw_images/order_".$order_id."/".$file_exp[3]."/"."*"))!=0)
      {
          $data=3;
      }
      }
      //echo $data;

    if($data==3) {
      mysqli_query($con,"UPDATE `orders` SET status_id=4 WHERE id=$order_id");
    }
    else{
      mysqli_query($con,"UPDATE `orders` SET status_id=2 WHERE id=$order_id");
    }
