<?php
ob_start();

include "connection1.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Login Check
if(isset($_REQUEST['loginbtn']))
{
	header("location:index.php?failed=1");
}


function email($y,$z)
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
	// $mail->addAddress("bharathwaj.v@adrgrp.com","Bharath");
	 $mail->addAddress($z);


	//Address to which recipient will reply
	$mail->addReplyTo("test.deve@adrgrp.com", "Reply");

	//CC and BCC
	//$mail->addCC("cc@example.com");
	//$mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Approved successfully";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"http://fotopia.adrgrp.com/logo.png\" /></td><td align=\"center\" class=\"titleCss\">ADMIN APPROVED SUCCESSFUL</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";



	$mail->Body.="Dear {{Registrered_User_Name}},<br><br>

Welcome to Fotopia!<br><br>

Your account has been approved by Fotopia Admin Team.<br>
<a href='{{project_url}}/login.php' target='_blank'>click here</a>
to login in to your Fotopia account.
<br><br>
Thanks,<br>
Fotopia Team.";
	$mail->Body=str_replace('{{project_url}}', $_SESSION['project_url'] , $mail->Body);
	$mail->Body=str_replace('{{Registrered_User_Name}}',$y, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";
	 // echo $mail->Body;exit;



	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		echo $e->getMessage();
	    echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

?>



<?php include "header.php";  ?>
	<style>

	</style>
<div class="section-empty bgimage7">
            <div class="row">


			<div class="col-md-2" style="padding-left:10px;">

	<?php
	if($_SESSION["admin_loggedin_type"] == "FotopiaAdmin"){
		include "sidebar.php";
	}
	else{
		include "sidebar.php";
	}
	 ?>


			</div>
                <div class="col-md-5"  style="padding-top:30px;">
                    <h5 class="text-center" style="margin-left:-10px;" id="label_company_details" adr_trans="label_company_details">Company details</h5>

<?php

$loggedin_id=$_SESSION["admin_loggedin_id"];
				$res=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedin_id'");
				$res1=mysqli_fetch_array($res);

				?>

				<?php if(@isset($_REQUEST["u"])) { ?>
                        <div class="success-box" style="display:block;margin-left:150px;">
                            <div class="text-success" id="label_profile_update_msg" adr_trans="label_profile_update_msg">Profile information updated successfully</div>
                        </div>
						<?php }  ?>

					<table class="" aria-busy="false" align="center" style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;margin-left:10px;">

					<tbody>

	  <?php

	  $userExist=mysqli_num_rows($res);

	  if ($userExist == 0) { ?>

	  	<tr><th style="padding-left:20px;">No profile information</th></tr>

	 <?php  }
	 else{

	   ?>

	    <tr><th style="padding-left:20px;"><span adr_trans="label_org_name">Organization name</span></th><th>:</th><td><?php echo @$res1['organization_name']; ?></td></tr>
		 <tr><th style="padding-left:20px;"><span adr_trans="label_org_branch">Organization branch</span></th><th>:</th><td><?php echo @$res1['organization_branch']; ?></td></tr>
		  <tr><th style="padding-left:20px;"><span adr_trans="label_contact_no">Contact number</span></th><th>:</th><td><b><?php echo @$res1['contact_number']; ?></b></td></tr>
		   <tr><th style="padding-left:20px;"><span adr_trans="label_email">Email</span></th><th>:</th><td><?php echo @$res1['email']; ?></td></tr>

			  <tr><th style="padding-left:20px;"><span adr_trans="label_address">Address</span></th><th>:</th><td><?php echo @$res1['address_line1'].", ".@$res1['address_line2']; ?></td></tr>

			   <!-- <tr><th style="padding-left:20px;"><span adr_trans="label_logo">Logo</span></th><th>:</th><td><img src="data:<?php //echo @$res1['logo_image_type']; ?>;base64,<?php //echo base64_encode(@$res1['logo']); ?>" width="50" height="50" /></td></tr> -->
      <tr><th style="padding-left:20px;"><span adr_trans="label_logo">Logo</span></th><th>:</th><td><img src="<?php echo @"../".$res1['logo_image_url'] ?>" width="50" height="50" /></td></tr>
			   <tr><th style="padding-left:20px;"><span adr_trans="label_city">City</span></th><th>:</th><td><?php echo @$res1['city']; ?></td></tr>
			    <tr><th style="padding-left:20px;"><span adr_trans="label_state">State</span></th><th>:</th><td><?php echo @$res1['state']; ?></td></tr>
				 <tr><th style="padding-left:20px;"><span adr_trans="label_zip_code">Zip Code</span></th><th>:</th><td><?php echo @$res1['postal_code']; ?></td></tr>
				  <tr><th style="padding-left:20px;"><span adr_trans="label_country">Country</span></th><th>:</th><td><?php echo @$res1['country']; ?></td></tr>

				    <tr><th style="padding-left:20px;">LinkedIN ID </th><th>:</th><td><?php echo @$res1['linkedin_id']; ?></td></tr>
					<tr><th style="padding-left:20px;">Facebook ID</th><th>:</th><td><?php echo @$res1['facebook_id']; ?></td></tr>
					<tr><th style="padding-left:20px;">Instagram ID</th><th>:</th><td><?php echo @$res1['instagram_id']; ?></td></tr>
					<tr><th style="padding-left:20px;"><span adr_trans="label_about_us">About us</span></th><th>:</th><td><?php echo @$res1['about_us']; ?></td></tr>
					<tr><th style="padding-left:20px;"><span adr_trans="label_skills">Skills</span></th><th>:</th><td><?php echo @$res1['skills']; ?></td></tr>
					<tr><th style="padding-left:20px;"><span adr_trans="label_portfolio_website">Portfolio/Website</span></th><th>:</th><td><?php echo @$res1['portfolio']; ?></td></tr>
					<tr><th style="padding-left:20px;"><span adr_trans="label_set_location">Set location</span></th><th>:</th><td><?php echo @$res1['location']; ?></td></tr>
					<tr><th style="padding-left:20px;"><span adr_trans="label_set_tax">Set tax</span></th><th>:</th><td><?php echo @$res1['tax']." %"; ?></td></tr>

<?php } ?>

				</tbody>
				  </table>
				  <br />
				  <a id="label_add_profile" adr_trans="label_add_profile"  class="anima-button circle-button btn-success btn-sm btn" style="margin-left: 65%;" href="edit_company_profile.php"><i class="fa fa-pencil"></i>Add / Edit profile</a>



 </div>





<?php

if(isset($_REQUEST['updatebtn']))
{

$email_template_title=$_REQUEST['email_template_title'];
$email_template_content=$_REQUEST['email_template_content'];

$email_template=mysqli_query($con,"select * from email_template where pc_admin_id='$loggedin_id' and template_title= '$email_template_title' ");


$template_exist=mysqli_num_rows($email_template);


if($template_exist==0)
{

mysqli_query($con,"insert into email_template(template_title,template_body_text,created_on,last_updated_on,last_updated_by,created_by,pc_admin_id)values('$email_template_title','$email_template_content',now(),now(),'$loggedin_id','$loggedin_id','$loggedin_id')");

}

else
{

	$get_email_template=mysqli_fetch_array($email_template);
	$template_id = $get_email_template['id'];

	mysqli_query($con,"update email_template set template_body_text='$email_template_content',last_updated_on= now(),last_updated_by='$loggedin_id' where id='$template_id'");
}

//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,$loggedin_id,now())");


header("location:company_profile.php?r=1");
}


 ?>

 <script>

function get_email_content()
{
  var title= $('#email_template_title').val();
  var logged_in_id= $('#logged_in_id').val();

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
       $("#email_template_content").html(this.responseText);
    }
  };
  xhttp.open("GET","get_email_content.php?id="+logged_in_id+"&con="+title,true);
  xhttp.send();
}

 </script>

