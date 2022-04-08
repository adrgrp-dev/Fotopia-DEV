<?php
ob_start();

include "connection1.php";

//$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['admin_loggedin_id'];


if(isset($_REQUEST['Save']))
{

$pc_admin_id=$_REQUEST['pc_admin_id'];
$photographer_id=$_REQUEST['photographer_id'];
$product_id=$_REQUEST['product_id'];
$photography_cost=$_REQUEST['photography_cost'];

$countIS=count($product_id);

for($i=0;$i<$countIS;$i++)
{
$product_id1=$product_id[$i];
$photography_cost1=$photography_cost[$i];
mysqli_query($con,"delete from photographer_product_cost where pc_admin_id='$loggedin_id' and photographer_id='$photographer_id' and product_id='$product_id1'");
mysqli_query($con,"insert into photographer_product_cost (photographer_id,pc_admin_id,product_id,photography_cost)values('$photographer_id','$pc_admin_id','$product_id1','$photography_cost1')");

}
header("location:PhotographerProducts.php?u=1&photographer=".$photographer_id);

}
?>
<?php include "header.php";  ?>
<style>
.active
{
background:none!important;
}
.mfp-close
{
display:none!important;
}
p
{
color:#000!important;
}
th
{
    background: #aad1d6;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 3px !important;
}
.infoBar .infos p
{
	margin-right: -10px;
}

</style>
<script>
        function confirmDelete() {
            var doc;
			 var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at du vil slette produktet";
		}
		else
		{
		alertmsg="Are you sure want to delete the product";
		}

            var result = confirm(alertmsg+"?");
            if (result == true) {
               return true;
            } else {
              return false;
            }

        }

		function calculateTotal()
		{
		var product_cost=$("#product_cost").val();
		var tax=$("#tax").val();
		var total_cost1=0;
		if(tax=="")
		{
		total_cost1=parseFloat(product_cost);
		//$("#tax").val("0");
		}
		else
		{
		total_cost1=parseFloat(product_cost)+parseFloat(tax);
		}

		$("#total_cost").val(total_cost1);

		}



function chkBox()
{
 var requiredCheckboxes = $("input[type=checkbox]:checked");
 var lengthIs = $("input[type=checkbox]:checked").length;
   //alert(lengthIs);
        if(lengthIs>0) {
            $(".prodsSelected").removeAttr('required');
        } else {
		var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Vennligst velg minst ett produkt";
		}
		else
		{
		alertmsg="Please select at least one product";
		}
alert(alertmsg);
		return false;
            $(".prodsSelected").attr('required', 'required');
        }

}
    </script>
 <div class="section-empty bgimage3">
        <div class="container">



					<div id="lb2" class="box-lightbox col-md-4" style="padding:0px;color:#000!important;">

					<table align="center" class="table table-responsive"><tr><td>
					<h5 class="text-center" id="label_edit_products" adr_trans="label_edit_products" style="color:#000000!important;">Add/Edit Products</h5>

						<form name="profile" method="post" action="">
						<div class="col-md-12">

                                <p id="label_product_name" adr_trans="label_product_name" style="color:#000!important;">Product Name</p>
								<input type="hidden" name="prodid[]" value="<?php echo @$_REQUEST['prodid']; ?>" />
                               <input id="title" name="product_name" placeholder="Product name" type="text" autocomplete="off" class="form-control form-value" required value="<?php echo @$res11['product_name']; ?>" size="40" onBlur="this.value=this.value.toUpperCase();">
                            </div>
<div class="col-md-12">
                                <p id="label_description" adr_trans="label_description" style="color:#000!important;">Description</p>
       <textarea id="desc" name="desc" class="form-control form-value"><?php echo @$res11['description']; ?></textarea>
                            </div>

								<div class="col-md-12">
                                <p id="label_timeline" adr_trans="label_timeline" style="color:#000!important;">Timeline</p>
                               <input id="timeline" name="timeline"  type="text" autocomplete="off" class="form-control form-value" required value="<?php echo @$res11['timeline']; ?>">
                            </div>

							<div class="col-md-12">
                                <p id="label_product_cost" adr_trans="label_product_cost" style="color:#000!important;">Product Cost ($)</p>
                                <input id="product_cost" name="product_cost" placeholder="Product Cost" type="number" autocomplete="off" class="form-control form-value" required value="<?php echo @$res11['product_cost']; ?>" onkeyUp="calculateTotal()">
                            </div>


							<div class="col-md-12">
                                <p id="label_tax" adr_trans="label_tax" style="color:#000!important;">Tax ($)</p>
                             <input id="tax" name="tax"  type="number" autocomplete="off" class="form-control form-value"  value="<?php echo @$res11['tax']; ?>" required  onkeyUp="calculateTotal()">
                            </div>


