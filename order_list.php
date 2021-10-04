<?php
ob_start();

include "connection1.php";
$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];
if(@$_REQUEST['filterByStatus']){
  $_SESSION['status']=@$_REQUEST['filterByStatus'];
}




//echo "INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Approved','$loggedin_name',$loggedin_id,$photographer_id,$loggedin_id,now())";
if(isset($_REQUEST['rejectbtn']))
{
$order_id=$_REQUEST['order_id'];



mysqli_query($con,"delete from appointment_updates where order_id='$order_id'");
$get_action_detail_query=mysqli_query($con,"select * from orders where id='$order_id'");
$get_action_detail=mysqli_fetch_assoc($get_action_detail_query);
$photographer_id=$get_action_detail['photographer_id'];

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Rejected','$loggedin_name',$loggedin_id,$photographer_id,$loggedin_id,now())");

header("location:order_list.php?rej=1");
}


if(isset($_REQUEST['approvebtn']))
{
$order_id=$_REQUEST['order_id'];

 $updates=mysqli_query($con,"select * from appointment_updates where order_id='$order_id'");
$updates1=mysqli_fetch_array($updates);
$from_datetime=$updates1['from_datetime'];
$to_datetime=$updates1['to_datetime'];
$due_date=$updates1['due_date'];
$prods=$updates1['products'];
$notes=$updates1['booking_notes'];
$ph_id=$updates1['photographer_id'];

//echo "update appointments set from_datetime='$from_datetime',to_datetime='$to_datetime' where order_id='$order_id'";

mysqli_query($con,"update orders set product_id='$prods',booking_notes='$notes',order_due_date='$due_date' where id='$order_id'");
mysqli_query($con,"update appointments set from_datetime='$from_datetime',to_datetime='$to_datetime' where order_id='$order_id'");
$get_action_detail_query=mysqli_query($con,"select * from orders where id='$order_id'");
$get_action_detail=mysqli_fetch_assoc($get_action_detail_query);
$photographer_id=$get_action_detail['photographer_id'];

mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Approved','$loggedin_name',$loggedin_id,$photographer_id,$loggedin_id,now())");

mysqli_query($con,"delete from appointment_updates where order_id='$order_id'");
header("location:order_list.php?app=1");
}
?>

<?php include "header.php";  ?>
 <div class="section-empty bgimage8">
        <div class="" style="margin-right:10px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">

	   <?php include "sidebar.php";  ?>
     <style>
     .display
     {
       display: block;
     }

	 @media only screen and (max-width: 1280px) {

	td,th
	{
	text-align:center;
	}
	}
	 @media only screen and (max-width: 800px) {



	#flip-scroll table { display: block; position: relative; width: 100%; }
	#flip-scroll thead { display: block; float: left; }
	#flip-scroll tbody { display: block; width: auto; position: relative; overflow-x: auto; white-space: nowrap; }
	#flip-scroll thead tr { display: block; }
	#flip-scroll th { display: block; text-align: left; }
	#flip-scroll tbody tr { display: inline-block; vertical-align: top; }
	#flip-scroll td { display: block; min-height: 1.25em; text-align: left; }


	/* sort out borders */

	#flip-scroll th { border-bottom: 0; border-left: 0; }
	#flip-scroll td { border-left: 0; border-right: 0; border-bottom: 0; }
	#flip-scroll tbody tr { border-left: 1px solid #babcbf; }
	#flip-scroll th:last-child,
	#flip-scroll td:last-child { border-bottom: 1px solid #babcbf; }
}
		th,td
		{
		padding:5px!important;
		text-align:left!important;
		}
		.nav-tabs > li.active > a, .current-active {
    background:#000!important;color:#FFF!important;
    border-radius: 20px 20px 0px 0px;
    opacity: 0.8;


}
.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}
     </style>
     <script>

       function mouseover(d)
       {

         $('#click'+d).toggleClass("hide");

       }
     </script>

                </div>
<div class="col-md-10" >
<div class="tab-box">
  <h5 align="center" adr_trans="label_list_order">List of Orders</h5>
   <p align="right" style="position: absolute;right: 15px;" >
        <!-- <a href="create_order.php" id="label_create_new_order" adr_trans="label_create_new_order" class="anima-button circle-button btn-sm btn"><i class="fa fa-calendar"></i> Create New Order</a> -->
        </p><br /><br />
<ul class="nav nav-tabs">
<li  class="active"><a href="#tab1" id="click1" adr_trans="label_ongoing_orders">On Going Orders</a></li>
<li ><a href="#tab2" id="click2" adr_trans="label_completed_orders">Completed Orders</a></li>
</ul>

