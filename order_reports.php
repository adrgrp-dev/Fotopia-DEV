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
  padding-left: 3px !important;
}
th:last-child > span
{
  vertical-align: text-top;
}
#undefined-footer
{
  background: white !important;
  padding: 0px 25px;
}
  </style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

 <div class="section-empty bgimage2">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:-15px;">
 <?php include "sidebar.php";

	  ?>
			</div>
                <div class="col-md-10">


                  <hr class="space s">
                  <div class="col-md-12" >

                          <ul class="nav nav-pills" style="margin-left:0px;">
                              <li class="active" style="margin-right: 10px;"><a href="order_reports.php" class="btn btn-default btn-sm adr-save"  adr_trans="label_order_reports">Order Report</a></li>

                              <li class="active"><a href="payment_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;"  adr_trans="label_payment_report">Payment Report</a></li>
														</ul>

<script>

 function filter1(x){

  if (x== "realtor") {

$('#realtor').css("display","block");
	$('#realtor').attr("required","required");
 $('#photographer').css("display","none");
 $('#photographer').removeAttr("required");
  $('#csr').css("display","none");
	$('#csr').removeAttr("required");

  }

  else if(x== "photographer"){

    $('#photographer').css("display","block");
		$('#photographer').attr("required","required");
    $('#realtor').css("display","none");
		$('#realtor').removeAttr("required");
    $('#csr').css("display","none");
		$('#csr').removeAttr("required");

  }

else if(x== "csr"){
$('#csr').css("display","block");
$('#csr').attr("required","required");
$('#photographer').removeAttr("required");
$('#photographer').css("display","none");
$('#realtor').css("display","none");
$('#realtor').removeAttr("required");
  }
 }

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


</script>
<br />

<div class="row" style="width:100%;margin-left:0px;">

<form>
<div class="col-md-3" style="padding-left:0px;">
<p><h5 adr_trans="label_from_date">From Date</h5></p>
<input type="date" onchange="setSecondDate();" id="start" name="starting" value="<?php echo @$_REQUEST['starting'];?>" class="form-control" style="height: 30px;">
</div>
<div class="col-md-3" style="padding-left:5px;">
<p><h5 adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending" value="<?php echo @$_REQUEST['ending'];?>" class="form-control"  style="height: 30px;">
</div>


<div class="col-md-3">
<span><h5 adr_trans="label_photo_company">Photo Company</h5></span>


<select name="photoCompany" id="realtor" class="form-control" style="display:block;margin-top:0px;height: 30px;padding: 4px;">
<option value="">Select Photo Company</option>
<?php
$realtorID=$_SESSION['loggedin_id'];

?>

 <?php
              $realtor=mysqli_query($con,"select distinct(organization_name),id from admin_users where type_of_user='PCAdmin' and is_approved=1");

              while($realtor1=mysqli_fetch_array($realtor))
              {
              ?>
              <option value="<?php echo $realtor1['id']; ?>" <?php if(@$_REQUEST['photoCompany']==@$realtor1['id']){echo "selected";}?>><?php echo $realtor1['organization_name']; ?> </option>
						<?php } ?>
</select>

</div>

<div class="col-md-3" style="margin-top:25px">
<button type="submit" id="submit" name="label_search" class="btn btn-default btn-sm" style="" adr_trans="label_search">Search</button>
<a href="#" onclick="Orders()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:25px;padding-left:10px;vertical-align: middle;margin-top: 3px;float:right" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:25px;padding-left:10px;vertical-align: middle;margin-top: 3px;float: right;" title="Download Excel"></i></a>
								</div>
</div>
</form>
<div style="margin-top: 5px;width:100%;border:solid 1px #fff;background-color:white">
  <div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden  ">

                            <table id="dataTable" align="center" class="table-striped" style="background:#FFF;color:#000;opacity:0.8;width:98%;margin-top: 10px;">
                                  <thead>
					                                    
                                      <tr><th data-column-id="id" class="text-left" style=""><span class="text" adr_trans="label_s.no">

                                            S.No

                                          </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text" adr_trans="label_property">
                                            Property
                                          </span>
                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_photo_company">

                                           Photo Company

                                          </span>


                              <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" adr_trans="label_session_date_time">

                                         Session Date & Time


                                          </span>

                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_products">


                                          Products


                                          </span>

                                           <span class="icon fa "></span></th>

										 <!--  <th data-column-id="logo" class="text-left" style=""><span class="text">


                                          Quantity


                                          </span>

                              <span class="icon fa "></span></th> -->


										   <th data-column-id="logo" class="text-left" style=""><span class="text" adr_trans="label_total_value">

                                        Total Value


                                          </span>

                              <!-- <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                          Realtor

                                          </span> -->


                              <span class="icon fa "></span></th><th data-column-id="link" class="text-left" style="margin-right: 5px;"><span class="text" adr_trans="label_status">

                                                  Status

                                          </span>	</a></th></tr>
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
//print_r($_REQUEST);
$filterBy="1";
$filterBy1="";
$filterbyid=0;

