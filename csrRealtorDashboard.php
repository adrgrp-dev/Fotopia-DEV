<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION['loggedin_id'];

?>
<style>

@media only screen and (max-width: 800px) {



	#flip-scroll table { display: block; position: relative; width: 100%; }
	#flip-scroll thead { display: block; float: left; }
	#flip-scroll tbody { display: block; width: auto; position: relative; overflow-x: auto; white-space: nowrap; }
	#flip-scroll thead tr { display: block; }
	#flip-scroll th { display: block; text-align: left; }
	#flip-scroll tbody tr { display: inline-block; vertical-align: top; }
	#flip-scroll td { display: block; min-height: 1.25em; text-align: left; }


	/* sort out borders */

	#flip-scroll th { border-bottom: 0; border-left: 0;padding:5px; }
	#flip-scroll td { border-left: 0; border-right: 0; border-bottom: 0;padding:5px; }
	#flip-scroll tbody tr { border-left: 1px solid #babcbf; }
	#flip-scroll th:last-child,
	#flip-scroll td:last-child { border-bottom: 1px solid #babcbf; }
}



.mobileLinks
{
width:75px!important;
display:inline-block!important;
color:#000000!important;
font-weight:600!important;
}

.mobileLinks a
{
color:#000000!important;
font-weight:600!important;
}
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
color:#000!important;
border:solid 1px #000!important;
padding:10px;
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
.fc .fc-toolbar.fc-header-toolbar
{
background:#FFF;
border-radius:25px 25px 0px 0px;
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
.fc .fc-toolbar-title
{
font-size:11px!important;
}
#label_view12 i
{
    color: #7c6f6f!important;
	}

	@media only screen and (max-width: 600px) {
	  .fc-prev-button, .fc-next-button, .fc-button
	{
	background:#aad1d6!important;
	color:#000!important;
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
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .active
	{
	opacity:1!important;
	
	}
	.tab-box .nav-tabs li.active
	{
	padding:0px!important;
	line-height:inherit!important;
	}
	.nav-tabs > li > a 
	{
	line-height:inherit!important;
	}
	.nav-tabs > li.active > a
	{
		padding: 5px !important;
	}
</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage9">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:-15px;">
	<?php include "sidebar.php"; ?>
 
		<script>
		var id=null;
		var title=null;
		function GetDetails(id,title)
		{
		 var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){

	 $("#resultDiv").html(this.responseText)


    }
  };
  xhttp.open("GET","Get_Details.php?id="+id,true);
  xhttp.send();
		}





		var id1=null;
		var org=null;
		function GetCompanyDetails(id1,org)
		{
		$("#companyName").html(org);
		 var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	 $("#resultDiv1").html(this.responseText);

    }
  };
  xhttp.open("GET","Get_Company_Details.php?id="+id1,true);
  xhttp.send();
		}

	var id_to_show_hide;
	function show(id_to_show_hide)
	{
	$("#show"+id_to_show_hide).show();

	}
	function hide(id_to_show_hide)
	{
	$("#show"+id_to_show_hide).hide();

	}

var tog="";
function togglePH(tog)
{
if(tog=='photographers')
{
$("#photo_company").hide();
$("#photographers").show();
}
else
{
$("#photographers").hide();
$("#photo_company").show();
}

}
		</script>
		<style>
		.btn-default
{
margin-left:0px!important;
}
		</style>
			</div>

