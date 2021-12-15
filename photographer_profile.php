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
	 $mail->addAddress($z);


	//Address to which recipient will reply
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");

	//CC and BCC
	//$mail->addCC("cc@example.com");
	//$mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Approved successfully";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">ADMIN APPROVED SUCCESSFUL</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
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
th.tablehead,td.tablehead
		{
		padding:5px!important;
				padding-left:15px!important;

		text-align:left!important;
		}
	</style>
<div class="section-empty bgimage7">
            <div class="row">
<hr class="space s">

			<div class="col-md-2">
				<script>
				   $(".hidden-xs").css("margin-right":"46px");
				</script>

	<?php

		include "sidebar.php";

	 ?>


			</div>
                <div class="col-md-5"  style="padding-top:20px;">


        <!--  <span id="hide1" style="margin-left: 30px;"><i class="fa fa-minus-circle" id="add" onclick="show1()" aria-hidden="true"></i></span>&nbsp;&nbsp;<b adr_trans="label_company_profile">Company profile</b><br> -->


         <script>

function show1()
{

  if(document.getElementById('table1').style.display == "none")
  {
    document.getElementById('table1').style.display="block";
  }
  else
   {
    document.getElementById('table1').style.display="none";
  }
}


           $('#hide1').click(function(){
            $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
              });
         </script>

                    <!-- <h5 class="text-center" style="margin-left:-10px;">Company profile</h5> -->

<?php

$loggedin_id=$_SESSION["loggedin_id"];
				$res=mysqli_query($con,"select pc_admin_id from user_login where id='$loggedin_id'");
				$res2=mysqli_fetch_array($res);

				$pc_admin_id = $res2['pc_admin_id'];

			$res3 = mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$pc_admin_id'");
			$res1=mysqli_fetch_array($res3);

				?>



					<table id="table1"  style="color: #000;background: #FFF;opacity:0.8;width:100%;border-radius:5px!important;margin-left:10px;padding:10px;height:500px;" cellpadding="10" cellspacing="10">

					<tbody>
					<tr><td colspan="3"><hr class="space xs" /></td></tr>

	  <?php

	  $userExist=mysqli_num_rows($res);

	  if ($userExist == 0) { ?>

	  	<tr><td align="right"  style="font-size: 10px;">No profile information</th></tr>

	 <?php  }
	 else{

	   ?>
<tr><td colspan="3"><h5 class="text-center" style="margin-left:-10px;">Company profile</h5></td></tr> 
	    <tr><td align="right"  style="font-size: 10px;"><img src="<?php echo @"./".$res1['logo_image_url'] ?>" width="50" height="50" /><br /></td><td style="padding-left:5px;padding-right:15px;">&nbsp;</td><td align="left" style="font-size:20px;"><?php echo @$res1['organization_name']; ?>
		 </td></tr>
		 <tr><td colspan="3"><hr class="space xs" /></td></tr>
		 <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_org_branch">Organization branch</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['organization_branch']; ?></td></tr>
		  <tr><td align="right"><span>Organization Number</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['organization_number']; ?></td></tr>
		  <tr><td colspan="3"><hr class="space xs" /></td></tr>

		    <tr><td align="right"  style="font-size: 10px;" adr_trans="label_contact_no">Contact number</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><b><?php echo @$res1['contact_number']; ?></b></td></tr>
		   <tr><td align="right"  style="font-size: 10px;" adr_trans="label_email">Email</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['email']; ?></td></tr>
		   <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_portfolio_website">Portfolio/Website</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['portfolio']; ?></td></tr>

		   <tr><td colspan="3"><hr class="space xs" /></td></tr>
			  <tr><td align="right"  style="font-size: 10px;" adr_trans="label_address">Address</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['address_line1'].", ".@$res1['address_line2']; ?></td></tr>
			   <tr><td align="right"  style="font-size: 10px;" adr_trans="label_city">City</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['city']; ?></td></tr>
			    <tr><td align="right"  style="font-size: 10px;" adr_trans="label_state">State</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['state']; ?></td></tr>
				 <tr><td align="right"  style="font-size: 10px;" adr_trans="label_zip_code">Zip Code</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['postal_code']; ?></td></tr>
				  <tr><td align="right"  style="font-size: 10px;" adr_trans="label_country">Country</td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['country']; ?></td></tr>

			<tr><td colspan="3"><hr class="space xs" /></td></tr>   
			  <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_fb_id">Facebook ID</span><span class="fa fa-facebook" style="margin-left: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['facebook_id']; ?></td></tr>
					<tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_insta_id">Instagram ID</span><span class="fa fa-instagram" style="margin-left: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span></td><td style="padding-left:5px;padding-right:15px;width:30px!important">:</td><td align="left"><?php echo @$res1['instagram_id']; ?></td></tr>
					<tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_twitter_id">Twitter ID</span><span class="fa fa-twitter" style="margin-left: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span></td><td style="padding-left:5px;padding-right:15px;width:30px!important">:</td><td align="left"><?php echo @$res1['twitter_id']; ?></td></tr>
					
					<tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_youtube_id">Youtube ID</span><span class="fa fa-youtube" style="margin-left: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span></td><td style="padding-left:5px;padding-right:15px;width:30px!important">:</td><td align="left"><?php echo @$res1['youtube_id']; ?></td></tr>
					<tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_linkedin_id">LinkedIN ID </span><span class="fa fa-linkedin" style="margin-left: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span></td><td style="padding-left:5px;padding-right:15px;width:30px!important">:</td><td align="left"><?php echo @$res1['linkedin_id']; ?></td></tr>







<?php } ?>
<tr><td colspan="3"><hr class="space xs" /></td></tr>
				</tbody>
				  </table>


 </div>

