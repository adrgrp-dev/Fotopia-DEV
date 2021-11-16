<?php

	include "../connection.php";



	// ------------- Check if file is not empty ------------
	if(!empty($_FILES)) {
	 try
	  {
		$order_id=$_REQUEST['id'];
		$service=$_REQUEST['type'];
		$user_id=$_REQUEST['user_id'];
		$user_type=$_REQUEST['user_type'];
    $finished_images_exist=0;
    $finished_images_check=mysqli_query($con,"select * from img_upload where finished_images=1 and order_id='$order_id'");
		$finished_images_exist=mysqli_num_rows($finished_images_check);
		$allowed=array('png', 'jpg','JPG','PNG','JPEG','jpeg','DNG','dng','CR2','cr2','NEF','nef','ARW','arw');

		$fileName 				=			$_FILES['file']['name'];

		$source_path 			=			$_FILES['file']['tmp_name'];

		$fileExtension			=			pathinfo($fileName, PATHINFO_EXTENSION);

		$description_name=explode('-',$fileName);
		$description_name1=explode('.',$description_name[1]);
		//$description=$description_name[0]." ".$description_name1[0];
			$description=$description_name[0];
			$picture_name=$description_name[0]." ".$description_name1[0];

    // $order_id=5;
		//$targetFile=$description."_".time()."-".time()."-".strtolower(str_replace(" "," ",$fileName));
		$targetFile="";
		if($finished_images_exist>0)
		{
		
				$targetFile=$description."_".time()."-".time()."-".strtolower(str_replace(" "," ",$fileName));
				
		}
		else
		{
		$targetFile=strtolower(str_replace("-","_",$fileName));
	  }


		$directory='../finished_images/order_'.$order_id;
    if($name=mkdir($directory,true))
		{
			echo '<script>console.log("true")<script>';
		}
		else {
			echo '<script>console.log("false")<script>';
		}
		if($service == 1)
		{
		mkdir($directory.'/standard_photos');
		$root_dir=$directory.'/standard_photos';
	  }
		else if($service == 2)
		{
		mkdir($directory.'/floor_plans');
		$root_dir=$directory.'/floor_plans';
   	}
		else if($service == 3)
		{
		mkdir($directory.'/Drone_photos');
			$root_dir=$directory.'/Drone_photos';
	  }
		else {
			mkdir($directory.'/HDR_photos');
				$root_dir=$directory.'/HDR_photos';
		}
	  $target_path =$root_dir."/".$targetFile;
		if(move_uploaded_file($source_path, $target_path)) {


mysqli_query($con,"update image_naming set downloaded_raw_image_name='$targetFile' where order_id='$order_id' and downloaded_raw_image_name='$fileName'");

			$sql 			=			"INSERT INTO `img_upload`( `img`, `order_id`, `raw_images`, `finished_images`, `service_id`,`updated_on`,`uploaded_by_id`,`uploaded_by_user`) VALUES ('$targetFile',$order_id,0,1,$service,now(),$user_id,'$user_type')";
			$result 		=			mysqli_query($con, $sql);
			mysqli_query($con,"INSERT INTO `image_naming`(`order_id`, `image_name`,`description`) VALUES ($order_id,'$targetFile','$picture_name')");
			if($result) {
				echo "File uploaded successfully";
			}
		}

		}
		catch(Exception $e) {
  console.log('Message: ' .$e->getMessage());
}
	}
?>
