<?php
ob_start();

include "connection1.php";

$loggedin_name=$_SESSION['admin_loggedin_name'];
$loggedin_id=$_SESSION['admin_loggedin_id'];

?>
<?php include "header.php";  ?>
<style>
p{
		font-weight:bold;
		padding-bottom:0px;
	}

@media only screen and (max-width: 600px) {
.infos
{
margin-left: 0px !important;
margin-top: -50px !important;
margin-right: -25px !important;
}

}
th{

    background: #aad1d6;
    padding-top: 10px !important;
    padding-bottom: 10px;
    padding-left: 3px !important;
}

</style>

 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">

                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10" style="background:#FFF;color:#000;opacity:0.8;padding:10px;margin-top: 24px;border-radius: 5px;">

					<table class="table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th style="padding-left:30px!important;width:100px;">#</th>
                        <th><span adr_trans="label_product_name">Product name</span></th>
                        <th><span adr_trans="label_timeline">Timeline</span></th>
                        <th><span adr_trans="label_product_cost">Product cost</span></th>
                        <th><span adr_trans="label_description">Description</th>
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

									$res=mysqli_query($con,"SELECT * FROM admin_users where id='$loggedin_id'");

									$res1=mysqli_fetch_array($res);
									$pc_admin_id =  $res1['pc_admin_id'];


									$count_query="select count(*) as total FROM products where id in(select product_id from photographer_product_cost where photographer_id in(select id from user_login where csr_id=$loggedin_id))";

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

						 // $res=mysqli_query($con,"select * from  `photographer_product_cost` where photographer_id=$loggedin_id");

							// 		$res1=mysqli_fetch_array($res);
							// 		$photo_cost =  $res1['photography_cost'];



								 $get_product_result=mysqli_query($con,"SELECT * FROM products where id in(select product_id from photographer_product_cost where photographer_id in(select id from user_login where csr_id=$loggedin_id)) limit $limit");



                  while($get_product=mysqli_fetch_array($get_product_result))
                  {
	                  $cnt++;
				          ?>
                    <tr class="listPageTR">
                        <td scope="row" style="padding-left:30px!important;;"><?php echo $cnt;?></td>
                        <td><?php echo $get_product['product_name']; ?></td>
                        <td><?php echo $get_product['timeline']; ?></td>
                        <td><?php echo $get_product['product_cost']; ?></td>
				        <td style="width:450px"><b id="label_description" adr_trans="label_description">Description </b>: <?php echo $get_product['description']; ?></td>
                    </tr>
                    <tr><td class="listPageTRGap">&nbsp;</td></tr>


				   <?php } } else { ?>
				   <tr><td colspan="7" id="label_no_product" adr_trans="label_no_product">No products found.</td></tr>
				   <?php } ?>
                </tbody>
            </table>
			<?php
			if($total_no!=0)
			{
			?>
						<div class="col-sm-6">
									<ul class="pagination ">
										<li class="first disabled" aria-disabled="true"><a href="./csr_products.php?page=1" class="button">«</a></li>
										<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./csr_products.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
										<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
										<li class="next disabled" aria-disabled="true"><a href="<?php echo "./csr_products.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
										<li class="last disabled" aria-disabled="true"><a href="<?php echo "./csr_products.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
										<div class="col-sm-6 infoBar"style="margin-top:24px">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
										</div><?php } ?>





							<!-- </div> -->


</div>




            </div>

		</div>
		<?php include "footer.php";  ?>
