<?php
ob_start();

include "connection1.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

   if(isset($_REQUEST['save_appointment']))
   {

     $property =$_REQUEST["property"];
     $plan=$_REQUEST["plan"];

     $area=$_REQUEST["area"];
     $address_same=@$_REQUEST["address_same"];
     $property_address=$_REQUEST["property_address"];
     $property_city=$_REQUEST["property_city"];
     $property_state=$_REQUEST["property_state"];
     $property_country=$_REQUEST["property_country"];
     $property_zip=$_REQUEST["property_zip"];
$pht_id="";
if(empty($_REQUEST["property_contact_mobile"]))
{
  $property_contact_mobile="";
}
else
{
  $property_contact_mobile = $_REQUEST["property_contact_mobile"];
}

if(empty($_REQUEST["property_contact_email"]))
{
  $property_contact_email="";
}
else
{
  $property_contact_email = $_REQUEST["property_contact_email"];
}


	   $rental_dormitory=@$_REQUEST["rental_dormitory"];
	   if(@$_REQUEST['pht_name']!="")
	   {
	   $pht_id=$_REQUEST["pht_name"];
	   }
	   else
	   {
	   $pht_id=$_REQUEST["Photographer_id"];
	   }
     //--------------the line get from photographer_id value-------------------------------------------//
     //$product=implode(",",$_REQUEST["product"]);
     $notes=$_REQUEST["notes"];
     $status=1;
     $home_seller_id=$_REQUEST["hs_id"];
     $created_id=$_SESSION["loggedin_id"];
     //-------------------------------------------------get value request method------------------------------------------//
     $from_date=$_REQUEST["from"];
     $to_date=$_REQUEST["to"];





$chk_due=$_REQUEST["due"];
$chk_from="";
$chk_to="";

     //-------------------------------------------------timestam format change---------------------------------------------//
     if(@$_REQUEST['from'])
	 {
	 $from_exp=explode("T",$from_date);
      $chk_from=$from_exp[0]." ".$from_exp[1];
	  }
	 if(@$_REQUEST['to'])
	 {
	 $to_exp=explode("T",$to_date);
$chk_to=$to_exp[0]." ".$to_exp[1];
}

if(!empty($from_date))
	 {
	 $_SESSION['fromDatetime']=$from_date;
	 }
	 if(!empty($to_date))
	 {
	 $_SESSION['toDatetime']=$to_date;
	 }
	  if(!empty($chk_due))
	 {
	 $_SESSION['due_date']=$chk_due;
	 }
     //
     //-------------------------------------------------t replace to space -----------------------------------------------//


    //
		if(empty($_REQUEST["due"]))
		{
			$added_date=date("Y-m-d H:i:s",strtotime('+24 hours', strtotime($chk_to)));
			$added_exp=explode(" ",$added_date);
			$chk_due=$added_exp[0];
		//	echo $due_date;
		}
		else
		{
			$chk_due=$_SESSION['due_date'];
		}
  //   $due_exp=explode("T",$due_date);
		// $chk_due=$_REQUEST["due"];

$pc_admin_id1=$_REQUEST['pc_admin_id'];
//$Photographer_id1=$_REQUEST['Photographer_id'];
$Photographer_id1=$pht_id;
$superCSR_ID=0;
$subCSR_ID=0;
						 $loggedin_name=$_SESSION['loggedin_name'];
						 $loggedin_id=$_SESSION['loggedin_id'];
              //echo "select * from user_login WHERE id='$Photographer_id1'";
              if(!empty($Photographer_id1)){
							$user_details_query=mysqli_query($con,"select * from user_login WHERE id='$Photographer_id1'");
							$user_details_query1=mysqli_fetch_assoc($user_details_query);
							$superCSR_ID=$user_details_query1['pc_admin_id'];
							$subCSR_ID=$user_details_query1['csr_id'];
							$photographer_Name=$user_details_query1['first_name']." ".$user_details_query1["last_name"];
							$email_id=$user_details_query1["email"];
            }
            else{
              $superCSR_ID=@$_REQUEST['pc_admin_id'];
              $photographer_Name="";
              $email_id="";

            }
	$editProduct=0;
if(@$_REQUEST['od']!="")
{
$editProduct=1;

$order_id=$_REQUEST['od'];


 mysqli_query($con,"update orders set `home_seller_id`='$home_seller_id', `property_type`='$property', `number_of_floor_plans`='$plan', `area`='$area',`property_address`='$property_address',`property_city`='$property_city',`property_state`='$property_state',`property_country`='$property_country',`property_zip`='$property_zip',`property_contact_mobile`='$property_contact_mobile',`property_contact_email`='$property_contact_email',`address_same`='$address_same',`rental_dormitory`='$rental_dormitory',  `photographer_id`='$Photographer_id1', `session_from_datetime`='$chk_from', `session_to_datetime`='$chk_to', `order_due_date`='$chk_due', `booking_notes`='$notes', `created_by_id`='$created_id',`created_by_type`='$_SESSION[user_type]',`pc_admin_id`='$pc_admin_id1',`csr_id`='$subCSR_ID',`created_datetime`=now(), `status_id`='$status' where id='$_REQUEST[od]'");

mysqli_query($con,"delete from `appointments` where order_id='$_REQUEST[od]'");
if(!empty($Photographer_id1))
{
$get_appointment=mysqli_query($con,"SELECT * FROM appointments WHERE photographer_id=$Photographer_id1 and ((from_datetime <= '$chk_from' AND to_datetime > '$chk_from') OR (from_datetime < '$chk_to' AND to_datetime >= '$chk_to'))");

 $number=mysqli_num_rows($get_appointment);
if($number>0)
{
header("location:create_appointment.php?hs_id=$home_seller_id&&pc_admin_id=$pc_admin_id1&&Photographer_id=$Photographer_id1&&od=$order_id&appdup=1");exit;

}
}
 mysqli_query($con,"INSERT INTO `appointments` (`order_id`, `created_by_id`, `photographer_id`, `home_seller_id`, `from_datetime`, `to_datetime`, `status`, `active`) VALUES ('$order_id', '$created_id', '$Photographer_id1', '$home_seller_id', '$chk_from', '$chk_to', '1', '1')");




 $insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`,`photographer_id`, `Realtor_id`,`pc_admin_id`,`csr_id`,`action_date`) VALUES ('Appointment','Updated','$loggedin_name',$loggedin_id,'Realtor',$pht_id,$loggedin_id,$pc_admin_id1,$subCSR_ID,now())");

}
else
{
//inserting in to order table



    mysqli_query($con,"INSERT INTO `orders` (`home_seller_id`,`realtor_id`, `property_type`, `number_of_floor_plans`, `area`,`property_address`,`property_city`,`property_state`,`property_country`,`property_zip`,`property_contact_mobile`,`property_contact_email`,`address_same`,`rental_dormitory`,  `photographer_id`, `session_from_datetime`, `session_to_datetime`, `order_due_date`, `booking_notes`, `created_by_id`,`created_by_type`,`pc_admin_id`,`csr_id`,`created_datetime`, `status_id`) VALUES ($home_seller_id,'$created_id', '$property', '$plan', '$area','$property_address','$property_city','$property_state','$property_country','$property_zip','$property_contact_mobile','$property_contact_email','$address_same','$rental_dormitory', '$Photographer_id1', '$chk_from', '$chk_to', '$chk_due', '$notes', '$created_id','$_SESSION[user_type]','$pc_admin_id1','$subCSR_ID',now(), '$status')");
$order_id=mysqli_insert_id($con);
if(!empty($Photographer_id1))
{
$get_appointment=mysqli_query($con,"SELECT * FROM appointments WHERE photographer_id=$Photographer_id1 and ((from_datetime <= '$chk_from' AND to_datetime > '$chk_from') OR (from_datetime < '$chk_to' AND to_datetime >= '$chk_to'))");

$number=mysqli_num_rows($get_appointment);
if($number>0)
{
header("location:create_appointment.php?hs_id=$home_seller_id&&pc_admin_id=$pc_admin_id1&&Photographer_id=$Photographer_id1&&od=$order_id&appdup=1");exit;

}
}

 mysqli_query($con,"INSERT INTO `appointments` (`order_id`, `created_by_id`, `photographer_id`, `home_seller_id`, `from_datetime`, `to_datetime`, `status`, `active`) VALUES ('$order_id', '$created_id', '$Photographer_id1', '$home_seller_id', '$chk_from', '$chk_to', '1', '1')");




 $insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`,`photographer_id`, `Realtor_id`,`pc_admin_id`,`csr_id`,`action_date`) VALUES ('Appointment','Created','$loggedin_name',$loggedin_id,'Realtor',$pht_id,$loggedin_id,$pc_admin_id1,$subCSR_ID,now())");
}
//Sending email
//email($photographer_Name,$order_id,$chk_from,$email_id);


	   header("location:select_products.php?od=$order_id&pc_admin_id=$pc_admin_id1&Photographer_id=$Photographer_id1&hs_id=$home_seller_id&u=$editProduct");



}
?>


