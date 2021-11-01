<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION["admin_loggedin_id"];
$loggedin_name=$_SESSION["admin_loggedin_name"];
$res=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedin_id'");
//echo "select * from photographer_profile where photographer_id='$loggedin_id";
$res1=mysqli_fetch_array($res);
$userExist=mysqli_num_rows($res);


	$imgData="";
	$imageProperties="";
	$imageType="";
	if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
        //echo "coming";
        $filename=$loggedin_id."_".$_FILES['logo']['name'];
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




if($userExist==0)
{

mysqli_query($con,"insert into photo_company_profile(about_us,skills,portfolio,location,pc_admin_id)values('','','','','$loggedin_id')");


}

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
$tax=$_REQUEST['tax'];



if($_FILES['logo']['size'] == 0 && $_FILES['profile_pic']['size'] == 0){

	// echo "sarath";
	// exit;

mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',logo='$imgData1',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',tax='$tax'
 where pc_admin_id='$loggedin_id'");

mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country'
 where id='$loggedin_id'");

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,
    'PCAdmin',$loggedin_id,now())");
}

elseif($_FILES['logo']['size'] == 1 || $_FILES['profile_pic']['size'] == 0) {

    mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',logo='$imgData',logo_image_url='$image_directory',logo_image_type='$imageType',facebook_id='$facebook_id',instagram_id='$instagram_id',tax='$tax'where pc_admin_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

}


elseif($_FILES['logo']['size'] == 0 || $_FILES['profile_pic']['size'] == 1) {

    mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',facebook_id='$facebook_id',instagram_id='$instagram_id',tax='$tax'where pc_admin_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set organization_name='$organization_name',organization_branch='$organization_branch',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

}


else {

	mysqli_query($con,"update photo_company_profile set about_us='$aboutus',skills='$skills',portfolio='$portfolio',location='$location',organization_name='$organization_name',organization_branch='$organization_branch',organization_number='$organization_number',contact_number='$contact_number',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',linkedin_id='$linkedin_id',logo='$imgData',logo_image_url='$image_directory',logo_image_type='$imageType',facebook_id='$facebook_id',instagram_id='$instagram_id',tax='$tax'where pc_admin_id='$loggedin_id'");

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


			</div>
                <div class="col-md-10">


<table style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;border-radius:25px 25px 25px 25px;opacity:0.7;margin-left:30px;"><tr><td style="padding:20px;">
				<!-- <h5 class="text-center" style="color:#000;display:none" id="label_my_profile" adr_trans="label_my_profile">My Profile</h5> -->
<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h5 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Welcome to Fotopia!<br />Its mandatory to complete the profile information for the realtor to understand you better</h5></div> <?php } ?>
						<div class="col-md-12"><h5 align="center" id="label_add_company_profile" adr_trans="label_add_company_profile" style="color:#000!important">Add / Edit company profile</h5></div>

						<form name="profile" method="post" action="" enctype="multipart/form-data">

 								<div class="col-md-12">
                                <p style="color:#000;" id="label_logo" adr_trans="label_logo">Logo</p>
                               <img src="<?php  echo @"../".$res1['logo_image_url'] ?>" width="60" height="60" />
                               <input type="hidden" name="old_logo" value="<?php  echo @"../".$res1['logo_image_url'] ?>" />
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
                                <input id="contact_number" name="contact_number" type="text" autocomplete="off" class="form-control form-value" minlength="6" maxlength="20" required="" value="<?php echo @$res1['contact_number']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;" id="label_email" adr_trans="label_email">Email</p>
                                <input id="email" name="email" type="email" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['email']; ?>">
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
                                  <input id="logo" name="logo" placeholder="logo" type="file" autocomplete="off" class="form-control form-value" >

                              </div>

															<div class="col-md-6">
                                   <p style="color:#000;" id="label_change_logo" adr_trans="label_change_profile_picture">Change Profile Picture</p>
                                  <input id="logo" name="profile_pic" placeholder="logo" type="file" autocomplete="off" class="form-control form-value" >

                              </div>


                              <div class="col-md-6">
                                <p style="color:#000;">LinkedIN profile</p>
                                <input id="linkedin_id" name="linkedin_id" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['linkedin_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p  style="color:#000;">Facebook profile</p>
                                <input id="facebook_id" name="facebook_id" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['facebook_id']; ?>">
								</div>

								<div class="col-md-6">
                                <p style="color:#000;">Instagram profile</p>
                                <input id="instagram_id" name="instagram_id" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['instagram_id']; ?>">
								</div>



						<div class="col-md-6">
                                <p id="label_about_me" adr_trans="label_about_us" style="color:#000;">About Us</p>
                                <textarea id="aboutus" name="aboutus"  class="form-control form-value" required="" rows="2" cols="40"><?php echo @$res1['about_us']; ?></textarea>

							</div>

							<div class="col-md-6">

                                <p id="label_skills" adr_trans="label_skills" style="color:#000;">Skills</p>
                               <textarea id="skills" name="skills"  class="form-control form-value" required="" rows="2" cols="40"><?php echo @$res1['skills']; ?></textarea>
				              </div>

				              <div class="col-md-6">


                                <p id="label_portfolio" adr_trans="label_portfolio" style="color:#000;">Portfolio</p>
                                <input id="portfolio" name="portfolio" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['portfolio']; ?>">

								</div>

								<div class="col-md-6">

                                <!-- <p>Set Location</p>
                                <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php // echo $res1['location']; ?>"> -->
	<p><span id="label_set_location" adr_trans="label_set_location" style="color:#000;">Set Location</span> (Add multiple locations seperated by comma)</p>
<?php /*?> <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $res1['location']; ?>"><?php */?>

<input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="<?php echo @$res1['location']; ?>" autocomplete="off" />

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
                                <p><span id="label_tax" adr_trans="label_tax" style="color:#000;">Tax</span><span id="label_percentage_tax" adr_trans="label_percentage_tax">(Enter the percentage of tax)</span></p>
                                <input id="tax" name="tax" type="number" step="any" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$res1['tax']; ?>">
								</div>



									<div class="col-md-6">



										<br>
															  <p align="center" >
																<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="profilebtn" id="label_update_profile" adr_trans="label_update_profile" style="background:#FFF!important;color:#000!important"><i class="fa fa-sign-in" style="color:#000"></i>Update Profile</button>
																					&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="company_profile.php" id="label_cancel" adr_trans="label_cancel" style="background:#FFF!important;color:#000!important"><i class="fa fa-times" style="color:#000"></i>Cancel</a></p>

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
