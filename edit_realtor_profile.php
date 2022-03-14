<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION["loggedin_id"];
$loggedin_name=$_SESSION["loggedin_name"];
$res=mysqli_query($con,"select * from realtor_profile where realtor_id='$loggedin_id'");
//echo "select * from photographer_profile where photographer_id='$loggedin_id";
$res1=mysqli_fetch_array($res);
$userExist=mysqli_num_rows($res);


	$imgData="";
	$imageProperties="";
	$imageType="";
	if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
        //echo "coming";
        $imgData = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['logo']['tmp_name']);
        $imageType = $_FILES['logo']['type'];
      /*  $sql = "INSERT INTO output_images(imageType ,imageData)
	VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: listImages.php");
        } */
    }
}



  $imgData1="";
  $imageProperties1="";
  $imageType1="";
  if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
        //echo "coming";
        $imgData1 = addslashes(file_get_contents($_FILES['profile_pic']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['logo']['tmp_name']);
        $imageType1 = $_FILES['profile_pic']['type'];
      /*  $sql = "INSERT INTO output_images(imageType ,imageData)
  VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: listImages.php");
        } */
    }
}



if($userExist==0)
{

mysqli_query($con,"insert into realtor_profile(realtor_id)values('$loggedin_id')");


}

if(isset($_REQUEST['profilebtn']))
{

$portfolio=$_REQUEST['portfolio'];
$organization_name=$_REQUEST['organization_name'];
$organization_branch=$_REQUEST['organization_branch'];
$realtor_employer_id=strtoupper($_REQUEST['realtor_employer_id']);

$organization_contact_number=$_REQUEST['organization_contact_number'];
$organization_email=$_REQUEST['organization_email'];

$address_line1=$_REQUEST['address_line1'];
$address_line2=$_REQUEST['address_line2'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];
$linkedin_id=$_REQUEST['linkedin_id'];
$facebook_id=$_REQUEST['facebook_id'];
$instagram_id=$_REQUEST['instagram_id'];
$youtube_id=$_REQUEST['youtube_id'];
$twitter_id=$_REQUEST['twitter_id'];
$contact_number=$_REQUEST['contact_number'];
// $email=$_REQUEST['email'];

$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
//$user_id=$_REQUEST['user_id'];
//$password=$_REQUEST['password'];
// $profile_pic=$_REQUEST['profile_pic'];



if($_FILES['logo']['size'] == 0 && $_FILES['profile_pic']['size'] == 0) {

mysqli_query($con,"update realtor_profile set realtor_employer_id='$realtor_employer_id',portfolio='$portfolio',organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',first_name='$fname',last_name='$lname' where realtor_id='$loggedin_id'");

mysqli_query($con,"update user_login set organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname' where id='$loggedin_id'");

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'Realtor',$loggedin_id,now())");

}

elseif($_FILES['profile_pic']['size'] == 0){


  mysqli_query($con,"update realtor_profile set realtor_employer_id='$realtor_employer_id',portfolio='$portfolio',organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',first_name='$fname',last_name='$lname',logo='$imgData',logo_image_type='$imageType' where realtor_id='$loggedin_id'");

  mysqli_query($con,"update user_login set organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,
    'Realtor',$loggedin_id,now())");

}

elseif($_FILES['logo']['size'] == 0){


  mysqli_query($con,"update realtor_profile set realtor_employer_id='$realtor_employer_id',portfolio='$portfolio',organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',first_name='$fname',last_name='$lname',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where realtor_id='$loggedin_id'");

  mysqli_query($con,"update user_login set organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,
  'Realtor',$loggedin_id,now())");

}

else {

mysqli_query($con,"update realtor_profile set realtor_employer_id='$realtor_employer_id',portfolio='$portfolio',organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',first_name='$fname',last_name='$lname',logo='$imgData',logo_image_type='$imageType',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where realtor_id='$loggedin_id'");

mysqli_query($con,"update user_login set organization_name='$organization_name',organization_branch='$organization_branch',organization_contact_number='$organization_contact_number',organization_email='$organization_email',contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'Realtor',$loggedin_id,now())");

}

//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,$loggedin_id,now())");


header("location:realtor_profile.php?u=1");
}
?>
<?php include "header.php";  ?>
<style>
p{
		font-weight:bold;
		padding-bottom:0px;
	}
.btn-default
{
margin-left:0px!important;
}
</style>
 <div class="section-empty bgimage5">
        <div class="" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:0px;">
	<?php include "sidebar.php"; ?>


			</div>

<script>

  function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

                <div class="col-md-10">