<?php include "header.php";  ?>
 <div class="section-empty bgimage7">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2"  style="margin-left:-15px;">
				<?php
				$calDate="";
				if(isset($_SESSION['date'])!="")
				{
				$calDate=$_SESSION['date'];
				}
				if(isset($_SESSION['fromDatetime'])!="")
				{
				$calDate=$_SESSION['fromDatetime'];
				}
				?>
				<input type="hidden" name="calDate" id="calDate" value="<?php echo $calDate; ?>" />
	<?php include "sidebar.php"; ?>
  <style>

#calendar{

  background: #FFF!important;
}

.breadcrumb1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 6px;
  overflow: hidden;
  margin-top: 52px!important;
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
  background-color: #DDD;
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
  background-color: #aad1d6;
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

#secondStep:hover {
background-color:#aad1d6;
}
#secondStep:after {
background-color:#aad1d6;
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

.fc .fc-button .fc-icon
{
font-size:0.8em!important;
}
.fc-day-mon,.fc-day-tue,.fc-day-wed,.fc-day-thu,.fc-day-fri
{
background:#CCEDFC!important;
border:solid 1px #01A8F2!important;
}
.fc-day-sat,.fc-day-sun
{
background:#EEEEEE!important;
border:solid 1px #01A8F2!important;
}
.fc-day-today
{
background:#8ed0ed!important;
border:solid 1px #01A8F2!important;
}
.btn-default
{
border-radius:0px;
color:#000!important;
background:#aad1d6!important;
}


  .status1{



		background-color:#86C4F0!important;



        color:#000!important;



        }