<?php 
 if (@$_REQUEST['second']) {

$realtor_id=$_SESSION['loggedin_id'];
   $realtor_profile1=mysqli_query($con,"select * from realtor_profile where realtor_id='$realtor_id'");
   $realtor_profile=mysqli_fetch_array($realtor_profile1);
   $realtor_employer_id=$realtor_profile['realtor_employer_id'];
   $organization_name=$realtor_profile['organization_name'];
   if(($realtor_employer_id=='' && !@$_REQUEST['first']) || ($organization_name=='' && !@$_REQUEST['first']))
   { 

?>
<input type="button" class="btn adr-save btn-sm" id="warningMsg" onclick="document.getElementById('myModal').style='display:block;padding-top:120px;background:rgba(94,94,94,0.7)'" style="display:none" />

<div id="myModal" class="modal" align="center" style="">
<div class="modal-content" align="center" style="width:26%!important;height:40%!important;border-radius:12px">
 <hr class="space xs">
<h5 class="text-center" id="label_warning" adr_trans="label_warning" style="color:orange!important;">Warning!<br /></h5>
          <table class="table table-responsive"><tr><td>


<hr class="space s">
<center>
<h5>Finish your registration in order to show up as a validated user.</h5></center>
<hr class="space m">
<p align="center"><a href="edit_realtor_profile.php?first=1" class="btn anima-button btn-sm adr-save"><i class="fa fa-check-circle"></i><span adr_trans="">Proceed</span></a>&nbsp;&nbsp;<a href="csrRealtorDashboard.php" class="btn anima-button btn-sm adr-cancel"><i class="fa fa-check-circle"></i><span adr_trans="">Skip for now</span></a></p>

</td></tr></table>
</div>
</div>

<?php }} ?>			
                <div class="col-md-10" >




				<div class="col-md-10" >




          <div class="col-md-12" style="margin-top: 3px;">



		  	<h5 class="text-center" id="label_realtor_dashboard" adr_trans="label_realtor_dashboard" style="display:none">CSR / Realtor Dashboard</h5>
<?php if(@isset($_REQUEST["na"])) { ?>

                            <p class="text-error" align="center" style="font-style:italic;color:red"><br />You are not Authorized to view the details of the requested Order.<br /></p>

						<?php }  ?>

<?php if(@isset($_REQUEST["wl"])) { ?>

                            <p class="text-success" align="center" ><br />Added to favorites successfully<br /></p>

						<?php }  ?>

						<?php if(@isset($_REQUEST["rwl"])) { ?>

                            <p class="text-success" align="center"><br />Removed from wishlist successfully<br /><br /></p>

						<?php }  ?>

						<?php if(@isset($_REQUEST["private"])) { ?>

                            <p class="text-danger" align="center"><br />This is private event of photographer, You do not have permission to access.
<br /><br /></p>

						<?php }  ?>


            <div class="row" style="padding-left:30px;">

<hr class="space s" />
<div class="col-md-12">

                       <div class="col-md-4">
                     <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">
                        

                            <?php
                              $get_complete_query=mysqli_query($con,"SELECT count(id) as total1 FROM orders where status_id=3 and realtor_id='$loggedin_id'");
                              $get_complete=mysqli_fetch_assoc($get_complete_query);
                              ?>
                            <h5><i class="fa fa-check-circle fa-lg" style="color:#aad1d6;"></i><br /><br /><span adr_trans="label_completed_orders">Completed Orders</span></h5>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_complete['total1'];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;color:#000">

      <?php echo $get_complete['total1'];?>
                            </p>
							<br />
							 <a class="btn-sm" adr_trans="label_view" href="order_list.php?c=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>
							
                        </div></div>

                        <div class="col-md-4">
         <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">
                          <?php
                            $get_ongoing_query=mysqli_query($con,"SELECT count(id) as total FROM orders where status_id<>3 and realtor_id='$loggedin_id'");
                            $get_ongoing=mysqli_fetch_assoc($get_ongoing_query);
                            ?>


                                        <h5><i class="fa fa-arrow-circle-right fa-lg" style="color:#aad1d6"></i><br /><br /><span adr_trans="label_ongoing_orders">OnGoing Orders</span></h5>
                                        <p class="counter" data-speed="1000" data-to="<?php echo $get_ongoing['total'];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;color:#000">

                      <?php echo $get_ongoing['total'];?>
                                        </p>

                                        <br />
                                        <a class="btn-sm" adr_trans="label_view" href="order_list.php?O=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>

                                        
                                    </div></div>

                       <div class="col-md-4">
                    <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

                                        <?php

              $get_order_query=mysqli_query($con,"SELECT count(*) as dueToday FROM orders where realtor_id='$loggedin_id' and order_due_date=current_date() ");
                                          $get_order=mysqli_fetch_assoc($get_order_query);
                                          ?>

                                        <h5><i class="fa fa-clock-o circle-right fa-lg" style="color:#aad1d6"></i><br /><br /><span adr_trans="label_due_today">Due Today</span></h5>
                                        <p style="color:white;font-size:25px;font-weight:600;padding-top: 5px;padding-bottom:18px;">  &nbsp;<label class="counter" data-speed="1000" data-to="<?php echo $get_order['dueToday'];?>" style="color:white;font-size:25px;font-weight:600;color:#000;"><?php echo $get_order['dueToday'];?></label></p>

                                        
                                        <a class="btn-sm" adr_trans="label_view" href="order_list.php?due=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>

                                         
                                    </div>
