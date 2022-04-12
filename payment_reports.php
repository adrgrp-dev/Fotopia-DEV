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
<style>
 .nav-pills > li > a{
  padding: 6px;
  }
thead > tr:last-child > th,th > span
{
  background: #aad1d6;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 2px !important;
}
th:last-child > span
{
  vertical-align: text-top;
}
#undefined-footer
{
  background: white !important;
  padding: 0px 25px;
  margin-right: 40px;
}
  </style>
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

                         <ul class="nav nav-pills" style="margin-left:0px;">
                              <li class="active" style="margin-right: 10px;"><a href="order_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;"  adr_trans="label_order_reports">Order Report</a></li>
                              <li class="active"><a href="payment_reports.php" class="btn btn-default btn-sm adr-save"   adr_trans="label_payment_report">Payment Report</a></li>
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
  document.getElementById("end").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+2)+"-"+zeroPadded(d.getDate());

  }

    function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}
function PCAdminSearch()
{
$("#submit").click();

}
function validateDates()
{
var start=$("#submit").val();
var end=$("#end").val();
var pcfilter=$("#pcfilter").val();

if(start=='' && end=='' && pcfilter=='')
{
alert("please select dates or photocompany to search");
return false;
}


if(start!='' && end=='')
{
$("#end").attr("min",start);
alert("please select the To date");
return false;
}
return true;
}
</script>
<form name="searchForm" method="post" action="" onsubmit="return validateDates()">
<div class="row">
<div class="col-md-3" style="padding-left:15px;">
<p><h5 adr_trans="label_from_date">From Date</h5></p>
<input type="date" id="start" name="starting" value="<?php echo @$_REQUEST['starting'];?>"; onchange="setSecondDate();" class="form-control" style="display:inline-table;height:30px;">
</div>
<div class="col-md-3" style="padding-left:10px;">
<p><h5 adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending" value="<?php echo @$_REQUEST['ending'];?>" class="form-control" style="height: 30px;">
</div>
<div class="col-md-3" style="padding-left:10px;">
<p><h5 adr_trans="label_photo_company">Photo Company</h5></p>
<?php
if(!empty($_REQUEST['pcfilter'])){
	//echo $_REQUEST['pcfilter']."<br>";
 $selected_pcadmin_id=@$_REQUEST['pcfilter'];
 $select_organization_query=mysqli_query($con,"select distinct(organization_name) as org,pc_admin_id from photo_company_profile where pc_admin_id=$selected_pcadmin_id");

 $select_organization=@mysqli_fetch_assoc(@$select_organization_query);

}
?>
<input type="text" name="pcfilter" id="pcfilter" class="form-control" placeholder="<?php echo @$select_organization['org'];?>" list="pclist" style="height: 30px;" onchange="PCAdminSearch()"  autocomplete="off" />
<datalist id="pclist">
 <?php
							$city1=mysqli_query($con,"select distinct(organization_name) as org,pc_admin_id from photo_company_profile where pc_admin_id in (select id from admin_users where is_approved=1)");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['pc_admin_id']; ?>"><?php echo $city['org']; ?></option>
							<?php } ?>
</datalist>
</div>
<div class="col-md-3" style="margin-top: 24px;padding-left: 10px;width: 220px;">
    <button type="submit" id="submit" class="btn btn-default btn-sm" style="" adr_trans="label_search">Search</button>

                          <a href="#" onclick="payment()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:25px;padding-left:10px;vertical-align: middle;margin-top: 3px;float: right;" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:25px;padding-left:10px;vertical-align: middle;margin-top: 3px;float: right;" title="Download Excel"></i></a>

  </div>
</div>

