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
	<style>

	td
	{
	font-family:verdana;
	font-size:12px;
	font-weight:300;
	}
	th
	{
	font-family:verdana;
	font-size:11px;
	font-weight:bold;
	}
	</style>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row" style="width:100%">
			<hr class="space s">
                <div class="col-md-2">
									<?php	if($_SESSION['admin_loggedin_type']=="SuperCSR"){
								 	include "sidebar.php";
								 } else {
								 	include "sidebar.php";
								 }
								 $supercsr=$_SESSION['admin_loggedin_id'];
								 ?>


			</div>
                <div class="col-md-10">


                  <hr class="space s">
                  <div class="col-md-12" style="width:100%;">

                         <ul class="nav nav-pills" style="margin-left:20px;">
                              <li class="active"><a id="label_order_report" adr_trans="label_order_report" href="order_reports.php" class="btn btn-default btn-sm ">Order Report</a></li>
                              <li class="active"><a id="label_appointment_report" adr_trans="label_appointment_report" href="appointment_reports.php" class="btn btn-default btn-sm ">Appointment Report</a></li>
                              <li class="active"><a id="label_payment_report" adr_trans="label_payment_report" href="payment_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;">Payment Report</a></li>
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
<div class="col-md-3" style="padding-left:15px;">
<p><h5 id="label_from_date" adr_trans="label_from_date" style="padding-left:5px;">From date</h5></p>
<input type="date" onchange="setSecondDate();" id="start" name="starting" class="form-control" style="display:inline-table;">
</div>
<div class="col-md-3" style="padding-left:10px;">
<p><h5 id="label_to_date" adr_trans="label_to_date" style="padding-left:5px;">To date</h5></p>
<input type="date" id="end" name="ending" class="form-control" style="">
</div>
<div class="col-md-3">
<p><h5 id="label_from_date" adr_trans="label_Choose_Realtor" style="padding-left:5px;">Filter By Realtor</h5></p>
<select name="realtor_id" class="form-control" list="realtors_list">
<option value="">-- Choose RealtorCompany --</option>
						<?php

						$selectrealtor=mysqli_query($con,"SELECT organization_name as org,id,type_of_user FROM `user_login` where organization_name!='' and type_of_user='Realtor' and id in(select distinct(created_by_id) from orders)");
						while($selectrealtor1=mysqli_fetch_array($selectrealtor))
						{
						?>
						<option value="<?php echo $selectrealtor1['id']; ?>"><?php echo $selectrealtor1['org']; ?></option>
						<?php } ?>

</select>

</div>
<div class="col-md-3" style="margin-top:23px;padding-left:20px;">
    <button type="submit" id="label_search" adr_trans="label_search" class="btn btn-primary s" style="border-radius:20px 20px 20px 20px;">Search</button>

                          <a href="#" onclick="payment()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:25px;padding-left:30px;" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:25px;padding-left:10px;" title="Download Excel"></i></a>

  </div>
</div>

</form>




  <div style="width:100%;overflow:scroll">
                              <table id="dataTable" class="table-striped" style="opacity:0.9;width:100%;">

                                    <thead>
			<tr class="text-center"><th align="center" colspan="9" style="font-size:15px;"><center><b><br /><span  adr_trans="label_payment_report">Payment Reports</span><br /></b></center></th></tr>
                                        <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                              S.No

                                            </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_order_cost_no" adr_trans="label_order_cost_no">
                                              Order Cost No
                                            </span>
                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                             Ref #


                                            </span>


                                <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                           Products & Value


                                            </span>

                                            <span class="icon fa "></span></a></th>


							<!--	<th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                          Photographer Cost


                                            </span>
                                <span class="icon fa "></span></a></th>-->
								<th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" adr_trans="label_other_cost">

                                          Other Cost


                                            </span>
                                <span class="icon fa "></span></a></th>

								<th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">
