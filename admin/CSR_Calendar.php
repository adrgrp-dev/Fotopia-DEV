<?php
ob_start();

include "connection1.php";

$csr_id_is=$_SESSION['admin_loggedin_id'];
$pc_admin_id_qry1=mysqli_query($con,"select * from admin_users where id='$csr_id_is' and type_of_user='CSR'");
$pc_admin_id_qry=mysqli_fetch_array($pc_admin_id_qry1);
$pc_admin_id_is=$pc_admin_id_qry['pc_admin_id'];



if(@$_REQUEST['busy'])
{

$fromDatetime=$_REQUEST['fromDatetime'];
$toDatetime=$_REQUEST['toDatetime'];
$Photographer_id=$_REQUEST['Photographer_id'];
$Photographer_name=$_REQUEST['ph_name'];

mysqli_query($con,"INSERT INTO `appointments` (`order_id`, `created_by_id`, `photographer_id`, `home_seller_id`, `from_datetime`, `to_datetime`, `status`, `active`) VALUES ('0', '0', '$Photographer_id', '0', '$fromDatetime', '$toDatetime', '0', '1')");
header("location:CSR_Calendar.php?ph_id=$Photographer_id&ph_name=$Photographer_name");
}
if(@$_REQUEST['deleteBusy'])
{
$busyid=$_REQUEST['busyid'];
$ph_id=$_REQUEST['ph_id'];
$ph_name=$_REQUEST['ph_name'];
mysqli_query($con,"delete from `appointments` where id='$busyid'");
header("location:CSR_Calendar.php?ph_id=$ph_id&ph_name=$ph_name");
}
?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
			<script>
			function fillPhId()
			{
		  var value= $('#ph_name').val();

  var photographer_id=$('#phList [value="' + value + '"]').data('value');
			//alert(photographer_id);
			$("#ph_id").val(photographer_id);
			$("#filterForm").submit();
			}



			var urlNew="";
			</script>
                <div class="col-md-8" style="padding-left:10px;">

<div class="row">
<div class="col-md-12" style="padding-left:20px;height:30px;width:100%">
				<div class="col-md-12" style="float:left;display:inline-block">
				<center><h5> CSR <span class="text-center" id="label_calendar" adr_trans="label_calendar"> Calendar</span> - <?php echo strtoupper($_SESSION['admin_loggedin_name']); ?>
				</h5>  <p align="right" style="position: absolute;right: 15px;" >
          <?php
           $csr_id=$_SESSION['admin_loggedin_id'];
            $get_pcadmin_query=mysqli_query($con,"select * from admin_users where id=$csr_id");
            $get_pcadmin=mysqli_fetch_array($get_pcadmin_query);
            $pc_admin_id=$get_pcadmin['pc_admin_id'];
          ?>
               <a href="photographerCalendar1.php?pc_admin_id=<?php echo $pc_admin_id;?>&csr_id=<?php echo $csr_id; ?>" id="label_create_new_order" adr_trans="label_create_new_order" class="anima-button circle-button btn-sm btn"><i class="fa fa-calendar"></i> Create New Order</a>
                </p></center></div>
				</div>
			</div>
<table class="table-responsive table-stripped" style="border-color:none!important;width:100%">
<tr>
<td align="left" style="width:200px;"><form name="" method="post" action="" id="filterForm">
<input type="text" name="ph_name"  id="ph_name" list="phList" onchange="fillPhId();" value="<?php echo @$_REQUEST['ph_name'];?>" placeholder="Select a photographer" autocomplete="off"  class="form-control" style="width:200px;margin-bottom:10px;"/>

 <datalist id="phList">
 	 <option value="" id="label_select_photographer" adr_trans="label_select_photographer">Select a Photographer</option>
       <?php
	   $photographers="select * from user_login where type_of_user='Photographer' and csr_id='$_SESSION[admin_loggedin_id]' order by first_name";

         $Photographers_list=mysqli_query($con,$photographers);
         while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
        {?>
                    <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1['first_name']." ".$Photographers_list1['last_name']; ?>"></option>
                  <?php } ?>

                  </datalist>
				  <input type="hidden" name="ph_id" id="ph_id" value="<?php echo @$_REQUEST['ph_id']; ?>" />
				  </form></td>
				  <td align="left" style="color:#000;">&nbsp; <?php if(@$_REQUEST['ph_name']) { echo strtoupper($_REQUEST['ph_name'])." (Photographer's) Calendar."; } ?></td>

</table>