.status4,.status5,.status6{
		background-color:#F58883!important;
		color:#000!important;
		 }


        .status3
 {

        color:#000!important;

		background-color:#76EA97!important;

        }
        .status2,.status7 {

		background-color:#FF8400!important;

        color:#000!important;

        }

		.fc .fc-toolbar.fc-header-toolbar
		{
		padding:3px!important;
		font-size:10px!important;
		}
		.fc-toolbar-title
		{
		font-size:10px!important;
		}
		.statusBUSY
{
 pointer-events: none;
	color:#000;
	padding-left:5px;
background: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 10px,
    #ccc 2px,
    #DDD 12px
  ),
  /* on "bottom" */
  linear-gradient(
    to bottom,
    #eee,
    #999
  )!important;

}
  </style>
  				<link href='lib/main.css' rel='stylesheet' />

  <script src='lib/main.js'></script>

 <?php
 $todayIs="";
 if(isset($_SESSION['date']))
 {
 $todayIs=$_SESSION['date'];
 }
 if(isset($_SESSION['fromDatetime']))
 {
 $todayIs=$_SESSION['fromDatetime'];
 $todayIs1=explode("T",$todayIs);
 $todayIs=$todayIs1[0];
 }
 ?>

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
    document.getElementById("property_state").innerHTML = split[0];
    // document.getElementById("property_zip").value= split[1];
  
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

 document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
	var today123='<?php echo $todayIs; ?>';
	var today ="";
	if(today123=='')
	{
today = new Date().toISOString().slice(0, 10)
}
else
{
today=today123;
}
	//alert(today123);

$.ajax({
      url: "photographer_events.php?photographer_id=<?php echo $_REQUEST["Photographer_id"]; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridDay',
	  contentHeight: 600,
	   fixedWeekCount: false,
      nowIndicator: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
	  displayEventTime:true,// allow "more" link when too many events
      eventSources: [
    'photographer_events.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>',
   'photographer_busy.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>'
  ],

    });

    calendar.render();



	}
	});


  });

  function setSecondDate1()
  {
var days = 1;
  var d = new Date(document.getElementById("from").value);
//alert(d);
var year = d.getFullYear();
var month = d.getMonth()+1;
var day = d.getDate();

if (day < 10) {
  day = '0' + day;
}
if (month < 10) {
  month = '0' + month;
}


var dateIs=year+"-"+month+"-"+day;






    var calendarEl = document.getElementById('calendar');
var today = new Date().toISOString().slice(0, 10)
//var today =d;

$.ajax({
      url: "photographer_events.php?photographer_id=<?php echo $_REQUEST["Photographer_id"]; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridDay',
	  contentHeight: 480,
	   fixedWeekCount: false,
      nowIndicator: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,listWeek'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
	  displayEventTime:true,// allow "more" link when too many events
      eventSources: [
    'photographer_events.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>',
   'photographer_busy.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>'
  ],
    });

    calendar.render();
calendar.gotoDate(dateIs);

	}
	});


	if(d!='Invalid Date')
	{
 $("#to").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours())+":"+zeroPadded(d.getMinutes()));


   $("#due").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes()));
  document.getElementById("due").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());
  }
 // alert(booking_chk1());
booking_chk1();



  var from=document.getElementById('from').value;

    var to=document.getElementById('to').value;
  //	alert("to"+to);

    var fromNew = new Date(document.getElementById("from").value);
//		alert("fromNew"+fromNew);
  var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes())+":00";
  //  alert("fromNew1"+fromNew1);
  var toNew = new Date(document.getElementById("to").value);
//	alert("toNew"+toNew);
  var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes())+":00";


