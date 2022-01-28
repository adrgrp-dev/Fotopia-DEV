<?php
ob_start();

include "connection1.php";



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


				<div>
				<h5 class="text-center" id="label_realtor_calendar" adr_trans="label_realtor_calendar">Sub CSR Calendar<hr class="space s" />
				<a href="create_order.php?val=2" class="anima-button circle-button btn-sm btn adr-save" id="label_create_new_order" adr_trans="label_create_new_order"><i class="fa fa-calendar"></i> Create New Order</a>
				</h5>

				</div>



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
        .fc-day-mon,.fc-day-tue,.fc-day-wed,.fc-day-thu,.fc-day-fri
        {
        background:#DAE7BD!important;
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
				</style>
				<script src='../lib/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: "sub_event.php?sub_csr_id=<?php echo $_SESSION['admin_loggedin_id']; ?>",
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'dayGridMonth',
	  contentHeight: 470,
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
	    eventClick: function(info) {
		var even=info.event;
   window.location.href = "superOrder_detail.php?id="+even.extendedProps.orderId;
  }
    });

    calendar.render();



	}
	});


  });

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
     // var phId='<?php echo $_SESSION['admin_loggedin_id']; ?>';
  var FcTop=$(this).find("div.fc-daygrid-day-top");
  var existing=FcTop.html();
  FcTop.html(existing+"<a href='./create_order.php?date="+dateIs+"' class='fc-daygrid-day-number' id='createEvent' style='float:left;padding-right:20px;text-decoration:underline;color:blue'>Create event</a>");
  //console.log(FcTop);
    }
    });



    // var date1;
    // var time1;
    // function createEventDateTime(date1,time1)
    // {
    //
    // var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
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
    // {
    // window.location.href="./create_order.php?date="+date1+"&time="+time1;
    // }

    }
    </script>
		<?php include "footer.php";  ?>
