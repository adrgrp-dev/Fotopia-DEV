<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($x,$y)
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
 $mail->Port = $_SESSION['emailPort'];
 //$mail->Port = 465;
 //From email address and name
 $mail->From = $_SESSION['emailUserID'];
 $mail->FromName = "Fotopia";

 //To address and name
 // ;
 // // //Recipient name is optional
 // //;
 // ;
	$mail->addAddress($y);


 //Address to which recipient will reply
 $mail->addReplyTo($_SESSION['emailUserID'], "Reply");

 //CC and BCC
 //$mail->addCC("cc@example.com");
 //$mail->addBCC("bcc@example.com");

 //Send HTML or Plain Text email
 $mail->isHTML(true);

 $mail->Subject = "Security code to update your email ID";
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Security Code to Change Email</td><td align=\"right\">".$_SESSION['support_team_email']."<br>".$_SESSION['support_team_phone']."</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.="Dear {{username}}<br>
A request to update your login email address has been submitted.<br>  
Please find the security code to change your login email for Fotopia here.<br>
<span style='color:blue'>{{security code here }}</span><br>


<br><br><span style=\"font-size:10px;font-weight:bold;\">*This is an auto generated email notification from Fotopia. Please do not reply back to this email. For any support please write to support@fotopia.no</span><br><br>
Thanks,<br>
Fotopia Team.";

     $mail->Body=str_replace('{{username}}', $_SESSION['loggedin_name'] , $mail->Body);
	 $mail->Body=str_replace('{{security code here }}', $x , $mail->Body);

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
$loggedin_id=$_SESSION['loggedin_id'];

$user=mysqli_query($con,"select * from user_login where id='$loggedin_id'");
$user1=mysqli_fetch_array($user);
$pc_admin_id=$user1['pc_admin_id'];
$user2=mysqli_query($con,"select * from admin_users where id='$pc_admin_id'");
$user4=mysqli_fetch_array($user2);
@$organization_name=@$user4['organization_name'];
if(isset($_REQUEST['changepass']))
{
$newpass=$_REQUEST['newpass'];
$oldpass=$_REQUEST['oldpass'];
$id=$_SESSION['loggedin_id'];



$currentpass=$user1['password'];

if($oldpass!=$currentpass)
{
header("location:change_email_password.php?i=1");
exit;
}

mysqli_query($con,"update user_login set password='$newpass' where id='$id'");
header("location:change_email_password.php?u=1");
}

if(isset($_REQUEST['sendcode']))
{

$newemail=$_REQUEST['newemail'];

$six_digit_random_number = mt_rand(100000, 999999);

$_SESSION['email_sc']=$six_digit_random_number;
$_SESSION['email_new']=$newemail;

//send an email to above email id with security code <br />
// Sub : Security code to update your email
// Your security code to change your login email in Fotopia is {{security code ehre }}.
//Please enter the security code in the change email screen and continue.
email($_SESSION['email_sc'],$_SESSION['email_new']);

header("location:change_email_password.php?sc2=1");


}


if(isset($_REQUEST['changeprofile']))
{
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$org=$_REQUEST['org'];
$id=$_SESSION['loggedin_id'];
mysqli_query($con,"update user_login set first_name='$fname',last_name='$lname',organization_name='$org' where id='$id'");
header("location:change_email_password.php?pu=1");

}
if(isset($_REQUEST['updateemail']))
{
$sc=$_SESSION['email_sc'];
$security_code=$_REQUEST['security_code'];
$emailnew=$_SESSION['email_new'];
if($sc==$security_code)
{
$id=$_SESSION['loggedin_id'];
mysqli_query($con,"update user_login set email='$emailnew' where id='$id'");

unset($_SESSION['email_sc']);
unset($_SESSION['email_new']);

header("location:change_email_password.php?eu=1");

}
else
{
header("location:change_email_password.php?isc=1");

}


}



?>

<style>

#calendar
{
background-color:#FFFFFF;
}

table td[class*="col-"], table th[class*="col-"]
{
background:#EEE;

}

.gmailEvent0
{
background:#D9534F!important;
color:white!important;
padding-left:5px;
}
.active
{
/*background:none!important;*/
opacity:1!important;

}
#myAcc td,th,#changeemail td,th,#changePassword td,th
{
padding:5px!important;
font-weight:500!important;
}


