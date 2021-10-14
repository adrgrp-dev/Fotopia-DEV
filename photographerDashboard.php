<?php
ob_start();

include "connection1.php";
$wip_check_query=mysqli_query($con,"select date(session_from_datetime) as date,status_id from orders");
while($get_wip=mysqli_fetch_assoc($wip_check_query))
{
$check=$get_wip['status_id'];
$today=date('Y-m-d');
if(($check == 1) && ($get_wip['date'] == $today))
{
  mysqli_query($con,"UPDATE `orders` SET status_id=2 where date(session_from_datetime)='$today' ");
}
}


?>

<style>

#calendar
{
background-color:#FFFFFF;
}

table td[class*="col-"], table th[class*="col-"]
{
background:#EEE;

}

.gmailEvent0
{
background:#D9534F!important;
color:white!important;
padding-left:5px;
}

.fc-day-mon,.fc-day-tue,.fc-day-wed,.fc-day-thu,.fc-day-fri,
{
background:#FFF!important;
border:solid 1px #000!important;
}
.fc-day-sat,.fc-day-sun
{
background:#EEEEEE!important;
border:solid 1px #000!important;
}
.active
{
background:none!important;
}
.btn-default
{
margin-left:0px!important;
}



.fc-day-today
{
background:#E8F0FE!important;
border:solid 1px #01A8F2!important;
}

h2.fc-toolbar-title
{
display:contents;
color:#FFF	!important;
border:solid 1px #000!important;
padding:10px;
}


