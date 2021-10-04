<?php
ob_start();

include "connection1.php";

$loggedin_name=$_SESSION['admin_loggedin_name'];
$loggedin_id=$_SESSION['admin_loggedin_id'];


if(isset($_REQUEST['Save']))
{

$pc_admin_id=$_REQUEST['pc_admin_id'];
$realtor_id=$_REQUEST['realtor_id'];
$product_id=$_REQUEST['product_id'];
$product_cost=$_REQUEST['product_cost'];
$discount_price=$_REQUEST['discount_price'];


mysqli_query($con,"delete from realtor_product_cost where pc_admin_id='$loggedin_id' and realtor_id='$realtor_id'");

$countIS=count($product_id);

for($i=0;$i<$countIS;$i++)
{
$product_id1=$product_id[$i];
$product_cost1=$product_cost[$i];
$discount_price1=$discount_price[$i];

mysqli_query($con,"insert into realtor_product_cost (realtor_id,pc_admin_id,product_id,product_cost,discount_price)values('$realtor_id','$pc_admin_id','$product_id1','$product_cost1','$discount_price1')");

}
header("location:RealtorProducts.php?u=1&realtor=".$realtor_id);

}
?>
<?php include "header.php";  ?>
<style>
p{
		font-weight:bold;
		padding-bottom:0px;
	}
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
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
{
border-top:none!important;
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
    </script>
 <div class="section-empty bgimage3">
        <div class="container">



					<div id="lb2" class="box-lightbox col-md-4" style="padding:0px;color:#000!important;border-radius:25px;">

					<table class="table table-responsive"><tr><td>
					<h5 class="text-center" id="label_edit_products" adr_trans="label_edit_products" style="color:#000000!important;">Add/Edit Products</h5>

						<form name="profile" method="post" action="">
						<div class="col-md-12">

                                <p id="label_product_name" adr_trans="label_product_name" style="color:#000!important;">Product Name</p>
								<input type="hidden" name="prodid" value="<?php echo @$_REQUEST['prodid']; ?>" />
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

						<div class="col-md-12" style="background:#FFF;color:#000;opacity:0.8;padding:10px;border:solid 1px #000;">

<center>
<div class="col-md9">
<div class="col-md-4" style="border-radius:25px 0px 0px 25px;border:solid 1px;font-weight:600;padding:10px;"><a href="products.php" id="label_product_price" adr_trans="label_product_price">Products & It's Price</a></div>
<div class="col-md-4" style="border:solid 1px;background:#ddd;color:#000;font-weight:600;padding:10px;background:#000;color:#FFF!important;"><a id="label_realtor_custom" adr_trans="label_realtor_custom" href="RealtorProducts.php" style="color:#FFF!important;">Custom Price for Realtor</a></div>
<div class="col-md-4" style="border-radius:0px 25px 25px 0px;border:solid 1px;font-weight:600;padding:10px;"><a href="PhotographerProducts.php" id="label_photographer_custom" adr_trans="label_photographer_custom">Custom Price for Photographers</a></div>
</div>
</center>
<br><br><br />
						<h5 class="text-center" id="label_list_products" adr_trans="label_list_products">List of Products
						<?php


						if(@$_REQUEST['realtor']) {

							$selectrealtor123=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and id='$_REQUEST[realtor]'");
						$selectrealtor1234=mysqli_fetch_array($selectrealtor123);

						echo "of ".$selectrealtor1234['first_name']." ".$selectrealtor1234['last_name']; } ?>

						</h5>

						<p align="left">
						<form name="filterfrm" method="post" action="">
						<input type="text" name="realtor" class="form-control" style="width:200px;" list="realtors" onChange="this.form.submit();" placeholder="Select Realtor">

						<datalist id="realtors">

						<?php
						$selectrealtor=mysqli_query($con,"select * from user_login where type_of_user='Realtor'");
						while($selectrealtor1=mysqli_fetch_array($selectrealtor))
						{
						?>
						<option value="<?php echo $selectrealtor1['id']; ?>"><?php echo $selectrealtor1['first_name']; ?>&nbsp;<?php echo $selectrealtor1['last_name']; ?></option>
						<?php } ?>
						</datalist>

						</form>
						</p>
						  <div style="width:100%;overflow:scroll">
					<table class="table-striped" style="width:100%;">
                <?php
				$total_no=0;
				if(@$_REQUEST['realtor'])
				{

				$realtor_id=$_REQUEST['realtor'];


				 ?><thead>
                    <tr>
                        <th>#</th>
                        <th id="label_product_name" adr_trans="label_product_name">Product Name</th>
						<th><span adr_trans="label_timeline">Timeline</span></th>
                        <th><span adr_trans="label_product_cost">Product Cost</span><span> ($)</span></th>
						 <th><span adr_trans="label_discount_price">Discount Price</span><span> ($)</span></th>
                    </tr>

                </thead>
<form name="submitFrm" method="post" action="">
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

					  $realtorDiscountPrice=$get_product['total_cost'];

	$realtorRate=mysqli_query($con,"select * from realtor_product_cost where pc_admin_id='$loggedin_id' and realtor_id='$realtor_id' and product_id='$proID'");

					  $rowsExist=mysqli_num_rows($realtorRate);
					  if($rowsExist>0)
					  {
					  $realtorRate1=mysqli_fetch_array($realtorRate);
					  $realtorDiscountPrice=$realtorRate1['discount_price'];
					  }

				          ?>
                    <tr>
                        <th scope="row"><?php echo $cnt;?></th>
                        <td><?php echo $get_product['product_name']; ?></td>
						<td><?php echo $get_product['timeline']; ?></td>
                        <td><?php echo $get_product['total_cost']; ?></td>
                        <td>
						<input type="number" name="discount_price[]" value="<?php echo $realtorDiscountPrice; ?>" style="width:70px;" max="<?php echo $get_product['total_cost']; ?>">
						<input type="hidden" name="product_cost[]" value="<?php echo $get_product['total_cost']; ?>">
						<input type="hidden" name="product_id[]" value="<?php echo $get_product['id']; ?>">
						<input type="hidden" name="pc_admin_id" value="<?php echo $loggedin_id; ?>">
						<input type="hidden" name="realtor_id" value="<?php echo $realtor_id; ?>">
						</td>


                    </tr>

				   <?php } } else { ?>
				   <tr><td colspan="7" id="label_no_product" adr_trans="label_no_product">No products found.</td></tr>
				   <?php }  } else  { ?>

				   <center><br><span id="label_select_realtor_price" adr_trans="label_select_realtor_price" style="font-weight:600;color:#006600;">Select a Realtor from the list to show the Realtor based product discount price</span><br><br></center>

				   <?php } ?>
				   <?php
					if(@$_REQUEST['realtor']) { ?>
				 <tr><td colspan="4">&nbsp;</td><td><input type="submit" name="Save" value="Set Price" class="btn btn-default btn-sm"></td></tr>
				 <?php } ?>
                </tbody>
				</form>
            </table></div>
			<?php
			if($total_no!=0)
			{
			?>
						<div class="col-sm-6">
									<ul class="pagination ">
										<li class="first disabled" aria-disabled="true"><a href="./super_Product.php?page=1" class="button adr-save">�</a></li>
										<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./super_Product.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
										<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
										<li class="next disabled" aria-disabled="true"><a href="<?php echo "./super_Product.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
										<li class="last disabled" aria-disabled="true"><a href="<?php echo "./super_Product.php?page=".($Page_check);?>" class="button adr-save">�</a></li></ul></div>
										<div class="col-sm-6 infoBar"style="margin-top:24px">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
										</div><?php } ?>
				</div>


					<?php

					if(isset($_REQUEST['edit']))
					{
					$prodid=$_REQUEST['prodid'];
					$result=mysqli_query($con,"select * from products where id='$prodid'");
               //echo "select * from photographer_profile where photographer_id='$loggedin_id";
              $res11=mysqli_fetch_array($result);

					}

					?>


							</div></div></div></div>

            <?php if(@$_REQUEST['edit'])
			{
			?>
			<script>
			$( document ).ready(function() {
   $("#addedit").click();
});

			</script>

			<?php } ?>


		<?php include "footer.php";  ?>
