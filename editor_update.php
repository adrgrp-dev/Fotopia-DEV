<?php

include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($order_id,$con)
{
	/* Exception class. */
	require 'C:\PHPMailer\src\Exception.php';

	/* The main PHPMailer class. */
	require 'C:\PHPMailer\src\PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'C:\PHPMailer\src\SMTP.php';

	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = $_SESSION['emailHost'];
	$mail->SMTPAuth = true;
	// //paste one generated by Mailtrap
	// //paste one generated by Mailtrap
	$mail->Username =$_SESSION['emailUserID'];
	$mail->Password =$_SESSION['emailPassword'];
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	//$mail->Port = 465;
	//From email address and name
	$mail->From = $_SESSION['emailUserID'];
	$mail->FromName = "Fotopia";

	$order_id=$order_id;
	 $get_orderdetail_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
	 $get_detail=mysqli_fetch_array($get_orderdetail_query);
	 $pc_admin_id=$get_detail['pc_admin_id'];
	$get_pcadmin_profile_query=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
	$get_profile=mysqli_fetch_assoc($get_pcadmin_profile_query);
	$pcadmin_email=$get_profile['email'];
	$pcadmin_contact=$get_profile['contact_number'];
	 $get_pcadmindetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin_id'");
	 $get_pcadmindetail=mysqli_fetch_assoc($get_pcadmindetail_query);
	 $PCAdmin_email=$get_pcadmindetail['email'];
	 $photographer_id=@$get_detail['photographer_id'];
	 $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
	 $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
	 $photographer_email=@$get_name["email"];
	 $csr_id=$get_name['csr_id'];
	 $get_csrdetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$csr_id'");
	 $get_csrdetail=mysqli_fetch_assoc($get_csrdetail_query);
	 $csr_email=$get_csrdetail['email'];
	$realtor_id=$get_detail['created_by_id'];
	$get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtor_id'");
	$get_realtor_name=mysqli_fetch_assoc($get_realtor_name_query);
	 $realtor_email=$get_realtor_name['email'];
	 $realtor_Name=$get_realtor_name['first_name'];

	//To address and name
	// ;
	// // //Recipient name is optional
	// //;
	if($get_detail['created_by_type']=="Realtor")
	{
		 $mail->addAddress($realtor_email);
		 $mail->addCC($PCAdmin_email);
		 $mail->addCC($csr_email);
		 $mail->addCC($photographer_email);
	}
	else{
		$mail->addAddress($PCAdmin_email);
		$mail->addCC($csr_email);
	  $mail->addCC($photographer_email);
	}


	//Address to which recipient will reply
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");

	//CC and BCC
	//$mail->addCC("cc@example.com");
	//$mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Editor has uploaded finished images";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">EDITOR UPLOADED FINISHED IMAGES</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";
	$mail->Body.="
Hello {{realtor_Name}},<br>

Finished images has been uploaded  for the order reference
#{{orderId}}, for further details please Login in to
<a href='{{project_url}}' target='_blank'>Fotopia</a>.

<br><br>
Thanks,<br>
Fotopia Team.";

$project_url=$_SESSION['project_url'];
if($get_detail['status_id']==4)
{
	$mail->Body=str_replace('Finished images','Rework finished images', $mail->Body);
}

	$mail->Body=str_replace('{{project_url}}',$project_url, $mail->Body);
  $mail->Body=str_replace('{{realtor_Name}}', $realtor_Name , $mail->Body);
	$mail->Body=str_replace('{{orderId}}',$order_id, $mail->Body);
  //	$mail->Body=str_replace('{{Editor_email}}',$y, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";
//	echo $mail->Body;exit;
	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		echo $e->getMessage();
	    echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

$order_id=$_REQUEST["id"];
$service=$_REQUEST["type"];

$get_order_query=mysqli_query($con,"SELECT * FROM `orders` WHERE id=$order_id");
$get_order=mysqli_fetch_assoc($get_order_query);

$photographer_id=$get_order["photographer_id"];
$get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
$get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
$photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
$email_address=$get_name['email'];
$realtor_id=$get_order["created_by_id"];
if($get_order['created_by_id']!=$get_order['pc_admin_id']||$get_order['created_by_id']!=$get_order['csr_id'])
{
$get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtor_id'");
$get_name1=mysqli_fetch_assoc($get_realtor_name_query);
$realtor_email=$get_name1['email'];
}
else{
	$get_realtor_name_query1=mysqli_query($con,"SELECT * FROM admin_users where id='$realtor_id'");
	$get_name1=mysqli_fetch_assoc($get_realtor_name_query1);
	$realtor_email=$get_name1['email'];
}

$get_rawimages_query=mysqli_query($con,"SELECT * FROM `raw_images` WHERE order_id=$order_id");
$get_images=mysqli_fetch_assoc($get_rawimages_query);
$email_id=$get_images["editor_email"];
$status_id=$get_order["photographer_id"];
email($order_id,$con);
mysqli_query($con,"UPDATE `raw_images` SET status=6 WHERE order_id=$order_id and service_name=$service");
mysqli_query($con,"INSERT INTO `user_actions`(`module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `photographer_id`, `action_date`) VALUES ('Finished images','Upload','$email_id',$photographer_id,'Photographer',$photographer_id,now())");
mysqli_query($con,"INSERT INTO `user_actions`(`module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`, `action_date`) VALUES ('Finished images','Upload','$email_id',$realtor_id,'Realtor',$realtor_id,now())");
mysqli_query($con,"DELETE FROM `img_upload` WHERE order_id=$order_id and raw_images=1");
mysqli_query($con,"UPDATE `orders` SET status_id=2 where id=$order_id ");
if($service == 1)
{
  $service_name="standard_photos";
}
elseif($service == 2)
{
  $service_name="floor_plans";
}
elseif($service == 3) {
  $service_name="Drone_photos";
}
else {
	$service_name="HDR_photos";
}
echo $service;
 $dir="./raw_images/order_$order_id/$service_name";
 echo $dir;

  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
          rrmdir($dir. DIRECTORY_SEPARATOR .$object);
        else
          unlink($dir. DIRECTORY_SEPARATOR .$object);
      }
    }

  }
	$dir1="./rework_images/order_$order_id/$service_name";
	if (is_dir($dir1)) {
		$objects = scandir($dir1);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (is_dir($dir1. DIRECTORY_SEPARATOR .$object) && !is_link($dir1."/".$object))
					rrmdir($dir1. DIRECTORY_SEPARATOR .$object);
				else
					unlink($dir1. DIRECTORY_SEPARATOR .$object);
			}
		}

	}
?>
