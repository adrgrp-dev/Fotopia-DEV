<?php
ob_start();

include "connection1.php";



?>
<?php include "header.php";  ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpWF2v01q7IpMiUSICKhd9zndRFb_kxf8"></script>

 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2"  style="margin-left:-15px;">
	<?php include "sidebar.php"; ?>
  <style>

.breadcrumb1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 6px;
  overflow: hidden;
  margin-top: 30px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  box-shadow: 0 1px 1px black, 0 4px 14px rgba(0, 0, 0, 0.7);
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

  box-shadow:10px 10px 10px #ccc;
}

.breadcrumb1 a {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  text-decoration: none;
  margin: auto;
  height: 100%;
  padding-left: 38px;
  padding-right: 0;
  color: #666;
}

.breadcrumb1 a:first-child {
  padding-left: 10px;

}

.breadcrumb1 a:last-child {
  padding-right: 15.2px;
}

#firstStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
  z-index: 1;

}
#secondStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
  z-index: 1;
}
.breadcrumb1 a:last-child:after {
  content: none;
}

.breadcrumb__inner {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  margin: auto;
  z-index: 2;
}

.breadcrumb__title {
  font-weight: bold;
}

#thirdStep:hover {
background-color:#337AB7;
}

#thirdStep:after {
background-color:#337AB7;
}

@media all and (max-width: 1000px) {
  .breadcrumb1 {
    font-size: 12px;
  }
}
@media all and (max-width: 710px) {
  .breadcrumb__desc {
    display: none;
  }

  .breadcrumb1 {
    height: 38px;
  }

  .breadcrumb1 a {
    padding-left: 25.33333px;
  }

  .breadcrumb a:after {
    content: "";
    width: 38px;
    height: 38px;
    right: -19px;
    -webkit-transform: scale(0.707) rotate(45deg);
            transform: scale(0.707) rotate(45deg);
  }
}

