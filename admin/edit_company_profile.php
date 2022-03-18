<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION["admin_loggedin_id"];
$loggedin_name=$_SESSION["admin_loggedin_name"];
$res=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedin_id'");
$userExist=mysqli_num_rows($res);
$res1=mysqli_fetch_array($res);



	$imgData="";
	$imageProperties="";
	$imageType="";
	if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
        //echo "coming";
        $filename=$loggedin_id."_".time().$_FILES['logo']['name'];
		$filename=str_replace(" ","",$filename);
        $imgData = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['logo']['tmp_name']);

        $imageType = $_FILES['logo']['type'];
        $rootdirectory="../pc_admin_logo/".$filename;
        unlink($_REQUEST['old_logo']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $rootdirectory);
        $image_directory="pc_admin_logo/".$filename;

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
      echo   $imgData1 = addslashes(file_get_contents($_FILES['profile_pic']['tmp_name']));
      //  $imageProperties = getimageSize($_FILES['logo']['tmp_name']);
      echo   $imageType1 = $_FILES['profile_pic']['type'];
			//exit;

      /*  $sql = "INSERT INTO output_images(imageType ,imageData)
  VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: listImages.php");
        } */
    }
}




/*if($userExist==0)
{

mysqli_query($con,"insert into photo_company_profile(about_us,skills,portfolio,location,pc_admin_id)values('','','','','$loggedin_id')");

}*/

if(isset($_REQUEST['profilebtn']))
{
$aboutus=addslashes($_REQUEST['aboutus']);
$skills=$_REQUEST['skills'];
$portfolio=$_REQUEST['portfolio'];
$location=$_REQUEST['location'];

$organization_name=$_REQUEST['organization_name'];
$organization_branch=$_REQUEST['organization_branch'];
$organization_number=strtoupper($_REQUEST['organization_number']);
$contact_number=$_REQUEST['contact_number'];
$email=$_REQUEST['email'];
$address_line1=$_REQUEST['address_line1'];
$address_line2=$_REQUEST['address_line2'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];
$profilepic=$_REQUEST['profile'];
$linkedin_id=$_REQUEST['linkedin_id'];
$facebook_id=$_REQUEST['facebook_id'];
$instagram_id=$_REQUEST['instagram_id'];
$twitter_id=$_REQUEST['twitter_id'];
$youtube_id=$_REQUEST['youtube_id'];
$tax=$_REQUEST['tax'];



if($_FILES['logo']['size'] == 0 && $_FILES['profile_pic']['size'] == 0){

	// echo "sarath";
	// exit;

mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',logo='$imgData1',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',tax='$tax'
 where pc_admin_id='$loggedin_id'");

mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country'
 where id='$loggedin_id'");

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,
    'PCAdmin',$loggedin_id,now())");
}

elseif($_FILES['logo']['size'] == 1 || $_FILES['profile_pic']['size'] == 0) {

    mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',logo='$imgData',logo_image_url='$image_directory',logo_image_type='$imageType',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',tax='$tax'where pc_admin_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

}


elseif($_FILES['logo']['size'] == 0 || $_FILES['profile_pic']['size'] == 1) {

    mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',tax='$tax'where pc_admin_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

}


else {

	mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',logo='$imgData',logo_image_url='$image_directory',logo_image_type='$imageType',facebook_id='$facebook_id',instagram_id='$instagram_id',youtube_id='$youtube_id',twitter_id='$twitter_id',tax='$tax'where pc_admin_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

}

//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,$loggedin_id,now())");


header("location:company_profile.php?u=1");
}
?>
<?php include "header.php";  ?>
<style>
p{
		font-weight:bold;
		padding-bottom:0px;
	}

</style>
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>



<script>
function validate_email(val)
{
  var curent_email="<?php echo $res1['email']; ?>";
  if(curent_email==val){

    return true;
  }
  else{

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {

       $("#Email_exist_error").html("Email already exist, please choose different email and continue");
     $("#Email_exist_error").show();
     $("#email").val("");
      $("#email").focus();
      return false;
     }
     else
     {
      $("#Email_exist_error").html();
    $("#Email_exist_error").hide();
     }
    }
  };
  xhttp.open("GET","validate_email.php?id="+val+"&type=PCAdmin",true);
  xhttp.send();
}
}
</script>



			</div>
                <div class="col-md-10">
