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

.active
{
background:none!important;
}

	</style>

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


if(@$_REQUEST['edit'])
{
$editor_id=$_REQUEST['editor_id'];
$res1=mysqli_query($con,"select * from editor where id='$editor_id'");
$res11=mysqli_fetch_array($res1);
}

if(isset($_REQUEST['del']))
{
$editor_id=$_REQUEST['editor_id'];
mysqli_query($con,"delete from editor where id='$editor_id'");
//$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`, `Realtor_id`,`action_date`) VALUES ('Product','Deleted','$loggedin_name',$loggedin_id,$loggedin_id,now())");
header("location:editor_list.php?ed=1");
}


if(isset($_REQUEST['signupbtn']))
{
	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$email=$_REQUEST['email'];
	$org=$_REQUEST['org'];
	$contactno=$_REQUEST['contactno'];
$photographer_id=$_SESSION['loggedin_id'];
	// $email_verification_code=getName(10);


if($editor_id=="")
{

		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"insert into editor (first_name,last_name,email,organization_name,contact_number,registered_on,pc_admin_id,photographer_id)values('$fname','$lname','$email','$org','$contactno',now(),0,'$photographer_id')");

	//echo "select * from user_login where email='$email' and password='$pass'";
   // email($fname,$email,$email_verification_code);


	header("location:editor_list.php?e=1");

}

else {


$res=mysqli_query($con,"update editor set first_name='$fname',last_name='$lname',email='$email',contact_number='$contactno',organization_name='$org',photographer_id='$photographer_id' where id='$editor_id'");

	header("location:editor_list.php?eu=1");

}

}



?>
<style>
th,td
{
padding:5px!important;
}

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

</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit">

<div class="container">



					<div id="lb2" class="box-lightbox col-md-4" style="padding:0px;background:#000;color:#FFF!important;border-radius:25px;">

					<table class="" width="100%"><tr><td>
					<h5 class="text-center" style="color:#FFF!important;">Create editor</h5>

						<form name="profile" method="post" action="">
						<div class="col-md-6">

                                <p adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" minlength="1" maxlength="20" value="<?php echo @$res11['first_name']; ?>" class="form-control form-value" required="">
                              </div>

						<div class="col-md-6">
							<p adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" minlength="1" maxlength="20" value="<?php echo @$res11['last_name']; ?>" class="form-control form-value" required="">
                            </div>

								<div class="col-md-6">
                               <p adr_trans="label_email">Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center"  class="alert-warning"></span>
						</p>
	<input id="email" name="email" onblur="this.value=this.value.trim()" placeholder="Email" value="<?php echo @$res11['email']; ?>" type="email" autocomplete="off" class="form-control form-value" required="">
                            </div>

							<div class="col-md-6">
                                <p adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="tel" pattern="[0-9+.\(\)\-\s+]*" autocomplete="off" value="<?php echo @$res11['contact_number']; ?>" class="form-control form-value" required="">
                            </div>


							<div class="col-md-6">
                                 <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" minlength="5" maxlength="20" placeholder="Organization"
                                value="<?php echo @$res11['organization_name']; ?>" type="text" autocomplete="off" class="form-control form-value" required="" >
                            </div>


						<div class="col-md-6">

                                <p adr_trans="label_photographer">Photogapher</p>
                                <input id="photogapher" name="photogapher" placeholder="Photogapher" type="text" autocomplete="off" value="<?php echo $_SESSION['loggedin_name']; ?>" class="form-control form-value" readonly required="" >
                            </div>



							<div class="col-md-12">
                                <p align="center" style="padding-top:10px;">
                                	<button class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"  adr_trans="label_save"><i class="fa fa-sign-in"></i>Save</button>
                         &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn" href="editor_list.php" adr_trans="label_cancel"><i class="fa fa-times"></i>Cancel</a>
								</p>
                            </div>
							</form>
							</td></tr></table>


						   </div>



                    </div>


            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>

                <div class="col-md-10">
                	<div class="tab-box" data-tab-anima="show-scale">
                    <h5 class="text-center">List of Editors</h5>


					<?php if(isset($_REQUEST['e'])) { ?>

					<p align="center" class="text-success" adr_trans="label_editor_created">Editor created Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['eu'])) { ?>

					<p align="center" class="text-success" adr_trans="label_editor_update">Editor updated Successfully!.</p>
					<?php } ?>

					<?php if(isset($_REQUEST['ed'])) { ?>

					<p align="center" class="text-success" adr_trans="label_editor_deleted">Editor deleted Successfully!.</p>
					<?php } ?>





<p align="right" style="width:100%;">
	<a class="lightbox btn btn-primary btn-sm circle-button"  id="addedit" href="#lb2" data-lightbox-anima="show-scale" style="float:right;margin-bottom:10px;" adr_trans="label_add_editor">+ Add Editor</a><br /><br />
						<div class="col-md-12" style="background:#000;color:#FFF;opacity:0.8;padding:10px;"></p>
<div id="flip-scroll">
<table class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_s.no">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" style="color:#FFF" adr_trans="label_name">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_organization">

                                Organization

                        </span>



						 <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_email_address">

                                Email address

                        </span>


						<span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_contact">

                                Contact

                        </span>

                        <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_photographer">

                                Photographer

                        </span>

						<span class="icon fa "></span></a></th><th data-column-id="link-icon" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable" style="color:#FFF"><span class="text" adr_trans="label_details">

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
									$created_by_id=$_SESSION['loggedin_id'];
									$q1="select count(*) as total from editor where photographer_id='$created_by_id'";
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
									$q = "SELECT * FROM editor where photographer_id='$created_by_id' LIMIT " . $start_no_users . ',' . $number_of_pages;
									$res=mysqli_query($con,$q);
									if($res == "0"){
					?><h5 align="center"> <?php echo "No Editors are Found";?> </h5>
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
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['email']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['contact_number']; ?></td>

				<td class="text-left" style="word-break:break-all;"><?php echo $_SESSION['loggedin_name']; ?></td>

				<td class="text-left" style=""><a target="" href="editor_list.php?editor_id=<?php echo $res1['id']; ?>&edit=1" class="link">
				<i class="fa fa-pencil" title="Edit editor details"></i></a> &nbsp;
				                 <a href="editor_list.php?editor_id=<?php echo $res1['id']; ?>&del=1" onclick="return confirmDelete();"><i class="fa fa-trash" title="Delete"></i></a></td>
				</tr>
				<?php }} ?></tbody>
            </table></div>

			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./editor_list.php?page=1" class="button"><<</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./editor_list.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./editor_list.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./editor_list.php?page=".($Page_check);?>" class="button">>></a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></div></div>
									</div>
								</div>




					<?php



					if(isset($_REQUEST['edit']))
					{
					$editor_id=$_REQUEST['editor_id'];
					$result=mysqli_query($con,"select * from editor where id='$editor_id'");
               //echo "select * from photographer_profile where photographer_id='$loggedin_id";
              $res11=mysqli_fetch_array($result);

					}

					?>



</div>

                </div>


            </div>
        </div>

</div>

<?php if(@$_REQUEST['edit'])
			{
			?>
			<script>
			$( document ).ready(function() {
   $("#addedit").click();
});

			</script>

			<?php } ?>
		<?php include "footer.php";  ?>
