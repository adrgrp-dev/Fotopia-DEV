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
$loggedin_type=$_SESSION['admin_loggedin_type'];

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `action_date`) VALUES ('Order','Created','$loggedin_name',$loggedin_id,$loggedin_type,now())");
}

else{

$res=mysqli_query($con,"UPDATE `home_seller_info` SET `name`='$sell_name',`address`='$address',`mobile_number`='$mobile_no',`email`= ' $email_id ',`city`='$city',`state`='$state',`country`='Norway',`zip`='$zip',`reference_number`='$ref_no',`contact_person_name`='$name',`contact_person_mobile`='$mobile_no1',`contact_person_email`='$email_id1',`notes`=' ',`lead_from`='$lead_from',`request_name`='$realtor_name',`request_contact_no`='$realtor_contactNo',`request_email`='$realtor_email',`request_address`='$realtor_address' where id='$hs_id_is'");

$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];
$loggedin_type=$_SESSION['admin_loggedin_type'];

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `action_date`) VALUES ('Order','Updated','$loggedin_name',$loggedin_id,$loggedin_type,now())");
$pc_admin_id1=@$_REQUEST['pc_admin_id'];
$Photographer_id1=@$_REQUEST['Photographer_id'];
if(@$_REQUEST['u'])
{
  $edit="&edit=1";
}
$params="hs_id=".$hs_id_is."&pc_admin_id=".$pc_admin_id1."&Photographer_id=".$Photographer_id1."&od=".$_REQUEST['od'].$edit;

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
  margin-top: 30px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  box-shadow: 0 1px 1px black, 0 4px 14px rgba(0, 0, 0, 0.7);
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

  box-shadow:10px 10px 10px #ccc;
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
background-color:#337AB7;
}

#firstStep:after {
background-color:#000;
}

@media all and (max-width: 1000px) {
  .breadcrumb1 {
    font-size: 12px;
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

color:#FFF!important;
background:#000!important;
}
#firstStep
{
border-radius:0px!important;
}

</style>
<script>
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
function saveRealtor()
{

var realtor_name=$("#realtor_name").val();
var realtor_contactNo=$("#realtor_contactNo").val();
var realtor_email=$("#realtor_email").val();
var realtor_address=$("#realtor_address").val();
var realtor_employer_id=$("#realtor_employer_id").val();

if(realtor_name=='')
{
$("#realtor_name").css("border","solid 2px red");
$("#realtor_name").focus();
return false;
}
else
{
$("#realtor_name").css("border","solid 1px grey");

}

if(realtor_contactNo=='')
{
$("#realtor_contactNo").css("border","solid 2px red");
$("#realtor_contactNo").focus();
return false;
}
else
{
$("#realtor_contactNo").css("border","solid 1px grey");

}
     

if(realtor_email=='')
{
$("#realtor_email").css("border","solid 2px red");
$("#realtor_email").focus();
return false;
}
else
{
$("#realtor_email").css("border","solid 1px grey");

}


if(realtor_address=='')
{
$("#realtor_address").css("border","solid 2px red");
$("#realtor_address").focus();
return false;
}
else
{
$("#realtor_address").css("border","solid 1px grey");

}

if(realtor_employer_id=='')
{
$("#realtor_employer_id").css("border","solid 2px red");
$("#realtor_employer_id").focus();
return false;
}
else
{
$("#realtor_employer_id").css("border","solid 1px grey");

}
 xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	
     $("#realtor_saved_msg").html(this.responseText);
	 $("#realtor_saved_msg").show(300);
	 $("#save_realtor").hide(600);
	 
    }
  };
  xhttp.open("GET", "save_realtor.php?realtor_name="+realtor_name+"&realtor_contactNo="+realtor_contactNo+"&realtor_email="+realtor_email+"&realtor_address="+realtor_address+"&realtor_employer_id="+realtor_employer_id, true);
  xhttp.send();

}

