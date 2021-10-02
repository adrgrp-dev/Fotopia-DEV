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
	</style>
<?php include "header.php";  ?>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">
                    <h5 class="text-center">List of users</h5>



		<div class="col-md-12">
		<form name="search_filter" method="post" action="">
		<select name="user_type" id="user_type" onchange="this.form.submit()">
				<option value="">Select a user type</option>
			    <option value="Photographer">Photographer</option>
			    <option value="Realtor">Realtor</option>
			    <option value="CSR">CSR</option>
  		</select>
		</form>
		<input type="text" class="search-field" placeholder="Search"  style="float:right">
</div>


<hr class="space s">
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

                                Type

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
                   //	---------------------------------  pagination starts ---------------------------------------
				if(empty($_GET["page"]))
				{
					$_SESSION["page"]=1;
				}
				else {
					$_SESSION["page"]=$_GET["page"];
				}
				if($_SESSION["page"] < 0)
				{
					$_SESSION["page"]=1;
				}
				if(isset($_REQUEST['user_type']))
	      {
	     $_SESSION['usertype']=$_REQUEST['user_type'];
	     $q1 = "select count(*) as total from user_login WHERE type_of_user='".$_SESSION['usertype']."'" ;
	      }
	   elseif(!empty($_SESSION['usertype']))
	     {
	     $q1 = "select count(*) as total from user_login WHERE type_of_user='".$_SESSION['usertype']."'";
	      }
				elseif(empty($_SESSION['usertype']))
				 {
				  $q1 = "select count(*) as total from user_login ";
				}


				//$q1="select count(*) as total from user_login WHERE type_of_user=''";
				$result=mysqli_query($con,$q1);
				$data=mysqli_fetch_assoc($result);
				$number_of_pages=5;

				// total number of user shown in database
				$total_no=$data['total'];

				$Page_check=intval($total_no/$number_of_pages);
				$page_check1=$total_no%$number_of_pages;
				if($page_check1 == 0)
				;
				else{
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
if(isset($_REQUEST['user_type']))
{
$user_type=$_REQUEST['user_type'];

$q = "SELECT *FROM user_login WHERE type_of_user='".$_SESSION['usertype']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
elseif(!empty($_SESSION['usertype']))
{
	$q = "SELECT *FROM user_login WHERE type_of_user='".$_SESSION['usertype']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
elseif(empty($_SESSION['usertype']))
 {
	$q = "SELECT *FROM user_login LIMIT " . $start_no_users . ',' . $number_of_pages;
}

				$res=mysqli_query($con,$q);
				while($res1=mysqli_fetch_array($res))
				{
				$cnt++;
				   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php echo $cnt; ?></td>
				<td class="text-left" style=""><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style=""><?php echo $res1['organization']; ?></td>
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved=$res1['email_verified']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Block</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php } ?>
            </table>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./Users.php?page=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./Users.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./Users.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./Users.php?page=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos">Showing <?php echo $start_no_users+1; ?> to <?php echo $cnt; ?> of <?php echo $total_no; ?> entries</div></div>
									</div>
								</div>



                </div>


            </div>
        </div>


		<?php include "footer.php";  ?>
