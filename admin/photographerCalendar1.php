<?php
ob_start();

include "connection1.php";

$photographer_name_is="";
if(@$_REQUEST['Photographer_id']!='')
{
$Photographer_id=@$_REQUEST['Photographer_id'];
$phDetail1=mysqli_query($con,"select * from user_login where id='$Photographer_id'");
$phDetail=mysqli_fetch_array($phDetail1);

$photographer_name_is=$phDetail['first_name']." ".$phDetail['last_name'];
}


if(@$_REQUEST['deleteBusy'])
{
$busyid=$_REQUEST['busyid'];
$ph_id=$_REQUEST['ph_id'];
$pc_admin_id=$_REQUEST['pc_admin_id'];
$ph_name=$_REQUEST['ph_name'];

mysqli_query($con,"delete from `appointments` where id='$busyid'");

header("location:photographerCalendar1.php?ph_id=$ph_id&ph_name=$ph_name&Photographer_id=$ph_id&pc_admin_id=$pc_admin_id");
}


?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>
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

			</div>
                <div class="col-md-10">



			<?php if(@$_REQUEST['Photographer_id']!='') { ?>	<h5 class="text-center"><?php echo $photographer_name_is; ?> - Photographer's Calendar</h5>
			<?php }  else { ?><h5 style="color:#006666;padding-top:20px;" class="text-center">Select a Photographer from the below list to create an Order</h5> <?php } ?>


<table class="table-responsive table-stripped" style="border-color:none!important;width:100%">
<tr>
<td align="center"><form name="" method="post" action="" id="filterForm">
<input type="text" name="ph_name"  id="ph_name" list="phList" onchange="fillPhId();" placeholder="Select a photographer"  autocomplete="off"  class="form-control" style="width:200px;margin-bottom:10px;"/>

 <datalist id="phList">
 	 <option value="" id="label_select_photographer" adr_trans="label_select_photographer">Select a Photographer</option>
       <?php
	   
	   if($_SESSION['admin_loggedin_type']=='PCAdmin')
	   {
	    $photographers="select * from user_login where type_of_user='Photographer' and pc_admin_id='$_SESSION[admin_loggedin_id]' order by first_name";
	   }
	   else
	   {
	   $pc_admin_id=$_REQUEST['pc_admin_id'];
	    $csr_id=$_REQUEST['csr_id'];
	    $photographers="select * from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id' and csr_id='$csr_id' order by first_name";
	   }
	   
	   
	  

         $Photographers_list=mysqli_query($con,$photographers);
         while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
        {?>
                    <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1['first_name']." ".$Photographers_list1['last_name']; ?>"></option>
                  <?php } ?>

                  </datalist>
				  <input type="hidden" name=" Photographer_id" id="ph_id" value="<?php echo @$_REQUEST['ph_id']; ?>" />
				   <input type="hidden" name=" pc_admin_id" id="pc_admin_id" value="<?php echo @$_REQUEST['pc_admin_id']; ?>" />
				  
				  </form></td>
				  <td align="left" style="color:#000080;">&nbsp; <?php //if(@$_REQUEST['ph_name']) { echo strtoupper($_REQUEST['ph_name'])." (Photographer's) Calendar."; } ?></td>
				  <td>



</table>
        <hr class="space s" />
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
      initialView: 'timeGridWeek',
	  contentHeight: 480,
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
      eventSources: [
    '../photographer_events.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>',
   '../photographer_busy.php?photographer_id=<?php echo $_REQUEST['Photographer_id']; ?>'
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

 }
		createEventDateTimeNew(info.startStr,info.endStr);
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
    var ph_id='<?php echo @$_REQUEST['Photographer_id'];?>';
	  var pc_admin_id='<?php echo @$_REQUEST['pc_admin_id'];?>';
   if(confirm("Are you sure want to remove the selected BUSY event of Mr."+ph_name+"?")) {
   // alert(info.event.extendedProps.orderId);
  window.location.href = "photographerCalendar1.php?deleteBusy=1&busyid="+info.event.extendedProps.orderId+"&ph_id="+ph_id+"&ph_name="+ph_name+"&pc_admin_id="+pc_admin_id;
   }
   }
  }
    });

    calendar.render();



	}
	});


  });




function createEventDateTimeNew(fromDatetime,toDatetime)
    {
	var fromDate = new Date(fromDatetime);
	var toDate=new Date(toDatetime);
//alert(dateFormat(date1, "dddd, mmmm dS, yyyy, h:MM:ss TT"));
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

    if(confirm(alertmsg+" "+fromDate.toDateString()+" "+fromDate.toLocaleTimeString()+" TO "+toDate.toLocaleTimeString()+"?"))
    {
	var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
	var pc_admin_id='<?php echo $_REQUEST['pc_admin_id']; ?>';
	
    window.location.href="create_order.php?fromDatetime="+fromDatetime+"&toDatetime="+toDatetime+"&Photographer_id="+phId1+"&pc_admin_id="+pc_admin_id;
    }

    }
</script>

	<div id='calendar'  style="box-shadow:10px 10px 10px 10px #DDD;border:solid 1px #1C83DC;opacity:0.8"></div>

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