<div class="panel active" id="tab1">



<p style="text-align: center;">
<?php if(@isset($_REQUEST["s"])) { ?>

<span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500" adr_trans="label_order_created">Order Created successfully<br /><br /></span>

<?php } ?>
<?php if(@isset($_REQUEST["rej"])) { ?>

<span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500" adr_trans="label_order_reject">Order changes has been rejected successfully<br /><br /></span>

<?php } ?>
<?php if(@isset($_REQUEST["app"])) { ?>

<span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500" adr_trans="label_order_approved">Order changes has been approved successfully<br /><br /></span>

<?php } ?>
<?php if(@isset($_REQUEST["rate"])) { ?>

<span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500" adr_trans="label_rating_provided">Rating provided successfully<br /><br /></span>

<?php } ?>



  <div style="width:100%; overflow:scroll">
<form name="filterStatus" method="post" action="">
<select name="filterByStatus" style="width:200px;margin-bottom:5px;" class="form-control" onchange="this.form.submit();">
<option value="">-- Select Status --</option>
<option value="1" <?php if(@$_REQUEST['filterByStatus']==1||@$_SESSION['status']==1) { echo "selected"; } ?> adr_trans="label_completed">Created</option>
<option value="2" <?php if(@$_REQUEST['filterByStatus']==2||@$_SESSION['status']==2) { echo "selected"; } ?>>Work in progress</option>
<option value="4" <?php if(@$_REQUEST['filterByStatus']==4||@$_SESSION['status']==4) { echo "selected"; } ?>>Rework</option>
<option value="5" <?php if(@$_REQUEST['filterByStatus']==5||@$_SESSION['status']==5) { echo "selected"; } ?>>Cancelled</option>
<option value="6" <?php if(@$_REQUEST['filterByStatus']==6||@$_SESSION['status']==6) { echo "selected"; } ?>>Declined</option>
<option value="7" <?php if(@$_REQUEST['filterByStatus']==7||@$_SESSION['status']==7) { echo "selected"; } ?>>Working with customer</option>
</select>
</form>
      <table class="table-stripped" style="width:100%">
          <thead>
          <tr><th class="text-left"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                          Order#

                  </span>

                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_homeseller" adr_trans="label_homeseller">

                          Homeseller

                  </span>

                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="label_photographer">

                          Photographer

                  </span>
                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photo_company" adr_trans="label_photo_company">

                          Photo Company

                  </span>
                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_address" adr_trans="label_address">

                          Address

                  </span>