</div>


            </div>


</div>













          </div>




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
                initialView: 'timeGridDay',
          	  contentHeight: 270,
          	   fixedWeekCount: false,
                nowIndicator: true,
                 headerToolbar: {
        left: 'today',
        center: 'prev,title,next',
        right: 'timeGridWeek,timeGridDay'
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

	// createEventDateTime(dateArray[0],timeIs[0]);
	  }
          //  alert('Clicked on: ' + info.dateStr);
           // alert('Current view: ' + info.event.timeText)

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
          <hr class="space s">

            <div class="col-md-6" style="">
			<br />
              <center>    <h5 adr_trans="label_upcoming_events">Upcoming Events</h5></center>
              	<div id='calendar' style="opacity:0.8;border-radius:5px;"></div>
                <hr class="space s">

                <center>  <a href="./csrRealtorCalendar.php" class="anima-button circle-button btn-sm btn adr-save" style="height:30px;" adr_trans="label_view_my_calender"><i class="fa fa-calendar"></i> View My Calender</a>    </center>

            </div>
						<div class="col-md-6">
						 <br />
              <center>    <h5 adr_trans="label_latest_delivered">Latest Delivered Orders</h5></center>
	 <div class=" advs-box boxed-inverse forMobile"  style="background:#FFF!important;border-radius:10px;opacity:0.8;height: 305px;">

					   <?php

					      $get_latest_delivered_query=mysqli_query($con,"SELECT * FROM `img_upload` where finished_images=1 and order_id in(select id from orders where created_by_id=$_SESSION[loggedin_id] and created_by_type='Realtor') order by rand() limit 4");
					      while($get_latest_delivered=mysqli_fetch_array($get_latest_delivered_query))
					      {

						  $orderIDIs=$get_latest_delivered['order_id'];
						  $get_address1=mysqli_query($con,"SELECT * FROM orders where id='$orderIDIs'");
						  $get_address=mysqli_fetch_array($get_address1);
					        ?>

					        <div class="col-md-6 " style="">
					          <a href="order_detail.php?id=<?php echo $get_latest_delivered['order_id']; ?>&f=1">
					        <img id="delivered_image" src="./finished_images/order_<?php echo $get_latest_delivered['order_id']; ?>/<?php if($get_latest_delivered['service_id']==1){ echo "standard_photos" ;}elseif($get_latest_delivered['service_id']==2){ echo "floor_plans";}elseif($get_latest_delivered['service_id']==3){echo "Drone_photos";}else{ echo "Hdr_photos";}?>/<?php echo $get_latest_delivered['img']?>" width="230" height="120" style="margin-bottom: 10px;"/>
					     <span id="delivered_address" style="position:absolute; text-align:center;z-index:2;color:#000;background:#FFF!important;padding:3px;opacity:0.6;width:93%;float:left;left:-1px;font-weight:bold;font-size:12px;"><?php echo $get_address['property_address']; ?></span>
						    </a>




					        </div>
					  <?php		}
					    ?>

					  </div></div>
					  <p align="center">

 <a class="anima-button circle-button btn-sm adr-save" href="order_list.php" style="margin-top:20px;height: 30px;" adr_trans="label_view_order"><i class="fa fa-long-arrow-right"></i>View My Orders </a>

