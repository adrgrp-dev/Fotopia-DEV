<?php
ob_start();

include "connection1.php";

//print_r($_REQUEST);
//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
if(isset($_REQUEST['label_search']))
{
	unset($_SESSION['filterby']);
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
  .infobar .infos p
  {
    margin-right: -40px;
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
    background: white;
    padding: 0px 25px;
  }
  .nav > li {
  margin-right:10px;
  }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
 <div class="section-empty bgimage2">
        <div class="" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			
               <div class="col-md-2" style="padding-left:15px;">

	<?php	if($_SESSION['admin_loggedin_type']=="PCAdmin"){
 	include "sidebar.php";
 } else {
 	include "sidebar.php";
 }
  $supercsr=$_SESSION['admin_loggedin_id'];
  ?>


			</div>
                <div class="col-md-10" style="padding-left:15px;">


                  <hr class="space s">
                  <div class="col-md-12" style="margin-top:5px;">

                          <ul class="nav nav-pills" style="margin-left:0px;">
                              <li class="active"><a href="order_reports.php" id="label_order_report" adr_trans="label_order_report" class="btn btn-default btn-sm adr-save ">Order Report</a></li>
                              <li class="active"><a href="appointment_reports.php" id="label_appointment_report" adr_trans="label_appointment_report" style="background:#FFF!important;color:#000!important;" class="btn btn-default btn-sm ">Appointment Report</a></li>
                              <li class="active"><a href="payment_reports.php" id="label_payment_report" adr_trans="label_payment_report" style="background:#FFF!important;color:#000!important;" class="btn btn-default btn-sm ">Payment Report</a></li>
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

<div class="row" style="width:100%;margin-left:3px;"> 
<form>
<div class="col-md-2" style="padding-left:0px;">
<p><h5 id="label_from_date" adr_trans="label_from_date">From Date</h5></p>
<input type="date" onchange="setSecondDate();" id="start" value="<?php echo @$_REQUEST['starting']?>" name="starting" class="form-control" style="padding-left:5px;width:160px;height:30px">
</div>
<div class="col-md-2" style="padding-left:5px;">
<p><h5 id="label_to_date" adr_trans="label_to_date">To Date</h5></p>
<input type="date" id="end" name="ending" value="<?php echo @$_REQUEST['ending']?>" class="form-control" style="padding-left:2px;width:160px;height:30px">
</div>

<div class="col-md-3" style="padding-left:15px;margin-top:5px;<?php if($_SESSION['admin_loggedin_type']=="PCAdmin"){  echo "width:230px!important"; } else
{ echo "width:140px!important"; } ?>;">
<p><h5 id="label_filter_by" adr_trans="label_filter_by">Filter By</h5></p>
<?php
if($_SESSION['admin_loggedin_type']=="PCAdmin"){ ?>
<input type="radio" value="realtor" name="filter"  <?php if(@$_REQUEST['filter']!='photographer'){echo'checked';} ?> onchange="filter1(this.value)">&nbsp;&nbsp;<span adr_trans="label_realtor" style="font-size:13px;color:#666666;">Realtor</span>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio"  value="photographer" id="photographer_radioID" name="filter" <?php if(@$_REQUEST['filter']=='photographer'){echo'checked';} ?> onchange="filter1(this.value)" onclick="filter1(this.value)">&nbsp;&nbsp;<span adr_trans="label_photographer" style="font-size:13px;color:#666666;">Photographer</span>&nbsp;
<?php if($_SESSION['admin_loggedin_type']=="CSR"){ ?><input type="radio" value="csr" name="filter" onchange="filter1(this.value)"><span adr_trans="label_csr">CSR</span>&nbsp;<?php } ?>
<?php }
else{?>

<input type="radio" value="photographer" id="photographer_radioID" name="filter" <?php if(@$_REQUEST['filter']=='photographer'){echo'checked';} ?>  onchange="filter1(this.value)" onclick="filter1(this.value)">&nbsp;&nbsp;<span id="label_photographer" adr_trans="label_photographer">Photographer</span>&nbsp;

<?php  } ?>
</div>

<div class="col-md-2" style="width:200px!important;">
  <?php
if($_SESSION['admin_loggedin_type']=="PCAdmin"){ ?>

<select name="realtor" id="realtor" class="form-control" style="display:block;margin-top:22px;width:200px;height:30px;font-size:13px;padding:0px 0px 0px 5px">
<option value="">Select Realtor</option>

 <?php
              $realtor=mysqli_query($con,"select distinct(first_name),id from user_login where type_of_user='Realtor' and email_verified=1");

              while($realtor1=mysqli_fetch_array($realtor))
              {
              ?>
              <option value="<?php echo $realtor1['id']; ?>" <?php if($realtor1['id']==@$_REQUEST['realtor']){ echo "selected";}?>><?php echo $realtor1['first_name']; ?></option>
              <?php } ?>

</select>
<?php } ?>

<select name="photographer10" id="photographer"  class="form-control" style="display:none;margin-top:22px;width:200px;height:30px;font-size:13px;padding:0px 0px 0px 5px">
<option value="">Select Photographer</option>

<?php
if($_SESSION['admin_loggedin_type']=="PCAdmin"){

     $photographer=mysqli_query($con,"select distinct(first_name),id from user_login where type_of_user='Photographer' and pc_admin_id='$supercsr' ");
              while($photographer1=mysqli_fetch_array($photographer))
              {
              ?>
              <option value="<?php echo $photographer1['id']; ?>" <?php if($photographer1['id']==@$_REQUEST['photographer10']){ echo "selected";}?>><?php echo $photographer1['first_name']; ?></option>
              <?php }

}
elseif($_SESSION['admin_loggedin_type']=="CSR"){

	$photographer=mysqli_query($con,"select distinct(first_name),id from user_login where type_of_user='Photographer' and csr_id='$supercsr' ");

	while($photographer1=mysqli_fetch_array($photographer))
	{
	?>
	<option value="<?php echo $photographer1['id']; ?>" <?php if($photographer1['id']==@$_REQUEST['photographer10']){ echo "selected";}?>><?php echo $photographer1['first_name']; ?></option>
	<?php }

}
else{
            $photographer=mysqli_query($con,"select distinct(first_name),id from user_login where type_of_user='Photographer'");

              while($photographer1=mysqli_fetch_array($photographer))
              {
              ?>
              <option value="<?php echo $photographer1['id']; ?>"><?php echo $photographer1['first_name']; ?></option>
              <?php }} ?>
</select>
<?php  if($_SESSION['admin_loggedin_type']=="PCAdmin"){?>
<select name="csr10" id="csr" class="form-control"  style="display:none;margin-top:22px;width:150px;">
<option value="">Select CSR</option>

<?php
if($_SESSION['admin_loggedin_type']!="PCAdmin"){
              $csr=mysqli_query($con,"select distinct(first_name),id from admin_users where type_of_user='PCAdmin'");

              while($csr1=mysqli_fetch_array($csr))
              {
              ?>
              <option value="<?php echo $csr1['id']; ?>"><?php echo $csr1['first_name']; ?></option>
              <?php } }?>
</select>
  <?php } ?>
  
  
</div>

<div class="col-md-3" style="margin-top:22px;width:220px;margin-left:20px; float:right">
<button type="submit" name="label_search" id="label_search" adr_trans="label_search" class="btn adr-save btn-sm" style="padding: 6px 10px !important;height:30px; margin-left:<?php if($_SESSION['admin_loggedin_type']=="PCAdmin"){ echo "-10px"; } else { echo "-100px"; } ?>;">Search</button>
<a href="#" onclick="Orders()"><i class="fa fa-file-pdf-o" style="color:#F20F00;font-size:28px;padding-left:10px;vertical-align: middle;float:right" title="Download PDF"></i></a>&nbsp;&nbsp;
<a href="#" class="dataExport" data-type="excel"><i class="fa fa-file-excel-o" style="color:#117C43;font-size:28px;padding-left:10px;vertical-align: middle;float:right" title="Download Excel"></i></a>
								</div>
</div>
</form>




			<div style="margin-top: 5px;width:100%;background-color:white">
                          <div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
                            <table id="dataTable" align="center" class="table-striped" style="background:#FFF;color:#000;opacity:0.8;width:98%;">
							
                                  <thead>
								  <hr class="space xs" />
				<!--<tr><th colspan="8" align="center" ><center><b><br /><span adr_trans="label_order_report">Order Reports</span><br /></b></center></th></tr>
-->                                      <tr><th data-column-id="id" class="text-left" style=""><span class="text" id="label_s.no" adr_trans="label_s.no">

                                            S.No

                                          </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text" id="label_property" adr_trans="label_property">
                                            Property
                                          </span>
                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" id="label_photographer" adr_trans="label_photographer">

                                           Photographer


                                          </span>


                              <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" id="label_session_date_time" adr_trans="label_session_date_time">

                                         Session Date & Time


                                          </span>

                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" id="label_products" adr_trans="label_products">


                                          Products


                                          </span>

                                          <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" id="label_total_value" adr_trans="label_total_value">

                                        Total Value


                                          </span>

                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span adr_trans="label_created_by">Created By</span> / <span class="text" id="label_realtor" adr_trans="label_realtor">

                                          Realtor

                                          </span>


                              <span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                                  Status

                                          </span>	</th></tr>
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
if(!empty($_REQUEST['photographer10'])&&(@$_REQUEST['filter']=="photographer"))
{
	$filterbyid=$_REQUEST['photographer10'];
}
if (!empty($_REQUEST['csr10'])) {
	$filterbyid=$_REQUEST['csr10'];
}
if (!empty($_REQUEST['realtor'])&&(@$_REQUEST['filter']=="realtor")) {
		$filterbyid=$_REQUEST['realtor'];
}
//	$_SESSION['filterby']=$filterBy;
	if(isset($_SESSION['filterby']))
	{
		//echo $_SESSION['filterby'];
			$filterBy=$_SESSION['filterby'];
	}
elseif((!empty($_REQUEST['photographer10']) || !empty($_REQUEST['realtor']) || !empty($_REQUEST['csr10'])) && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending'])))
{
	$starting=$_REQUEST['starting'];
		$ending=$_REQUEST['ending'];

		if(!empty($_REQUEST['csr10']))$filterBy=" super_csr_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
	if(!empty($_REQUEST['photographer10']) || !empty($_REQUEST['realtor']))
     if(@$_REQUEST['filter']=="realtor")
      $filterBy=" realtor_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
    else
      $filterBy="photographer_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
    


  //$filterBy=" created_by_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
//  $filterBy1=" where created_by_id=".$filterbyid." AND DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";

		$_SESSION['filterby']=$filterBy;
}

elseif((empty($_REQUEST['photographer10']) && empty($_REQUEST['realtor']) && empty($_REQUEST['csr10'])) && (!empty($_REQUEST['starting']) && !empty($_REQUEST['ending'])))
{
	$starting=$_REQUEST['starting'];
		$ending=$_REQUEST['ending'];
 $filterBy=" DATE(session_from_datetime) BETWEEN '$starting' AND '$ending'";
//		$filterBy1=" created_by_id=".$_REQUEST['realtor']." ";
		$_SESSION['filterby']=$filterBy;
}


if((!empty($_REQUEST['photographer10']) || !empty($_REQUEST['realtor']) || !empty($_REQUEST['csr10'])) && (empty($_REQUEST['starting']) && empty($_REQUEST['ending'])))
{
	if(!empty($_REQUEST['csr10']))$filterBy=" super_csr_id=".$filterbyid;
	if(!empty($_REQUEST['photographer10']) || !empty($_REQUEST['realtor']))
    if(@$_REQUEST['filter']=="realtor")
      $filterBy=" realtor_id=".$filterbyid;
    else
      $filterBy="photographer_id=".$filterbyid;



 //	$filterBy1=" super_csr_id=".$_REQUEST['csr10']." ";
		$_SESSION['filterby']=$filterBy;
}

                            if ((isset($_REQUEST['starting']) && isset($_REQUEST['ending'])))
														{
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
                              // echo "select count(*) as total FROM `orders`  WHERE $filterBy  DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
														  $q1="select count(*) as total FROM `orders` where $filterBy ";
														}
                          }

                          elseif (!empty($_SESSION['starting_time'])) {
                            $start = $_SESSION['starting_time'];
                             $end = $_SESSION['ending_time'] ;
                             if (isset($_SESSION['filterby'])) {
                               
                               $filterBy=$_SESSION['filterby'] ;
                               
                             }
														 

                            if($_SESSION['admin_loggedin_type']=="PCAdmin")
                           {
                              $q1="select count(*) as total FROM `orders` where $filterBy and pc_admin_id=$supercsr ";
                            }
														elseif($_SESSION['admin_loggedin_type']=="CSR")
													 {
															$q1="select count(*) as total FROM `orders` where $filterBy and csr_id=$supercsr ";
														}
                            else {

                              $q1="select count(*) as total FROM `orders` where $filterBy ";
                            }

                          }
                          else{

                          if($_SESSION['admin_loggedin_type']=="PCAdmin")
                           {
                              $q1="select count(*) as total FROM `orders` where $filterBy and pc_admin_id=$supercsr ";
                            }
														elseif($_SESSION['admin_loggedin_type']=="CSR")
	                           {
	                              $q1="select count(*) as total FROM `orders` where $filterBy and csr_id=$supercsr ";
	                            }
                            else {
                              $q1="select count(*) as total FROM `orders` where $filterBy ";
                            }
                          }
													//echo $q1;

$res="";

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
                          $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

                           $cnt=$start_no_users;

                           if (isset($_REQUEST['starting']) && isset($_REQUEST['ending'])) {

                             $_SESSION['starting_time'] = $_REQUEST['starting'];
                             $_SESSION['ending_time'] = $_REQUEST['ending'];

                            $start = $_SESSION['starting_time'];
                            $end = $_SESSION['ending_time'] ;

														if($_SESSION['admin_loggedin_type']=="PCAdmin")
	                           {
															  $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages ";
													  	}
															elseif($_SESSION['admin_loggedin_type']=="CSR")
															 {
																	$res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages ";
																}

															else {
	                              // echo "select count(*) as total FROM `orders`  WHERE $filterBy  DATE(session_from_datetime)  BETWEEN  '$start' AND '$end' order by session_from_datetime asc";
															  $res="select * FROM `orders` where $filterBy limit $start_no_users ,$number_of_pages";
															}
	                          }

	                          elseif (!empty($_SESSION['starting_time'])) {
	                            $start = $_SESSION['starting_time'];
	                             $end = $_SESSION['ending_time'] ;
															 if (isset($_SESSION['filterby'])) {
                               
                               $filterBy=$_SESSION['filterby'] ;
                               
                             }

	                            if($_SESSION['admin_loggedin_type']=="PCAdmin")
	                           {
	                              $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages";
	                            }
															elseif($_SESSION['admin_loggedin_type']=="CSR")
														{
															 $res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages";
														 }
	                            else {

	                              $res="select * FROM `orders` where $filterBy limit $start_no_users ,$number_of_pages";
	                            }

	                          }
	                          else{

	                          if($_SESSION['admin_loggedin_type']=="PCAdmin")
	                           {
	                              $res="select * FROM `orders` where $filterBy and pc_admin_id=$supercsr limit $start_no_users ,$number_of_pages";
	                            }
															elseif($_SESSION['admin_loggedin_type']=="CSR")
		                           {
		                              $res="select * FROM `orders` where $filterBy and csr_id=$supercsr limit $start_no_users ,$number_of_pages";
		                            }
	                            else {
	                              $res="select * FROM `orders` where $filterBy limit $start_no_users ,$number_of_pages";
	                            }

	                          }

								@$res1=mysqli_query($con,@$res);
								 //echo "<br>".$res;

                           if(@$res1)
                            {
                          while(@$get_order=mysqli_fetch_assoc($res1))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr data-row-id="0" class="listPageTR">
                          <td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
                          <?php
                            $hs_id=$get_order["home_seller_id"];
                            $get_home_query=mysqli_query($con,"select * from home_seller_info where id=$hs_id");
                            $get_home=mysqli_fetch_assoc($get_home_query);
                           ?>
                          <td class="text-left" style=""><?php echo $get_order["property_type"]; ?> <br><?php echo @$get_home["city"].",".@$get_home['state'];?></td>
                          <?php
                          $photographer_id=$get_order['photographer_id'];
													 $order_id=$get_order['id'];
                          $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                          $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                          $photographer_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
                          ?>
                          <td class="text-left" style=""><?php echo $photographer_Name; ?></td>
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
                          <td class="text-left" style="word-wrap:break-word;width:200px"><?php  echo @substr($prodName,0,-1); ?></td>



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
													 $total_cost=mysqli_query($con,"SELECT sum(total_price) as totalPrice from order_products WHERE order_id='$order_id'");
															$total_cost1=mysqli_fetch_array($total_cost);

													?>
                          <td class="text-left" style=""><?php echo "$".@$total_cost1['totalPrice']; ?></td>
                          <?php
                        $created_by_id=$get_order['created_by_id'];
						   $pcAdminId=$get_order['pc_admin_id'];
							 $csr_id=$get_order['csr_id'];
						   $createdByQr="";
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

                          <td class="text-left" style=""><?php echo $created_name; ?></td>
                          <td class="text-left" style=""><?php $status=$get_order['status_id'];if($status==1) { echo "<span id='label_created' adr_trans='label_created' style='color: #000; font-weight: bold;display: block; background: #86C4F0;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>Created</span>"; } elseif($status==2){echo "<span id='label_wip' adr_trans='label_wip' style='color: #000; font-weight: bold;display: block; background: #FF8400; padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>WIP</span>";}elseif($status==3){echo "<span id='label_completed' adr_trans='label_completed' style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>completed</span>";}elseif($status==4){echo "<span id='label_rework' adr_trans='label_rework' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>Rework</span>";}elseif($status==6){echo "<span id='label_declined' adr_trans='label_declined' style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>Declined</span>";}elseif($status==7){echo "<span id='label_working_customer' adr_trans='label_working_customer' style='color: #000; font-weight: bold;display: block; background: orange;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>Working with Customer</span>";}elseif($status==5){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;'>Cancelled</span>";}elseif($status==8){echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;width:70px;' id='' adr_trans=''>Reopen</span>";} ?></td>

                          </tr>
                           <tr><td class="listPageTRGap">&nbsp;</td></tr>
												<?php }} ?>
												</tbody>
                              </table></div></div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled " aria-disabled="true"><a href="./order_reports.php?page=1" class="button">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
																		<div class="col-sm-6 infobar"style="">
																		<div class="infos"><p align="right" style="    margin-right: -px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> <span> of </span> <?php echo $total_no; ?><span adr_trans="label_entries">entries</span></p></p></div>
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
if($_SESSION['admin_loggedin_type']=="CSR"){
?><script>

$("#photographer").css("display","none");
</script>
<?php }
?>

<?php

if(@$_REQUEST['filter']=='photographer'){
?>

<script>

$('#photographer_radioID').click();

</script>
<?php

}

?>
<?php if($_SESSION['admin_loggedin_type']!="PCAdmin"){ ?> 
  <script>$("#photographer_radioID").click(); 
 
  </script>
  <?php } ?>

		<?php include "footer.php";  ?>
