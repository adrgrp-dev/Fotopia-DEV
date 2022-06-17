<?php
ob_start();

include "connection1.php";

//Login Check
if(isset($_REQUEST['loginbtn']))
{
	header("location:index.php?failed=1");
}
$superCsr=$_SESSION['admin_loggedin_id'];
$loggedin_id=$_SESSION['admin_loggedin_id'];

?>
<?php include "header.php";  ?>
 <div class="section-empty bgimage4">
        <div class="container-fluid" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space xs">
                <div class="col-md-2">
				<hr class="space s">
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
		function GetCompanyDetails(supercsr,id1,org)
		{
		$("#companyName").html(org);
		 var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
	 $("#resultDiv1").html(this.responseText);

    }
  };
  xhttp.open("GET","Get_Company_Details.php?super_csr_id="+supercsr+"&id="+id1,true);
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
/*background:none!important;*/

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
font-size: 10px!important;
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
margin:2px!important;
font-size: 10px!important;
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
/*background:#000!important;
color:#FFF!important;*/
margin:2px!important;
font-size: 7px!important;
}
.fc .fc-toolbar-title
{
font-size:7px!important;
}

.forMobile
{
height:fit-content!important;
}
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .active
{
opacity:1!important;
border:none;
}
</style>
			</div>
<?php
$pc_id=$_SESSION['admin_loggedin_id'];
    $pc_profile=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$pc_id'");
    $pc_profile1=mysqli_fetch_array($pc_profile);
    $aboutPC=$pc_profile1['about_us'];
    
        $organization_number=$pc_profile1['organization_number'];
         $organization_name=$pc_profile1['organization_name'];
        $organization_tax=$pc_profile1['tax'];
         $organization_location=$pc_profile1['location'];

    $products=mysqli_query($con,"select * from products where pc_admin_id='$pc_id'");
    $productsFound=mysqli_num_rows($products);

if (@$_REQUEST['second']) {


    if($organization_number=='' && !@$_REQUEST['first'] || $organization_name=='' && !@$_REQUEST['first'] || $organization_tax=='' && !@$_REQUEST['first'] || $organization_location=='' && !@$_REQUEST['first']) 
      { 
        ?>
      <input type="button" class="btn adr-save btn-sm" id="warningMsg" onclick="document.getElementById('myModal').style='display:block;padding-top:120px;background:rgba(94,94,94,0.7)'" style="display:none" />

<div id="myModal" class="modal" align="center">
<div class="modal-content" align="center" style="width:26%!important;height:40%!important;border-radius:12px">
 <hr class="space xs">
<h5 class="text-center" id="label_warning" adr_trans="" style="color:orange!important;">Warning!<br /></h5>
          <table class="table table-responsive"><tr><td>


<hr class="space s">
<center><span>Finish your registration in order to show up as a validated user</span></center>
<hr class="space m">
<p align="center"><a href="edit_company_profile.php?first=1" class="btn anima-button btn-sm adr-save"><i class="fa fa-check-circle"></i><span adr_trans="">Proceed</span></a>&nbsp;&nbsp;<a href="PCAdmin_dashboard.php" class="btn anima-button btn-sm adr-cancel"><i class="fa fa-check-circle"></i><span adr_trans="">Skip for now</span></a></p>

</td></tr></table>
</div>
</div>
  <?php  

}
}

if (@$_REQUEST['third']) {

    if($productsFound==0 && !@$_REQUEST['first']) 
      { 
       
 ?>
      <input type="button" class="btn adr-save btn-sm" id="warningMsg2" onclick="document.getElementById('myModal').style='display:block;padding-top:120px;background:rgba(94,94,94,0.7)'" style="display:none" />

<div id="myModal" class="modal" align="center">
<div class="modal-content" align="center" style="width:26%!important;height:40%!important;border-radius:12px">
 <hr class="space xs">
<h5 class="text-center" id="label_warning" adr_trans="label_warning" style="color:orange!important;">Warning!<br /></h5>
          <table class="table table-responsive"><tr><td>


<hr class="space s">
<center><span>Finish your registration in order to show up as a validated user</span></center>
<hr class="space m">
<p align="center"><a href="products.php?first=1" class="btn btn-sm anima-button adr-save"><i class="fa fa-check-circle"></i><span adr_trans="">Proceed</span></a>&nbsp;&nbsp;<a href="PCAdmin_dashboard.php" class="btn anima-button btn-sm adr-cancel"><i class="fa fa-check-circle"></i><span adr_trans="">Skip for now</span></a></p>

</td></tr></table>
</div>
</div>
  <?php  

      }}?>
                <div class="col-md-8">
