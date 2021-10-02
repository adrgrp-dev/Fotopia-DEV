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
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
									<?php	if($_SESSION['admin_loggedin_type']=="PCAdmin"){
								 	include "sidebar.php";
								 } else {
								 	include "sidebar.php";
								 }
								 $supercsr=$_SESSION['admin_loggedin_id'];
								  ?>

			</div>
                <div class="col-md-10">


                  <hr class="space s">
                  <div class="col-md-12">
                           <ul class="nav nav-pills" style="margin-left:20px;">
                              <li class="active"><a href="order_reports.php" id="label_order_report" adr_trans="label_order_report" class="btn btn-default btn-sm ">Order Report</a></li>
                              <li class="active"><a href="appointment_reports.php" id="label_appointment_report" adr_trans="label_appointment_report" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;">Appointment Report</a></li>
                              <li class="active"><a href="payment_reports.php" id="label_payment_report" adr_trans="label_payment_report" class="btn btn-default btn-sm ">Payment Report</a></li>
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
<div class="col-md-2" style="padding-left:30px;">
<p><h5 id="label_from_date" adr_trans="label_from_date">From Date</h5></p>
<input type="date" onchange="setSecondDate();" id="start" name="starting" value="<?php echo @$_REQUEST['starting']?>" class="form-control" style="display:inline-table">&nbsp;&nbsp;&nbsp;
</div>
<div class="col-md-2" style="padding-left:30px;">
<p><h5 id="label_to_date" adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending"  class="form-control" value="<?php echo @$_REQUEST['ending']?>" style="">
</div>
<div class="col-md-3" style="padding-left:30px;">
<p><h5 id="label_filter_by" adr_trans="label_filter_by">Filter By</h5></p>
 <input type="text"  list="Suggestions1" placeholder="Search Photographer" class="form-control form-value" id="user_name1" name="user_name1" value="" style="display:inline;" />
 <!-- <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button> -->

 <datalist id="Suggestions1"  >
 <?php
              if($_SESSION['admin_loggedin_type']=="PCAdmin"){

                $user_name=mysqli_query($con,"select * from user_login where type_of_user='Photographer'and pc_admin_id='$supercsr' order by first_name");

              }
							elseif($_SESSION['admin_loggedin_type']=="CSR"){

                $user_name=mysqli_query($con,"select * from user_login where type_of_user='Photographer'and csr_id='$supercsr' order by first_name");

              }
              else{

                $user_name=mysqli_query($con,"select * from user_login where type_of_user='Photographer' order by first_name");

              }

              while($user_first_name=mysqli_fetch_assoc($user_name))
              {
              ?>


              <option value="<?php echo $user_first_name['first_name'].' '.$user_first_name['last_name']; ?>"<?php if(($user_first_name['first_name'].' '.$user_first_name['last_name'])==$_REQUEST["user_name1"]){ echo "selected";}?> ><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

              <?php } ?>
</datalist>
</div>


<div class="col-md-3" style="margin-top:23px;padding-left:0px;margin-left:30px;">
  <button type="submit" id="label_search" adr_trans="label_search" class="btn btn-primary s" style="border-radius:20px 20px 20px 20px;">Search</button>

   <a href="#" onclick="appointment()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:25px;padding-left:50px;" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:25px;padding-left:10px;" title="Download Excel"></i></a>

</div>
</div>


</form>





<div style="width:100%;overflow:scroll">
              <table  id="" cellpadding="10" class="table-striped" style="width:100%;border-radius:30px 30px 30px 30px!important;">



                                    <thead>
					<tr class="text-center"><th align="center" colspan="8"><center><b><br /><span adr_trans="label_appointment_report">Appointment Reports</span><br /></b></center></th></tr>

                                        <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                                              S.No

                                            </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_home_address" adr_trans="label_home_address">
                                              Home Address
                                            </span>
                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_city" adr_trans="label_city">

                                             City


                                            </span>


                                <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_state" adr_trans="label_state">

                                           State


                                            </span>

                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="label_photographer">


                                            Photographer


                                            </span>

                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_session_date_time" adr_trans="label_session_date_time">

                                          Session Date & Time


                                            </span>

                                <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_products" adr_trans="label_products">

                                           Products

                                            </span>


                                          <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                              Realtor

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
$filterBy="1";
$filterbyname=0;
if(!empty($_REQUEST['user_name1']))
{
 $filterbyname =  $_REQUEST['user_name1']." ";
$get_name = explode(" ",$filterbyname);
$fname = $get_name['0'];
$lname = $get_name['1'];

$name_id=mysqli_query($con,"select id from user_login WHERE type_of_user='Photographer' AND (first_name='$fname' AND last_name='$lname')");

$name_id1=mysqli_fetch_array($name_id);

$photographer_filter_id =  $name_id1['id'];
}

$_SESSION['filterby']=$filterBy;

