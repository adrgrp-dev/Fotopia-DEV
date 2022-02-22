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

 $mail->Subject = "Editor Created successfully";
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">EDITOR CREATED SUCCESSFUL</td><td align=\"right\">".$_SESSION['support_team_email']."<br>".$_SESSION['support_team_phone']."</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.="
 Hello {{Realtor_Name}},<br>

 You are successfully created SubCSR in your company  <br>
 You will be notified in email when Company approved your registration. <br />
 you can resetpassword using secret code <b>{{project_url}}</b>.
 <a href='http://fotopia.adrgrp.com/photo/admin/resetPassword.php?email={{email}}&secret_code={{project_url}}' target='_blank'>ResetPassword</a>
 <br><br><span style=\"font-size:10px;font-weight:bold;\">*This is an auto generated email notification from Fotopia. Please do not reply back to this email. For any support please write to support@fotopia.no</span><br><br>
Thanks,<br>
Fotopia Team.";


   $mail->Body=str_replace('{{project_url}}',$z, $mail->Body);
	 $mail->Body=str_replace('{{Realtor_Name}}',$x, $mail->Body);
	 $mail->Body=str_replace('{{email}}',$y, $mail->Body);

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

function getName($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
} ?>
<?php
//Login Check
if(isset($_REQUEST['signupbtn']))
{
	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$email=$_REQUEST['email'];
	$org=$_REQUEST['org'];
	$contactno=$_REQUEST['contactno'];
	$photographer_id=$_REQUEST['photographer_id'];

$pc_admin_id=$_SESSION['loggedin_id'];
	$email_verification_code=getName(10);



		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"insert into editor (first_name,last_name,email,organization_name,contact_number,registered_on,pc_admin_id,photographer_id)values('$fname','$lname','$email','$org','$contactno',now(),'$pc_admin_id','$photographer_id')");

	//echo "select * from user_login where email='$email' and password='$pass'";
   email($fname,$email,$email_verification_code);


	header("location:csr_list1.php?e=1");

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage8" data-sub-height="238">
            <div class="row">


			<div class="col-md-2">

<br>
				<?php

				include "sidebar.php";
			?>

			<script>
function validate_email(val)
{
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {

        var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
	$("#Email_exist_error").html("E-posten er allerede i bruk, vennligst velg en annen e-post og fortsett");
		}
		else
		{
		$("#Email_exist_error").html("Email already in use, please choose different email and continue");
		}
	   $("#Email_exist_error").show();
	   $("#email").val("");
	    $("#email").focus();
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
</script>
			</div>
                <div class="col-md-8" style="padding-top:30px;">








						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()"  style="background:#000;color:#FFF;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;padding:20px;">
<div class="col-md-12"><h5 align="center" adr_trans="label_create_editor"> Create Editor</h5></div>



  						<div class="col-md-6">
                                  <p adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" minlength="5" maxlength="20" class="form-control form-value" required="">
                              </div>

  							<div class="col-md-6">
                                  <p adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="">
                              </div>



                              <div class="col-md-6">
                                  <p adr_trans="label_email">Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off" onblur="this.value=this.value.trim();validate_email(this.value)" class="form-control form-value" required="">

 															</div>


  							 <div class="col-md-6">
                                  <p adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" required="">
                              </div>

                     <div class="col-md-6">
                                <p id="label_organization"  adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" minlength="5" maxlength="20" class="form-control form-value" required="" >
                            </div>

          <div class="col-md-6">

                                <p adr_trans="label_photographer">Photogapher</p>
                                <input id="photogapher" name="photogapher" placeholder="Photogapher" type="text" autocomplete="off" value="<?php echo $_SESSION['loggedin_name']; ?>" class="form-control form-value" readonly required="" >
                            </div>

  						 <div class="row">
                              <div class="col-md-12"><center><hr class="space s">

  							<div class="error-box" style="display:none;">
                              <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                          </div>

  						 <button class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn" adr_trans="label_create"><i class="fa fa-sign-in"></i>Create</button>
                         &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn" href="csr_list1.php" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>
  </center>
  					   </div>

					   </form>

                          </div>


                  </div>


              </div>

        <script>


       </script>


		<?php include "footer.php";  ?>