<?php if(@isset($_REQUEST["na"])) { ?>

                            <p class="text-error" align="center" style="font-style:italic;color:red"><br />You are not Authorized to view the details of the requested Order.<br /></p>

						<?php }  ?>
						<div class="row">
						<!--<p align="left"><span style="padding-left:5px;color:#000;">PC Admin Dashboard</span>-->	
						<a href="quick_create_order.php?u=0&pc_admin_id=<?php echo $_SESSION['admin_loggedin_id']; ?>" class="btn-sm btn" style="background:#aad1d6;color:#000;border-radius:5px;border:none;margin-right:15px;margin-bottom:10px;width:120px;padding:7px;font-size:11px!important; float:right">Quick Order</a> 
					<div class="row" style="margin-left:0px;"></p></div>

               
								<div class="row" style="margin-left:0px;">

											<div class="col-md-3">
													 <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

																<hr class="space s">
															<div class="row">

															<div class="col-md-12" style="padding-left: 35px;">
																	<h5><i class="fa fa-arrow-circle-right fa-lg" style="color:#aad1d6;"></i><br /><br /><span\>New /<br> Ongoing </span></h5>
																		<?php
																		$get_ongoing_query=mysqli_query($con,"select count(*) as ongoing_no from orders where status_id in(1,2,4,7,8) and pc_admin_id=$superCsr");
																		if($get_ongoing=mysqli_fetch_assoc($get_ongoing_query))
																		{
																		?>
																	<p class="counter" data-speed="1000" data-to="  <?php echo $get_ongoing["ongoing_no"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;"> <?php echo $get_ongoing["ongoing_no"]; }?></p>

																	<hr class="space xs">
							 <a class="btn-sm" adr_trans="label_view" href="superorder_list1.php?o=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>


																</div>
															</div>
													</div>
											</div>
											 <div class="col-md-3">
                     <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

													<hr class="space s">
                        <div class="row">
													<div class="col-md-12" style="padding-left: 35px;">
														<h5><i class="fa fa-check-circle fa-lg" style="color:#aad1d6;"></i><br /><br /><span id="label_completed" adr_trans="label_completed">Completed</span></h5>
														<hr class="space xs">
															<?php
															$get_order_query=mysqli_query($con,"select count(*) as completed_no from orders where status_id=3 and pc_admin_id=$superCsr");
															if($get_order=mysqli_fetch_assoc($get_order_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to=" <?php echo $get_order["completed_no"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;margin-top: 2px;">

			 <?php echo $get_order["completed_no"]; }?>
		 </p>

		 <hr class="space xs">
							 <a class="btn-sm" adr_trans="label_view" href="superorder_list1.php?c=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>

		  
													</div>

												</div>
                    </div>
                </div>
                <div class="col-md-3">
                     <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

													<hr class="space s">
												<div class="row">
													<div class="col-md-12" style="padding-left: 35px;">
                              <h5><i class="fa fa-users circle-right fa-lg " style="color:#aad1d6;"></i><br /><br /><span id="label_users" adr_trans="label_users">Users</span></h5>
                              <hr class="space xs">
															<?php
															$get_user_query=mysqli_query($con,"select count(*) as user_no from user_login where type_of_user='Photographer' and pc_admin_id=$superCsr");

															$get_user_query1=mysqli_query($con,"select count(*) as user_no1 from admin_users where type_of_user='CSR' and pc_admin_id=$superCsr");

															$get_user_query2=mysqli_query($con,"select count(*) as user_no2 from photo_company_admin where pc_admin_id=$superCsr");

															$get_user=mysqli_fetch_assoc($get_user_query);
															$get_user1=mysqli_fetch_assoc($get_user_query1);
															$get_user2=mysqli_fetch_assoc($get_user_query2);
															  ?>
														<p class="counter" data-speed="1000" data-to="<?php echo $get_user["user_no"]+$get_user1["user_no1"]+$get_user2["user_no2"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;margin-top: 2px;">

		<?php echo $get_user["user_no"]+$get_user1["user_no1"]+$get_user2["user_no2"]; ?>
		 </p>

		 <hr class="space xs">
							 <a class="btn-sm" adr_trans="label_view" href="csr_list1.php?p=1" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>

		     
													</div>

												</div>
                    </div>
                </div>
                <div class="col-md-3">
                   <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

                          	<hr class="space s">
												<div class="row">
												<div class="col-md-12" style="padding-left: 35px;">
														<h5><i class="fa fa-sliders fa-lg " style="color:#aad1d6;"></i><br /><br /><span>Revenue<br/> this Month</span></h5>

															<?php

													$total1=0;
													// echo "SELECT id FROM orders where status_id=3 and pc_admin_id=$superCsr";
													$get_invoiced_name_query=mysqli_query($con,"SELECT id FROM orders where month(session_from_datetime)=month(now()) and status_id=3 and pc_admin_id=$superCsr");
													while(@$get_name=mysqli_fetch_assoc(@$get_invoiced_name_query))
													{
														$order_id=$get_name['id'];
														//echo "SELECT sum(total_price*quantity) as totalPrice from order_products WHERE order_id='$order_id'";
														  $total_cost=mysqli_query($con,"SELECT sum(price*quantity) as totalPrice from order_products WHERE order_id='$order_id'");
																	if($get_product=mysqli_fetch_array($total_cost))
                                   {
													     	   @$total1 +=@$get_product['totalPrice'];
													       }
                          }
												?>
											   <p style="color:white;font-size:25px;font-weight:600;margin-bottom:5px;"><label class="" data-speed="1000" data-to="<?php echo $total1;?>" style="color:#000;font-size:22px;font-weight:600;margin-top: 3px;"><?php echo "$".$total1; ?></label></p>
											 
											   
							 <a class="btn-sm" adr_trans="label_view" href="payment_reports.php" style="background:#aad1d6!important;color:#000!important;font-weight:600;border-radius:5px;padding-left:40px;padding-right:40px;">View </a>

													</div>

												</div>

                    </div>
                </div>
            </div>






<br />

<div class="col-md-6">
<!--  calendar starts -->


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
background:#FFF!important;
border:solid 1px #01A8F2!important;
}
.fc-day-sat,.fc-day-sun
{
background:#EEEEEE!important;
border:solid 1px #01A8F2!important;
}
				</style>
				<script src='../lib/main.js'></script>
			<?php
			if(@$_REQUEST['ph_id'])
{
		?>
			<script>
		var urlNew="../photographer_events.php?photographer_id=<?php echo $_REQUEST['ph_id']; ?>";
			</script>

			<?php } else {  ?>
			<script>
				var urlNew="super_event.php?super_csr_id=<?php echo $_SESSION['admin_loggedin_id']; ?>";

			</script>
			<?php }   ?>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