if(!empty($_REQUEST['user_name1']) && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending'])))
{

$starting=$_REQUEST['starting'];
$ending=$_REQUEST['ending'];

$filterBy="  photographer_id=".$photographer_filter_id." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";

$_SESSION['filterby']=$filterBy;

}

elseif(empty($_REQUEST['user_name1']) && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending'])))
{

$starting=$_REQUEST['starting'];
$ending=$_REQUEST['ending'];

$filterBy=" DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";

$_SESSION['filterby']=$filterBy;

}

elseif(!empty($_REQUEST['user_name1'])  && (empty($_REQUEST['starting']) && empty($_REQUEST['ending'])))
{

$starting=$_REQUEST['starting'];
$ending=$_REQUEST['ending'];

$filterBy="  photographer_id=".$photographer_filter_id;

$_SESSION['filterby']=$filterBy;

}



														if (isset($_REQUEST['starting']) && isset($_REQUEST['ending']) ){

                            $_SESSION['starting_time'] = $_REQUEST['starting'];
                            $_SESSION['ending_time'] = $_REQUEST['ending'];

                             $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                          if($_SESSION['admin_loggedin_type']=="PCAdmin")
                           {
                              $q1="select count(*) as total FROM `orders` where $filterBy and pc_admin_id=$supercsr";
                            }
														elseif($_SESSION['admin_loggedin_type']=="CSR")
														 {
																$q1="select count(*) as total FROM `orders` where $filterBy and csr_id=$supercsr";
															}
                            else {
                              $q1="select count(*) as total FROM `orders` WHERE $filterBy";
                            }
                          }

                          elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                            if($_SESSION['admin_loggedin_type']=="PCAdmin")
                           {
                              $q1="select count(*) as total FROM `orders` where $filterBy and pc_admin_id=$supercsr";
                            }
														elseif($_SESSION['admin_loggedin_type']=="CSR")
													 {
															$q1="select count(*) as total FROM `orders` where $filterBy and csr_id=$supercsr";
														}
                            else {
                              $q1="select count(*) as total FROM `orders` where $filterBy";
                            }

                          }

                          else{

                          if($_SESSION['admin_loggedin_type']=="PCAdmin")
                           {
                              $q1="select count(*) as total FROM `orders`  where $filterBy and pc_admin_id=$supercsr";
                            }
														elseif($_SESSION['admin_loggedin_type']=="CSR")
	                           {
	                              $q1="select count(*) as total FROM `orders`  where $filterBy and csr_id=$supercsr";
	                            }
                            else {
                              $q1="select count(*) as total FROM `orders` where $filterBy";
                            }

                          }
                          $res="";
                            $result=mysqli_query($con,$q1);
                            @$data=mysqli_fetch_assoc(@$result);
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

                            if($_SESSION['admin_loggedin_type']=="PCAdmin"){

                             $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages ";

                           }
													 elseif($_SESSION['admin_loggedin_type']=="CSR"){

														$res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages ";

													}
                           else {

                            $res="select * FROM `orders` WHERE $filterBy limit $start_no_users ,$number_of_pages ";

                           }
                           }

                           elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;

                           if($_SESSION['admin_loggedin_type']=="PCAdmin"){

                             $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages ";

                           }
													 elseif($_SESSION['admin_loggedin_type']=="CSR"){

														 $res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages ";

													 }
                           else {
                            $res="select * FROM `orders` where $filterBy limit $start_no_users ,$number_of_pages ";

                           }

                          }

                           else{

                            if($_SESSION['admin_loggedin_type']=="PCAdmin"){

                             $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages ";

                           }
													 elseif($_SESSION['admin_loggedin_type']=="CSR"){

														$res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages ";

													}
                           else {

                            $res="select * FROM `orders` where $filterBy limit $start_no_users ,$number_of_pages ";

                           }
                           }


                            $res1=mysqli_query($con,$res);

                            if(@$res1)
														{
                            while(@$get_order=mysqli_fetch_array(@$res1))
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
														  $order_id=$get_order['id'];
                            $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                            $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                            $photographer_Name=@$get_name["first_name"]."".@$get_name["last_name"];
                            ?>
                            <td class="text-left" style=""><?php echo @$photographer_Name; ?></td>
                            <?php

                              $toexp=explode(" ",$get_order['session_to_datetime']);
                             ?>
                            <td class="text-left" style=""><?php  if($get_order['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>
                            <?php
														$prodName="";
																					  				 $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");
																					              while($prodsList1=mysqli_fetch_array($prodsList))
																					  			{
																					  				//$prodName.=$prodsList1['product_name'].',';
																									$prodID=$prodsList1['id'];
											$prodQty1 =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id' and product_id='$prodID'");
											$prodQty=mysqli_fetch_array($prodQty1);
								  				$prodName.=$prodsList1['product_name'].'&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;'.$prodQty['quantity'].'<br>';
																									}
                            ?>
                            <td class="text-left" style="width: 200px;word-wrap: break-word;"><?php  echo @substr($prodName,0,-1); ?></td>

                            <?php
                           $prodQuan="";
                           $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");

                            $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

                              while($product_title=mysqli_fetch_array($get_product))
                        {
                          $prodQuan.=$product_title['quantity'].',';
                        }
                          ?>
                         

                            <?php
                         
						  $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
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

                            </tr>
													<?php } }?>
													</tbody>
                                </table></div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled" aria-disabled="true"><a href="./appointment_reports.php?page=1" class="button adr-save">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./appointment_reports.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./appointment_reports.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./appointment_reports.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:24px">
																		<div class="infos"><p align="right" style="    margin-right: -px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">entries</span></p></div>
																		</div>
																	</div>
																</div>



															<script type="text/javascript">
																		 function appointment(){
																			html2canvas($('#dataTable')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("Appointment_reports.pdf");
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
