<?php
ob_start();

include "connection1.php";

$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];

?>
<?php include "header.php";  ?>
<style>
/*p{
		font-weight:bold;
		padding-bottom:0px;
	}*/
@media only screen and (max-width: 800px) {



	#flip-scroll table { display: block; position: relative; width: 100%; }
	#flip-scroll thead { display: block; float: left; }
	#flip-scroll tbody { display: block; width: auto; position: relative; overflow-x: auto; white-space: nowrap; }
	#flip-scroll thead tr { display: block; }
	#flip-scroll th { display: block; text-align: left; }
	#flip-scroll tbody tr { display: inline-block; vertical-align: top; }
	#flip-scroll td { display: block; min-height: 1.25em; text-align: left; }


	/* sort out borders */

	#flip-scroll th { border-bottom: 0; border-left: 0;padding:5px; }
	#flip-scroll td { border-left: 0; border-right: 0; border-bottom: 0;padding:5px; }
	#flip-scroll tbody tr { border-left: 1px solid #babcbf; }
	#flip-scroll th:last-child,
	#flip-scroll td:last-child { border-bottom: 1px solid #babcbf; }
}
/*
th,td
		{
		padding:5px!important;
		text-align:left!important;
		}*/

th
{
  background: #aad1d6;
  padding-top: 10px !important;
  padding-bottom: 10px !important;
  padding-left: 3px !important;
}
.infobar .infos p
{
  margin-right: -10px;
}
.pagination
{
	padding-left: 7px;
} 
</style>

 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">

                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10" style="color: #000;background: white;opacity:0.8;border-radius:5px;margin-top: 23px;">

						<!-- <div class="col-md-8" style="background:#CCEDFC;opacity:0.8;padding:10px;"> -->

						<!-- <h5 class="text-center" id="label_list_products" adr_trans="label_list_products" style="color:#000">List of Products</h5> -->
						<hr class="space xs">
						<div id="" style="width:100%;">
					<table align="center" class="table-striped" width="98%" style="margin-left: 15px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th ><span adr_trans="label_product_name">Product name</span></th>
                        <th ><span adr_trans="label_timeline">Timeline</span></th>
                        <th ><span adr_trans="label_earnings">Commissions</span><span>($)</span></th>
                       	<th style="width:450px"><span adr_trans="label_description">Description</span></th>
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

									$res=mysqli_query($con,"SELECT * FROM user_login where id='$loggedin_id'");

									$res1=mysqli_fetch_array($res);
									$pc_admin_id =  $res1['pc_admin_id'];


									$count_query="select count(*) as total, a.product_name,a.description,a.timeline,b.photography_cost from products a join photographer_product_cost b on a.id=b.product_id where b.photographer_id=$loggedin_id";

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



								 $get_product_result=mysqli_query($con,"SELECT a.product_name,a.description,a.timeline,b.photography_cost from products a join photographer_product_cost b on a.id=b.product_id where b.photographer_id=$loggedin_id limit $limit");



                  while($get_product=mysqli_fetch_array($get_product_result))
                  {
	                  $cnt++;
				          ?>
                    <tr class="listPageTR">
                        <td scope="row"><?php echo $cnt;?></td>
                        <td><?php echo $get_product['product_name']; ?></td>
                        <td><?php echo $get_product['timeline']; ?></td>
                        <td><?php echo $get_product['photography_cost']; ?></td>

                   <td><b id="label_description" adr_trans="label_description">Description </b>: <?php echo $get_product['description']; ?></td></tr>
                   <tr><td class="listPageTRGap">&nbsp;</td></tr>

				   <?php } } else { ?>
				   <tr><td colspan="7">No products found.</td></tr>
				   <?php } ?>
                </tbody>
            </table></div>
			<?php
			if($total_no!=0)
			{
			?>
						<div class="col-sm-6">
									<ul class="pagination ">
										<li class="first disabled" aria-disabled="true"><a href="./products.php?page=1" class="button">«</a></li>
										<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./products.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
										<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
										<li class="next disabled" aria-disabled="true"><a href="<?php echo "./products.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
										<li class="last disabled" aria-disabled="true"><a href="<?php echo "./products.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
										<div class="col-sm-6 infoBar"style="margin-top:20px">
										<div class="infos"><p align="right" style="margin-right:-10px;"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
										</div><?php } ?>
							<!-- </div> -->


</div>




            </div>

		</div>
		<?php include "footer.php";  ?>
