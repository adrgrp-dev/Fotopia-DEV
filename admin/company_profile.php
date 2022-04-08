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



?>



<?php include "header.php";  ?>
	<style>

	</style>
<div class="section-empty bgimage7">
            <div class="row">


			<div class="col-md-2" style="padding-left:10px;">
<br/>
	<?php
	if($_SESSION["admin_loggedin_type"] == "FotopiaAdmin"){
		include "sidebar.php";
	}
	else{
		include "sidebar.php";
	}
	 ?>


			</div>
                <div class="col-md-6"  style="padding-top:5px;">
                  <hr class="space m" />
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

					<table class="" aria-busy="false" align="center" style="color: #000;background: #FFF;opacity:0.8;width:100%;border-radius:10px!important;margin-left:10px;height: 600px;">


	  <?php

	  $userExist=mysqli_num_rows($res);

	  if ($userExist == 0) { ?>

	  	<tr><th style="padding-left:20px;">No profile information</th></tr>

	 <?php  }
	 else{
 
	   ?>

	   <!--<tr><td colspan="3" style="padding-top:10px;"> <h5 class="text-center" style="margin-left:-10px;" id="label_company_details" adr_trans="label_company_details">Company details</h5></td></tr>-->
  <tr><td style="width:250px;font-size: 10px;vertical-align: baseline;padding-top: 0px;padding-bottom: 30px" align="right"><img src="<?php echo @"../".$res1['logo_image_url'] ?>" width="50" height="50" /></td><td style="padding-left:15px;padding-right:15px;padding-top: 10px;padding-bottom: 10px"></td><td style="font-size: 20px;padding-top: 0px;padding-bottom: 30px"><?php echo @$res1['organization_name']; ?></td></tr>
	    
		 <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_org_branch">Organization branch</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['organization_branch']; ?></td></tr>

		 <tr><td align="left" style="font-size: 10px;padding-left:40px;padding-bottom: 20px"><span adr_trans="label_org_number">Organization Number</span></td><td style="padding-left:15px;padding-right:15px;padding-bottom: 20px">:</td><td style="padding-bottom: 20px"><?php echo @$res1['organization_number']; ?></td></tr>

		  <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_contact_no">Contact number</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><b><?php echo @$res1['contact_number']; ?></b></td></tr>

		   <tr><td align="left" style="font-size: 10px;padding-left:40px;padding-bottom: 20px"><span adr_trans="label_email">Email</span></td><td style="padding-left:15px;padding-right:15px;padding-bottom: 20px">:</td><td style="padding-bottom: 20px"><?php echo @$res1['email']; ?></td></tr>

			  <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_address">Address</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['address_line1'].", ".@$res1['address_line2']; ?></td></tr>

			   <!-- <tr><th style="padding-left:20px;"><span adr_trans="label_logo">Logo</span></th><th>:</th><td><img src="data:<?php //echo @$res1['logo_image_type']; ?>;base64,<?php //echo base64_encode(@$res1['logo']); ?>" width="50" height="50" /></td></tr> -->
     
			   <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_city">City</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['city']; ?></td></tr>

			    <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_state">State</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['state']; ?></td></tr>

				 <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_zip_code">Zip Code</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['postal_code']; ?></td></tr>

				  <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_country">Country</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['country']; ?></td></tr>

				  <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_location">Location</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><?php echo @$res1['location']; ?></td></tr>

					<tr><td align="left" style="font-size: 10px;padding-left:40px;padding-bottom: 20px"><span adr_trans="label_tax">Tax</span></td><td style="padding-left:15px;padding-right:15px;padding-bottom: 20px">:</td><td style="padding-bottom: 20px"><?php echo @$res1['tax']." %"; ?></td></tr>

					<tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_skills">Skills</span></td><td style="padding-left:15px;padding-right:15px;vertical-align: baseline;">:</td><td><?php echo @$res1['skills']; ?></td></tr>

					<tr><td align="left" style="font-size: 10px;padding-left:40px;padding-bottom: 20px"><span adr_trans="label_portfolio_website">Portfolio/Website</span></td><td style="padding-left:15px;padding-right:15px;padding-bottom: 20px">:</td><td style="padding-bottom: 20px"><?php echo @$res1['portfolio']; ?></td></tr>

                     <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_fb_id">Facebook ID</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><span class="fa fa-facebook" style="margin-right: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span><?php echo @$res1['facebook_id']; ?></td></tr>

                     <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_insta_id">Instagram ID</span></td><td style="padding-left:15px;padding-right:15px;">:</td><td><span class="fa fa-instagram" style="margin-right: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span><?php echo @$res1['instagram_id']; ?></td></tr>

					<tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_twitter_id">Twitter ID</span></td><td style="padding-left:15px;padding-right:15px;width:30px!important">:</td><td align="left"><span class="fa fa-twitter" style="margin-right: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span><?php echo @$res1['twitter_id']; ?></td></tr>

					<tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_youtube_id">Youtube ID</span></td><td style="padding-left:15px;padding-right:15px;width:30px!important">:</td><td align="left"><span class="fa fa-youtube" style="margin-right: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span><?php echo @$res1['youtube_id']; ?></td></tr>

				    <tr><td align="left" style="font-size: 10px;padding-left:40px;"><span adr_trans="label_linkedin_id">LinkedIN ID</span> </td><td style="padding-left:15px;padding-right:15px;">:</td><td><span class="fa fa-linkedin" style="margin-right: 5px;padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px !important;font-size: 8px;"></span><?php echo @$res1['linkedin_id']; ?></td></tr>



					 <tr><td align="left"  style="font-size: 10px; padding-left:40px;"><br /><span adr_trans="label_about_us">About Us</span> :</td><td style="padding-left:5px;padding-right:15px;">&nbsp;</td><td align="left">&nbsp;</td></tr>

<tr><td colspan="3" style="font-size: 11px; padding:10px;padding-bottom:60px;padding-left:40px;"><?php echo @$res1['about_us']; ?></td></tr>
					


<?php } ?>

				  </table>
				  <br />
				  <a id="label_add_profile" adr_trans="label_add_profile"  class="anima-button circle-button btn-success btn-sm btn adr-save" style="float: right;margin-right: -8px;" href="edit_company_profile.php"><i class="fa fa-pencil"></i>Add / Edit profile</a>



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

 <script>

       function mouseover()
       {

         $('#click').toggleClass("hide");

       }
     </script>
