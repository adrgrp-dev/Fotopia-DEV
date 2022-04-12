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
  @media only screen and (max-width: 600px) {
    .infobar
    {
      margin-top: -24px !important;
      margin-right: -40px !important;
    }
  }
  .nav-pills > li > a
  {
    padding: 6px;
  }
  .infobar
  {
    margin-top: 22px;
  }
  thead > tr:last-child > th,th > span
  {
    background: #aad1d6;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 3px !important;
  }
  .infobar .infos p
  {
    margin-right: -90px;
  }
  #undefined-footer
  {
    background: white;
    padding: 0px 25px;
  }
  .nav > li {
  margin-right:10px;
  }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	<style>

	/*td
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
	}*/
	</style>
 <div class="section-empty">
        <div class="" style="margin-left:0px;height:inherit;width:100%">
            <div class="row" style="width:100%">
			
               <div class="col-md-2" style="padding-left:15px;">
									<?php	if($_SESSION['admin_loggedin_type']=="SuperCSR"){
								 	include "sidebar.php";
								 } else {
								 	include "sidebar.php";
								 }
								 $supercsr=$_SESSION['admin_loggedin_id'];
								 ?>


			</div>
                <div class="col-md-10" style="padding-left:15px;">


                  <hr class="space s">
                  <div class="col-md-12" style="width:100%;margin-top: 5px;">

                         <ul class="nav nav-pills" style="margin-left:0px;">
                              <li class="active"><a id="label_order_report" adr_trans="label_order_report" href="order_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;">Order Report</a></li>
                              <li class="active"><a id="label_appointment_report" adr_trans="label_appointment_report" href="appointment_reports.php" class="btn btn-default btn-sm " style="background:#FFF!important;color:#000!important;">Appointment Report</a></li>
                              <li class="active"><a id="label_payment_report" adr_trans="label_payment_report" href="payment_reports.php" class="btn btn-default btn-sm adr-save ">Payment Report</a></li>
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

function radioFilter(val)
{
  if(val=="Photographer")
  {
    $("#realtorDropdown").css("display","none");
    $("#photographerDropdown").css("display","inline-block");
    $("#label_photographer_commission").css("display","block");
    $("#value_photographer_commission").css("display","block");
    $(".label_total").css("visibility","hidden");
    $(".filter2").hide()
    $(".newfilter2").show();
  }
  else{
    $("#realtorDropdown").css("display","inline-block");
    $("#photographerDropdown").css("display","none");
    $("#label_photographer_commission").css("display","none");
    $("#value_photographer_commission").css("display","none");
    $(".label_total").css("visibility","visible");
    $(".filter2").show();
    $(".newfilter2").hide();
    

  }
}

</script>


<div class="row" style="width:100%;margin-left:3px;"> 
<form>
<div class="col-md-2" style="padding-left:0px;margin-top:5px;">
<h5 id="label_from_date" adr_trans="label_from_date">From Date</h5>
<input type="date" onchange="setSecondDate();" id="start" value="<?php echo @$_REQUEST['starting']?>" name="starting" class="form-control" style="padding-left:5px;width:160px;height:30px">
</div>
<div class="col-md-2" style="padding-left:5px;margin-top:5px;">
<p><h5 id="label_to_date" adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending" value="<?php echo @$_REQUEST['ending']?>" class="form-control" style="padding-left:2px;width:160px;height:30px">
</div>
<div class="col-md-6" >
  <h5 id="label_from_date" adr_trans="label_Choose_Realtor" style="padding-left:15px;margin-top:5px;">Filter By</h5>
 &nbsp;&nbsp; <input type="radio" id="radioRealtor" name="filter" value="RealtorCompany" <?php if(@$_REQUEST['filter']!='Photographer'){ echo 'checked';} ?>  onclick="radioFilter(this.value)" onChange="radioFilter(this.value)"><span  style="font-size:13px;color:#666666;">&nbsp;&nbsp;Realtor Company</span>&nbsp;&nbsp;&nbsp;&nbsp;
 <?php if($_SESSION['admin_loggedin_type']!="FotopiaAdmin"){?> <input type="radio" id="radioPhotographer" name="filter" value="Photographer" <?php if(@$_REQUEST['filter']=='Photographer'){ echo 'checked';} ?> onclick="radioFilter(this.value)" onChange="radioFilter(this.value)"><span style="font-size:13px;color:#666666;display:inline-block">&nbsp;&nbsp;Photographer</span>
<?php } ?>

