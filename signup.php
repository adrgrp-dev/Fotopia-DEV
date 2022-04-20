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
if(isset($_REQUEST['signupbtn']))
{
   
$captcha=$_REQUEST['g-recaptcha-response'];
//echo "https://www.google.com/recaptcha/api/siteverify?secret=6LfcQV0aAAAAAE8XUGzbkDCRwKhHgtIFGkPmxb3c&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']."<br>";exit;
$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfcQV0aAAAAAE8XUGzbkDCRwKhHgtIFGkPmxb3c&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

 //  echo $response['success']."<br>";
  // print_r($response);
   //exit;
    if($response['success'] == false)
    {
        header("location:signup.php");
    }
    else
    {
        
    


	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	// $org=$_REQUEST['org'];
	// $typeofuser=$_REQUEST['typeofuser'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$contactno=$_REQUEST['contactno'];

$org_name=$_REQUEST['org_name'];
$org_branch=$_REQUEST['org_branch'];
$org_email=$_REQUEST['org_email'];
$org_no=$_REQUEST['org_no'];


	$addressline1=$_REQUEST['addressline1'];
	$addressline2=$_REQUEST['addressline2'];
	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=$_REQUEST['zip'];
	$country=$_REQUEST['country'];

$for_whom = $_REQUEST["for_whom"];

	$email_verification_code=getName(10);

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

		//echo "insert into user_login (first_name,last_name,organization,type_of_user,email,password,contact_number,address,city,state,postal_code,country,email_verified,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$org','$typeofuser','$email','$password','$contactno','$address','$city','$state','$zip','$country',1,'$imgData','$imageType',now())";exit;
if($for_whom=="realtor"){

$typeofuser = "Realtor";
$inserted_id=0;
   mysqli_query($con,"insert into user_login (type_of_user,organization_name,organization_branch,organization_contact_number,organization_email,first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,email_verification_code,email_verified,profile_pic,profile_pic_image_type,registered_on)values('$typeofuser','$org_name','$org_branch','$org_no','$org_email','$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$email_verification_code',0,'$imgData','$imageType',now())");
$inserted_id=mysqli_insert_id($con);
if($inserted_id!=0)
{
mysqli_query($con,"insert into realtor_profile (organization_name,organization_branch,organization_contact_number,organization_email,first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,realtor_id)values('$org_name','$org_branch','$org_no','$org_email','$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType','$inserted_id')");
}

header("location:regSuccess.php?name=".$fname."&lname=".$lname."&type=".$typeofuser."&email=".$email);

}

else{


$typeofuser = "Photo Company";

$user = "PCAdmin";
$inserted_id=0;
mysqli_query($con,"insert into admin_users (type_of_user,organization_name,organization_branch,organization_contact_number,organization_email,first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$user','$org_name','$org_branch','$org_no','$org_email','$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())");
$inserted_id=mysqli_insert_id($con);
if($inserted_id!=0)
{

$rootdirectory="";
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['profilepic']['tmp_name'])) {
        //echo "coming";
        $filename=$inserted_id."_".time().$_FILES['profilepic']['name'];
		$filename=str_replace(" ","",$filename);
        $imgData = addslashes(file_get_contents($_FILES['profilepic']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['logo']['tmp_name']);

        $imageType = $_FILES['profilepic']['type'];
        $rootdirectory="pc_admin_logo/".$filename;
        move_uploaded_file($_FILES['profilepic']['tmp_name'], $rootdirectory);
       

     
    }
}



mysqli_query($con,"insert into photo_company_profile (organization_name,organization_branch,email,contact_number,address_line1,address_line2,city,state,postal_code,country,pc_admin_id,logo_image_url,logo_image_type)values('$org_name','$org_branch','$email','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$inserted_id','$rootdirectory','$imageType')");
}

header("location:regSuccess.php?name=".$fname."&lname=".$lname."&type=".$typeofuser."&email=".$email);

}



	//echo "select * from user_login where email='$email' and password='$pass'";




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

