<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION["admin_loggedin_id"];
$res=mysqli_query($con,"select * from company_profile where super_csr_id='$loggedin_id'");
//echo "select * from photographer_profile where photographer_id='$loggedin_id";
$res1=mysqli_fetch_array($res);
$userExist=mysqli_num_rows($res);

if($userExist==0)
{
mysqli_query($con,"insert into company_profile(about_me,skills,portfolio,location,super_csr_id)values('','','','','$loggedin_id')");

}

if(isset($_REQUEST['profilebtn']))
{
$aboutme=$_REQUEST['aboutme'];
$skills=$_REQUEST['skills'];
$portfolio=$_REQUEST['portfolio'];
$location=$_REQUEST['location'];


mysqli_query($con,"update company_profile set about_me='$aboutme',skills='$skills',portfolio='$portfolio',location='$location' where super_csr_id='$loggedin_id'");


//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `photographer_id`,`action_date`) VALUES ('Profile','Updated','$loggedin_name',$loggedin_id,$loggedin_id,now())");


header("location:super_myprofile.php?u=1");
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


<table style="background:#000;color:#FFF;border-radius:25px 25px 25px 25px;opacity:0.7;"><tr><td style="padding:20px;">
				<h5 class="text-center" style="color:#1D1E5F;display:none" id="label_my_profile" adr_trans="label_my_profile">My Profile</h5>

				<?php if(@isset($_REQUEST["u"])) { ?>
                        <div class="success-box" style="display:block;">
                            <center><div class="text-success">Profile information updated successfully</div></center>
                        </div>
						<?php }  ?>

						<form name="profile" method="post" action="">
						<div class="col-md-12">
                                <p id="label_about_me" adr_trans="label_about_me" style="color:#1D1E5F;">About Us</p>
                                <textarea id="aboutme" name="aboutme"  class="form-control form-value" required="" rows="3" cols="40"><?php echo $res1['about_me']; ?></textarea>
                            </div>

							<div class="col-md-12">
                                <p id="label_skills" adr_trans="label_skills" style="color:#1D1E5F;">Skills</p>
                               <textarea id="skills" name="skills"  class="form-control form-value" required="" rows="3" cols="40"><?php echo $res1['skills']; ?></textarea>
                            </div>

							<div class="col-md-12">
                                <p id="label_portfolio" adr_trans="label_portfolio" style="color:#1D1E5F;">Portfolio</p>
                                <input id="portfolio" name="portfolio" placeholder="portfolio link" type="text" autocomplete="off" class="form-control form-value" placeholder="Listing, own website, etc." value="<?php echo $res1['portfolio']; ?>">
                            </div>

							<div class="col-md-12">
                                <!-- <p>Set Location</p>
                                <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php // echo $res1['location']; ?>"> -->
	<p><span id="label_set_location" adr_trans="label_set_location" style="color:#1D1E5F;">Set Location</span> (Add multiple locations seperated by comma)</p>
<?php /*?> <input id="location" name="location" placeholder="Set location" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $res1['location']; ?>"><?php */?>

<input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="<?php echo $res1['location']; ?>" />

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

                 	<div class="col-md-12">
										<br>
															  <p align="center" >
																<button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="profilebtn" id="label_update_profile" adr_trans="label_update_profile"><i class="fa fa-sign-in"></i>Update Profile</button>
																					&nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="super_myprofile.php" id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a></p>
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

</script>

		<?php include "footer.php";  ?>
