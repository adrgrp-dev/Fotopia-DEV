<?php
ob_start();

include "connection1.php";


$Photographer_id=$_REQUEST['Photographer_id'];
$phDetail1=mysqli_query($con,"select * from user_login where id='$Photographer_id'");
$phDetail=mysqli_fetch_array($phDetail1);

$photographer_name_is=$phDetail['first_name']." ".$phDetail['last_name'];
?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">



				<h5 class="text-center"><?php echo $photographer_name_is; ?> - Photographer's Calendar</h5>



        <hr class="space s" />
				<link href='../lib/main.css' rel='stylesheet' />
				<style>

			#calendar
				{
				background-color:#FFFFFF;
				}

				table td[class*="col-"], table th[class*="col-"]
				{
				background:#EEE;

				}

.gmailEvent
{
color:#337AB7;
padding-left:5px;
}
.td
{
background:#993366!important;
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

.fc .fc-col-header-cell-cushion
{
color:#00012F!important;

}

.fc a[data-navlink]:hover {
text-decoration:none;


}
.fc-day-today
{
background:#8ed0ed!important;
border:solid 1px #01A8F2!important;
}
	
				</style>
				<script src='../lib/main.js'></script>
<script>



$.ajax({
      url: "../Google-Calendar-API-Service.php",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){

	  }
	});


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: "../photographer_events.php?photographer_id=<?php echo $_REQUEST["Photographer_id"]; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'dayGridMonth',
	  contentHeight: 480,
	   fixedWeekCount: false,
      nowIndicator: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
	  displayEventTime:true,// allow "more" link when too many events
      events: response,
	   dateClick: function(info) {
	// console.log("aaaaa");
	 console.log(info);
	 // console.log("bbbbb");
	 // console.log(info.view.type);
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
   //alert(info.event.title + " was dropped on " + info.event.start.toISOString());
    
	if(info.event.extendedProps.status=='BUSY')
	{
	 info.revert();
	}
	
	},
	  eventClick: function(info) {
		var even=info.event;
		even.extendedProps.gmail
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
		alertmsg="Er du sikker på at du vil  lage et arrangement for";
		}
		else
		{
		alertmsg="Are you sure want to create an event for";
		}
    if(confirm(alertmsg+" "+date1+" & "+time1+"?"))
    {
	var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
    window.location.href="./create_order.php?date="+date1+"&time="+time1+"&photographer_id="+phId1;
    }

    }
</script>
		<?php include "footer.php";  ?>
