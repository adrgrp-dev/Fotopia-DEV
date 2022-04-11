<?php
ob_start();

include "connection1.php";


//Login Check
if(isset($_REQUEST['loginbtn']))
{
	header("location:index.php?failed=1");
}
?><style>
   .infos{
		margin-left: 269px;
		margin-top: 20px;
	 }
@media only screen and (max-width: 600px) {
.infos
{
    margin-left: 0px !important;
    margin-top: -20px !important;
    margin-right: -35px !important;
}
}
th
{
    background: #aad1d6;
    padding-top: 10px !important;
    padding-bottom: 10px;
    padding-left: 3px !important;
}
.infos p
{
  margin-right: -40px;
 }
	</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage1">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">

<?php if(isset($_REQUEST['c'])) { ?>

					<p align="center" class="text-success"> Admin created Successfully!.</p>
					<?php } ?>


 <h5><span style="color:#000;margin-left: 3px;">List of Fotopia Admins</span></h5>
 	<a href="create_admin.php" class="circle-button btn adr-save" style="float:right;font-size: 12px;height: 30px;margin-top:-36px;"><i class="fa fa-plus fa-xs" style=""></i>Create</a>      
<div style="background: white;padding: 10px;border-radius: 5px!important;">
<div style="width:100%;">
		
					<table class="table-stripped" style="color:#000;opacity:0.8;width:100%;">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><span class="text">

                                S.No

                        </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text">

                                Name

                        </span>

						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                City

                        </span>

						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                State

                        </span>

						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                Picture

                        </span>
						<span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text">

                                Contact

                        </span>



						<span class="icon fa "></span></th><th data-column-id="link-icon" class="text-left" style=""><span class="text">

                                Details

                        </span><span class="icon fa "></span></th></tr>
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
									$q1="select count(*) as total from admin_users where type_of_user='FotopiaAdmin' ";
									$result=mysqli_query($con,$q1);
									$data=mysqli_fetch_assoc($result);
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
									$q = "SELECT *FROM admin_users WHERE type_of_user='FotopiaAdmin' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									while($res1=mysqli_fetch_array($res))
									{
				$cnt++;
				//-----------------------------------pagination end---------------------------------------------
				?>
				<tr data-row-id="0" class="listPageTR">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style=""><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>
				<td class="text-left" style=""><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><a target="" href="adminDetails.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-chevron-circle-right fa-lg"></i></a></td>
				</tr>
				<tr><td class="listPageTRGap">&nbsp;</td></tr>
				<?php } ?>
            </table></div>

<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./admin_users.php?page=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./admin_users.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./admin_users.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./admin_users.php?page=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to&nbsp</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
								</div>
                </div>
            </div>
        </div>
        </div>
			</div>
		</div>
	</div>


		<?php include "footer.php";  ?>
