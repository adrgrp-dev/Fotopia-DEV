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
                <div class="col-md-2" style="padding-left:15px;">
	<?php include "sidebar.php"; ?>
 
 
			</div>
                <div class="col-md-10" style="padding-left: 15px;margin-top: 3px; text-align:center">

					<div class="row hidden-xs hidden-sm">
<hr class="space s" />
<div class="col-md-2">&nbsp;</div>
                <div class="col-md-5">

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
													<div class="col-md-6" style="padding-left:40px;">
														<h5>Ongoing</h5>
															<?php
															$get_ongoing_query=mysqli_query($con,"select count(*) as ongoing_no from orders where status_id in(2,4,8)");
															if($get_ongoing=mysqli_fetch_assoc($get_ongoing_query))
															{
															?>
                            <p class="counter" data-speed="1000" data-to="<?php echo $get_ongoing["ongoing_no"];?>" style="color:#000;font-size:25px;font-weight:600;padding-top:5px;"> <?php echo $get_ongoing["ongoing_no"]; }?></p>
													</div>
												</div>
                    </div>
                </div>
                <div class="col-md-5">

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
													<div class="col-md-6" style="padding-left:50px;">
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
															$get_ongoing_query=mysqli_query($con,"select count(*) as ongoing_no from orders where status_id in(2,4,8)");
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












            </div>
        </div>
</div>


		<?php include "footer.php";  ?>