</p>

            </div>




				<div class="col-md-2" style="height:inherit;overflow:scroll;height:600px;overflow-x: hidden;margin-top: 3px;">


	<!-- <input type="radio" name="toglePH"  value="photographers" checked="checked" onchange="togglePH(this.value)" />&nbsp;<span style="color:#000!important;">Photographers<br /></span>
	<input type="radio"  name="toglePH"  value="photo_company"  onchange="togglePH(this.value)"/>&nbsp;<span style="color:#000!important;">Photo Companies</span>
     -->

				<div id="photographers" style="display:none">

				<h5 class="text-left" style="margin-left:20px;display:none" id="label_photographers" adr_trans="label_photographers">Photographers</h5>
				<p style="padding-left:3px;">
				<form name="searchByLocation" method="post" action="" style="margin-left:5px;">

				 <input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="<?php echo @$_REQUEST['location']; ?>" style="display:inline;width:115px;font-size:12px;"  placeholder="Choose city" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>
</form>
<datalist id="Suggestions">
 <?php
							$city1=mysqli_query($con,"select cities from norway_states_cities");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>"><?php echo $city['cities']; ?></option>
							<?php } ?>
</datalist>
				</p>

				<?php
				$whereIs="";
				if(@$_REQUEST['location'])
				{
				$searchByLocation=$_REQUEST['location'];
				$whereIs=" and location like '%$searchByLocation%'";
				}

				$photo=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and pc_admin_id=0 and csr_id=0 $whereIs and id in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc");
				while($photo1=mysqli_fetch_array($photo))
				{

				?>
				<table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive" style="box-shadow:5px 5px 5px #DDD;background:#000;color:#FFF;font-weight:600;opacity:0.8;width:145px;border-radius:25px 25px 25px 25px;width:100%">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:25px;border:none">
				 <?php
                if ($ph=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and super_csr_id=0 and sub_csr_id=0 $whereIs and id in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc")) {

                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">

         <i class="fa fa-heart close" style="position:absolute;bottom:45px;right:1px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Remove from wishlist" onClick="removeFromWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
				<img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>

				   <?php
                }
               ?>

				<p align="center" style="padding-top:3px;width:75px!important;word-break:break-all;font-size: 13px;"><?php echo strtoupper(substr($photo1['first_name'],0,10)); ?>
          <br />

<?php
$phidIs=$photo1['id'];
//echo "select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
$rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id,photographer_id having photographer_id='$phidIs'");
$ratingIs=0;
if($rating1=mysqli_fetch_array($rating))
{
$ratingIs= $rating1['avgRating'];
}



for($i=1;$i<=5;$i++)
{
if($i<=$ratingIs)
{
?>
<i class="fa fa-star" style="padding:1px;font-size:10px;color:#337AB7;"></i>
<?php } else { ?>
<i class="fa fa-star-o" style="padding:1px;color:#337AB7;font-size:10px;"></i>
<?php } } ?>
       </p><br />
<?php echo $knowMore; ?>

				</td>
				</tr>

				<tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;" id="show<?php echo $photo1['id']; ?>">
				<td>

				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onclick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onclick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
        	<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


				</td></tr>


				</table>


<table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive " style="box-shadow:5px 5px 5px #DDD;background:#000;color:#FFF;font-weight:600;opacity:0.8;width:145px;border-radius:25px 25px 25px 25px;width:100%;">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:25px;border:none">


         <?php
                if ($ph=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and super_csr_id=0 and sub_csr_id=0 and email_verified=1 $whereIs and id in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc")) {

                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">


        <img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>
         <i class="fa fa-heart close" style="position:absolute;bottom:45px;right:1px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Remove from wishlist" onClick="removeFromWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
           <?php
                }
               ?>

       <p align="center" style="padding-top:3px;width:75px!important;word-break:break-all;font-size: 13px;"><?php echo strtoupper(substr($photo1['first_name'],0,10)); ?>
          <br />

<?php
$phidIs=$photo1['id'];
//echo "select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
$rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id,photographer_id having photographer_id='$phidIs'");
$ratingIs=0;
if($rating1=mysqli_fetch_array($rating))
{
$ratingIs= $rating1['avgRating'];
}



for($i=1;$i<=5;$i++)
{
if($i<=$ratingIs)
{
?>
<i class="fa fa-star" style="padding:1px;font-size:10px;color:#337AB7;"></i>
<?php } else { ?>
<i class="fa fa-star-o" style="padding:1px;color:#337AB7;font-size:10px;"></i>
<?php } } ?>
      </p><br />
<?php echo $knowMore; ?>

        </td>
        </tr>

        <tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;" id="show<?php echo $photo1['id']; ?>">
        <td>

        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onclick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onclick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
          <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


        </td></tr>


        </table>
        
					<?php } ?>