var bFound=parseInt($("#BookingFound").val());
//alert(bFound);
$("#appointments_exist_error").hide();
    if(bFound>0)
    {
	//alert("coming123");
     var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#appointments_exist_error").html("Det er en annen avtale planlagt for den valgte fotografen mellom <br>"+fromNew1+" og "+toNew1+", Velg en annen dato og tid.");
		}
		else
		{
		$("#appointments_exist_error").html("There is another appoinment scheduled for the selected photographer <br> in between "+fromNew1+" and "+toNew1+", Kindly choose different Date & Time.");
		}

     //$("#appointments_exist_error").show();
	 //return false;
    }
    if(bFound==0)
    {
//	alert("coming 0");
    //  alert("no appointment");
	$("#appointments_exist_error").hide();
	//$("#appointmentForm").submit();
	return true;
    }


  }


  function setSecondDate()
  {
var days = 1;
  var d = new Date(document.getElementById("from").value);

var year = d.getFullYear();
var month = d.getMonth()+1;
var day = d.getDate();

if (day < 10) {
  day = '0' + day;
}
if (month < 10) {
  month = '0' + month;
}


var dateIs=year+"-"+month+"-"+day;






    var calendarEl = document.getElementById('calendar');
var today = new Date().toISOString().slice(0, 10)
//var today =d;

$.ajax({
      url: "photographer_events.php?photographer_id=<?php echo $_REQUEST["Photographer_id"]; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridDay',
	  contentHeight: 480,
	   fixedWeekCount: false,
      nowIndicator: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,listWeek'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
	  displayEventTime:true,// allow "more" link when too many events
      eventSources: [
    'photographer_events.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>',
   'photographer_busy.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>'
  ],
    });

    calendar.render();
calendar.gotoDate(dateIs);

	}
	});

 $("#to").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours())+":"+zeroPadded(d.getMinutes()));
  document.getElementById("to").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());

 $("#to").attr("value",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes()));
  document.getElementById("to").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());

   $("#due").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes()));
  document.getElementById("due").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());
booking_chk();


 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);


  }



  function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}

  //---------------------------------------- validate greater than or not-----------------------------//


var photographer_id;
  function Get_Products()
{
  var value= $('#pht').val();

  var photographer_id=$('#options [value="' + value + '"]').data('value');

  $('#photo_id').val(photographer_id);
  //console.log(d);

}
var valIs="";
function showHideFloors(valIs)
{
if(valIs=="EmptyLand")
{
$("#plan").attr("readonly","readonly");
$("#plan").attr("style","background:#CCC !important");
$("#plan").removeAttr("placeholder");
$("#plan").val("");
}
else
{
$("#plan").removeAttr("readonly");

$("#plan").attr("style","background:#E8EFFC");
$("#plan").attr("placeholder","Enter the floor number");
}

}

             function setpropertyAddress(){

var property_address="<?php if(isset($_SESSION['property_address'])) { echo $_SESSION['property_address']; } else { echo ""; } ?>";
var property_city="<?php if(isset($_SESSION['property_city'])) { echo $_SESSION['property_city']; } else { echo ""; } ?>";
var property_state="<?php if(isset($_SESSION['property_state'])) { echo $_SESSION['property_state']; } else { echo ""; } ?>";
var property_country="<?php if(isset($_SESSION['property_country'])) { echo $_SESSION['property_country']; } else { echo ""; } ?>";
var property_zip="<?php if(isset($_SESSION['property_zip'])) { echo $_SESSION['property_zip']; } else { echo ""; } ?>";
var property_contact_mobile="<?php if(isset($_SESSION['property_contact_mobile'])) { echo $_SESSION['property_contact_mobile']; } else { echo ""; } ?>";
var property_contact_email="<?php if(isset($_SESSION['property_contact_email'])) { echo $_SESSION['property_contact_email']; } else { echo ""; } ?>";


              if($("#address_same").prop('checked') == true)
                {
                $("#property_address").val("");

                $("#property_city").val("");
                $("#property_state").val("");
                $("#property_country").val("");
                $("#property_zip").val("");
                $("#property_contact_mobile").val("");
                $("#property_contact_email").val("");

                $("#property_address").removeAttr("readonly");
                $("#property_city").removeAttr("readonly");
                $("#property_state").removeAttr("readonly");
                $("#property_country").removeAttr("readonly");
                $("#property_zip").removeAttr("readonly");
                $("#property_contact_mobile").removeAttr("readonly");
                $("#property_contact_email").removeAttr("readonly");

                }
                else
                {
                $("#property_address").val(property_address);
                $("#property_city").val(property_city);
                $("#property_state").val(property_state);
                $("#property_country").val(property_country);
                $("#property_zip").val(property_zip);
                $("#property_contact_mobile").val(property_contact_mobile);
                $("#property_contact_email").val(property_contact_email);

                $("#property_address").attr("readonly","readonly");
                $("#property_city").attr("readonly","readonly");
                $("#property_state").attr("readonly","readonly");
                $("#property_country").attr("readonly","readonly");
                $("#property_zip").attr("readonly","readonly");
                $("#property_contact_mobile").attr("readonly","readonly");
                $("#property_contact_email").attr("readonly","readonly");
                }
             }




function booking_chk()
  {

    var from=document.getElementById('from').value;

    var to=document.getElementById('to').value;
  //	alert("to"+to);
   var photo_id='<?php echo @$_REQUEST['Photographer_id']; ?>';
  //  alert("photo_id"+photo_id);

    var fromNew = new Date(document.getElementById("from").value);
//		alert("fromNew"+fromNew);
  var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes())+":00";
  //  alert("fromNew1"+fromNew1);
  var toNew = new Date(document.getElementById("to").value);
//	alert("toNew"+toNew);
  var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes())+":00";
   //alert("toNew1"+toNew1);
 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);


