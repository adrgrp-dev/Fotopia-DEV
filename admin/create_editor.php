<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($fname,$email,$admin_name,$organization,$con)
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
 $mail->Subject = "New editor created";
 $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Editor Created Successfully!</td>
 <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
 //$mail->AltBody = "This is the plain text version of the email content";
 $mail->Body.="Hi {{name}},<br/>

Welcome to Real Estate Photography world!<br/>

You are chosen as an Editor for our company {{organization}}, we will send a link to download the Real estate raw images for editing.<br/>

For further quires on how to download & upload raw images & finished image, please follow the tutorials given below.<br/>

tutorial<br/>

Thanks<br/>
{{admin_name}}<br/>
{{organization}}";



 $mail->Body=str_replace('{{user_type}}','Editor', $mail->Body);
 $mail->Body=str_replace('{{organization}}',$organization, $mail->Body);
 $mail->Body=str_replace('{{name}}',$fname, $mail->Body);
 $mail->Body=str_replace('{{admin_name}}',$admin_name, $mail->Body);


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
	$org=$_REQUEST['org'];
	$contactno=$_REQUEST['contactno'];
	$photographer_id=$_REQUEST['photographer_id'];
  $service=$_REQUEST['service'];
  if(empty($_REQUEST["org_website"]))
{
  $org_website=0;
}
else
{
$org_website = $_REQUEST["org_website"];
}

$pc_admin_id=$_SESSION['admin_loggedin_id'];
	$email_verification_code=getName(10);



		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"insert into editor (first_name,last_name,email,organization_name,organization_website,contact_number,registered_on,pc_admin_id)values('$fname','$lname','$email','$org','$org_website','$contactno',now(),'$pc_admin_id')");
  $editor_ID=mysqli_insert_id($con);
  foreach ($photographer_id as $key => $value) {
    mysqli_query($con,"INSERT INTO `editor_photographer_mapping`( `editor_id`, `photographer_id`, `service_type`) VALUES ($editor_ID,$value,$service)");
  }

  $get_organization_query=mysqli_query($con,"select * from admin_users where id=$pc_admin_id");
	$get_organization=mysqli_fetch_assoc($get_organization_query);
	$organization=$get_organization['organization_name'];
	$admin_name=$get_organization['first_name'];
   email($fname,$email,$admin_name,$organization,$con);


	header("location:csr_list1.php?e=1");

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
                <div class="col-md-8" style="padding:30px;">


<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h4 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Step #7 of 7 : Create an editor</h5></div> <?php } ?>

<br />





						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()"  style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;padding:20px;">
<div class="col-md-12"><h5 align="center" id="label_create_editor" adr_trans="label_create_editor"> Create Editor</h5></div>



  						<div class="col-md-6">
                                  <p id="label_first_name" adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" minlength="5" maxlength="20" class="form-control form-value" required="">
                              </div>

  							<div class="col-md-6">
                                  <p id="label_last_name" adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="5" maxlength="20" class="form-control form-value" required="">
                              </div>



                              <div class="col-md-6">
                                  <p id="label_email" adr_trans="label_email">Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off" onblur="validate_email(this.value)" class="form-control form-value" required="">

 															</div>


  							 <div class="col-md-6">
                                  <p id="label_contact_no" adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" autocomplete="off" class="form-control form-value" required="">
                              </div>

                     <div class="col-md-6">
                                <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" minlength="5" maxlength="20" class="form-control form-value" required="" >
                            </div>


                     <div class="col-md-6">
                                <p adr_trans="">Organization Website</p>
                                <input id="org_website" name="org_website" placeholder="Organization Website" type="text" autocomplete="off" class="form-control form-value">
                            </div>

         <div class="col-md-6">
                                <span><span id="label_photographer" adr_trans="label_photographer">Photographer</span>&nbsp;<span style="font-style:italic;font-size:11px;">(ctrl+click to choose mutiple photographers)</span></span>
        <select name="photographer_id[]" class="form-control" multiple required size="5">

              <?php

              $type_of_user=$_SESSION['admin_loggedin_type'];
              $editorList=NULL;

              // if($type_of_user=="PCAdmin")
              // {
              $pc_admin_id=$_SESSION['admin_loggedin_id'];
              $editorList=mysqli_query($con,"select id,first_name from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id'");
              // }

              // $editor_ID=0;
              // if($type_of_user=="Photographer")
              // {
              // $editor_ID=$_SESSION['admin_loggedin_id'];
              // $findPCAdmin=mysqli_query($con,"select pc_admin_id from admin_users where id='$editor_ID'");
              // $findPCAdmin1=mysqli_fetch_array($findPCAdmin);

              // $pc_admin_id=$findPCAdmin1['pc_admin_id'];

              // $editorList=mysqli_query($con,"select id,first_name from admin_users where type_of_user='editor' and pc_admin_id='$pc_admin_id'");
              // }

              while($editorList1=mysqli_fetch_array($editorList))
              {
              ?>
              <option value="<?php echo $editorList1['id']; ?>"><?php echo $editorList1['first_name']; ?></option>
              <?php } ?>
              </select>
                            </div>
                            <div class="col-md-6">
                                       <p adr_trans="">Service</p>
                                       <select  autocomplete="off" class="form-control form-value" id="service" name="service">
                                         <option value="1">Photos</option>
                                         <option value="2">Floor plans</option>
                                       </select>
                                   </div>

  						 <div class="row">
                              <div class="col-md-12"><center><hr class="space s">

  							<div class="error-box" style="display:none;">
                              <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                          </div>

  						 <button id="label_create" adr_trans="label_create" class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Create</button>
                         &nbsp;&nbsp;<a id="label_cancel" adr_trans="label_cancel" class="anima-button circle-button btn-sm btn" href="csr_list1.php"><i class="fa fa-times"></i>Cancel</a>
  </center>
  					   </div>

					   </form>

                          </div>


                  </div>


              </div>

        <script>


       </script>


		<?php include "footer.php";  ?>
