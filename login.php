<?php
ob_start();
// session_start();
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
//Login Check
if(isset($_REQUEST['loginbtn']))
{

	$email=$_REQUEST['email'];
	$pass=$_REQUEST['password'];

	$res=mysqli_query($con,"select * from user_login where email='$email' and password='$pass'");

	$user_exist=mysqli_num_rows($res);

	$ipAddress = $_SERVER['REMOTE_ADDR'];
	if($user_exist!=0)
	{
		$getres=mysqli_fetch_array($res);
		$user_name=$getres['first_name']." ".$getres['last_name'];
		$user_type=$getres['type_of_user'];
		$uid=$getres['id'];
		 $email_verified=$getres['email_verified'];
		 

		if($email_verified==0)
		{

		header("location:login.php?activate=1");
		exit;
		}
		if($email_verified==2)
		{
		header("location:login.php?blocked=1");
		exit;
		}
$_SESSION['EXPIRES'] = time() + 3600;
		$_SESSION["loggedin_id"]=$uid;
		$_SESSION["loggedin_email"]=$email;
		$_SESSION["loggedin_name"]=$user_name;
		$_SESSION["user_type"]=$user_type;
		



		$email_verification_code=getName(10);
		mysqli_query($con,"update user_login set last_login_ip='$ipAddress',last_login=now(),online_now=1,email_verification_code='$email_verification_code' where id='$uid'");

		if($user_type=='Realtor')
		{
		header("location:csrRealtorDashboard.php");
		}
		else
		{
			header("location:photographerDashboard.php");
		}
	}
	else
	{

	header("location:login.php?failed=1");
	}
}
?>
<?php include "header.php";  ?>
	<style>
	.container.content
	{
		padding-top:20px;
		padding-bottom:20px;
	}
	</style>
<div class="container content">


            <div class="row">
			<div class="col-md-6">







		<br /><br /><br />
		<div class="coverflow-slider">
                        <ul>
						 <li>
                                <a class="img-box lightbox inner" href="images/csr.jpeg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/csr.jpeg"  style="width:350px;height:300px;"></span>
                                    <span class="caption-box">
                                        <span class="caption">
                                           &nbsp;
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a class="img-box lightbox inner" href="images/realtor.jpeg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/realtor.jpeg" style="width:350px;height:300px;"></span>
                                    <span class="caption-box">
                                        <span class="caption">
                                           &nbsp;
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a class="img-box lightbox inner" href="images/photo.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/photo.jpg" style="width:350px;height:300px;"></span>
                                    <span class="caption-box">
                                        <span class="caption">
                                           &nbsp;
                                        </span>
                                    </span>
                                </a>
                            </li>
							</ul></div>







			</div>
                <div class="col-md-6" style="padding-left:50px;">

				<br>
						<?php if(@isset($_REQUEST["success"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_msg_sent" adr_trans="label_msg_sent"><i style="font-size: initial;    color: #00b300;"
                            >Congratulations. Your message has been sent successfully</i></div>
                        </div>
						<?php } ?>

						<?php if(@isset($_REQUEST["blocked"])) { ?>
                        <div class="error-box" style="display:block;">
                            <div class="text-danger" adr_trans=""><i style="font-size: initial;    color: #ff3300;"  adr_trans="label_blocked_admin">You are Blocked by the Admin.</i></div>
                        </div>
						<?php } ?>

						<?php if(@isset($_REQUEST["logout"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_logged_out_success" adr_trans="label_logged_out_success"><i style="font-size: initial;    color: #00b300;"
                            >Your are logged out successfully.</i></div>
                        </div>
						<?php } ?>
						<?php if(isset($_REQUEST["failed"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="text-danger" id="label_invalid_loggin" adr_trans="label_invalid_loggin">
                            	<i style="font-size: initial;color: #ff3300;">  Invalid login  credentials. Please try again.</i></div>
                        </div>
						<?php } ?>

						<?php if(isset($_REQUEST["sessexp"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="text-danger" id="label_session_expired" adr_trans="label_session_expired"><i style="font-size: initial;color: #ff3300;"
                            >Your session expired. Please login again.</i></div>
                        </div>
						<?php } ?>

						<?php if(isset($_REQUEST["activate"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="text-danger" id="label_acc_not_approved"
                            adr_trans="label_acc_not_approved"><i style="font-size: initial;color: #ff3300;">Your account is not yet Approved by Admin.</i></div>

                            <div class="text-danger" id="label_notified_approved" adr_trans="label_notified_approved"><i style="font-size: initial;color: #ff3300;">You will be notified in email when Admin approved.</i></div>
                        </div>
						<?php } ?>

				<?php if(!isset($_REQUEST["activate"]) && !isset($_REQUEST["sessexp"]) && !isset($_REQUEST["success"]) && !isset($_REQUEST["failed"]) && !isset($_REQUEST["logout"]))
				{

				?>
				<div style="height:75px;">&nbsp;</div>
				<?php
				} ?>
                    <form action="" class="form-box form-ajax" method="post">
                        <br><h3 id="label_user_login" adr_trans="label_user_login">User Login</h3>
                        <div class="row">
                            <div class="col-md-6">
                              <p id="label_email" adr_trans="label_email">Email</p>
                                <input id="email" name="email" placeholder="Email" type="email" autocomplete="off" class="form-control form-value" onblur="this.value=this.value.trim()" required="" style="box-shadow:5px 7px #DDDDDD">
                            </div>
							</div>
							 <div class="row">
                            <div class="col-md-6">
                              <p id="label_password" adr_trans="label_password">Password</p>
                                <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" style="box-shadow:5px 7px #DDDDDD">
                            </div>
                        </div>

             <br>
						<a href="forgotPassword.php" style="text-decoration:underline;color:blue;" id="label_forgot_password" adr_trans="label_forgot_password">&nbsp;&nbsp;Forgot password?</a>
						<br>
						 <div class="row">
                            <div class="col-md-12"><hr class="space s">
						 <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="loginbtn"  ><i class="fa fa-sign-in"></i><span adr_trans="label_login">Login</span></button>
                       &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="index.php" id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>
<br>&nbsp;&nbsp;<span id="label_no_acc" adr_trans="label_no_acc">No account? Register</span> <a href="signup.php" class="text-primary" style="text-decoration:underline;color:blue;" id="label_here" adr_trans="label_here">here </span></a>
					   </div>
                        </div>

                    </form>
                </div>


            </div>
        </div>


		<?php include "footer.php";  ?>