.fc .fc-toolbar.fc-header-toolbar
{
background:#FFF;
border-radius:25px 25px 0px 0px;
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
@media only screen and (max-width: 600px) {
  .fc-prev-button, .fc-next-button, .fc-button
{
background:#000!important;
color:#FFF!important;
margin:2px!important;
font-size: 7px!important;
}
.fc .fc-toolbar-title
{
font-size:8px!important;
}
.forMobile
{
height:fit-content!important;
}
#delivered_address
{
  text-align: center;
}
#delivered_image
{

  margin-left: auto;
  margin-right: auto;
  width: 95%;

}

}

</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage9">
        <div class="container" style="margin-left:0px;height:inherit;width:100%;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10 ">
              	<h5 class="text-center" id="label_photographer_dashboard" adr_trans="label_photographer_dashboard">Photographer Dashboard</h5>


<?php if(@isset($_REQUEST["private"])) { ?>

                            <p class="text-danger" align="center"><br />This is private event of photographer, You do not have permission to access.
<br /><br /></p>

						<?php }  ?>


					<div class="col-md-12">
            <div class="row" style="margin-left:5px;">

              <div class="col-md-3">
                     <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#E8F0FE!important;border-radius:35px 35px 35px 35px;opacity:0.7;color:#000000;border:solid 3px #000000;box-shadow:10px 10px 10px #3a3b3c">
                         <i class="fa fa-check icon circle anima" aid="0.8497340629201113" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;border:solid 2px #000000;background:#000!important;color:#0000FF !important;"></i>
               <?php
                $user_id=$_SESSION["loggedin_id"];
                $get_completed_query=mysqli_query($con,"SELECT count(photographer_id) as COUNT FROM `orders` WHERE photographer_id='$user_id' and status_id=3");

                $get_complete=mysqli_fetch_array($get_completed_query);

                ?>

                             <h5 adr_trans="label_completed_orders">Completed orders</h5>
                             <p class="counter" data-speed="1000" data-to="<?php echo $get_complete['COUNT'];?>" style="color:000;font-size:25px;font-weight:600;padding-top:5px;">
       <?php echo $get_complete['COUNT'];?>
                             </p>
                             <a class="anima-button circle-button btn-sm" adr_trans="label_view" href="photographerorder_list.php?c=1" style="background:#0000FF!important;color:#FFF!important;font-weight:700;box-shadow:2px 2px 2px 2px #3a3b3c;"><i class="fa fa-long-arrow-right"></i>View </a>
                         </div>



                         </div>
                       <div class="col-md-3">
                    <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#E8F0FE!important;border-radius:35px 35px 35px 35px;opacity:0.7;color:#000000;border:solid 3px #000000;box-shadow:10px 10px 10px #3a3b3c">
                        <i class="fa fa-calendar icon circle anima" aid="0.8497340629201113" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;border:solid 2px #000000;background:#000!important;color:#FF0000!important;"></i>
							<?php
               // $user_id=$_SESSION["loggedin_id"];
               $get_order_query=mysqli_query($con,"SELECT count(photographer_id) as COUNT FROM `orders` WHERE photographer_id='$user_id' and status_id in(2,4)");
               $get_order=mysqli_fetch_array($get_order_query);

               ?>
                            <h5 adr_trans="label_ongoing">Ongoing Orders</h5>
                            <p class="counter" data-speed="1000" data-to=" <?php echo $get_order['COUNT'];?>" style="color:000;font-size:25px;font-weight:600;padding-top:5px;">
			   <?php echo $get_order['COUNT'];?>
                            </p>
                            <a class="anima-button circle-button btn-sm" adr_trans="label_view" href="photographerorder_list.php?o=1" style="background:#FF0000!important;color:#FFF!important;font-weight:700;box-shadow:2px 2px 2px 2px #3a3b3c;"><i class="fa fa-long-arrow-right"></i>View </a>
                        </div></div>


                        <div class="col-md-3">
                               <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#E8F0FE!important;border-radius:35px 35px 35px 35px;opacity:0.7;color:#000000;border:solid 3px #000000;box-shadow:10px 10px 10px #3a3b3c">
                                   <i class="fa fa-database icon circle anima" aid="0.8497340629201113" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;border:solid 2px #000000;background:#000!important;color:#ffff00!important;"></i>


                                       <h5 adr_trans="label_my_products">My Products</h5>
									   <?php
					 $get_prod_query1=mysqli_query($con,"SELECT count(*) as prodCount FROM `photographer_product_cost` WHERE photographer_id='$user_id'");
               $get_prod_query=mysqli_fetch_array($get_prod_query1);

									   ?>
                                        <p class="counter" data-speed="1000" data-to=" <?php echo $get_prod_query['prodCount'];?>" style="color:000;font-size:25px;font-weight:600;padding-top:5px;">

                                       </p>

                                       <a class="anima-button circle-button btn-sm" adr_trans="label_view" href="products.php" style="background:#ffff00!important;color:#7c6f6f!important;font-weight:700;box-shadow:2px 2px 2px 2px #3a3b3c;"><i class="fa fa-long-arrow-right" style="color:#7c6f6f!important;"></i>View </a>
                                   </div>



                                   </div>

					 <div class="col-md-3">
                    <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#E8F0FE!important;border-radius:35px 35px 35px 35px;opacity:0.7;color:#000000;border:solid 3px #000000;box-shadow:10px 10px 10px #3a3b3c">
                        <i class="fa fa-money icon circle anima" aid="0.8497340629201113" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;border:solid 2px #000000;background:#000!important;color:#118C4F!important;"></i>
                            <h5 adr_trans="label_my_earnings">My Earnings</h5>
                            <?php
                            $total1=0;
                            @$get_invoiced_name_query=mysqli_query($con,"SELECT id,product_id FROM orders where status_id =3 and photographer_id=$user_id");
                            if(@$get_name=mysqli_fetch_assoc(@$get_invoiced_name_query))
                            {
                              @$Photographer_id=@$_SESSION['loggedin_id'];
                              @$id=@$get_name['id'];
                              //echo "SELECT sum(photography_cost) as total_value FROM `photographer_product_cost` where photographer_id=$Photographer_id";
                              @$get_product_query=mysqli_query($con,"SELECT sum(photography_cost) as total_value FROM `photographer_product_cost` where photographer_id=$Photographer_id");
                              @$get_product=mysqli_fetch_assoc(@$get_product_query);
                              @$total1+=@$get_product['total_value'];

                            }
                            ?>
                             <p style="color:000;font-size:25px;font-weight:600;"> $ &nbsp;<label class="counter" data-speed="1000" data-to="<?php echo $total1;?>" style="color:000;font-size:25px;font-weight:600"><?php echo $total1;?></label><br /></p>
                          <a class="anima-button circle-button btn-sm" adr_trans="label_view" href="photographerorder_list.php?c=1" style="background:#118C4F!important;color:#FFF!important;font-weight:700;box-shadow:2px 2px 2px 2px #3a3b3c;"><i class="fa fa-long-arrow-right"></i>View </a>
                        </div>


						</div>











</div>


          </div>
          <hr class="space s" />



        <!--  calender starts -->
       <link href='lib/main.css' rel='stylesheet' />
       <style>

       #calendar
       {
       background-color:#FFFFFF;
       }

       table td[class*="col-"], table th[class*="col-"]
       {
       background:#EEE;

       }

   .gmailEvent0
   {
   background:#D9534F!important;
   color:white!important;
   padding-left:5px;
   }
       </style>
       <script src='lib/main.js'></script>
   <script>



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
     initialView: 'timeGridDay',
   contentHeight: 270,
    fixedWeekCount: false,
     nowIndicator: true,
     headerToolbar: {
        left: 'today',
        center: 'prev,title,next',
        right: 'timeGridWeek,timeGridDay'
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
// alert('Clicked on: ' + info.dateStr);
// alert('Current view: ' + info.event.timeText)

},
   eventClick: function(info) {
   var even=info.event;
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
var phId1='<?php echo $_SESSION['loggedin_id']; ?>';
window.location.href="./create_order.php?date="+date1+"&time="+time1;
}

}
   </script>
     <!--  calender end --><br />
    <div class="col-md-6" style="">
        <center>    <h5 adr_trans="label_upcoming_events">Upcoming Events</h5></center>
 <div id='calendar' style="opacity:0.8;border-radius:25px;box-shadow:10px 10px 10px 10px #DDD;"></div>
    <br>

 <center> <a href="./photographerCalendar.php" class="anima-button circle-button btn-sm btn" adr_trans="label_view_my_calender"><i class="fa fa-calendar"></i>View My Calender</a>  </center>
  </div>
  <div class="col-md-6">
              <center>    <h5 adr_trans="label_latest_delivered">Latest Delivered Orders</h5></center>
