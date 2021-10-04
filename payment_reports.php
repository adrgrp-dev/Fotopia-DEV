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
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:-15px;">
									<?php

								 	include "sidebar.php";

								 $realtorID=$_SESSION['loggedin_id'];
								 ?>


			</div>
                <div class="col-md-10">


                  <hr class="space s">
                  <div class="col-md-12">

                         <ul class="nav nav-pills" style="margin-left:20px;">
                              <li class="active"><a href="order_reports.php" class="btn btn-default btn-sm " adr_trans="label_order_reports">Order Report</a></li>
                              <li class="active"><a href="payment_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;" adr_trans="label_payment_report">Payment Report</a></li>
                                </ul>
<br />
<script>

function setSecondDate()
  {
var days = 1;
  var d = new Date(document.getElementById("start").value);

 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);
   $("#end").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate()));
  document.getElementById("end").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate());

  }

    function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}

</script>
<form>
<div class="row">
<div class="col-md-3" style="padding-left:30px;">
<p><h5 adr_trans="label_from_date">From Date</h5></p>
<input type="date" id="start" name="starting" class="form-control" style="display:inline-table">
</div>
<div class="col-md-3" style="padding-left:30px;">
<p><h5 adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending" class="form-control" style="">
</div>
<div class="col-md-3" style="margin-top:23px;padding-left:30px;">
    <button type="submit" id="submit" class="btn btn-primary s" style="border-radius:20px 20px 20px 20px;" adr_trans="label_search">Search</button>

                          <a href="#" onclick="payment()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:25px;padding-left:50px;" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:25px;padding-left:10px;" title="Download Excel"></i></a>

  </div>
</div>