</form>
<div style="margin-top: 5px;width:96%;border:solid 1px #fff;background-color:white">
<div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
                              <table id="dataTable" align="center" class="table-striped" style="background:#FFF;color:#000;opacity:0.9;width:96%;margin-top: 10px;">


                                    <thead>
			<!--  -->
                                        <tr><th data-column-id="id" class="text-left" style=""><span class="text" adr_trans="label_s.no">

                                              S.No

                                            </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text" adr_trans="label_order_cost_no">

                                              Order Cost No

                                            </span>
                                            <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="">

                                             Assignment #

                                            </span>
                                           <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" adr_trans="label_products">

                                          Products & Value

                                           </span>
																					 <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" adr_trans="label_otherCost">

                                          Other Cost

                                           </span>
																					 <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" >

																					Tax

																					 </span>

                                            <span class="icon fa "></span></th>


										<!--	<th data-column-id="logo" class="text-left" style=""><span class="text">


                                          Quantity


                                          </span>

                                           <span class="icon fa "></span></th>-->


										   <th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_total_value">

                                          Total Value

                                            </span>
                                           <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_photo_company">

                                          Photo Company

                                           </span>
                                            <!-- <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                            Realtor

                                            </span> -->
                                            <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_date_and_time">

                                              Date & Time

                                            </span>

                                <span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text" adr_trans="label_status">

                                             Status
                                </span>
  															</a></th></tr>
                                    </thead>
                                    <tbody>
                            <?php

							$pc_admin_filter="";
							if(@$_REQUEST['pcfilter'])
							{
							$_SESSION['pcfilter']=$_REQUEST['pcfilter'];


							}
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
                              $q1="select count(*) as total FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID  and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders`  WHERE $pc_admin_filter status_id=3 AND realtor_id=$realtorID AND DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
                            }
                          }
                          elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                            if($_SESSION['user_type']=="Realtor")
                           {
                              $q1="select count(*) as total FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'   ORDER BY session_from_datetime asc ";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders`  WHERE $pc_admin_filter status_id=3 AND realtor_id=$realtorID AND DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
                            }
                          }
                          else{

                          if($_SESSION['user_type']=="Realtor")
                           {
                              $q1="select count(*) as total FROM `orders` where $pc_admin_filter realtor_id=$realtorID and status_id=3";
                            }
                            else {
                              $q1="select count(*) as total FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID ";
                            }
                          }




						  if(empty($_SESSION['starting_time']) && !empty($_SESSION['pcfilter']))
						  {
						  $pcadmin=$_SESSION['pcfilter'];
							$pc_admin_filter="pc_admin_id='$pcadmin' and ";
						   $q1="select count(*) as total FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID ";

						  }

						  if(!empty($_SESSION['starting_time']) && !empty($_SESSION['pcfilter']))
						  {

						  $pcadmin=$_SESSION['pcfilter'];
							$pc_admin_filter="pc_admin_id='$pcadmin' and ";
							 $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;
						   $q1="select count(*) as total FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'";

						  }


                            $result=mysqli_query($con,$q1);
                            $data=mysqli_fetch_assoc($result);
                            $number_of_pages=50;

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
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where $pc_admin_filter status_id=3 and realtor_id=$realtorID and
                            DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` WHERE $pc_admin_filter status_id=3 and realtor_id=$realtorID DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           }

                           elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                           if($_SESSION['user_type']=="Realtor"){
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where $pc_admin_filter status_id=3 and realtor_id=$realtorID and
                            DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` WHERE $pc_admin_filter status_id=3 and realtor_id=$realtorID DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages);

                           }

                          }

                           else{

                            if($_SESSION['user_type']=="Realtor"){
                             $res2=mysqli_query($con,"SELECT * FROM `orders` where $pc_admin_filter status_id=3 and realtor_id=$realtorID ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           else {
                            $res2=mysqli_query($con,"SELECT * FROM `orders` where $pc_admin_filter status_id=3 and realtor_id=$realtorID  ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);
                           }
                           }

 if(empty($_SESSION['starting_time']) && !empty($_SESSION['pcfilter']))
						  {
						  $pcadmin=$_SESSION['pcfilter'];
							$pc_admin_filter="pc_admin_id='$pcadmin' and ";
						   $res2=mysqli_query($con,"select * FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID   ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);

						  }

						  if(!empty($_SESSION['starting_time']) && !empty($_SESSION['pcfilter']))
						  {

						  $pcadmin=$_SESSION['pcfilter'];
							$pc_admin_filter="pc_admin_id='$pcadmin' and ";
							 $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;
						  $res2=mysqli_query($con,"select * FROM `orders` where $pc_admin_filter status_id=3 AND realtor_id=$realtorID and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' ORDER BY id DESC LIMIT " . $start_no_users . ',' . $number_of_pages);

						  }
                            if($res2)
														{
                            while(@$get_order2=mysqli_fetch_array($res2))
                            {
                            $cnt++;
                               //	---------------------------------  pagination starts ---------------------------------------
                            ?>
                            <tr data-row-id="0" class="listPageTR">
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
														$taxpercentage=0;
														 $pc_admin_id=$get_order2['pc_admin_id'];
														 $taxpercent="";

																				    $taxpercent=mysqli_query($con,"select tax from photo_company_profile where pc_admin_id='$pc_admin_id'");


														$available=mysqli_num_rows($taxpercent);
																						if($available>0)
																						{
																					   $taxpercent1=mysqli_fetch_array($taxpercent);
																					   $taxpercentage=$taxpercent1['tax'];
																					   }
														?>
														<?php  $product_id_is=$get_order2['product_id'];

						 //  $product=mysqli_query($con,"select sum(total_price)+sum(photographer_cost)+sum(other_cost) as total_value,GROUP_CONCAT(product_title,' - $',total_price SEPARATOR '<br>') as title from order_products where order_id='$order_id'");

								 $product=mysqli_query($con,"select sum(price*quantity) as total_value,GROUP_CONCAT(product_title,' X ',quantity,' - $',total_price SEPARATOR '<br>') as title from order_products where order_id='$order_id'");

						 // $product=mysqli_query($con,"select * from order_products where order_id=$order_id")
														 $product_detail=mysqli_fetch_array($product);



							 $photography=mysqli_query($con,"select sum(photographer_cost) as photography_value,GROUP_CONCAT(product_title,' - $',photographer_cost SEPARATOR '\n') as photography_title from order_products where order_id='$order_id'");

								$photography1=mysqli_fetch_array($photography);


								$otherCost=mysqli_query($con,"select other_cost from invoice where order_id='$order_id'");
								 $otherCost1=mysqli_fetch_array($otherCost);

								 $totalCostIs=@$product_detail['total_value']+@$otherCost1['other_cost'];
								// echo ""




                 $grandTotal=0;
								 $totalOrderValue=0;
								 $taxation=0;
								 if($taxpercentage==0)
								 {
									$totalOrderValue=$totalCostIs;
								$grandTotal=$grandTotal+$totalOrderValue;
								 }
								 else
								 {
								 $taxation=($totalCostIs*$taxpercentage)/100;
								 $totalOrderValue=$totalCostIs+$taxation;
								 $grandTotal=$grandTotal+$totalOrderValue;
								 }

														?>
														<td class="text-left" style="width:220px;"><?php  echo $product_detail['title']; ?></td>
																<td class="text-left" style=""><?php echo "$".$otherCost1['other_cost']; ?></td>
																	<td class="text-leenterft" style=""><?php echo "$".$taxation; ?></td>




														 <?php
													 $prodQuan="";


														$get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

															while($product_title=mysqli_fetch_array($get_product))
												{
													$prodQuan.=$product_title['quantity'].',';
												}
													?>



                         <?php /* <td class="text-left" style="word-wrap:break-word;width:100px"><?php  echo @substr($prodQuan,0,-1); ?></td> */ ?>
                            <td class="text-left" style=""><?php echo "$".$totalOrderValue; ?></td>
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
                            $created_name=$get_name_create["first_name"]." ".$get_name_create["last_name"];
                            ?>

                            <td class="text-left" style=""><?php echo $created_name; ?></td> -->
                               <?php

                              $toexp=explode(" ",$get_order2['session_to_datetime']);
                             ?>
                            <td class="text-left" style=""><?php  if($get_order2['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order2['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>
                            <td class="text-left" style="padding-right: 10px;"><?php $status=$get_order2['status_id']; if($status==1) { echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Created</span>"; } elseif($status==2){echo "<span style='color:brown;font-weight:bold;'>WIP</span>";}elseif($status==3){echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>completed</span>";}elseif($status==4){echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Rework</span>";} ?></td>

                            </tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
													<?php } }?>
                                </table>
                              </div>
                            </div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled" aria-disabled="true"><a href="./payment_reports.php?page=1" class="button ">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]-1);?>" class="button ">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button "><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]+1);?>" class="button ">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($Page_check);?>" class="button ">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:22px">
																		<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
																		</div>
																	</div>
																</div>


															<!-- <script type="text/javascript">
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

															</script> -->


<script type="text/javascript">
function payment(){
html2canvas($('#dataTable')[0], {
onrendered: function(canvas) {

let splitAt = 1300; 

let images = [];
let y = 0;
while (canvas.height > y) {
images.push(getClippedRegion(canvas, 0, y, canvas.width, splitAt));
y += splitAt;
}
var docDefinition = {
content: images,
pageSize: "LETTER"
};
pdfMake.createPdf(docDefinition).download("Payment_Report.pdf");
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