<hr class="space s">
<table id="profile" style="color: #000;background: #FFF;border-radius:10px;opacity:0.7;width:100%"><tr><td style="padding:20px;">
				<!-- <h5 class="text-center" style="color:#000;display:none" id="label_my_profile" adr_trans="label_my_profile">My Profile</h5> -->


				<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h5 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Welcome to Fotopia!<br />Its mandatory to complete the profile information to understand you better</h5></div> <?php } ?>
						<div class="col-md-12"><h5 align="center" style="color:#000" adr_trans="label_edit_realtor">Add / Edit Realtor profile</h5></div>

						<form name="profile" method="post" action="" enctype="multipart/form-data">

 								<div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_logo">Logo</p>
                               <img src="data:<?php echo @$res1['logo_image_type']; ?>;base64,<?php echo base64_encode(@$res1['logo']); ?>" width="60" height="60" />
								</div>

                <div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_profile_picture">Profile picture</p>
                               <img src="data:<?php echo @$res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode(@$res1['profile_pic']); ?>" width="60" height="60" />
                </div>

								<br>

 								<div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_org_name">Organization name</p>
                                <input id="organization_name" name="organization_name" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="20" required="" value="<?php echo @$res1['organization_name']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_org_branch">Organization branch</p>
                                <input id="organization_branch" name="organization_branch" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="20" required="" value="<?php echo @$res1['organization_branch']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;">Company ID</p>
                                <input id="realtor_employer_id" name="realtor_employer_id" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['realtor_employer_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_org_contact_no">Organization Contact number</p>
                                <input id="organization_contact_number" name="organization_contact_number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" minlength="6" maxlength="20" required="" value="<?php echo @$res1['organization_contact_number']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_org_email">Organization Email</p>
                                <input id="organization_email" name="organization_email" type="email" autocomplete="off" class="form-control form-value" onblur="this.value=this.value.trim()" required="" value="<?php echo @$res1['organization_email']; ?>">
								</div>




                              <div class="col-md-6">
                                   <p style="color:#000;" adr_trans="label_change_logo">Change logo</p>
                                  <input id="logo" name="logo" placeholder="logo" type="file" autocomplete="off" class="form-control form-value" >

                              </div>


                              <div class="col-md-6">
                                <p style="color:#000;"><span adr_trans="label_linkedin_profile">LinkedIN profile</span>&nbsp;<span class="fa fa-linkedin" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;"></span></p>
                                <input id="linkedin_id" name="linkedin_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['linkedin_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p  style="color:#000;" ><span adr_trans="label_fb_profile">Facebook profile</span>&nbsp;<span class="fa fa-facebook" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;"></span></p>
                                <input id="facebook_id" name="facebook_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['facebook_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;"><span adr_trans="label_insta_profile">Instagram profile</span>&nbsp;<span class="fa fa-instagram" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;"></span></p>
                                <input id="instagram_id" name="instagram_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['instagram_id']; ?>">
								</div>
                <div class="col-md-6">
                                <p style="color:#000;" ><span adr_trans="label_youtube_profile">Youtube profile</span>&nbsp;<span class="fa fa-youtube" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;"></span></p>
                                <input id="youtube_id" name="youtube_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['youtube_id']; ?>">
                </div>
                <div class="col-md-6">
                                <p style="color:#000;"><span adr_trans="label_twitter_profile">Twitter profile</span>&nbsp;<span class="fa fa-twitter" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;"></span></p>
                                <input id="twitter_id" name="twitter_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['twitter_id']; ?>">
                </div>


				              <div class="col-md-6">


                                <p id="label_portfolio" adr_trans="label_portfolio" style="color:#000;" adr_trans="label_portfolio">Portfolio</p>
                                <input id="portfolio" name="portfolio" type="text" autocomplete="off" class="form-control form-value" placeholder="Listing, own website, etc." value="<?php echo @$res1['portfolio']; ?>">

								</div>


                <div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_first_name">First name</p>
                                <input id="fname" name="fname" type="text" autocomplete="off" class="form-control form-value" minlength="1" maxlength="20" required="" value="<?php echo @$res1['first_name']; ?>">
                </div>

                <div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_last_name">Last name</p>
                                <input id="lname" name="lname" type="text" autocomplete="off" class="form-control form-value" minlength="1" maxlength="20" required="" value="<?php echo @$res1['last_name']; ?>">
                </div>


                <div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_contact_no">Contact number</p>
                                <input id="contact_number" name="contact_number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" minlength="6" maxlength="20" required="" value="<?php echo @$res1['contact_number']; ?>">
                </div>

                <!-- <div class="col-md-6">
                                <p style="color:#000;">Email</p>
                                <input id="email" name="email" type="email" autocomplete="off" class="form-control form-value" required="" value="<?php //echo @$res1['email']; ?>">
                </div> -->


                <div class="col-md-6">
                <p style="color:#000;" adr_trans="label_address_line1">Address line 1</p>
                 <input id="address_line1" name="address_line1" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30" required="" value="<?php echo @$res1['address_line1']; ?>">
               </div>

                 <div class="col-md-6">
                <p style="color:#000;" adr_trans="label_address_line2">Address line 2</p>
                 <input id="address_line2" name="address_line2" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30" value="<?php echo @$res1['address_line2']; ?>">
               </div>

              <div class="col-md-6">
                 <p style="color:#000;" adr_trans="label_city">City</p>
                <select name="city" class="form-control form-value" required="">
              <?php
              $city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
              while($city=mysqli_fetch_array($city1))
              {
              ?>
              <option value="<?php echo $city['cities']; ?>" <?php if(@$res1['city']==$city['cities']) { echo "selected"; } ?>><?php echo $city['cities']; ?></option>
              <?php } ?>
              </select>
                </div>

                <div class="col-md-6">
                  <p style="color:#000;" adr_trans="label_state">State</p>
                <select name="state" class="form-control form-value" required="" >
              <?php
              $state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc");
              while($state=mysqli_fetch_array($state1))
              {
              ?>
              <option value="<?php echo $state['states']; ?>" <?php if(@$res1['state']==$state['states']) { echo "selected"; } ?>><?php echo $state['states']; ?></option>
              <?php } ?>
              </select>
                </div>

               <div class="col-md-6">
                                   <p style="color:#000;" adr_trans="label_zip_code">Zip code</p>
                                  <input id="zip" name="zip" type="number" autocomplete="off" class="form-control form-value"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" required=""  value="<?php echo @$res1['postal_code']; ?>">
                              </div>

                              <!-- <div class="col-md-6">
                                   <p style="color:#000;">Country</p>
                                  <input id="country" name="country"  type="text" autocomplete="off" class="form-control form-value" required=""  value="<?php echo @$res1['country']; ?>">
                              </div> -->

                               <div class="col-md-6">
                 <p style="color:#000;" adr_trans="label_country">Country</p>
                <select name="country" class="form-control form-value" required="">
                              <option value="Norway">Norway</option>
                              <option value="US">US</option>
                              </select>
                </div>



          <?php /*      <div class="col-md-6">
                                <p style="color:#000;">User ID</p>
                                <input id="user_id" name="user_id" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="20" required="" value="<?php echo @$res1['user_id']; ?>">
                </div>
*/ ?>




                <div class="col-md-6">
                                   <p style="color:#000;" adr_trans="label_change_profile_picture">Change profile picture</p>
                                  <input id="profile_pic" name="profile_pic" placeholder="Profile picture" type="file" autocomplete="off" class="form-control form-value" >

                              </div>
   <?php /*
                <div class="col-md-6">
                                <p style="color:#000;" adr_trans="label_password">Password</p>
                                <input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  autocomplete="off" class="form-control form-value" minlength="5" maxlength="20" required="" value="<?php echo @$res1['password']; ?>">
                                <input type="checkbox" onclick="showPassword()"> <span adr_trans="">Show Password</span>
                </div>*/ ?>

									<div class="col-md-12">



										<br>
															  <p align="center" >
																<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="profilebtn" id="label_update_profile" adr_trans="label_update_profile"><i class="fa fa-sign-in"></i>Update Profile</button>
																					&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="realtor_profile.php" id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a></p>

							</div>
							</form>


							</td></tr></table>

							</div>

                </div>


            </div>


		<script>
document.addEventListener("DOMContentLoaded", function () {
const separator = ',';
for (const input of document.getElementsByTagName("input")) {
if (!input.multiple) {
continue;
}
if (input.list instanceof HTMLDataListElement) {
const optionsValues = Array.from(input.list.options).map(opt => opt.value);
let valueCount = input.value.split(separator).length;
input.addEventListener("input", () => {
const currentValueCount = input.value.split(separator).length;
// Do not update list if the user doesn't add/remove a separator
// Current value: "a, b, c"; New value: "a, b, cd" => Do not change the list
// Current value: "a, b, c"; New value: "a, b, c," => Update the list
// Current value: "a, b, c"; New value: "a, b" => Update the list
if (valueCount !== currentValueCount) {
const lsIndex = input.value.lastIndexOf(separator);
const str = lsIndex !== -1 ? input.value.substr(0, lsIndex) + separator : "";
filldatalist(input, optionsValues, str);
valueCount = currentValueCount;
}
});
}
}
function filldatalist(input, optionValues, optionPrefix) {
const list = input.list;
if (list && optionValues.length > 0) {
list.innerHTML = "";
const usedOptions = optionPrefix.split(separator).map(value => value.trim());
for (const optionsValue of optionValues) {
if (usedOptions.indexOf(optionsValue) < 0) {
const option = document.createElement("option");
option.value = optionPrefix + optionsValue;
list.append(option);
}
}
}
}
});


$("#logo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Logo skal bare v�re i det gitte formatet";
		}
		else
		{
		alertmsg="Logo Pic should be only in the given format";
		}

            alert(alertmsg+" : "+fileExtension.join(', '));
      $("#logo").val("");
        }
    });

$("#profile_pic").change(function () {
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
      $("#profile_pic").val("");
        }
    });

</script>

		<?php include "footer.php";  ?>
