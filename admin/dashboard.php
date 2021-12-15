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
 <div class="section-empty bgimage9">
        <div class="container" style="margin-left:0px;height:fit-content">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">

					<div class="row hidden-xs hidden-sm">
<hr class="space s" />
                <div class="col-md-6">

                        <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

                       

                        <h3><i class="fa fa-stack-exchange fa-lg" style="color:#aad1d6;"></i><br /><br /> <span adr_trans="">Orders</span></h3>
					    <hr class="space s">
                        <div class="row">
													<div class="col-md-6">
														<h5>Completed</h5>
															<?php
															$get_order_query=mysqli_query($con,"select count(*) as completed_no from orders where status_id=3");
															if($get_order=mysqli_fetch_assoc($get_order_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_order["completed_no"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;">

			 <?php echo $get_order["completed_no"]; }?>
		 </p>
													</div>
													<div class="col-md-6">
														<h5>Ongoing</h5>
															<?php
															$get_ongoing_query=mysqli_query($con,"select count(*) as ongoing_no from orders where status_id <> 3");
															if($get_ongoing=mysqli_fetch_assoc($get_ongoing_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_ongoing["ongoing_no"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;"> <?php echo $get_ongoing["ongoing_no"]; }?></p>
													</div>
												</div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class=" advs-box boxed-inverse" style="background:#FFF!important;border-radius:10px;color:#000000;text-align:center;">

                        

                        <h3><i class="fa fa-users circle-right fa-lg " style="color:#aad1d6;"></i><br /><br /><span adr_trans="">Users</span></h3>

													<hr class="space s">
												<div class="row">
													<div class="col-md-6">
														<h5>Photo Companies</h5>
		<?php
$get_photographer_query=mysqli_query($con,"select count(*) as photo_companies_no from admin_users where type_of_user='PCAdmin'");
		
			$get_photographer=mysqli_fetch_assoc($get_photographer_query);

             $cnt_get_photographer=$get_photographer['photo_companies_no'];

															  ?>
						<p class="counter" data-speed="1000" data-to="<?php echo $cnt_get_photographer;?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;">

							<?php echo $cnt_get_photographer; ?>
													
													 </p>
													</div>
													<div class="col-md-6">
														<h5>Realtors</h5>
														<?php
														$get_csr_query=mysqli_query($con,"select count(*) as realtor_no from user_login where type_of_user='Realtor'");
														
														$get_csr_query1=mysqli_fetch_assoc($get_csr_query);
														
														$total_realtor_csr = $get_csr_query1["realtor_no"] ?>
														<p class="counter" data-speed="1000" data-to=" <?php echo $total_realtor_csr;?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;"><?php echo $total_realtor_csr; ?></p>
													</div>
												</div>
                    </div>
                </div>
                
            </div>

	<div class="row hidden-md hidden-lg hidden-xl">

                <div class="col-md-4">
                    <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#5CB85C;border-radius:35px 35px 35px 35px;opacity:0.8">
                        <i class="fa fa-database icon circle anima" aid="0.33201800164139406" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                        <h3>Orders</h3>
					    <hr class="space s">
                        <div class="row">
													<div class="col-md-6">
														<h5>Completed</h5>
															<?php
															$get_order_query=mysqli_query($con,"select count(*) as completed_no from orders where status_id=3");
															if($get_order=mysqli_fetch_assoc($get_order_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_order["completed_no"];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;">

			 <?php echo $get_order["completed_no"]; }?>
		 </p>
													</div>
													<div class="col-md-6">
														<h5>Ongoing</h5>
															<?php
															$get_ongoing_query=mysqli_query($con,"select count(*) as ongoing_no from orders where status_id <> 3");
															if($get_ongoing=mysqli_fetch_assoc($get_ongoing_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_ongoing["ongoing_no"];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;"> <?php echo $get_ongoing["ongoing_no"]; }?></p>
													</div>
												</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#337AB7;border-radius:35px 35px 35px 35px;opacity:0.8">
                        <i class="fa fa-users icon circle anima" aid="0.8497340629201113" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                        <h3>Users</h3>
													<hr class="space s">
												<div class="row">
													<div class="col-md-6">
														<h5>Photographers</h5>
															<?php
															$get_photographer_query=mysqli_query($con,"select count(*) as photographer_no from user_login where type_of_user='Photographer'");
															if($get_photographer=mysqli_fetch_assoc($get_photographer_query))
															{  ?>
														<p class="counter" data-speed="1000" data-to="<?php echo $get_photographer["photographer_no"];?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;">

													<?php  }?>
													 </p>
													</div>
													<div class="col-md-6">
														<h5>CSR & Realtor</h5>
														<?php
														$get_csr_query=mysqli_query($con,"select count(*) as csr_no from user_login where type_of_user in ('Realtor')");
														$get_csr_query1=mysqli_query($con,"select count(*) as csr_no1 from admin_users where type_of_user in ('SuperCSR','SubCSR','StandaloneCSR')");

														if($get_csr=mysqli_fetch_assoc($get_csr_query) and $get_csr1=mysqli_fetch_assoc($get_csr_query1))
														{
														$total_realtor_csr = $get_csr["csr_no"] + $get_csr1["csr_no1"]  ?>
														<p class="counter" data-speed="1000" data-to="<?php echo $total_realtor_csr;?>" style="color:white;font-size:25px;font-weight:600;padding-top:5px;"><?php echo $total_realtor_csr; }?></p>
													</div>
												</div>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class=" advs-box advs-box-top-icon boxed-inverse" data-anima="rotate-20" data-trigger="hover" style="background:#F0AD4E;border-radius:35px 35px 35px 35px;opacity:0.8">
                        <i class="fa fa-usd icon circle anima" aid="0.7325797694245981" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;"></i>
                        <h3>Revenue</h3>
                          	<hr class="space s">
												<div class="row">
													<div class="col-md-6">
														<h5>Order Cost</h5>

															<?php
													$total=0;
													$get_invoiced_name_query=mysqli_query($con,"SELECT id,product_id FROM orders where status_id =3");
													while($get_name=mysqli_fetch_assoc($get_invoiced_name_query))
													{
														$product_id=$get_name['product_id'];
														$get_product_query=mysqli_query($con,"SELECT sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value FROM `products` where id IN ($product_id) group by `photographer_id`");
														$get_product=mysqli_fetch_assoc($get_product_query);

														$total +=$get_product['total_value'];

                          }
												?>
											   <p style="color:white;font-size:25px;font-weight:600"> $<label class="counter" data-speed="1000" data-to="<?php echo $total;?>" style="color:white;font-size:25px;font-weight:600"><?php echo $total; ?></label></p>
													</div>
													<div class="col-md-6">
														<h5>Pending</h5>
															<?php
													$total1=0;
													$get_invoiced_name_query1=mysqli_query($con,"SELECT id,product_id FROM orders where status_id <> 3");
													while($get_name1=mysqli_fetch_assoc($get_invoiced_name_query1))
													{
														$product_id1=$get_name1['product_id'];
														$get_product_query1=mysqli_query($con,"SELECT sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value1 FROM `products` where id IN ($product_id1) group by `photographer_id`");
														$get_product1=mysqli_fetch_assoc($get_product_query1);

														$total1 +=$get_product1['total_value1'];

													}
												?>
													   <p style="color:white;font-size:25px;font-weight:600"> $<label class="counter" data-speed="1000" data-to="<?php echo $total1; ?>" style="color:white;font-size:25px;font-weight:600"><?php echo $total1; ?></label></p>
													</div>
												</div>

                    </div>
                </div>
            </div>












            </div>
        </div>
</div>


		<?php include "footer.php";  ?>
