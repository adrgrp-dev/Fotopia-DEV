<?php
//header ("Pragma: public\r\nExpires: 0");die;
ob_start();

include "connection1.php";



if(isset($_REQUEST['SaveOrder']))
{
$fnd_address = $_REQUEST["fnd_address"];
$sell_name = $_REQUEST["sell_name"];
$address = $_REQUEST["address"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zip = $_REQUEST["zip"];
$country = $_REQUEST["country"];
$mobile_no = $_REQUEST["mobile_no"];
$email_id = $_REQUEST["email_id"];


$_SESSION['property_address'] =  $_REQUEST["address"];
$_SESSION['property_city']  = $_REQUEST["city"];
$_SESSION['property_state']  = $_REQUEST["state"];
$_SESSION['property_country'] = $_REQUEST["country"];
$_SESSION['property_zip']  = $_REQUEST["zip"];
$_SESSION['property_contact_mobile'] = $_REQUEST["mobile_no"];
$_SESSION['property_contact_email'] = $_REQUEST["email_id"];



if(empty($_REQUEST["ref_no"]))
{
  $ref_no=0;
}
else
{
$ref_no = $_REQUEST["ref_no"];
}
//--------------------------------------------------contact person name--------------------------------------------
if(empty($_REQUEST["name"]))
{
  $name="";
}
else
{
$name = $_REQUEST["name"];
}
//-----------------------------------------------------contact person mobileno-----------------------------------------
if(empty($_REQUEST["mobile_no1"]))
{
  $mobile_no1="";
}
else
{
$mobile_no1 = $_REQUEST["mobile_no1"];
}
//--------------------------------------------------contact person emailid---------------------------------------------------
if(empty($_REQUEST["email_id1"]))
{
  $email_id1="";
}
else
{
  $email_id1 = $_REQUEST["email_id1"];
}

if(empty($_REQUEST["realtor_name"]))
{
  $realtor_name="";
}
else
{
  $realtor_name = $_REQUEST["realtor_name"];
}

if(empty($_REQUEST["realtor_contactNo"]))
{
  $realtor_contactNo="";
}
else
{
  $realtor_contactNo = $_REQUEST["realtor_contactNo"];
}

if(empty($_REQUEST["realtor_email"]))
{
  $realtor_email="";
}
else
{
  $realtor_email = $_REQUEST["realtor_email"];
}

if(empty($_REQUEST["realtor_address"]))
{
  $realtor_address="";
}
else
{
  $realtor_address = $_REQUEST["realtor_address"];
}
$lead_from = @$_REQUEST["from_whom"];




if(empty(@$_REQUEST["hs_id"]))
{
  $hs_id_is = 0;
}
else
{
  $hs_id_is = $_REQUEST["hs_id"];
}


// $realtor_name = $_REQUEST["realtor_name"];
// $realtor_contactNo = $_REQUEST["realtor_contactNo"];
// $realtor_email = $_REQUEST["realtor_email"];
// $realtor_address = $_REQUEST["realtor_address"];


if($hs_id_is==0)
{

$res=mysqli_query($con,"INSERT INTO `home_seller_info` (`name`, `address`, `mobile_number`, `email`, `city`, `state`,`country`, `zip`,`reference_number`, `contact_person_name`, `contact_person_mobile`, `contact_person_email`,`lead_from`,`request_name`, `request_contact_no`, `request_email`, `request_address`) VALUES ('$sell_name', '$address', '$mobile_no', ' $email_id ', '$city', '$state','Norway', '$zip', '$ref_no', '$name', '$mobile_no1', '$email_id1','$lead_from','$realtor_name', '$realtor_contactNo','$realtor_email','$realtor_address')");
$inserted_id=mysqli_insert_id($con);
$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`, `action_date`) VALUES ('Order','Created','$loggedin_name',$loggedin_id,'Realtor',$loggedin_id,now())");
}

else{

$res=mysqli_query($con,"UPDATE `home_seller_info` SET `name`='$sell_name',`address`='$address',`mobile_number`='$mobile_no',`email`= ' $email_id ',`city`='$city',`state`='$state',`country`='Norway',`zip`='$zip',`reference_number`='$ref_no',`contact_person_name`='$name',`contact_person_mobile`='$mobile_no1',`contact_person_email`='$email_id1',`notes`=' ',`lead_from`='$lead_from',`request_name`='$realtor_name',`request_contact_no`='$realtor_contactNo',`request_email`='$realtor_email',`request_address`='$realtor_address' where id='$hs_id_is'");

$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`, `action_date`) VALUES ('Order','Updated','$loggedin_name',$loggedin_id,'Realtor',$loggedin_id,now())");
$pc_admin_id1=@$_REQUEST['pc_admin_id'];
$Photographer_id1=@$_REQUEST['Photographer_id'];
$params="hs_id=".$hs_id_is."&pc_admin_id=".$pc_admin_id1."&Photographer_id=".$Photographer_id1."&od=".$_REQUEST['od'];

 header("location:create_appointment.php?".trim($params));

exit;

}
// $realtor_details=mysqli_query($con,"INSERT INTO `home_seller_info` (`request_name`, `request_contact_no`, `request_email`, `request_address`) VALUES ('$realtor_name', '$realtor_contactNo','$realtor_email','realtor_address')");
if(isset($_REQUEST['date']))
{
$_SESSION['date']=$_REQUEST['date'];
}
else
{
unset($_SESSION['date']);
}
if(isset($_REQUEST['bn']))
{
$_SESSION['bn']=$_REQUEST['bn'];
}
else
{
unset($_SESSION['bn']);
}
if(isset($_REQUEST['toDatetime']))
{
$_SESSION['toDatetime']=$_REQUEST['toDatetime'];
}
else
{
unset($_SESSION['toDatetime']);
}
if(isset($_REQUEST['fromDatetime']))
{
$_SESSION['fromDatetime']=$_REQUEST['fromDatetime'];
}
else
{
unset($_SESSION['fromDatetime']);
}


if(isset($_REQUEST['due_date']))
{
$_SESSION['due_date']=$_REQUEST['due_date'];
}
else
{
unset($_SESSION['due_date']);
}



if(isset($_REQUEST['photographer_id']))
{
$_SESSION['photographer_id']=$_REQUEST['photographer_id'];
}
else
{
unset($_SESSION['photographer_id']);
}

$pc_admin_id1=@$_REQUEST['pc_admin_id'];
$Photographer_id1=@$_REQUEST['Photographer_id'];
$od1=@$_REQUEST['od'];
$params="hs_id=".$inserted_id."&pc_admin_id=".$pc_admin_id1."&Photographer_id=".$Photographer_id1."&od=".$od1;

    header("location:create_appointment.php?".trim($params));

}

 ?>
