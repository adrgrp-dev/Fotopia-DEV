<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pc_admin_id=$_SESSION['admin_loggedin_id'];
 //echo "SELECT * FROM `photo_company_profile` WHERE id=$pc_admin_id";
 $get_pcadmin_profile_query1=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
 $get_profile1=mysqli_fetch_assoc($get_pcadmin_profile_query1);

function email($template,$fname,$email,$password,$secret_code,$con)
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
	$mail->addAddress($email);


 //Address to which recipient will reply
 $mail->addReplyTo("test.deve@adrgrp.com", "Reply");

 //CC and BCC
 //$mail->addCC("cc@example.com");
 //$mail->addBCC("bcc@example.com");

 //Send HTML or Plain Text email
 $mail->isHTML(true);
 $pc_admin_id=$_SESSION['admin_loggedin_id'];
 //echo "SELECT * FROM `photo_company_profile` WHERE id=$pc_admin_id";
 $get_pcadmin_profile_query=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
 $get_profile=mysqli_fetch_assoc($get_pcadmin_profile_query);
 $pcadmin_email=$get_profile['email'];
 $pcadmin_contact=$get_profile['contact_number'];

 $mail->Subject = "Your are created as an Photographer for ".$get_profile['organization_name'];
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"{{project_url}}logo.png\" /></td><td align=\"center\" class=\"titleCss\">You are created as photographer successfully!</td>
 <td align=\"right\"><img src=\""."{{project_url}}".$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.=$template;
 $mail->Body.="<br> You have been added as a Photographer for ".$get_profile['organization_name'];
 $mail->Body.="<br><a href='{{project_url}}resetPassword.php?email={{email}}&secret_code={{secret_code}}'>Click here</a> Reset your password and using a {{secret_code}} code.";


 $mail->Body=str_replace('{{secret_code}}',$secret_code, $mail->Body);
 $mail->Body=str_replace('{{Name}}',$fname, $mail->Body);
 $mail->Body=str_replace('{{project_url}}',$_SESSION['project_url'], $mail->Body);
 $mail->Body=str_replace('{{name of the company}}',$_SESSION['admin_loggedin_org'], $mail->Body);
 $mail->Body=str_replace('{{email}}',$email, $mail->Body);

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
	$password=$_REQUEST['password'];

	$contactno=$_REQUEST['contactno'];
	$addressline1=$_REQUEST['addressline1'];
	 if(empty($_REQUEST['addressline2']))
  {
    $addressline2='';
  }
  else{

    $addressline2=$_REQUEST['addressline2'];

  }


	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=$_REQUEST['zip'];
	$country=$_REQUEST['country'];
	$created_by_id=$_SESSION['admin_loggedin_id'];

	$type_of_user=$_SESSION['admin_loggedin_type'];
	$CSR_ID=$_REQUEST['csr_id'];
  $CSR_ID1=explode('-',$CSR_ID);
$csr_id_new = 0;
$admin_user_id = 0;
if ($CSR_ID1[0]=='A') {

  $admin_user_id=$CSR_ID1[1];

}

if ($CSR_ID1[0]=='C') {

  $csr_id_new=$CSR_ID1[1];

}


	$pc_admin_id=0;


	if($type_of_user=="PCAdmin")
	{
	$pc_admin_id=$_SESSION['admin_loggedin_id'];

	}
	if($type_of_user=="CSR")
	{
	$CSR_ID=$_SESSION['admin_loggedin_id'];
							$findPCAdmin=mysqli_query($con,"select pc_admin_id from admin_users where id='$CSR_ID'");
							$findPCAdmin1=mysqli_fetch_array($findPCAdmin);

							$pc_admin_id=$findPCAdmin1['pc_admin_id'];
	}





	$imgData="";
	$imageProperties="";
	$imageType="";
	if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['profilepic']['tmp_name'])) {
        //echo "coming";
        $imgData = addslashes(file_get_contents($_FILES['profilepic']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['profilepic']['tmp_name']);
        $imageType = $_FILES['profilepic']['type'];
      /*  $sql = "INSERT INTO output_images(imageType ,imageData)
	VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: listImages.php");
        } */
    }
}

		//echo "insert into user_login (first_name,last_name,email,password,type_of_user,organization,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on,email_verified,created_by_id)values('$fname','$lname','$email','$password','Photographer','$org','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','','$imageType',now(),1,$created_by_id)";exit;