<?php
        $photo=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and pc_admin_id=0 and csr_id=0 and email_verified=1 $whereIs and id not in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc");
        while($photo1=mysqli_fetch_array($photo))
        {

        ?>
      <table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive" style="box-shadow:5px 5px 5px #DDD;background:#000;color:#FFF;font-weight:600;opacity:0.8;width:145px;border-radius:25px 25px 25px 25px;width:100%">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:25px;border:none">
<center>

       <div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;float:right;">
				 <i class="fa fa-heart-o close" style="position:absolute;bottom:45px;right:0px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Add to wishlist"  onClick="addToWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
				<img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>

        <p align="center" style="padding-top:3px;width:75px!important;word-break:break-all;font-size: 13px;"><?php echo strtoupper(substr($photo1['first_name'],0,10)); ?>
           <br />

 <?php
 $phidIs=$photo1['id'];
 //echo "select avg(rating) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
 $rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id,photographer_id having photographer_id='$phidIs'");
 $ratingIs=0;
 if($rating1=mysqli_fetch_array($rating))
 {
 $ratingIs= $rating1['avgRating'];
 }

 for($i=1;$i<=5;$i++)
 {
 if($i<=$ratingIs)
 {
 ?>
 <i class="fa fa-star" style="padding:1px;font-size:10px;color:#337AB7;"></i>
 <?php } else { ?>
 <i class="fa fa-star-o" style="padding:1px;color:#337AB7;font-size:10px;"></i>
 <?php } } ?>
         </p>
       </div>
         </center>

        </td>
        </tr>

        <tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;color:#333333" id="show<?php echo $photo1['id']; ?>">
        <td style="padding-left:10px;">

        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onclick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onclick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
          <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


        </td>
      </tr>


        </table>





        <table cellspacing="0" border="0" cellpadding="0" class="table hidden-md hidden-lg hidden-xl" style="box-shadow:5px 5px 5px #DDD;width:max-content;margin-left:5px;background:#000;color:#FFF;opacity:0.8;width:100%;border-radius:25px 25px 25px 25px;"  onmouseover="show(<?php echo $photo1['id']; ?>)"  onmouseout="hide(<?php echo $photo1['id']; ?>)">
        <tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">
<center>

       <div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;float:right;">
        <i class="fa fa-heart-o close" style="position:absolute;bottom:45px;right:0px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Add to wishlist"  onClick="addToWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
        <img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>

         <p align="center" style="padding-top:3px;width:75px!important;word-break:break-all;font-size: 13px;"><?php echo strtoupper(substr($photo1['first_name'],0,10)); ?>
           <br />

 <?php
 $phidIs=$photo1['id'];
 //echo "select avg(rating) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
 $rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id,photographer_id having photographer_id='$phidIs'");
 $ratingIs=0;
 if($rating1=mysqli_fetch_array($rating))
 {
 $ratingIs= $rating1['avgRating'];
 }

 for($i=1;$i<=5;$i++)
 {
 if($i<=$ratingIs)
 {
 ?>
 <i class="fa fa-star" style="padding:1px;font-size:10px;color:#337AB7;"></i>
 <?php } else { ?>
 <i class="fa fa-star-o" style="padding:1px;color:#337AB7;font-size:10px;"></i>
 <?php } } ?>
         </p>
         </div>
         </center>

        </td>

        </tr>

        <tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;color:#333333" id="show<?php echo $photo1['id']; ?>">
        <td style="padding-left:10px;">

        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onclick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onclick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
          <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onclick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


        </td>
      </tr>


        </table>







          <?php } ?>

