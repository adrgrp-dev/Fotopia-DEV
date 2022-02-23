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
  margin-top: 52px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

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

#thirdStep:after {
background-color:#aad1d6;
}

#thirdStep:hover {
background-color:#aad1d6;
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
  #homeseller_label_div
  {
  	margin-left: -5px !important;
  }
  iframe{
  	margin-left: -20px;
  	width: 270px;
  }
  .ribbon{
  	margin-right: 45px;
  }
}
 #homeseller_label_div
  {
  	margin-left: 25px ;
  }


.btn-default
{
color:#000!important;
background:#aad1d6!important;
}
#fourthStep
{
border-radius:0px!important;

}
html{	background-color:#FFF; }

/* The ribbon */

.ribbon {
    width: 100px;
    height: 50px;
    background-color: #AAD1D6;
	  color:#000!important;
    position: absolute;
    right: -33px;
	  z-index:999;
    top: -450px;
	  border-radius:5px 0px 0px 5px;
    -webkit-animation: drop forwards 0.8s 1s cubic-bezier(0.165, 0.84, 0.44, 1);
    animation: drop forwards 0.8s 1s cubic-bezier(0.165, 0.84, 0.44, 1);
	  margin-top:80px;
}




@keyframes drop{
	0%		{ top:-300px; }
	100%	{ top:-17px; }
}
@media print
{
	#homeseller_label{  padding-right: 40px !important; }
	body
	{
		background: #000080!important;
	}
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
         window.onbeforeprint = function(event) { 

          $('#homeseller_label').css("margin-right","40px");

         };
        window.onafterprint = function(event) { 
          $('#homeseller_label').css("margin-right","0px");

         };
		</script>
			</div>
			      <div class="col-md-10" style="background:#F1F3F4">

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
		<a href="#"  class="btn btn-default" id="fourthStep"><i class="fa fa-file-text-o" style="font-size:30px;color:#000;padding-top:10px;"></i>
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
		<a href="#" class="bbtn btn-default">
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
            $photographer_Name=@$get_name["first_name"]." ".@$get_name["last_name"];

            $pcadmin_id=@$get_summary['pc_admin_id'];
            $get_pcadmin_org_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pcadmin_id'");
            @$get_org_name=mysqli_fetch_assoc($get_pcadmin_org_query);
            $Pc_organization=@$get_org_name["organization_name"];
            ?>


        		<div class="col-md-12" style="background:#F1F3F4;width:100%">
				<div class="col-md-12">
					<button type="button" value="click" onclick="printDiv()" style="background:#AAD1D6;;color:#000;border:none;border-radius:5px;float:left;margin-left:0px"><i class="fa fa-print"></i></button> 
				<center>
				 <h4 style="color:green"><i class="fa fa-check-circle" style="color:green;margin-right:15px;font-size:30px;"></i><span adr_trans="label_order_created">Order Created Successfully</span></h4>
			 </center></div><br />
				<?php

				 $total_cost=mysqli_query($con,"SELECT sum(total_price) as totalPrice from order_products WHERE order_id='$order_id'");
						$total_cost1=mysqli_fetch_array($total_cost);



				?>

<div class="col-md-12"><div class="ribbon" style="padding-left:13px;font-weight:600;padding-top:5px;color:white"><span adr_trans="label_order_value">Order Value</span><br /><span style="padding-left:20px;">$<?php echo $total_cost1['totalPrice']?><i class="fa fa-info-circle" style="color:#000;padding-left:5px;" title="Order Value w/o tax and other cost. Please refer order cost for more details."></i></span></div></div>


	<div class="row" style="margin:0px;" id="printArea">
					<hr class="space xs">
				<div class="col-md-6">
				<div style="width: 101%;background:#FFF;padding:10px;border-radius:5px;min-height: 800px;max-height: fit-content;">
				<p align="right" style="color:#000;font-weight:600;font-size:15px;">Order Details</p>

				<table class="" style="color:#000;font-weight:600;font-size:13px;">

					<tr>
					<td  align="right" style="width:150px;font-size:10px;" adr_trans="label_order_no">Order #</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_summary['id']; ?></td>
					</tr>
					<tr>
					<td align="right" style="font-size:10px;" >Assignment Number</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['reference_number']; ?><hr class="space xs"></td>
					</tr>
					<tr>
          <td align="right" style="font-size: 10px;" id="label_property_type" adr_trans="label_property_type">Property Type</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_summary['property_type']?></td>
          </tr>
          <tr>
          <td align="right" style="font-size: 10px;" id="label_floors" adr_trans="label_floors">No. of Floors</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_summary['number_of_floor_plans']?></td>
          </tr>
          <tr>
          <td align="right" style="font-size: 10px;" id="label_area" adr_trans="label_area">Area</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_summary['area']?><hr class="space xs"></td>
          </tr>
					<tr>
				<td  align="right" style="font-size:10px;" adr_trans="label_property_address">Property Address</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_summary['property_address'],",".$get_summary['property_city']."<br>".$get_summary['property_state'].",".$get_summary['property_zip']; ?><hr class="space xs"></td>
				</tr>
				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="">Photo Company Name</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php if($get_summary['pc_admin_id']!=0){echo $Pc_organization;} else{echo 'Not yet selected';}?></td>
				</tr>

				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="">Photographer Name</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php if($get_summary['photographer_id']!=0){echo $photographer_Name;} else{echo 'Not yet selected';}?></td>
				</tr>

				<tr>
        <td align="right" style="font-size: 10px;" id="label_session_date_time" adr_trans="label_session_date_time">Session Date & Time</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php if($get_summary['session_from_datetime']!='0000-00-00 00:00:00') { echo date("d-m-Y H:i a",strtotime($get_summary['session_from_datetime']))." - ". date("d-m-Y H:i a",strtotime($get_summary['session_to_datetime'])); } else { echo "Session not booked yet.";  } ?><hr class="space xs"></td>
        </tr>
        <?php
            $realtorID=$get_summary['created_by_id'];
            $get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtorID'");
            $get_realtor_name=mysqli_fetch_assoc($get_realtor_name_query);
            $get_realtor_name1=$get_realtor_name["first_name"]." ".$get_realtor_name["last_name"];
         ?>
         <tr>
				<td  align="right" style="font-size:10px;" adr_trans="">Realtor Organization</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo @$get_realtor_name["organization_name"]; ?></td>
				</tr>
				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="label_realtor_name">Realtors Name</td><td style="padding-left:5px;padding-right:15px;">:</td><td>
				  <?php
            echo $get_realtor_name1;
            ?>
				</td>
				</tr>
				
				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="label_realtor_phone">Realtors Phone</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_realtor_name["contact_number"]; ?></td>
				</tr>
				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="label_realtor_email">Realtors Email</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $get_realtor_name["email"]; ?></td>
				</tr>
				<tr>
				<td  align="right" style="font-size:10px;" adr_trans="label_due_date">Due Date</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo date("d-m-Y",strtotime($get_summary['order_due_date'])); ?><hr class="space xs"></td>
				</tr>
				
				<tr>
				<td align="right" style="font-size:10px;" adr_trans="label_status">Status</td><td style="padding-left:5px;padding-right:15px;">:</td><td>  <?php $status=$get_summary['status_id']; if($status==1) { echo "<span adr_trans='label_created' style='width:60px;color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Created</span>"; } elseif($status==2){echo "<span adr_trans='label_wip' style='width:60px;color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>WIP</span>";} ?></td>
				</tr>
				</table>
				 <hr class="space s">
       
				<p align="left" adr_trans=""style="color:#000;font-weight:600;font-size:15px;">Products Ordered</p>
					<hr class="space xs">
				<table style="color:#000;font-weight:600;font-size:12px;min-height:50px">
				<?php

				 $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");

				 $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

            while($product_title=mysqli_fetch_array($get_product))
			{
				?>
				<tr>
				<td><?php echo $product_title['product_title']; ?></td><td>&nbsp;&nbsp;X&nbsp;&nbsp;</td><td><?php echo $product_title['quantity']; ?></td>
				</tr>
				<?php } ?>
				</table>
					<br>
				 <p id="" adr_trans="" align="left" style="color:#000;font-weight:600;font-size:15px;">Booking Notes</p>
				 <hr class="space xs">
        <table style="color:#000;font-weight:600;font-size:12px;white-space:pre-wrap">

          <tr>

        <td style="text-align: justify;"><?php echo $get_summary['booking_notes']; ?><hr class="space xs"></td>

        </tr>

        </table>
			</div>
				</div>
				<div class="col-md-6">
					<div style="width: 105%;background:#FFF;padding:10px;border-radius:5px;height:800px;" id="homeseller_label_div">
				<p adr_trans="label_homeseller_info" id="homeseller_label" align="right" style="color:#000;font-weight:600;font-size:15px;">Home Seller Info</p>

<table class="" style="color:#000;font-weight:600;font-size:13px;">
				<tr>
				<td align="right" style="font-size:10px;" adr_trans="label_homeseller_name">Home Seller Name</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['name']; ?></td>
				</tr>
				<tr>
        <td align="right" style="font-size: 10px;" id="label_homeseller_address" adr_trans="label_homeseller_address">Home Seller Address</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['address'].",<br>".$homeSeller1['city'].", ".$homeSeller1['state'];?></td>
        </tr>

				<tr>
				<td align="right" style="font-size:10px;" adr_trans="label_homeseller_phone">Home Seller Phone</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['mobile_number'];?></td>
				</tr>

				<tr>
				<td align="right" style="font-size:10px;" adr_trans="label_homeseller_email">Home Seller Email</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['email'];

$propAddress=$get_summary['property_address']." ".$get_summary['property_zip']." ".$get_summary['property_city']." Norway ";  
  $propAddress=str_replace(",","",$propAddress);
  $propAddress=str_replace(" ","+",$propAddress); 

			?>
				
				<hr class="space s">
			</td>
				</tr>

<?php  if (!empty($homeSeller1['contact_person_name'])) { ?>
				<tr>
				<td align="right" style="font-size:10px;" adr_trans="">Additional Contact Name</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['contact_person_name'];?></td>
				</tr>

<?php } ?>

<?php  if (!empty($homeSeller1['contact_person_email'])) { ?>
				<tr>
				<td align="right" style="font-size:10px;" adr_trans="">Additional Contact Email</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['contact_person_email'];?></td>
				</tr>
	<?php } ?>

			
<?php  if (!empty($homeSeller1['contact_person_mobile'])) { ?>
				<tr>
				<td align="right" style="font-size:10px;" adr_trans="">Additional Phone</td><td style="padding-left:5px;padding-right:15px;">:</td><td><?php echo $homeSeller1['contact_person_mobile'];?></td>
				</tr>
<?php } ?>



				</table>
				<br />


				<div class="col-md-12">
  <iframe width="380" height="450" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=<?php echo $propAddress; ?>&key=<?php echo $_SESSION['googleMapApiKey']; ?>"></iframe>
</div> 

				



  </div>
				</div>


				</div>


    </div></div>
            </div>
          </section>
                </div>
            </div>
               <?php if($_SESSION["user_type"]!='Photographer') {  ?>
                 <hr class="space m" />
             <p align="center"><a style="background-color: #AAD1D6;color: #000;border-color: #AAD1D6;" class="anima-button circle-button btn-sm btn mt-3 adr-save" href="order_list.php"><i style="color:black" class="fa fa-times"></i><span adr_trans="label_back_to_order">Back to Order</span></a></p>
                <?php } else { ?>
                  <hr class="space m" />
              <p align="center"><a style="background-color: #AAD1D6;color: #000;border-color: #AAD1D6;" class="anima-button circle-button btn-sm btn mt-3 adr-save" href="Photographerorder_list.php"><i style="color:black" class="fa fa-times"></i><span adr_trans="label_back_to_order">Back to Order</span></a></p>
                 <?php } ?>


</div>
<?php
//unset($_SESSION['fromDatetime']);
//unset($_SESSION['toDatetime']);
//unset($_SESSION['date']);
//unset($_SESSION['bn']);
?>
		<?php include "footer.php";  ?>