<?php
$taxpercentage=0;
 $pc_admin_id=$_SESSION['admin_loggedin_id'];
 $taxpercent="";
	 if($_SESSION['admin_loggedin_type']=="PCAdmin"){
						    $taxpercent=mysqli_query($con,"select tax from photo_company_profile where pc_admin_id='$pc_admin_id'");
}
else
{
$csr_id=$_SESSION['admin_loggedin_id'];
						    $taxpercent=mysqli_query($con,"select tax from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id='csr_id' and type_of_user='CSR')");

}
$available=mysqli_num_rows($taxpercent);
								if($available>0)
								{
							   $taxpercent1=mysqli_fetch_array($taxpercent);
							   $taxpercentage=$taxpercent1['tax'];
							   }
?>
                                          <span adr_trans="label_tax">Tax</span>&nbsp;(<?php echo $taxpercentage; ?>%)


                                            </span>
                                <span class="icon fa "></span></a></th>

								<th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_total_value" adr_trans="label_total_value">

                                          Total Value


                                            </span>
                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="label_photographer">


                                          Photographer


                                </span>

                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                            Realtor

                                            </span>
                                 <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_date_and_time" adr_trans="label_date_and_time">

                                              Date & Time

                                 </span>


                                <span class="icon fa "></span></a></th></tr>
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
                            if($_SESSION["page"] == 0 || !isset($_SESSION["page"]))
                            {
                              $_SESSION["page"]=1;
                            }
							if(isset($_REQUEST['realtor_id']))
							{
							$_SESSION['realtor_id'] = $_REQUEST['realtor_id'];
							}

						   $CSRWhereCondition="";
 if($_SESSION['admin_loggedin_type']=="CSR"){
 $csr_id=$_SESSION['admin_loggedin_id'];
 $CSRWhereCondition=" and csr_id='$csr_id' ";
 }
 else
 {
  $pc_admin_id=$_SESSION['admin_loggedin_id'];
 $CSRWhereCondition=" and pc_admin_id='$pc_admin_id' ";
 }


