<?php
ob_start();

include "connection1.php";



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


	.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}

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

		th,td
		{
		padding:5px!important;
		text-align:left!important;
		}


</style>
<?php include "header.php";  ?>

 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">

	   <?php include "sidebar.php";  ?>

                </div>
<style>

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
<div class="col-md-10" >
<div class="tab-box" data-tab-anima="show-scale">
  <h5 align="center"  adr_trans="label_list_order">List of Orders</h5>
   <!-- <p align="right" style="position: absolute;right: 15px;" > -->
    <?php
$pht = $_SESSION['loggedin_id'];
?>
       <!--  <a href="create_order.php?photographer_id=<?php //echo $pht;  ?>" class="anima-button circle-button btn-sm btn"><i class="fa fa-calendar"></i> Create New Order</a> -->
        <!-- </p> -->
<ul class="nav nav-tabs">
<li  class="active"><a href="#tab1" id="click1" adr_trans="label_ongoing_orders">On Going Orders</a></li>
<li ><a href="#tab2" id="click2" adr_trans="label_completed_orders">Completed Orders</a></li>
</ul>

<div class="panel active" id="tab1">

<p style="text-align: center;"><?php if(@isset($_REQUEST["s"])) { ?>

           <span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500" adr_trans="label_order_created">Order Created successfully</span>
                <hr class="space s" />
            <?php } ?>
           <!-- <?php if(@isset($_REQUEST["c"])) {
              echo "<script>$('#tab2').addClass('active');$('#tab1').removeClass('active'); </script>";
            } ?> -->

        <div >
<div id="" style="width:100%;overflow:scroll;">
      <table class="" aria-busy="false" width="100%">
          <thead>
              <tr><th  class="text-left" style="" id="label_s.no"  ><span adr_trans="label_s.no">
                          Order#

                 </span></th>
								 <th  class="text-left" style="" id="label_homeseller" ><span adr_trans="label_created_by">Created By</span> / <br /><span adr_trans="label_realtor_name">
                          Realtor Name

                  </span></th>
								 <th  class="text-left" style="" id="label_homeseller" ><span adr_trans="label_homeseller">
                          Homeseller Name

                  </span></th>
                  <!-- <th  class="text-center" style="">
                          Photographer
                  </th> -->

								<th  class="text-left" style="" id="label_from_date_time" ><span adr_trans="label_from_date_time">
                          From date & time
                 </span></th>
                 <th  class="text-left" style="" ><span adr_trans="label_due_date">
                          Due date
                 </span></th>
                 <!-- <th  class="text-center" style="" id="label_created_by" adr_trans="label_created_by">
                           Created By
               </th> -->
							 <th  class="text-left" style="" id="label_status" ><span adr_trans="label_status">
                           Status
                 </span></th><th  class="text-left" style="" id="label_details" ><span adr_trans="label_details">
                           Details

                 </span></th>

							 </tr>
          </thead>
          <?php
          $loggedin_id=$_SESSION["loggedin_id"];
            //  ---------------------------------  pagination starts ---------------------------------------
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
          $q1="SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' and status_id not in(1,3,5,6,7)";
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
          $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id not in(1,3,5,6,7) order by id desc limit $limit");
          if($get_order_query == "0"){

            ?><h5 align="center"> <?php echo "No Orders Yet";?> </h5>
          <?php

          $start_no_users = -1;
          }
          else{
             $cnt = 0;
          while($get_order=mysqli_fetch_array($get_order_query))
          {
          $cnt++;
          ?>
          <tr >
          <td class="text-left" style=""><?php echo $get_order['id']; ?></td>
					<?php
					
					$created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $created_by_type=$get_order['created_by_type'];
						   $createdByQr="";
						   if($created_by_type=='CSR' || $created_by_type=='PCAdmin')
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
          $get_realtor_name_query=mysqli_query($con,$createdByQr);
					
					$get_name=mysqli_fetch_assoc($get_realtor_name_query);
					$realtor_name=@$get_name["first_name"]."".@$get_name["last_name"];
					?>
					<td class="text-left" style=""><?php echo $realtor_name ?></td>
          <td class="text-left" style="word-break:break-all;"><?php

       $home_seller_id=$get_order['home_seller_id'];
       $Home_seller=mysqli_query($con,"select * from home_seller_info where id='$home_seller_id'");
       $Home_seller_detail=mysqli_fetch_array($Home_seller);
       echo $Home_seller_detail['name'];


      ?></td>

          <?php
          $photographer_id=$get_order['photographer_id'];
          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
          ?>

            <td class="text-left" style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
          <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

          <td class="text-left" style=""><?php $status=$get_order['status_id']; if($status==1) { echo "<span adr_trans='label_created' style='color:green;font-weight:bold;'>Created</span>"; }elseif($status==2){echo "<span adr_trans='label_wip' style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span adr_trans='label_completed' style='color:green;font-weight:bold;'>completed</span>";} elseif($status==4){echo "<span adr_trans='label_rework' style='color:red;font-weight:bold;'>Rework</span>";} elseif($status==5){echo "<span style='color:red;font-weight:bold;'>Cancelled</span>";}  elseif($status==6){echo "<span adr_trans='label_declined' style='color:red;font-weight:bold;'>Declined</span>";} elseif($status==7){echo "<span adr_trans='label_working_customer' style='color:red;font-weight:bold;'>Waiting for Customer</span>";} else { } ?></td>
          <td class="text-left" style=""><a target="" href="photographerorder_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
          <i class="fa fa-external-link"></i></a></td>


          </tr>
          <?php }} ?>
              </table>