if (isset($_REQUEST['photoCompany'])) {
		$filterbyid=$_REQUEST['photoCompany'];
}

	//$_SESSION['filterby']=$filterBy;
if((!empty($_REQUEST['photoCompany'])  && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending']))))
{

	$starting=$_REQUEST['starting'];
		$ending=$_REQUEST['ending'];


	if(!empty($_REQUEST['photoCompany']))$filterBy=" pc_admin_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";


  //$filterBy=" created_by_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
//  $filterBy1=" where created_by_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";

		$_SESSION['filterby']=$filterBy;
}

elseif(empty($_REQUEST['photoCompany']) && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending'])))
{


	$starting=$_REQUEST['starting'];
		$ending=$_REQUEST['ending'];
 $filterBy=" DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
//		$filterBy1=" created_by_id=".$_REQUEST['realtor']." ";
		$_SESSION['filterby']=$filterBy;
}


if(!empty($_REQUEST['photoCompany']) && (empty($_REQUEST['starting']) && empty($_REQUEST['ending'])))
{



	if(!empty($_REQUEST['photoCompany']))$filterBy=" pc_admin_id=".$filterbyid;


 //	$filterBy1=" created_by_id=".$_REQUEST['csr10']." ";
		$_SESSION['filterby']=$filterBy;
}
                            if ((isset($_REQUEST['starting']) && isset($_REQUEST['ending'])))
														{
                            $_SESSION['starting_time'] = $_REQUEST['starting'];
                            $_SESSION['ending_time'] = $_REQUEST['ending'];

                             $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;


						if($_SESSION['user_type']=="Realtor")
                           {
														 // echo "select count(*) as total FROM `orders` where $filterBy and created_by_id=$realtorID";
														  $q1="select count(*) as total FROM `orders` where $filterBy and realtor_id='$realtorID' ";
												  	}


                          }

                          elseif (!empty($_SESSION['starting_time'])) {

                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;
														 $filterBy=$_SESSION['filterby'] ;

                            if($_SESSION['user_type']=="Realtor")
                           {
														 // echo "select count(*) as total FROM `orders` where $filterBy and created_by_id=$realtorID";

                              $q1="select count(*) as total FROM `orders` where $filterBy and realtor_id=$realtorID ";
                            }


                          }
                          else{

                               if(empty($_SESSION['filterby']))
															   $filterBy=1;
																 else
																 $filterBy=$_SESSION['filterby'];
														  // echo "select count(*) as total FROM `orders` where $filterBy and created_by_id=$realtorID";
                              $q1="select count(*) as total FROM `orders` where $filterBy and realtor_id= $realtorID ";


                          }


$res="";
 //echo $q1;
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

                           if (isset($_REQUEST['starting']) && isset($_REQUEST['ending'])) {

                             $_SESSION['starting_time'] = $_REQUEST['starting'];
                             $_SESSION['ending_time'] = $_REQUEST['ending'];

                            $start = $_SESSION['starting_time'];
                            $end = $_SESSION['ending_time'] ;

														if($_SESSION['user_type']=="Realtor")
	                           {
															  $res="select * FROM `orders` where $filterBy and realtor_id= $realtorID  LIMIT " . $start_no_users . ',' . $number_of_pages;
													  	}


	                          }

	                          elseif (!empty($_SESSION['starting_time'])) {
	                            $start = $_SESSION['starting_time'];
	                             $end = $_SESSION['ending_time'] ;
															 $filterBy=$_SESSION['filterby'] ;

	                            if($_SESSION['user_type']=="Realtor")
	                           {
	                              $res="select * FROM `orders` where $filterBy and realtor_id= $realtorID LIMIT " . $start_no_users . ',' . $number_of_pages;
	                            }

	                          }
	                          else{

															if(empty($_SESSION['filterby']))
															 $filterBy=1;
															 else
															 $filterBy=$_SESSION['filterby'];
	                              $res="select * FROM `orders` where $filterBy and realtor_id= $realtorID  LIMIT " . $start_no_users . ',' . $number_of_pages;



	                          }

								$res1=mysqli_query($con,$res);
								// echo $res;

                    if(@$res1){


                          while(@$get_order=mysqli_fetch_assoc($res1))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr class="listPageTR">
                          <td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
                          <?php
                            $hs_id=$get_order["home_seller_id"];
                            $get_home_query=mysqli_query($con,"select * from home_seller_info where id=$hs_id");
                            $get_home=mysqli_fetch_assoc($get_home_query);
                           ?>
                          <td class="text-left" style=""><?php echo $get_order["property_type"]; ?> <br><?php echo @$get_home["city"].",".@$get_home['state'];?></td>
                          <?php
                          $pc_id=$get_order['pc_admin_id'];
													 $order_id=$get_order['id'];
                          $get_pc_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_id'");
                          $get_name=mysqli_fetch_assoc($get_pc_name_query);
                          $pc_Name=@$get_name["organization_name"];
                          ?>
                          <td class="text-left" style=""><?php echo $pc_Name; ?></td>
                          <?php

                            $toexp=explode(" ",$get_order['session_to_datetime']);
														//echo $toexp[1];
                           ?>
                          <td class="text-left" style=""><?php  if($get_order['session_from_datetime']!='0000-00-00 00:00:00') {
		  echo date('d/m/Y H:i',strtotime($get_order['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>

													<?php
	$prodName="";
								  				 $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");


								              while($prodsList1=mysqli_fetch_array($prodsList))
								  			{
											$prodID=$prodsList1['id'];
											$prodQty1 =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id' and product_id='$prodID'");
											$prodQty=mysqli_fetch_array($prodQty1);
								  				$prodName.=$prodsList1['product_name'].'&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;'.$prodQty['quantity'].'<br>';
												}
								  				?>

                          <td class="text-left" style="word-wrap:break-word;width:250px"><?php  echo @substr($prodName,0,-1); ?></td>

                           <?php
  $prodQuan="";
                           $prodsList=mysqli_query($con,"SELECT * from products where id in(select product_id from order_products WHERE order_id='$order_id')");

                            $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

                              while($product_title=mysqli_fetch_array($get_product))
                        {
                          $prodQuan.=$product_title['quantity'].',';
                        }
                          ?>
                       <?php /*   <td class="text-left" style="word-wrap:break-word;width:100px"><?php  echo @substr($prodQuan,0,-1); ?></td> */ ?>

													<?php
													 $total_cost=mysqli_query($con,"SELECT sum(total_price) as totalPrice from order_products WHERE order_id='$order_id'");
															$total_cost1=mysqli_fetch_array($total_cost);

													?>
                          <td class="text-left" style=""><?php echo "$".@$total_cost1['totalPrice']; ?></td>
                          <?php
                          $created_by_id=$get_order['created_by_id'];
                          $get_create_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$created_by_id'");
                          $get_name_create=mysqli_fetch_assoc($get_create_name_query);


                             $get_create_name_query2 = mysqli_query($con,"SELECT * FROM admin_users where id='$created_by_id'");


                          $get_name_create=mysqli_fetch_assoc($get_create_name_query2);
                          $created_name=@$get_name_create["first_name"]." ".@$get_name_create["last_name"];
                          ?>

                          <!-- <td class="text-left" style=""><?php echo $created_name; ?></td> -->
                          <td class="text-left" style="width:70px;padding-right: 10px;"><?php $status=$get_order['status_id']; if($status==1) { echo "<span id='label_created' adr_trans='label_created' style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;'>Rework</span>";}elseif($status==6){echo "<span id='label_declined' adr_trans='label_declined' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;'>Declined</span>";}elseif($status==7){echo "<span id='label_working_customer' adr_trans='label_working_customer' style='color: #000; font-weight: bold;display: block; background: orange;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:80px;'>Working with Customer</span>";}elseif($status==5){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;'>Cancelled</span>";}elseif($status==8){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:60px;' id='' adr_trans=''>Reopen</span>";} ?></td>

                          </tr>
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
												<?php }} ?>
                              </table>
                            </div>
                          </div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled " aria-disabled="true"><a href="./order_reports.php?page=1" class="button ">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]-1);?>&starting=<?php echo @$_REQUEST['starting']; ?>&ending=<?php echo @$_REQUEST['ending']; ?>" class="button ">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button "><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]+1);?>&starting=<?php echo @$_REQUEST['starting']; ?>&ending=<?php echo @$_REQUEST['ending']; ?>" class="button ">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($Page_check);?>&starting=<?php echo @$_REQUEST['starting']; ?>&ending=<?php echo @$_REQUEST['ending']; ?>" class="button ">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:22px">
																<div class="infos"><p align="right" style="margin-right: -15px;"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
																		</div>
																	</div>
																</div>



<script type="text/javascript">
function Orders(){
html2canvas($('#dataTable')[0], {
onrendered: function(canvas) {

let splitAt = 1400; 

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
pdfMake.createPdf(docDefinition).download("Order_Report.pdf");
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
<?php
if($_SESSION['user_type']=="Realtor"){
echo '<script>
 $(document).ready(function(){
$("#photographer").css("display","block");
  });
</script>';
}
?>
		<?php include "footer.php";  ?>
