<?php
ob_start();

include "connection1.php";

$csrid=$_REQUEST['id'];

$csr1=mysqli_query($con,"select * from admin_users where id='$csrid'");
$csr=mysqli_fetch_array($csr1);

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
$id=$_REQUEST['id'];

	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];


	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	$contactno=$_REQUEST['contactno'];
	$addressline1=$_REQUEST['addressline1'];
		$addressline2=$_REQUEST['addressline2'];


	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=$_REQUEST['zip'];
	$country=$_REQUEST['country'];


	$org=$_REQUEST['org'];

	$email_verification_code=getName(10);


		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"update admin_users set first_name='$fname',last_name='$lname',email='$email',type_of_user='SubCSR',organization='$org',contact_number='$contactno',address_line1='$addressline1',address_line2='$addressline2',city='$city',state='$state',postal_code='$zip' where id='$id'");

	//echo "select * from user_login where email='$email' and password='$pass'";



	header("location:csr_list1.php?cu=1");

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage1" data-sub-height="238">
            <div class="row">


			<div class="col-md-2">


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









						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()" style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;padding:20px;">
 <div class="col-md-12"><h5 align="center"> Edit Sub CSR</h5></div>


  						<div class="col-md-6">
                                  <p>First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="" value="<?php echo $csr['first_name']; ?>">
                              </div>

  							<div class="col-md-6">
                                  <p>Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="" value="<?php echo $csr['last_name']; ?>">
                              </div>

<div class="col-md-6">
                                <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $csr['organization']; ?>" readonly>
                            </div>


                              <div class="col-md-6">
                                  <p>Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off" onblur="this.value=this.value.trim();validate_email(this.value)" class="form-control form-value" required="" value="<?php echo $csr['email']; ?>">

 															</div>


  							 <div class="col-md-6">
                                  <p>Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" required="" value="<?php echo $csr['contact_number']; ?>">
                              </div>




  						 <div class="col-md-6">
  						  <p>Address Line 1</p>
  						   <input id="addressline1" name="addressline1" placeholder="Address line 1" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $csr['address_line1']; ?>">
  						 </div>

  							 <div class="col-md-6">
  						  <p>Address Line 2</p>
  						   <input id="addressline2" name="addressline2" placeholder="Address line 2" type="text" autocomplete="off" class="form-control form-value"  value="<?php echo $csr['address_line2']; ?>">
  						 </div>

  						<div class="col-md-6">
  							 <p>City</p>
  							<select name="city" class="form-control form-value" required="">
							<?php
							$city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc ");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>" <?php if($csr['city']==$city['cities']) { echo "selected"; } ?>><?php echo $city['cities']; ?></option>
							<?php } ?>
							</select>
  							</div>

  							<div class="col-md-6">
  							 <p>State</p>
  							<select name="state" class="form-control form-value" required="" >
							<?php
							$state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc ");
							while($state=mysqli_fetch_array($state1))
							{
							?>
							<option value="<?php echo $state['states']; ?>" <?php if($csr['state']==$state['states']) { echo "selected"; } ?>><?php echo $state['states']; ?></option>
							<?php } ?>
							</select>
  							</div>
  						 <div class="col-md-6">
                                  <p>Zip Code</p>
                                  <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" required=""  value="<?php echo $csr['postal_code']; ?>">
                              </div>

<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />


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

  						 <button class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Update</button>
                         &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn" href="csr_list1.php"><i class="fa fa-times"></i>Cancel</a>
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


       </script>


		<?php include "footer.php";  ?>
