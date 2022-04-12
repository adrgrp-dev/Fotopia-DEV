<?php
ob_start();

include "connection1.php";


if(@$_REQUEST['busy'])
{

$fromDatetime=$_REQUEST['fromDatetime'];
$toDatetime=$_REQUEST['toDatetime'];
$Photographer_id=$_REQUEST['Photographer_id'];

$dateTemp=explode("T",$fromDatetime);
$busyDate=$dateTemp[0];

mysqli_query($con,"INSERT INTO `appointments` (`order_id`, `created_by_id`, `photographer_id`, `home_seller_id`, `from_datetime`, `to_datetime`, `status`, `active`) VALUES ('0', '0', '$Photographer_id', '0', '$fromDatetime', '$toDatetime', '0', '1')");
header("location:photographerCalendar.php?busydate=$busyDate");
}
if(@$_REQUEST['deleteBusy'])
{
$busyid=$_REQUEST['busyid'];

$getDate=mysqli_query($con,"select * from appointments where id='$busyid'");
$getDate1=mysqli_fetch_array($getDate);

$from_datetime1=$getDate1['from_datetime'];

$dateTemp=explode("T",$from_datetime1);
$busyDate=$dateTemp[0];

mysqli_query($con,"delete from `appointments` where id='$busyid'");
header("location:photographerCalendar.php?busydate=$busyDate");
}
?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit;width:100%;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10" style="margin-top:-5px;">
<div class="row">
<div class="col-md-12" style="padding-left:21px;height:27px;width:98%">

				<h5 style="color: #000;margin-top: 10px;"> <span class="text-center" adr_trans="label_calendar"> Calendar</span> - <?php echo strtoupper($_SESSION['loggedin_name']); ?>
				</h5>

				</div>
			</div>

<?php
$pht = $_SESSION['loggedin_id'];
?>


		<p align="center" class="text-success" style="display:none" id="appointment_msg">Your request for the order update has been sent to the Realtor for an approval.<br />You will be notified once the Realtor approves your request</p>
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
border-radius:0px!important;
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
@media only screen and (max-width: 600px) {
  .fc-prev-button, .fc-next-button, .fc-button
{
background:#FFF!important;
color:#000!important;
margin:1px!important;
font-size: 8px!important;
}
.fc .fc-toolbar-title
{
font-size:9px!important;

}
.fc .fc-button-primary {
  margin: 0px !important;
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
				<script src='lib/main.js'></script>
<script>
var busyDate=0;
var busyDateIs="<?php echo @$_REQUEST['busydate']; ?>";
</script>
<?php if(@$_REQUEST['busydate'])
{
		?><script>
				busyDate=1;
				</script>
			<?php } ?>

<script>
function removeBusy(appid)
{
alert(appid);
}

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
      url: "photographer_events.php?photographer_id=<?php echo $_SESSION['loggedin_id']; ?>",
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
    'photographer_events.php?photographer_id=<?php echo $_SESSION['loggedin_id']; ?>',
   'photographer_busy.php?photographer_id=<?php echo $_SESSION['loggedin_id']; ?>'
  ],
	  select: function(info) {
       // alert('selected ' + info.startStr + ' to ' + info.endStr);
	   if(info.view.type=="timeGridDay" || info.view.type=="timeGridWeek")
	  {
		createEventDateTimeNew(info.startStr,info.endStr);
		}
      },
	  selectOverlap: function(event) {
    return event.rendering === 'background';
  },
     // ---- new-----
     dateClick: function(info) {

	  if(info.view.type=="timeGridDay")
	  {
	  var dateIs=info.dateStr;
	  var dateArray=dateIs.split("T");
	 var timeIs=dateArray[1].split("+");

	 createEventDateTime(dateArray[0],timeIs[0]);
	  }
          //  alert('Clicked on: ' + info.dateStr);
           // alert('Current view: ' + info.event.timeText)

			},
			 eventDrop: function(info) {
			 info.revert();
			 }, eventResize: function(info) {
			 info.revert();
			 },
	  eventClick: function(info) {
	  console.log(info);
	  if(info.event.extendedProps.status!='BUSY')
	{
		var even=info.event;

		if(even.extendedProps.gmailEvent==1)
		{
		alert("This event is imported from your google calendar. So details not available");
		}
		else
		{
   window.location.href = "photographerorder_detail.php?id="+even.extendedProps.orderId;
   }
   }
    if(info.event.extendedProps.status=='BUSY' && info.event.extendedProps.gmailEvent!=1)
   {
   if(confirm("Are you sure want to remove the selected BUSY event?")) {
  // alert(info.event.extendedProps.orderId);
  window.location.href = "photographerCalendar.php?deleteBusy=1&busyid="+info.event.extendedProps.orderId;
   }
   }

  }
    });

    calendar.render();
if(busyDate==1)calendar.gotoDate(busyDateIs);


	}
	});


  });

function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}

/*$(document).ready(function(){
alert("yessss");
$(".fc-scrollgrid-sync-inner").mouseover(function(){
  alert("yes");
});
});*/
</script>

	<div id='calendar' style="border-radius:5px"></div>

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
      var phId='<?php echo $_SESSION['loggedin_id']; ?>';
  var FcTop=$(this).find("div.fc-daygrid-day-top");
  var existing=FcTop.html();
  FcTop.html(existing+"<a href='./create_order.php?date="+dateIs+"&photographer_id="+phId+"' class='fc-daygrid-day-number' id='createEvent' style='float:left;padding-right:20px;text-decoration:underline;color:blue'>Create event</a>");
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
    window.location.href="./create_order.php?date="+date1+"&time="+time1;
    }

    }



	function createEventDateTimeNew(fromDatetime,toDatetime)
    {
var fromDate = new Date(fromDatetime);
	var toDate=new Date(toDatetime);

    if(confirm("Are you sure want to mark yourself BUSY for "+fromDate.toDateString()+" "+fromDate.toLocaleTimeString()+" TO "+toDate.toLocaleTimeString()+"?"))
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
	var phId1='<?php echo $_SESSION['loggedin_id']; ?>';
   window.location.href="./photographerCalendar.php?busy=1&fromDatetime="+fromDatetime+"&toDatetime="+toDatetime+"&Photographer_id="+phId1;
   }
    }

    }
    </script>
		<?php include "footer.php";  ?>