<select name="realtor_id" id="realtorDropdown" class="form-control" list="realtors_list" style="width:200px;height:30px;font-size:13px;padding:0px 0px 0px 5px;display:inline-block;margin-left:20px;">
<option value=0> Select Realtor</option>
						<?php

						$selectrealtor=mysqli_query($con,"SELECT organization_name as org,id,type_of_user FROM `user_login` where organization_name!='' and type_of_user='Realtor' and id in(select distinct(created_by_id) from orders)");
						while($selectrealtor1=mysqli_fetch_array($selectrealtor))
						{
						?>
						<option value="<?php echo $selectrealtor1['id']; ?>" <?php if($selectrealtor1['id']==@$_REQUEST['realtor_id']){ echo "selected"; }?>><?php echo $selectrealtor1['org']; ?></option>
						<?php } ?>

</select>
<select name="photographer_id" id="photographerDropdown" class="form-control" list="realtors_list" style="width:200px;height:30px;font-size:13px;padding:0px 0px 0px 5px;display:none;margin-left:20px;">
<option value=0>Select Photographer</option>
            <?php
            $loggedin_type=$_SESSION['admin_loggedin_type'];
            $loggedin_id=$_SESSION['admin_loggedin_id'];
            if($loggedin_type=="PCAdmin")
            {
            $selectphotographer=mysqli_query($con,"SELECT * FROM `user_login` where type_of_user='Photographer' and pc_admin_id=$loggedin_id");
            }
            elseif($loggedin_type=="CSR")
            {
             $selectphotographer=mysqli_query($con,"SELECT * FROM `user_login` where type_of_user='Photographer' and csr_id=$loggedin_id");
            }
            else
            {
              $selectphotographer=mysqli_query($con,"SELECT * FROM `user_login` where type_of_user='Photographer'");
            }

            while($selectphotographer1=mysqli_fetch_array($selectphotographer))
            {
            ?>
            <option value="<?php echo $selectphotographer1['id']; ?>" <?php if($selectphotographer1['id']==@$_REQUEST['photographer_id']){ echo "selected"; }?>><?php echo $selectphotographer1['first_name']; ?></option>
            <?php } 
            ?>

</select>

</div>
<div class="col-md-2" style="margin-top:23px;padding-left:0px;">
    <button type="submit" id="label_search" adr_trans="label_search" class="btn adr-save s" style="padding: 6px 10px !important;height:30px;font-size:12px;margin-left:<?php if($loggedin_type=="PCAdmin" || $loggedin_type=="CSR") { echo "-15px"; } else { echo "-125px"; }?>;margin-top:5px;">Search</button>

                          <a href="#" onclick="payment()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:28px;padding-left:10px;vertical-align: middle;float:right;padding-top:5px;" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:28px;padding-left:10px;vertical-align: middle;float:right;padding-top:5px;" title="Download Excel"></i></a>

  </div>
</div>

</form>



<div style="margin-top: 5px;width:100%;border-radius: 5px;background-color:white">
  <div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
        <table id="dataTable" align="center" class="table-striped" style="opacity:0.9;width:98%;">

                                    <thead>
									<hr class="space xs" />
			<!--<tr class="text-left"><th align="center" colspan="11" style="font-size:15px;"><center><b><br /><span  adr_trans="label_payment_report">Payment Reports</span><br /></b></center></th></tr>-->
                                        <tr><th data-column-id="id" class="text-left" style=""><span class="text">

                                              S.No

                                            </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text" id="label_order_cost_no" adr_trans="label_order_cost_no">
                                              Order Cost No
                                            </span>
                                <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                             Order #


                                            </span>


                                <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left filter2" style="" ><span class="text">

                                           Products & Value


                                            </span>

                                            <span class="icon fa "></span></th>


								
								<th data-column-id="logo" class="text-left filter2" style=""><span class="text" adr_trans="label_other_cost">

                                          Other Cost


                                            </span>
                                <span class="icon fa "></span></th>

								<th data-column-id="logo" class="text-left filter2" style=""><span class="text">