</div>






<div id="photo_company" style="display:block">


<h5 class="text-left" style="margin-left:20px;display:none"  adr_trans="label_photo_companies">Photo Companies</h5>
				<?php /* <p style="padding-left:3px;">
				<form name="searchByLocation" method="post" action="./csrRealtorDashboard1.php" style="margin-left:5px;">

				 <input type="text" list="Suggestions1" multiple="multiple" class="form-control form-value" name="company" value="" style="display:inline;width:115px;font-size:12px;"  placeholder="Choose city" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>
</form>
<datalist id="Suggestions1">
 <?php
							$city1=mysqli_query($con,"select distinct(organization) from admin_users where organization!='Fotopia'");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['organization']; ?>"><?php echo $city['organization']; ?></option>
							<?php } ?>
</datalist>
				</p><?php */ ?>
<p align="center" style="font-weight:600;color:#000" adr_trans="label_photo_companies">Photo Companies</p>
<form name="searchByLocation" method="post" action="./csrRealtorDashboard.php" style="margin-left:5px;">

				 <input type="text"  class="form-control form-value" name="companySearch" value="<?php echo @$_REQUEST['companySearch']; ?>" style="display:inline;font-size:12px;height: 30px;"  placeholder="Search " list="cities" onchange="this.form.submit()" />
<datalist id="cities">
 <?php
							$city1=mysqli_query($con,"select cities from norway_states_cities");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>"><?php echo $city['cities']; ?></option>
							<?php } ?>
</datalist>
				 </form>

				<?php


$where="";
$knowMore="";

if(isset($_REQUEST['companySearch']))
{
$companySearch=$_REQUEST['companySearch'];
$where="(location like '%$companySearch%' or organization_name like '%$companySearch%' or organization_branch like '%$companySearch%') and ";
}
				$photo=mysqli_query($con,"select * from photo_company_profile where $where pc_admin_id in(select super_csr_id from wishlist where realtor_id = '$loggedin_id') and pc_admin_id not in (select id from admin_users where is_approved<>1) order by id desc");
				while($photo1=mysqli_fetch_array($photo))
				{

				?><center>
				<table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive" style="background:#FFF;color:#000;font-weight:600;opacity:0.8;width:100%;border-radius:10px;width:100%">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">

				 <?php
                if ($ph=mysqli_query($con,"select * from photo_company_profile where $where pc_admin_id in(select super_csr_id from wishlist where realtor_id = '$loggedin_id') and pc_admin_id not in (select id from admin_users where is_approved<>1) order by id desc")) {
$knowMore='<a href="#photoCompany"  class="lightbox link" data-lightbox-anima="show-scale" onclick="GetCompanyDetails('.$photo1['pc_admin_id'].',\''.$photo1['organization_name'].'\')"><span adr_trans="label_view1">View</span></a>';
                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">
				<img   href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,'<?php echo $photo1['organization_name']; ?>')" src="<?php if( $photo1['logo_image_url']!='') { echo $photo1['logo_image_url']; } else { echo "photo-not-available.png"; } ?>" width="120" height="100"  style="max-width: 70px;"/>
				 <i class="fa fa-heart close" style="position:absolute;top:80px;right:1px;;background:white;color:#aad1d6;font-weight:700;padding:2px;" title="Remove from wishlist" onClick="removeFromWishList1(<?php  echo $loggedin_id; ?>,<?php echo $photo1['pc_admin_id'];?>)"></i>
				   <?php
                }
               ?>
<p align="center" style="padding-top:3px;width:120px!important;word-break:break-word;font-size: 13px;"><?php echo strtoupper($photo1['organization_name']); ?>
 </p>


<?php
$phidIs=$photo1['pc_admin_id'];
//echo "select ROUND(avg(rating)) as avgRating,super_csr_id from photographer_rating group by realtor_id having super_csr_id='$phidIs'";
$rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,super_csr_id from photographer_rating group by realtor_id,super_csr_id having super_csr_id='$phidIs'");
$ratingIs=0;
if($rating1=mysqli_fetch_array($rating))
{
$ratingIs= $rating1['avgRating'];
}