<div class="col-md-12">
                                <p id="label_total_cost" adr_trans="label_total_cost" style="color:#000!important;">Total Cost ($)</p>
                                <input id="total_cost" name="total_cost" placeholder="Total Cost" type="number" autocomplete="off" class="form-control form-value" readonly value="<?php echo @$res11['total_cost']; ?>">
                            </div>



							<div class="col-md-12">
                                <p align="center" style="padding-top:10px;"> <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="prodbtn"><i class="fa fa-sign-in" id="label_save" adr_trans="label_save"></i>Save</button>

								  &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="Products.php"><i class="fa fa-times" id="label_cancel" adr_trans="label_cancel"></i>Cancel</a>
								</p>
                            </div>
							</form>
							</td></tr></table>


						   </div>



                    </div>
                </div>
            <div class="row">
			<hr class="space s">

                <div class="col-md-2" style="margin-left:10px;">
	<?php include "sidebar.php"; ?>

			</div>
            <div class="col-md-9" style="margin-left:40px;">
			<center>
			
			
			
			<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h5 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Step #6 of 7 : Set custom price for photographers (commissions)</h5></div> <?php } ?>
			
			
			
	<?php if(@isset($_REQUEST["d"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_product_deleted" adr_trans="label_product_deleted">Product deleted successfully</div>
                        </div>
						<?php }  ?>
				<?php if(@isset($_REQUEST["u"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_product_updated" adr_trans="label_product_updated">Product updated successfully</div>
                        </div>
						<?php }  ?>
							<?php if(@isset($_REQUEST["a"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success" id="label_product_addedd" adr_trans="label_product_addedd">Product addedd successfully</div>
                        </div>
						<?php }  ?>
						</center>

						<div class="col-md-12" style="background:#FFF;color:#000;opacity:0.8;padding:10px; border-radius:5px;width:100%;scrollbar-width: none;overflow-x: hidden;overflow-y:hidden;margin-top:25px;">

<center>
<div class="col-md-12">
<div class="col-md-4" style="border-radius:5px 0px 0px 5px;border:solid 1px;font-weight:600;padding:10px;"><a href="products.php" id="label_product_price" adr_trans="label_product_price">Products & It's Price</a></div>
<div class="col-md-4" style="border:solid 1px;font-weight:600;padding:10px;"><a href="RealtorProducts.php" id="label_realtor_custom" adr_trans="label_realtor_custom">Custom Price for Realtor</a></div>
<div class="col-md-4" style="border-radius:0px 5px 5px 0px;padding:10px;border:solid 1px;font-weight:600;color:#000;background:#aad1d6;color:#000!important;"><a href="PhotographerProducts.php" style="color:#000!important">Photographers Commission</a></div>
</div>
</center>
<br><br><br />

<div class="row">
						<div class="col-md-12">
						<div class="col-md-6" style="text-align:left;padding-left:15px;">
						<h5 class="text-left" id="label_list_products"><span  adr_trans="label_list_products" style="color:#000">List of Products</span>
						<?php


						if(@$_REQUEST['photographer']) {
						$selectrealtor123=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and id='$_REQUEST[photographer]'");
						$selectrealtor1234=mysqli_fetch_array($selectrealtor123);
						$photographernameIs=$selectrealtor1234['first_name']." ".$selectrealtor1234['last_name'];
						 echo "of ".$photographernameIs; }
						  ?>

						</div>
<div class="col-md-6" style="text-align:right">
						
						<form name="filterfrm" method="post" action="">
						<input type="text" name="photographer" class="form-control"  style="width:300px;height:30px;font-size:12px;float:right;margin-right:-35px;" list="photographers" onChange="this.form.submit();" placeholder="<?php if(empty($_REQUEST['photographer'])) { echo "Select photographer"; } else { echo $photographernameIs; } ?>" autocomplete="off">

						<datalist id="photographers">

						<?php

						$selectrealtor=mysqli_query($con,"select * from user_login where type_of_user='Photographer' and pc_admin_id='$loggedin_id'");
						while($selectrealtor1=mysqli_fetch_array($selectrealtor))
						{
						?>
						<option value="<?php echo $selectrealtor1['id']; ?>"><?php echo $selectrealtor1['first_name']; ?>&nbsp;<?php echo $selectrealtor1['last_name']; ?></option>
						<?php } ?>
						</datalist>

						
						</div></div></div>
						<hr class="space xs" />
						
						<form name="submitFrm" method="post" action="">
						  <div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
					<table class="table-striped" style="width:100%;">
                <?php
				$total_no=0;
				if(@$_REQUEST['photographer'])
				{

				$photographer_id=$_REQUEST['photographer'];


				 ?><thead>
                    <tr>
                        <th id="label_select" adr_trans="label_select">Select</th>
                        <th id="label_product_name" adr_trans="label_product_name">Product Name</th>
					<th id="label_timeline" adr_trans="label_timeline">Timeline</th>
						<th >Product Cost</th>
                        <th><span adr_trans="label_photographer_earnings">Photographer's Commission</span><span> ($)</span> </th>


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
									if($_SESSION["page"] == 0)
									{
										$_SESSION["page"]=1;
									}
									$count_query="select count(*) as total from products where pc_admin_id='$loggedin_id'";
									$count_result=mysqli_query($con,$count_query);
									$data=mysqli_fetch_assoc($count_result);
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
                  $limit=$start_no_users. ',' . $number_of_pages;
								//	print_r($limit);
								if($total_no!=0)
								{
				          $get_product_result=mysqli_query($con,"SELECT * FROM products where pc_admin_id='$loggedin_id' limit $limit");
$realtorDiscountPrice=0;
                  while($get_product=mysqli_fetch_array($get_product_result))
                  {
	                  $cnt++;
					  $proID=$get_product['id'];
                      $get_detail=mysqli_query($con,"SELECT * FROM `products` where id=$proID");
					  $get_product_price=mysqli_fetch_assoc($get_detail);

					  $realtorDiscountPrice=0;

	$realtorRate=mysqli_query($con,"select * from photographer_product_cost where pc_admin_id='$loggedin_id' and photographer_id='$photographer_id' and product_id='$proID'");

					  $rowsExist=mysqli_num_rows($realtorRate);
					  if($rowsExist>0)
					  {
					  $realtorRate1=mysqli_fetch_array($realtorRate);
					  $realtorDiscountPrice=$realtorRate1['photography_cost'];
					  

					 
					  }

				          ?>
                    <tr class="listPageTR">
                        <td scope="row"><input type="checkbox" name="product_id[]" value="<?php echo $get_product['id']; ?>" <?php if($rowsExist>0) { ?>checked<?php } ?>></td>
                        <td><?php echo $get_product['product_name']; ?></td>
						<td><?php echo $get_product['timeline']; ?></td>
						<td><?php echo $get_product_price['product_cost']; ?></td>


                        <td>
						<input type="number" name="photography_cost[]" value="<?php echo $realtorDiscountPrice; ?>" style="width:70px;" step="0.01">&nbsp;<span adr_trans="label_wo_tax">(w/o tax)</span>

						<input type="hidden" name="pc_admin_id" value="<?php echo $loggedin_id; ?>">
						<input type="hidden" name="photographer_id" value="<?php echo $photographer_id; ?>">
						</td>


                    </tr>
                    <tr><td class="listPageTRGap">&nbsp;</td></tr>
				   <?php } } else { ?>
				   <tr><td colspan="7" id="label_no_product" adr_trans="label_no_product">No products found.</td></tr>
				   <?php }  } else  { ?>

				   <center><br><span id="label_select_photographer_product" adr_trans="label_select_photographer_product" style="font-weight:600;color:#006600;">Select a Photographer from the list to show the photographer's commission for each product</span><br><br></center>

				   <?php } ?>
				 <?php
					if(@$_REQUEST['photographer']) { ?>
				 <tr><td colspan="4">&nbsp;</td><td><input type="submit" name="Save" value="Set Price" class="btn adr-save btn-sm" onClick="return chkBox()"></td></tr>
				 <?php } ?>
                </tbody>

            </table></div></form>
			<?php
			if($total_no!=0)
			{
			?>
						<div class="col-sm-6">
									<ul class="pagination ">
										<li class="first disabled" aria-disabled="true"><a href="./PhotographerProducts.php?page=1" class="button"><<</a></li>
										<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./PhotographerProducts.php?page=".($_SESSION["page"]-1);?>&photographer=<?php echo @$_REQUEST['photographer']; ?>" class="button">&lt;</a></li>
										<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
										<li class="next disabled" aria-disabled="true"><a href="<?php echo "./PhotographerProducts.php?page=".($_SESSION["page"]+1);?>&photographer=<?php echo @$_REQUEST['photographer']; ?>" class="button">&gt;</a></li>
										<li class="last disabled" aria-disabled="true"><a href="<?php echo "./PhotographerProducts.php?page=".($Page_check);?>&photographer=<?php echo @$_REQUEST['photographer']; ?>" class="button">>></a></li></ul></div>
										<div class="col-sm-6 infoBar"style="margin-top:24px">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
										</div><?php } ?>
				</div>





							</div></div></div></div>



		<?php include "footer.php";  ?>