</form>
                              <table id="dataTable" class="table table-striped" style="opacity:0.9;width:100%;border-radius:30px 30px 30px 30px!important;">

                                    <thead>
			<tr class="text-center"><th align="center" colspan="9"><center><b adr_trans="label_payment_report"><br />Payment Reports<br /></b></center></th></tr>
                                        <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_s.no">

                                              S.No

                                            </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_order_cost_no">

                                              Order Cost No

                                            </span>
                                            <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_order_reference">

                                             Order Reference

                                            </span>
                                           <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_products">

                                           Products

                                           </span>

                                            <span class="icon fa "></span></a></th>


										<!--	<th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">


                                          Quantity


                                          </span>

                                           <span class="icon fa "></span></a></th>-->


										   <th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_total_value">

                                          Total Value

                                            </span>
                                           <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_photo_company">

                                          Photo Company

                                           </span>
                                            <!-- <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                            Realtor

                                            </span> -->
                                            <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_date_and_time">

                                              Date & Time

                                            </span>

                                <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_status">

                                             Status
                                </span>
  															</a></th></tr>
                                    </thead>
                                    <tbody>
                            <?php
                                       //	---------------------------------  pagination starts ---------------------------------------
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
                            if (isset($_REQUEST['starting']) && isset($_REQUEST['ending']) ){

                            $_SESSION['starting_time'] = $_REQUEST['starting'];
                            $_SESSION['ending_time'] = $_REQUEST['ending'];

                             $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                          if($_SESSION['user_type']=="Realtor")
                           {
                              $q1="select count(*) as total FROM `orders` where status_id=3 AND created_by_id=$realtorID and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders`  WHERE status_id=3 AND created_by_id=$realtorID AND DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
                            }
                          }
                          elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                            if($_SESSION['user_type']=="Realtor")
                           {
                              $q1="select count(*) as total FROM `orders` where status_id=3 AND created_by_id=$realtorID and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'   ORDER BY session_from_datetime asc ";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders`  WHERE status_id=3 AND created_by_id=$realtorID AND DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
                            }
                          }
                          else{

                          if($_SESSION['user_type']=="Realtor")
                           {
                              $q1="select count(*) as total FROM `orders` where created_by_id=$realtorID and status_id=3";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders` where status_id=3 AND created_by_id=$realtorID";
                            }
                          }
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

                             if (isset($_REQUEST['starting']) && isset($_REQUEST['ending']) ){

                             $_SESSION['starting_time'] = $_REQUEST['starting'];
                             $_SESSION['ending_time'] = $_REQUEST['ending'];

                            $start = $_SESSION['starting_time'];
                            $end = $_SESSION['ending_time'] ;

                            if($_SESSION['user_type']=="Realtor"){
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where status_id=3 and created_by_id=$realtorID and
                            DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` WHERE status_id=3 and created_by_id=$realtorID DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           }

                           elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                           if($_SESSION['user_type']=="Realtor"){
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where status_id=3 and created_by_id=$realtorID and
                            DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` WHERE status_id=3 and created_by_id=$realtorID DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);

                           }

                          }

                           else{

                            if($_SESSION['user_type']=="Realtor"){
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where status_id=3 and created_by_id=$realtorID ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` where status_id=3 and created_by_id=$realtorID ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           }

                            if($res2)
														{
                            while(@$get_order2=mysqli_fetch_array($res2))
                            {
                            $cnt++;
                               //	---------------------------------  pagination starts ---------------------------------------
                            ?>
                            <tr data-row-id="0">
															<?php
															$order_id=$get_order2['id'];
															$hs_id=$get_order2['home_seller_id'];

														   $homeSeller=mysqli_query($con,"SELECT * from home_seller_info WHERE id='$hs_id'");
														              $homeSeller1=mysqli_fetch_array($homeSeller);
															 $get_invoiced_name_query=mysqli_query($con,"Select * from invoice where order_id='$order_id'");
															 $get_invoice=mysqli_fetch_array($get_invoiced_name_query);

																					?>
                            <td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
                            <td class="text-left" style=""><?php echo "FOT".$get_invoice['invoice_id']; ?></td>
                            <td class="text-left" style=""><?php echo "FOT#".@$homeSeller1['reference_number']; ?></td>

																											<?php
															$prodName="";
		 $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");
		// echo "select product_id from order_products WHERE order_id='$order_id'";
																						              while($prodsList1=mysqli_fetch_array($prodsList))
																						  			{
																						  				//$prodName.=$prodsList1['product_name'].',';
																										$prodID=$prodsList1['id'];
											$prodQty1 =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id' and product_id='$prodID'");
											$prodQty=mysqli_fetch_array($prodQty1);
								  				$prodName.=$prodsList1['product_name'].'&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;'.$prodQty['quantity'].'<br>';
																										}
																						  				?>
													<?php	$total_cost=mysqli_query($con,"SELECT sum(total_price) as totalPrice from order_products WHERE order_id='$order_id'");
															 $total_cost1=mysqli_fetch_array($total_cost);?>

                            <td class="text-left" style=""><?php  echo @substr($prodName,0,-1); ?></td>

                             <?php
                           $prodQuan="";


                            $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

                              while($product_title=mysqli_fetch_array($get_product))
                        {
                          $prodQuan.=$product_title['quantity'].',';
                        }
                          ?>
                         <?php /* <td class="text-left" style="word-wrap:break-word;width:100px"><?php  echo @substr($prodQuan,0,-1); ?></td> */ ?>
                            <td class="text-left" style=""><?php echo "$".@$total_cost1['totalPrice']; ?></td>
														<?php
	                          $pc_id=$get_order2['pc_admin_id'];
														 $order_id=$get_order2['id'];
	                          $get_pc_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_id'");
	                          $get_name=mysqli_fetch_assoc($get_pc_name_query);
	                          $pc_Name=@$get_name["organization_name"];
	                          ?>
                            <td class="text-left" style=""><?php echo  $pc_Name; ?></td>
                            <!-- <?php
                           $created_by_id=$get_order2['created_by_id'];
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);

                          if ($get_name_create['type_of_user']== 'SuperCSR' || $get_name_create['type_of_user']== 'SubCSR'  ) {

                             $get_create_name_query2 = mysqli_query($con,"SELECT * FROM admin_users where id='$created_by_id'");

                          } else {

                           $get_create_name_query2 = mysqli_query($con,"SELECT * FROM user_login where id='$created_by_id'");
                          }


                          $get_name_create=mysqli_fetch_assoc($get_create_name_query2);
                            $created_name=$get_name_create["first_name"]."".$get_name_create["last_name"];
                            ?>

                            <td class="text-left" style=""><?php echo $created_name; ?></td> -->
                               <?php

                              $toexp=explode(" ",$get_order2['session_to_datetime']);
                             ?>
                            <td class="text-left" style=""><?php  if($get_order2['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order2['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>
                            <td class="text-left" style=""><?php $status=$get_order2['status_id']; if($status==1) { echo "<span style='color:green;font-weight:bold;'>Created</span>"; } elseif($status==2){echo "<span style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span style='color:green;font-weight:bold;'>completed</span>";}elseif($status==4){echo "<span style='color:green;font-weight:bold;'>Rework</span>";} ?></td>

                            </tr>
													<?php } }?>
                                </table>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled" aria-disabled="true"><a href="./payment_reports.php?page=1" class="button adr-save">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:24px">
																		<div class="infos"><p align="right" style="    margin-right: -px;">Showing <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> to <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?> entries</p></div>
																		</div>
																	</div>
																</div>


															<script type="text/javascript">
																		 function payment(){
																			html2canvas($('#dataTable')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("payment_reports.pdf");
																					}
																			});
																		}

															</script>
                          </div>




                  </div>


                </div>

        </div>

<script src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>
<script src="export.js"></script>
		<?php include "footer.php";  ?>