var od='<?php echo @$_REQUEST["od"]; ?>';
   var value= $('#pht').val();
   var a=0;
   var xhttp= new XMLHttpRequest();
   console.log(photo_id);
   console.log(fromNew);
    console.log(toNew);
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
$("#appointments_exist_error").hide();
      a=parseInt(this.responseText);

       $("#BookingFound").val(a);

      if(a>0)
    {
     var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#appointments_exist_error").html("Det er en annen avtale planlagt for den valgte fotografen mellom <br>"+fromNew1+" og "+toNew1+", Velg en annen dato og tid.");
		}
		else
		{
		$("#appointments_exist_error").html("There is another appoinment scheduled for the selected photographer <br> in between "+fromNew1+" and "+toNew1+", Kindly choose different Date & Time.");
		}
     $("#appointments_exist_error").show();
	 $("#BookingFound").val(a);
    return false;
    }
    else
    {
    //  alert("no appointment");
	$("#appointments_exist_error").hide();

    return true;
    }

    }
  };
  xhttp.open("GET","check_appointment.php?photographer_id="+photo_id+"&fromDate="+fromNew1+"&toDate="+toNew1+"&od="+od,true);
  xhttp.send();
  }
function booking_chk1()
  {

    var from=document.getElementById('from').value;

    var to=document.getElementById('to').value;
  //	alert("to"+to);
   var photo_id='<?php echo @$_REQUEST['Photographer_id']; ?>';
  //  alert("photo_id"+photo_id);

    var fromNew = new Date(document.getElementById("from").value);
//		alert("fromNew"+fromNew);
  var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes())+":00";
  //  alert("fromNew1"+fromNew1);
  var toNew = new Date(document.getElementById("to").value);
//	alert("toNew"+toNew);
  var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes())+":00";
   //alert("toNew1"+toNew1);
 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);


var od='<?php echo @$_REQUEST["od"]; ?>';
   var value= $('#pht').val();
   var a=0;
   var xhttp= new XMLHttpRequest();
   console.log(photo_id);
   console.log(fromNew);
    console.log(toNew);
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	$("#appointments_exist_error").hide();
      a=parseInt(this.responseText);
  $("#BookingFound").val(a);

  if(a>0)
    {
     var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		$("#appointments_exist_error").html("Det er en annen avtale planlagt for den valgte fotografen mellom <br>"+fromNew1+" og "+toNew1+", Velg en annen dato og tid.");
		}
		else
		{
		$("#appointments_exist_error").html("There is another appoinment scheduled for the selected photographer <br> in between "+fromNew1+" and "+toNew1+", Kindly choose different Date & Time.");
		}
     $("#appointments_exist_error").show();
	 $("#BookingFound").val(a);
    return false;
    }
    else
    {
    //  alert("no appointment");
	$("#appointments_exist_error").hide();

    return true;
    }
    }
  };
  xhttp.open("GET","check_appointment.php?photographer_id="+photo_id+"&fromDate="+fromNew1+"&toDate="+toNew1+"&od="+od,true);
  xhttp.send();

  }

           </script>
			</div>

			      <div class="col-md-7" style="padding-top:0px;">



			<div class="breadcrumb1 hidden-xs hidden-sm">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&u=1&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep"><i class="fa fa-camera-retro" style="font-size:40px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_order">Order</span>
				<span class="breadcrumb__desc" adr_trans="label_fill_order">Fill the order</span>
			</span>
		</a>

		<a href="#" id="secondStep" class="btn btn-default"><i class="fa fa-calendar" style="font-size:30px;color:#000;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_appointment">Appointment</span>
				<span class="breadcrumb__desc" adr_trans="label_pick_appointment">Pick appointment</span>

			</span>
		</a>
		<a href="#" id="thirdStep"><i class="fa fa-database" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_products">Products</span>
				<span class="breadcrumb__desc" adr_trans="label_select_products">Select Products</span>

			</span>
		</a>
		<a href="#"><i class="fa fa-file-text-o" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_summary">Summary</span>
				<span class="breadcrumb__desc" adr_trans="label_order_status">Order Status</span>
			</span>
		</a>
	</div>


	<div class="breadcrumb1 hidden-md hidden-lg hidden-xl" style="height:50px;">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&u=1&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_order">Order</span>

			</span>
		</a>

		<a href="#" id="secondStep" class="btn btn-default">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_appointment">Appointment</span>


			</span>
		</a>
		<a href="#" id="thirdStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title"  adr_trans="label_products">Products</span>


			</span>
		</a>
		<a href="#">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="label_summary">Summary</span>

			</span>
		</a><br />
	</div>


			<?php
			if(@$_REQUEST['od']!="")
			{
			$order_fetch1=mysqli_query($con,"select * from orders where id='$_REQUEST[od]'");
			$order_fetch=mysqli_fetch_array($order_fetch1);

			}

			?>