for($i=1;$i<=5;$i++)
{
if($i<=$ratingIs)
{
?>
<i class="fa fa-star" style="padding:1px;font-size:10px;color:#aad1d6;"></i>
<?php } else { ?>
<i class="fa fa-star-o" style="padding:1px;color:#aad1d6;font-size:10px;"></i>
<?php } } ?>
          <br />
<span style="font-size:12px;"><?php echo $knowMore; ?></span>
				</td>
				</tr>




				</table>
				</center>
					<?php } ?>

<?php
        $photo=mysqli_query($con,"select * from photo_company_profile where $where pc_admin_id not in(select super_csr_id from wishlist where realtor_id = '$loggedin_id') and pc_admin_id!=0 and pc_admin_id not in (select id from admin_users where is_approved<>1) order by id desc");
        while($photo1=mysqli_fetch_array($photo))
        {
$knowMore='<a href="#photoCompany"  class="lightbox link" data-lightbox-anima="show-scale" onclick="GetCompanyDetails('.$photo1['pc_admin_id'].',\''.$photo1['organization_name'].'\')"><span adr_trans="label_view1">View</span></a>';
        ?>

      <table cellspacing="0" border="0"  cellpadding="0" class="table table-responsive" style="background:#FFF;color:#000;font-weight:600;opacity:0.8;width:100%;border-radius:10px;width:100%">
				<tr style="float:left;"><td style="padding:15px;border:none">
<center>

<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">
				<img   href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,'<?php echo $photo1['organization_name']; ?>')" src="<?php if( $photo1['logo_image_url']!='') { echo $photo1['logo_image_url']; } else { echo "photo-not-available.png"; } ?>" width="120" height="100"  style="max-width: 70px;"/><i class="fa fa-heart-o close" style="position:absolute;top:80px;right:0px;;background:white;color:#aad1d6;font-weight:700;padding:2px;" title="Add to wishlist"  onClick="addToWishList1(<?php  echo $loggedin_id; ?>,<?php echo $photo1['pc_admin_id'];?>)"></i>
<p align="center" style="padding-top:3px;width:120px!important;word-break:break-word;font-size: 13px;"><?php echo strtoupper($photo1['organization_name']); ?>
 </p>


 <?php
 $phidIs=$photo1['pc_admin_id'];
 //echo "select avg(rating) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
 $rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,super_csr_id from photographer_rating group by realtor_id,super_csr_id having super_csr_id='$phidIs'");
 $ratingIs=0;
 if($rating1=mysqli_fetch_array($rating))
 {
 $ratingIs= $rating1['avgRating'];
 }

 for($i=1;$i<=5;$i++)
 {
 if($i<=$ratingIs)
 {
 ?>
 <i class="fa fa-star" style="padding:1px;font-size:10px;color:#aad1d6;"></i>
 <?php } else { ?>
 <i class="fa fa-star-o" style="padding:1px;color:#aad1d6;font-size:10px;"></i>
 <?php } } ?><br />
              <span style="font-size:12px;"><?php echo $knowMore; ?></span>


        </td>
        </tr>


        </table>
		</center>
          <?php } ?>

</div>

</div>



<script>


function addToWishList(realtors,photographers)
{
var R_id= realtors;
var P_id= photographers;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","wishlist.php?R_id="+R_id+"&P_id="+P_id,true);
  xhttp.send();
window.location.href = "./csrRealtorDashboard.php?wl=1";
window.reload();

 }


 function addToWishList1(realtors,supercsrid)
{
var R_id= realtors;
var CSR_id= supercsrid;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){

window.location.href = "./csrRealtorDashboard.php?wl=1&cw=1";
//window.reload();
    }
    };
  xhttp.open("GET","wishlist1.php?R_id="+R_id+"&CSR_id="+CSR_id,true);
  xhttp.send();

 }


 function removeFromWishList(realtors,photographers)
{
var R_id= realtors;
var P_id= photographers;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
window.location.href = "./csrRealtorDashboard.php?rwl=1";
//window.reload();

    }
    };
  xhttp.open("GET","removeFromWishlist.php?R_id="+R_id+"&P_id="+P_id,true);
  xhttp.send();

 }




 function removeFromWishList1(realtors,supercsrid)
{
var R_id= realtors;
var CSR_id= supercsrid;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","removeFromWishlist1.php?R_id="+R_id+"&CSR_id="+CSR_id,true);
  xhttp.send();
window.location.href = "./csrRealtorDashboard.php?rwl=1&cw=1";
window.reload();
 }

