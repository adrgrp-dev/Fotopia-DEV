<?php

include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($x,$y,$z,$v,$k,$status_id)
{
	/* Exception class. */
	require 'C:\PHPMailer\src\Exception.php';

	/* The main PHPMailer class. */
	require 'C:\PHPMailer\src\PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'C:\PHPMailer\src\SMTP.php';

	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	//$mail->Username = 'sidambara.selvan@adrgrp.com'; //paste one generated by Mailtrap
	//$mail->Password = 'Selvan1#$'; //paste one generated by Mailtrap
	$mail->Username = 'test.deve@adrgrp.com';
	$mail->Password = 'adrgrp@123';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	//$mail->Port = 465;
	//From email address and name
	$mail->From = "test.deve@adrgrp.com";
	$mail->FromName = "Fotopia";

	//To address and name
	// $mail->addAddress("ssselvan.83@gmail.com", "Selvan");
	// //$mail->addAddress("lakshminarayanan@adrgrp.com","Lakshmi"); //Recipient name is optional
	// //$mail->addAddress("srivatsan@adrgrp.com","Srivatsan");
	 $mail->addAddress($k);
	 $mail->addAddress($v);


	//Address to which recipient will reply
	$mail->addReplyTo("test.deve@adrgrp.com", "Reply");

	//CC and BCC
	//$mail->addCC("cc@example.com");
	//$mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Editor Upload successfully";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">EDITOR UPLOAD SUCCESSFUL</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";
	$mail->Body.="
Hello {{Photographer_Name}},<br>

Finished images has been uploaded by {{Editor_email}} for the order reference
#F{{orderId}}, for further details please Login in to
<a href='{{project_url}}' target='_blank'>Fotopia</a>.

<br><br>
Thanks,<br>
Fotopia Team.";

$project_url=$_SESSION['project_url'];
if($status_id==4)
{
	$mail->Body=str_replace('Finished images','Rework finished images', $mail->Body);
}

	$mail->Body=str_replace('{{project_url}}',$project_url, $mail->Body);
  $mail->Body=str_replace('{{Photographer_Name}}', $x , $mail->Body);
	$mail->Body=str_replace('F{{orderId}}',$z, $mail->Body);
  	$mail->Body=str_replace('{{Editor_email}}',$y, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";
	//echo $mail->Body;exit;
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
email($photographer_Name,$email_id,$order_id,$email_address,$realtor_email,$status_id);
mysqli_query($con,"UPDATE `raw_images` SET status=6 WHERE order_id=$order_id and service_name=$service");
mysqli_query($con,"INSERT INTO `user_actions`(`module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`, `action_date`) VALUES ('Finished images','Upload','$email_id',$photographer_id,$photographer_id,now())");
mysqli_query($con,"INSERT INTO `user_actions`(`module`, `action`, `action_done_by_name`, `action_done_by_id`, `Realtor_id`, `action_date`) VALUES ('Finished images','Upload','$email_id',$realtor_id,$realtor_id,now())");
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
