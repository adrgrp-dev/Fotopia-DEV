<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION['loggedin_id'];

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
.active
{
background:none!important;
}

</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage9">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
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


	var id_to_show_hide;
	function show(id_to_show_hide)
	{
	$("#show"+id_to_show_hide).show();

	}
	function hide(id_to_show_hide)
	{
	$("#show"+id_to_show_hide).hide();

	}


		</script>
			</div>
                <div class="col-md-10" >




				<div class="col-md-10" >




          <div class="col-md-12">



		  	<h5 class="text-center" id="label_realtor_dashboard" adr_trans="label_realtor_dashboard" style="display:none">CSR / Realtor Dashboard</h5>


<?php if(@isset($_REQUEST["wl"])) { ?>

                            <p class="text-success" align="center" ><br />Added to wishlist successfully<br /></p>

						<?php }  ?>

						<?php if(@isset($_REQUEST["rwl"])) { ?>

                            <p class="text-success" align="center"><br />Removed from wishlist successfully<br /><br /></p>

						<?php }  ?>



            <div class="row">




                        <div class="col-md-3 advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:grey;border-radius:35px 35px 35px 35px!important;width:23%;margin:7px;">
                            <i class="fa fa-check icon circle anima" aid="0.8338801153232887" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                            <?php
                              $get_complete_query=mysqli_query($con,"SELECT count(id) as total1 FROM orders where status_id=3 and created_by_id='$loggedin_id'");
                              $get_complete=mysqli_fetch_assoc($get_complete_query);
                              ?>
                            <h5>Completed Orders</h5>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_complete['total1'];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px">

      <?php echo $get_complete['total1'];?>
                            </p>
                            <a class="anima-button circle-button btn-sm" href="order_list.php?c=1"><i class="fa fa-long-arrow-right"></i>View </a>
                        </div>

                        <div class="col-md-3 advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:grey;border-radius:35px 35px 35px 35px!important;width:23%;margin:7px;">
                          <?php
                            $get_ongoing_query=mysqli_query($con,"SELECT count(id) as total FROM orders where status_id<>3 and created_by_id='$loggedin_id'");
                            $get_ongoing=mysqli_fetch_assoc($get_ongoing_query);
                            ?>

                                        <i class="fa fa-calendar icon circle anima" aid="0.8338801153232887" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                                        <h5>OnGoing Orders</h5>
                                        <p class="counter" data-speed="1000" data-to="<?php echo $get_ongoing['total'];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px">

                      <?php echo $get_ongoing['total'];?>
                                        </p>
                                        <a class="anima-button circle-button btn-sm" href="order_list.php?o=1"><i class="fa fa-long-arrow-right"></i>View </a>
                                    </div>

                        <div class="col-md-3 advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:grey; height:171px;border-radius:35px 35px 35px 35px!important;width:23%;margin:7px;">
                                        <i class=" icon circle anima" aid="0.8338801153232887" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                                        <!-- <?php
                                          $get_order_query=mysqli_query($con,"SELECT count(home_seller_id) as home_total FROM orders where  created_by_id='$loggedin_id'");
                                          $get_order=mysqli_fetch_assoc($get_order_query);
                                          ?>
                                        <h5>Properties</h5>
                                        <p style="color:white;font-size:25px;font-weight:600">  &nbsp;<br /><label class="counter" data-speed="1000" data-to="<?php echo $get_order['home_total'];?>" style="color:white;font-size:25px;font-weight:600"><?php echo $get_order['home_total'];?></label></p>
                                  </p> -->
                                          <a class="anima-button circle-button btn-sm" href="#"><i class="fa fa-long-arrow-right"></i>View </a>
                                    </div>

            <div class="col-md-3 advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:grey; height:171px;border-radius:35px 35px 35px 35px!important;width:23%;margin:7px;">
              <?php
              $get_user_login=mysqli_query($con,"SELECT count(*) as total FROM user_login where type_of_user='Photographer'");
              $get_user=mysqli_fetch_assoc($get_user_login);
              ?>
                            <i class="icon circle anima" aid="0.8338801153232887" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                            <!-- <h5>Photographers</h5>
                             <p style="color:white;font-size:25px;font-weight:600">&nbsp;<br /><label class="counter" data-speed="1000" data-to="<?php echo $get_user['total'];?>" style="color:white;font-size:25px;font-weight:600"><?php echo $get_user['total'];?></label></p> -->

                          <a class="anima-button circle-button btn-sm" href="#"><i class="fa fa-long-arrow-right"></i>View </a>
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
          	    eventClick: function(info) {
          		var even=info.event;
             window.location.href = "order_detail.php?id="+even.title;
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
		alertmsg="Er du sikker på at du vil  lage et arrangement for";
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

            <div class="col-md-6" style="padding:20px 10px;">
              <center>    <h5>Upcoming Events</h5></center>
              	<div id='calendar' style="opacity:0.8"></div>
                <hr class="space s">
                <center>  <a href="./csrRealtorCalendar.php" class="anima-button circle-button btn-sm btn adr-save"><i class="fa fa-calendar"></i> View My Calender</a>    </center>
            </div>
            <div class="col-md-6">  <div class=" advs-box advs-box-top-icon boxed-inverse"  style="background:white;border:1px solid black;border-radius:35px 35px 35px 35px;opacity:0.8;height: 330px;">
                <p style="color:black;margin-top: -20px;margin-bottom: 25px;font-size: 18px;">Latest Deliverd photos</p>
             <?php

                $get_latest_delivered_query=mysqli_query($con,"SELECT * FROM `img_upload` where finished_images=1 and order_id in(select id from orders where created_by_id=$_SESSION[loggedin_id]) order by rand() limit 4");
                while($get_latest_delivered=mysqli_fetch_array($get_latest_delivered_query))
                {
                  ?>

                  <div class="col-md-6">
                    <a href="order_detail.php?id=<?php echo $get_latest_delivered['order_id']; ?>&f=1">
                  <img src="./finished_images/order_<?php echo $get_latest_delivered['order_id']; ?>/<?php if($get_latest_delivered['service_id']==1){ echo "standard_photos" ;}elseif($get_latest_delivered['service_id']==2){ echo "floor_plans";}elseif($get_latest_delivered['service_id']==3){echo "Drone_photos";}else{ echo "Hdr_photos";}?>/<?php echo $get_latest_delivered['img']?>" width="200" height="100" style="padding-bottom:10px;"/>
                  </a>
                  </div>
            <?php		}
              ?>
               <a class="anima-button circle-button btn-sm" href="order_list.php"><i class="fa fa-long-arrow-right"></i>View My Orders </a>
            </div></div>


            </div>




			<div class="col-md-2">
				<h5 class="text-left" style="margin-left:20px;display:none" id="label_photographers" adr_trans="label_photographers">Photographers</h5>
				<p style="margin-left:5px;">
				<form name="searchByLocation" method="post" action="" style="margin-left:5px;">
				<input type="text" list="Suggestions" multiple="multiple" class="form-control form-value" name="location" value="" style="display:inline;width:131px;font-size:12px;"  placeholder="Type city to search" />
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


				$locIs=@$_POST['location'];

				$photo=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and id in(select photographer_id from wishlist where realtor_id ='$loggedin_id') order by id desc");
				while($photo1=mysqli_fetch_array($photo))
				{

				$uID=$photo1['id'];

				$profileQry=mysqli_query($con,"select count(*) as totRec from photographer_profile where photographer_id='$uID' and location like '%$locIs%'");
				$profileQry1=mysqli_fetch_array($profileQry);
				$totalRecords=$profileQry1['totRec'];
				if($totalRecords!=0)
				{

				?>
				<table cellspacing="0" border="0" cellpadding="0" class="table table-responsive" style="box-shadow:5px 5px 5px #DDD;width:max-content;margin-left:5px;background:#000;color:#FFF;opacity:0.8;width:150px;border-radius:25px 25px 25px 25px;"  onmouseover="show(<?php echo $photo1['id']; ?>)"  onmouseout="hide(<?php echo $photo1['id']; ?>)">
				<tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">

				 <?php
                if ($ph=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and id in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc")) {

                  ?>
<div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;">
				<img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/>
				 <i class="fa fa-heart close" style="position:absolute;bottom:45px;right:1px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Remove from wishlist" onClick="removeFromWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
				   <?php
                }
               ?>

				<p align="center" style="padding-top:3px;"><?php echo strtoupper($photo1['first_name']); ?>
          <br />

<?php
$phidIs=$photo1['id'];
//echo "select avg(rating) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
$rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'");
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
				</td>
				</tr>

				<tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;" id="show<?php echo $photo1['id']; ?>">
				<td>

				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onClick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onClick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
        	<a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


				</td></tr>


				</table>
					<?php } } ?>

<?php
        $photo=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and id not in(select photographer_id from wishlist where realtor_id = '$loggedin_id') order by id desc");
        while($photo1=mysqli_fetch_array($photo))
        {
$uID=$photo1['id'];

				$profileQry=mysqli_query($con,"select count(*) as totRec from photographer_profile where photographer_id='$uID' and location like '%$locIs%'");
				$profileQry1=mysqli_fetch_array($profileQry);
				$totalRecords=$profileQry1['totRec'];
				if($totalRecords!=0)
				{
        ?>
        <table cellspacing="0" border="0" cellpadding="0" class="table table-responsive" style="box-shadow:5px 5px 5px #DDD;width:max-content;margin-left:5px;background:#000;color:#FFF;opacity:0.8;width:150px;border-radius:25px 25px 25px 25px;"  onmouseover="show(<?php echo $photo1['id']; ?>)"  onmouseout="hide(<?php echo $photo1['id']; ?>)">
        <tr style="float:left;"><td rowspan="0" align="center" style="padding:15px;border:none">


       <div ng-repeat="file in imagefinaldata" class="img_wrp" style="display: inline-block;position: relative;float:right;">
				<img   href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:underline" onclick="GetDetails(<?php echo $photo1['id']; ?>)" src="data:<?php echo $photo1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($photo1['profile_pic']); ?>" width="120" height="100"  style="max-width: 70px;"/><i class="fa fa-heart-o close" style="position:absolute;bottom:45px;right:1px;;background:white;color:#006600;font-weight:700;padding:2px;" title="Add to wishlist"  onClick="addToWishList(<?php  echo $loggedin_id; ?>,<?php echo $photo1['id'];?>)"></i>
         <p align="center" style="padding-top:3px;"><?php echo strtoupper($photo1['first_name']); ?>
           <br />

 <?php
 $phidIs=$photo1['id'];
 //echo "select avg(rating) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'";
 $rating=mysqli_query($con,"select ROUND(avg(rating)) as avgRating,photographer_id from photographer_rating group by realtor_id having photographer_id='$phidIs'");
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


        </td>
        </tr>

        <tr class="fade-top" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;" id="show<?php echo $photo1['id']; ?>">
        <td>

        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_about_me" adr_trans="label_about_me" onClick="GetDetails(<?php echo $photo1['id']; ?>)">About Me</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_my_skills" adr_trans="label_my_skills" onClick="GetDetails(<?php echo $photo1['id']; ?>)">My Skills</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_portfolio" adr_trans="label_portfolio" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Portfolio</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>
        <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_contact" adr_trans="label_contact" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Contact</a><br>
          <a href="#aboutMe" class="lightbox link" data-lightbox-anima="show-scale" style="color:blue;text-decoration:none;color:#333333;padding-left:10px;" id="label_products" adr_trans="label_products" onClick="GetDetails(<?php echo $photo1['id']; ?>)">Products</a><br>


        </td></tr>


        </table>
          <?php } } ?>
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

 }

 function removeFromWishList(realtors,photographers)
{
var R_id= realtors;
var P_id= photographers;

var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


    }
    };
  xhttp.open("GET","removeFromWishlist.php?R_id="+R_id+"&P_id="+P_id,true);
  xhttp.send();
