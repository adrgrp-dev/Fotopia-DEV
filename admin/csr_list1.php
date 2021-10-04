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
	 .nav-tabs > li.active > a, .current-active {
    background:#000!important;color:#FFF!important;
    border-radius: 20px 20px 0px 0px;
    opacity: 0.8;


}
.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}
 table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {

  text-align: center;
  padding: 8px;
  color: black;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
	</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
<style>
	.nav-tabs > li.active > a, .current-active {
    background:#000!important;color:#FFF!important;
    border-radius: 20px 20px 0px 0px;
    opacity: 0.8;


}
.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}
	 </style>
                <div class="col-md-10" style="padding-left:30px;">
                	<div class="tab-box" data-tab-anima="show-scale">
                    <h5 class="text-center" adr_trans="label_users_list">List of Users</h5>
					<?php if(isset($_REQUEST['c'])) { ?>

					<p align="center" class="text-success" id="label_csr_created" adr_trans="label_csr_created">CSR created Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['p'])) { ?>

					<p align="center" id="label_photographer_created" adr_trans="label_photographer_created" class="text-success">Photographer created Successfully!.</p>
					<?php } ?>
					<?php if(isset($_REQUEST['pu'])) { ?>

					<p align="center" id="label_photographer_updated" adr_trans="label_photographer_updated" class="text-success">Photographer updated Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['e'])) { ?>

					<p align="center" id="label_editor_created" adr_trans="label_editor_created" class="text-success">Editor created Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['eu'])) { ?>

					<p align="center" id="label_editor_update" adr_trans="label_editor_update" class="text-success">Editor updated Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['ed'])) { ?>

					<p align="center" id="label_editor_deleted" adr_trans="label_editor_deleted" class="text-success">Editor deleted Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['a'])) { ?>

					<p align="center" id="label_admin_created" adr_trans="label_admin_created" class="text-success">Admin created Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['au'])) { ?>

					<p align="center" id="label_admin_updated" adr_trans="label_admin_updated" class="text-success">Admin updated Successfully!.</p>
					<?php } ?>


					<?php if(isset($_REQUEST['cu'])) { ?>

					<p align="center" id="label_csr_updated" adr_trans="label_csr_updated" class="text-success">CSR details updated Successfully!.</p>
					<?php } ?>
                    <ul class="nav nav-tabs">
<li id="click1" class="active"><a href="#" id="label_admin" adr_trans="label_admin">Admin</a></li>
<li id="click2"><a href="#" id="label_csr" adr_trans="label_csr">CSR</a></li>
<li id="click3"><a href="#" id="label_photographers" adr_trans="label_photographers">Photographers</a></li>
<li id="click4"><a href="#" id="label_editor" adr_trans="label_editor">Editor</a></li>
</ul>

<div class="panel active " id="tab1" style="width:100%;overflow:scroll;">

<p align="right"><a href="create_pc_admin_user.php" id="label_create_admin" adr_trans="label_create_admin" class="btn btn-default" >Create Admin</a></p>

<table class="table-striped" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_name" adr_trans="label_name">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_organization" adr_trans="label_organization">

                                Organization

                        </span>


						<!-- <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Type

                        </span> -->

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_city" adr_trans="label_city">

                                City

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_state" adr_trans="label_state">

                                State

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_profile_picture" adr_trans="label_profile_picture">

                                Profile picture

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_contact" adr_trans="label_contact">

                                Contact

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

                                Status

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text"  id="label_details" adr_trans="label_details">

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
									$created_by_id=$_SESSION['admin_loggedin_id'];
									$q1="select count(*) as total from photo_company_admin where pc_admin_id='$created_by_id'";
									$result=mysqli_query($con,$q1);
									$data=mysqli_fetch_assoc($result);
									$total_no=$data['total'];
									$number_of_pages=5;
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
									$q = "SELECT * FROM photo_company_admin where pc_admin_id='$created_by_id' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									if($res == "0"){
					?><h5 align="center" id="label_no_admin" adr_trans="label_no_admin"> <?php echo "No Admin are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
									while($res1=mysqli_fetch_array($res))
									{
				$cnt++;   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization_name']; ?></td>
				<!-- <td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td> -->
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-center" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved2=$res1['is_approved']; if($approved2==0) { echo "<span style='color:red;font-weight:bold;' id='label_pending' adr_trans='label_pending'>Pending</span>"; } elseif($approved2==2) { echo "<span style='color:red;font-weight:bold;' id='label_blocked' adr_trans='label_blocked'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;' id='label_approved' adr_trans='label_approved'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="pc_admin_details.php?val=0&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a>&nbsp;&nbsp;<a target="" href="edit_pc_admin_user.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit Admin details"></i></a></td>
				</tr>
				<?php }} ?></tbody>
            </table>

			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list1.php?a=1&page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list1.php?a=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list1.php?a=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list1.php?a=1&page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div style="float:right;" class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>