<?php include "header.php";  ?>
<script>

function myfunc()
{

  if(document.getElementById('show').style.display == "none")
  {
    document.getElementById('show').style.display="block";
  }
  else
   {
    document.getElementById('show').style.display="none";
  }
}
</script>
<style>


.breadcrumb1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 6px;
  overflow: hidden;
  margin-top: 42px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

  
}

.breadcrumb1 a {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  text-decoration: none;
  margin: auto;
  height: 100%;
  padding-left: 38px;
  padding-right: 0;
  color: #666;
}

.breadcrumb1 a:first-child {
  padding-left: 10px;

}

.breadcrumb1 a:last-child {
  padding-right: 15.2px;
}

#firstStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #000;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
 
  z-index: 1;

}
#secondStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
 
  z-index: 1;
}

#thirdStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  
  z-index: 1;
}
.breadcrumb1 a:last-child:after {
  content: none;
}

.breadcrumb__inner {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  margin: auto;
  z-index: 2;
}

.breadcrumb__title {
  font-weight: bold;
}

#firstStep:hover {
background-color:#aad1d6;
}

#firstStep:after {
background-color:#aad1d6;
}

@media all and (max-width: 1000px) {
  .breadcrumb1 {
    font-size: 15px;
  }
}
@media all and (max-width: 710px) {
  .breadcrumb__desc {
    display: none;
  }

  .breadcrumb1 {
    height: 38px;
  }

  .breadcrumb1 a {
    padding-left: 25.33333px;
  }

  .breadcrumb a:after {
    content: "";
    width: 38px;
    height: 38px;
    right: -19px;
    -webkit-transform: scale(0.707) rotate(45deg);
            transform: scale(0.707) rotate(45deg);
  }
}
.btn-default
{

color:#000!important;
background:#aad1d6!important;
}
#firstStep
{
border-radius:0px!important;
}