<div class=" advs-box boxed-inverse forMobile"  style="background:#E8F0FE!important;border-radius:25px;box-shadow:10px 10px 10px 10px #DDD;opacity:0.8;height: 305px;">

   <?php

      $get_latest_delivered_query=mysqli_query($con,"SELECT * FROM `img_upload` where finished_images=1 and order_id in(select id from orders where photographer_id=$_SESSION[loggedin_id]) order by rand() limit 4");
      while($get_latest_delivered=mysqli_fetch_array($get_latest_delivered_query))
      {
	    $orderIDIs=$get_latest_delivered['order_id'];
		$get_address1=mysqli_query($con,"SELECT * FROM orders where id='$orderIDIs'");
		$get_address=mysqli_fetch_array($get_address1);
        ?>

        <div class="col-md-6">
          <a href="photographerorder_detail.php?id=<?php echo $get_latest_delivered['order_id']; ?>&f=1">
        <img id="delivered_image" src="./finished_images/order_<?php echo $get_latest_delivered['order_id']; ?>/<?php if($get_latest_delivered['service_id']==1){ echo "standard_photos" ;}elseif($get_latest_delivered['service_id']==2){ echo "floor_plans";}elseif($get_latest_delivered['service_id']==3){echo "Drone_photos";}else{ echo "Hdr_photos";}?>/<?php echo $get_latest_delivered['img']?>" width="230" height="140" style="padding-bottom:15px;"/>
		 <span id="delivered_address" style="position:absolute; text-align:center;z-index:2;color:#000;background:#E8F0FE!important;padding:3px;opacity:0.5;width:100%;float:left;left:0px;"><?php echo $get_address['property_address']; ?></span>
        </a>
        </div>
  <?php		}
    ?>

  </div></div>
<p align="center">

 <a class="anima-button circle-button btn-sm" href="photographerorder_list.php?c=1" style="margin-top:20px;" adr_trans="label_view_order"><i class="fa fa-long-arrow-right"></i>View My Orders</a>
</p>

            </div>


    </div>
        </div>


		<?php include "footer.php";  ?>