<!--
          <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_product" adr_trans="label_product">

                          Product

                  </span> -->


                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_from_date_time" adr_trans="label_from_date_time">

                          From date & time

                  </span>
                  <span class="icon fa "></span></a></th><th class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_due_date">

                          Due date

                  </span>
                  <!-- <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                           Created By

                  </span> -->
                  <span class="icon fa "></span></a></th><th class="text-left" style="width: 100px;"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

                           Status

                  </span>
                  <span class="icon fa "></span></a></th><th class="text-center" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_edit_details" adr_trans="label_edit_details">

                           Edit Details

                  </span>

                </tr>
          </thead>
          <?php
          $loggedin_id=$_SESSION["loggedin_id"];
		  $q1="";

		  $get_order_query="";
            //  ---------------------------------  pagination starts ---------------------------------------
            if(@$_GET["page"]<0)
            {
            $_GET["page"]=1;
            }
          if(empty($_GET["page"]))
          {
            $_SESSION["page"]=1;
          }
          else {
            $_SESSION["page"]=$_GET["page"];
          }
          if($_SESSION["page"] == 0)
          {
            $_SESSION["page"]=1;
          }
          if(@$_SESSION['status']!=0)
            {
              $statusId=@$_SESSION['status'];
           $q1="SELECT count(*) as total FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id='$statusId' and created_by_type='Realtor'";
            }
      elseif(@$_REQUEST['filterByStatus']!=0)
		  {
		  $statusId=$_REQUEST['filterByStatus'];

     $q1="SELECT count(*) as total FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id ='$statusId' and created_by_type='Realtor'";
		}
		else
		{
		 $q1="SELECT count(*) as total FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id !=3 and created_by_type='Realtor'";
		}
          $result=mysqli_query($con,$q1);
          $data=mysqli_fetch_assoc($result);
          $total_no=$data['total'];
          $number_of_pages=5;
          $Page_check=intval($total_no/$number_of_pages);
          $page_check1=$total_no%$number_of_pages;
          if($page_check1 == 0)
          ;
          else {
            $Page_check=$Page_check+1;

          }
          if($Page_check<=$_SESSION["page"])
          {
            $_SESSION["page"]=$Page_check;
          }
            // how many entries shown in page

            //starting number to print the users shown in page
          $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

           $cnt=$start_no_users;


          $limit=$start_no_users . ',' . $number_of_pages;
          if(@$_SESSION['status']!=0)
          {
            $statusId=@$_SESSION['status'];
          $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and  status_id='$statusId' and created_by_type='Realtor' order by id desc limit $limit");
          }
		  elseif(@$_REQUEST['filterByStatus']!=0)
		  {
		  $statusId=$_REQUEST['filterByStatus'];
		    $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and  status_id='$statusId' and created_by_type='Realtor' order by id desc limit $limit");
		  }

		  else
		  {
          $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and  status_id!=3 and created_by_type='Realtor' order by id desc limit $limit");
		  }

          if($get_order_query == "0"){

            ?><h5 align="center"> <?php echo "No Orders Yet";?> </h5>
          <?php
          $cnt = 0;
          $start_no_users = -1;
          }
          else{
          while($get_order=mysqli_fetch_array($get_order_query))
          {
          $cnt++;
          ?>
          <tr>
          <td style=""><?php echo @$get_order['id']; ?></td>

          <td style="word-break:break-all;"><?php

       $home_seller_id=$get_order['home_seller_id'];
       $Home_seller=mysqli_query($con,"select * from home_seller_info where id='$home_seller_id'");
       $Home_seller_detail=mysqli_fetch_array($Home_seller);
        echo $Home_seller_detail['name'];

      ?></td>

          <?php
          $photographer_id=$get_order['photographer_id'];
          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
         if(  $get_name=mysqli_fetch_assoc($get_photgrapher_name_query))
         {
          $photographer_Name=@$get_name["first_name"]."".@$get_name["last_name"];
          $online=$get_name['online_now'];
         }

          ?>
          <td style="word-break:break-all;"><?php echo @$photographer_Name ?>&nbsp;<?php if(@$online==1) { ?>
      <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $photographer_Name ?>"></i>
      <?php } ?></td>
      <?php $pc_admin=$get_order['pc_admin_id'];
      $get_realtor_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin'");
     if($get_name=mysqli_fetch_assoc($get_realtor_name_query))
     {
      $pc_Name=@$get_name["organization_name"];
     }
       ?>
      <td style=""><?php echo @$pc_Name; ?></td>
        <td style=""><?php echo $get_order['property_address'];?></td>


          <td style=""><?php  if($get_order['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>
          <td style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

                          <td style=""><a onclick="mouseover(<?php echo $get_order['id']?>)"><?php $status=$get_order['status_id']; if($status==1) { echo "<span adr_trans='label_created' style='color:green;font-weight:bold;'>Created</span>"; } elseif($status==2){echo "<span adr_trans='label_wip' style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span adr_trans='label_completed' style='color:green;font-weight:bold;'>completed</span>";}elseif($status==4){echo "<span adr_trans='label_rework' style='color:green;font-weight:bold;'>Rework</span>";}elseif($status==6){echo "<span adr_trans='label_declined' style='color:Red;font-weight:bold;'>Declined</span>";}elseif($status==7){echo "<span adr_trans='label_working_customer' style='color:orange;font-weight:bold;'>Working with Customer</span>";}elseif($status==5){echo "<span style='color:red;font-weight:bold;'>Cancelled</span>";}?><?php if($status==5||$status==6||$status==7){ echo "  <i class='fa fa-question-circle' aria-hidden='true' title='Click to view the reason'></i>";}?></a></td>
                                      <td style="" class="text-center"><a target="" href="order_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
          <i class="fa fa-external-link"></i></a></td>

          </tr>
          <?php
          if($get_order['status_id']==6||$get_order['status_id']==7||$get_order['status_id']==5)
          {
            ?>
            <tr>
              <td class="text-center hide" id="click<?php echo $get_order['id']?>" colspan="9" style="background-color: white;
color: black;" ><span style="color:red;font-size:13px;">Comment:</span><?php echo @$get_order['comment'];?> </td>
            </tr>
        <?php  }
      ?>
		  <?php
		  $updates=mysqli_query($con,"select * from appointment_updates where order_id=".$get_order['id']);


		   $exist=mysqli_num_rows($updates);
		  if($exist>0) {


		  $appointment=mysqli_query($con,"select * from appointments where order_id=".$get_order['id']);
		  $appointment1=mysqli_fetch_array($appointment);

		  $updates1=mysqli_fetch_array($updates);

		  $product_id_are=$updates1['products'];
		   $productlist=mysqli_query($con,"select GROUP_CONCAT(title) as title from products where id in ($product_id_are)");
        $productlist1=mysqli_fetch_array($productlist);
		  ?>



		  <tr><td colspan="8" style="padding:5px;">
		  <table style="width:100%; background:#F7D8B9;padding:5px;" class="table table-bordered" border="1">
		  <tr><td colspan="5" style="padding:5px;font-weight:600;">Photographer has made changes in the photography session.Kindly review the changes and approve.</td></tr>
		  <tr style="font-weight:600"><td>&nbsp;</td><td>Session From</td><td>Session To</td><td>Products</td><td>Notes</td><td rowspan="3" align="center" style="top:0px;">

		   <form name="approvereject" method="post" action="">
		   <input type="submit" name="approvebtn" value="Approve" class="btn btn-primary" /> <br /><br />
		   <input type="submit" name="rejectbtn" value="Reject" class="btn btn-warning" />
		   <input type="hidden" name="order_id" value="<?php echo $updates1['order_id']; ?>">
		   </form>
		   </td></tr>
		  <tr><td style="font-weight:600;">Actual Data</td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_to_datetime'])); ?></td><td><?php echo $product_detail['title']; ?></td><td><?php echo $get_order['booking_notes']; ?></td></tr>
		  <tr><td style="font-weight:600;">Changed by Photographer</td><td><?php echo date('d/m/Y H:i',strtotime($updates1['from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($updates1['to_datetime'])); ?></td><td><?php echo $productlist1['title']; ?></td><td><?php echo $updates1['booking_notes']; ?></td></tr>
		  </table>
		  </td></tr>
		  <?php  } ?>
          <?php } } ?>

              </table>
       </div>
       <?php if(@isset($_REQUEST["c"])) { ?>
         <script>$(document).ready(function() { $("#tab1").removeClass("active");
         $("#click2").click();
         $("#tab2").addClass("active");
       });
          </script>
      <?php } ?>
                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                            <div class="row"><div class="col-sm-6">
                              <ul class="pagination" style="background:#000!important;">
                                <li class="first disabled" aria-disabled="true"><a href="./order_list.php?page=1" class="button">«</a></li>
                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                                </div>
                              </div>
                            </div>


</div>

<div class="panel" id="tab2">

<hr class="space s" >


  <div style="width:100%; overflow:scroll">


      <table class="table-striped" aria-busy="false" style="width:100%">
          <thead>
              <tr><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                          Order#

                  </span
                  >
                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_homeseller" adr_trans="label_homeseller">

                          Homeseller

                  </span>

                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="label_photographer">

                          Photographer

                  </span>
                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photo_company" adr_trans="label_photo_company">

                          Photo Company

                  </span>
                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_address" adr_trans="label_address">

                          Address

                  </span>



                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_from_date_time" adr_trans="label_from_date_time">

                          From date & time

                  </span>
                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_due_date">

                          Due date

                  </span>

                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

                           Status

                  </span>
                  <span class="icon fa "></span></a></th><th class="text-center" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_details" adr_trans="label_details">

                           Details

                  </span>
                  <span class="icon fa "></span></a></th><th style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_order_summary" adr_trans="label_order_summary">

                           Order Summary

                  </span></tr>
          </thead>
          <?php
          $loggedin_id=$_SESSION["loggedin_id"];
            //  ---------------------------------  pagination starts ---------------------------------------
            if(@$_GET["page"]<0)
            {
            $_GET["page"]=1;
            }
          if(empty($_GET["page"]))
          {
            $_SESSION["page"]=1;
          }
          else {
            $_SESSION["page"]=$_GET["page"];
          }
          if($_SESSION["page"] == 0)
          {
            $_SESSION["page"]=1;
          }
          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
          $q1="SELECT count(*) as total FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id='3'";
          $result=mysqli_query($con,$q1);
          $data=mysqli_fetch_assoc($result);
          $total_no=$data['total'];
          $number_of_pages=5;
          $Page_check=intval($total_no/$number_of_pages);
          $page_check1=$total_no%$number_of_pages;
          if($page_check1 == 0)
          ;
          else {
            $Page_check=$Page_check+1;

          }
          if($Page_check<=$_SESSION["page"])
          {
            $_SESSION["page"]=$Page_check;
          }
            // how many entries shown in page

            //starting number to print the users shown in page
          $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

           $cnt=$start_no_users;
//           $q = "SELECT *FROM admin_users LIMIT " . $start_no_users . ',' . $number_of_pages;
//           $res=mysqli_query($con,$q);
//           while($res1=mysqli_fetch_array($res))
//           {
// $cnt++;


          $limit=$start_no_users . ',' . $number_of_pages;
          $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and  status_id='3' and created_by_type='Realtor' order by id desc limit $limit");
           if($get_order_query == "0"){

            ?><h5 align="center"> <?php echo "No Orders Yet";?> </h5>
          <?php
           $cnt = 0;
           $start_no_users = -1;
          }
          else{
          while($get_order=mysqli_fetch_array($get_order_query))
          {
          $cnt++;
          ?>
          <tr >
          <td style=""><?php echo @$get_order['id']; ?></td>
          <td style="word-break:break-all;"><?php

       $home_seller_id=$get_order['home_seller_id'];
       $Home_seller=mysqli_query($con,"select * from home_seller_info where id='$home_seller_id'");
       $Home_seller_detail=mysqli_fetch_array($Home_seller);
        echo $Home_seller_detail['name'];

      ?></td>

          <?php
          $photographer_id=$get_order['photographer_id'];
          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
         if(  $get_name=mysqli_fetch_assoc($get_photgrapher_name_query))
         {
          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
          $online=$get_name['online_now'];
         }

          ?>
          <td style="word-break:break-all;"><?php echo @$photographer_Name ?>&nbsp;<?php if(@$online==1) { ?>
      <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $photographer_Name ?>"></i>
      <?php } ?></td>
      <?php $pc_admin=$get_order['pc_admin_id'];
      $get_realtor_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin'");
     if(  $get_name=mysqli_fetch_assoc($get_realtor_name_query))
     {
      $pc_Name=@$get_name["organization_name"];
     }
       ?>
      <td style=""><?php echo @$pc_Name; ?></td>
        <td style=""><?php echo @$get_order['property_address']; ?></td>

          <td style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
          <td style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

        <td class="text-left"  style=""><a onclick="mouseover(<?php echo $get_order['id']; ?>)"><?php $status=$get_order['status_id']; if($status==1) { echo "<span adr_trans='label_created' style='color:green;font-weight:bold;'>Created</span>"; } elseif($status==2){echo "<span adr_trans='label_wip' style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span adr_trans='label_completed' style='color:green;font-weight:bold;'>completed</span>";}elseif($status==4){echo "<span adr_trans='label_rework' style='color:green;font-weight:bold;'>Rework</span>";}elseif($status==6){echo "<span adr_trans='label_declined' style='color:red;font-weight:bold;'>Declined</span>";}elseif($status==7){echo "<span adr_trans='label_working_customer' style='color:orange;font-weight:bold;'>Working With Customer</span>";}?></a></td>
        <td class="text-center" style=""><a target="" href="order_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
          <i class="fa fa-external-link"></i></a></td>
          <?php
          if($get_order['status_id']==3)
          {
           $approved_check_query=mysqli_query($con,"SELECT * FROM `invoice` where order_id=".$get_order['id']);
           @$approved_check=mysqli_fetch_assoc(@$approved_check_query);
              if(@$approved_check['approved']==1)
               {
                 echo '<td class="text-center" style="font-size: 18px;"><a target="" href="order_detail.php?c=1&id='.$get_order['id'].'" class="link">
                 <i class="fa fa-file-text-o " title="View Order Cost"></i></a></td>';
               }
               else {
                 echo '<td class="text-center" style="font-size: 18px;"><a target="" href="#" class="link">
                 <i class="fa fa-file-o " title="Order Cost is not Approved"></i></a></td>';
               }
          }
          else {
            echo '<td class="text-center" style="font-size: 18px;"><a target="" href="#" class="link">
            <i class="fa fa-file-o " title="Order Cost is not Ready"></i></a></td>';
          }

           ?>
          </tr>
          <?php
              if($get_order['status_id']==6||$get_order['status_id']==7)
              {
                ?>
                <tr>
                  <td class="text-center hide" id="click<?php echo $get_order['id']?>" colspan="9" style="background-color: white;
    color: black;" ><span style="color:red;font-size:13px;">Comments:</span><?php echo $get_order['comment'];?> </td>
                </tr>
            <?php  }?>
          <?php } } ?>


              </table>
       </div>
                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                            <div class="row"><div class="col-sm-6">
                              <ul class="pagination" style="background:#000!important;">
                                <li class="first disabled" aria-disabled="true"><a href="./order_list.php?page=1" class="button">«</a></li>
                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./order_list.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                                </div>
                              </div>
                            </div>


  </div>

 </div>
</div>

	</div>



	</div>





		<?php include "footer.php";  ?>
