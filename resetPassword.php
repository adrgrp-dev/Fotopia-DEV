<?php
ob_start();
// session_start();
include "header.php";
include "connection.php";
function getName($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}



if(isset($_REQUEST['passresetbtn']))
{
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];
mysqli_query($con,"update user_login set password='$password' where email='$email'");
header("location:passwordResetSuccess.php");

}

if(isset($_REQUEST['confirmbtn']))
{
$email=$_REQUEST['emailhidden'];
$resetcode=$_REQUEST['resetcode'];



$res=mysqli_query($con,"select * from user_login where email='$email' and email_verification_code='$resetcode'");
$exist=mysqli_num_rows($res);

if($exist==0)
	{

	header("location:resetPassword.php?codeincorrect=1&email=$email");
	}
else
{

header("location:resetPassword.php?resetpass=1&email=$email");
}


}




//$code=$_REQUEST['code'];
//$res=mysqli_query($con,"select * from user_login where email_verification_code='$code'");
//$exist=mysqli_num_rows($res);
/*
if($exist!=0)
	{

	mysqli_query($con,"update user_login set email_verified=1 where email_verification_code='$code'");


 ?>
<div class="container content box-middle-container full-screen-size" data-sub-height="238">
            <div class="row">
                <div class="col-md-12 text-center box-middle">
                    <div>

                        <hr class="space m">
                        <h1 style="font-size:80px"><i class="fa fa-check" style="color:green"></i></h1>
                        <h1>Account activated!</h1>
                        <h5>
                            Your account has been activated. Please click the login button to proceed.</a>
                        </h5>
                        <hr class="space m">
                        <a class="anima-button btn-ms btn circle-button" href="login.php"><i class="fa fa-long-arrow-left"></i>Login</a>
                    </div>
                </div>
            </div>
        </div>
		<?php  }
		 */ ?>
		 <script src='https://www.google.com/recaptcha/api.js'></script>
		 <?php if(isset($_REQUEST['resetpass']))
		 { ?>
		<div class="container content box-middle-container full-screen-size" data-sub-height="238">
            <div class="row">
			<div class="col-md-4">&nbsp;</div>
                <div class="col-md-4 text-center box-middle">
                    <div>

                        <hr class="space m">
                        <h1 style="font-size:80px"><i class="fa fa-key text-xl" style="color:green"></i></h1>
                        <h2 adr_trans="">Reset password!</h1>
                        			  <form action="" class="form-box form-ajax" method="post"  onSubmit="return validateData()">
<div class="row">
						 <div class="col-md-12">
                                <p align="left" id="label_password" adr_trans="label_password">Password</p>
                                <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
								<input type="hidden" name="email" value="<?php echo $_REQUEST['email']; ?>" />
                            </div>
							</div>


							<div class="row">
							<div class="col-md-12">
                                <p align="left" id="label_confirm_password" adr_trans="label_confirm_password">Confirm Password</p>
                                <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div></div>




						<div class="col-md-12">
                               <br />
                               <span class="g-recaptcha" data-sitekey="6LfcQV0aAAAAALoVQq1XWMiLQDmIOadNhXqLStI_"></span>
        <span id="error"></span>
                            </div>




						 <div class="row">
                            <div class="col-md-12"><center><hr class="space s">

							<div class="error-box"  style="display:none;">
                            <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                        </div>

						 <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="passresetbtn"><i class="fa fa-sign-in"></i>Reset Password</button>
                       &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" id="label_cancel" adr_trans="label_cancel" href="login.php"><i class="fa fa-sign-in"></i>Cancel</a>
</center>
					   </div>
                        </div>



						</form>





                    </div>
                </div>
            </div>
        </div>
		<?php }  ?>

		<?php if(!isset($_REQUEST['resetpass']))
		{ ?>
		<div class="container content box-middle-container full-screen-size" data-sub-height="238">
            <div class="row">

			<div class="col-md-4"> &nbsp;</div>
                <div class="col-md-4 text-center box-middle">

                        <hr class="space m">
                        <h1 style="font-size:80px"><i class="fa fa-key text-xl" style="color:green"></i></h1>
                        <h1 id="label_confirm_reset_password" adr_trans="label_confirm_reset_password">Confirm Reset Password Code</h1>

						<?php if(isset($_REQUEST["codeincorrect"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="alert alert-warning" id="label_reset_incorrect" adr_trans="label_reset_incorrect">Password reset code is Incorrect. Please re-enter the correct reset code and try again.</div>
                        </div>
						<?php } ?>


                        <h5 id="label_reset_received" adr_trans="label_reset_received">
                            Enter the reset password code received in email :<br /><br />
							<form method="post" action="">
			<input type="hidden" name="emailhidden" value="<?php echo $_REQUEST['email']; ?>" />
			<input type="text" name="resetcode"  type="text" placeholder="" autocomplete="off" class="form-control form-value" required="" size="40"  />

							<br /><br />
							 <button class="anima-button circle-button btn-sm btn adr-save" id="label_confirm" adr_trans="label_confirm" type="submit" name="confirmbtn"><i class="fa fa-sign-in"></i>Confirm</button>
                       &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" id="label_cancel" adr_trans="label_cancel" href="login.php"><i class="fa fa-sign-in"></i>Cancel</a>
</center>
							</form>
                        </h5>

                    </div>
					<div class="col-md-4 text-center box-middle"> &nbsp;</div>
                </div>

            </div>
        </div>

		<?php } ?>

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
        var response = grecaptcha.getResponse();
        if(response.length == 0) {
		$('#error-msg').html('Please Confirm with captcha');
	$('.error-box').show();
            //document.getElementById('error').innerHTML = '<span style="color:red;margin-left:20px;">  This field is required.</span>';
            return false;
        }
        return true;
    }

		</script>
		<?php include "footer.php";  ?>
