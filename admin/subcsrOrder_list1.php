<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION['admin_loggedin_id'];


?>
<style>
@media only screen and (max-width: 600px) {

.mob-i{

  margin-left: -40px!important;
}
td
{
min-width:100px!important;
}
#label_list_order
{
  margin-bottom: 50px;
}
#label_create_new_order 
{
  margin-top:-40px;
  right: 10%;
}
.infobar
{
      margin-top: -23px !important;
    margin-right: -50px;
}
.nav-tabs
{
 border: none !important; 
 margin-top: 5px !important ;
}
.view-btn{
 
   margin-left:40% !important;
}
.search-field
{
  padding-left: -10px !important;
}
.form-control
{
  width: 95% !important;
}

}
.view-btn{
  display:inline-table;
  float:left;
  margin-left:20px;
  border-radius:20px;
  padding:2px;
  font-size: 12px;
}
.btn-default{
  padding-top: 5px !important;
}
.nav-tabs > li
{
  margin-left: 0px !important;
}
.nav-tabs > li > a:hover
{
  padding-bottom: 8px;
}
.nav-tabs > li.active > a:hover
{
  padding-bottom: 2px;
}


.nav-tabs > li > a
{
  border-radius: 5px!important;
}

.tab-box .nav-tabs li.active 
{
  padding-top: 6px!important;
    padding-bottom: 6px!important;
    padding-left: 0px!important;
    padding-right: 0px!important;
}
th,th > span
{
    background: #aad1d6;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 3px !important;
}
th:first-child,th:last-child
{
  vertical-align: bottom;
}
.infobar .infos p
{
  margin-right: -40px;
}
</style>
<?php
if(isset($_REQUEST['rejectbtn']))
{
$order_id=$_REQUEST['order_id'];
mysqli_query($con,"delete from appointment_updates where order_id='$order_id'");
$get_action_detail_query=mysqli_query($con,"select * from orders where id='$order_id'");
$get_action_detail=mysqli_fetch_assoc($get_action_detail_query);
$photographer_id=$get_action_detail['photographer_id'];

// mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Rejected','$loggedin_name',$loggedin_id,$photographer_id,$loggedin_id,now())");

header("location:subcsrOrder_list1.php?rej=1");
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

// mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Approved','$loggedin_name',$loggedin_id,$photographer_id,$loggedin_id,now())");

mysqli_query($con,"delete from appointment_updates where order_id='$order_id'");
header("location:subcsrOrder_list1.php?app=1");
}
?>

<?php include "header.php";  ?>
 <div class="section-empty bgimage8">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
                  <script>
                  function mouseover(d)
                  {
                   $('#showComment'+d).toggleClass("hide");
                  }
                  function mouseover2(d)
                  {
                   $('#showComment'+d).toggleClass("hide");
                  }
                  </script>
				  <style>