// $wish=mysqli_query($con,"INSERT INTO `wishlist` (`realtor_id`, `photographer_id`) VALUES ('$loggedin_id',
//   '$photo1['id']')");
</script>


				<div id="aboutMe" class="box-lightbox" style="padding:25px;height:450px;">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="label_photographer_details" adr_trans="label_photographer_details" >PHOTOGRAPHER DETAILS</h5>
                            <hr class="space s">

							<div class="tab-box right" data-tab-anima="fade-left">
                        <div class="panel-box col-md-8" id="resultDiv" style="height:400px;">

                        </div>
                        <ul class="nav nav-tabs col-md-4" style="height:200px;">
              <li class="active" id="about" style="border-bottom:solid 1px #DDD;" ><a href="#" id="label_about_me" adr_trans="label_about_me">About Me</a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_skills" adr_trans="label_skills">Skills</a></li>
              <li id="portfolio" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_portfolio" adr_trans="label_portfolio">Portfolio</a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_contact" adr_trans="label_contact">Contact</a></li>
               <li id="products" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_products" adr_trans="label_products">Products</a></li>

                        </ul>
                    </div>

							</div>

</div></div>











			
			</div>
<div id="photoCompany" class="box-lightbox" style="background: #F1F3F4;padding:25px;height:450px;border-radius:10px;">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center">
							<span id="companyName" style="text-transform:uppercase"></span></h5>
                            <hr class="space s">

							<div class="tab-box right" data-tab-anima="fade-left">
                      		<div class="hidden-md hidden-lg hidden-xl">
							<ul class="nav nav-tabs col-md-4 col-sm-4" style="height:200px;">
           <li class="active mobileLinks" id="about" style="border-bottom:solid 1px #DDD;" ><a href="#"><span adr_trans="label_about_us">About us </span></a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;width:110px!important;" class="mobileLinks"><a href="#"><span adr_trans="label_photographers">Photographers</span></a></li>
             <li id="products" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#"><span adr_trans="label_products">Products</span></a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#"><span adr_trans="label_contact">Contact</span></a></li>
          <li id="portfolio" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#"><span adr_trans="label_portfolio">Portfolio</span></a></li>
                      </ul>
							</div>
                        <div class="panel-box col-md-8 col-sm-8" id="resultDiv1" style="height:330px;overflow-y:scroll;">

                        </div>
                        <ul class="nav nav-tabs col-md-4 col-sm-4 hidden-sm hidden-xs" style="height: 145.333px;">
              <li class="active" id="about" style="border-bottom:solid 1px #DDD;width:96%" ><a href="#"><i class="fa fa-user" style="color:#333333"></i> <span adr_trans="label_about_us">About us</span></a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-camera" style="color:#333333"></i> <span adr_trans="label_photographers">Photographers</span></a></li>
             <li id="products" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-database" style="color:#333333"></i> <span adr_trans="label_products">Products</span></a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-tablet" style="color:#333333"></i><span adr_trans="label_contact">Contact</span></a></li>
               <li id="portfolio" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-certificate" style="color:#333333"></i> <span adr_trans="label_portfolio">Portfolio</span></a></li>

                        </ul>
                    </div>

							</div>
            </div>


            </div>

<script>
$(document).ready(function() {
    $("#warningMsg").click();
});

</script>

<?php if(isset($_REQUEST['companySearch']) || @$_REQUEST['cw']) { ?>
<script>
$("#photographers").hide();
$("#photo_company").show();
var value="photo_company";
  $("input[name=toglePH][value=" + value + "]").prop('checked', true);
</script>
<?php } ?>

<?php include "footer.php";  ?>
