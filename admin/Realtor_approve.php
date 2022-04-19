<?php
include "connection.php";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photography App</title>
    <meta name="description" content="About page with company informations.">
    <script src="../scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="../scripts/bootstrap/css/bootstrap.css">
    <script src="scripts/../script.js"></script>
    <link rel="stylesheet" href="../style.css">
 <link rel="stylesheet" href="../scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="../css/content-box.css">
  <link rel="stylesheet" href="../css/image-box.css">
   <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../scripts/magnific-popup.css">
  <link rel="stylesheet" href="../scripts/jquery.flipster.min.css">

    <style>
  .adr-save,.adr-save:hover
    {
    background:#AAD1D6!important;
    border-color:#AAD1D6!important;
    color: #000 !important;
    border-radius: 5px !important;
    }
    .adr-cancel
    {
    /*background:#5cb85c!important;
    border-color:#5cb85c!important;*/
    background:#F2ADA8!important;
    border-color:#F2ADA8!important;
    color: #000 !important;
    border-radius: 5px !important;
     
    }
    .adr-success
    {
    /*background:#5cb85c!important;
    border-color:#5cb85c!important;*/
    background:#AAD1D6!important;
    border-color:#AAD1D6!important;
     color: #000 !important;
     border-radius: 5px !important;
    }

     a.adr-save > i,button.adr-save > i,a.adr-cancel > i,button.adr-cancel > i,a.adr-save > span,a.btn-default > i,button.btn-default > i
{
  color: #000 !important;

} 

  .tab-black
  {
    background-color: white;
    color: black;
  }
  .tab-box > .panel, .tab-box > .panel-box > .panel{
    border-color: #585858;
  }
  .mfp-container
{
background:none!important;
}
 </style>

<script>
var calid;
function calDetails(calid)
{
$("#dayVal").val(calid);

}
</script>
<script src="dropzone/dropzone.js"></script>
<script src="dropzone/validate.js"></script>
<script>

</script>
<link rel="stylesheet" href="dropzone/dropzone.css">
     <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <!-- Extra optional content header -->
</head>
<body>
  <body class="home device-l"><input type="hidden" name="dayVal" id="dayval" value="">

      <div id="preloader" style="display: none;"></div>
      <header data-menu-anima="fade-left">
          <div class="navbar navbar-default over wide-area" role="navigation">
              <div class="navbar navbar-main over">
                  <div class="container">
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle">
                              <i class="fa fa-bars"></i>
                          </button>
                          <a class="navbar-brand" href="../index.php" style="padding-left:30px;"><img src="../images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-6px;width:65px;height:60px">
  						<span style="display:ineline;font-size:13px;color:#000;margin-left:-4px"><span style="color:#aad1d6;font-size:18px;">f</span>otopia</span></a>

                      </div>


                      </div>
                  </div>
              </div>

      </header>