</div>
<div class="panel" id="tab2" style="width:100%;overflow:scroll;">
<!--Panel 2 starts-->
<p align="right"><a href="create_csr.php" class="btn btn-default"><span adr_trans="label_create_csr">Create CSR</span></a></p>

<table class="table-striped" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_name" adr_trans="label_name">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_organization" adr_trans="label_organization">

                                Organization

                        </span>

                        <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_admin" adr_trans="label_admin">

                                Admin

                        </span>


						<span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_type" adr_trans="label_type">

                                Type

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_city" adr_trans="label_city">

                                City

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_state" adr_trans="label_state">

                                State

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_profile_picture" adr_trans="label_profile_picture">

                                Profile picture

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_contact" adr_trans="label_contact">

                                Contact

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

                                Status

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_details" adr_trans="label_details">

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
									$created_by_id=$_SESSION['admin_loggedin_id'];
									$q1="select count(*) as total from admin_users where pc_admin_id='$created_by_id' and type_of_user='CSR'";
									$result=mysqli_query($con,$q1);
									$data=mysqli_fetch_assoc($result);
									$total_no=$data['total'];
									$number_of_pages=5;
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
									$q = "SELECT *FROM admin_users where pc_admin_id='$created_by_id' and type_of_user='CSR' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									if($res == "0"){
					?><h5 align="center" id='label_no_csr' adr_trans='label_no_csr'> <?php echo "No CSRs are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
									while($res1=mysqli_fetch_array($res))
									{

				$cnt++;   //	---------------------------------  pagination starts ---------------------------------------
				$assigned_admin_id = $res1['assigned_admin_id'];

				$admin = mysqli_query($con,"select first_name from photo_company_admin where id='$assigned_admin_id' ");

				$admin1 = mysqli_fetch_array($admin);

				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo @$admin1['first_name']; ?></td>
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-center" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved2=$res1['is_approved']; if($approved2==0) { echo "<span id='label_pending' adr_trans='label_pending' style='color:red;font-weight:bold;' >Pending</span>"; } elseif($approved2==2) { echo "<span id='label_blocked' adr_trans='label_blocked' style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span id='label_approved' adr_trans='label_approved' style='color:green;font-weight:bold;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="csr_details.php?val=0&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a>&nbsp;&nbsp;<a target="" href="edit_csr.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit CSR details"></i></a></td>
				</tr>
				<?php }} ?></tbody>
            </table>

			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list1.php?c=1&page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list1.php?c=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list1.php?c=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list1.php?c=1&page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div style="float:right;" class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>

</div>


<div class="panel" id="tab3" style="width:100%;overflow:scroll;">
<!--Panel 3 starts-->
<p align="right"><a href="create_photographer.php" class="btn btn-default"><span adr_trans="label_create_photographer">Create Photographer</span></a></p>

<table class="table-striped" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_name" adr_trans="label_name">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_organization" adr_trans="label_organization">

                                Organization

                        </span>


						<span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_admin_csr" adr_trans="label_admin_csr">

                                 Admin / CSR

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_city" adr_trans="label_city">

                                City

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_state" adr_trans="label_state">

                                State

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_profile_picture" adr_trans="label_profile_picture">

                                Profile picture

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_contact" adr_trans="label_contact">

                                Contact

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

                                Status

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_details" adr_trans="label_details">

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
									$created_by_id=$_SESSION['admin_loggedin_id'];
									$q1="select count(*) as total from user_login where type_of_user='Photographer' and pc_admin_id='$created_by_id'";
									$result=mysqli_query($con,$q1);
									$data=mysqli_fetch_assoc($result);
									$total_no=$data['total'];
									$number_of_pages=5;
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
									$q = "SELECT *FROM user_login where type_of_user='Photographer' and pc_admin_id='$created_by_id' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									if($res == "0"){
					?><h5 align="center" id="label_no_photographer" adr_trans="label_no_photographer"> <?php echo "No Photographers are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
									while($res1=mysqli_fetch_array($res))
									{
				$cnt++;
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php
				$idIS=$res1['csr_id'];
				$idIS1=$res1['pc_admin_user_id'];

				if ($idIS !=0 && $idIS1 == 0 ) {

				$csr1=mysqli_query($con,"select first_name,last_name from admin_users where id='$idIS'");

				}
				else{

			$csr1=mysqli_query($con,"select first_name,last_name from photo_company_admin where id='$idIS1'");

				}

				$csr=mysqli_fetch_array($csr1);
				 echo $csr['first_name']." ".$csr['last_name'];


				  ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-center" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res13["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php $approved=$res1['email_verified']; if($approved==0) { echo "<span id='label_pending' adr_trans='label_pending' style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span id='label_blocked' adr_trans='label_blocked' style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span id='label_approved' adr_trans='label_approved' style='color:green;font-weight:bold;'>Approved</span>"; } ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=2&id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-external-link"></i></a>&nbsp;&nbsp;<a target="" href="edit_photographer.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit photographer details"></i></td>
				</tr>
				<?php }} ?></tbody>
            </table>