<hr class="space s">

<table style="color: #000;background: #FFF;border-radius:10px;opacity:0.7;margin-left:30px;"><tr><td style="padding:20px;">
				<!-- <h5 class="text-center" style="color:#000;display:none" id="label_my_profile" adr_trans="label_my_profile">My Profile</h5> -->
<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h5 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Welcome to Fotopia!<br />Step #1 of 2 : Fill out the Company profile</h5></div> <?php } ?>
						<div class="col-md-12"><h5 align="center" id="label_add_company_profile" adr_trans="label_add_company_profile" style="color:#000!important">Add / Edit company profile</h5></div>

						<form name="profile" method="post" action="" enctype="multipart/form-data">

 								<div class="col-md-12">
                                <p style="color:#000;" id="label_logo" adr_trans="label_logo">Logo</p>
                               <img src="<?php  echo @"../".$res1['logo_image_url'] ?>" width="60" height="60" />
                               <input type="hidden" name="old_logo" value="<?php  echo @"../".$res1['logo_image_url'] ?>" />

                               <br/>
                               <span style="margin-left:20px;color:red;display:none;font-size:9px;" id="Email_exist_error" align="center" class="alert-warning"></span>
								</div>

								<br>

 								<div class="col-md-6">
                                <p style="color:#000;" id="label_org_name" adr_trans="label_org_name">Organization name</p>
                                <input id="organization_name" name="organization_name" type="text" autocomplete="off" class="form-control form-value"  required="" value="<?php echo @$res1['organization_name']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" id="label_org_branch" adr_trans="label_org_branch">Organization branch</p>
                                <input id="organization_branch" name="organization_branch" type="text" autocomplete="off" class="form-control form-value"  required="" value="<?php echo @$res1['organization_branch']; ?>">
								</div>

									<div class="col-md-6">
                                <p style="color:#000;" id="label_org_branch" adr_trans="label_org_number">Organization Number</p>
                                <input id="organization_number" name="organization_number" type="text" autocomplete="off" class="form-control form-value"  required="" value="<?php echo @$res1['organization_number']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" id="label_contact_no" adr_trans="label_contact_no">Contact number</p>
                                <input id="contact_number" name="contact_number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" minlength="6" maxlength="20" required="" value="<?php echo @$res1['contact_number']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" id="label_email" adr_trans="label_email">Email</p> 
                                <input id="email" name="email" type="email" autocomplete="off" onblur="this.value=this.value.trim();validate_email(this.value)"  class="form-control form-value" required="" value="<?php echo @$res1['email']; ?>">
								</div>



								<div class="col-md-6">
  						  <p style="color:#000;" id="label_address_line1" adr_trans="label_address_line1">Address line 1</p>
  						   <input id="address_line1" name="address_line1" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30" required="" value="<?php echo @$res1['address_line1']; ?>">
  						 </div>

  							 <div class="col-md-6">
  						  <p style="color:#000;" id="label_address_line2" adr_trans="label_address_line2">Address line 2</p>
  						   <input id="address_line2" name="address_line2" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30" value="<?php echo @$res1['address_line2']; ?>">
  						 </div>

  						<div class="col-md-6">
  							 <p style="color:#000;" id="label_city" adr_trans="label_city">City</p>
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
  							  <p style="color:#000;" id="label_state" adr_trans="label_state">State</p>
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
                                   <p style="color:#000;" id="label_zip_code" adr_trans="label_zip_code">Zip code</p>
                                  <input id="zip" name="zip" type="number" autocomplete="off" class="form-control form-value"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" required=""  value="<?php echo @$res1['postal_code']; ?>">
                              </div>

                             <!--  <div class="col-md-6">
                                   <p style="color:#000;">Country</p>
                                  <input id="country" name="country"  type="text" autocomplete="off" class="form-control form-value" required=""  value="<?php echo @$res1['country']; ?>">
                              </div> -->

                               <div class="col-md-6">
                 <p style="color:#000;" id="label_country" adr_trans="label_country">Country</p>
                <select name="country" class="form-control form-value" required="">
                              <option value="Norway">Norway</option>
                              <option value="US">US</option>
                              </select>
                </div>

                              <div class="col-md-6">
                                   <p style="color:#000;" id="label_change_logo" adr_trans="label_change_logo">Change logo</p>
                                  <input id="logo" name="logo" placeholder="logo" type="file" autocomplete="off" class="form-control form-value">

                              </div>

															<div class="col-md-6">
                                   <p style="color:#000;" id="label_change_logo" adr_trans="label_change_profile_picture">Change Profile Picture</p>
                                  <input id="logo" name="profile_pic" placeholder="logo" type="file" autocomplete="off" class="form-control form-value" >

                              </div>


                              <div class="col-md-6">
                                <p style="color:#000;">LinkedIN profile<span class="fa fa-linkedin" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;margin-left: 5px;"></span></p>
                                <input id="linkedin_id" name="linkedin_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['linkedin_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p  style="color:#000;">Facebook profile<span class="fa fa-facebook" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;margin-left: 5px;"></span></p>
                                <input id="facebook_id" name="facebook_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['facebook_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;">Instagram profile<span class="fa fa-instagram" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;margin-left: 5px;"></span></p>
                                <input id="instagram_id" name="instagram_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['instagram_id']; ?>">
								</div>
                                <div class="col-md-6">
                                <p style="color:#000;">Youtube profile<span class="fa fa-youtube" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;margin-left: 5px;"></span></p>
                                <input id="youtube_id" name="youtube_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['youtube_id']; ?>">
                                </div>
                                <div class="col-md-6">
                                <p style="color:#000;">Twitter profile<span class="fa fa-twitter" style="    padding: 4px;background: #aad1d6;color: #000;font-weight: bold;border-radius: 20px;font-size: 10px;margin-left: 5px;"></span></p>
                                <input id="twitter_id" name="twitter_id" type="text" autocomplete="off" class="form-control form-value" value="<?php echo @$res1['twitter_id']; ?>">
                                </div>



						<div class="col-md-6">
                                <p id="label_about_me" adr_trans="label_about_us" style="color:#000;">About Us</p>
                                <textarea id="aboutus" name="aboutus"  class="form-control form-value" rows="2" cols="40"><?php echo @$res1['about_us']; ?></textarea>

							</div>

							<div class="col-md-6">

                                <p id="label_skills" adr_trans="label_skills" style="color:#000;">Skills</p>
                               <textarea id="skills" name="skills"  class="form-control form-value" rows="2" cols="40"><?php echo @$res1['skills']; ?></textarea>
				              </div>

				              <div class="col-md-6">


                                <p id="label_portfolio" adr_trans="label_portfolio" style="color:#000;">Portfolio</p>
                                <input id="portfolio" name="portfolio" type="text" autocomplete="off" class="form-control form-value" placeholder="Listing, own website, etc." value="<?php echo @$res1['portfolio']; ?>">

								</div>

								<div class="col-md-6">

                                <!-- <p>Set Location</p>
                                <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php // echo $res1['location']; ?>"> -->
	<p><span id="label_set_location" adr_trans="label_set_location" style="color:#000;">Set Location</span> (Add multiple locations seperated by comma)</p>