</style>

	   <?php include "sidebar.php";  ?>

                </div>
                <div class="col-md-10" style="padding-left:30px;margin-top: 23px;">
                <div class="tab-box" data-tab-anima="show-scale">
                 
                  <p align="right" style="position: absolute;right: 15px;" >
                      <?php
                       $csr_id=$_SESSION['admin_loggedin_id'];
                        $get_pcadmin_query=mysqli_query($con,"select * from admin_users where id=$csr_id");
                        $get_pcadmin=mysqli_fetch_array($get_pcadmin_query);
                        $pc_admin_id=$get_pcadmin['pc_admin_id'];
                      ?>
                       <a href="photographerCalendar1.php?pc_admin_id=<?php echo $pc_admin_id;?>&csr_id=<?php echo $csr_id; ?>" style="margin-top: 3px;" id="label_create_new_order" adr_trans="label_create_new_order" class="anima-button circle-button btn-sm btn adr-save"><i class="fa fa-calendar"></i> Create New Order</a>
                        </p>
                <ul class="nav nav-tabs">
                  <li class="active current-active" id="click3"><a href="#tab3" ><span id="label_new_orders" adr_trans="label_new_orders">New Orders</span></a></li>
                  <li id="click4"><a href="#tab4"><span id="label_neworder_appointment" adr_trans="label_neworder_appointment">New orders With Appointment</span></a></li>
                <li  id="click1"><a href="#tab1" ><span id="label_ongoing_orders" adr_trans="label_ongoing_orders">On Going Orders</span></a></li>
                <li id="click2"><a href="#tab2" ><span id="label_completed_orders" adr_trans="label_completed_orders">Completed Orders</span></a></li>
                </ul>
                <div class="panel active" id="tab3">

            

                <p style="text-align: center;">
                <?php if(@isset($_REQUEST["s"])) { ?>

                <span  id="label_order_created" adr_trans="label_order_created"align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500">Order Created successfully<br /><br /></span>

                <?php } ?>
                <?php if(@isset($_REQUEST["rej"])) { ?>

                <span  id="label_order_reject" adr_trans="label_order_reject" align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500">Order changes has been rejected successfully<br /><br /></span>

                <?php } ?>
                <?php if(@isset($_REQUEST["app"])) { ?>

                <span id="label_order_approved" adr_trans="label_order_approved"  align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500">Order changes has been approved successfully<br /><br /></span>

                <?php } ?>
                <?php if(@isset($_REQUEST["rate"])) { ?>

                <span id="label_rating_provided" adr_trans="label_rating_provided" align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500">Rating provided successfully<br /><br /></span>

                <?php } ?>



                  <div  style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
                      <table class="table-striped" aria-busy="false" style="width:99% !important">
                          <thead>
                              <tr><th  class="text-left" style=""><span class="text" id="label_order_no" adr_trans="label_order_no">

                                          Order#

                                  </span>
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor" >

                                          Realtor

                                  </span>
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_homeseller" adr_trans="label_homeseller" >

                                          Homeseller

                                  </span>

                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_photographer" adr_trans="label_photographer">

                                          Photographer

                                  </span>

                          <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_product" adr_trans="label_product">

                                          Product

                                  </span> -->
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_address" adr_trans="label_address">

                                          Address

                                  </span>


                                  <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_from_date" adr_trans="label_from_date">

                                          Schedule date

                                  </span> -->
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_due_date" adr_trans="label_due_date">

                                          Due date

                                  </span>
                                  <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text">

                                           Created By

                                  </span> -->
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                           Status

                                  </span>
                                  <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_edit_details" adr_trans="label_edit_details">

                                           Edit Details

                                  </span>