<link href='../lib/main.css' rel='stylesheet' />
				<style>


				#calendar
				{
				background-color:#FFFFFF;
				border-radius:25px!important;
				}

				table td[class*="col-"], table th[class*="col-"]
				{
				background:#EEE;

				}
        .fc-day-mon,.fc-day-tue,.fc-day-wed,.fc-day-thu,.fc-day-fri
        {
        background:#FFF!important;
        border:solid 1px #EEE!important;
        }
        .fc-day-sat,.fc-day-sun
        {
        background:#EEEEEE!important;

        }
        .fc-daygrid-event
        {
        background:none!important;
        }
        .status1
        {
		background-color:#b5e2ff!important;
        color:#000080!important;
        }

        .status3,.status6
        {
        color:#006600!important;
		background-color:#D0F0C0!important;
        }
        .status2,.status4,.status5
        {
		background-color:#FED8B1!important;
        color:#FF8400!important;
        }

.fc-day-mon,.fc-day-tue,.fc-day-wed,.fc-day-thu,.fc-day-fri
{
background:#FFF!important;
border:solid 1px #000!important;
}
.fc-day-sat,.fc-day-sun
{
border:solid 1px #000!important;
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



.fc-day-today
{
background:#E8F0FE!important;
border:solid 1px #01A8F2!important;
}

h2.fc-toolbar-title
{
display:contents;
color:#FFF!important;
border:solid 1px #000!important;
padding:10px;
}


.fc .fc-toolbar.fc-header-toolbar
{
background:#FFF;
border-radius:25px;
}

.fc-scroller-harness,.fc-scroller-harness-liquid
{
border-radius:25px!important;
}


.fc-prev-button, .fc-next-button
{
background:#000!important;
color:#FFF!important;
margin:10px!important;

}
/*.fc-event-main .status2
{
background-color:#FED8B1!important;
color:#242526!important;
font-weight:bold;
}
.fc-event-main-frame .status1
{
background-color:#67B7D1!important;
color:#242526!important;
font-weight:bold;
}
*/
.fc-timegrid-event .fc-event-time
{
margin-bottom:0px!important;
}
.fc-timegrid-event .fc-event-time
{
margin-bottom:0px!important;
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
.fc-button
{
margin:2px!important;
}


@media only screen and (max-width: 600px) {
  .fc-prev-button, .fc-next-button, .fc-button
{
background:#000!important;
color:#FFF!important;
margin:3px!important;
font-size: 5px!important;
}
.fc .fc-toolbar-title
{
font-size:7px!important;

}
.forMobile
{
height:fit-content!important;
}
.fc-col-header-cell-cushion
{
font-size:10px!important;
}
#label_create_new_order
{
float:right!important;
margin-right:-160px!important;
font-size:10px!important;
margin-top:15px;
}
}


				</style>


				<script src='../lib/main.js'></script>
			<?php
			if(@$_REQUEST['ph_id'])
{
		?>
			<script>
		var urlNew="../photographer_events.php?photographer_id=<?php echo $_REQUEST['ph_id']; ?>";
		var urlNew1="photographer_busy.php?pc_admin_id=<?php echo $pc_admin_id_is; ?>&photographer_id=<?php echo @$_REQUEST['ph_id']; ?>&csr_id=<?php echo $_SESSION['admin_loggedin_id']; ?>";

			</script>

			<?php } else {  ?>
			<script>
				var urlNew="super_event.php?csr_id=<?php echo $_SESSION['admin_loggedin_id']; ?>";
var urlNew1="";
			</script>
			<?php }   ?>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: urlNew,
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridWeek',
	  contentHeight: 530,
	   fixedWeekCount: false,
      nowIndicator: true,
      headerToolbar: {
        left: 'today',
        center: 'prev,title,next',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
businessHours: // specify an array instead
  {
    dow: [ 1, 2, 3,4,5 ], // Monday, Tuesday, Wednesday, Thursday, Friday
    start: '08:00', // 8am
    end: '17:00' // 6pm
  },


      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
	  displayEventTime:true,// allow "more" link when too many events
     // events: response,
	  eventSources: [
    urlNew,
  urlNew1
  ],
	    select: function(info) {
       // alert('selected ' + info.startStr + ' to ' + info.endStr);
	   if(info.view.type=="timeGridDay" || info.view.type=="timeGridWeek")
	  {

		createEventDateTimeNew(info.startStr,info.endStr);
		}
      },
	   eventDrop: function(info) {
   //alert(info.event.title + " was dropped on " + info.event.start.toISOString());

	if(info.event.extendedProps.status=='BUSY')
	{
	 info.revert();
	}

	},
	  selectOverlap: function(event) {
    return event.rendering === 'background';
  },
	    eventClick: function(info) {
		if(info.event.extendedProps.status!='BUSY')
		{
		var even=info.event;
   window.location.href = "superOrder_detail.php?id="+even.extendedProps.orderId;
  }
  else
   {
   var ph_name='<?php echo strtoupper(@$_REQUEST['ph_name']);?>';
    var ph_id='<?php echo @$_REQUEST['ph_id'];?>';
   if(confirm("Are you sure want to remove the selected BUSY event of Mr."+ph_name+"?")) {
  // alert(info.event.extendedProps.orderId);
  window.location.href = "CSR_Calendar.php?deleteBusy=1&busyid="+info.event.extendedProps.orderId+"&ph_id="+ph_id+"&ph_name="+ph_name;
   }
   }
  }
    });

    calendar.render();



	}
	});


  });