<br/>
<br/>
<div class="col-md-4">



<table style="color: #000;background: #FFF;border-radius:10px;opacity:0.7;width:90%;" align="center"><tr><td style="padding:20px;">
	 <h5 class="text-center" style="margin-left:-10px;color:#000!important;"  ><span adr_trans="label_email_settings">Email Settings</span><a onclick="mouseover()"><i class='fa fa-question-circle' aria-hidden='true'></i></a></h5>


              <span class="text-center hide" id="click" colspan="9" style="background-color: white;
color: black;" ><i><?php echo 'The Dynamic fields below can be used to customize the email content. Simply select an email title from dropdown and then enter email content to desired Email Content field to display for your customer'?> </i></span>
           

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
								<option value="Order declined">Order declined</option>
								<option value="Appointment updated">Appointment Updated</option>
								<option value="Raw images uploaded">Raw images uploaded</option>
								<option value="Order completed">Order completed</option>
								<option value="New user created">New user created</option>
								<option value="Inviting new clients">Inviting new clients</option>
								<option value="Rework">Rework</option>
								<option value="Realtor discount">Realtor discount</option>
								<option value="Order Cost">Order Cost</option>
								<option value="Finished Images Upload">Finished Images Upload</option>
								<option value="Order Completed">Order Completed</option>
								<option value="Share finished images">Share finished images</option>
								<option value="Send finished images">Send finished images</option>


							</select>
								</div>

								<div class="col-md-12">
                                <p adr_trans="label_email_content"><b>Email content</b></p>
                                <textarea id="email_template_content" name="email_template_content"  class="form-control form-value" required="" rows="3" cols="100"></textarea>
								</div>

								<br><br><br><br><br>

							<div class="col-md-8">

	 						<p align="right" ><br />
							<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="updatebtn" id="label_update_template" adr_trans="label_update_template"><i class="fa fa-sign-in"></i>Update template</button>
							</p>

							</div>


</form>

</table>



 </div>




            </div>


		<?php include "footer.php";  ?>
