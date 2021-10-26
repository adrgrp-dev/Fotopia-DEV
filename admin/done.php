<?php

include "connection1.php";
$order_id=$_REQUEST['id'];

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
  $get_template_query=mysqli_query($con,"select * from email_template where pc_admin_id='$pc_admin_id' and template_title='Order Completed'");
  $get_template=mysqli_fetch_array(@$get_template_query);
  $order_completed_template=@$get_template['template_body_text'];

  if($get_detail['created_by_type']!="Realtor")
  {
    $mail->addAddress($PCAdmin_email);
    $mail->addCC($csr_email);
    $mail->addCC($photographer_email);
  }
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");
	$mail->isHTML(true);

	$mail->Subject = "Order Completed";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">ORDER COMPLETED SUCCESSFULLY</td>
  <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";

	$mail->Body.=$order_completed_template;
  $mail->Body.="</br>Kindly check the order #{{Order_ID}} in your orders page for details</br>
Thank you for continued support.
 <br><br>
Thanks,<br>
Fotopia Team.";
 $mail->Body=str_replace('{{Order_ID}}',$order_id, $mail->Body);

	$mail->Body.="<br><br></td></tr></table></html>";


	 // echo $mail->Body;
	 // exit;



	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		// echo $e->getMessage();
	  //   echo "Mailer Error: " . $mail->ErrorInfo;
	}
}
email($order_id,$con);
$invoice_check_query=mysqli_query($con,"select * from orders where id=$order_id");
$invoice_check=mysqli_fetch_assoc($invoice_check_query);

mysqli_query($con,"UPDATE `orders` SET status_id=3 WHERE id=$order_id");
mysqli_query($con,"UPDATE `raw_images` SET status=3 WHERE order_id=$order_id");


 ?>
