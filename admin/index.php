<?php
ob_start();
include "connection.php";

//echo $_SESSION['Selected_Language_Session'];
//Login Check
if(isset($_REQUEST['approve']))
{
  $email=$_REQUEST['email'];
  $verifiation_code=$_REQUEST['code'];
  $get_approved_query=mysqli_query($con,"select * from admin_users where email='$email' and secret_code='$verifiation_code'");
  if(mysqli_num_rows($get_approved_query)>0)
  {
    mysqli_query($con,"update admin_users set is_approved=1 where email='$email'");
  }
  else{
  	header("location:index.php?activate=1");
  }
}

if(isset($_REQUEST['loginbtn']))
{
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['password'];

	$res=mysqli_query($con,"select * from admin_users where email='$email' and password='$pass'");
    $user_exist=mysqli_num_rows($res);
	$pc_admin_user=mysqli_query($con,"select * from photo_company_admin where email='$email' and password='$pass'");
	$pc_admin_user_exist=mysqli_num_rows($pc_admin_user);
	
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	if($user_exist!=0)
	{
		$getres=mysqli_fetch_array($res);
		$user_name=$getres['first_name']." ".$getres['last_name'];
		$id=$getres['id'];
        $is_approved=$getres['is_approved'];
		$type=$getres['type_of_user'];
		$org=$getres['organization_name'];
		$_SESSION["admin_loggedin_email"]=$email;
		$_SESSION["admin_loggedin_name"]=$user_name;
		$_SESSION["admin_loggedin_id"]=$id;
		$_SESSION["admin_loggedin_type"]=$type;
		$_SESSION["admin_loggedin_org"]=$org;

		if($is_approved==2)
		{
		header("location:index.php?blocked=1");
		exit;
	    }
		elseif($is_approved==0)
		{
		header("location:index.php?activate=1");
		exit;
	    }




		mysqli_query($con,"update admin_users set last_login_ip='$ipAddress',last_login=now() where id='$id'");

		if($type=='FotopiaAdmin')
		{
		header("location:dashboard.php");
		}
		if($type=='PCAdmin')
		{  

			$id=$_SESSION['admin_loggedin_id'];
    $pc_profile=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$id'");
    $pc_profile1=mysqli_fetch_array($pc_profile);
    $aboutPC=$pc_profile1['about_us'];

        $organization_number=$pc_profile1['organization_number'];
           $organization_name=$pc_profile1['organization_name'];
        $organization_tax=$pc_profile1['tax'];
         $organization_location=$pc_profile1['location'];

 
    $products=mysqli_query($con,"select * from products where pc_admin_id='$pc_id'");
    $productsFound=mysqli_num_rows($products);

 if($organization_number=='' && !@$_REQUEST['first'] || $organization_name=='' && !@$_REQUEST['first'] || $organization_tax=='' && !@$_REQUEST['first'] || $organization_location=='' && !@$_REQUEST['first'])
   { 

	header("location:PCAdmin_dashboard.php?second=1");

   }
elseif($productsFound==0 && !@$_REQUEST['first']) 
      {

	header("location:PCAdmin_dashboard.php?third=1");

       }
else
{
	header("location:PCAdmin_dashboard.php");
}
		
		}
		if($type=='CSR')
		{
		header("location:subcsr_dashboard.php");
		}


	}
	else if($pc_admin_user_exist!=0)
	{
	$getPCAdminUser=mysqli_fetch_array($pc_admin_user);
	$pc_admin_id=$getPCAdminUser['pc_admin_id'];
	
	$Pc_admin_details=mysqli_query($con,"select * from admin_users where id='$pc_admin_id' and type_of_user='PCAdmin'");
	
	
	
	$getres=mysqli_fetch_array($Pc_admin_details);
		//$user_name=$getres['first_name'];
		$user_name=$getPCAdminUser['first_name'];
		$type=$getres['type_of_user'];
		$org=$getres['organization_name'];
		$emailIs=$getres['email'];
		$_SESSION["admin_loggedin_email"]=$emailIs;
		$_SESSION["admin_loggedin_name"]=$user_name;
		$_SESSION["admin_loggedin_id"]=$pc_admin_id;
		$_SESSION["admin_loggedin_type"]=$type;
		$_SESSION["admin_loggedin_org"]=$org;
header("location:PCAdmin_dashboard.php");
	
	}
	else
	{

	header("location:index.php?failed=1");
	}
}
?>
<?php include "header1.php";  ?>
	<style>
	.container.content
	{
		padding-top:20px;
		padding-bottom:20px;
	}
	</style>
<div class="content-empty bgimage7">


            <div class="row">
			<div class="col-md-6">&nbsp;
			</div>
                <div class="col-md-6" style="padding-left:40px;padding-top:20px;">

				<br>
						


                    <form action="" class="form-box form-ajax" method="post">
                        <h3 adr_trans="label_administration_login">Administrator Login</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p id="label_email" adr_trans="label_email">Email</p>
                                <input id="email" name="email" placeholder="Email" type="email" autocomplete="off" class="form-control form-value" required="" onblur="this.value=this.value.trim()">
                            </div>
							</div>
							 <div class="row">
                            <div class="col-md-6">
                                <p id="label_password" adr_trans="label_password">Password</p>
                   <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="">
                            </div>
                        </div>
						<a href="forgotPassword.php">&nbsp;&nbsp;<span adr_trans="label_forgot_password">Forgot password?</span></a>
						<br>
						 <div class="row">
                            <div class="col-md-12">
                            	<p>
                            		<?php if(@isset($_REQUEST["success"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div id="label_msg_sent" adr_trans="label_msg_sent" class="text text-success">Congratulations. Your message has been sent successfully</div>
                        </div>
						<?php } ?>
												<?php if(@isset($_REQUEST["logout"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div id="label_logged_out_success" adr_trans="label_logged_out_success" class="text text-success">Your are logged out successfully.</div>
                        </div>
						<?php } ?>

						<?php if(isset($_REQUEST["failed"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div id="label_invalid_loggin" adr_trans="label_invalid_loggin" class="text text-warning">Invalid login  credentials. Please try again.</div>
                        </div>
						<?php } ?>

						<?php if(isset($_REQUEST["sessexp"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div id="label_session_expired" adr_trans="label_session_expired" class="text text-warning">Your session expired. Please login again.</div>
                        </div>
						<?php } ?>

						<?php if(@isset($_REQUEST["blocked"])) { ?>
												<div class="error-box" style="display:block;">
														<div class="text-danger" adr_trans=""><i style="font-size: initial;    color: #ff3300;"adr_trans="label_blocked_admin">Your are Blocked, Please check with Admin</i></div>
												</div>
						<?php } ?>

						<?php if(isset($_REQUEST["activate"])) { ?>
												<div class="error-box"  style="display:block;">
														<div class="text-danger" id="label_acc_not_approved"
														adr_trans=""><i style="font-size: initial;color: #ff3300;">Your Email is not verified.</i></div>

														<div class="text-danger" id="label_notified_approved" adr_trans=""><i style="font-size: initial;color: #ff3300;">Please check your email and verify your account.</i></div>
												</div>
						<?php } ?>
                            	</p>
                            	<br>
						 <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="loginbtn"><i class="fa fa-sign-in"></i><span adr_trans="label_login">Login</span></button>
                       </div>
					   <hr class="space l" />
                        </div>

                    </form>
					<br />
                </div>
                </div>

          </div>

		<?php include "footer.php";  ?>
