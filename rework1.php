<?php

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($x,$y,$z,$v,$k)
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

	$mail->Subject = "rework assigned to editor";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">REWORK SUCCESSFUL</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";
	$mail->Body.="
  Hello {{Photographer_Name}},<br>

You have been assigned for Photo Rework from {{Realtor_Name}} through
Fotopia with the order reference # F{{orderId}}.<br>

For further details please Login in to
<a href='{{project_url}}' target='_blank'>Fotopia</a>.

<br><br>
Thanks,<br>
Fotopia Team.";

	$mail->Body=str_replace('{{project_url}}',$_SESSION['project_url'], $mail->Body);
  $mail->Body=str_replace('{{Photographer_Name}}', $x , $mail->Body);
	$mail->Body=str_replace('F{{orderId}}',$z, $mail->Body);
  	$mail->Body=str_replace('{{Realtor_Name}}',$y, $mail->Body);
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


$file =$_REQUEST['id'];
$file_exp=explode("/",$file);
$order_id=$_REQUEST['od'];


// print_r($file_exp);
if($data1=@mkdir("raw_images/".$file_exp[2]))
{
	// console.log("created");
}
	if($data1=@mkdir("raw_images/".$file_exp[2]."/".$file_exp[3]))
	{
		// console.log("reated");
	}
$destinationFilePath ="./raw_images/".$file_exp[2]."/".$file_exp[3]."/".$file_exp[4];
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
if(rename($file,$destinationFilePath) ) {


     mysqli_query($con,"UPDATE `raw_images` SET status=4 WHERE order_id=$order_id and service_name=$service");

     mysqli_query($con,"UPDATE `img_upload` SET `raw_images`=1,`finished_images`=0 WHERE img='$file_exp[4]'");

     $get_order_query=mysqli_query($con,"SELECT * FROM `orders` WHERE id=$order_id");
     $get_order=mysqli_fetch_assoc($get_order_query);
     $photographer_id=$get_order['photographer_id'];
     $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
     $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
     $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
		 $photographer_email=$get_name['email'];
     $realtor_id=$get_order['created_by_id'];
     $get_photgrapher_name_query1=mysqli_query($con,"SELECT * FROM user_login where id='$realtor_id'");
     $get_name1=mysqli_fetch_assoc($get_photgrapher_name_query1);
     $realtor=$get_name1["first_name"]."".$get_name1["last_name"];
		 $editor_email_query=mysqli_query($con,"SELECT * FROM `raw_images` WHERE order_id=$order_id and service_name=$service");
		 $editor_email=mysqli_fetch_assoc($editor_email_query);
		 $editor=$editor_email['editor_email'];
     if($get_order['status_id']==4)
		 {
		 email($photographer_Name,$realtor,$order_id,$editor,$photographer_email);
	   }
     mysqli_query($con,"UPDATE `orders` SET status_id=4 WHERE id=$order_id");
     }

    ?>