function RealtorSearch(realtorId)
{
$("#save_realtor").hide(300);
if(realtorId=='')
{
	 $("#realtor_name").val('');
$("#realtor_contactNo").val('');
$("#realtor_email").val('');
$("#realtor_address").val('');
$("#realtor_employer_id").val('');
 $("#save_realtor").show(300);
}
else
{
 $("#save_realtor").hide(600);
 
 xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    const abc=JSON.parse(this.responseText);
	 $("#realtor_name").val(abc[0].first_name);
$("#realtor_contactNo").val(abc[0].contact_number);
$("#realtor_email").val(abc[0].email);
$("#realtor_address").val(abc[0].address_line1);
$("#realtor_employer_id").val(abc[0].realtor_employer_id);
    }
  };
  xhttp.open("GET", "get_realtor_info.php?realtor_id="+realtorId, true);
  xhttp.send();
}

}
</script>

 <div class="section-empty bgimage3">
        <div class="" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:10px;">
	<?php include "sidebar.php"; ?>

			</div>


      <div class="col-md-10" style="padding-top:10px;">







	<div class="breadcrumb1 hidden-xs hidden-sm">
		<a href="#" class="btn btn-default" id="firstStep"><i class="fa fa-camera-retro" style="font-size:40px;"></i>
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




    <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="" style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;padding:10px;opacity:0.9;border-radius:25px 25px 25px 25px">


      <?php
   $user_type=@$_SESSION['admin_loggedin_type'];

          if($user_type=="PCAdmin"||$user_type=="CSR")
          {
   ?>
<?php
if(@$_REQUEST["hs_id"]!='')
{
$hs_id_is = @$_REQUEST["hs_id"];
$appointment_update=mysqli_query($con,"select * from home_seller_info where id='$hs_id_is'");
$appointment_update_details=mysqli_fetch_array($appointment_update);
}
?>
   <div class="col-md-6">
    <label for="from_homeseller">
          <input type="radio" id="from_homeseller" name="from_whom" value="homeseller" <?php if(@$_REQUEST["hs_id"]!='' && $appointment_update_details['lead_from']=="homeseller"){ echo "checked"; } ?>  required /><span adr_trans="label_from_homeseller"> FROM HOMESELLER</span>
        </label>
      
      </div>
      <div class="col-md-6">
        <label for="from_realtor">
          <input type="radio" id="from_realtor" name="from_whom" value="realtor" <?php if(@$_REQUEST["hs_id"]!='' && $appointment_update_details['lead_from']=="realtor"){echo "checked"; };?> /><span adr_trans="label_from_realtor"> FROM REALTOR </span>
        </label>
         &nbsp; &nbsp; &nbsp;
	   <select name="realtor_id" id="realtor_id" class="form-control" list="realtors_list"  style="display:inline-block;visibility:hidden;width:230px;" onchange="RealtorSearch(this.value)">
<option value="">Create New Realtor</option>
						<?php

						$selectrealtor=mysqli_query($con,"SELECT organization_name as org,id,type_of_user,first_name FROM `user_login` where organization_name!='' and type_of_user='Realtor' and email_verified=1");
						while($selectrealtor1=mysqli_fetch_array($selectrealtor))
						{
						?>
						<option value="<?php echo $selectrealtor1['id']; ?>"><?php echo $selectrealtor1['first_name']." (".$selectrealtor1['org'].")"; ?></option>
						<?php } ?>

</select>
      </div>

    <br>

<script>

$(function() {
   $("input[name='from_whom']").click(function() {
     if ($("#from_realtor").is(":checked")) {
       $("#realtor_information").show();
       $("#realtor_name").attr("required","required");
       $("#realtor_contactNo").attr("required","required");
       $("#realtor_email").attr("required","required");
       $("#realtor_address").attr("required","required");
     $("#from_whom").removeAttr('required');
	 
	  $("#realtor_id").css("visibility","visible");
       $("#realtor_id").attr("required","required");

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


</script>

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
                        <p>REALTOR CONTACT NO</p>
                        <input id="realtor_contactNo" name="realtor_contactNo" placeholder="Enter The Realtor contact Number" type="number" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_contact_no'];?>" class="form-control form-value" required>
    </div>
    <div class="col-md-6">
                        <p>REALTOR EMAIL</p>
                        <input id="realtor_email" name="realtor_email" placeholder="Enter The Realtor email id" type="email" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_email'];?>" class="form-control form-value" required>
                             
    </div>
    <div class="col-md-6">
                        <p>REALTOR ADDRESS</p>
                        <input id="realtor_address" name="realtor_address" placeholder="Enter The Realtor address" type="text" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['request_address'];?>" class="form-control form-value" required>
    </div>
	 <div class="col-md-6">
                        <p>REALTOR EMPLOYER ID</p>
                        <input id="realtor_employer_id" name="realtor_employer_id" placeholder="Enter The Realtor employer ID" type="text" autocomplete="off"
                        value="<?php echo  @$appointment_update_details['realtor_employer_id'];?>" class="form-control form-value" required>
    </div>
	<div class="col-md-6">
                        <p>&nbsp;</p>
                 <input type="button" name="save_realtor" id="save_realtor" class="btn btn-default btn-sm" value="Save New Realtor" style="border-radius:25px;" onclick="saveRealtor()" />
				&nbsp;&nbsp; <span id="realtor_saved_msg" style="color:#006600;font-size:13px; display:none"></span>
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
                        <input id="fnd_address" name="fnd_address" placeholder="Find The Address" type="text" autocomplete="off" class="form-control form-value" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
                        <span style="float:right;margin-top:-30px;"><i class="fa fa-search" style="margin-left:-25px;"></i></span>
    </div>

    <div class="col-md-6">
                        <p id="label_homeseller_name" adr_trans="label_homeseller_name">HOME SELLER NAME</p>
                        <input id="sell_name" name="sell_name" placeholder="Enter The home seller name" value="<?php echo  @$appointment_update_details['name'];?>" type="text" autocomplete="off" class="form-control form-value" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
    </div>
    <?php if(@$_REQUEST['u']==2&&@$appointment_update_details['created_by_id']!=$_SESSION['admin_loggedin_id']) { ?>
    <div class="col-md-6">
                        <p id="label_ref_no" adr_trans="label_ref_no">REFERENCE NO</p>
                        <input id=" ref_no" name="ref_no" placeholder="Enter The Reference Number"  value="<?php echo  @$appointment_update_details['reference_number'];?>" type="number" autocomplete="off" class="form-control form-value" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
						<input type="hidden" name="pc_admin_id" value="<?php echo @$_REQUEST['pc_admin_id']; ?>" />
						<input type="hidden" name="Photographer_id" value="<?php echo @$_REQUEST['Photographer_id']; ?>" />
						<input type="hidden" name="od" value="<?php echo @$_REQUEST['od']; ?>" />

    </div>
    <?php } ?>
    <div class="col-md-12">
                        <p id="label_address" adr_trans="label_address">ADDRESS</p>
                        <input id="address" name="address" placeholder="Enter The Address" type="text" autocomplete="off"  value="<?php echo  @$appointment_update_details['address'];?>" class="form-control form-value" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
                      </div>
    <div class="col-md-6">
       <p id="label_city" adr_trans="label_city">CITY</p>
      <select name="city" class="form-control form-value"  value="<?php echo  @$appointment_update_details['city'];?>"  required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
        <option value="<?php echo  @$appointment_update_details['city'];?>" selected  hidden><?php echo @$appointment_update_details['city']; ?></option>
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
       <p id="label_state" adr_trans="label_state">STATE</p>
      <select name="state" class="form-control form-value"  value="<?php echo  @$appointment_update_details['state'];?>" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
        <option value="<?php echo  @$appointment_update_details['state'];?>" selected  hidden><?php echo @$appointment_update_details['state']; ?></option>
                   <?php
							$state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc ");
							while($state=mysqli_fetch_array($state1))
							{
							?>
							<option value="<?php echo $state['states']; ?>"><?php echo $state['states']; ?></option>
							<?php } ?>
                    </select>
      </div>
     <div class="col-md-6">
                        <p id="label_zip_code" adr_trans="label_zip_code">ZIP CODE</p>
                        <input id="zip" name="zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value"  value="<?php echo  @$appointment_update_details['zip'];?>" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
                    </div>


    <div class="col-md-6">
       <p id="label_country" adr_trans="label_country">COUNTRY</p>
      <select name="country" class="form-control form-value"  value="<?php echo  @$appointment_update_details['country'];?>" required="" <?php if(@$_REQUEST['u']) { echo "disabled"; } ?>>
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p id="label_mobile_no" adr_trans="label_mobile_no">MOBILE NO</p>
                              <input id="mobile_no" name="mobile_no" placeholder="Enter The mobile Number" type="number" autocomplete="off"  value="<?php echo  @$appointment_update_details['mobile_number'];?>" class="form-control form-value" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
                          </div>

          <div class="col-md-6">
                              <p id="label_email_id" adr_trans="label_email_id">EMAIL ID</p>
                              <input id="email_id" name="email_id" placeholder="Enter The email id" type="email"   autocomplete="off" value="<?php echo  @$appointment_update_details['email'];?>" class="form-control form-value" required="" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
                              <br>
                          </div>
<?php

if($user_type=="Photographer")
{
  ?>

<div class="col-md-12"  >
          <span id="add_info"><i class="fa fa-plus-circle" id="add" onclick="show()" aria-hidden="true"></i></span>&nbsp;&nbsp;<span adr_trans="label_contact_person">Add contact person(optional)</span><br>
         </div>


   <?php } else { ?>

<div class="col-md-12"  >
          <span id="add_info"><i class="fa fa-plus-circle" id="add" onclick="show()" aria-hidden="true"></i></span>&nbsp;&nbsp;<span adr_trans="label_contact_person">Add contact person(optional)</span><br>
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
                              <input id="name" name="name" value="<?php echo  @$appointment_update_details['contact_person_name'];?>" placeholder="Enter The name" visibility="hidden" type="text" autocomplete="off" class="form-control form-value" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>

          </div>
        <div class="col-md-6">
                        <p id="label_mobile_no" adr_trans="label_mobile_no">MOBILE NO</p>
                        <input id="mobile_no1" name="mobile_no1" placeholder="Enter The mobile number" type="number" autocomplete="off" value="<?php echo  @$appointment_update_details['contact_person_mobile'];?>" class="form-control form-value" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
        </div>

        <div class="col-md-6">
                        <p id="label_email_id" adr_trans="label_email_id">EMAIL ID</p>
                          <input id="email_id1" name="email_id1" placeholder="Enter The email id" type="email" autocomplete="off" value="<?php echo  @$appointment_update_details['contact_person_email'];?>" class="form-control form-value" <?php if(@$_REQUEST['u']) { echo "readonly"; } ?>>
        </div></div>


     <div class="row">
                    <div class="col-md-12"><center><hr class="space s">



     <button class="anima-button circle-button btn-sm btn" type="submit" name="SaveOrder"><i class="fa fa-chevron-circle-right"></i><span adr_trans="label_next">Next</span></button>

	 <?php
	 $user_type=@$_SESSION['user_type'];

					if($user_type=="CSR")
					{

	 ?>
               &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn" href="subcsrOrder_list1.php"  id="label_cancel" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>

			   <?php } else { ?>
			     &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn" id="label_cancel" adr_trans="label_cancel" href="superorder_list1.php"><i class="fa fa-times"></i>Cancel</a>

			   <?php } ?>
</center>
     </div>



                </div>
                 </form>



            </div>
        </div>
     </div>




		<?php include "footer.php";  ?>
