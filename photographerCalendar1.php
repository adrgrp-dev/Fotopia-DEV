<?php
ob_start();

include "connection1.php";

$Photographer_id=$_REQUEST['Photographer_id'];
$phDetail1=mysqli_query($con,"select * from user_login where id='$Photographer_id'");
$phDetail=mysqli_fetch_array($phDetail1);
$pc_admin_id=$phDetail['pc_admin_id'];
$photographer_name_is=$phDetail['first_name']." ".$phDetail['last_name'];
?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:-15px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">

				<a class="lightbox btn btn-primary btn-sm circle-button" id="warningMsg" href="#lb2" data-lightbox-anima="show-scale" style="float:right;margin-bottom:10px;display:none;">+Add Product</a>

<div class="row">
<div class="col-md-12" style="padding-left:20px;height:30px;width:98%">
				<div class="col-md-6" style="float:left;display:inline-block">
				<h5> <span class="" id="label_calendar" adr_trans="label_realtor_calendar"> Calendar</span> - Photographer - <?php echo strtoupper($photographer_name_is); ?>
				</h5></div>
				<div class="col-md-6" style="float:right">
				<a href="create_order.php" class="anima-button circle-button btn-sm btn" id="label_create_new_order" adr_trans="label_create_new_order" style="float:right;margin-top:-6px;display:none;"><i class="fa fa-calendar"></i> Create New Order</a>
				</div></div>
			</div>


				<link href='lib/main.css' rel='stylesheet' />
				<style>

				#calendar

				{

				background-color:#FFFFFF;

				border-radius:10px!important;

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
background: #FFF!important;
color:#000!important;
border:solid 1px #01A8F2!important;
}

h2.fc-toolbar-title
{
display:contents;
color:#000!important;
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
background:#FFF!important;
color:#000!important;
margin:10px!important;

}
/*.fc-event-main .status2
{
background-color:#FED8B1!important;
color:#242526!important;
font-weight:bold;
}
.fc-event-main-frame .status1{
background-color:#67B7D1!important;
color:#242526!important;
font-weight:bold;
}
*/
.fc-timegrid-event .fc-event-time
{
margin-bottom:0px!important;
}

.active
{
background:none!important;
}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
{
border-top:none!important;
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
@media only screen and (max-width: 700px) {

#calendar{

	width: 392px;
}	

  .fc-prev-button, .fc-next-button, .fc-button
{
/*background:#000!important;
color:#FFF!important;*/
margin:3px!important;
font-size: 10px!important;
}
.fc .fc-toolbar-title
{
font-size:5px!important;
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


.busyIcon
{
display:none;
}
				</style>
				<script src='lib/main.js'></script>
<script>


function close_modal()
{
$(".mfp-close").click();
}


var pc_admin_id='<?php echo $pc_admin_id; ?>';
$.ajax({
      url: "Google-Calendar-API-Service.php",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){

	  }
	});


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: "photographer_events.php?photographer_id=<?php echo $_REQUEST["Photographer_id"]; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridWeek',
	  contentHeight: 520,
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
    'photographer_events.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>',
   'photographer_busy.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>'
  ],
	   select: function(info) {
       // alert('selected ' + info.startStr + ' to ' + info.endStr);
	   if(info.view.type=="timeGridDay" || info.view.type=="timeGridWeek")
	  {

 var dateMovedTo=info.start.toISOString();
 var dateIS=dateMovedTo.split("T");
 //alert(dateIS[0]);

 var todayDate1=new Date().toISOString();
 var todayDate=todayDate1.split("T");

 if(todayDate[0]>dateIS[0])
 {
 alert("Appointment cannot be created to past date");
  return false;

 }		createEventDateTimeNew(info.startStr,info.endStr);

		}

      },
	  selectOverlap: function(event) {
    return event.rendering === 'background';
  },
	   dateClick: function(info) {
	// console.log("aaaaa");
	 console.log(info);
	 // console.log("bbbbb");
	 // console.log(info.view.type);
	  if(info.view.type=="timeGridWeek")
	  {
	  var dateIs=info.dateStr;
	  var dateArray=dateIs.split("T");
	 var timeIs=dateArray[1].split("+");

	// createEventDateTime(dateArray[0],timeIs[0]);
	  }
          //  alert('Clicked on: ' + info.dateStr);
           // alert('Current view: ' + info.event.timeText)

			},
			eventResize: function(info) {
			 info.revert();
			 },
			 eventDrop: function(info) {
			 info.revert();
			 },
	  eventClick: function(info) {
		var even=info.event;
		if(info.event.extendedProps.status!='BUSY')
		{
		if(even.extendedProps.gmailEvent==1)
		{
		var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Denne hendelsen er imporrtert fra Google kalenderen din. Derfor er ikke detaljer tilgjengelige";
		}
		else
		{
		alertmsg="This event is imported from your google calendar. So details not available";
		}
alert(alertmsg);
		}
		else
		{
   window.location.href = "photographerorder_detail.php?id="+even.extendedProps.orderId;
   }
   }
  }
    });

    calendar.render();



	}
	});


  });