$org=$_REQUEST['org'];
	$email_verification_code=getName(10);
  $res=mysqli_query($con,"insert into user_login (first_name,last_name,email,password,type_of_user,organization_name,contact_number,address_line1,address_line2,city,state,postal_code,country,email_verification_code,profile_pic,profile_pic_image_type,registered_on,email_verified,pc_admin_id,csr_id,pc_admin_user_id)values('$fname','$lname','$email','$password','Photographer','$org','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$email_verification_code','$imgData','$imageType',now(),1,$pc_admin_id,$csr_id_new,$admin_user_id)");
  $inserted_id=mysqli_insert_id($con);

   $res1=mysqli_query($con,"insert into photographer_profile (first_name,last_name,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,photographer_id)values('$fname','$lname','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType','$inserted_id')");

	//echo "select * from user_login where email='$email' and password='$pass'";
  $get_template_query=mysqli_query($con,"SELECT * FROM `email_template` WHERE template_title='New user created' and pc_admin_id='$pc_admin_id'");
  $get_template=mysqli_fetch_array($get_template_query);
  $template=$get_template['template_body_text'];
  email($template,$fname,$email,$password,$email_verification_code,$con);



	if($type_of_user=="PCAdmin")
  {
  header("location:csr_list1.php?p=1");
}
elseif($type_of_user=="CSR"){

  header("location:subcsr_list1.php?p=1");
}

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage3" data-sub-height="238">
            <div class="row">


			<div class="col-md-2" style="margin-left:10px;">


	<?php include "sidebar.php"; ?>

			<script>
function validate_email(val)
{
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {

       $("#Email_exist_error").html("Email already in use as a CSR, please choose different email and continue");
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
  xhttp.open("GET","validate_email.php?id="+val+"&type=Photographer",true);
  xhttp.send();
}
</script>
			</div>
                <div class="col-md-8" style="padding:30px;">









						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()"   style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;padding:20px;">

<div class="col-md-12"><h5 align="center" id="label_create_photographer" adr_trans="label_create_photographer" style="color:#000"> Create Photographer</h5></div>

  						<div class="col-md-6">
                                  <p id="label_first_name" adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" class="form-control form-value" required="">
                              </div>

  							<div class="col-md-6">
                                  <p id="label_last_name" adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" class="form-control form-value" required="">
                              </div>
<?php if($_SESSION['admin_loggedin_type'] != "CSR"){ ?>

<div class="col-md-6">
                                <p id="label_select_admin_csr" adr_trans="label_select_admin_csr">Select Admin / CSR</p>
                               <select name="csr_id" class="form-control form-value" required="">
                                <option selected disabled="" value="">Select an admin / csr</option>
							<?php

							$type_of_user=$_SESSION['admin_loggedin_type'];
	$CSRList=NULL;
  $adminList=NULL;
							if($type_of_user=="PCAdmin")
							{
							$pc_admin_id=$_SESSION['admin_loggedin_id'];

							$CSRList=mysqli_query($con,"select id,first_name from admin_users where type_of_user='CSR' and pc_admin_id='$pc_admin_id'");

              $adminList=mysqli_query($con,"select id,first_name from photo_company_admin where pc_admin_id='$pc_admin_id'");



while($adminList1=mysqli_fetch_array($adminList))
              {
              ?>
              <option value="A-<?php echo $adminList1['id']; ?>"><?php echo $adminList1['first_name']; ?> (Admin)</option>

              <?php }

while($CSRList1=mysqli_fetch_array($CSRList))
              {
              ?>
              <option value="C-<?php echo $CSRList1['id']; ?>"><?php echo $CSRList1['first_name']; ?> (CSR)</option>

              <?php }



							}

							$CSR_ID=0;
							if($type_of_user=="CSR")
							{
							$CSR_ID=$_SESSION['admin_loggedin_id'];
							$findPCAdmin=mysqli_query($con,"select pc_admin_id from admin_users where id='$CSR_ID'");
							$findPCAdmin1=mysqli_fetch_array($findPCAdmin);

							$pc_admin_id=$findPCAdmin1['pc_admin_id'];

							$CSRList=mysqli_query($con,"select id,first_name from admin_users where type_of_user='CSR' and pc_admin_id='$pc_admin_id'");

while($CSRList1=mysqli_fetch_array($CSRList))
              {
              ?>
              <option value="<?php echo $CSRList1['id']; ?>" <?php if($CSR_ID!=0 && $CSR_ID==$CSRList1['id']) { echo "selected readonly"; } ?>><?php echo $CSRList1['first_name']; ?></option>

              <?php } }?>


							</select>
                            </div>
<?php } else{ ?>

  <div class="col-md-6">
          <p id="label_csr" adr_trans="label_csr" >CSR</p>

         <input id="" name="" placeholder="<?php echo $_SESSION['admin_loggedin_name']; ?>" type="text" autocomplete="off" class="form-control form-value" readonly>
       </div>
<?php } ?>


<div class="col-md-6" style="display:none">
                                <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $_SESSION['admin_loggedin_org']; ?>" readonly>
                            </div>

                              <div class="col-md-6">
                                  <p id="label_email" adr_trans="label_email">Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off"  onblur="validate_email(this.value)" class="form-control form-value" required="">

 															</div>



                              <div class="col-md-6">
                                  <p id="label_password" adr_trans="label_password">Password</p>
                                  <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">

                              </div>
  							<div class="col-md-6">
                                  <p id="label_confirm_password" adr_trans="label_confirm_password">Confirm Password</p>
                                  <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                              </div>

                <div class="col-md-6">
                                  <p id="label_contact_no" adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="number" autocomplete="off" class="form-control form-value" required="">
                              </div>

  						 <div class="col-md-6">
  						  <p id="label_address_line1" adr_trans="label_address_line1">Address Line 1</p>
  						   <input id="addressline1" name="addressline1" placeholder="Address line 1" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $get_profile1['address_line1']; ?>">
  						 </div>

  							 <div class="col-md-6">
  						  <p id="label_address_line2" adr_trans="label_address_line2">Address Line 2</p>
  						   <input id="addressline2" name="addressline2" placeholder="Address line 2" type="text" autocomplete="off" class="form-control form-value" value="<?php echo $get_profile1['address_line2']; ?>">
  						 </div>

  						<div class="col-md-6">
  							 <p id="label_city" adr_trans="label_city">City</p>
  							<select name="city" class="form-control form-value" required="">
							<?php
							$city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>"<?php if($get_profile1['city']==$city['cities']) { echo "selected"; } ?>><?php echo $city['cities']; ?></option>
							<?php } ?>
							</select>
  							</div>

  							<div class="col-md-6">
  							 <p id="label_state" adr_trans="label_state">State</p>
  							<select name="state" class="form-control form-value" required="">
							<?php
							$state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc");
							while($state=mysqli_fetch_array($state1))
							{
							?>
							<option value="<?php echo $state['states']; ?>" <?php if($get_profile1['state']==$state['states']) { echo "selected"; } ?>><?php echo $state['states']; ?></option>
							<?php } ?>
							</select>
  							</div>
  						 <div class="col-md-6">
                                  <p id="label_zip_code" adr_trans="label_zip_code" >Zip Code</p>
                                  <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" required="" value="<?php echo $get_profile1['postal_code']; ?>">
                              </div>


  						<div class="col-md-6">
  							 <p id="label_country" adr_trans="label_country">Country</p>
  							<select name="country" class="form-control form-value" required="">
  														<option value="Norway" <?php if($get_profile1['country']=='Norway') { echo "selected"; } ?>>Norway</option>
                              <option value="US" <?php if($get_profile1['country']=='US') { echo "selected"; } ?>>US</option>
  														</select>
  							</div>
  						<div class="col-md-6">
                                  <p id="label_profile_pic" adr_trans="label_profile_pic">Profile Pic</p>
                                  <input id="profilepic" name="profilepic" placeholder="Profile pic" type="file" autocomplete="off" class="form-control form-value">
                              </div>




  <?php
  		/*					<div class="col-md-12">

                                  <p>Confirm Captcha</p>
                                 <span class="g-recaptcha" data-sitekey="6LfHgzIaAAAAABt7sRE_3-noIhlhSlT01oUjzmJW" data-callback="verifyCaptcha"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfHgzIaAAAAABt7sRE_3-noIhlhSlT01oUjzmJW&amp;co=aHR0cDovL2xvY2FsaG9zdDo4MA..&amp;hl=en&amp;v=-nejAZ5my6jV0Fbx9re8ChMK&amp;size=normal&amp;cb=1z623uotmfq9" width="304" height="78" role="presentation" name="a-f1dkdujeepvd" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></span>
          <span id="error"></span>*
                              </div>  */?>




  						 <div class="row">
                              <div class="col-md-12"><center><hr class="space s">

  							<div class="error-box" style="display:none;">
                              <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                          </div>

                          <?php