<?php /*?> <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $res1['location']; ?>"><?php */?>

<input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="<?php echo @$res1['location']; ?>" autocomplete="off" required />

<datalist id="Suggestions">
<?php
$city1=mysqli_query($con,"select cities from norway_states_cities");
while($city=mysqli_fetch_array($city1))
{
?>
<option value="<?php echo $city['cities']; ?>"><?php echo $city['cities']; ?></option>
<?php } ?>
</datalist>
</div>

								<div class="col-md-6">
                                <p><span id="label_set_tax" adr_trans="labelabel_set_taxl_tax" style="color:#000;">Set tax</span><span id="label_percentage_tax" adr_trans="label_percentage_tax">(Enter the percentage of tax)</span></p>
                                <input id="tax" name="tax" type="number" step="any" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['tax']; ?>">
								</div>



									<div class="col-md-6">



										<br>
															  <p align="center" >

																<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="profilebtn" id="label_update_profile" adr_trans="label_update_profile" style=""><i class="fa fa-sign-in" style="color:#000"></i>Update Profile</button>
																					&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="company_profile.php" id="label_cancel" adr_trans="label_cancel" style=""><i class="fa fa-times" style="color:#000"></i>Cancel</a></p>

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
      $("#logo").val("");
        }
    });
</script>

		<?php include "footer.php";  ?>