let today = new Date().toISOString().slice(0, 10)


$.ajax({
      url: urlNew,
      modal: true,
	   dataType: 'JSON',
	  success: function(response){
	 // eventData=JSON.stringify(response);
	//alert(eventData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: today,
      initialView: 'timeGridDay',
	  contentHeight: 320,
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
<br />

              <center>    <h5 adr_trans="label_upcoming_events">Upcoming Events</h5></center>
 <div id='calendar' style="background:#FFF!important;border-radius:5px;"></div>
  <hr class="space s">
                <center>
                <a href="PCAdmin_calender.php" class="anima-button circle-button btn-sm btn adr-save" adr_trans="label_view_my_calender"><i class="fa fa-calendar"></i>View My Calender</a>   </center>
    </div>

<!-- calendar ends -->


<div class="col-md-6">
 <br />
              <center>    <h5 id="label_latest_delivered" adr_trans="label_latest_delivered">Latest Delivered Orders</h5></center>
<div class=" advs-box boxed-inverse forMobile"  style="background:#FFF!important;border-radius:10px;opacity:0.8;height: 350px;">
 <?php

		$get_latest_delivered_query=mysqli_query($con,"SELECT * FROM `img_upload` where finished_images=1 and order_id in(select id from orders where pc_admin_id=$_SESSION[admin_loggedin_id]) order by rand() limit 4");
		while($get_latest_delivered=mysqli_fetch_array($get_latest_delivered_query))
		{
		  $orderIDIs=$get_latest_delivered['order_id'];
		$get_address1=mysqli_query($con,"SELECT * FROM orders where id='$orderIDIs'");
		$get_address=mysqli_fetch_array($get_address1);
			?>

			<div class="col-md-6">
				<a href="superOrder_detail.php?id=<?php echo $get_latest_delivered['order_id']; ?>&finished_image=1">
				<img src="../finished_images/order_<?php echo $get_latest_delivered['order_id']; ?>/<?php if($get_latest_delivered['service_id']==1){ echo "standard_photos" ;}elseif($get_latest_delivered['service_id']==2){ echo "floor_plans";}elseif($get_latest_delivered['service_id']==3){echo "Drone_photos";}else{ echo "Hdr_photos";}?>/<?php echo $get_latest_delivered['img']?>" width="235" height="140" style="padding-bottom:10px;"/>
				 <span style="position:absolute; text-align:center;z-index:2;color:#000;background: #FFF!important;
color:#000!important;padding:3px;opacity:0.6;width:93%;float:left;left:0px;font-weight:bold;font-size:12px;"><?php echo $get_address['property_address']; ?></span>
			</a>
			</div>
<?php		}
	?>

</div></div>


<p align="center">

 <a class="anima-button circle-button btn-sm adr-save" href="superorder_list1.php?c=1" style="margin-top:25px;background:#aad1d6;color:#000;border-radius:8px;border:none;" adr_trans="label_view_order"><i class="fa fa-long-arrow-right"></i>View My Orders </a>
 </p>







                </div>
								</div>



<div class="col-md-2">


<table class="table-responsive"><tr><td style="font-size:11px;font-weight:600;padding-left:10px;">
	<input type="radio" name="toglePH"  value="photographers" checked="checked" onchange="togglePH(this.value)" />&nbsp;&nbsp;<span id="label_photographers" adr_trans="label_photographers"  style="color:#000!important;position: relative;top:-3px;">&nbsp;Photographers<br /></span></td>
	<td style="font-size:11px;font-weight:600;">&nbsp;&nbsp;<input type="radio"  name="toglePH"  value="photo_company"  onchange="togglePH(this.value)"/>&nbsp;&nbsp;<span id="label_csr" adr_trans="label_csr" style="color:#000!important;position: relative;top:-3px;">CSR</span></td>
	</tr>
	</table>

<div style="">
				<div id="photographers" style="display:block;overflow:scroll!important;height:630px;">

				<h5 class="text-left" style="margin-left:20px;display:none" id="label_photographers" adr_trans="label_photographers">Photographers</h5>
				<p style="padding-left:3px;">
				<form name="searchByLocation" method="post" action="" style="margin-left:5px;">

		<?php 	/*	 <input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="" style="display:inline;font-size:12px;"  placeholder="Choose city" />

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
<br />
				<?php

$whereIs="";
$knowMore="";
				if(@$_REQUEST['location'])
				{
				$searchByLocation=$_REQUEST['location'];
				$whereIs=" and location like '%$searchByLocation%'";
			} */?>

<input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="photographersearch" value="<?php echo @$_REQUEST['photographersearch'];?>" style="display:inline;font-size:12px;height:30px;"  placeholder="Search Photographer" />

</form>

				</p>
<br />
				<?php

$whereIs="";
$knowMore="";
				if(@$_REQUEST['photographersearch'])
				{
				$searchByphotographer=$_REQUEST['photographersearch'];
				$whereIs=" and first_name like '%$searchByphotographer%'";
				}


				$photo=mysqli_query($con,"select * from user_login where email_verified=1 and type_of_user='Photographer' and pc_admin_id=$superCsr $whereIs order by id desc");
				while($photo1=mysqli_fetch_array($photo))
				{

				?>
				<table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive" style="background:#FFF;color:#000;font-weight:600;opacity:0.8;border-radius:10px;width:80%">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">

				 <?php
                if ($ph=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and pc_admin_id=$superCsr $whereIs order by id desc")) {

                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">

				<img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>

				   <?php

				   $knowMore="<a href='#aboutMe'  class='lightbox link' data-lightbox-anima='show-scale' onclick='GetDetails(".$photo1['id'].")'><span adr_trans='label_view1'>View</span></a>";
                }
               ?>

				<p align="center" style="padding-top:3px;"><?php echo strtoupper($photo1['first_name']); ?>
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
<i class="fa fa-star" style="padding:1px;font-size:10px;color:#aad1d6;"></i>
<?php } else { ?>
<i class="fa fa-star-o" style="padding:1px;color:#aad1d6;font-size:10px;"></i>
<?php } } ?>

        </p>
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

</div>





<div id="photo_company" style="display:none;overflow:scroll!important;height:500px;">


<h5 class="text-left" style="margin-left:20px;display:none" id="label_photo_companies" adr_trans="label_photo_companies">Photo companies</h5>


<form name="searchByLocation" method="post" action="" style="margin-left:5px;">

				 <input type="text"  class="form-control form-value" name="companySearch" value="<?php echo @$_REQUEST['companySearch']; ?>" style="display:inline;font-size:12px;height: 30px;margin-bottom:10px;"  placeholder="Search CSR" />
				 </form>

				<?php


$where="";

if(isset($_REQUEST['companySearch']))
{
$companySearch=$_REQUEST['companySearch'];
$where="and first_name like '$companySearch%'";
}

				$photo=mysqli_query($con,"select * from admin_users where is_approved=1 and type_of_user='CSR' and pc_admin_id='$superCsr' $where order by id desc");
				while($photo1=mysqli_fetch_array($photo))
				{
		 $knowMore="<a href='#photoCompany'  class='lightbox link' data-lightbox-anima='show-scale' onclick='GetCompanyDetails(".$photo1['pc_admin_id'].",".$photo1['id'].",\"".$photo1['organization_name']."\")'><span adr_trans='label_view1'>View</span></a>";

				?>
				<table cellspacing="0" border="0" align="center"  cellpadding="0" class="table table-responsive" style="background:#FFF;color:#000;font-weight:600;opacity:0.8;border-radius:10px;width:80%">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">

				 <?php
                if ($ph=mysqli_query($con,"select * from admin_users where type_of_user='CSR' and pc_admin_id='$superCsr' $where  order by id desc")) {

                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">
				<img   href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,<?php echo $photo1['id']; ?>,'<?php echo $photo1['organization_name']; ?>')" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>

				   <?php


                }
               ?>

				<p align="center" style="padding-top:3px;"><?php echo strtoupper($photo1['first_name']); ?>
          <br />

<?php
$phidIs=$photo1['id'];
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
               </p>
<?php echo $knowMore; ?>

				</td>
				</tr>

				 <tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;color:#333333" id="show<?php echo $photo1['id']; ?>1">
        <td style="padding-left:10px;">

        <a href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_us" adr_trans="label_about_us" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,<?php echo $photo1['id']; ?>,'<?php echo $photo1['organization_name']; ?>')">About us</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_photographers" adr_trans="label_photographers" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,<?php echo $photo1['id']; ?>,'<?php echo $photo1['organization_name']; ?>')">Photographers</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>

          <a href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,<?php echo $photo1['id']; ?>,'<?php echo $photo1['organization_name']; ?>')">Products</a><br>
        <a href="#photoCompany" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onclick="GetCompanyDetails(<?php echo $photo1['pc_admin_id']; ?>,<?php echo $photo1['id']; ?>,'<?php echo $photo1['organization_name']; ?>')">Contact</a><br>


        </td></tr>


				</table>
					<?php } ?>