<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list1.php?p=1&page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list1.php?p=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list1.php?p=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list1.php?p=1&page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div style="float:right;" class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div><!--Panel 3 ends-->

</div>

<div class="panel" id="tab4" >

<script>

 function confirmDelete() {
            var doc;
 var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker p� at vil slette redigeringsbyr�et";
		}
		else
		{
		alertmsg="Are you sure want to delete the editor";
		}
alert(alertmsg);


            var result = confirm(alertmsg+"?");
			            if (result == true) {
               return true;
            } else {
              return false;
            }

        }


</script>

<?php

if(isset($_REQUEST['del']))
{
$editor_id=$_REQUEST['editor_id'];
mysqli_query($con,"delete from editor where id='$editor_id'");
//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `Realtor_id`,`action_date`) VALUES ('Product','Deleted','$loggedin_name',$loggedin_id,$loggedin_id,now())");
header("location:csr_list1.php?ed=1");
}


?>

<p align="right"><a href="create_editor.php" class="btn btn-default"><span adr_trans="label_create_editor">Create Editor</span></a></p>

<table class="table-striped" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_name" adr_trans="label_name">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_organization" adr_trans="label_organization">

                                Organization

                        </span>


						 <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_email_address" adr_trans="label_email_address">

                                Email address

                        </span>


						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_contact" adr_trans="label_contact">

                                Contact

                        </span>

                        <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="label_photographer">

                                Photographer

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_details" adr_trans="label_details">

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
									if($_SESSION["page"] == 0)
									{
										$_SESSION["page"]=1;
									}
									$created_by_id=$_SESSION['admin_loggedin_id'];
									$q1="select count(*) as total from editor where pc_admin_id='$created_by_id'";
									$result=mysqli_query($con,$q1);
									$data=mysqli_fetch_assoc($result);
									$total_no=$data['total'];
									$number_of_pages=5;
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
									$q = "SELECT *FROM editor where pc_admin_id='$created_by_id' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									if($res == "0"){
					?><h5 align="center" id='label_no_editor' adr_trans='label_no_editor'> <?php echo "No Editors are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
									while($res1=mysqli_fetch_array($res))
									{
				$photographer_id =  $res1['photographer_id'];

				$res2=mysqli_query($con,"SELECT first_name FROM user_login where id='$photographer_id'");
				$res3=mysqli_fetch_array($res2);


				$cnt++;   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['email']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res3['first_name']; ?></td>

				<td class="text-left" style=""><a target="" href="edit_editor.php?id=<?php echo $res1['id']; ?>" class="link">
				<i class="fa fa-pencil" title="Edit Editor details"></i></a>&nbsp;
				                 <a href="csr_list1.php?editor_id=<?php echo $res1['id']; ?>&del=1" onclick="return confirmDelete();"><i class="fa fa-trash" title="Delete"></i></a></td>
				</tr>
				<?php }} ?></tbody>
            </table>

			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./csr_list1.php?e=1&page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./csr_list1.php?e=1&page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./csr_list1.php?e=1&page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./csr_list1.php?e=1&page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div style="float:right;" class="infos"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></div></div>
									</div>
								</div>



</div>




                </div>


            </div>
        </div>
				<?php if(@$_REQUEST['c'])
				{
					?>
					<script>

										$("#click1").removeClass('active');
										$("#click2").addClass('active');
										$("#tab2").addClass("active");
										$("#tab4").removeClass("active");
										$("#tab3").removeClass("active");
										$("#tab1").removeClass("active");

					</script>
					<?php
				}?>

				<?php if(@$_REQUEST['p'])
				{
					?>
					<script>


					$("#click1").removeClass('active');
					$("#click3").addClass('active');
					$("#tab3").addClass("active");
					$("#tab2").removeClass("active");
					$("#tab4").removeClass("active");
					$("#tab1").removeClass("active");
					</script>
					<?php
				}?>
				<?php if(@$_REQUEST['a'])
				{
					?>
					<script>



					$("#click1").addClass('active');
					$("#tab1").addClass("active");
					$("#tab2").removeClass("active");
					$("#tab4").removeClass("active");
					$("#tab3").removeClass("active");
					</script>
					<?php
				}?>

				<?php if(@$_REQUEST['e'])
				{
					?>
					<script>

					$("#click1").removeClass('active');
					$("#click4").addClass('active');
					$("#tab4").addClass("active");
					$("#tab2").removeClass("active");
					$("#tab3").removeClass("active");
					$("#tab1").removeClass("active");


					</script>
					<?php
				}?>

</div>
		<?php include "footer.php";  ?>
