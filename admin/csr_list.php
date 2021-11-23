<?php
ob_start();

include "connection1.php";



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
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>

                <div class="col-md-10">
                	<div class="tab-box" data-tab-anima="show-scale">
                    <h5 class="text-center">List of users</h5>
					<?php if(isset($_REQUEST['c'])) { ?>

					<p align="center" class="text-success">CSR created Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['cu'])) { ?>

					<p align="center" class="text-success">CSR details updated Successfully!.</p>
					<?php } ?>
                    <ul class="nav nav-tabs">
<li class="active"><a href="#">Super CSRs & Standalone CSRs</a></li>
<li><a href="#">Sub CSRs</a></li>
<li><a href="#">Photographers</a></li>
</ul>

<div class="panel active" id="tab1">
<!-- Panel 1 starts -->
<form name="user_search" method="post" action="">
<select name="user_type1" class="form-control" id="user_type1" onchange="this.form.submit()" style="position: absolute;width:200px;left: 15px;">
				<option value="All">All</option>
			    <option value="SuperCSR" <?php if(@$_REQUEST['user_type1']=="SuperCSR") { echo "selected"; } ?>>SuperCSR</option>
			    <option value="StandaloneCSR" <?php if(@$_REQUEST['user_type1']=="StandaloneCSR") { echo "selected"; } ?>>StandaloneCSR</option>

  		</select>
		</form>
<p align="right"><a href="create_users.php" class="btn btn-primary">+ Create Super CSR</a></p>
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


									// $q1="select count(*) as total from admin_users where type_of_user in ('SuperCSR','StandaloneCSR')";

									if(isset($_REQUEST['user_type1']))
	     						 {

	     $_SESSION['usertype1']=$_REQUEST['user_type1'];
	     if( $_SESSION['usertype1'] == "All")
	     {
$q1="select count(*) as total from admin_users where type_of_user in ('SuperCSR','StandaloneCSR')";
	     }
	     else{
	     $q1 = "select count(*) as total from admin_users where type_of_user='".$_SESSION['usertype1']."'" ;
								 }
								}

								 elseif(empty($_SESSION['usertype1']))
				 {
				  $q1="select count(*) as total from admin_users where type_of_user in ('SuperCSR','StandaloneCSR')";
				}

				elseif(!empty($_SESSION['usertype1']))
	     {

if( $_SESSION['usertype1'] == "All")
	     {
$q1="select count(*) as total from admin_users where type_of_user in ('SuperCSR','StandaloneCSR')";
	     }
	     else{
	     	$q1 = "select count(*) as total from admin_users where type_of_user='".$_SESSION['usertype1']."'" ;
		 }
		}

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


									// $q = "SELECT *FROM admin_users where type_of_user in ('SuperCSR','StandaloneCSR') LIMIT " . $start_no_users . ',' . $number_of_pages;


									if(isset($_REQUEST['user_type1']))
	     						 {

	     $_SESSION['usertype1']=$_REQUEST['user_type1'];
if( $_SESSION['usertype1'] == "All")
	     {
$q = "SELECT *FROM admin_users where type_of_user in ('SuperCSR','StandaloneCSR') LIMIT " . $start_no_users . ',' . $number_of_pages;
	     }
	     else{
	     $q = "SELECT *FROM admin_users where type_of_user='".$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . $number_of_pages;

								 }
								}

								 elseif(empty($_SESSION['usertype1']))
				 {

				  $q = "SELECT *FROM admin_users where type_of_user in ('SuperCSR','StandaloneCSR') LIMIT " . $start_no_users . ',' . $number_of_pages;
				}

				elseif(!empty($_SESSION['usertype1']))
	     {
	     	if( $_SESSION['usertype1'] == "All")
	     {
$q = "SELECT *FROM admin_users where type_of_user in ('SuperCSR','StandaloneCSR') LIMIT " . $start_no_users . ',' . $number_of_pages;
	     }
	     else{
	     	$q = "SELECT *FROM admin_users where type_of_user='".$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . $number_of_pages;

		 }
		}


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
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved=$res1['is_approved']; if($approved==0) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Blocked</span>"; } else { echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="csr_details.php?val=1&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a>&nbsp;&nbsp;<a target="" href="edit_users.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit CSR details"></i></a></td>
				</tr>
				<?php } ?></tbody>
            </table>

<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list.php?page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list.php?page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>


<!--Panel 1 ends-->
</div>






<div class="panel" id="tab2">
<!--Panel 2 starts-->

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
				if(empty($_GET["page1"]))
									{
										$_SESSION["page1"]=1;
									}
									else {
										$_SESSION["page1"]=$_GET["page1"];
									}
									if($_SESSION["page1"] == 0)
									{
										$_SESSION["page1"]=1;
									}
									$q1="select count(*) as total from admin_users where type_of_user='SubCSR'";
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
									if($Page_check<=$_SESSION["page1"])
									{
										$_SESSION["page1"]=$Page_check;
									}
										// how many entries shown in page

										//starting number to print the users shown in page
									$start_no_users = ($_SESSION["page1"]-1) * $number_of_pages;

					         $cnt=$start_no_users;
									$q = "SELECT *FROM admin_users where type_of_user='SubCSR' LIMIT " . $start_no_users . ',' . $number_of_pages;
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
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res12["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved2=$res1['is_approved']; if($approved2==0) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Pending</span>"; } elseif($approved2==2) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Blocked</span>"; } else { echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="csr_details.php?val=1&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php } ?></tbody>
            </table>


<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list.php?page1=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list.php?page1=".($_SESSION["page1"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page1"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list.php?page1=".($_SESSION["page1"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list.php?page1=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>

<!--Panel 2 starts-->
</div>


<div class="panel" id="tab3">
<!--Panel 3 starts-->

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

				if(empty($_GET["page2"]))
									{
										$_SESSION["page2"]=1;
									}
									else {
										$_SESSION["page2"]=$_GET["page2"];
									}
									if($_SESSION["page2"] == 0)
									{
										$_SESSION["page2"]=1;
									}
									$q1="select count(*) as total from user_login where type_of_user='Photographer'";
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
									if($Page_check<=$_SESSION["page2"])
									{
										$_SESSION["page2"]=$Page_check;
									}
										// how many entries shown in page

										//starting number to print the users shown in page
									$start_no_users = ($_SESSION["page2"]-1) * $number_of_pages;

					         $cnt=$start_no_users;
									$q = "SELECT *FROM user_login where type_of_user='Photographer' LIMIT " . $start_no_users . ',' . $number_of_pages;
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
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res13["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved=$res1['email_verified']; if($approved==0) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Blocked</span>"; } else { echo "<span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=1&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php } ?></tbody>
            </table>



<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list.php?page2=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list.php?page2=".($_SESSION["page2"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page2"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list.php?page2=".($_SESSION["page2"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list.php?page2=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>
</div>




                </div>


            </div>
        </div>

</div>


<!-- <?php if(isset($_GET["page"]) )
{ ?>
<script>
$("#tab1").addClass("active");
$("#tab2").removeClass("active");
$("#tab3").removeClass("active");
</script>
<?php } ?>


<?php if(isset($_GET["page1"]) )
{ ?>
<script>
$("#tab2").addClass("active");
$("#tab1").removeClass("active");
$("#tab3").removeClass("active");
</script>
<?php } ?>


<?php if(isset($_GET["page2"]) )
{ ?>
<script>
$("#tab3").addClass("active");
$("#tab2").removeClass("active");
$("#tab1").removeClass("active");
</script>
<?php } ?>
 -->

		<?php include "footer.php";  ?>
