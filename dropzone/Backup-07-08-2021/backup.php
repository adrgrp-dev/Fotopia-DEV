
<?php

	include "connection1.php";



	// ------------- Check if file is not empty ------------
	if(!empty($_FILES)) {
		$order_id=$_REQUEST['id'];
		$service=$_REQUEST['type'];




		$allowed 				=			 array('png', 'jpg');

		$fileName 				=			$_FILES['file']['name'];

		$source_path 			=			$_FILES['file']['tmp_name'];

		$fileExtension			=			pathinfo($fileName, PATHINFO_EXTENSION);


		$targetFile				=			time()."-".time()."-".strtolower(str_replace(" ","-",$fileName));
		console.log($targetFile);
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
		else
		{
		mkdir($directory.'/Drone_photos');
			$root_dir=$directory.'/Drone_photos';
	  }
	  $target_path =$root_dir."/".$targetFile;


		if(move_uploaded_file($source_path, $target_path)) {

			$sql =	"INSERT INTO `img_upload`( `img`, `order_id`, `raw_images`, `finished_images`, `updated_on`) VALUES ('$targetFile',$order_id,0,1,now())";

			$result 		=			mysqli_query($con, $sql);
				mysqli_query($con,"INSERT INTO `image_naming`(`order_id`, `image_name`) VALUES ($order_id,'$targetFile')");
			if($result) {
				echo "File uploaded successfully";
			}

		}
	}
?>