</script>

	<div id='calendar'  style="border-radius:5px"></div>

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
	var phId='<?php echo $_REQUEST['Photographer_id']; ?>';
     var FcTop=$(this).find("div.fc-daygrid-day-top");
     var existing=FcTop.html();

     FcTop.html(existing+"<a href='./create_order.php?date="+dateIs+"&Photographer_id="+phId+"&pc_admin_id="+pc_admin_id+"' class='fc-daygrid-day-number' id='createEvent' style='float:left;padding-right:20px;text-decoration:underline;color:blue'>Create event</a>");
    //console.log(FcTop);
    }
    });



    var date1;
    var time1;
    function createEventDateTime(date1,time1)
    {

    var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';

		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil  lage et arrangement for";
		}
		else
		{
		alertmsg="Are you sure want to create an event for";
		}
    if(confirm(alertmsg+" "+date1+" & "+time1+"?"))
    {
	var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
    window.location.href="./create_order.php?date="+date1+"&time="+time1+"&Photographer_id="+phId1+"&pc_admin_id="+pc_admin_id;
    }

    }

	function createEventDateTimeNew(fromDatetime,toDatetime)
    {
	var fromDate = new Date(fromDatetime);
	var toDate=new Date(toDatetime);
//alert(dateFormat(date1, "dddd, mmmm dS, yyyy, h:MM:ss TT"));
var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';

		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil  lage et arrangement for";
		}
		else
		{
		alertmsg="Are you sure want to create an event for";
		}

    if(confirm(alertmsg+" "+fromDate.toDateString()+" "+fromDate.toLocaleTimeString()+" TO "+toDate.toLocaleTimeString()+"?"))
    {
	var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
    window.location.href="./create_order.php?fromDatetime="+fromDatetime+"&toDatetime="+toDatetime+"&Photographer_id="+phId1+"&pc_admin_id="+pc_admin_id;
    }

    }

</script>






<div id="lb2" class="box-lightbox col-md-4" style="padding-left:20px;padding-right:20px;padding-bottom:10px;padding-top:20px;color:#000!important;border-radius:25px;border:none!important;">
                      	   <h5 class="text-center" id="label_warning" adr_trans="label_warning" style="color:orange!important;">Booking Warning!<br /></h5>
					<table class="table table-responsive"><tr><td>



<span adr_trans="label_booking_content">The appointment time needs to be approved by the photographer and is subject to change based on drive times etc. The photographer will reach out to confirm or adjust as needed</span>
<br /><br />
<p align="center"><a href="csrRealtorDashboard.php" class="btn btn-default anima-button circle-button btn-sm"><i class="fa fa-times-circle"></i><span adr_trans="label_cancel">Cancel</span></a>&nbsp;&nbsp;<button type="button" class="btn btn-default anima-button circle-button btn-sm" onclick="close_modal();"><i class="fa fa-check-circle"></i><span adr_trans="label_got_it">Got It</span></button></p>


</td></tr></table></div>

<script>
$(document).ready(function() {
    $("#warningMsg").click();
});

</script>
		<?php include "footer.php";  ?>