@media only screen and (max-width: 600px) {
#changeemail,#changePassword,#changePersonal
{
width:100%!important;
height:250px;
}
}
</style>
<script>
function validate()
{

var newpass=$("#newpass").val();
var confirmpass=$("#confirmpass").val();

if(newpass!=confirmpass)
{
$("#passmsg").show();
$("#confirmpass").val("");
$("#newpass").val("");
return false;
}
$("#passmsg").hide();
return true;
}



function validate_email(val)
{

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {

       $("#Email_exist_error").html("Email already in use, Choose different email and continue");
	   $("#Email_exist_error").show();
	   $("#newemail").val("");
	    $("#newemail").focus();

     }
     else
     {
      $("#Email_exist_error").html();
	  $("#Email_exist_error").hide();

     }
    }
  };
  xhttp.open("GET","validate_email.php?id="+val,true);
  xhttp.send();
}

function showMore()
{
$("#moreInfoText").toggle(1000);
}


</script>
<?php include "header.php";  ?>
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s" />
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">

<hr class="space s" />

<table class="table-stripped" id="myAcc" style="color: #000;background: #FFF;border-radius:10px;width:100%;font-weight:200; font-size:15px;" align="center">
<tr><td colspan="3" align="center"><h4 adr_trans="label_settings">Settings</h4>

