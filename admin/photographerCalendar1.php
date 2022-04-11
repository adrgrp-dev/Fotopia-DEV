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
        <div class="" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:10px;">
	<?php include "sidebar.php"; ?>
	<style>
		
	</style>
<script>

function close_modal()
{
$(".mfp-close").click();
}

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
<a class="lightbox btn btn-primary btn-sm circle-button" id="warningMsg" href="#lb2" data-lightbox-anima="show-scale" style="float:right;margin-bottom:10px;display:none;">+Add Product</a>


			<?php if(@$_REQUEST['Photographer_id']!='') { ?>	<h5 class="text-center"><?php echo $photographer_name_is; ?> - Photographer's Calendar</h5>
			<?php }  else { ?><h5 style="color:#006666;padding-top:0px;" class="text-center">Select a Photographer from the below list to create an Order OR bypass to order detail screen</h5> <?php } ?>


<div class="row" style="border-color:none!important;width:100%;background: #FFF!important;
color:#000!important;border-radius:5px;margin-top: 0px;margin-bottom: 10px;margin-left: 2px;">
<div class="col-md-4" style="padding:10px;padding-left:30px;">
<form name="" method="post" action="" id="filterForm">
<input type="text" name="ph_name"  id="ph_name" list="phList" onchange="fillPhId();" placeholder="Select a photographer" value="<?php echo @$_REQUEST['ph_name']; ?>"  autocomplete="off"  class="form-control btn btn-default" style="color: #000;width:250px;margin-bottom:10px;padding: 0px;margin-top:10px;border-radius:25px;height: 30px;font-size: 12px;"/>

 <datalist id="phList" style="">
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
				  <input type="hidden" name="Photographer_id" id="ph_id" value="<?php echo @$_REQUEST['ph_id']; ?>" />
				   <input type="hidden" name="pc_admin_id" id="pc_admin_id" value="<?php echo @$_REQUEST['pc_admin_id']; ?>" />

				  </form></div>
				 <div class="col-md-4" style="padding:10px;font-size:24px;text-align:center;top:10px;font-weight:bolder"><span style="text-shadow: 2px 2px #AAA;">OR</span></div>
				 <div class="col-md-4" style="padding:20px;">
<a href="quick_create_order.php?u=0&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>" class="btn btn-default" style="border-radius:25px;padding: 6px;color:#AAA;height: 30px;font-size: 12px;width:250px;">Skip to Order Detail screen
</a>
</div>
</div>

				<link href='../lib/main.css' rel='stylesheet' />
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

.btn-default
    {
    padding-top:0px!important;
	padding:8px!important;
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
// alert("Appointment cannot be created to past date");
if(confirm("Are you sure want to create an appointment in the Past Date?"))
{
var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
	var pc_admin_id='<?php echo $_REQUEST['pc_admin_id']; ?>';
 window.location.href="create_order.php?u=0&fromDatetime="+info.startStr+"&toDatetime="+info.endStr+"&Photographer_id="+phId1+"&pc_admin_id="+pc_admin_id+"&past=1";
 return true;
 }
else
{
var phId1='<?php echo @$_REQUEST['Photographer_id']; ?>';
var csr_id='<?php echo @$_REQUEST['csr_id']; ?>';
	var pc_admin_id='<?php echo @$_REQUEST['pc_admin_id']; ?>';
window.location.href = "photographerCalendar1.php?pc_admin_id="+pc_admin_id+"&csr_id="+csr_id+"&Photographer_id="+phId1;
return false;
}
//return false;
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
  eventDrop: function(info) {
   //alert(info.event.title + " was dropped on " + info.event.start.toISOString());

	if(info.event.extendedProps.status=='BUSY')
	{
	 info.revert();
	}

	},
   eventClick: function(info) {
		if(info.event.extendedProps.status!='BUSY')
		{
		var even=info.event;
   window.location.href = "superOrder_detail.php?id="+even.extendedProps.orderId;
   }
   
   if(info.event.extendedProps.status=='BUSY' && info.event.extendedProps.gmailEvent!=1)
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
		alertmsg="Er du sikker p� at du vil  lage et arrangement for";
		}
		else
		{
		alertmsg="Are you sure want to create an event for";
		}

    if(confirm(alertmsg+" "+fromDate.toDateString()+" "+fromDate.toLocaleTimeString()+" TO "+toDate.toLocaleTimeString()+"?"))
    {
	var phId1='<?php echo $_REQUEST['Photographer_id']; ?>';
	var pc_admin_id='<?php echo $_REQUEST['pc_admin_id']; ?>';

    window.location.href="create_order.php?u=0&fromDatetime="+fromDatetime+"&toDatetime="+toDatetime+"&Photographer_id="+phId1+"&pc_admin_id="+pc_admin_id+"&past=1";
    }

    }
</script>
<?php if(@$_REQUEST['Photographer_id']!='') { ?>

	<div id='calendar'  style="border-radius:5px"></div>

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
		alertmsg="Er du sikker p� at du vil  lage et arrangement for";
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

<div id="lb2" class="box-lightbox col-md-4" style="padding-left:20px;padding-right:20px;padding-bottom:10px;padding-top:20px;color:#000!important;border-radius:25px;border:none!important;">
                      	   <h5 class="text-center" id="label_warning" adr_trans="label_warning" style="color:orange!important;">Booking Warning!<br /></h5>
					<table class="table table-responsive"><tr><td>

<span style="font-size:12px;margin-bottom:20px;"><br /><br />Are you sure want to create an appointment in the past date?</span>

<p align="center" style="margin-top:40px;"><a href="photographerCalendar1.php" class="btn btn-default anima-button circle-button btn-sm" style="width:90px!important"><i class="fa fa-times-circle"></i><span>&nbsp;No</span>&nbsp;&nbsp;</a>&nbsp;&nbsp;<button type="button" class="btn btn-default anima-button circle-button btn-sm" onclick="close_modal();" style="width:90px;"><i class="fa fa-check-circle"></i><span adr_trans="label_yes">Yes</span></button></p>



</td></tr></table></div>


		<?php include "footer.php";  ?>
