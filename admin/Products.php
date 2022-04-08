<?php
ob_start();

include "connection1.php";

$loggedin_name=$_SESSION['admin_loggedin_name'];
$loggedin_id=$_SESSION['admin_loggedin_id'];

if(@$_REQUEST['edit'])
{
$prodid=$_REQUEST['prodid'];
$res1=mysqli_query($con,"select * from products where id='$prodid'");
$res11=mysqli_fetch_array($res1);
}

if(isset($_REQUEST['del']))
{
$prodid=$_REQUEST['prodid'];

mysqli_query($con,"delete from products where id='$prodid'");

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Product','Deleted','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

header("location:super_Product.php?d=1");
}
if(isset($_REQUEST['prodbtn']))
{

$prodid=$_REQUEST['prodid'];
$product_name=$_REQUEST['product_name'];
$product_cost=$_REQUEST['product_cost'];
$tax=$_REQUEST['tax'];
// $bata=$_REQUEST['bata'];
$total_cost=$_REQUEST['total_cost'];
$timeline=$_REQUEST['timeline'];
$desc=$_REQUEST['desc'];



if($prodid=="")
{


mysqli_query($con,"insert into products (product_name,product_cost,tax,total_cost,timeline,description,pc_admin_id)values('$product_name','$product_cost','$tax','$total_cost','$timeline','$desc','$loggedin_id')");

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Product','Created','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

header("location:products.php?a=1");
}
else
{
mysqli_query($con,"update products set product_name='$product_name',product_cost='$product_cost',tax='$tax',total_cost='$total_cost',timeline='$timeline',description='$desc',pc_admin_id='$loggedin_id' where id='$prodid'");

$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `pc_admin_id`,`action_date`) VALUES ('Product','Updated','$loggedin_name',$loggedin_id,'PCAdmin',$loggedin_id,now())");

header("location:products.php?u=1");
}
}
?>
<?php include "header.php";  ?>
<style>
/*p{
		font-weight:bold;
		padding-bottom:0px;
	}*/
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
		if(tax=="" || tax==0)
		{
		total_cost1=parseFloat(product_cost);
		//$("#tax").val("0");
		}
		else
		{
		var percentage=(product_cost*tax)/100;
		total_cost1=parseFloat(product_cost)+parseFloat(percentage);
		}

		$("#total_cost").val(total_cost1);

		}
    </script>
 <div class="section-empty bgimage3">
        <div class="container">

		<?php
		$taxPercent=0;
		$tax1=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedin_id'");
		$tax=mysqli_fetch_array($tax1);
		$taxPercent=$tax['tax'];
		?>

					<div id="lb2" class="box-lightbox col-md-4" style="padding:20px;border-radius:25px;color:#000!important;">
                   <div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
					<table class="table table-striped" style="width:100%;"><tr><td>
					
					
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
                                <p id="label_tax" adr_trans="label_tax" style="color:#000!important;">Tax (%)</p>
                             <input id="tax" name="tax"  type="number" autocomplete="off" class="form-control form-value"  value="<?php echo @$taxPercent; ?>" required  readonly="">
                            </div>