</a></th>
                                </tr>
                          </thead>
                          <?php
                          $loggedin_id=$_SESSION['admin_loggedin_id'];
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
                          if($_SESSION["page"] < 0)
                          {
                            $_SESSION["page"]=1;
                          }
                          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
                          $q1="SELECT count(*) as total FROM orders where csr_id=$loggedin_id and session_from_datetime='0000-00-00 00:00:00' and status_id in(1,6,7,5) ";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $total_no=$data['total'];
                          $number_of_pages=50;
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
                          $get_order_query=mysqli_query($con,"SELECT * FROM orders where csr_id=$loggedin_id and session_from_datetime='0000-00-00 00:00:00' and status_id in(1,6,7,5)  order by id desc limit $limit");
                          if($get_order_query == "0"){

                            ?><tr><td colspan="8" style="padding:10px"><h5 id="label_no_order" adr_trans="label_no_order" align="center"> <?php echo "No Orders Yet";?> </h5></td></tr>
                          <?php
                          $cnt = 0;
                          $start_no_users = -1;
                          }
                          else{
                          while($get_order=mysqli_fetch_array($get_order_query))
                          {
                          $cnt++;
                          ?>
                          <tr class="listPageTR">
                          <td class="text-left" style=""><?php echo @$get_order['id']; ?></td>
                          <?php
						  $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $createdByQr="";
						   if($created_by_id==$pcAdminId || $created_by_id==$csr_id)
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
                          $get_realtor_name_query=mysqli_query($con,$createdByQr);
                         if(  $get_name=mysqli_fetch_assoc($get_realtor_name_query))
                         {
                          $realtor_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                         }
                           ?>
                          <td class="text-left" style=""><?php echo @$realtor_Name; ?></td>
                          <td class="text-left" style="word-break:break-all;"><?php

                       $home_seller_id=$get_order['home_seller_id'];
                       $Home_seller=mysqli_query($con,"select * from home_seller_info where id='$home_seller_id'");
                       $Home_seller_detail=mysqli_fetch_array($Home_seller);
                        echo $Home_seller_detail['name'];

                      ?></td>


                      <?php

                      $photographer_id=$get_order['photographer_id'];
                      $photographer_Name="--";
                      $online=0;
                      $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                     if(  $get_name=mysqli_fetch_assoc($get_photgrapher_name_query))
                     {
                      $photographer_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                     }

                ?>
                      <td class="text-left" style="word-break:break-all;"><?php echo $photographer_Name; ?>&nbsp;<?php if($online==1) { ?>
                  <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $photographer_Name ?>"></i>
                  <?php } ?></td>


                        <td class="text-left" style="word-break:break-all;"><?php


                      echo $get_order['property_address'];

                    ?></td>

                    <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

                                            <td class="text-left" style="width: 100px;"><a onclick="mouseover(<?php echo $get_order['id']?>)"><?php $status=$get_order['status_id']; if($status==1) { echo "<span id='label_created' adr_trans='label_created' style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Rework</span>";}elseif($status==6){echo "<span id='label_declined' adr_trans='label_declined' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Declined</span>";}elseif($status==7){echo "<span id='label_working_customer' adr_trans='label_working_customer' style='color: #000; font-weight: bold;display: block; background: orange;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Working with Customer</span>";}elseif($status==5){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Cancelled</span>";}?><?php if($status==5||$status==6||$status==7){ echo "  <i class='fa fa-question-circle' style='position: relative;top: -17px;right: -73px;color: black;' aria-hidden='true' title='Click to view the reason'></i>";}?></a></td>
                                                      <td class="text-center" style=""><a target="" href="superOrder_detail.php?id=<?php echo $get_order['id']; ?>" class="link"> <i class="fa fa-pencil fa-lg"></i></a></td>
 
                          </tr>
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
                          <?php
                              if($get_order['status_id']==6||$get_order['status_id']==7||$get_order['status_id']==5)
                              {
                                ?>
                                <tr>
                                  <td class="text-center hide" id="showComment<?php echo $get_order['id']?>" colspan="10" style="background-color: white;
                    color: black;" ><span id='label_comments' adr_trans='label_comments' style="color:red;font-size:13px;">Comment:</span><?php echo @$get_order['comment'];?> </td>
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



                		<?php /*  <tr><td colspan="8" style="padding:5px;">
                		  <table style="width:100%; background:#F7D8B9;padding:5px;" class="table table-bordered" border="1">
                		  <tr><td colspan="5" style="padding:5px;font-weight:600;" id='label_session_change' adr_trans='label_session_change'>Photographer has made changes in the photography session.Kindly review the changes and approve.</td></tr>
                		  <tr style="font-weight:600"><td>&nbsp;</td><td id='label_session_from' adr_trans='label_session_from'>Session From</td><td id='label_session_to' adr_trans='label_session_to'>Session To</td><td id='label_products' adr_trans='label_products'>Products</td><td id='label_notes' adr_trans='label_notes'>Notes</td><td rowspan="3" align="center" style="top:0px;">

                		   <form name="approvereject" method="post" action="">
                		   <input type="submit" name="approvebtn" value="Approve" class="btn btn-primary" /> <br /><br />
                		   <input type="submit" name="rejectbtn" value="Reject" class="btn btn-warning" />
                		   <input type="hidden" name="order_id" value="<?php echo $updates1['order_id']; ?>">
                		   </form>
                		   </td></tr>
                		  <tr><td id='label_actual_date' adr_trans='label_actual_date' style="font-weight:600;">Actual Date</td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo $product_detail['title']; ?></td><td><?php echo $get_order['booking_notes']; ?></td></tr>
                		  <tr><td id='label_changed_photographer' adr_trans='label_changed_photographer' style="font-weight:600;">Changed by Photographer</td><td><?php echo date('d/m/Y H:i',strtotime($updates1['from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($updates1['to_datetime'])); ?></td><td><?php echo $productlist1['title']; ?></td><td><?php echo $updates1['booking_notes']; ?></td></tr>
                		  </table>
                		  </td></tr>*/ ?>
                		  <?php  } ?>
                          <?php } } ?>

                       </table>
                       </div>

                      <?php  ?>
                                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                                            <div class="row"><div class="col-sm-6">
                                              <ul class="pagination">
                                                <li class="first disabled" aria-disabled="true"><a href="./subcsrOrder_list1.php?page=1" class="button">«</a></li>
                                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                               <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
                                                </div>
                                              </div>
                                            </div>


                </div>
                <div class="panel" id="tab4">

        
                 <div  style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">


                      <table class="table-striped" aria-busy="false" style="width:99% !important">
                        <thead>
                            <tr><th  class="text-left" style=""><span class="text" id="label_order_no" adr_trans="label_order_no">

                                        Order#

                                </span

                                >
                                <th  class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                          Realtor

                                    </span
                                    ><span class="icon fa "></span></th></a><th  class="text-left" style=""><span class="text" id="label_homeseller" adr_trans="label_homeseller">

                                        Homeseller

                                </span>

                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_photographer" adr_trans="label_photographer">

                                        Photographer

                                </span>

                        <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_product" adr_trans="label_product">

                                        Product

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_address" adr_trans="label_address">

                                        Address

                                </span>


                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_from_date_time" adr_trans="label_from_date_time">

                                        From date & time

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_due_date" adr_trans="label_due_date">

                                        Due date

                                </span>
                                <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text">

                                         Created By

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                         Status

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_edit_details" adr_trans="label_edit_details">

                                         Edit Details

                                </span>
</a></th>
                              </tr>
                        </thead>
                          <?php
                          $loggedin_id=$_SESSION['admin_loggedin_id'];
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
                          if($_SESSION["page"] < 0)
                          {
                            $_SESSION["page"]=1;
                          }
                          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
                          $q1="SELECT count(*) as total FROM orders where csr_id=$loggedin_id and session_from_datetime!='0000-00-00 00:00:00' and photographer_id!='0' and status_id in(1,6,7,5) ";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $total_no=$data['total'];
                          $number_of_pages=50;
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
                          $get_order_query=mysqli_query($con,"SELECT * FROM orders where csr_id=$loggedin_id and session_from_datetime!='0000-00-00 00:00:00' and photographer_id!='0' and status_id in(1,6,7,5)  order by id desc limit $limit");
                          if($get_order_query == "0"){

                            ?><tr><td colspan="8" style="padding:10px"><h5 align="center" adr_trans="label_no_order"> <?php echo "No Orders Yet";?> </h5></td></tr>
                          <?php
                          $cnt = 0;
                          $start_no_users = -1;
                          }
                          else{
                          while($get_order=mysqli_fetch_array($get_order_query))
                          {
                          $cnt++;
                          ?>
                          <tr class="listPageTR">
                          <td class="text-left" style=""><?php echo $get_order['id'];; ?></td>
                          <?php  $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $createdByQr="";
						   if($created_by_id==$pcAdminId || $created_by_id==$csr_id)
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
                          $get_realtor_name_query=mysqli_query($con,$createdByQr);
                         if(  $get_name=mysqli_fetch_assoc($get_realtor_name_query))
                         {
                          $realtor_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                         }
                           ?>
                          <td class="text-left" style=""><?php echo @$realtor_Name; ?></td>
                          <td class="text-left" style="word-break:break-all;"><?php

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
                      $photographer_Name=$get_name["first_name"]." ".$get_name["last_name"];
                      $online=0;
                     }
                  ?>
                      <td class="text-left" style="word-break:break-all;"><?php echo $photographer_Name; ?>&nbsp;<?php if($online==1) { ?>
                  <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $pc_Name ?>"></i>
                  <?php } ?></td>

                      <td class="text-left" style=""><?php echo $get_order['property_address']; ?></td>


                          <td class="text-left" style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
                          <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

                                          <td class="text-left" style=""><a onclick="mouseover2(<?php echo $get_order['id']?>)"><?php $status=$get_order['status_id']; if($status==1) { echo "<span style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;' id='label_created' adr_trans='label_created'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>Rework</span>";}elseif($status==6){echo "<span id='label_declined' adr_trans='label_declined' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>Declined</span>";}  elseif($status==7){echo "<span id='label_working_customer' adr_trans='label_working_customer' style='color: #000; font-weight: bold;display: block; background: orange;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>Working with Customer</span>";}elseif($status==5){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 75px;padding-bottom: 5px;text-align: center;'>Cancelled</span>";}?><?php if($status==5||$status==6||$status==7){ echo "  <i class='fa fa-question-circle mob-i' style='position: relative;top: -17px;right: -64px;color: black;' aria-hidden='true' aria-hidden='true' title='Click to view the reason'></i>";}?></a></td>
                                                      <td class="text-center" style=""><a target="" href="superOrder_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
                          <i class="fa fa-pencil fa-lg"></i></a></td>

                          </tr>
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
                          <?php
                              if($get_order['status_id']==6||$get_order['status_id']==7||$get_order['status_id']==5)
                              {
                                ?>
                                <tr>
                                  <td class="text-center hide" id="showComment<?php echo $get_order['id']?>" colspan="10" style="background-color: white;
                    color: black;" ><span id='label_comments' adr_trans='label_comments' style="color:red;font-size:13px;">Comment:</span><?php echo @$get_order['comment'];?> </td>
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



                	<?php /*	  <tr><td colspan="8" style="padding:5px;">
                		  <table style="width:100%; background:#F7D8B9;padding:5px;" class="table table-bordered" border="1">
                		  <tr><td colspan="5" id='label_session_change' adr_trans='label_session_change' style="padding:5px;font-weight:600;">Photographer has made changes in the photography session.Kindly review the changes and approve.</td></tr>
                		  <tr style="font-weight:600"><td>&nbsp;</td><td id='label_session_from' adr_trans='label_session_from'>Session From</td><td id='label_session_to' adr_trans='label_session_to'>Session To</td><td id='label_products' adr_trans='label_products'>Products</td><td id='label_notes' adr_trans='label_notes'>Notes</td><td rowspan="3" align="center" style="top:0px;">

                		   <form name="approvereject" method="post" action="">
                		   <input type="submit" name="approvebtn" value="Approve" class="btn btn-primary" /> <br /><br />
                		   <input type="submit" name="rejectbtn" value="Reject" class="btn btn-warning" />
                		   <input type="hidden" name="order_id" value="<?php echo $updates1['order_id']; ?>">
                		   </form>
                		   </td></tr>
                		  <tr><td id='label_actual_date' adr_trans='label_actual_date' style="font-weight:600;">Actual Date</td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo $product_detail['title']; ?></td><td><?php echo $get_order['booking_notes']; ?></td></tr>
                		  <tr><td style="font-weight:600;" id='label_changed_photographer' adr_trans='label_changed_photographer'>Changed by Photographer</td><td><?php echo date('d/m/Y H:i',strtotime($updates1['from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($updates1['to_datetime'])); ?></td><td><?php echo $productlist1['title']; ?></td><td><?php echo $updates1['booking_notes']; ?></td></tr>
                		  </table>
                		  </td></tr> */ ?>
                		  <?php  } ?>
                          <?php } } ?>

                              </table>
                       </div>
                       <?php if(@isset($_REQUEST["o"])) { ?>
                         <script>$(document).ready(function() { $("#tab3").removeClass("active");
                         $("#click1").click();
                         $("#click3").removeClass("active");
                         $("#tab1").addClass("active");

                       });
                          </script>
                      <?php } ?>
                                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                                            <div class="row"><div class="col-sm-6">
                                              <ul class="pagination">
                                                <li class="first disabled" aria-disabled="true"><a href="./subcsrOrder_list1.php?na=1&page=1" class="button">«</a></li>
                                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?na=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?na=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?na=1&page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                               <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
                                                </div>
                                              </div>
                                            </div>

                </div>
                <div class="panel" id="tab1">

                  <div  style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">



                      <table class="table-striped" aria-busy="false" style="width:99% !important">
                        <thead>
                            <tr><th  class="text-left" style=""><span class="text" id="label_order_no" adr_trans="label_order_no">

                                        Order#

                                </span>
                                <th  class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor" >

                                          Realtor

                                    </span
                                    >
                                <span class="icon fa "></span></th></a><th  class="text-left" style=""><span class="text" id="label_homeseller" adr_trans="label_homeseller">

                                        Homeseller

                                </span>

                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_photographer" adr_trans="label_photographer">

                                        Photographer

                                </span>

                        <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_product" adr_trans="label_product">

                                        Product

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_address" adr_trans="label_address">

                                        Address

                                </span>


                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_from_date_time" adr_trans="label_from_date_time">

                                        From date & time

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text">

                                        Due date

                                </span>
                                <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text">

                                         Created By

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                         Status

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_edit_details" adr_trans="label_edit_details">

                                         Edit Details

                                </span>

                              </tr>
                        </thead>
                          <?php
                          $loggedin_id=$_SESSION['admin_loggedin_id'];
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
                          if($_SESSION["page"] < 0)
                          {
                            $_SESSION["page"]=1;
                          }
                          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
                          $q1="SELECT count(*) as total FROM orders where csr_id=$loggedin_id and status_id in (2,4,8) ";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $total_no=$data['total'];
                          $number_of_pages=50;
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
                          $get_order_query=mysqli_query($con,"SELECT * FROM orders where csr_id=$loggedin_id and status_id in (2,4,8)  order by id desc limit $limit");
                          if($get_order_query == "0"){

                            ?><tr><td colspan="8" style="padding:10px"><h5 id="label_no_order" adr_trans="label_no_order" align="center"> <?php echo "No Orders Yet";?> </h5></td></tr>
                          <?php
                          $cnt = 0;
                          $start_no_users = -1;
                          }
                          else{
                          while($get_order=mysqli_fetch_array($get_order_query))
                          {
                          $cnt++;
                          ?>
                          <tr class="listPageTR">
                          <td class="text-left" style=""><?php echo $get_order['id'];; ?></td>
                          <?php   $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $createdByQr="";
						   if($created_by_id==$pcAdminId || $created_by_id==$csr_id)
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
                          $get_realtor_name_query=mysqli_query($con,$createdByQr);
                         if(  $get_name=mysqli_fetch_assoc($get_realtor_name_query))
                         {
                          $realtor_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                         }
                           ?>
                          <td class="text-left" style=""><?php echo @$realtor_Name; ?></td>
                          <td class="text-left" style="word-break:break-all;"><?php

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
                          $photographer_Name=$get_name["first_name"]." ".$get_name["last_name"];
                          $online=0;
                         }

                          ?>
                          <td class="text-left" style="word-break:break-all;"><?php echo $photographer_Name ?>&nbsp;<?php if($online==1) { ?>
                      <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $photographer_Name ?>"></i>
                    <?php } ?></td>
                      <td class="text-left" style=""><?php echo $get_order['property_address'];; ?></td>

                          <td class="text-left" style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
                          <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

                                          <td class="text-left" style=""><?php $status=$get_order['status_id']; if($status==1) { echo "<span id='label_created' adr_trans='label_created' style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Rework</span>";}elseif($status==6){echo "<span id='label_declined' adr_trans='label_declined' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Decline</span>";}elseif($status==8){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;' id='' adr_trans=''>Reopen</span>";}?></td>
                                                      <td class="text-center" style=""><a target="" href="superOrder_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
                          <i class="fa fa-pencil fa-lg"></i></a></td>

                          </tr>
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
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
                		  <tr><td colspan="5" id='label_session_change' adr_trans='label_session_change' style="padding:5px;font-weight:600;">Photographer has made changes in the photography session.Kindly review the changes and approve.</td></tr>
                		  <tr style="font-weight:600"><td>&nbsp;</td><td id='label_session_from' adr_trans='label_session_from'>Session From</td><td id='label_session_to' adr_trans='label_session_to'>Session To</td><td id='label_products' adr_trans='label_products'>Products</td><td id='label_notes' adr_trans='label_notes'>Notes</td><td rowspan="3" align="center" style="top:0px;">

                		   <form name="approvereject" method="post" action="">
                		   <input type="submit" name="approvebtn" value="Approve" class="btn btn-primary" /> <br /><br />
                		   <input type="submit" name="rejectbtn" value="Reject" class="btn btn-warning" />
                		   <input type="hidden" name="order_id" value="<?php echo $updates1['order_id']; ?>">
                		   </form>
                		   </td></tr>
                		  <tr><td id='label_actual_date' adr_trans='label_actual_date' style="font-weight:600;">Actual Date</td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td><td><?php echo $product_detail['title']; ?></td><td><?php echo $get_order['booking_notes']; ?></td></tr>
                		  <tr><td id='label_changed_photographer' adr_trans='label_changed_photographer' style="font-weight:600;">Changed by Photographer</td><td><?php echo date('d/m/Y H:i',strtotime($updates1['from_datetime'])); ?></td><td><?php echo date('d/m/Y H:i',strtotime($updates1['to_datetime'])); ?></td><td><?php echo $productlist1['title']; ?></td><td><?php echo $updates1['booking_notes']; ?></td></tr>
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
                          $("#tab3").removeClass("active");
                       });
                          </script>
                      <?php } ?>
                                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                                            <div class="row"><div class="col-sm-6">
                                              <ul class="pagination">
                                                <li class="first disabled" aria-disabled="true"><a href="./subcsrOrder_list1.php?o=1&page=1" class="button">«</a></li>
                                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?o=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?o=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?o=1&page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                                <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
                                                </div>
                                              </div>
                                            </div>


                </div>

                <div class="panel" id="tab2">

                