<?php
$taxpercentage=0;
$filterWhereCondition="";
 $pc_admin_id=$_SESSION['admin_loggedin_id'];
 $taxpercent="";
	 if($_SESSION['admin_loggedin_type']=="PCAdmin"){
						    $taxpercent=mysqli_query($con,"select tax from photo_company_profile where pc_admin_id='$pc_admin_id'");
}
else
{
$csr_id=$_SESSION['admin_loggedin_id'];
						    $taxpercent=mysqli_query($con,"select tax from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id='$csr_id' and type_of_user='CSR')");

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
                                <span class="icon fa "></span></th>

								<th data-column-id="logo" class="text-left filter2" style=""><span class="text" id="label_total_value" adr_trans="label_total_value">

                                          Total Value


                                            </span>
                                <span class="icon fa "></span></th>
                                <th data-column-id="logo" class="text-left newfilter2" style=" display: none;width: 170px;"><span class="text">


                                          Address

                                </span>

                                <span class="icon fa "></span></th>
                                <th data-column-id="logo" class="text-left " style=""><span class="text"  id="label_photographer" adr_trans="label_photographer">


                                         
                                         Photographer

                                </span>

                                <span class="icon fa "></span></th>
                                <!-- <th data-column-id="logo" class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                            Realtor

                                            </span>
                                 <span class="icon fa "></span></th> -->


								 <th data-column-id="logo" class="text-left" style=""><span class="text" id="label_date_and_time" adr_trans="label_billedTo">

                                              Billed To

                                 </span>


                                <span class="icon fa "></span></th>



								<th data-column-id="more-info" id="label_photographer_commission" class="text-left" style="display: none;"><span class="text">

                                           Photographer's Commission


                                            </span>

                                            <span class="icon fa "></span></th>



								</tr>
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
                             $_SESSION['starting_time'] = @$_REQUEST['starting'];
                             $_SESSION['ending_time'] = @$_REQUEST['ending'];
							if(@$_REQUEST['filter']=="RealtorCompany")
							{
							$_SESSION['realtor_id1'] = @$_REQUEST['realtor_id'];
              // if(isset($_SESSION['photographer_id'])){unset($_SESSION['photographer_id'])}
							}
							elseif(@$_REQUEST['filter']=="Photographer")
              {
                $_SESSION['photographer_id1'] = @$_REQUEST['photographer_id'];
                 // if(isset($_SESSION['realtor_id'])){unset($_SESSION['realtor_id'])}
              }
              else
							{
							unset($_SESSION['realtor_id1']);
              unset($_SESSION['photographer_id1']);
							}

						   $CSRWhereCondition="";
               $photographer_id=@$_REQUEST['photographer_id'];
 if($_SESSION['admin_loggedin_type']=="CSR"){
 $csr_id=$_SESSION['admin_loggedin_id'];
 if(@$_REQUEST['filter']=="Photographer" && $_SESSION['photographer_id1']!=0)
 {
  $photographer_id=$_SESSION['photographer_id1'];
 $filterWhereCondition="and photographer_id=$photographer_id ";
 }
  elseif(@$_REQUEST['filter']=="RealtorCompany" && $_SESSION['realtor_id1']!=0){
  $realtor_id=$_SESSION['realtor_id1'];
  $filterWhereCondition="and realtor_id=$realtor_id ";
 }
 $CSRWhereCondition=" and csr_id='$csr_id' ";
 }
 if($_SESSION['admin_loggedin_type']=="PCAdmin")
 {
  $pc_admin_id=$_SESSION['admin_loggedin_id'];
  if(@$_REQUEST['filter']=="Photographer" && $_SESSION['photographer_id1']!=0)
 {
  $photographer_id=$_SESSION['photographer_id1'];
 $filterWhereCondition="and photographer_id=$photographer_id";
 }
 elseif(@$_REQUEST['filter']=="RealtorCompany" && $_SESSION['realtor_id1']!=0){
  $realtor_id=$_SESSION['realtor_id1'];
  $filterWhereCondition="and realtor_id=$realtor_id  ";
 }
 $CSRWhereCondition="and pc_admin_id='$pc_admin_id' ";
 }




if(!empty($_SESSION['starting_time']) && (!empty($_SESSION['realtor_id1']) || !empty($_SESSION['photographer_id1']) ))
{
 $start = $_SESSION['starting_time'];
  $end = $_SESSION['ending_time'] ;
  $q1="select count(*) as total FROM `orders` where status_id=3 AND  DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' $filterWhereCondition $CSRWhereCondition  ORDER BY session_from_datetime asc ";
}
elseif(!empty($_SESSION['starting_time']) && empty($_SESSION['realtor_id1'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;


                              $q1="select count(*) as total FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start' AND '$end'   $CSRWhereCondition ORDER BY session_from_datetime asc ";


                          }
elseif(empty($_SESSION['starting_time']) && (!empty($_SESSION['realtor_id1']) || !empty($_SESSION['photographer_id1'])))
{

  $q1="select count(*) as total FROM `orders` where status_id=3 $filterWhereCondition  $CSRWhereCondition  ORDER BY session_from_datetime asc ";
}
else
{
  $q1="select count(*) as total FROM `orders` where status_id=3   $CSRWhereCondition ORDER BY session_from_datetime asc ";
}


                            //echo $q1;
                            $result=mysqli_query($con,$q1);
                            @$data=mysqli_fetch_assoc(@$result);
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
							//$start_no_users =1
							//if($_SESSION["page"]!=0)
							//{
							if($_SESSION["page"]==0)
							{
							$start_no_users=0;
							}
							else
							{
                            $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;
							}
//}
                             $cnt=$start_no_users;



                             

                             $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;


if(!empty($_SESSION['starting_time']) && (!empty($_SESSION['realtor_id1']) || !empty($_SESSION['photographer_id1'])))
{
 $start1 = $_SESSION['starting_time'];
  $end1 = $_SESSION['ending_time'] ;
  $q2="select *  FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start1' AND '$end1' $filterWhereCondition $CSRWhereCondition  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
elseif(!empty($_SESSION['starting_time']) && empty($_SESSION['realtor_id1'])) {
                            $start1 = $_SESSION['starting_time'];
                             $end1 = $_SESSION['ending_time'] ;


                              $q2="select *  FROM `orders` where status_id=3 and DATE(session_from_datetime)  BETWEEN  '$start1' AND '$end1'   $CSRWhereCondition ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages	;


                          }
elseif(empty($_SESSION['starting_time']) && (!empty($_SESSION['realtor_id1']) || !empty($_SESSION['photographer_id1'])))
{
  
  $q2="select *  FROM `orders` where status_id=3 $filterWhereCondition $CSRWhereCondition  ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages	;
}
else
{
  $q2="select *  FROM `orders` where status_id=3 $CSRWhereCondition ORDER BY session_from_datetime asc LIMIT " . $start_no_users . ',' . $number_of_pages;
}

//echo "<br>".$q2;
                            $res2=mysqli_query($con,$q2);
							$grandTotal=0;
                            if($res2)
														{
                            while($get_order2=mysqli_fetch_array($res2))
                            {
                            $cnt++;

                               //	---------------------------------  pagination starts ---------------------------------------
                            ?>
                            <tr data-row-id="0" class="listPageTR">
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

						     $product=mysqli_query($con,"select sum(price*quantity) as total_value,GROUP_CONCAT(product_title,' X ',quantity,' - $',price SEPARATOR '<br>') as title from order_products where order_id='$order_id'");

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
                            <td class="text-left filter2" style="width:200px;"><?php  echo $product_detail['title']; ?></td>




                             <?php
                           $prodQuan="";


                            $get_product =  mysqli_query($con,"SELECT * FROM order_products WHERE order_id ='$order_id'");

                              while($product_title=mysqli_fetch_array($get_product))
                        {
                          $prodQuan.=$product_title['quantity'].',';
                        }
                         
                         $photography_query=mysqli_query($con,"SELECT sum(photography_cost) as photo_commission_cost,GROUP_CONCAT(product_id) FROM `photographer_product_cost` where product_id in (SELECT product_id FROM `order_products` where order_id in (select id from orders where status_id=3 and id=$order_id))");
                         $photography_earning_cost=mysqli_fetch_assoc($photography_query);

                         $home_seller_query=mysqli_query($con,"select * from home_seller_info where id in (select home_seller_id from orders where status_id=3 and id=$order_id)");
                        $Home_seller_detail=mysqli_fetch_array($home_seller_query);
                          ?>


							
							<td class="text-left filter2" style=""><?php echo "$".$taxation; ?></td>
						 	<td class="text-left filter2" style="" title="<?php  echo $photography1['photography_title']; ?>">$<?php  echo $photography1['photography_value']; ?></td>  
                            <td class="text-left filter2" style=""><?php echo "$".$totalOrderValue; ?></td>

                            <?php
                            $photographer_id=$get_order2['photographer_id'];
                            $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                            $get_name=mysqli_fetch_array($get_photgrapher_name_query);
                            @$photographer_Name=$get_name["first_name"]." ".$get_name["last_name"];
                            ?>
                            <td class="text-left newfilter2" style="display: none;width: 150px;word-wrap:break-word"><?php echo $Home_seller_detail['address']."<br>".$Home_seller_detail['city']." ".$Home_seller_detail['state']; ?></td>
                            <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
                            <?php
                           $created_by_id=$get_order2['created_by_id'];
						   $pcAdminId=$get_order2['pc_admin_id'];
						   $createdByQr="";
							  $csr_id=$get_order2['csr_id'];
						   if($created_by_id==$pcAdminId||$created_by_id==$csr_id)
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

                            <!-- <td class="text-left" style=""><?php //echo $created_name; ?></td> -->

							<td align="left">

							<?php
							$HS_ID=$get_order2['home_seller_id'];
							$REALTOR_ID=$get_order2['realtor_id'];
							$billedTo="";
							if($REALTOR_ID==0)
							{
  $tempRealtor=mysqli_query($con,"select * from home_seller_info where id='$HS_ID'");
  $tempRealtor1=mysqli_fetch_array($tempRealtor);
  $billedTo=$tempRealtor1['request_name']." (".$tempRealtor1['request_email'].")";
  }
  else
  {
   $getRealtors=mysqli_query($con,"SELECT * FROM user_login where id='$REALTOR_ID'");
   $getRealtors1=mysqli_fetch_array($getRealtors);
   $billedTo=$getRealtors1['organization_name'];
  }
			echo $billedTo;
							?>

							</td>
               <td class="text-left newfilter2" style="display: none"><?php

                if (empty($photography_earning_cost['photo_commission_cost'])) {

                   echo "$"."0";
                }

                else{

               echo "$".$photography_earning_cost['photo_commission_cost']; 

             } ?></td>





                               <?php

                              // $toexp=explode(" ",$get_order2['session_to_datetime']);
                             ?>
                           <!--  <td class="text-left" style=""><?php  //if($get_order2['session_from_datetime']!='0000-00-00 00:00:00') {
		  //echo date('d/m/Y H:i',strtotime($get_order2['session_from_datetime'])); } else { echo "Not booked yet."; } ?></td>
 -->

                            </tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
													<?php } }?>
													<tr ><td colspan="5">&nbsp;</td>
													<td style="font-weight:600;padding-left:3px ;"  ><b class="label_total">TOTAL</b> </td><td style="font-weight:600;padding-left:3px ;"><b class="label_total">$<?php echo $grandTotal; ?></b></td>
													<td colspan="4">&nbsp;</td>
													</tr>
													</tbody>
                                </table></div>
                              </div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
                                  <ul class="pagination">
                                    <li class="first disabled" aria-disabled="true"><a href="./payment_reports.php?page=1&filter=<?php echo @$_REQUEST['filter']?>" class="button">«</a></li>
                                    <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]-1)."&filter=".@$_REQUEST['filter'];?>" class="button">&lt;</a></li>
                                    <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                                    <li class="next disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($_SESSION["page"]+1)."&filter=".@$_REQUEST['filter'];?>" class="button">&gt;</a></li>
                                    <li class="last disabled" aria-disabled="true"><a href="<?php echo "./payment_reports.php?page=".($Page_check)."&filter=".@$_REQUEST['filter'];?>" class="button">»</a></li></ul></div>
                                    <div class="col-sm-6 infobar"style="">
                                    <div class="infos"><p align="right" style="    margin-right: -25px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> <span> of </span> <?php echo $total_no; ?><span adr_trans="label_entries">entries</span></p></div>
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

let splitAt = 1350; 

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

<?php

if(@$_REQUEST['filter']=='Photographer') { ?> 

<script>
  
  $('#radioPhotographer').click();
  radioFilter("Photographer");

</script>

<?php } 

elseif(@$_REQUEST['filter']=='RealtorCompany') { ?>

  <script>

  $('#radioRealtor').click();
   radioFilter("RealtorCompany");

</script>

<?php }?>


		<?php include "footer.php";  ?>
