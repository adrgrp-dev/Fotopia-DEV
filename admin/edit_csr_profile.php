<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION["admin_loggedin_id"];
$loggedin_name=$_SESSION["admin_loggedin_name"];
$res=mysqli_query($con,"select * from csr_profile where csr_id='$loggedin_id'");

$res1=mysqli_fetch_array($res);
$userExist=mysqli_num_rows($res);



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

mysqli_query($con,"insert into csr_profile(csr_id)values('$loggedin_id')");


}

if(isset($_REQUEST['profilebtn']))
{



$address_line1=$_REQUEST['address_line1'];
$address_line2=$_REQUEST['address_line2'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];

$contact_number=$_REQUEST['contact_number'];
// $email=$_REQUEST['email'];

$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];

// $profile_pic=$_REQUEST['profile_pic'];


if($_FILES['profile_pic']['size'] == 0) {


	mysqli_query($con,"update csr_profile set contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname' where csr_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `csr_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'CSR',$loggedin_id,now())");

}

else{

 mysqli_query($con,"update csr_profile set contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where csr_id='$loggedin_id'");

  mysqli_query($con,"update admin_users set contact_number='$contact_number',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',postal_code='$zip',country='$country',first_name='$fname',last_name='$lname',profile_pic='$imgData1',profile_pic_image_type='$imageType1' where id='$loggedin_id'");

  mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `csr_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,'CSR',$loggedin_id,now())");

}




//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,$loggedin_id,now())");


header("location:csr_profile.php?u=1");
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
<table style="color: #000;background: #FFF;border-radius:10px;opacity:0.7;"><tr><td style="padding:20px;">
						<div class="col-md-12"><h5 align="center"  id="label_edit_csr_profile" adr_trans="label_edit_csr_profile" style="color:#000!important">Add / Edit csr profile</h5></div>

						<form name="profile" method="post" action="" enctype="multipart/form-data">

                <div class="col-md-12">
                                <p style="color:#000;" id="label_profile_picture" adr_trans="label_profile_picture">Profile picture</p>
                               <img src="data:<?php echo @$res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode(@$res1['profile_pic']); ?>" width="60" height="60" />
                </div>

								<br>



                <div class="col-md-6">
                                <p style="color:#000;" id="label_first_name" adr_trans="label_first_name">First name</p>
                                <input id="fname" name="fname" type="text" autocomplete="off" class="form-control form-value" minlength="1" maxlength="20" required="" value="<?php echo @$res1['first_name']; ?>">
                </div>

                <div class="col-md-6">
                                <p style="color:#000;" id="label_last_name" adr_trans="label_last_name">Last name</p>
                                <input id="lname" name="lname" type="text" autocomplete="off" class="form-control form-value" minlength="1" maxlength="20" required="" value="<?php echo @$res1['last_name']; ?>">
                </div>


                <div class="col-md-6">
                                <p style="color:#000;" id="label_contact_no" adr_trans="label_contact_no">Contact number</p>
                                <input id="contact_number" name="contact_number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" minlength="6" maxlength="20" required="" value="<?php echo @$res1['contact_number']; ?>">
                </div>


                <div class="col-md-6">
                <p style="color:#000;" id="label_address_line1" adr_trans="label_address_line1">Address line 1</p>
                 <input id="address_line1" name="address_line1" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30" required="" value="<?php echo @$res1['address_line1']; ?>">
               </div>

                 <div class="col-md-6">
                <p style="color:#000;" id="label_address_line2" adr_trans="label_address_line2">Address line 2</p>
                 <input id="address_line2" name="address_line2" type="text" autocomplete="off" class="form-control form-value" minlength="5" maxlength="30"  value="<?php echo @$res1['address_line2']; ?>">
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

                              <!-- <div class="col-md-6">
                                   <p style="color:#000;">Country</p>
                                  <input id="country" name="country"  type="text" autocomplete="off" class="form-control form-value" required=""  value="<?php echo @$res1['country']; ?>">
                              </div>
 -->
                              <div class="col-md-6">
                 <p style="color:#000;" id="label_country" adr_trans="label_country">Country</p>
                <select name="country" class="form-control form-value" required="">
                              <option value="Norway">Norway</option>
                              <option value="US">US</option>
                              </select>
                </div>



                <div class="col-md-6">
                                   <p style="color:#000;" id="label_change_profile_picture" adr_trans="label_change_profile_picture">Change profile picture</p>
                                  <input id="profile_pic" name="profile_pic" placeholder="Profile picture" type="file" autocomplete="off" class="form-control form-value" >

                              </div>


									<div class="col-md-12">



										<br>
															  <p align="center" >
																<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="profilebtn" id="label_update_profile" adr_trans="label_update_profile"><i class="fa fa-sign-in" style="color:#FFF"></i>Update Profile</button>
																					&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="csr_profile.php" id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times" style="color:#FFF"></i>Cancel</a></p>

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