<?php if(@isset($_REQUEST["appdup"])) { ?>

                            <p class="text-error" align="center" style="font-style:italic;color:red">Sorry!. You have just missed.<br />Someone booked the selected slot of the photographer just few seconds ago.</p>

						<?php }  ?>
          <form action=""  method="post" enctype="multipart/form-data" onsubmit="return setSecondDate1()" id="appointmentForm" style="color: #000;background: #fff;padding-left: 8px;padding-bottom: 20px;border-radius: 5px;padding-top: 2px;">
		  <input type="hidden" id="BookingFound" value="0" />
           <input type="hidden" name="hs_id" value="<?php echo @$_REQUEST["hs_id"]; ?>"/>
		   <input type="hidden" name="pc_admin_id" value="<?php echo @$_REQUEST['pc_admin_id']; ?>" />
						<input type="hidden" name="Photographer_id" value="<?php echo @$_REQUEST['Photographer_id']; ?>" />
						<input type="hidden" name="od" value="<?php echo @$_REQUEST['od']; ?>" />
           <div class="col-md-12">

             <input id="address_same" value="1" onchange="setpropertyAddress()" name="address_same" type="checkbox" checked="checked" class="form-value">&nbsp;&nbsp; <span>The property address is different from sellers address</span>

           </div>



          <div class="col-md-4">
              <p id="label_type_property" adr_trans="label_type_property">Type Of Property</p>
             <select name="property" id="TypeOfProperty" class="form-control form-value" required="" onchange="showHideFloors(this.value)" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
                         <option value="" id="label_select_property_type" adr_trans="label_select_property_type">Select a property type</option>

                              <option value="Apartment" id="label_appartment" <?php if(@$order_fetch['property_type']=="Apartment"){ echo "selected"; } ?> adr_trans="label_appartment">Apartment</option>
        					            <option value="Home" id="label_home" adr_trans="label_home" <?php if(@$order_fetch['property_type']=="Home"){ echo "selected"; } ?>>Home</option>
                              <option value="HolidayHome" id="label_holiday_home" adr_trans="label_holiday_home"<?php if(@$order_fetch['property_type']=="HolidayHome"){ echo "selected"; } ?>>Holiday Home</option>
                              <option value="EmptyLand" id="label_empty_land" adr_trans="label_empty_land"<?php if(@$order_fetch['property_type']=="EmptyLand"){ echo "selected"; } ?>>Empty Land</option>
                           </select>
             </div>
            <div class="col-md-4">
              <p id="label_floor_plans" adr_trans="label_floor_plans">No. Of Floor Plans</p>
              <input id="plan" name="plan" placeholder="Enter The Floor Number" type="number" min="0" max="999"  autocomplete="off" class="form-control form-value" required="" value="<?php echo @$order_fetch['number_of_floor_plans']; ?>" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
            </div>
            <div class="col-md-4">
              <p id="label_area" adr_trans="label_area">Area (Sq.Mt)</p>
              <input id="area" name="area" placeholder="Enter The Area" type="number"min="0" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$order_fetch['area']; ?>" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
            </div>
            <div class="col-md-12" class="l">
                        <p >Property Address</p>
                          <input id="property_address" name="property_address" placeholder="Enter The Address" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo @$order_fetch['property_address']; ?>" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>

            </div>