</div>

</div>

</div>

<script>


function addToWishList(supercsr,photographers)
{
var Super_CSR__id= supercsr;
var P_id= photographers;
var typeofuser="<?php echo $_SESSION['admin_loggedin_type']; ?>";
var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };

  xhttp.open("GET","wishlist.php?Super_CSR_id="+Super_CSR__id+"&P_id="+P_id+"&type="+typeofuser,true);
  xhttp.send();
window.location.href = "./csr_dashboard.php?wl=1";

 }


 function addToWishList1(supercsrid,subcsrid)
{
var super_csr_id= supercsrid;
var sub_csr_id= subcsrid;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","wishlist1.php?super_csr_id="+super_csr_id+"&sub_csr_id="+sub_csr_id,true);
  xhttp.send();
window.location.href = "./csr_dashboard.php?wl=1&cw=1";

 }


 function removeFromWishList(supercsr,photographers)
{
var Super_CSR__id= supercsr;
var P_id= photographers;
var typeofuser="<?php echo $_SESSION['admin_loggedin_type']; ?>";
var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","removeFromWishlist.php?Super_CSR_id="+Super_CSR__id+"&P_id="+P_id+"&type="+typeofuser,true);
  xhttp.send();
window.location.href = "./csr_dashboard.php?rwl=1";

 }




 function removeFromWishList1(supercsrid,subcsrid)
{
var super_csr_id= supercsrid;
var sub_csr_id= subcsrid;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","removeFromWishlist1.php?super_csr_id="+super_csr_id+"&sub_csr_id="+sub_csr_id,true);
  xhttp.send();
window.location.href = "./csr_dashboard.php?rwl=1&cw=1";

 }