</style>
<script>
function get_states(cityIs)
{
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

$('#anc1').removeAttr('onclick');

//---------------------------------------- validate greater than or not-----------------------------//

function show()
{

  if(document.getElementById('show').style.display == "none")
  {
    document.getElementById('show').style.display="block";
  }
  else
   {
    document.getElementById('show').style.display="none";
  }
}
function getAddressApi()
{
  var locationTextField=$('#locationTextField').val();
  //alert('getGooglePlacesDetails.php?locationTextField='+locationTextField);
  $.ajax({
    url:'getGooglePlacesDetails.php?locationTextField='+locationTextField,
    type:'GET',
    success:function(result)
    {
      var json=JSON.parse(result);
      var city=json.predictions[0].terms;
      var citylength=city.length;
      var cityval=city[citylength-2].value;
      get_states(cityval);
      $('#city').val(cityval);
      $('#address').val(locationTextField);
      
    }
  });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&&libraries=places&key=AIzaSyCTPPWUkcYXU_s0Qelncs3GKrKW_kQDUIs&&callback=initAutocomplete"></script>

 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:-15px;">
	<?php include "sidebar.php"; ?>

			</div>


      <div class="col-md-10" style="padding-top:10px;">







	<div class="breadcrumb1 hidden-xs hidden-sm">
		<a href="#" class="btn btn-default" id="firstStep"><i class="fa fa-camera-retro" style="font-size:40px;color:#000"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_order" adr_trans="label_order">Order</span>
				<span class="breadcrumb__desc" id="label_fill_order" adr_trans="label_fill_order">Fill the order</span>
			</span>
		</a>

		<a href="#" id="secondStep"><i class="fa fa-calendar" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_appointment" adr_trans="label_appointment">Appointment</span>
				<span class="breadcrumb__desc" id="label_pick_appointment" adr_trans="label_pick_appointment">Pick appointment</span>

			</span>
		</a>
		<a href="#" id="thirdStep"><i class="fa fa-database" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_products" adr_trans="label_products">Products</span>
				<span class="breadcrumb__desc" id="label_select_products" adr_trans="label_select_products">Select Products</span>

			</span>
		</a>
		<a href="#"><i class="fa fa-file-text-o" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_summary" adr_trans="label_summary">Summary</span>
				<span class="breadcrumb__desc" id="label_order_status" adr_trans="label_order_status">Order Status</span>
			</span>
		</a>
	</div>



<div class="breadcrumb1 hidden-md hidden-lg hidden-xl" style="height:50px;">
		<a href="#" class="btn btn-default" id="firstStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_order" adr_trans="label_order">Order</span>

			</span>
		</a>

		<a href="#" id="secondStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_appointment" adr_trans="label_appointment">Appointment</span>


			</span>
		</a>
		<a href="#" id="thirdStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_products" adr_trans="label_products">Products</span>


			</span>
		</a>
		<a href="#">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_summary" adr_trans="label_summary">Summary</span>

			</span>
		</a><br />
	</div>




    <form action="" autocomplete="off" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="" style="color: #000;background: #fff;border-radius: 5px;padding-left: 8px;padding-bottom: 20px;">


      <?php
   $user_type=$_SESSION['user_type'];

          if($user_type=="Photographer")
          {

   ?>
<?php
$hs_id_is = @$_REQUEST["hs_id"];
$appointment_update=mysqli_query($con,"select * from home_seller_info where id='$hs_id_is'");
$appointment_update_details=mysqli_fetch_array($appointment_update);
?>
   <div class="col-md-6">
    <center><label for="from_homeseller">
          <input type="radio" id="from_homeseller" name="from_whom" value="homeseller" required />&nbsp;&nbsp;<span adr_trans="label_from_homeseller">FROM HOMESELLER</span>
        </label>
      </center>
      </div>
      <div class="col-md-6">
        <center><label for="from_realtor">
          <input type="radio" id="from_realtor" name="from_whom" value="realtor" /> &nbsp;&nbsp;<span adr_trans="label_from_realtor">FROM REALTOR</span>
        </label>
        </center>
      </div>

    <br>

<!-- <script>

$(function() {
   $("input[name='from_whom']").click(function() {
     if ($("#from_realtor").is(":checked")) {
       $("#realtor_information").show();
       $("#realtor_name").attr("required","required");
       $("#realtor_contactNo").attr("required","required");
       $("#realtor_email").attr("required","required");
       $("#realtor_address").attr("required","required");
     $("#from_whom").removeAttr('required');

     } else {
       $("#realtor_name").removeAttr('required');
       $("#realtor_contactNo").removeAttr('required');
       $("#realtor_email").removeAttr('required');
       $("#realtor_address").removeAttr('required');

       $("#realtor_information").hide();
      $("#from_whom").removeAttr('required');
     }
   });
 });


</script> -->

<?php
$hs_id_is = @$_REQUEST["hs_id"];
$appointment_update=mysqli_query($con,"select * from home_seller_info where id='$hs_id_is'");
$appointment_update_details=mysqli_fetch_array($appointment_update);
?>

               <div id="realtor_information" style="display:none" >
               <div class="col-md-6">
                        <p>REALTOR NAME</p>
                        <input id="realtor_name" name="realtor_name" placeholder="Enter The Realtor name" type="text" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_name'];?>" class="form-control form-value" required >
    </div>
    <div class="col-md-6">
                        <p>REALTOR PHONE NO</p>
                        <input id="realtor_contactNo" name="realtor_contactNo" placeholder="Enter The Realtor Phone Number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_contact_no'];?>" class="form-control form-value" required>
    </div>
    <div class="col-md-6">
                        <p>REALTOR EMAIL</p>
                        <input id="realtor_email" name="realtor_email" placeholder="Enter The Realtor email id" type="email" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_email'];?>" class="form-control form-value" onblur="this.value=this.value.trim()" required>
                              <br>
    </div>
    <div class="col-md-6">
                        <p>REALTOR ADDRESS</p>
                        <input id="realtor_address" name="realtor_address" placeholder="Enter The Realtor address" type="text" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_address'];?>" class="form-control form-value" required>
    </div>
</div>
         <?php } ?>
<?php
$hs_id_is = @$_REQUEST["hs_id"];
$appointment_update=mysqli_query($con,"select * from home_seller_info where id='$hs_id_is'");
$appointment_update_details=mysqli_fetch_array($appointment_update);

?>

    <div class="col-md-12">
                        <p id="label_find_address" adr_trans="label_find_address">FIND ADDRESS</p>
                        <input id="locationTextField" name="fnd_address" placeholder="Find The Address" type="text" autocomplete="0" class="form-control" style="width: 90%;display: inline;"> <button class="mt-3 btn adr-save" onclick="getAddressApi()">Confirm</button>
                        <!-- <span style="float:right;margin-top:-30px;"><i class="fa fa-search" style="margin-left:-25px;"></i></span> -->
    </div>

    <div class="col-md-6">
                        <p id="label_homeseller_name" adr_trans="label_homeseller_name">HOME SELLER NAME</p>
                        <input id="sell_name" name="sell_name" placeholder="Enter The home seller name" value="<?php echo  @$appointment_update_details['name'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
    </div>
    <div class="col-md-6">
                        <p id="label_assignment_no" adr_trans="label_assignment_no">Assignment Number</p>
                        <input id=" ref_no" name="ref_no" placeholder="Enter The Assignment Number"  value="<?php echo  @$appointment_update_details['reference_number'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
						<input type="hidden" name="pc_admin_id" value="<?php echo @$_REQUEST['pc_admin_id']; ?>" />
						<input type="hidden" name="Photographer_id" value="<?php echo @$_REQUEST['Photographer_id']; ?>" />
						<input type="hidden" name="od" value="<?php echo @$_REQUEST['od']; ?>" />

    </div>
    <div class="col-md-12">
                        <p id="label_address" adr_trans="label_address">ADDRESS</p>
                        <input id="address" name="address" placeholder="Enter The Address" type="text" autocomplete="off"  value="<?php echo  @$appointment_update_details['address'];?>" class="form-control form-value" required="">
                      </div>
    <div class="col-md-6">
       <p id="label_city" adr_trans="label_city">CITY</p>
      <select name="city" id="city" class="form-control form-value" onchange="get_states(this.value)" required="">
        <option value="">Select City</option>
                    <?php
							$city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>" <?php if(@$appointment_update_details['city']==@$city['cities']){echo "selected";}?>><?php echo $city['cities']; ?></option>
							<?php } ?>
                    </select>
                    <span id="validation_message" style="display: none;color: red;position: absolute;top:0px;left:45px;"><span>
      </div>

      <div class="col-md-6">
       <p id="label_state" adr_trans="label_state">STATE</p> 
      <select name="state" class="form-control form-value" id="state" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
       <?php if($appointment_update_details['state']!='') { ?><option value="<?php echo  @$appointment_update_details['state'];?>"><?php echo  @$appointment_update_details['state'];?></option><?php } ?>
                    </select>
      </div>
     <div class="col-md-6">
                        <p id="label_zip_code" adr_trans="label_zip_code">ZIP CODE</p>
                        <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value"  value="<?php echo  @$appointment_update_details['zip'];?>" readonly required="">
                    </div>


    <div class="col-md-6">
       <p id="label_country" adr_trans="label_country">COUNTRY</p>
      <select name="country" class="form-control form-value"  value="<?php echo  @$appointment_update_details['country'];?>" required="">
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p id="label_mobile_no" adr_trans="label_mobile_no">MOBILE NO</p>
                              <input id="mobile_no" name="mobile_no" placeholder="Enter The mobile Number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off"  value="<?php echo  @$appointment_update_details['mobile_number'];?>" class="form-control form-value" required="">
                          </div>

          <div class="col-md-6">
                              <p id="label_email_id" adr_trans="label_email_id">EMAIL ID</p>
                              <input id="email_id" name="email_id" placeholder="Enter The email id" type="email" autocomplete="off" value="<?php echo  @$appointment_update_details['email'];?>" class="form-control form-value" onblur="this.value=this.value.trim()" required="">
                              <br>
                          </div>
<?php

if($user_type=="Photographer")
{
  ?>

<div class="col-md-12"  >
          <span id="add_info"><i class="fa fa-plus-circle" id="add" onclick="show()" aria-hidden="true"></i></span>&nbsp;&nbsp;Add contact person(optional)<span id="label_contact_person" adr_trans="label_contact_person"></span><br>
         </div>


   <?php } else { ?>

<div class="col-md-12"  >
          <span id="add_info"><i class="fa fa-plus-circle" id="add" onclick="show()" aria-hidden="true"></i></span>&nbsp;&nbsp;<span id="label_contact_person" adr_trans="label_contact_person"></span><br>
         </div>
<?php } ?>


         <script>
           $('#add_info').click(function(){
            $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
              });
         </script>
          <div id="show" style="display:none;">
          <div class="col-md-6">
                              <p id="label_name" adr_trans="label_name">NAME</p>
                              <input id="name" name="name" value="<?php echo  @$appointment_update_details['contact_person_name'];?>" placeholder="Enter The name" visibility="hidden" type="text" autocomplete="off" class="form-control form-value" >

          </div>
        <div class="col-md-6">
                        <p id="label_mobile_no" adr_trans="label_mobile_no">MOBILE NO</p>
                        <input id="mobile_no1" name="mobile_no1" placeholder="Enter The mobile number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" value="<?php echo  @$appointment_update_details['contact_person_mobile'];?>" class="form-control form-value">
        </div>

        <div class="col-md-6">
                        <p id="label_email_id" adr_trans="label_email_id">EMAIL ID</p>
                          <input id="email_id1" name="email_id1" placeholder="Enter The email id" type="email" autocomplete="off" value="<?php echo  @$appointment_update_details['contact_person_email'];?>" onblur="this.value=this.value.trim()" class="form-control form-value">
        </div></div>


     <div class="row">
                    <div class="col-md-12"><center><hr class="space s">



     <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="SaveOrder" adr_trans="label_next"><i class="fa fa-chevron-circle-right"></i>Next</button>

	 <?php
	 $user_type=$_SESSION['user_type'];

					if($user_type=="Photographer")
					{

	 ?>
               &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="photographerCalendar.php"  id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>

			   <?php } else { ?>
			     &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" id="label_cancel" adr_trans="label_cancel" onclick="return confirm('Are you sure want to cancel the order?');" href="csrRealtorCalendar.php"><i class="fa fa-times"></i>Cancel</a>

			   <?php } ?>
</center>
     </div>



                </div>
                 </form>



            </div>
        </div>
     </div>
     <script>
            function init() {
                var input = document.getElementById('locationTextField');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>



		<?php include "footer.php";  ?>