<div class="col-md-6">
       <p>Property City</p>
      <select id="property_city"  name="property_city" onchange="get_states(this.value)" class="form-control form-value" required="" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
        <option value="">Select City</option>
                    <?php
              $city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
              while($city=mysqli_fetch_array($city1))
              {
              ?>
              <option value="<?php echo $city['cities']; ?>" <?php if(@$order_fetch['property_city']==@$city['cities']){ echo "selected"; } ?>><?php echo $city['cities']; ?></option>
              <?php } ?>
                    </select>
                    <span id="validation_message" style="display: none;color: red;position: absolute;top:0px;left:100px;"><span>
      </div>

      <div class="col-md-6">
       <p>Property State</p>
      <select id="property_state" name="property_state" class="form-control form-value"  required="" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
                    <option value="<?php if(isset($_SESSION['property_state'])) {echo $_SESSION['property_state'];}?>"><?php if(isset($_SESSION['property_state'])) {echo $_SESSION['property_state'];}?></option>
                  
                    </select>
      </div>
     <div class="col-md-6">
                        <p>Property Zip code</p>
                        <input id="property_zip" name="property_zip" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" readonly required="" value="<?php echo @$order_fetch['property_zip']; ?>"  >
                    </div>


    <div class="col-md-6">
       <p>Property Country</p>
      <select name="property_country" class="form-control form-value" required="" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p>Property Phone No.</p>
                              <input id="property_contact_mobile" name="property_contact_mobile" placeholder="Enter The mobile Number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" class="form-control form-value" value="<?php echo @$order_fetch['property_contact_mobile']; ?>" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
                          </div>

          <div class="col-md-6">
                              <p>Property Email</p>
                              <input id="property_contact_email" name="property_contact_email" placeholder="Enter The email id" type="email" onblur="this.value=this.value.trim()" autocomplete="off" class="form-control form-value"  value="<?php echo @$order_fetch['property_contact_email']; ?>" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>

                          </div>







						  <div class="col-md-6">
						  <?php
			$photographersNameIs="";
			$photoCompanyNameIs="";
			 if(@$_REQUEST['Photographer_id'])
			 {
			 $photographers=mysqli_query($con,"select * from user_login where id='$_REQUEST[Photographer_id]'");
			 $photographers1=mysqli_fetch_array($photographers);
			 $photographersNameIs=$photographers1['first_name'];
			 }


			 if(@$_REQUEST['pc_admin_id'])
			 {
			 $photoCompanies=mysqli_query($con,"select * from admin_users where id='$_REQUEST[pc_admin_id]'");
			 $photoCompanies1=mysqli_fetch_array($photoCompanies);
			 $photoCompanyNameIs=$photoCompanies1['organization_name'];
			 }


			?>
       <p id="label_photo_company" adr_trans="label_photo_company">Photo Company</p>



	   <input list="photocompanies" name="pht" class="form-control form-value" id="phtcompany"  value="<?php echo strtoupper(@$photoCompanyNameIs); ?>" <?php //if(@$_REQUEST['Photographer_id']) { echo "readonly"; } ?> <?php if(@$_REQUEST['pc_admin_id']=='') { echo "required"; } ?> type="text"   placeholder="Select Photo company" autocomplete="off" />
        <datalist id="photocompanies">
 	 <option data-value="" value="" id="label_select_photographer" adr_trans="label_select_photographer">Select a Photo Company</option><?php
	   $photoCompanyIs="";
	   if(@$_REQUEST['pc_admin_id'])
	   {
	   $photographers="select * from admin_users where id='$_REQUEST[pc_admin_id]'";

	   }
	   else
	   {
	   $photographers="select * from admin_users where type_of_user='PCAdmin' order by first_name";
	   }
         $Photographers_list=mysqli_query($con,$photographers);
         while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
        {?>
                    <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1["organization_name"];?>" <?php if($Photographers_list1["id"]==@$_REQUEST['$pc_admin_id'] || $Photographers_list1["id"]==@$order_fetch['$pc_admin_id']) { echo "selected"; } ?> <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>><?php echo $Photographers_list1["organization_name"];?></option>
                  <?php } ?>

                  </datalist>



      <select name="product[]" id="products" class="form-control form-value" placeholder="Select Multiple Products"  multiple size=3 style="display:none;">

                    </select>
       </div>






            <div class="col-md-6">

       <p id="label_choose_photographer" adr_trans="label_choose_photographer">Select photographer or let us choose one </p>
      <!-- <select name="pht_name" class="form-control form-value" required="" onchange="Get_Products(this.value);"> -->
        <input list="options" name="pht" class="form-control form-value" id="pht" type="text"  value="<?php echo @$photographersNameIs; ?>"  placeholder="Select Photographer" onclick="Get_Products()" onchange=" Get_Products()" <?php // if(@$_REQUEST['Photographer_id']) { echo "readonly"; } ?>  autocomplete="off" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>/>
        <datalist id="options">
 	 <option value="" id="label_select_photographer" adr_trans="label_select_photographer">Select a Photographer</option>
       <?php
	   $photographers="";
	   if(@$_REQUEST['pc_admin_id'])
	   {
	   $photographers="select * from user_login where type_of_user='Photographer' and pc_admin_id='$_REQUEST[pc_admin_id]' order by first_name";
	   }
	   else
	   {
	   $photographers="select * from user_login where type_of_user='Photographer' order by first_name";
	   }
         $Photographers_list=mysqli_query($con,$photographers);
         while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
        {
          ?>
                    <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1["first_name"];?>" <?php if($Photographers_list1["id"]==@$_REQUEST['Photographer_id'] || $Photographers_list1["id"]==@$order_fetch['Photographer_id']) { echo "selected"; } ?>></option>
                  <?php
                 }
                  ?>
                  
                  </datalist>

                  </div>
                  <input id="rental_dormitory" value="1" name="rental_dormitory" type="checkbox" class=" form-value" <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>&nbsp;&nbsp; <span id="label_rental_apartment" adr_trans="label_rental_apartment">This Property has a Rental Apartment/Dormitory</span>

              <input type="hidden" name="pht_name" id="photo_id" />
     <?php
	 $from123="";
	 $to123="";
	 if(@$_REQUEST['od'])
	 {
	 	$appointmentsAre=mysqli_query($con,"select * from appointments where order_id='$_REQUEST[od]'");
$appointmentsAre1=mysqli_fetch_array($appointmentsAre);

$from123=date("Y-m-d H:i",strtotime($appointmentsAre1['from_datetime']));
$from123=preg_replace("/ /","T",$from123);
   $to123=date("Y-m-d H:i",strtotime($appointmentsAre1['to_datetime']));
   $to123=preg_replace("/ /","T",$to123);
   }
   if(isset($_SESSION['date'])!="")
   {
   $from123=$_SESSION['date']."T08:00:00";
    $to123=$_SESSION['date']."T08:00:00";
   }
   if(isset($_SESSION['fromDatetime'])!="" && isset($_SESSION['toDatetime'])!="")
   {
   $from123=$_SESSION['fromDatetime'];
   $to123=$_SESSION['toDatetime'];
   $from123Is=explode(" ",$from123);
   $to123Is=explode(" ",$to123);
    $from123=$from123Is[0];
   $to123=$to123Is[0];
   }

	  ?>

        <br />
             <div class="col-md-4" <?php if(isset($_SESSION['bn'])==1) { echo "style='display:none'";  } ?>>

                                <p id="label_appointment_from" adr_trans="label_appointment_from">From Date & Time  </p>
                                <input id="from" name="from" placeholder="select FromDate" type="datetime-local"  onchange="setSecondDate();" autocomplete="off" class="form-control form-value" min="<?php echo date('Y-m-d')."T".date('H:m'); ?>"  value="<?php echo $from123; ?>" minutestep="10" <?php if(isset($_SESSION['bn'])==1) { echo "readonly";  } ?>>
                            </div>

							<?php

							if(isset($_SESSION['date'])!="" || isset($_SESSION['fromDatetime'])!="")
							{
							?>
							<script>
							//alert("aaaaaaaaaa");
							//setSecondDate();
							</script>


							<?php } ?>
                            <?php