</script>

	<div id='calendar' style="box-shadow:10px 10px 10px 10px #DDD;opacity:0.8"></div>

    </div>
	<div class="col-md-2" style="margin-top:80px;border:solid 1px #000;padding-right:0px;height:auto">
	<div style="background:#000;color:#FFF!important;padding:5px;width:100%;"><h5 id="label_today_appointment" adr_trans="label_today_appointment" align="center" style="color:#FFF;"><u>Today's Appointment</u><br /><br /> <?php echo date("d-M-Y"); ?></h5></div>
	<?php
	$appointments="";
	if(@$_REQUEST['ph_id']) {
	$appointments=mysqli_query($con,"select * from appointments where photographer_id!=0 and photographer_id='$_REQUEST[ph_id]' and date(from_datetime)=CURRENT_DATE order by from_datetime");
	}
	else
	{
$appointments=mysqli_query($con,"select * from appointments where photographer_id!=0 and photographer_id in(select id from user_login where type_of_user='Photographer' and csr_id='$_SESSION[admin_loggedin_id]') and date(from_datetime)=CURRENT_DATE order by from_datetime");
	}


	while($appointments1=mysqli_fetch_array($appointments))
	{
	$orderid=$appointments1['order_id'];
	$photographer_id=$appointments1['photographer_id'];

	$order_info1=mysqli_query($con,"select * from orders where id='$orderid'");
	$order_info=mysqli_fetch_array($order_info1);

	$userInfo1=mysqli_query($con,"select * from user_login where id='$photographer_id'");
	$userInfo=mysqli_fetch_array($userInfo1);
	 ?>
	 <span style="color:#006600;font-size:11px;font-weight:600;margin-left:5px;"><i class="fa fa-chevron-circle-right"></i>&nbsp;<?php echo date("H:i a",strtotime($appointments1['from_datetime']))." to ".date("H:i a",strtotime($appointments1['to_datetime']))." - ".$userInfo['first_name']." ".$userInfo['last_name']." , "."Order #".$orderid.", ".$order_info['property_city'].",".$order_info['property_state']; ?></span><br />
	 <?php } ?>

	</div>
	</div>



	</div>




   <script>


    $( document ).on( "click", "td.fc-day", function() {
    var dateIs=$(this).attr("data-date");
    var createEventis=$(this).find("a#createEvent").text();
    if(createEventis=="Create event")
    {
    }
    else
    {

  var FcTop=$(this).find("div.fc-daygrid-day-top");
  var existing=FcTop.html();
  FcTop.html(existing+"<a href='./create_order.php?date="+dateIs+"' class='fc-daygrid-day-number' id='createEvent' style='float:left;padding-right:20px;text-decoration:underline;color:blue'>Create event</a>");
  //console.log(FcTop);
    }
    });


function createEventDateTimeNew(fromDatetime,toDatetime)
    {

var phNameIs='<?php echo strtoupper(@$_REQUEST['ph_name']);?>';
if(phNameIs!='')
{
var fromDate = new Date(fromDatetime);
	var toDate=new Date(toDatetime);
    if(confirm("Are you sure want to mark  Mr."+phNameIs+" (Photographer) with BUSY status for "+fromDate.toDateString()+" "+fromDate.toLocaleTimeString()+" TO "+toDate.toLocaleTimeString()+"?"))
    {

	// var even=info.event;
 var dateMovedTo=fromDatetime;
 var dateIS=dateMovedTo.split("T");
 //alert(dateIS[0]);

 var todayDate1=new Date().toISOString();
 var todayDate=todayDate1.split("T");

 if(todayDate[0]>dateIS[0])
 {
 alert("BUSY status cannot be marked to past date");
  info.revert();

 }
 else
 {
	var phId1='<?php echo @$_REQUEST['ph_id']; ?>';
	var phname1='<?php echo @$_REQUEST['ph_name']; ?>';
   window.location.href="./CSR_Calendar.php?busy=1&fromDatetime="+fromDatetime+"&toDatetime="+toDatetime+"&Photographer_id="+phId1+"&ph_name="+phname1;
   }
    }

    }
   }



    </script>
		<?php include "footer.php";  ?>
