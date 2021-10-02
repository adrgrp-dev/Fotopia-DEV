<?php
ob_start();
session_start();
include "header.php";
include "connection.php";
$code=$_REQUEST['code'];
$res=mysqli_query($con,"select * from user_login where email_verification_code='$code'");
$exist=mysqli_num_rows($res);

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
                        <h1 ><span adr_trans="label_account_activated">Account activated!</span></h1>
                        <h5 ><span adr_trans="label_login_btn_proceed">Your account has been activated. Please click the login button to proceed.</span></a></h5>
                        <hr class="space m">
                        <a class="anima-button btn-ms btn circle-button" href="login.php" adr_trans="label_login"><i class="fa fa-long-arrow-left"></i>Login</a>
                    </div>
                </div>
            </div>
        </div>
		<?php  }
		 else
		{ ?>
		<div class="container content box-middle-container full-screen-size" data-sub-height="238">
            <div class="row">
                <div class="col-md-12 text-center box-middle">
                    <div>

                        <hr class="space m">
                        <h1 style="font-size:80px"><i class="fa fa-times" style="color:red"></i></h1>
                        <h1 adr_trans="label_account_not_activated">Account cannot be activated!</h1>
                        <h5 adr_trans="label_email_link_invalid">
                            Email link is invalid or expired. Please contact administrator to activate your account.</a>
                        </h5>
                        <hr class="space m">
                        <a class="anima-button btn-ms btn circle-button" href="index.php"><i class="fa fa-long-arrow-left" adr_trans="label_go_back_home"></i>Go back to Home</a>
                    </div>
                </div>
            </div>
        </div>
		<?php } ?>
		<?php include "footer.php";  ?>