<div class="col-md-5"  style="padding-top:20px;">
<!--
                   <span id="hide2" style="margin-left: 30px;"><i class="fa fa-minus-circle" id="add" onclick="show2()" aria-hidden="true"></i></span>&nbsp;&nbsp;<b adr_trans="label_my_profile">My profile</b><br>
-->

         <script>

function show2()
{

  if(document.getElementById('table2').style.display == "none")
  {
    document.getElementById('table2').style.display="block";
  }
  else
   {
    document.getElementById('table2').style.display="none";
  }
}


           $('#hide2').click(function(){
            $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
              });
         </script>

<?php

$loggedin_id=$_SESSION["loggedin_id"];
				$res=mysqli_query($con,"select * from photographer_profile where photographer_id='$loggedin_id'");
				$res1=mysqli_fetch_array($res);

				?>


<div id="table2" style="display:block;">

	<?php if(@isset($_REQUEST["u"])) { ?>
                        <div class="success-box" style="display:block;margin-left:150px;">
                            <div class="text-success">Profile information updated successfully</div>
                        </div>
						<?php }  ?>
<table id="table"  style="color: #000;background: #FFF;opacity:0.8;width:95%;border-radius:5px!important;margin-left:10px;padding:10px;height:500px;" cellpadding="10" cellspacing="10">					<tbody>
<tr><td colspan="3"><hr class="space xs" /></td></tr>
	  <?php

	  $userExist=mysqli_num_rows($res);

	  if ($userExist == 0) { ?>

	  	<tr><td align="right"  style="font-size: 10px;">No profile information</th></tr>

	 <?php  }
	 else{

	   ?>
	   <tr><td colspan="3"><h5 class="text-center" style="margin-left:-10px;">My profile</h5></td></tr> 
	   <!-- <tr><td colspan="3"><hr class="space s" /></td></tr> -->
<tr><td align="right"  style="font-size: 10px;width:200px"><img src="data:<?php echo @$res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode(@$res1['profile_pic']); ?>" width="70" height="70" style="border-radius:35px" /><br /></td><td style="padding-left:5px;padding-right:15px;">&nbsp;</td><td align="left" style="font-size:20px;"><?php echo @$res1['first_name']." ".$res1['last_name']; ?>
		 </td></tr>
<tr><td colspan="3"><hr class="space xs" /></td></tr>
			   <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_contact_no">Contact number</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><b><?php echo @$res1['contact_number']; ?></b></td></tr>
			    
			    <tr><td colspan="3"><hr class="space xs" /></td></tr>
			   
			   
				   <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_contact_skills">Skills</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['skills']; ?></td></tr>
				     <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_contact_portfolio">Portfolio</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['portfolio']; ?></td></tr>
					 <tr><td colspan="3"><hr class="space xs" /></td></tr>
			  <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_address">Address</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['address_line1'].", ".@$res1['address_line2']; ?></td></tr>
			   <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_city">City</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['city']; ?></td></tr>
			    <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_state">State</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['state']; ?></td></tr>
				 <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_zip_code">Zip Code</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['postal_code']; ?></td></tr>
				  <tr><td align="right"  style="font-size: 10px;"><span adr_trans="label_country">Country</span></td><td style="padding-left:5px;padding-right:15px;">:</td><td align="left"><?php echo @$res1['country']; ?></td></tr>



			     <tr><td align="left"  style="font-size: 10px; padding-left:10px;"><span adr_trans="label_contact_about">About Me</span> :</td><td style="padding-left:5px;padding-right:15px;">&nbsp;</td><td align="left">&nbsp;</td></tr>

<tr><td colspan="3" style="font-size: 11px; padding:10px;"><?php echo @$res1['about_me']; ?></td></tr>
<?php } ?>

				</tbody>
				  </table>
				  <br />
				  <a class="anima-button circle-button btn-success btn-sm btn adr-save" style="margin-left: 40%;" href="edit_photographer_profile.php" adr_trans="label_add_profile"><i class="fa fa-pencil"></i>Add / Edit profile</a>

</div>

 </div>


            </div>


		<?php include "footer.php";  ?>