</div>

       </div>
       <?php if(@isset($_REQUEST["c"])) { ?>
         <script>$(document).ready(function() {
         $("#tab1").removeClass("active");
         $("#click2").click();
         $("#tab2").addClass("active");
       });
          </script>
      <?php } ?>

                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                            <div class="row"><div class="col-sm-6">
                              <ul class="pagination">
                                <li class="first disabled" aria-disabled="true"><a href="./photographerorder_list.php?page=1" class="button">«</a></li>
                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($Page_check);?>" class="button ">»</a></li></ul></div>
                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php echo $start_no_users+1; ?> <span adr_trans="label_to">to</span> <?php echo $cnt; ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                                </div>
                              </div>
                            </div>


</div>

<div class="panel" id="tab2">

<p style="text-align: center;"><?php if(@isset($_REQUEST["s"])) { ?>

           <span align="center" class="alert" style="font-style:italic;color:#009900;font-weight:500">Order Created successfully</span>
                <hr class="space s" />
            <?php } ?>
        <div>


<div id="" style="width:100%;overflow:scroll;">
      <table class="" aria-busy="false" style="width:100%">
          <thead>
						<tr><th  class="text-left" style="" id="label_s.no"  ><span adr_trans="label_s.no">
												Order#

							 </span></th>
							 <th  class="text-left" style="" id="label_homeseller" ><span adr_trans="label_created_by">Created By</span> / <br /><span adr_trans="label_realtor_name">
												Realtor Name

								</span></th>
							 <th  class="text-left" style="" id="label_homeseller" ><span adr_trans="label_homeseller">
												Homeseller Name

								</span></th>
								<!-- <th  class="text-center" style="">
												Photographer
								</th> -->

							<th  class="text-left" style="" id="label_from_date_time" ><span adr_trans="label_from_date_time">
												From date & time
							 </span></th>
							 <th  class="text-left" style="" ><span adr_trans="label_due_date">
												Due date
							 </span></th>
							 <!-- <th  class="text-center" style="" id="label_created_by" adr_trans="label_created_by">
												 Created By
						 </th> -->
						 <th  class="text-left" style="" id="label_status" ><span adr_trans="label_status">
												 Status
							 </span></th><th  class="text-left" style="" id="label_details" ><span adr_trans="label_details">
												 Details

							 </span></th>

							 </tr>
          </thead>
          <?php
          $loggedin_id=$_SESSION["loggedin_id"];
            //  ---------------------------------  pagination starts ---------------------------------------
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
          $q1="SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' and status_id='3'";
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
          $get_order_query=mysqli_query($con,"SELECT * FROM orders where (photographer_id='$loggedin_id' or created_by_id='$loggedin_id') and status_id='3' order by id desc limit $limit");
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
          <td class="text-left" style=""><?php echo $get_order['id']; ?></td>
					<?php
					$created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
						   $csr_id=$get_order['csr_id'];
						   $created_by_type=$get_order['created_by_type'];
						   $createdByQr="";
						   if($created_by_type=='CSR' || $created_by_type=='PCAdmin')
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
          $get_realtor_name_query=mysqli_query($con,$createdByQr);
					
					$get_name=mysqli_fetch_assoc($get_realtor_name_query);
					$realtor_name=$get_name["first_name"]."".$get_name["last_name"];
					?>
					<td class="text-left" style=""><?php echo $realtor_name ?></td>
          <td class="text-left" style="word-break:break-all;"><?php

       $home_seller_id=$get_order['home_seller_id'];
       $Home_seller=mysqli_query($con,"select * from home_seller_info where id='$home_seller_id'");
       $Home_seller_detail=mysqli_fetch_array($Home_seller);
       echo $Home_seller_detail['name'];


      ?></td>

          <?php
          $photographer_id=$get_order['photographer_id'];
          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
          ?>

          <td class="text-left" style=""><?php echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); ?></td>
          <td class="text-left" style=""><?php echo date('d/m/Y ',strtotime($get_order['order_due_date'])); ?></td>

					<td class="text-left" style=""><?php $status=$get_order['status_id']; if($status==1) { echo "<span adr_trans='label_created'style='color:green;font-weight:bold;'>Created</span>"; }elseif($status==2){echo "<span adr_trans='label_wip' style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span adr_trans='label_completed' style='color:green;font-weight:bold;'>completed</span>";} elseif($status==4){echo "<span adr_trans='label_rework' style='color:red;font-weight:bold;'>Rework</span>";}?></td>

          <td class="text-left" style=""><a target="" href="photographerorder_detail.php?id=<?php echo $get_order['id']; ?>" class="link">
          <i class="fa fa-external-link"></i></a></td><td class="text-left" style="font-size: 13px;">


          </tr>

          <?php }} ?>
              </table>
</td>


       </div>

                          <div id="undefined-footer" class="bootgrid-footer container-fluid">
                            <div class="row"><div class="col-sm-6">
                              <ul class="pagination">
                                <li class="first disabled" aria-disabled="true"><a href="./photographerorder_list.php?page=1" class="button">«</a></li>
                                <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                                <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                <li class="next disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                                <li class="last disabled" aria-disabled="true"><a href="<?php echo "./photographerorder_list.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
                                <div class="col-sm-6 infoBar"style="margin-top:24px">
                                <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php echo $start_no_users+1; ?> <span adr_trans="label_to">to</span> <?php echo $cnt; ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                                </div>
                              </div>
                            </div>










</div>



	</div>
</div>


	</div>


	</div>

  	</div>


		<?php include "footer.php";  ?>