input
{
box-shadow:5px 5px 5px 5px #DDD;
}
.mfp-container
{
background:none!important;
}
#tnc p
{
font-weight:bold;
padding-bottom:0px;
color:#333333!important;
}
	</style>
	<script>
  function validate_fname(val)
  {
  	var pattern=/^[a-zA-Z0-9_]+.*$/;
    if(val.match(pattern))
    {
    $("#validation_message").html("");
    return true;
    }
    else
    {
    $("#validation_message").html("Input must contain atleast one character, No space at beginning and no symbol at beginning and must start with a character.").show();
    return false;
    }
  }
  function validate_tel(val)
  {
  	//alert(val);
  	var pattern=/[0-9+.()-]$/;

    if(val.match(pattern))
    {
    $("#validation_message").html("");
    return true;
    }
    else
    {
    $("#validation_message").html("Please enter the contact number with only the allowed symbols ()-+.").show();
    return false;
    }
  }


	function validate_email(val)
{
// alert(type);
var email=$("#email").val(); 
if(email==""){

	// alert("Please enter an email");
	return false;
}
else{

	val=email;
}
var type= $("input[name='for_whom']:checked").val();


if(val!="" && typeof type !== 'undefined')
{
	// alert(type); 
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
  xhttp.open("GET","validate_email_signup.php?id="+val+"&type="+type,true);
  xhttp.send();
  }
  else{
  
  $("#Email_exist_error").html("Please select the user type!");
	   $("#Email_exist_error").show();
	   $("#email").val("");
	    $("#email").focus();
  }
}



function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

 var y = document.getElementById("confirmpassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }

}


function showStep2() {

var fname =  $("#fname").val();
var lname =  $("#lname").val();
var email =  $("#email").val();
var contactno =  $("#contactno").val();
var password =  $("#password").val();
var confirmpassword =  $("#confirmpassword").val();

var pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

var emailpattern = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;



if(fname=='')
{
$("#fname").css("border","solid 1px red");
}
else
{
$("#fname").css("border","solid 1px grey");
}
if(lname=='')
{
$("#lname").css("border","solid 1px red");
}
else
{
$("#lname").css("border","solid 1px grey");
}
if(email=='')
{
$("#email").css("border","solid 1px red");
}
else
{
$("#email").css("border","solid 1px grey");
}
if(contactno=='')
{
$("#contactno").css("border","solid 1px red");
}
else
{
$("#contactno").css("border","solid 1px grey");
}
if(password=='')
{
$("#password").css("border","solid 1px red");
}
else
{
$("#password").css("border","solid 1px grey");
}
if(confirmpassword=='')
{
$("#confirmpassword").css("border","solid 1px red");
}
else
{
$("#confirmpassword").css("border","solid 1px grey");
}




if (fname==""){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		 $("#validation_message").html("Vennligst skriv inn ditt fornavn!");
		}
		else
		{
	  $("#validation_message").html("Please enter the first name!");
		}
   $("#validation_message").css("display","block");
  $("#fname").focus();
  return false;
}

else{
  $("#validation_message").css("display","none");
}

if (lname==""){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		  $("#validation_message").html("Vennligst skriv inn ditt etternavn!");
		}
		else
		{
	 $("#validation_message").html("Please enter the last name!");
		}

  $("#validation_message").css("display","block");
  $("#lname").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}

if (email==""){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		  $("#validation_message").html("Vennligst skriv inn e-post ID!");
		}
		else
		{
	   $("#validation_message").html("Please enter the Email ID!");
		}

  $("#validation_message").css("display","block");
  $("#email").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}

if(email.match(emailpattern) == null)
{
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		 $("#validation_message").html("Vennligst skriv inn din e-post i riktig fomat!");
		}
		else
		{
	 $("#validation_message").html("Please enter email in the correct format!");
		}

  $("#validation_message").css("display","block");
  $("#email").focus();
  return false;

}

else{
$("#validation_message").css("display","none");

}


if (contactno==""){

var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#validation_message").html("Vennligst skriv inn kontaktnummeret!");
		}
		else
		{
	 $("#validation_message").html("Please enter the contact number!");
		}
  $("#validation_message").html("Please enter the contact number!");
  $("#validation_message").css("display","block");
  $("#contactno").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}