<div class="col-md-12" style="float:right">
<form name="searchOrder" method="post" action=""> <a href="subcsrOrder_list1.php?vAll=1" class="btn btn-default view-btn" style="height: 30px;font-size:12px;margin-left: 15px;">Reset Search</a><input type="text" name="searchAddress" value="<?php echo @$_REQUEST['searchAddress']; ?>" class="form-control" style="width:300px;float:right;margin-bottom:20px;height: 30px;font-size:12px;    margin-right: 10px;" placeholder="Search Address / City / Zip / Contact / Email" />
</form>
</div>
                <p style="text-align: center;"><?php if(@isset($_REQUEST["s"])) { ?>

                           <span align="center" class="alert" id="label_order_created" adr_trans="label_order_created" style="font-style:italic;color:#009900;font-weight:500">Order Created successfully</span>

                            <?php } ?>

                  <div  style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">


                      <table class="table-striped" aria-busy="false" style="width:99% !important">
                        <thead>
                            <tr><th  class="text-left" style=""><span class="text" id="label_order_no" adr_trans="label_order_no">

                                        Order#

                                </span
                                >
                                <th  class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                          Realtor

                                    </span
                                    >
                                    <span class="icon fa "></span></th></a><th  class="text-left" style=""><span class="text" id="label_homeseller" adr_trans="label_homeseller">

                                        Homeseller

                                </span>

                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_photographer" adr_trans="label_photographer">

                                        Photographer

                                </span>

                        <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_product" adr_trans="label_product">

                                        Product

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_address" adr_trans="label_address">

                                        Address

                                </span>


                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_from_date_time" adr_trans="label_from_date_time">

                                        From date & time

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_due_date" adr_trans="label_due_date">

                                        Due date

                                </span>
                                <!-- <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text">

                                         Created By

                                </span> -->
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                         Status

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_order_summary" adr_trans="label_order_summary">

                                         Order Summary

                                </span>
                                <span class="icon fa "></span></th><th  class="text-left" style=""><span class="text" id="label_order_cost" adr_trans="label_order_cost">

                                         Order Cost

                                </span></tr>
                        </thead>
                          <?php
                          $loggedin_id=$_SESSION['admin_loggedin_id'];
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
                          if($_SESSION["page"] < 0)
                          {
                            $_SESSION["page"]=1;
                          }
                          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
                          $q1="SELECT count(*) as total FROM orders where csr_id=$loggedin_id and status_id='3'";

		if(@$_REQUEST['searchAddress'])
		  {
		  $searchAddress=$_REQUEST['searchAddress'];
		  $q1="SELECT count(*) as total FROM orders where csr_id=$loggedin_id and status_id='3' and (property_address like '%$searchAddress%' or property_city like '%$searchAddress%' or property_state like '%$searchAddress%' or property_zip like '%$searchAddress%' or property_contact_mobile like '%$searchAddress%' or property_contact_email like '%$searchAddress%')";

		  }

						  $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $total_no=$data['total'];
                          $number_of_pages=50;
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
						  $get_order_query="";
                          if(@$_REQUEST['searchAddress'])
		  {
		  $searchAddress=$_REQUEST['searchAddress'];

		  $get_order_query=mysqli_query($con,"SELECT * from orders where csr_id=$loggedin_id and status_id='3' and (property_address like '%$searchAddress%' or property_city like '%$searchAddress%' or property_state like '%$searchAddress%' or property_zip like '%$searchAddress%' or property_contact_mobile like '%$searchAddress%' or property_contact_email like '%$searchAddress%') order by id desc limit $limit");
		  }
		  else
		  {
						  $get_order_query=mysqli_query($con,"SELECT * FROM orders where csr_id=$loggedin_id  and  status_id='3'  order by id desc limit $limit");
						  }
                           if($get_order_query == "0"){

                            ?><tr><td colspan="10" style="padding:10px"><h5 align="center" id="label_no_order" adr_trans="label_no_order"> <?php echo "No Orders Yet";?> </h5></td></tr>
                          <?php
                           $cnt = 0;
                           $start_no_users = -1;
                          }
                          else{
                          while($get_order=mysqli_fetch_array($get_order_query))
                          {
                          $cnt++;
                          ?>
                          <tr class="listPageTR">
                            <td class="text-left" style=""><?php echo $get_order['id'];; ?></td>
                            <?php $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $createdByQr="";
						   if($created_by_id==$pcAdminId || $created_by_id==$csr_id)
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
                          $get_realtor_name_query=mysqli_query($con,$createdByQr);
                           if(  $get_name=mysqli_fetch_assoc($get_realtor_name_query))
                           {
                            $realtor_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                           }
                             ?>
                            <td class="text-left" style=""><?php echo @$realtor_Name; ?></td>
                            <td class="text-left" style="word-break:break-all;"><?php

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
                            $photographer_Name=$get_name["first_name"]." ".$get_name["last_name"];
                            $online=0;
                           }

                            ?>
                            <td class="text-left" style="word-break:break-all;"><?php echo $photographer_Name ?>&nbsp;<?php if($online==1) { ?>
                        <i class="fa fa-comment" style="color:#006600" data-touserid="<?php echo $photographer_id ?>" data-tousername="<?php echo $photographer_Name ?>"></i>
                      <?php } ?></td>
                        <td class="text-left" style=""><?php echo $get_order['property_address'];; ?></td>

                            <td class="text-left" style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
                            <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

                                            <td class="text-left" style=""><?php $status=$get_order['status_id']; if($status==1) { echo "<span id='label_created' adr_trans='label_created' style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Rework</span>";}elseif($status==6){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Decline</span>";}?></td>
                                                        <td class="text-center" style=""><a target="" href="superOrder_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
                            <i class="fa fa-chevron-circle-right fa-lg"></i></a></td>
                          <?php
                          if($get_order['status_id']==3)
                          {
                           @$approved_check_query=mysqli_query($con,"SELECT * FROM `invoice` where order_id=".$get_order['id']);
                           @$approved_check=mysqli_fetch_assoc(@$approved_check_query);
                              if(@$approved_check['approved']==1)
                               {
                                 echo '<td class="text-center" style="font-size: 18px;"><a target="" href="superOrder_detail.php?c=1&id='.$get_order['id'].'" class="link">
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
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
                          <?php } } ?>


                              </table>
                       </div>
                                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                                            <div class="row"><div class="col-sm-6">
                                              <ul class="pagination">
                                                <li class="first disabled" aria-disabled="true"><a href="./subcsrOrder_list1.php?c=1&page=1" class="button">«</a></li>
                                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?c=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?c=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./subcsrOrder_list1.php?c=1&page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                               <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
                                                </div>
                                              </div>
                                            </div>

                   </div>
                                              </div>
                                            </div>

 <hr class="space l" />

	</div></div>
<?php if(@$_REQUEST["c"] || @$_REQUEST["searchAddress"] || @$_REQUEST['vAll']) { ?>
    <script>$(document).ready(function() {
  $("#click1").removeClass("active");
  $("#click4").removeClass("active");
   $("#click3").removeClass("active");
   $("#tab1").removeClass("active");
   $("#tab4").removeClass("active");
   $("#tab3").removeClass("active");
   $("#click2").click();
   $("#tab2").addClass("active");
  });
     </script>
 <?php } ?>
  <?php if(@isset($_REQUEST["na"])) { ?>
    <script>$(document).ready(function() { $("#tab4").removeClass("active");
    $("#click4").click();
    $("#tab4").addClass("active");
     $("#tab3").removeClass("active");
     
  });
     </script>
 <?php } ?>




		<?php include "footer.php";  ?>