window.location.href = "./csrRealtorDashboard.php?rwl=1";

 }

// $wish=mysqli_query($con,"INSERT INTO `wishlist` (`realtor_id`, `photographer_id`) VALUES ('$loggedin_id',
//   '$photo1['id']')");
</script>

				</div>

                </div>


				<div id="aboutMe" class="box-lightbox white" style="padding:25px;height:336px;">
                        <div class="subtitle g" style="color:#333333">
                            <h5 style="color:#333333" align="center" id="label_photographer_details" adr_trans="label_photographer_details" >PHOTOGRAPHER DETAILS</h5>
                            <hr class="space s">

							<div class="tab-box right" data-tab-anima="fade-left">
                        <div class="panel-box col-md-8" id="resultDiv">

                        </div>
                        <ul class="nav nav-tabs col-md-4" style="height: 145.333px;">
              <li class="active" id="about" style="border-bottom:solid 1px #DDD;" ><a href="#" id="label_about_me" adr_trans="label_about_me" ><i class="fa fa-user" style="color:#333333"></i> About Me</a></li>
			        <li id="skills" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_skills" adr_trans="label_skills" ><i class="fa fa-certificate" style="color:#333333"></i> Skills</a></li>
              <li id="portfolio" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_portfolio" adr_trans="label_portfolio" ><i class="fa fa-list" style="color:#333333"></i> Portfolio</a></li>
               <li id="contact" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_contact" adr_trans="label_contact" ><i class="fa fa-tablet" style="color:#333333"></i> Contact</a></li>
               <li id="products" style="border-bottom:solid 1px #DDD;"><a href="#" id="label_products" adr_trans="label_products" ><i class="fa fa-tablet" style="color:#333333"></i> Products</a></li>

                        </ul>
                    </div>

							</div>
            </div>






            </div>
        </div>

		<?php include "footer.php";  ?>
