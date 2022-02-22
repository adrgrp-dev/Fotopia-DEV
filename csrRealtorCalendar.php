<?php
ob_start();

include "connection1.php";



?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">

                <div class="col-md-2" style="margin-left:-15px;">
	<?php include "sidebar.php"; ?>


			</div>

				<div class="col-md-10" style="margin-top: -7px;">
<div class="row">
<div class="col-md-12" style="padding-left:20px;height:30px;">
				<div class="col-md-6" style="float:left;display:inline-block">
				<h5> <span class="" adr_trans="label_calendar"> Calendar</span> - <?php echo strtoupper($_SESSION['loggedin_name']); ?>
				<hr class="space s" /></h5></div>
				<div class="col-md-6" style="float:right">
				<!-- <a href="create_order.php" class="anima-button circle-button btn-sm btn" id="label_create_new_order" adr_trans="label_create_new_order" style="float:right;margin-top:-6px;"><i class="fa fa-calendar"></i> Create New Order</a> -->
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

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: "realtor_events.php?realtor_id=<?php echo $_SESSION['loggedin_id']; ?>",
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
      events: response,
	  
	  			 eventDrop: function(info) {
   //alert(info.event.title + " was dropped on " + info.event.start.toISOString());
  if(info.event.extendedProps.status!='1')
		{
		alertmsg="You can only move the appointment which has status 'Created'";
		info.revert();
		}
 if(info.event.extendedProps.status=='1')
		{
   if(info.view.type=="timeGridDay")
	  {
	 
	   var even1=info.event;
	   var order_id1=even1.extendedProps.orderId;
	 var startDay=info.event.startStr;
	 var endDay=info.event.endStr;

	  var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil flytte avtalen";
		}
		else
		{
		alertmsg="Are you sure want to move the appointment";
		}
	if (!confirm(alertmsg+"?")) {
      info.revert();
    }
	else
	{

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	    $("#appointment_msg").show();
    }
  };

  xhttp.open("GET","move_appointment1.php?order_id="+order_id1+"&startDay="+startDay+"&endDay="+endDay,true);
  xhttp.send();
 }

 return;
 }
 }


 var even=info.event;
 var dateMovedTo=info.event.start.toISOString();
 var dateIS=dateMovedTo.split("T");
 //alert(dateIS[0]);

 var todayDate1=new Date().toISOString();
 var todayDate=todayDate1.split("T");

 if(todayDate[0]>dateIS[0])
 {
 alert("Appointment cannot be moved to past date");
  info.revert();

 }
 else if(info.event.extendedProps.status!='1')
		{
		alertmsg="You can only move the appointment which has status 'Created'";
		info.revert();
}
 else
 {
 // alert("future date");
// console.log("***********"+even.extendedProps.orderId+"     "+dateMovedTo);
 var order_id=even.extendedProps.orderId;

  var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil flytte avtalen til";
		}
		else
		{
		alertmsg="Are you sure want to move the appointment to";
		}
  if (!confirm(alertmsg+" "+dateIS[0]+"?")) {
      info.revert();
    }
	else
	{

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	    $("#appointment_msg").show();
    }
  };

  xhttp.open("GET","move_appointment.php?order_id="+order_id+"&date="+dateIS[0],true);
  xhttp.send();
 }


 }



  }, eventResize: function(info) {
   // alert(info.event.title + " end is now " + info.event.end.toISOString());
  // alert(info.event.extendedProps.status);
 if(info.event.extendedProps.status!='1')
		{
		alertmsg="You can only extend the appointment which has status 'Created'";
		info.revert();
}
if(info.event.extendedProps.status=='1')
		{
	  var even1=info.event;
	   var order_id1=even1.extendedProps.orderId;
	 var startDay=info.event.startStr;
	 var endDay=info.event.endStr;
	 var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil forlenge avtalen";
		}
		else
		{
		alertmsg="Are you sure want to move extend the appointment ";
		}
	if (!confirm(alertmsg+"?")) {
      info.revert();
    }
	else
	{

  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	    $("#appointment_msg").show();
    }
  };

  xhttp.open("GET","move_appointment1.php?order_id="+order_id1+"&startDay="+startDay+"&endDay="+endDay,true);
  xhttp.send();
 }

}


  },
	    eventClick: function(info) {
		var even=info.event;
   window.location.href = "order_detail.php?id="+even.extendedProps.orderId;
  }
    });

    calendar.render();



	}
	});


  });

</script>

	<div id='calendar' style="border-radius:5px;"></div>









    </div>
	</div>



	</div>




   <script>


 /*   $( document ).on( "click", "td.fc-day", function() {
    var dateIs=$(this).attr("data-date");
    var createEventis=$(this).find("a#createEvent").text();
    if(createEventis=="Create event")
    {
    }
    else
    {
     // var phId='<?php //echo $_SESSION['loggedin_id']; ?>';
  var FcTop=$(this).find("div.fc-daygrid-day-top");
  var existing=FcTop.html();
  FcTop.html(existing+"<a href='./create_order.php?date="+dateIs+"' class='fc-daygrid-day-number' id='createEvent' style='float:left;padding-right:20px;text-decoration:underline;color:blue'>Create event</a>");
  //console.log(FcTop);
    }
    });
*/


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
    </script>
		<?php include "footer.php";  ?>