// $wish=mysqli_query($con,"INSERT INTO `wishlist` (`realtor_id`, `photographer_id`) VALUES ('$loggedin_id',
//   '$photo1['id']')");
</script>


			<div id="aboutMe" class="box-lightbox" style="background: #F1F3F4;padding:25px;height:350px;border-radius:10px;">
                        <div class="subtitle g" style="color:#333333">

                            <h5 style="color:#333333" align="center" id="label_photographer_details" adr_trans="label_photographer_details" >PHOTOGRAPHER DETAILS</h5>
                            <hr class="space s">

							<div class="tab-box right" data-tab-anima="fade-left">
							<div class="hidden-md hidden-lg hidden-xl">
							<ul class="nav nav-tabs col-md-4 col-sm-4" style="height: 200px;">
          <li class="active mobileLinks" id="about" style="border-bottom:solid 1px #DDD;" ><a href="#" id="label_about_me" adr_trans="label_about_me" >About me</a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_skills" adr_trans="label_skills" > Skills</a></li>
              <li id="portfolio" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_portfolio" adr_trans="label_portfolio" > Portfolio</a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_contact" adr_trans="label_contact" > Contact</a></li>
               <li id="products" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_products" adr_trans="label_products" >Products</a></li>

                      </ul>
							</div>
                        <div class="panel-box col-md-8 col-sm-8" id="resultDiv" style="height:200px;overflow-y:scroll;">

                        </div>
                        <ul class="nav nav-tabs col-md-4 col-sm-4 hidden-sm hidden-xs" style="height: 145.333px;">
              <li class="active" id="about" style="border-bottom:solid 1px #DDD;width:96%" ><a href="#"><i class="fa fa-user" style="color:#333333"></i><span adr_trans="label_about_me">About Me</span></a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-certificate" style="color:#333333"></i><span adr_trans="label_skills"> Skills</span></a></li>
              <li id="portfolio" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-list" style="color:#333333"></i><span adr_trans="label_portfolio"> Portfolio</span></a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-tablet" style="color:#333333"></i><span adr_trans="label_contact"> Contact</span></a></li>
               <li id="products" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-database	" style="color:#333333"></i><span adr_trans="label_products"> Products</span></a></li>

                      </ul>
                    </div>

							</div>

