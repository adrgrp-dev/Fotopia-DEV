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
background: #FFF!important;
color:#000!important;
border:solid 1px #01A8F2!important;
}

h2.fc-toolbar-title
{
display:contents;
color:#000	!important;
border:solid 1px #000!important;
padding:10px;
}


.fc .fc-toolbar.fc-header-toolbar
{
background:#FFF;
border-radius:5px;
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
@media only screen and (max-width: 600px) {
  .fc-prev-button, .fc-next-button, .fc-button
{
/*background:#000!important;
color:#FFF!important;*/
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
 <div class="section-empty ">
        <div class="" style="margin-left:0px;height:inherit;width:100%;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:15px;">
				
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10" style="padiding-left:20px;">
              	<!-- <h5 class="text-center" id="label_photographer_dashboard" adr_trans="label_photographer_dashboard">Photographer Dashboard</h5> -->

<?php if(@isset($_REQUEST["na"])) { ?>

                            <p class="text-error" align="center" style="font-style:italic;color:red"><br />You are not Authorized to view the details of the requested Order.<br /></p>

						<?php }  ?>

<?php if(@isset($_REQUEST["private"])) { ?>

                            <p class="text-danger" align="center"><br />This is private event of photographer, You do not have permission to access.
<br /><br /></p>

						<?php }  ?>


					<div class="col-md-12">
            <div class="row" style="margin-left:5px;">
<hr class="space s">
              <div class="col-md-3">
                     <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">
                        
               <?php
                $user_id=$_SESSION["loggedin_id"];
                $get_completed_query=mysqli_query($con,"SELECT count(photographer_id) as COUNT FROM `orders` WHERE photographer_id='$user_id' and status_id=3");

                $get_complete=mysqli_fetch_array($get_completed_query);

                ?>

                             <h5><i class="fa fa-check-circle fa-lg" style="color:#aad1d6;"></i><br /><br /><span adr_trans="label_completed_orders">Completed orders</span></h5>
                             <p class="counter" data-speed="1000" data-to="<?php echo $get_complete['COUNT'];?>" style="color:000;font-size:25px;font-weight:600;padding-top:5px;">
       <?php echo $get_complete['COUNT'];?>
                             </p>
							 <br />
                           <a class="btn-sm" adr_trans="label_view" href="photographerorder_list.php" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>
                         </div>



                         </div>
                       <div class="col-md-3">
                    <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">
							<?php
               // $user_id=$_SESSION["loggedin_id"];
               $get_order_query=mysqli_query($con,"SELECT count(photographer_id) as COUNT FROM `orders` WHERE photographer_id='$user_id' and status_id in(2,4,8)");
               $get_order=mysqli_fetch_array($get_order_query);

               ?>
			    <h5><i class="fa fa-arrow-circle-right fa-lg" style="color:#aad1d6"></i><br /><br /><span adr_trans="label_ongoing">Ongoing orders</span></h5>
                            
                            <p class="counter" data-speed="1000" data-to=" <?php echo $get_order['COUNT'];?>" style="color:000;font-size:25px;font-weight:600;padding-top:5px;">
			   <?php echo $get_order['COUNT'];?>
                            </p>
							<br />
							  <a class="btn-sm" adr_trans="label_view" href="photographerorder_list.php" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>
							
                           
                        </div></div>


                        <div class="col-md-3">
                                <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

<h5><i class="fa fa-camera fa-lg" style="color:#aad1d6"></i><br /><br /><span adr_trans="label_my_products">My Products</span></h5>
                                      
									   <?php
					 $get_prod_query1=mysqli_query($con,"SELECT count(*) as prodCount FROM `photographer_product_cost` WHERE photographer_id='$user_id'");
               $get_prod_query=mysqli_fetch_array($get_prod_query1);

									   ?>
                                        <p class="counter" data-speed="1000" data-to=" <?php echo $get_prod_query['prodCount'];?>" style="color:000;font-size:25px;font-weight:600;padding-top: 3px;padding-bottom: 1px;">

                                       </p>
<br />
                                       <a class="btn-sm" adr_trans="label_view" href="products.php" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>
                                   </div>



                                   </div>

					 <div class="col-md-3">

                    <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">
					
					<h5><i class="fa fa-sliders fa-lg" style="color:#aad1d6"></i><br /><br /><span adr_trans="label_my_earnings_month">My Commissions this month</span></h5>
                            

                            <?php
                            $total1=0;
                            @$get_invoiced_name_query=mysqli_query($con,"SELECT id FROM orders where month(session_from_datetime)=month(now()) and status_id=3 and photographer_id=$user_id");
                            while(@$get_name=mysqli_fetch_assoc(@$get_invoiced_name_query))
                            {
                              @$id=@$get_name['id'];
                            
                              $prodsList=mysqli_query($con,"select group_concat(product_id) as product_id from order_products WHERE order_id='$id'");
                              $prodsList1=mysqli_fetch_array($prodsList);
                              $product_id_is=$prodsList1['product_id'];

                              @$get_product_query=mysqli_query($con,"SELECT sum(photography_cost) as total_value FROM `photographer_product_cost` where product_id in ($product_id_is)");
                              @$get_product=mysqli_fetch_assoc(@$get_product_query);
                              @$total1+=@$get_product['total_value'];

                            }
                            ?>

                             <p style="color:000;font-size:25px;font-weight:600;"> $ &nbsp;<label class="counter" data-speed="1000" data-to="<?php echo $total1;?>" style="color:000;font-size:25px;font-weight:600"><?php echo $total1;?></label><br /></p>
							 <hr class="space s">
							  <a class="btn-sm" adr_trans="label_view" href="photographerorder_list.php" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>
                         
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
     <!--  calender end -->
    <div class="col-md-6" style="">
        <center>    <h5 adr_trans="label_upcoming_events">Upcoming Events</h5></center>
 <div id='calendar' style="border-radius:5px"></div>
    <br>

 <center> <a href="./photographerCalendar.php" class="anima-button circle-button btn-sm btn adr-save" adr_trans="label_view_my_calender" style="background:#aad1d6;color:#000;border-radius:5px;border:none;height: 30px;font-size: 12px;"><i class="fa fa-calendar"></i>View My Calender</a>  </center>
  </div>
  <div class="col-md-6">
              <center>    <h5 adr_trans="label_latest_delivered">Latest Delivered Orders</h5></center>
<div class=" advs-box boxed-inverse forMobile"  style="background:#FFF!important;border-radius:10px;height:305px;">

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
		 <span id="delivered_address" style="position:absolute; text-align:center;z-index:2;color:#000;background:#FFF!important;padding:3px;opacity:0.6;width:100%;float:left;left:0px;font-size:12px;font-weight:bold"><?php echo $get_address['property_address']; ?></span>
        </a>
        </div>
  <?php		}
    ?>

  </div></div>
<p align="center">
<br /><br />
 <a class="anima-button circle-button btn-sm adr-save" href="photographerorder_list.php?c=1" style="margin-top:20px!important;background:#aad1d6;color:#000;border-radius:8px;border:none;height: 30px;font-size: 12px;" adr_trans="label_view_order"><i class="fa fa-long-arrow-right"></i>View My Orders</a>
</p>

            </div>


    </div>
        </div>


		<?php include "footer.php";  ?>
