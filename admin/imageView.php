<?php
    require_once "connection1.php";
    if(isset($_GET['image_id'])) {
        echo $sql = "SELECT profile_pic,profile_pic_image_type FROM user_login WHERE id=" . $_GET['image_id'];
		$result = mysqli_query($con, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type:".$row['profile_pic_image_type']);
      //  echo $row["profile_pic"];
	  
	  echo "<img src=\"data:<?php echo $row['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($row['profile_pic']); ?>\" width=\"50\" height=\"50\" />";
				
		//echo base64_decode($row["profile_pic"]);
	}
	mysqli_close($conn);
?>