if (password==""){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#validation_message").html("Vennligst skriv passordet!");
		}
		else
		{
	$("#validation_message").html("Please enter the password!");
		}


  $("#validation_message").css("display","block");
  $("#password").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}


if (confirmpassword==""){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#validation_message").html("Vennligst bekreft passordet!");
		}
		else
		{
	$("#validation_message").html("Please enter the confirm password! ");
		}

  $("#validation_message").css("display","block");
  $("#confirmpassword").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}

if (confirmpassword!=password){
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		 $("#validation_message").html("Passordet og det bekreftede passordet m� v�re det samme!");
		}
		else
		{
	 $("#validation_message").html("The password and confirm password should be same!");
		}


  $("#validation_message").css("display","block");
  $("#confirmpassword").focus();
  return false;
}

else{

  $("#validation_message").css("display","none");
}




if(password.match(pattern) == null)
{
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		 $("#validation_message").html("Vennligst skriv inn passord i riktig format!");
		}
		else
		{
	 $("#validation_message").html("Please enter password in the correct format!");
		}


  $("#validation_message").css("display","block");
  $("#password").focus();
  return false;

}

else{
$("#validation_message").css("display","none");

}


if($('input:radio[name=for_whom]').is(':checked')){

 $("#validation_message").css("display","none");
}

else{
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#validation_message").html("Vennligst velg brukertype!");
		}
		else
		{
	 $("#validation_message").html("Please select the user type!");
		}

  $("#validation_message").css("display","block");
  $("#for_whom").focus();
  return false;
}





   document.getElementById('step1').style.display = "none";
   document.getElementById('step2').style.display = "block";

}

function showStep1() {

   document.getElementById('step2').style.display = "none";
   document.getElementById('step1').style.display = "block";

}



function step2Validation()
{

var org_name =  $("#org_name").val();
if(org_name=='')
{
$("#org_name").css("border","solid 1px red");
}
else
{
$("#org_name").css("border","solid 1px grey");
}


var org_branch =  $("#org_branch").val();
if(org_branch=='')
{
$("#org_branch").css("border","solid 1px red");
}
else
{
$("#org_branch").css("border","solid 1px grey");
}

var org_email =  $("#org_email").val();
if(org_email=='')
{
$("#org_email").css("border","solid 1px red");
}
else
{
$("#org_email").css("border","solid 1px grey");
}


var org_no =  $("#org_no").val();
if(org_no=='')
{
$("#org_no").css("border","solid 1px red");
}
else
{
$("#org_no").css("border","solid 1px grey");
}

var addressline1 =  $("#addressline1").val();
if(addressline1=='')
{
$("#addressline1").css("border","solid 1px red");
}
else
{
$("#addressline1").css("border","solid 1px grey");
}


// var addressline2 =  $("#addressline2").val();
// if(addressline2=='')
// {
// $("#addressline2").css("border","solid 1px red");
// }
// else
// {
// $("#addressline2").css("border","solid 1px grey");
// }


// var addressline2 =  $("#addressline2").val();
// if(addressline2=='')
// {
// $("#addressline2").css("border","solid 1px red");
// }
// else
// {
// $("#addressline2").css("border","solid 1px grey");
// }


var city =  $("#city").val();
if(city=='')
{
$("#city").css("border","solid 1px red");
}
else
{
$("#city").css("border","solid 1px grey");
}

var state =  $("#state").val();
if(state=='')
{
$("#state").css("border","solid 1px red");
}
else
{
$("#state").css("border","solid 1px grey");
}

var zip =  $("#zip").val();
if(zip=='')
{
$("#zip").css("border","solid 1px red");
}
else
{
$("#zip").css("border","solid 1px grey");
}

var country =  $("#country").val();
if(country=='')
{
$("#country").css("border","solid 1px red");
}
else
{
$("#country").css("border","solid 1px grey");
}

}