<?php if(@isset($_REQUEST["u"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-success" adr_trans="label_pw_updated">Password updated successfully</div></center>
                        </div>
						<?php }  ?>

						<?php if(@isset($_REQUEST["pu"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-success" adr_trans="label_pw_detail_updated">Personal details updated successfully</div></center>
                        </div>
						<?php }  ?>

						<?php if(@isset($_REQUEST["i"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-danger" adr_trans="label_password_incorrect">Old Password is Incorrect, Please try again.</div></center>
                        </div>
						<?php }  ?>

<?php if(@isset($_REQUEST["eu"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-success" adr_trans="label_email_updated">Email updated successfully.</div></center>
                        </div>
						<?php }  ?>
<tr><td style="padding-left:20px;"><h5 adr_trans="label_first_name">First Name</h5></td><td><?php echo $user1['first_name']; ?><br /></td></tr>
<tr><td style="padding-left:20px;"><h5 adr_trans="label_last_name">Last  Name</h5></td><td>  <?php echo $user1['last_name']; ?><br /></td></tr>
<tr><td style="padding-left:20px;"><h5 adr_trans="label_organization">Organization</h5></td><td>  <?php if($_SESSION['user_type']!='Photographer') {echo $user1['organization_name'];} else { echo $organization_name; } ?><td align="left">
<?php if($_SESSION['user_type']!='Photographer'){?><a href="#changePersonal" id="uname" class="lightbox link btn  adr-save" data-lightbox-anima="show-scale" style="font-size:13px;text-decoration:none;color:blue;" adr_trans="label_update">Update</a></td></td></tr><?php } ?>


<tr><td style="padding-left:20px;"><h5>Role </h5></td><td> <?php echo $user1['type_of_user']; ?><br /></td><td align="left">
<a href="#" id="moreInfo" onClick="showMore()" style="color:blue;" adr_trans="label_more" >More</a></td></tr>

<tr><td colspan="3"><span id="moreInfoText" style="display:none" adr_trans="label_change_role">To change your role, kindly click on sign up in the home screen and register as a new user.</span></td></tr>
</td></tr>
<tr><td style="padding-left:20px;"><h5 adr_trans="label_user_name">User Name </h5></td><td> <?php echo $user1['email']; ?><br /></td><td><a href="#changeemail" id="uname1" class="lightbox link btn adr-save" data-lightbox-anima="show-scale" style="font-size:13px;text-decoration:none;color:blue;" adr_trans="label_update">Update</a><br /></td></tr>
<tr><td style="padding-left:20px;padding-bottom:20px;"><h5 adr_trans="label_new_password">Password</h5></td><td>

 <?php

 $len  = floor(strlen($user1['password'])/2);

    echo substr( $user1['password'],0, $len) . str_repeat('*', $len)
  ?>

 <br /></td><td><a href="#changePassword" class="lightbox link btn adr-save" data-lightbox-anima="show-scale" id="upass" style="font-size:13px;text-decoration:none;color:blue;" adr_trans="label_update">Update</a><br /></td></tr>

</table>





<div id="changePersonal" class="box-lightbox white" style="color: #000;background: #FFF;padding:25px;height:300px; width:500px;border-radius:10px">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="" adr_trans="label_change_personal" >Change personal details</h5>

                            <hr class="space s">
				<table class="table table-responsive">


				</td></tr>
				<form name="changepersonal" method="post" action="">
	<tr><td adr_trans="label_first_name">First Name</td><td>:</td><td><input type="text" name="fname" class="form-control" minlength="5" maxlength="20" required value="<?php echo $user1['first_name']; ?>" /></td></tr>

	<tr><td adr_trans="label_last_name">Last Name</td><td>:</td><td><input type="text" name="lname" class="form-control" minlength="1" maxlength="20" required value="<?php echo $user1['last_name']; ?>" /></td></tr>

	<tr><td adr_trans="label_organization">Organization</td><td>:</td><td><input type="text" name="org" class="form-control" required value="<?php echo $user1['organization_name']; ?>" /></td></tr>

				<tr><td colspan="3" align="center">
				<input type="hidden" name="id" value="<?php echo $user1['id']; ?>" />
				<input type="submit" name="changeprofile" value="Update Profile" class="btn btn-primary adr-save" style="border-radius:20px 20px 20px 20px;background:#0275D8" /></td></tr>
				</form>

				</table>

</div></div>





<div id="changePassword" class="box-lightbox white" style="color: #000;background: #FFF;padding:25px;height:300px; width:500px;border-radius:10px">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="" adr_trans="label_change_password" >Change Password
							<span id="companyName" style="text-transform:uppercase"></span></h5>
								<p align="center" class="text-danger" id="passmsg" style="display:none" adr_trans="label_password_msg">New Password and Confirm New Password must be same.</p>


                            <hr class="space s">
				<table class="table-stripped">


				</td></tr>
				<form name="changepass" method="post" action="" onsubmit="return validate()">
				<tr><td adr_trans="label_old_password">Old Password</td><td>:</td><td><input type="password" name="oldpass" class="form-control" required /></td></tr>

				<tr><td adr_trans="label_new_password1">New Password</td><td>:</td><td><input type="password" name="newpass" id="newpass" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/></td></tr>
				<tr><td adr_trans="label_new_password_confirm">Confirm New Password</td><td>:</td><td><input type="password" name="confirmpass" id="confirmpass" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/></td></tr>
				<tr><td colspan="3" align="center">
				<input type="submit" name="changepass" value="Update Password" class="btn btn-primary adr-save" style="border-radius:20px 20px 20px 20px;background:#0275D8" /></td></tr>
				</form>

				</table>

</div></div>





				<div id="changeemail" class="box-lightbox" style="color: #000;background: #FFF;height:330px;width:500px;border-radius:10px">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="" adr_trans="label_change_email" >Change Email
							<span id="companyName" style="text-transform:uppercase"></span></h5>

							<?php if(@isset($_REQUEST["sc2"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-success" adr_trans="label_security_email">Security code sent to your new email.</div></center>
                        </div>
						<?php }  ?>
						<?php if(@isset($_REQUEST["isc"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-danger" adr_trans="label_security_invalid">Invalid Security code.</div></center>
                        </div>
						<?php }  ?>

						<p style="margin-left:20px;color:red!important;display:none;font-style:italic;" class="text-danger" id="Email_exist_error" align="center"></p>
						<hr class="space s">
				<table class="table-stripped">


				</td></tr>
				<form name="verifyemail" method="post" action="">
				<tr><td adr_trans="label_new_email">New Email</td><td>:</td><td><input type="email" name="newemail" id="newemail" class="form-control" required onblur="this.value=this.value.trim();validate_email(this.value)" /></td></tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" name="sendcode" value="Send Verification Code" class="btn btn-warning adr-cancel" style="border-radius:20px 20px 20px 20px; background:#F0AD4E" /></td></tr>
				</form>
				<form name="changeemail" method="post" action="">
				<tr><td adr_trans="label_security_code">Security Code</td><td>:</td><td><input type="text" name="security_code" maxlength="6" class="form-control" required /></td></tr>


				<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" name="updateemail" value="Update Email" class="btn btn-primary adr-save" style="border-radius:20px 20px 20px 20px; background:#0275D8" />
 
				<br />
				</td></tr>
				</form>
				</table>
				</div></div>







        </div>







 </div></div>
<?php if(@isset($_REQUEST["sc"]) || @isset($_REQUEST["isc"])) { ?>
                     <script>
					 $(document).ready(function() {
					 $("#uname").click();
					 });
					 </script>
						<?php }  ?>



          <?php if(@isset($_REQUEST["sc2"])) { ?>
                               <script>
                     $(document).ready(function() {
                     $("#uname1").click();

                     });
                     </script>
                      <?php }  ?>

		<?php include "footer.php";  ?>
