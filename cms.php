<?php
ob_start();

include "connection1.php";

$id=@$_REQUEST['id'];
						$cmsPage=mysqli_query($con,"select * from cms_pages where id='$id'");
						$cmsPage1=mysqli_fetch_array($cmsPage);
						

?>


<?php include "header.php";  ?>
 <div class="section-empty bgimage9">
        <div class="container" style="margin-left:0px;height:inherit;width:100%;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                 <div class="col-md-10" style="padiding-left:20px;">
              	<h5 class="text-center" id="label_photographer_dashboard"><?php echo $cmsPage1['page_title']; ?></h5>
				<div style="font-weight:500;font-family:Geneva, Arial, Helvetica, sans-serif; width:100%; background:#E8F0FE!important;padding:3%;border-radius:25px;box-shadow:10px 10px 10px #DDD">
				<?php
				
						echo $cmsPage1['page_content'];
				
				?>
</div>
</div>


    </div>
        </div>


		<?php include "footer.php";  ?>
