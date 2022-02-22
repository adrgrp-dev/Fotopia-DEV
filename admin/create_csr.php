<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pc_admin_id=$_SESSION['admin_loggedin_id'];
 //echo "SELECT * FROM `photo_company_profile` WHERE id=$pc_admin_id";
 $get_pcadmin_profile_query1=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
 $get_profile1=mysqli_fetch_assoc($get_pcadmin_profile_query1);

function email($template,$Password,$fname,$email,$secret_code,$con)
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
	$mail->addAddress($email);


 //Address to which recipient will reply
 $mail->addReplyTo($_SESSION['emailUserID'], "Reply");

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

 $mail->Subject = $get_profile['organization_name']." has added you as a CSR";
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">YOU ARE SUCCESSFULLY REGISTERED AS A CSR!</td>
 <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">".$_SESSION['support_team_email']."<br>".$_SESSION['support_team_phone']."</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.=$template;
$mail->Body.="Dear {{Name}},<br>";
$mail->Body.=$template;
$mail->Body.="
You have been successfully registered as a CSR (Customer Service Representative) for ".$get_profile['organization_name']."<br>
<a href='{{project_url}}resetPassword.php?email={{email}}&secret_code={{secret_code}}'>Click here</a> to reset your password using this secure code.<br><br>
{{secret_code}}<br><br><span style=\"font-size:10px;font-weight:bold;\">*This is an auto generated email notification from Fotopia. Please do not reply back to this email. For any support please write to support@fotopia.no</span><br><br>
Thanks,<br>
Fotopia Team."
;


   $url=$_SESSION['project_url']."admin/";
  $mail->Body=str_replace('{{secret_code}}',$secret_code, $mail->Body);
  $mail->Body=str_replace('{{Name}}',$fname, $mail->Body);
  $mail->Body=str_replace('{{project_url}}',$url, $mail->Body);
  $mail->Body=str_replace('{{name of the company}}',$_SESSION['admin_loggedin_org'], $mail->Body);
  $mail->Body=str_replace('{{email}}',$email, $mail->Body);
   $mail->Body.="<br><br></td></tr></table></html>";
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

$select_admin = @$_REQUEST['select_admin'];

	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=$_REQUEST['zip'];
	$country=$_REQUEST['country'];


	$org=$_SESSION['admin_loggedin_org'];
$pc_admin_id=$_SESSION['admin_loggedin_id'];
	$email_verification_code=getName(10);

// if ($_FILES['profilepic']['size'] == 0) {

// }
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

		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"insert into admin_users (first_name,last_name,email,password,type_of_user,organization_name,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on,pc_admin_id,assigned_admin_id,secret_code,is_approved)values('$fname','$lname','$email','$password','CSR','$org','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now(),'$pc_admin_id','$select_admin','$email_verification_code',1)");
  $inserted_id=mysqli_insert_id($con);

   $res1=mysqli_query($con,"insert into csr_profile (first_name,last_name,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,csr_id)values('$fname','$lname','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType','$inserted_id')");

	//echo "select * from user_login where email='$email' and password='$pass'";
  $get_template_query=mysqli_query($con,"SELECT * FROM `email_template` WHERE template_title='New user created' and pc_admin_id='$pc_admin_id'");
  $get_template=mysqli_fetch_array($get_template_query);
  $template=@$get_template['template_body_text'];
   email($template,$password,$fname,$email,$email_verification_code,$con);


	header("location:csr_list1.php?c=1");

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage8" data-sub-height="238">
            <div class="row">


			<div class="col-md-2" style="margin-left:10px;">


				<?php	if($_SESSION['admin_loggedin_type']=="PCAdmin"){
				include "sidebar.php";
			 } else {
				include "sidebar.php";
			}?>

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
		$("#Email_exist_error").html("Email already exist, please choose different email and continue");
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
  xhttp.open("GET","validate_email.php?id="+val+"&type=CSR",true);
  xhttp.send();
}


function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
    $('#pass_icon').removeClass('fa-eye');
     $('#pass_icon').addClass('fa-eye-slash');

  } else {
    x.type = "password";
    $('#pass_icon').removeClass('fa-eye-slash');
     $('#pass_icon').addClass('fa-eye');

  }

}


function showPassword2() {
  var y = document.getElementById("confirmpassword");
  if (y.type === "password") {
    y.type = "text";
    $('#pass_icon2').removeClass('fa-eye');
     $('#pass_icon2').addClass('fa-eye-slash');

  } else {
    y.type = "password";
    $('#pass_icon2').removeClass('fa-eye-slash');
     $('#pass_icon2').addClass('fa-eye');

  }
}