td{
padding-right:15px;
}
.btn-default
{
color:#FFF!important;
background:#000!important;
}
#fourthStep
{
border-radius:0px!important;

}
html{	background-color:#FFF; }

/* The ribbon */

.ribbon {
    width: 120px;
    height: 50px;
    background-color: black;
    position: absolute;
    right: -7px;
    top: -300px;
	border-radius:25px 0px 0px 25px;
    -webkit-animation: drop forwards 0.8s 1s cubic-bezier(0.165, 0.84, 0.44, 1);
    animation: drop forwards 0.8s 1s cubic-bezier(0.165, 0.84, 0.44, 1);
}




@keyframes drop{
	0%		{ top:-300px; }
	100%	{ top:-17px; }
}
  </style>
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

	 function printDiv() {
             var printContents = document.getElementById("printArea").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
        }
		</script>
			</div>
			      <div class="col-md-10" style="padding-top:10px;">

               <div class="breadcrumb1 hidden-xs hidden-sm">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep"><i class="fa fa-camera-retro" style="font-size:40px;"></i>
			<span class="breadcrumb__inner">
        <span class="breadcrumb__title"  adr_trans="label_order">Order</span>
        <span class="breadcrumb__desc"  adr_trans="label_fill_order">Fill the order</span>
			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep"><i class="fa fa-calendar" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
        <span class="breadcrumb__title"  adr_trans="label_appointment">Appointment</span>
        <span class="breadcrumb__desc"  adr_trans="label_pick_appointment">Pick appointment</span>

			</span>
		</a>
		<a href="select_products.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>&u=1" id="thirdStep"><i class="fa fa-database" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
        <span class="breadcrumb__title"  adr_trans="label_products">Products</span>
				<span class="breadcrumb__desc"  adr_trans="label_select_products">Select Products</span>

			</span>
		</a>
		<a href="#"  class="btn btn-default" id="fourthStep"><i class="fa fa-file-text-o" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
        <span class="breadcrumb__title"  adr_trans="label_summary">Summary</span>
				<span class="breadcrumb__desc"  adr_trans="label_order_status">Order Status</span>
			</span>
		</a>
	</div>

<div class="breadcrumb1 hidden-md hidden-lg hidden-xl" style="height:50px;">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep">
			<span class="breadcrumb__inner" adr_trans="">
				<span class="breadcrumb__title" adr_trans="">Order</span>

			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="">Appointment</span>


			</span>
		</a>
		<a href="select_products.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>&u=1" id="thirdStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="">Products</span>


			</span>
		</a>
		<a href="#" class="btn btn-primary">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" adr_trans="">Summary</span>

			</span>
		</a><br />
	</div>



          <?php
            $order_id=$_REQUEST['od'];
            $get_summary_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
            $get_summary=mysqli_fetch_array($get_summary_query);
$hs_id=$get_summary['home_seller_id'];

 $homeSeller=mysqli_query($con,"SELECT * from home_seller_info WHERE id='$hs_id'");
            $homeSeller1=mysqli_fetch_array($homeSeller);

          ?>

      <div>
      <div class="col-md-12">

                 <?php
            $photographer_id=@$get_summary['photographer_id'];
            $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
            @$get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
            $photographer_Name=@$get_name["first_name"]."".@$get_name["last_name"];
            ?>


        		<div class="col-md-12" style="border-left:1px solid #DDD;color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;padding:10px;opacity:0.7;border-radius:25px 25px 25px 25px;font-size:14px;width:100%">
				<div class="col-md-12">
				<center>
				 <h3 style="color:green"><i class="fa fa-check-circle" style="color:green;margin-right:15px;font-size:30px;"></i><span adr_trans="label_order_created">Order Created Successfully</span></h3>
			 </center><p align="right"><button type="button" value="click" onclick="printDiv()" style="background:#FFF;color:#000;border:none;border-radius:5px;float:left;margin-left:23px"><i class="fa fa-print"></i></button></p> </div><br />
				<?php

				 $total_cost=mysqli_query($con,"SELECT sum(total_price) as totalPrice from order_products WHERE order_id='$order_id'");
						$total_cost1=mysqli_fetch_array($total_cost);



				?>
<div class="col-md-12"><div class="ribbon" style="padding-left:13px;font-weight:600;padding-top:5px;color:white"><span adr_trans="label_order_value">Order Value</span><br /><span style="padding-left:20px;">$<?php echo $total_cost1['totalPrice']?></span></div></div>

	<div class="row" style="margin:20px;" id="printArea">
					<br>
					<br>
				<div class="col-md-6">
				<p align="left" style="color:#000;font-weight:600;font-size:15px;">Order Details</p>

				<table class="" style="color:#000;font-weight:600;font-size:12px;">
					<tr>
					<td adr_trans="label_order_no">Order #</td><td>:</td><td><?php echo $get_summary['id']; ?></td>
					</tr>
					<tr>
					<td>Reference Number</td><td>:</td><td><?php echo $homeSeller1['reference_number']; ?></td>
					</tr>
				<td adr_trans="label_property_address">Property Address</td><td>:</td><td><?php echo $get_summary['property_address']?></td>
				</tr>
				<tr>
				<td adr_trans="label_floors">No. Of Floors</td><td>:</td><td><?php echo $get_summary['number_of_floor_plans']?></td>
				</tr>
				<tr>
				<td adr_trans="label_area">Area</td><td>:</td><td><?php echo $get_summary['area']?></td>
				</tr>

				<tr>
				<td adr_trans="">Photographer Name</td><td>:</td><td><?php if($get_summary['photographer_id']!=0){echo $photographer_Name;} else{echo 'Not yet selected';}?></td>
				</tr>

				<tr>
				<td adr_trans="label_session_date_time">Session Date & Time</td><td>:</td><td><?php if($get_summary['session_from_datetime']!='0000-00-00 00:00:00') { echo date("d-m-Y H:i a",strtotime($get_summary['session_from_datetime'])); ?>
				 - <?php echo date("d-m-Y H:i a",strtotime($get_summary['session_to_datetime'])); } else { echo "Session not booked yet.";  } ?>
				</td>
				</tr>
				<tr>
				<td adr_trans="label_realtor_name">Realtors Name</td><td>:</td><td>
				  <?php
            $realtorID=$get_summary['created_by_id'];
            $get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtorID'");
            $get_realtor_name=mysqli_fetch_assoc($get_realtor_name_query);
            echo $get_realtor_name1=$get_realtor_name["first_name"]."".$get_realtor_name["last_name"];
            ?>
				</td>
				</tr>
				<tr>
				<td adr_trans="label_realtor_contact">Realtors Contact</td><td>:</td><td><?php echo $get_realtor_name["contact_number"]; ?></td>
				</tr>
				<tr>
				<td adr_trans="label_realtor_email">Realtors Email</td><td>:</td><td><?php echo $get_realtor_name["email"]; ?></td>
				</tr>
				<tr>
				<td adr_trans="label_due_date">Due Date</td><td>:</td><td><?php echo $get_summary['order_due_date']; ?></td>
				</tr>
				<tr>
				<td adr_trans="label_booking_notes">Booking Notes</td><td>:</td><td><?php echo $get_summary['booking_notes']; ?></td>
				</tr>
				<tr>
				<td adr_trans="label_booking_notes">Status</td><td>:</td><td>Created</td>
				</tr>
				</table><br />
				<p adr_trans="label_order_products" align="left" adr_trans="label_order_products"style="color:#000;font-weight:600;font-size:15px;">Products For the Order</p>

				<table style="color:#000;font-weight:600;font-size:12px;">
				<?php

				 $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");

				 $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

            while($product_title=mysqli_fetch_array($get_product))
			{
				?>
				<tr>
				<td><?php echo $product_title['product_title']; ?></td><td>X</td><td><?php echo $product_title['quantity']; ?></td>
				</tr>
				<?php } ?>
				</table>
				</div>
				<div class="col-md-6">
				<p adr_trans="label_homeseller_info" align="left" style="color:#000;font-weight:600;font-size:15px;">Home Seller Info</p>

<table class="" style="color:#000;font-weight:600;font-size:12px;">
				<tr>
				<td adr_trans="label_homeseller_name">Home Seller Name</td><td>:</td><td><?php echo $homeSeller1['name']; ?></td>
				</tr>
				<tr>
				<td adr_trans="label_homeseller_address">Home Seller Address</td><td>:</td><td><?php echo $homeSeller1['address'].",".$homeSeller1['city'];?></td>
				</tr>

				<tr>
				<td adr_trans="label_homeseller_contact">Home Seller Contact</td><td>:</td><td><?php echo $homeSeller1['mobile_number'];?></td>
				</tr>

				<tr>
				<td adr_trans="label_homeseller_email">Home Seller Email</td><td>:</td><td><?php echo $homeSeller1['email'];?></td>
				</tr>

				</table>
				<br />
				<div class="col-md-12" id="googleMap" style="width:100%;height:250px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(59.9139,10.7522),
  zoom:7,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpWF2v01q7IpMiUSICKhd9zndRFb_kxf8&callback=myMap"></script>



				</div>


				</div>


    </div></div>
            </div>
          </section>
                </div>
            </div>
               <?php if($_SESSION["user_type"]!='Photographer') {  ?>
                 <hr class="space m" />
             <p align="center"><a class="anima-button circle-button btn-sm btn mt-3 " href="order_list.php"><i class="fa fa-times"></i><span adr_trans="label_back_to_order">Back to Order</span></a></p>
                <?php } else { ?>
                  <hr class="space m" />
              <p align="center"><a class="anima-button circle-button btn-sm btn mt-3 " href="Photographerorder_list.php"><i class="fa fa-times"></i><span adr_trans="label_back_to_order">Back to Order</span></a></p>
                 <?php } ?>


</div>
<?php
//unset($_SESSION['fromDatetime']);
//unset($_SESSION['toDatetime']);
//unset($_SESSION['date']);
//unset($_SESSION['bn']);
?>
		<?php include "footer.php";  ?>