/*
														if(isset($_SESSION['time']))
														{
														  $dates=$_SESSION['date'].'T'.$_SESSION['time'];
															  echo '<script>$("#from").val("'.$dates.'")</script>';
															  echo '<script>$("#from").val("'.$date.'");</script>';
															echo '<script>$("#to").attr("min","'.$date.'");</script>';
															echo '<script>$("#due").attr("min","'.$date.'");</script>';
														}
														elseif(isset($_SESSION['date']))
														{
															$date=$_SESSION['date'].'T00:00';
															echo '<script>$("#from").val("'.$date.'");</script>';
															echo '<script>$("#to").attr("min","'.$date.'");</script>';
															echo '<script>$("#due").attr("min","'.$date.'");</script>';
														}
                            if(isset($_SESSION['photographer_id']))
														{
															$pht_id=$_SESSION['photographer_id'];
															$get_user_query=mysqli_query($con,"select * from user_login where id=$pht_id");
															$get_users=mysqli_fetch_assoc($get_user_query);
															$get_user=$get_users['first_name'];
															echo '<script>$("#pht").val("'.$get_user.'")</script>';
														}
														*/


                            ?>
            <div class="col-md-4"  <?php if(isset($_SESSION['bn'])==1) { echo "style='display:none'";  } ?>>
                              <p id="label_appointment_to" adr_trans="label_appointment_to">To Date & Time</p>
                              <input id="to" name="to" placeholder="Select ToDate" type="datetime-local" autocomplete="off" class="form-control form-value" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" value="<?php echo @$to123; ?>" <?php if(isset($_SESSION['bn'])==1) { echo "readonly";  } ?>>
                            </div>

            <div class="col-md-4">
                              <p id="label_due_date_time" adr_trans="label_due_date_time">Due Date</p>
                              <input id="due" name="due" placeholder="Select DueDate" type="date" autocomplete="off" min="<?php echo date('Y-m-d'); ?>" value="<?php  if(@$_REQUEST['od']) { echo date("Y-m-d",strtotime(@$order_fetch['order_due_date'])); } ?>" class="form-control form-value" required <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>>
                            </div>



                <div class="col-md-12">

                                <p id="label_booking_notes" adr_trans="label_booking_notes">Booking Notes</p>
                    <textarea rows="5" cols="50" id="notes" name="notes" class="form-control form-value" required <?php if(@$_REQUEST['edit']) { echo "readonly"; } ?>><?php echo @$order_fetch['booking_notes']; ?></textarea>
                    
					 <input type="hidden" name="appointments_exist" id="appointments_exist" value="0" />
                </div>


             <div class="row">
                            <div class="col-md-12"><center><br />
                              <div id="appointments_exist_error" class="text-danger" style="display:none"></div>
</center>



                     <a class="anima-button circle-button btn-sm btn adr-cancel" href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&u=1&od=<?php echo @$_REQUEST['od']; ?>" style="float:left;margin-left:20px;"><i class="fa fa-chevron-circle-left"></i><span adr_trans="label_back">Back</span></a>
					 <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="save_appointment" style="float:right;margin-right:20px;" ><i class="fa fa-chevron-circle-right"></i><span adr_trans="label_next">Next</span></button>

             </div>

           </div>

            </form>
			</div>
			<div class="col-md-3">
<hr class="space s">
			<div id='calendar'  <?php if(isset($_SESSION['date'])=='' && isset($_SESSION['fromDatetime'])=='' && isset($_SESSION['Photographer_id'])=='') { echo "style='display:none'";  } else { echo "style='display:block'"; } ?>></div>

			</div>

            </div>
        </div>
<?php   if(isset($_SESSION['Photographer_id']))
{ ?>
<script>

  $(document).ready(function(){
    $('#pht').click();
	$('#pht').attr("readonly","readonly");

  })


</script>

<?php } ?>
<script>
   $("#address_same").click();
   showHideFloors($('#TypeOfProperty :selected').val());
</script>
		<?php include "footer.php";  ?>
