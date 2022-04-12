<?php
ob_start();

include "connection1.php";


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
		$addressline2=$_REQUEST['addressline2'];


	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=$_REQUEST['zip'];
	$country=$_REQUEST['country'];

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

		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"insert into admin_users (first_name,last_name,email,password,type_of_user,organization,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','FotopiaAdmin','Fotopia','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())");

	//echo "select * from user_login where email='$email' and password='$pass'";



	header("location:admin_users.php?c=1");

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage9">
            <div class="row">

<hr class="space s">
			<div class="col-md-2" style="padding-left:15px;" >


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
                <div class="col-md-10" style="">

<h5><span adr_trans="" style="color:#000;margin-left: 3px;">Create Admin</span></h5>  

						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()" style="background:#fff;color:#000;opacity:0.8;width:90%;padding:20px;border-radius: 5px;">


  						<div class="col-md-6">
                                  <p>First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="">
                              </div>

  							<div class="col-md-6">
                                  <p>Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="1" maxlength="20" class="form-control form-value" required="">
                              </div>



                              <div class="col-md-6">
                                  <p>Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
						</p>
	<input id="email" name="email" placeholder="Email" type="email" autocomplete="off" onblur="this.value=this.value.trim();validate_email(this.value)" class="form-control form-value" required="">

 															</div>


  							 <div class="col-md-6">
                                  <p>Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" required="">
                              </div>
                              <div class="col-md-6">
                                  <p>Password</p>
                                  <input id="password" name="password" placeholder="password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">

                              </div>
  							<div class="col-md-6">
                                  <p>Confirm Password</p>
                                  <input id="confirmpassword" name="confirmpassword" placeholder="Confirm password" type="password" autocomplete="off" class="form-control form-value" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                              </div>



  						 <div class="col-md-6">
  						  <p>Address Line 1</p>
  						   <input id="addressline1" name="addressline1" placeholder="Address line 1" type="text" autocomplete="off" class="form-control form-value" required="">
  						 </div>

  							 <div class="col-md-6">
  						  <p>Address Line 2</p>
  						   <input id="addressline2" name="addressline2" placeholder="Address line 2" type="text" autocomplete="off" class="form-control form-value" >
  						 </div>

  						<div class="col-md-6">
  							 <p>City</p>
  							<select name="city" class="form-control form-value" required="">
  														<option value="Alesund">Alesund</option>
  														<option value="Arendal">Arendal</option>
  														<option value="Bergen">Bergen</option>
  														<option value="Bodo">Bodo</option>
  														<option value="Drammen">Drammen</option>
  														<option value="Egersund">Egersund</option>
  														<option value="Farsund">Farsund</option>
  														<option value="Flekkefjord">Flekkefjord</option>
  														<option value="Floro">Floro</option>
  														<option value="Fredrikstad">Fredrikstad</option>
  														<option value="Gjovik">Gjovik</option>
  														<option value="Grimstad">Grimstad</option>
  														<option value="Halden">Halden</option>
  														<option value="Hamar">Hamar</option>
  														<option value="Hammerfest">Hammerfest</option>
  														<option value="Harstad">Harstad</option>
  														<option value="Haugesund">Haugesund</option>
  														<option value="Holmestrand">Holmestrand</option>
  														<option value="Honefoss">Honefoss</option>
  														<option value="Horten">Horten</option>
  														<option value="Kongsberg">Kongsberg</option>
  														<option value="Kongsvinger">Kongsvinger</option>
  														<option value="Kristiansand">Kristiansand</option>
  														<option value="Kristiansund">Kristiansund</option>
  														<option value="Larvik">Larvik</option>
  														<option value="Lillehammer">Lillehammer</option>
  														<option value="Mandal">Mandal</option>
  														<option value="Molde">Molde</option>
  														<option value="Moss">Moss</option>
  														<option value="Namsos">Namsos</option>
  														<option value="Narvik">Narvik</option>
  														<option value="Notodden">Notodden</option>
  														<option value="Oslo">Oslo</option>
  														<option value="Porsgrunn">Porsgrunn</option>
  														<option value="Risor">Risor</option>
  														<option value="Sandefjord">Sandefjord</option>
  														<option value="Sandnes">Sandnes</option>
  														<option value="Sarpsborg">Sarpsborg</option>
  														<option value="Skien">Skien</option>
  														<option value="Sogne">Sogne</option>
  														<option value="Stavanger">Stavanger</option>
  														<option value="Steinkjer">Steinkjer</option>
  														<option value="Tonsberg">Tonsberg</option>
  														<option value="Tromso">Tromso</option>
  														<option value="Trondheim">Trondheim</option>
  														<option value="Vadso">Vadso</option>
  														<option value="Vardo">Vardo</option>
  														<option value="Vennesla">Vennesla</option>
  														</select>
  							</div>

  							<div class="col-md-6">
  							 <p>State</p>
  							<select name="state" class="form-control form-value" required="">
  														<option value="More og Romsdal">More og Romsdal</option>
  														<option value="Aust-Agder">Aust-Agder</option>
  														<option value="Hordaland">Hordaland</option>
  														<option value="Nordland">Nordland</option>
  														<option value="Buskerud">Buskerud</option>
  														<option value="Rogaland">Rogaland</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														<option value="Sogn og Fjordane">Sogn og Fjordane</option>
  														<option value="Ostfold">Ostfold</option>
  														<option value="Oppland">Oppland</option>
  														<option value="Aust-Agder">Aust-Agder</option>
  														<option value="Ostfold">Ostfold</option>
  														<option value="Hedmark">Hedmark</option>
  														<option value="Finnmark">Finnmark</option>
  														<option value="Troms">Troms</option>
  														<option value="Rogaland">Rogaland</option>
  														<option value="Vestfold">Vestfold</option>
  														<option value="Buskerud">Buskerud</option>
  														<option value="Vestfold">Vestfold</option>
  														<option value="Buskerud">Buskerud</option>
  														<option value="Hedmark">Hedmark</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														<option value="More og Romsdal">More og Romsdal</option>
  														<option value="Vestfold">Vestfold</option>
  														<option value="Oppland">Oppland</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														<option value="More og Romsdal">More og Romsdal</option>
  														<option value="Ostfold">Ostfold</option>
  														<option value="Nord-Trondelag">Nord-Trondelag</option>
  														<option value="Nordland">Nordland</option>
  														<option value="Telemark">Telemark</option>
  														<option value="Oslo">Oslo</option>
  														<option value="Telemark">Telemark</option>
  														<option value="Aust-Agder">Aust-Agder</option>
  														<option value="Vestfold">Vestfold</option>
  														<option value="Rogaland">Rogaland</option>
  														<option value="Ostfold">Ostfold</option>
  														<option value="Telemark">Telemark</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														<option value="Rogaland">Rogaland</option>
  														<option value="Nord-Trondelag">Nord-Trondelag</option>
  														<option value="Vestfold">Vestfold</option>
  														<option value="Troms">Troms</option>
  														<option value="Sor-Trondelag">Sor-Trondelag</option>
  														<option value="Finnmark">Finnmark</option>
  														<option value="Finnmark">Finnmark</option>
  														<option value="Vest-Agder">Vest-Agder</option>
  														</select>
  							</div>
  						 <div class="col-md-6">
                                  <p>Zip Code</p>
                                  <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" required="">
                              </div>


  						<div class="col-md-6">
  							 <p>Country</p>
  							<select name="country" class="form-control form-value" required="">
  														<option value="Norway">Norway</option>
  														<option value="US">US</option>
  														</select>
  							</div>
  						<div class="col-md-6">
                                  <p>Profile Pic</p>
                                  <input id="profilepic" name="profilepic" placeholder="Profile pic" type="file" autocomplete="off" class="form-control form-value" >
                              </div>




  <?php
  		/*					<div class="col-md-12">

                                  <p>Confirm Captcha</p>
                                 <span class="g-recaptcha" data-sitekey="6LfHgzIaAAAAABt7sRE_3-noIhlhSlT01oUjzmJW" data-callback="verifyCaptcha"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfHgzIaAAAAABt7sRE_3-noIhlhSlT01oUjzmJW&amp;co=aHR0cDovL2xvY2FsaG9zdDo4MA..&amp;hl=en&amp;v=-nejAZ5my6jV0Fbx9re8ChMK&amp;size=normal&amp;cb=1z623uotmfq9" width="304" height="78" role="presentation" name="a-f1dkdujeepvd" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></span>
          <span id="error"></span>*
                              </div>  */?>




  						 <div class="row">
                              <div class="col-md-12" align="right"><hr class="space s">

  							<div class="error-box" style="display:none;">
                              <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                          </div>

  						 <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Create</button>
                         &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="admin_users.php"><i class="fa fa-times"></i>Cancel</a>
  
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