<?php
@$id=$_REQUEST['id'];
if(@$_REQUEST['approve']==1)
{
  // echo "INSERT INTO user_login(select * from user_login_temp where id=$id)";
  // exit;
mysqli_query($con,"INSERT INTO user_login(select null, `first_name`, `last_name`, `organization`, `organization_name`, `organization_branch`, `organization_email`, `organization_contact_number`, `type_of_user`, `email`, `password`, `contact_number`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `email_verification_code`, `email_verified`, `profile_pic`, `profile_pic_image_type`, `last_login`, `last_login_ip`, `registered_on`, `online_now`, `pc_admin_id`, `pc_admin_user_id`, `csr_id`, `location` from user_login_temp where id=$id)");

$inserted_id=mysqli_insert_id($con);
$profile_id=@$_REQUEST['profile_id'];
mysqli_query($con,"update realtor_profile set realtor_id=$inserted_id where id=$profile_id");
mysqli_query($con,"delete from user_login_temp where id=$id");
header("location:Realtor_approve.php?update_password=$inserted_id");
}
elseif(isset($_REQUEST['approve'])) {


  $profile_id=@$_REQUEST['profile_id'];
  mysqli_query($con,"delete from realtor_profile where id=$profile_id");
  mysqli_query($con,"delete from user_login_temp where id=$id");
  header("location:Realtor_approve.php?fail=1");
}
if(isset($_REQUEST['passresetbtn']))
{
  $id=@$_REQUEST['id'];
  $password=@$_REQUEST['password'];
  // echo "UPDATE `user_login` SET `password`='$password' where id=$id";
  // exit;
  mysqli_query($con,"update user_login set password='$password' where id=$id");
  header("location:Realtor_approve.php?reg_success=1");

}
 if(isset($_REQUEST['reg_success'])) {
  ?>
  <div class="container content box-middle-container full-screen-size" data-sub-height="238">
              <div class="row">
                  <div class="col-md-12 text-center box-middle">
                      <div>
                          <hr class="space m">
                          <h1 >Registration Successful!</h1>
                          <h5>
                          You are successfully registered as a Realtor<br />
                          <span >You will be notified in the email when Admin approves your registration.</span> <br />
                          <span >You can login only after admin approves your account.</span>
                          </h5>
                          <hr class="space m">
                          <a class="anima-button btn-ms btn adr-cancel"  href="../index.php"><i class="fa fa-long-arrow-left"></i>Go back to home</a>
                      </div>
                  </div>
              </div>
          </div>
<?php } ?>
<?php
if(isset($_REQUEST['fail'])) {
 ?>
 <div class="container content box-middle-container full-screen-size" data-sub-height="238">
             <div class="row">
                 <div class="col-md-12 text-center box-middle">
                     <div>
                       <hr class="space m">
                       <h1 style="font-size:80px"><i class="fa fa-frown-o" aria-hidden="true" style="color:orange"></i></h1>
                       <h3>
                       Thanks & Hope you come back with us soon!<br />
                      </h3>
                       <hr class="space m">
                       <a class="anima-button btn-ms btn adr-save circle-button" style="" id="label_go_back_home" adr_trans="label_go_back_home" href="../index.php"><i class="fa fa-long-arrow-left"></i>Go back to home</a>
                     </div>
                 </div>
             </div>
         </div>
<?php } ?>
<?php
if(isset($_REQUEST['update_password']))
{?>

  <br>
  <br>
  <p align="center" style="font-size: x-large;color:black;margin-top: 10px;"> Create Password</p>
  <div class="col-md-4">
  </div>
  <form action="" class="form-box form-ajax" method="post"  onSubmit="return validateData()">
  <div class="row">
  <div class="col-md-4">
  <p align="left" id="label_password" adr_trans="label_password">Password</p>
  <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
  <input type="hidden" name="id" value="<?php echo $_REQUEST['update_password']; ?>" />
  </div>
  </div>

  <div class="col-md-4">
  </div>
  <div class="row">
  <div class="col-md-4">
  <p align="left" id="label_confirm_password" adr_trans="label_confirm_password">Confirm Password</p>
  <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
  </div></div>




  <div class="col-md-4">
  <br />
  <span class="g-recaptcha" data-sitekey="6LfcQV0aAAAAALoVQq1XWMiLQDmIOadNhXqLStI_"></span>
  <span id="error"></span>
  </div>




  <div class="row">
  <div class="col-md-4"><center><hr class="space s">

  <div class="error-box"  style="display:none;">
  <div class="alert alert-warning" id="error-msg">&nbsp;</div>
  </div>

  <button class="anima-button btn-sm btn adr-save" type="submit" name="passresetbtn"><i class="fa fa-sign-in"></i>Create</button>
  &nbsp;&nbsp;<a class="anima-button  btn-sm btn adr-cancel" id="label_cancel" adr_trans="label_cancel" href="login.php"><i class="fa fa-sign-in"></i>Cancel</a>
  </center>
  </div>
  </div>



  </form>
<?php
}
?>

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
