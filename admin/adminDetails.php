<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($x,$y,$z)
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

 //To address and name
 // ;
 // // //Recipient name is optional
 // //;
 // ;
	$mail->addAddress($z);


 //Address to which recipient will reply
 $mail->addReplyTo("test.deve@adrgrp.com", "Reply");

 //CC and BCC
 //$mail->addCC("cc@example.com");
 //$mail->addBCC("bcc@example.com");

 //Send HTML or Plain Text email
 $mail->isHTML(true);

 $mail->Subject = "Account approved";
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Your account approved successfully.</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.="
 Dear {{Registrered_User_Name}},<br><br>

Welcome to Fotopia!<br><br>

Your account has been approved by Fotopia Admin Team.<br>
<a href='{{project_url}}/login.php' target='_blank'>click here</a>
to login in to your Fotopia account.
<br><br>
Thanks,<br>
Fotopia Team.";

	 $mail->Body=str_replace('{{project_url}}',$_SESSION['project_url'], $mail->Body);
	  $mail->Body=str_replace('{{Registrered_User_Name}}',$y, $mail->Body);

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

//Login Check
if(isset($_REQUEST['loginbtn']))
{
	header("location:index.php?failed=1");
}

if(isset($_REQUEST['approve']))
{
	$id=$_REQUEST['id'];
	$get_user_query=mysqli_query($con,"select * from user_login where id=$id");
	$get_user=mysqli_fetch_assoc($get_user_query);
	$get_users=$get_user['firstname'];
	$get_email=$get_user['email'];
	email($id,$get_users,$get_email);
	mysqli_query($con,"update user_login set email_verified=1 where id='$id'");
	header("location:userDetails.php?success=1&id=$id");
}
?>
<?php include "header.php";  ?>

<div class="section-empty bgimage3">
            <div class="row">


			<div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10"  style="padding-top:30px;">
                    <h5 class="text-center">Admins Details</h5>

					<?php if(@isset($_REQUEST["success"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="alert alert-success">Your have approved the selected user successfully.</div>
                        </div>
						<?php } ?>
<?php
$id=@$_REQUEST['id'];
				$res=mysqli_query($con,"select * from admin_users where id='$id'");
				$res1=mysqli_fetch_array($res);
				?>
					<table class="table table-striped" style="background:#000;color:#FFF;opacity:0.8;width:80%;border-radius:30px 30px 30px 30px!important;">
					<tbody>
      <?php /*?> <tr><th>ID</th><td>:</td><td><?php echo $res1['id']; ?></td></tr><?php */?>
	   <tr><th>Profile Photo</th><td>:</td><td><img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td></tr>
	    <tr><th>First Name</th><td>:</td><td><?php echo $res1['first_name']; ?></td></tr>
		 <tr><th>Last Name</th><td>:</td><td><?php echo $res1['last_name']; ?></td></tr>
		    <tr><th>Email</th><td>:</td><td><?php echo $res1['email']; ?></td></tr>
			 <tr><th>contact Number</th><td>:</td><td><?php echo $res1['contact_number']; ?></td></tr>
			  <tr><th>Address</th><td>:</td><td><?php echo $res1['address_line1']." ".$res1['address_line2']; ?></td></tr>
			   <tr><th>City</th><td>:</td><td><?php echo $res1['city']; ?></td></tr>
			    <tr><th>State</th><td>:</td><td><?php echo $res1['state']; ?></td></tr>
				 <tr><th>Postal Code</th><td>:</td><td><?php echo $res1['postal_code']; ?></td></tr>
				  <tr><th>Country</th><td>:</td><td><?php echo $res1['country']; ?></td></tr>
				    <tr><th>Last Login</th><td>:</td><td><?php echo $res1['last_login']; ?></td></tr>
					<tr><th>Last Login <br>IP Address</th><td>:</td><td><?php echo $res1['last_login_ip']; ?></td></tr>

<tr><td colspan="3" align="center"><a class="anima-button circle-button btn-sm btn" href="admin_users.php"><i class="fa fa-sign-in"></i>Back to Admin list</a></td></tr>
				</tbody>
            </table>
                </div>
            </div>


		<?php include "footer.php";  ?>