<div class="col-md-12">
                                <p id="label_total_cost" adr_trans="label_total_cost" style="color:#000!important;">Total Cost ($)</p>
                                <input id="total_cost" name="total_cost" placeholder="Total Cost" type="number" autocomplete="off" class="form-control form-value" readonly value="<?php echo @$res11['total_cost']; ?>">
                            </div>



							<div class="col-md-12">
                                <p align="center" style="padding-top:10px;"> <button class="anima-button circle-button btn-sm btn adr-save" type="submit" name="prodbtn"><i class="fa fa-sign-in"></i><span adr_trans="label_save">Save</span></button>

								  &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="Products.php"><i class="fa fa-times"></i><span adr_trans="label_cancel">Cancel</span></a>
								</p>
                            </div>
							</form>
							</td></tr></table></div>


						   </div>



                    </div>
                </div>
            <div class="row">
			<hr class="space xs">

                <div class="col-md-2" style="margin-left:10px;">
                	<hr class="space xs">
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
						<?php if(@$_REQUEST['first']) { ?><div class="col-md-12"><h5 align="center" id="label_add_company_profile" style="color:#006600!important;font-size:13px;">Step #2 of 2 : Set up products for Photo company</h5></div> <?php } ?>
						</center>
						<a class="lightbox btn adr-save btn-sm circle-button" id="addedit" href="#lb2" data-lightbox-anima="show-scale" style="float:right;margin-bottom:10px;"><span id="label_add_new_product" adr_trans="label_add_new_product">+Add Product</span></a>
						
						<div class="col-md-12" style="background:#FFF;color:#000;opacity:0.8;padding:10px; width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden;border-radius: 5px;margin-top: -5px;">

<center>
<div class="col-md9">
<div class="col-md-4" style="border-radius:5px 0px 0px 5px;border:solid 1px;background:#aad1d6;color:#000!important;font-weight:600;padding:10px;"><a id="label_product_price" adr_trans="label_product_price" href="products.php" style="color:#000!important">Products & It's Price</a></div>
<div class="col-md-4" style="border:solid 1px;font-weight:600; padding:10px;"><a id="label_realtor_custom" adr_trans="label_realtor_custom" href="RealtorProducts.php" style="">Custom Price for Realtor</a></div>
<div class="col-md-4" style="border-radius:0px 5px 5px 0px;border:solid 1px;font-weight:600;padding:10px;"><a  href="PhotographerProducts.php">Photographers Commission</a></a></div>
</div>
</center>
<!--
						<h5 class="text-center" id="label_list_products" adr_trans="label_list_products">List of Products</h5>-->
						  <div style="width:100%;">
						  <hr class="space xs" />
					<table align="center" class="table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th id="label_product_name" adr_trans="label_product_name">Product Name</th>
                        <th style="width:70px"><span adr_trans="label_product_cost">Product Cost</span><span> ($)</span></th>
						 <th style="width:50px" id="label_tax" adr_trans="label_tax">Tax</th>
						 <th><span adr_trans="label_total_cost">Total Cost ($)</span><br />&nbsp;&nbsp;(Incl. Tax)</th>
						 <th id="label_timeline" adr_trans="label_timeline">Timeline</th>
						  <th id="label_description" adr_trans="label_description">Description</th>
						 <th align="center"><span adr_trans="label_action">Action</span></th>
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

                  while($get_product=mysqli_fetch_array($get_product_result))
                  {
	                  $cnt++;
				          ?>
                    <tr class="listPageTR">
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $get_product['product_name']; ?></td>
                        <td><?php echo $get_product['product_cost']; ?></td>
                        <!-- <td><?php //echo $get_product['photographer_bata']; ?></td> -->
					             	<td><?php echo $get_product['tax']; ?></td>
                        <td><?php echo $get_product['total_cost']; ?></td>
						<td><?php echo $get_product['timeline']; ?></td>
						<td style="word-wrap:break-word;width:220px;white-space: pre-wrap;"><b id="label_description" adr_trans="label_description">Description </b>: <?php echo $get_product['description']; ?></td>
				                <td align="left"><a  href="products.php?prodid=<?php echo $get_product['id']; ?>&edit=1"  style="color:#000"><i class="fa fa-pencil fa-lg" title="Edit"></i></a> &nbsp;&nbsp;&nbsp;
				                 <a href="products.php?prodid=<?php echo $get_product['id']; ?>&del=1" onclick="return confirmDelete();" style="color:#000!important"><i class="fa fa-trash-o fa-lg" title="Delete" style="color:#000"></i></a>
						            </td>
                    </tr>
                    <tr><td class="listPageTRGap">&nbsp;</td></tr>



				   <?php } } else { ?>
				   <tr><td colspan="7" id="label_no_product" adr_trans="label_no_product">No products found.</td></tr>
				   <?php } ?>
                </tbody>
            </table></div>
			<?php
			if($total_no!=0)
			{
			?>
						<div class="col-sm-6">
									<ul class="pagination ">
										<li class="first disabled" aria-disabled="true"><a href="./Products.php?page=1" class="button"><<</a></li>
										<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./Products.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
										<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
										<li class="next disabled" aria-disabled="true"><a href="<?php echo "./Products.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
										<li class="last disabled" aria-disabled="true"><a href="<?php echo "./Products.php?page=".($Page_check);?>" class="button">>></a></li></ul></div>
										<div class="col-sm-6 infoBar"style="margin-top:22px">
										<div class="infos"><p align="right" style=""><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> <span> of </span> <?php echo $total_no; ?> <span adr_trans="label_entries"> entries</span></p></div>
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
