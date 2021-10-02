<?php
ob_start();

include "connection1.php";


//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
?>
<?php include "header.php";  ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">

                  <h5 class="text-center">Reports</h5>
                  <hr class="space s">
                  <div class="col-md-12">
                      <div class=" tab-box pills" data-tab-anima="fade-left">
                          <ul class="nav nav-pills ">
                              <li class="current-active active"><a class="" style="background:#F0AD4E;color:white;"href="#">Order Reports</a></li>
                              <li class=""><a href="#" style="background:#337AB7;color:white;">Appointment Reports</a></li>
                              <li class=""><a href="#" style="background:#5CB85C;color:white;">Payment Reports</a></li>
                          </ul>
                          <div class="panel active fade-left" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;">
														 	<p align="right"><input type="button" class="btn btn-primary" id="btnExport"  onclick="Orders()"value="Download PDF" style="    margin: -105px -350px 0px 0px;"/></p>
                            <table id="tblCustomersorders" class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false" style="width: 1300px;">
                                  <thead>
                                      <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            S.No

                                          </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">
                                            Property
                                          </span>
                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                           Photographer


                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                         Session Date


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">


                                          Products


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                        Total Value


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                          CreatedBy

                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                                  Status

                                          </span>	</a></th></tr>
                                  </thead>
                                  <tbody>
                          <?php
                                     //	---------------------------------  pagination starts ---------------------------------------
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
                          $q1="select count(*) as total FROM `orders`";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $number_of_pages=5;

                          // total number of user shown in database
                          $total_no=$data['total'];

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
                          $q = "SELECT * FROM `orders` ";
                          $res=mysqli_query($con,$q);
                          while($get_order=mysqli_fetch_array($res))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr data-row-id="0">
                          <td class="text-left" style=""><?php echo $cnt; ?></td>
                          <?php
                            $hs_id=$get_order["home_seller_id"];
                            $get_home_query=mysqli_query($con,"select * from home_seller_info where id=$hs_id");
                            $get_home=mysqli_fetch_assoc($get_home_query);
                           ?>
                          <td class="text-left" style=""><?php echo $get_order["property_type"]; ?> <br><?php echo $get_home["city"].",".$get_home['state'];?></td>
                          <?php
                          $photographer_id=$get_order['photographer_id'];
                          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
                          ?>
                          <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
                          <?php

                            $toexp=explode(" ",$get_order['session_to_datetime']);
                           ?>
                          <td class="text-left" style=""><?php echo $get_order['session_to_datetime']."-".$toexp[1]; ?></td>
                          <?php  $product_id_is=$get_order['product_id'];
                          $product=mysqli_query($con,"select sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value,GROUP_CONCAT(title) as title from products where id in ($product_id_is)");
                           $product_detail=mysqli_fetch_array($product);
                          ?>
                          <td class="text-left" style=""><?php  echo $product_detail['title']; ?></td>
                          <td class="text-left" style=""><?php echo "$".$product_detail['total_value']; ?></td>
                          <?php
                          $created_by_id=$get_order['created_by_id'];
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);
                          $created_name=$get_name_create["first_name"]."".$get_name_create["last_name"];
                          ?>

                          <td class="text-left" style=""><?php echo $created_name; ?></td>
                          <td class="text-left" style=""><?php $status=$get_order['status_id']; if($status==1) { echo "<span style='color:green;font-weight:bold;'>Created</span>"; } elseif($status==2){echo "<span style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span style='color:green;font-weight:bold;'>completed</span>";}elseif($status==4){echo "<span style='color:green;font-weight:bold;'>Rework</span>";} ?></td>

                          </tr>
                          <?php } ?>
                              </table>

															<script type="text/javascript">
																		 function Orders(){
																			html2canvas($('#tblCustomersorders')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("customer-Ordersdetails.pdf");
																					}
																			});
																		}

															</script>
                          </div>
                          <div class="panel fade-left" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;">
														 	<p align="right"><input type="button" class="btn btn-primary" id="btnExport"  onclick="Appointment()"value="Download PDF" style="    margin: -105px -350px 0px 0px;"/></p>
                            <table id="tblCustomersAppointment" class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false" style="width: 1300px;">
                                  <thead>
                                      <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            S.No

                                          </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">
                                            Home Address
                                          </span>
                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                           City


                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                         State


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">


                                          Photographer


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                        Session Date


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                         Products

                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            CreatedBy

                                          </span>	</a></th></tr>
                                  </thead>
                                  <tbody>
                          <?php
                                     //	---------------------------------  pagination starts ---------------------------------------
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
                          $q1="select count(*) as total FROM `orders`";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $number_of_pages=5;

                          // total number of user shown in database
                          $total_no=$data['total'];

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
                          $q = "SELECT * FROM `orders`";
                          $res=mysqli_query($con,$q);
                          while($get_order=mysqli_fetch_array($res))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr data-row-id="0">
                          <td class="text-left" style=""><?php echo $cnt; ?></td>
                          <?php
                            $hs_id=$get_order["home_seller_id"];
                            $get_home_query=mysqli_query($con,"select * from home_seller_info where id=$hs_id");
                            $get_home=mysqli_fetch_assoc($get_home_query);
                           ?>
                          <td class="text-left" style=""><?php echo $get_home["address"];?></td>
                            <td class="text-left" style=""><?php echo $get_home["city"];?></td>
                              <td class="text-left" style=""><?php echo $get_home["state"];?></td>
                          <?php
                          $photographer_id=$get_order['photographer_id'];
                          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
                          ?>
                          <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
                          <?php

                            $toexp=explode(" ",$get_order['session_to_datetime']);
                           ?>
                          <td class="text-left" style=""><?php echo $get_order['session_to_datetime']."-".$toexp[1]; ?></td>
                          <?php  $product_id_is=$get_order['product_id'];
                          $product=mysqli_query($con,"select sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value,GROUP_CONCAT(title) as title from products where id in ($product_id_is)");
                           $product_detail=mysqli_fetch_array($product);
                          ?>
                          <td class="text-left" style=""><?php  echo $product_detail['title']; ?></td>

                          <?php
                          $created_by_id=$get_order['created_by_id'];
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);
                          $created_name=$get_name_create["first_name"]."".$get_name_create["last_name"];
                          ?>

                          <td class="text-left" style=""><?php echo $created_name; ?></td>

                          </tr>
                          <?php } ?>
                              </table>

															<script type="text/javascript">
																		 function Appointment(){
																			html2canvas($('#tblCustomersAppointment')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("customer-Appointmentdetails.pdf");
																					}
																			});
																		}

															</script>

                          </div>
                          <div class="panel fade-left" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;">
                             	<p align="right"><input type="button" class="btn btn-primary" id="btnExport"  onclick="payment()"value="Download PDF" style="    margin: -105px -350px 0px 0px;"/></p>
                            <table id="tblCustomerspayment" class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false" style="width: 1300px;">

                                  <thead>
                                      <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            S.No

                                          </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">
                                            Invoice No
                                          </span>
                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                           Order Reference


                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                         Products


                                          </span>



                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                        Total Value


                                          </span>
                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">


                                        Photographer


                              </span>

                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                          CreatedBy

                                          </span>
                               <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            Date

                               </span>


                              <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                                  Status

                              </span>
															</a></th></tr>
                                  </thead>
                                  <tbody>
                          <?php
                                     //	---------------------------------  pagination starts ---------------------------------------
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
                          $q1="select count(*) as total FROM `orders`";
                          $result=mysqli_query($con,$q1);
                          $data=mysqli_fetch_assoc($result);
                          $number_of_pages=5;

                          // total number of user shown in database
                          $total_no=$data['total'];

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
                          $q2 = "SELECT * FROM `orders` where status_id=3 ";
                          $res2=mysqli_query($con,$q2);
                          while($get_order2=mysqli_fetch_array($res2))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr data-row-id="0">
														<?php
														$order_id=$get_order2['id'];
														$get_invoice_query=mysqli_query($con,"SELECT * FROM `invoice` WHERE order_id=$order_id");
														$get_invoice=mysqli_fetch_assoc($get_invoice_query);
														?>
                          <td class="text-left" style=""><?php echo $cnt; ?></td>
                          <td class="text-left" style=""><?php echo "FOT".$get_invoice['invoice_id']; ?></td>
                          <td class="text-left" style=""><?php echo "FOT#".$get_invoice['order_id']; ?></td>
                          <?php  $product_id_is=$get_order2['product_id'];
                          $product=mysqli_query($con,"select sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value,GROUP_CONCAT(title) as title from products where id in ($product_id_is)");
                           $product_detail=mysqli_fetch_array($product);
                          ?>
                          <td class="text-left" style=""><?php  echo $product_detail['title']; ?></td>
                          <td class="text-left" style=""><?php echo "$".$product_detail['total_value']; ?></td>

                          <?php
                          $photographer_id=$get_order2['photographer_id'];
                          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                          $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
                          ?>
                          <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
                          <?php
                          $created_by_id=$get_order2['created_by_id'];
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);
                          $created_name=$get_name_create["first_name"]."".$get_name_create["last_name"];
                          ?>

                          <td class="text-left" style=""><?php echo $created_name; ?></td>
                            <td class="text-left" style=""><?php echo 1; ?></td>
                          <td class="text-left" style=""><?php $status=$get_order2['status_id']; if($status==1) { echo "<span style='color:green;font-weight:bold;'>Created</span>"; } elseif($status==2){echo "<span style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span style='color:green;font-weight:bold;'>completed</span>";}elseif($status==4){echo "<span style='color:green;font-weight:bold;'>Rework</span>";} ?></td>

                          </tr>
                          <?php } ?>
                              </table>

															<script type="text/javascript">
																     function payment(){
																			html2canvas($('#tblCustomerspayment')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("customer-Paymentdetails.pdf");
																					}
																			});
																		}

															</script>
                          </div>


                      </div>
                  </div>


                </div>


            </div>
        </div>
</div>

		<?php include "footer.php";  ?>