if($_SESSION['admin_loggedin_type'] == "PCAdmin")
{
?>
 <button id="label_create" adr_trans="label_create" class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Create</button>&nbsp;&nbsp;<a id="label_cancel" adr_trans="label_cancel" class="anima-button circle-button btn-sm btn" href="csr_list1.php"><i class="fa fa-times"></i>Cancel</a>

<?php
}
else if($_SESSION['admin_loggedin_type'] == "CSR")
{
  ?>

 <button id="label_create" adr_trans="label_create" class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Create</button>&nbsp;&nbsp;<a id="label_cancel" adr_trans="label_cancel" class="anima-button circle-button btn-sm btn" href="subcsr_list1.php"><i class="fa fa-times"></i>Cancel</a>


    <?php } ?>


  </center>
  					   </div>

					   </form>

                          </div>


                  </div>


              </div>




        <script>


       function validateData() {
   	$('.error-box').hide();
   	$('#error-msg').html('');

   	var pass=document.getElementById('password').value;
   	var cpass=document.getElementById('confirmpassword').value;
   	if(pass!=cpass)
   	{
   	//alert("Password and Confirm password must be same.");
   	$('#error-msg').html('Password and Confirm password must be same.');
   	$('.error-box').show();
   	return false;
   	}
           return true;
       }

 $("#profilepic").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var profile_pic_alert='';
		if(langIs=='no')
		{
		profile_pic_alert="Profilbilde skal bare v�re i det gitte formatet";
		}
		else
		{
		profile_pic_alert="Profile Pic should be only in the given format";
		}
            alert(profile_pic_alert+": "+fileExtension.join(', '));
      $("#profilepic").val("");
        }
    });


       </script>


		<?php include "footer.php";  ?>