<div class="col-md-5"  style="padding-top:60px;">



<table style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;border-radius:25px 25px 25px 25px;opacity:0.7;width:90%;" align="center"><tr><td style="padding:20px;">
	 <h5 class="text-center" style="margin-left:-10px;color:#000!important;" adr_trans="label_email_settings" >Email Settings</h5>

<?php if(@isset($_REQUEST["r"])) { ?>
                        <div class="success-box" style="display:block;margin-left:140px;">
                            <div class="text-success" id="label_email_template_update"
	 adr_trans="label_email_template_update" >Email content updated successfully</div>
                        </div>
						<?php }  ?>

<input type="hidden" name="logged_in_id" id="logged_in_id" value="<?php echo $loggedin_id ?>" />

<form name="profile" method="post" action="" enctype="multipart/form-data">

 								<br>

 								<div class="col-md-12">
                                <p adr_trans="label_select_title"><b>Select Title</b></p>
                                <select name="email_template_title" id="email_template_title" class="form-control form-value" onclick="get_email_content()" onchange=" get_email_content()" required="">

                                <option value="" selected="" disabled="">Select an email title</option>
                                <option value="Order assigned">Order assigned</option>
								<option value="Order confirmation">Order confirmation</option>
								<option value="Order declined">Order declined</option>
								<option value="Appointment changed">Appointment changed</option>
								<option value="Raw images uploaded">Raw images uploaded</option>
								<option value="Order completed">Order completed</option>
								<option value="New user created">New user created</option>
								<option value="Inviting new clients">Inviting new clients</option>
								<option value="Rework">Rework</option>
								<option value="Realtor discount">Realtor discount</option>


							</select>
								</div>

								<div class="col-md-12">
                                <p adr_trans="label_email_content"><b>Email content</b></p>
                                <textarea id="email_template_content" name="email_template_content"  class="form-control form-value" required="" rows="3" cols="100"></textarea>
								</div>

								<br><br><br><br><br>

							<div class="col-md-8">

	 						<p align="right" ><br />
							<button class="anima-button circle-button btn-sm btn" type="submit" name="updatebtn" id="label_update_template" adr_trans="label_update_template"><i class="fa fa-sign-in"></i>Update template</button>
							</p>

							</div>


</form>

</table>



 </div>




            </div>


		<?php include "footer.php";  ?>