</script>
			</div>
			
                <div class="col-md-8" style="padding:30px;">

<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h4 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Step #4 of 7 : Create a CSR</h5></div> <?php } ?>

<br />

<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()"  style="color: #000;background: #FFF;opacity:0.8;width:100%;border-radius:10px!important;padding:20px;">
<div class="col-md-12"><h5 align="center" id="label_create_csr" adr_trans="label_create_csr"> Create CSR</h5></div>



  						<div class="col-md-6">
                                  <p id="label_first_name" adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" minlength="5" maxlength="20" placeholder="First name" type="text" autocomplete="off" class="form-control form-value" required="">
                              </div>

  							<div class="col-md-6">
                                  <p id="label_last_name" adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" minlength="1" maxlength="20" placeholder="Last name" type="text" autocomplete="off" class="form-control form-value" required="">
                              </div>



                              <div class="col-md-6">
                                  <p id="label_email" adr_trans="label_email">Email
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off"  onblur="this.value=this.value.trim();validate_email(this.value)" class="form-control form-value" required="">

 															</div>


  							 <div class="col-md-6">
                                  <p id="label_contact_no" adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" required="">
                              </div>
                              <div class="col-md-6">
                                  <p id="label_password" adr_trans="label_password">Password</p><i class="fa fa-eye" id="pass_icon" onclick="showPassword()" style="display:inline;position: absolute;float: right;z-index:999;right: 0;padding-right: 23px;padding-top: 10px;"></i>
                                  <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
 
                              </div>
  							<div class="col-md-6">
                                  <p id="label_confirm_password" adr_trans="label_confirm_password">Confirm Password</p><i class="fa fa-eye" id="pass_icon2" onclick="showPassword2()" style="display:inline;position: absolute;float: right;z-index:999;right: 0;padding-right: 23px;padding-top: 10px;"></i>
                                  <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                              </div>



  						 <div class="col-md-6">
  						  <p id="label_address_line1" adr_trans="label_address_line1">Address Line 1</p>
  						   <input id="addressline1" name="addressline1" placeholder="Address line 1" type="text" autocomplete="off" class="form-control form-value" value="<?php echo $get_profile1['address_line1']; ?>" required="" >
  						 </div>

  							 <div class="col-md-6">
  						  <p id="label_address_line2" adr_trans="label_address_line2">Address Line 2</p>
  						   <input id="addressline2" name="addressline2" value="<?php echo $get_profile1['address_line2']; ?>" placeholder="Address line 2" type="text" autocomplete="off" class="form-control form-value" >
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
                                  <p id="label_zip_code" adr_trans="label_zip_code">Zip Code</p>
                                  <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" value="<?php echo $get_profile1['postal_code']; ?>" required="" >
                              </div>


  						<div class="col-md-6">
  							 <p id="label_country" adr_trans="label_country">Country</p>
  							<select name="country" class="form-control form-value" required="">
  														<option value="Norway" <?php if($get_profile1['country']=='Norway') { echo "selected"; } ?>>Norway</option>
                              <option value="US" <?php if($get_profile1['country']=='US') { echo "selected"; } ?>>US</option>
  														</select>
  							</div>

                <div class="col-md-6">
                 <p id="label_select_admin" adr_trans="label_select_admin">Select admin</p>
                <select name="select_admin" class="form-control form-value">
                  <option selected disabled="" value="">Select an admin</option>
                  <?php
              $CSRList=NULL;
              $pc_admin_id=$_SESSION['admin_loggedin_id'];
              $CSRList=mysqli_query($con,"select id,first_name from photo_company_admin where pc_admin_id='$pc_admin_id'");



                            while($CSRList1=mysqli_fetch_array($CSRList))
              {
              ?>
              <option value="<?php echo $CSRList1['id']; ?>"><?php echo $CSRList1['first_name']; ?></option>
              <?php } ?>
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

  						 <button id="label_create" adr_trans="label_create" class="anima-button circle-button btn-sm btn adr-save" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Create</button>
                         &nbsp;&nbsp;<a id="label_cancel" adr_trans="label_cancel" class="anima-button circle-button btn-sm btn adr-cancel" href="csr_list1.php?fc=1"><i class="fa fa-times"></i>Cancel</a>
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