if(!empty($_SESSION['starting_time']) && !empty($_SESSION['realtor_id']))
{
 $start = $_SESSION['starting_time'];
  $end = $_SESSION['ending_time'] ;
  $realtor_id = $_SESSION['realtor_id'] ;
  $q1="select count(*) as total FROM `orders` where status_id=3 AND  DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' and created_by_id='$realtor_id'  $CSRWhereCondition  ORDER BY session_from_datetime asc ";
}
else if(!empty($_SESSION['starting_time']) && empty($_SESSION['realtor_id'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;


                              $q1="select count(*) as total FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'   $CSRWhereCondition ORDER BY session_from_datetime asc ";


                          }
else if(empty($_SESSION['starting_time']) && !empty($_SESSION['realtor_id']))
{
  $realtor_id = $_SESSION['realtor_id'] ;
  $q1="select count(*) as total FROM `orders` where status_id=3  and created_by_id='$realtor_id'  $CSRWhereCondition  ORDER BY session_from_datetime asc ";
}
else
{
  $q1="select count(*) as total FROM `orders` where status_id=3   $CSRWhereCondition ORDER BY session_from_datetime asc ";
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
							//$start_no_users =1
							//if($_SESSION["page"]!=0)
							//{
                            $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;
//}
                             $cnt=$start_no_users;



                             $_SESSION['starting_time'] = @$_REQUEST['starting'];
                             $_SESSION['ending_time'] = @$_REQUEST['ending'];

                            $start = $_SESSION['starting_time'];
                            $end = $_SESSION['ending_time'] ;


if(!empty($_SESSION['starting_time']) && !empty($_SESSION['realtor_id']))
{
 $start = $_SESSION['starting_time'];
  $end = $_SESSION['ending_time'] ;
  $realtor_id = $_SESSION['realtor_id'] ;
  $q2="select *  FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' and created_by_id='$realtor_id' $CSRWhereCondition  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
else if(!empty($_SESSION['starting_time']) && empty($_SESSION['realtor_id'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;


                              $q2="select * FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' $CSRWhereCondition  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages	;


                          }
else if(empty($_SESSION['starting_time']) && !empty($_SESSION['realtor_id']))
{
  $realtor_id = $_SESSION['realtor_id'] ;
  $q2="select *  FROM `orders` where status_id=3 and created_by_id='$realtor_id' $CSRWhereCondition  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages	;
}
else
{
  $q2="select *  FROM `orders` where status_id=3 $CSRWhereCondition ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages;
}


                            $res2=mysqli_query($con,$q2);
							$grandTotal=0;
                            if($res2)
														{
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
                            <td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
                            <td class="text-left" style=""><?php echo "FOT".$get_invoice['invoice_id']; ?></td>
                            <td class="text-left" style=""><?php echo "FOT#".$get_invoice['order_id']; ?></td>
                            <?php  $product_id_is=$get_order2['product_id'];

						 //  $product=mysqli_query($con,"select sum(total_price)+sum(photographer_cost)+sum(other_cost) as total_value,GROUP_CONCAT(product_title,' - $',total_price SEPARATOR '<br>') as title from order_products where order_id='$order_id'");

						     $product=mysqli_query($con,"select sum(total_price*quantity) as total_value,GROUP_CONCAT(product_title,' X ',quantity,' - $',total_price SEPARATOR '<br>') as title from order_products where order_id='$order_id'");

						 // $product=mysqli_query($con,"select * from order_products where order_id=$order_id")
                             $product_detail=mysqli_fetch_array($product);



							 $photography=mysqli_query($con,"select sum(photographer_cost) as photography_value,GROUP_CONCAT(product_title,' - $',photographer_cost SEPARATOR '\n') as photography_title from order_products where order_id='$order_id'");

							  $photography1=mysqli_fetch_array($photography);


							  $otherCost=mysqli_query($con,"select other_cost from invoice where order_id='$order_id'");
							   $otherCost1=mysqli_fetch_array($otherCost);

							   $totalCostIs=$product_detail['total_value']+$otherCost1['other_cost'];
								// echo ""





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
                            <td class="text-left" style="width:200px;"><?php  echo $product_detail['title']; ?></td>




                             <?php
                           $prodQuan="";


                            $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

                              while($product_title=mysqli_fetch_array($get_product))
                        {
                          $prodQuan.=$product_title['quantity'].',';
                        }
                          ?>


							<td class="text-center" style=""><?php echo "$".$otherCost1['other_cost']; ?></td>
							<td class="text-leenterft" style=""><?php echo "$".$taxation; ?></td>
						<?php /*	<td class="text-center" style="" title="<?php  echo $photography1['photography_title']; ?>">$<?php  echo $photography1['photography_value']; ?></td> */ ?>
                            <td class="text-center" style=""><?php echo "$".$totalOrderValue; ?></td>

                            <?php
                            $photographer_id=$get_order2['photographer_id'];
                            $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                            $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                            $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
                            ?>
                            <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
                            <?php
                           $created_by_id=$get_order2['created_by_id'];
						   $pcAdminId=$get_order2['pc_admin_id'];
						   $createdByQr="";
						   if($created_by_id==$pcAdminId)
						   {
						   $createdByQr="SELECT * FROM admin_users where id='$created_by_id'";
						   }
						   else
						   {
						    $createdByQr="SELECT * FROM user_login where id='$created_by_id'";
						   }
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);

                             $get_create_name_query2 = mysqli_query($con,$createdByQr);

                          $get_name_create=mysqli_fetch_assoc($get_create_name_query2);
                            $created_name=@$get_name_create["first_name"]." ".@$get_name_create["last_name"];
                            ?>

                            <td class="text-left" style=""><?php echo $created_name; ?></td>
                               <?php

                              $toexp=explode(" ",$get_order2['session_to_datetime']);
                             ?>
                            <td class="text-left" style=""><?php  if($get_order2['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order2['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>


                            </tr>
													<?php } }?>
													<tr><td colspan="5">&nbsp;</td>
													<td style="font-weight:600;">TOTAL </td><td style="font-weight:600;">$<?php echo $grandTotal; ?></td>
													<td colspan="3">&nbsp;</td>
													</tr>
													</tbody>
                                </table></div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled" aria-disabled="true"><a href="./payment_reports.php?page=1" class="button adr-save">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:24px">
																		<div class="infos"><p align="right" style="    margin-right: -px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></p></div>
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
