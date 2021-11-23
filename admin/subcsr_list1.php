<?php
ob_start();

include "connection1.php";

$loggedin_id=$_SESSION['admin_loggedin_id'];

//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
?>

<style>
   .infos{
		margin-left: 269px;
		margin-top: 20px;
	 }
	</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>

                <div class="col-md-10">
                	<div class="tab-box" data-tab-anima="show-scale">
                    <h5 class="text-center">List of Photographers</h5>
					<?php if(isset($_REQUEST['c'])) { ?>

					<p align="center" class="text-success">CSR created Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['p'])) { ?>

					<p align="center" class="text-success">Photographer created Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['pu'])) { ?>

					<p align="center" class="text-success">Photographer updated Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['cu'])) { ?>

					<p align="center" class="text-success">CSR updated Successfully!.</p>
					<?php } ?>
                    <ul class="nav nav-tabs">

<li class="active"><a href="#">Photographers</a></li>
</ul>



<div class="panel active" id="tab2">
<!--Panel 3 starts-->
<p align="right"><a href="create_photographer.php" class="btn btn-primary">+ Create Photographer</a></p>

<table class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Organization

                        </span>


						<span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                 CSR

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                City

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                State

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Picture

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Contact

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Status

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Details

                        </span><span class="icon fa "></span></a></th></tr>
                </thead>
                <tbody>
				<?php
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
									$q1="select count(*) as total from user_login where type_of_user='Photographer' and csr_id='$loggedin_id'";
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
									$q = "SELECT *FROM user_login where type_of_user='Photographer' AND  csr_id='$loggedin_id' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									while($res1=mysqli_fetch_array($res))
									{
				$cnt++;
				   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php
				$idIS=$res1['id'];
				$csr1=mysqli_query($con,"select first_name,last_name from admin_users where id=(select csr_id from user_login where id='$idIS')");
				$csr=mysqli_fetch_array($csr1);
				 echo $csr['first_name']." ".$csr['last_name'];


				  ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved=$res1['email_verified']; if($approved==0) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Blocked</span>"; } else { echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=3&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a>&nbsp;&nbsp;<a target="" href="edit_photographer.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit photographer details"></i></td>
				</tr>
				<?php } ?></tbody>
            </table>


<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./subcsr_list1.php?page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./subcsr_list1.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./subcsr_list1.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./subcsr_list1.php?page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div>
								</div>
</div>




                </div>


            </div>
        </div>

</div>
		<?php include "footer.php";  ?>