</div></div>












			<div id="photoCompany" class="box-lightbox  col-md-6" style="background: #F1F3F4;padding:25px;height:450px;border-radius:10px;">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="label_photocompany_details" adr_trans="label_photocompany_details">
							<span id="companyName" style="text-transform:uppercase"></span></h5>
                            <hr class="space s">

							<div class="tab-box right" data-tab-anima="fade-left">
							<div class="hidden-md hidden-lg hidden-xl">
							<ul class="nav nav-tabs col-md-4 col-sm-4" style="height: 200px;">
         <li class="active mobileLinks" id="about" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_about_me" adr_trans="label_about_me" >About us</a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;width:150px!important;" class="mobileLinks"><a href="#" id="label_photographers" adr_trans="label_photographers" >Photographers</a></li>
             <li id="products" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_products" adr_trans="label_products" >Products</a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;" class="mobileLinks"><a href="#" id="label_contact" adr_trans="label_contact" > Contact</a></li>
                      </ul>
							</div>
                        <div class="panel-box  col-md-8 col-sm-8" id="resultDiv1" style="height:330px;overflow-y:scroll;">

                        </div>
                        <ul class="nav nav-tabs col-md-4 hidden-sm hidden-xs" style="height: 145.333px;">
              <li class="active" id="about" style="border-bottom:solid 1px #DDD;width:96%" ><a href="#"><i class="fa fa-user" style="color:#333333"></i><span adr_trans="label_about_us"> About Us</span></a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-camera" style="color:#333333"></i><span adr_trans="label_photographers"> Photographers</span></a></li>
             <li id="products" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-database" style="color:#333333"></i><span adr_trans="label_products"> Products</span></a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;width:96%"><a href="#"><i class="fa fa-tablet" style="color:#333333"></i><span adr_trans="label_contact"> Contact</span></a></li>


                        </ul>
                    </div>

							</div>
            </div>


            </div>

<script>
$(document).ready(function() {
    $("#warningMsg").click();
});

$(document).ready(function() {
    $("#warningMsg2").click();
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