function get_states(cityIs) {
	
  if(cityIs!="")
  {
  $("#validation_message").css("display","none");
  $("#validation_message").html("");
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
  var split=this.responseText.split("zipcode");
    document.getElementById("state").innerHTML = split[0];
    // document.getElementById("zip").value= split[1];
	
    }
  xhttp.open("GET", "getState.php?city="+cityIs, true);
  xhttp.send();
  }
  else
  {
    $("#validation_message").css("display","block");
    $("#validation_message").html("(Please select your city!.)");
  }
}	 

	</script>


	<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container content">


            <div class="row">
			  <form action="" class="form-box form-ajax" method="post"  enctype="multipart/form-data"  onSubmit="return validateData()">

			<div class="col-md-6">&nbsp;


	<br /><br /><br />



                    <div class="flexslider slider white">

                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
					<ul class="slides" style="width: 1000%; transition-duration: 0s; transform: translate3d(-1110px, 0px, 0px);">


					<li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/1.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/1.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                         Most people would have the mentality of listing photos being a necessary expense to sell a home
                                        </h5>
                                    </span>
                                </a>
                            </li>



							 <li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/6.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/6.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                            There are plenty of successful real estate teams that reuse their listing content to generate leads of buyers and sellers.
                                        </h5>
                                    </span>
                                </a>
                            </li>


                            <li style="width: 555px; float: left; display: block;" class="">
                                <a class="img-box lightbox inner" href="images/signupimages/2.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/2.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                          When hiring a photographer, take a look at their track record for real estate photography
                                        </h5>
                                    </span>
                                </a>
                            </li>

							 <li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/7.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/7.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                          Pay attention to how your photographer interacts with your clients.
                                        </h5>
                                    </span>
                                </a>
                            </li>


                             <li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/3.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/3.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                           Professional photos will help sell your listing quicker, for more money, and make you look amazing to attract more buyers and sellers to your business.
                                        </h5>
                                    </span>
                                </a>
                            </li>
                            <li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/4.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/4.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                           Brand yourself with great looking photos and marketing content which is achieved only through professional photography.
                                        </h5>
                                    </span>
                                </a>
                            </li>
                        <li class="" style="width: 555px; float: left; display: block;">
                                <a class="img-box lightbox inner" href="images/signupimages/5.jpg" data-lightbox-anima="show-scale">
                                    <span><img alt="" src="images/signupimages/5.jpg" draggable="false"></span>
                                    <span class="caption-box">
                                        <h5 class="caption">
                                           Photographers who advocate for your and are with you throughout your listings make great business partners for you and your career.
                                        </h5>
                                    </span>
                                </a>
                            </li></ul>

							</div><ol class="flex-control-nav flex-control-paging">

							</ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#"></a></li><li class="flex-nav-next"><a class="flex-next" href="#"></a></li></ul></div>







			</div>


                <div class="col-md-6" style="padding-left:30px;">


                      		<br>
						<?php if(@isset($_REQUEST["success"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_msg_sent" adr_trans="label_msg_sent">Congratulations. Your message has been sent successfully</div>
                        </div>
						<?php } elseif(isset($_REQUEST["failed"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="text-warning" id="label_invalid_loggin" adr_trans="label_invalid_loggin">Invalid login  credentials. Please try again.</div>
                        </div>
						<?php }  elseif(isset($_REQUEST["sessexp"])) { ?>
                        <div class="error-box"  style="display:block;">
                            <div class="text-warning" id="label_session_expired" adr_trans="label_session_expired">Your session expired. Please login again.</div>
                        </div>
						<?php } else { ?>
				<div class="error-box"  style="display:none;">
                           
                        </div>
						<?php } ?>



                       <div class="col-md-12"><h3 align="center" id="label_signup" adr_trans="label_signup"> SignUp</h3></div>

                       <br><i class="text-left" style="width:130px;word-wrap:break-word;padding-left:0px;text-align:"><span adr_trans="label_welcome_to_sign_up">Welcome to our signup page. Please pick your option as Realtor or Photo Company</span></i><br><br>

                       <div class="error-box" id="validation_message" style="margin-left:20px;color:red;display:none;font-style:italic;" align="center">
                            <div class="text-warning" ></div>
                        </div>
			<span style="margin-left:110px;color:red;display:none;font-style:italic;" id="Email_exist_error" align="center" class=""></span>

          <div id="step1" name="step1">

             <div class="col-md-6">
    <center><label for="from_homeseller"> 
          <input type="radio" name="for_whom" onchange="validate_email('aa')" value="realtor" required />&nbsp;&nbsp;<span adr_trans="label_realtor">Realtor </span>
        </label>
      </center>
      </div>

      <div class="col-md-6">
        <center><label for="from_realtor">
          <input type="radio" name="for_whom" onchange="validate_email('aa')" value="photo_company"  />&nbsp;&nbsp;<span adr_trans="label_photo_company"> Photo company</span>
        </label>
        </center>
        <br>
      </div>
						<div class="col-md-6">
                                <p><span id="label_first_name" adr_trans="label_first_name">First Name</span></p>
                                <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" class="form-control form-value" onblur="return validate_fname(this.value)" minlength="1" maxlength="20" required="" >
                            </div>

							<div class="col-md-6">
                                <p id="label_last_name" adr_trans="label_last_name">Last Name</p>
                                <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="">
                            </div>

							<!-- <div class="col-md-6">
                                <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" class="form-control form-value" required="">
                            </div> -->

							<!-- <div class="col-md-6">
							 <p id="label_type_user" adr_trans="label_type_user">Type of user</p>
							<select name="typeofuser" class="form-control form-value" required="">
							<option value="Realtor" id="label_realtor" adr_trans="label_realtor">Realtor
                            </option>
							<option value="Photographer" id="label_photographer" adr_trans="label_photographer" >Photographer</option>
							</select>
							</div> -->

                            <div class="col-md-6">
                                <p id="label_email" adr_trans="label_email">Email</p>

                                <input id="email" name="email" placeholder="Email" type="email"    autocomplete="off" class="form-control form-value" required="" onblur="this.value=this.value.trim();validate_email(this.value)">
                            </div>


							 <div class="col-md-6">
                                <p id="label_contact_no" adr_trans="label_contact_no">Contact Number</p>
           <input id="contactno" name="contactno" placeholder="Contact number" type="tel"  onblur="return validate_tel(this.value)" min="1" autocomplete="off" class="form-control form-value" required="">
                            </div>


                            <div class="col-md-6">
                                <p id="label_password" adr_trans="label_password"><i class="fa fa-info-circle" style="float:right;padding-top:4px;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></i></p>

                               <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  style="display:inline" />

                            </div>

							<div class="col-md-6">
                                <p id="label_confirm_password" adr_trans="label_confirm_password">Confirm Password</p>
                                <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">


                            </div>
<div class="col-md-12"><span style="font-style:italic; line-height:normal; font-weight:500">Password Must contain at least 1 number, 1 uppercase letter and at least 8 or more characters</span></div>
                            <br>

                            <div class="col-md-6">

                                <input type="checkbox" onclick="showPassword()"> Show Password


                            </div>


                            <div class="col-md-6" align="left">
                                <br><br>

                            <a class="anima-button circle-button btn-sm btn adr-save" onclick="return showStep2()" id="next" name="next" adr_trans="label_next" ><i class="fa fa-chevron-circle-right"></i>Next</a>&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="index.php" id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>



                            </div>

                            </div>



<div id="step2" name="step2" style="display:none" >


    <div class="col-md-6">
                                <p adr_trans="label_org_name">Organization name</p>
                                <input id="org_name" name="org_name" placeholder="Organization name" type="text" autocomplete="off" class="form-control form-value" required="" >
                            </div>

                            <div class="col-md-6">
                                <p adr_trans="label_org_branch">Organization branch</p>
                                <input id="org_branch" name="org_branch" placeholder="Organization name" type="text" autocomplete="off" class="form-control form-value" required="">
                            </div>

                            <div class="col-md-6">
                                <p adr_trans="label_org_email">Organization Email</p>

                                <input id="org_email" name="org_email" placeholder="Organization Email" type="email" autocomplete="off" class="form-control form-value" required="" onblur="this.value=this.value.trim();">
                            </div>


                             <div class="col-md-6">
                                <p adr_trans="label_org_contact_no">Organization contact number</p>
           <input id="org_no" name="org_no" placeholder="Organization contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" min="1" autocomplete="off" class="form-control form-value" required="">
                            </div>

						 <div class="col-md-6">
						  <p id="label_address_line1" adr_trans="label_address_line1">Address Line 1</p>
						   <input id="addressline1" name="addressline1" placeholder="Address line 1" type="text" autocomplete="off" class="form-control form-value" required="">
						 </div>

							 <div class="col-md-6">
						  <p id="label_address_line2" adr_trans="label_address_line2">Address Line 2</p>
						   <input id="addressline2" name="addressline2" placeholder="Address line 2" type="text" autocomplete="off" class="form-control form-value">
						 </div>

						<div class="col-md-6">
							 <p id="label_city" adr_trans="label_city">City</p>
							<select name="city" id="city" onchange="get_states(this.value)" class="form-control form-value" required="">
								<option value="">Select City</option>
							<?php
							$city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>"><?php echo $city['cities']; ?></option>
							<?php } ?>
							</select>
							</div>

							<div class="col-md-6">
							 <p id="label_state" adr_trans="label_state">State</p>
							<select name="state" id="state" class="form-control form-value" required="">
						
							</select>
							</div>
						 <div class="col-md-6">
                                <p id="label_zip_code" adr_trans="label_zip_code">Zip Code</p>
                                <input name="zip" id="zip" placeholder="Zip code" type="number" min="1" autocomplete="off" class="form-control form-value" required="">
                            </div>


						<div class="col-md-6">
							 <p id="label_country" adr_trans="label_country">Country</p>
							<select name="country" id="country" class="form-control form-value" required="">
							<?php
							//$country1=mysqli_query($con,"select * from countries");
							//while($country=mysqli_fetch_array($country1))
							//{
							?>
							<option value="Norway"><?php //echo $country['countryName']; ?>Norway</option>
							<?php //} ?>
							</select>
							</div>
						<div class="col-md-6">
                                <p id="label_profile_pic" adr_trans="label_profile_pic">Profile Pic</p>
           <input id="profilepic" name="profilepic" placeholder="Profile pic" type="file" autocomplete="off" class="form-control form-value"  accept="image/*">
                            </div>


							<div class="col-md-6">
                               <br>
                                <input id="terms" name="terms" type="checkbox" class=" form-value" required="" />&nbsp;&nbsp;<span id="label_accept" adr_trans="label_accept">Accept our</span>
                                <a href="#tnc" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" id="label_terms" adr_trans="label_terms">Terms & Conditions</a><br />
                            </div>


							<div class="col-md-12">
                                <p id="label_confirm_captcha" adr_trans="label_confirm_captcha">Confirm Captcha</p>
                               <span class="g-recaptcha" data-sitekey="6LfcQV0aAAAAALoVQq1XWMiLQDmIOadNhXqLStI_"  data-callback='submit' data-action='submit'></span>
        <span id="error"></span>
                            </div>




						 <div class="row">
                            <div class="col-md-12"><center><hr class="space s">

							<div class="error-box"  style="display:none;">
                            <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                        </div>

						  <a class="anima-button circle-button btn-sm btn adr-cancel" onclick="showStep1()" id="next" name="next" ><i class="fa fa-chevron-circle-left"></i>Back</a>&nbsp;&nbsp;<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="signupbtn" id="label_signup" onclick="return step2Validation()"><i class="fa fa-sign-in"></i><span  adr_trans="label_signup">Signup</span></button>

</center>
					   </div>
                        </div>
</div>

                </div> </form>


            </div>
        </div>
		 <div id="tnc" class="box-lightbox white" style="padding:25px">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="label_terms" adr_trans="label_terms">Terms and Conditions</h5>
                            <hr>
                            <span class="sub" style="color:#333333">Read and accept our terms and conditions.<br /><br /></span>

						<?php
						$cmsPage=mysqli_query($con,"select * from cms_pages where id=2");
						$cmsPage1=mysqli_fetch_array($cmsPage);
						echo $cmsPage1['page_content'];
						?>
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




        var response = grecaptcha.getResponse();
        if(response.length == 0) {
		$('#error-msg').html('Please Confirm with captcha');
	  $('.error-box').show();
            //document.getElementById('error').innerHTML = '<span style="color:red;margin-left:20px;">  This field is required.</span>';
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
