<?php
ob_start();

include "connection1.php";



//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
//header("location:users.php");
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
                    <ul class="nav nav-tabs">
<li  id="tab11" class="active"><a onclick="" class="click" href="#">Approved Users</a></li>
<li id="tab21"><a class="click" href="#">Pending Users</a></li>
<li id="tab31"><a href="#">Denied Users</a></li>
</ul>

<div class="panel active" id="tab1">
<div>

		<span style="position: absolute;right: 25px">
				<form name="searchUser1" method="post" action="users.php" onsubmit="return validate1()" style="margin-left:5px;">
				Search User Name :
				 <input type="text"  list="Suggestions1" class="form-control form-value" id="user_name1" name="user_name1" value="" style="display:inline;width:150px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions1"  >
 <?php
							if(empty(@$_SESSION['usertype1']))
							{

								$user_name=mysqli_query($con,"select * from user_login where email_verified=1 order by first_name");
						  }
							if(!empty(@$_SESSION['usertype1']))
							{
							if(@$_SESSION['usertype1']!='PCAdmin')
							{
								$user_name=mysqli_query($con,"select * from user_login where email_verified=1 order by first_name");
							}
							else
							{
								$user_name=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=1 order by first_name");
						  }
						}
						// echo $username;
							while(@$user_first_name=mysqli_fetch_assoc(@$user_name))
							{
							?>
							<option value="<?php echo $user_first_name['first_name'].' '.$user_first_name['last_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php } ?>
</datalist>
</form>
</span>
<script type="text/javascript">
 function validate1()
 {
    if(document.getElementById('user_name1').value == "")
        {
            var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Skriv inn brukernavn i søkefeltet";
		}
		else
		{
		alertmsg="Enter a user name in the search bar";
		}
alert(alertmsg);

            return false;
        }
}


var initialArray = [];
        initialArray = $('#Suggestions1 option');
        $("#user_name1").keyup(function() {
          var inputVal = $('#user_name1').val();
          var first = [];
          first = $('#Suggestions1 option');
          if (inputVal != '' && inputVal != 'undefined') {
            var options = '';
            for (var i = 0; i < first.length; i++) {
              if (first[i].value.toLowerCase().startsWith(inputVal.toLowerCase())) {
                options += '<option value="' + first[i].value + '" />';
              }
            }
            document.getElementById('Suggestions1').innerHTML = options;
          } else {
            var options = '';
            for (var i = 0; i < initialArray.length; i++) {
              options += '<option value="' + initialArray[i].value + '" />';
            }
            document.getElementById('Suggestions1').innerHTML = options;
          }
        });
</script>

		<form name="search_filter1" method="post" action="users.php">
<select name="user_type1" class="form-control" id="user_type1" onchange="this.form.submit()" style="width:200px;left: 15px;">
				<option value="">Select a user type</option>
			    <!-- <option value="Photographer" <?php if(@$_REQUEST['user_type1']=="Photographer") { echo "selected"; } ?>>Photographer</option> -->
			    <option value="Realtor" <?php if(@$_REQUEST['user_type1']=="Realtor") { echo "selected"; } ?>>Realtor</option>
			    <!-- <option value="CSR" <?php if(@$_REQUEST['user_type1']=="CSR") { echo "selected"; } ?>>CSR</option> -->
					<option value="PCAdmin" <?php if(@$_REQUEST['user_type1']=="PCAdmin") { echo "selected"; } ?>>PCAdmin</option>
			    <!-- <option value="All" <?php if(@$_REQUEST['user_type1']=="All") { echo "selected"; } ?>>All</option> -->
  		</select>
		</form>
</div>


<hr class="space s">
					<table class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style="width:100px;word-break:break-all;"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

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
					@$_SESSION["page"]=1;
				}
				else {
					@$_SESSION["page"]=$_GET["page"];
				}
				if(@$_SESSION["page"] < 0)
				{
					@$_SESSION["page"]=1;
				}
				if(isset($_REQUEST['user_type1']))
	      {
	      	if($_REQUEST['user_type1'] == "All"){
	      		@$_SESSION['usertype1']=$_REQUEST['user_type1'];
	      		$q1 = "select count(*) as total from user_login WHERE email_verified='1' ";
	      	}
					elseif($_REQUEST['user_type1']=="PCAdmin")
					{


							@$_SESSION['usertype1']=$_REQUEST['user_type1'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$q1 = "select count(*) as total from admin_users WHERE is_approved='1' and type_of_user='".@$_SESSION['usertype1']."'";
					}
	      	else{
	     @$_SESSION['usertype1']=$_REQUEST['user_type1'];
	     $q1 = "select count(*) as total from user_login WHERE email_verified='1' AND type_of_user='".@$_SESSION['usertype1']."'" ;
	 }
	      }
	   elseif(!empty(@$_SESSION['usertype1']))
	     {
	     	if (@$_SESSION['usertype1'] =="All") {

	     		$q1 = "select count(*) as total from user_login WHERE email_verified='1' ";
	     	}
				elseif(@$_SESSION['usertype1']=="PCAdmin")
				{

							$q1 = "select count(*) as total from admin_users WHERE is_approved='1' and type_of_user='".@$_SESSION['usertype1']."'";
				}
	     	else{
	     $q1 = "select count(*) as total from user_login WHERE email_verified='1' AND type_of_user='".@$_SESSION['usertype1']."'";
	 }
	      }
				// elseif(empty(@$_SESSION['usertype1']))
				//  {
				//   $q1 = "select count(*) as total from user_login WHERE email_verified='1' ";
				// }

			if(isset($_REQUEST['user_name1']))
{
	$user1 = $_REQUEST['user_name1']." ";

$new1 = explode(" ",$user1);
 $fname1 = $new1['0'];
 $lname1 = $new1['1'];
if(@$_SESSION['usertype1']!='PCAdmin')
{

	$q1 = "select count(*) as total from user_login WHERE email_verified='1' AND (first_name='$fname1' AND last_name='$lname1') ";
}
else {
	$q1 = "select count(*) as total from admin_users WHERE  is_approved='1' AND (first_name='$fname1' AND last_name='$lname1') ";
}
}


				//$q1="select count(*) as total from user_login WHERE type_of_user=''";
				@$result=mysqli_query($con,@$q1);
				if(@$result == "0"){
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				$data=mysqli_fetch_assoc(@$result);
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
				if($Page_check<=@$_SESSION["page"])
				{
					@$_SESSION["page"]=$Page_check;
				}
				// how many entries shown in page

				//starting number to print the users shown in page
				$start_no_users = (@$_SESSION["page"]-1) * $number_of_pages;

         $cnt=$start_no_users;
     }
if(isset($_REQUEST['user_type1']))
{
$user_type=$_REQUEST['user_type1'];

if($_REQUEST['user_type1'] == "All"){

$q = "SELECT *FROM user_login WHERE email_verified='1' LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type1']=="PCAdmin")
{
      echo "";
			$q = "SELECT *FROM admin_users WHERE is_approved='1' AND type_of_user='".@$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . '5';
}
else{
$q = "SELECT *FROM user_login WHERE email_verified='1' AND type_of_user='".@$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty(@$_SESSION['usertype1']))
{
	if (@$_SESSION['usertype1'] =="All") {

		$q = "SELECT *FROM user_login WHERE email_verified='1' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif(@$_SESSION['usertype1']=="PCAdmin")
	{

				$q = "SELECT *FROM admin_users WHERE is_approved='1' AND type_of_user='".@$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	else{
	$q = "SELECT *FROM user_login WHERE email_verified='1' AND type_of_user='".@$_SESSION['usertype1']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty(@$_SESSION['usertype1']))
//  {
// 	$q = "SELECT *FROM user_login WHERE email_verified='1' LIMIT " . $start_no_users . ',' . $number_of_pages;
// }

if(isset($_REQUEST['user_name1']))
{
	$userName1 = $_REQUEST['user_name1']." ";
$new = explode(" ",$userName1);
$fname = $new['0'];
$lname = $new['1'];
if(@$_SESSION['usertype1']!='PCAdmin')
{
	$q = "SELECT *FROM user_login WHERE email_verified='1' AND (first_name='$fname' AND last_name='$lname' )  LIMIT " . $start_no_users . ',' . $number_of_pages;
}
	else {
		$q = "SELECT *FROM admin_users WHERE is_approved='1' AND (first_name='$fname' AND last_name='$lname') LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
}

				@$res=mysqli_query($con,@$q);
				if(@$res == "0"){
					?><h5 align="center"> <?php echo "No Approved Users are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				while($res1=mysqli_fetch_array($res))
				{
				$cnt++;
				   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;word-break:break-all;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $res1['organization']; ?></td>
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $res1['contact_number']; ?></td>
				<td class="text-left" style=""><?php if(@$_SESSION['usertype1']!='PCAdmin'){$approved=$res1['email_verified']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }}else{$approved=$res1['is_approved']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }} ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=0<?php  if(@$_SESSION['usertype1']!='PCAdmin'){ echo "&id=".$res1['id']; }else{ echo "&id1=".$res1['id']; }?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php }} ?>
            </table>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page=".(@$_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo @$_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page=".(@$_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
									</div>
								</div>

</div>

<div class="panel" id="tab2">
<div>

		<span style="position: absolute;right: 25px">
				<form name="searchUser2" method="post" action="" onsubmit="return validate2()" style="margin-left:5px;">
				Search User Name :
				 <input type="text"  list="Suggestions2" class="form-control form-value" id="user_name2" name="user_name2" value="" style="display:inline;width:150px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions2"  >
 <?php
 if(empty(@$_SESSION['usertype2']))
 {

	 $user_name2=mysqli_query($con,"select * from user_login where email_verified=0 order by first_name");
 }
 if(!empty(@$_SESSION['usertype1']))
 {
 if(@$_SESSION['usertype1']!='PCAdmin')
 {
	 $user_name2=mysqli_query($con,"select * from user_login where email_verified=0 order by first_name");
 }
 else
 {
	 $user_name2=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=0 order by first_name");
 }
}
							while($user_first_name=mysqli_fetch_assoc($user_name2))
							{
							?>
							<option value="<?php echo $user_first_name['first_name'].' '.$user_first_name['last_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php } ?>
</datalist>
</form>
</span>
<script type="text/javascript">
 function validate2()
 {
    if(document.getElementById('user_name2').value == "")
        {
            var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Skriv inn brukernavn i søkefeltet";
		}
		else
		{
		alertmsg="Enter a user name in the search bar";
		}
alert(alertmsg);
            return false;
        }
}



var initialArray = [];
        initialArray = $('#Suggestions2 option');
        $("#user_name2").keyup(function() {
          var inputVal = $('#user_name2').val();
          var first = [];
          first = $('#Suggestions2 option');
          if (inputVal != '' && inputVal != 'undefined') {
            var options = '';
            for (var i = 0; i < first.length; i++) {
              if (first[i].value.toLowerCase().startsWith(inputVal.toLowerCase())) {
                options += '<option value="' + first[i].value + '" />';
              }
            }
            document.getElementById('Suggestions2').innerHTML = options;
          } else {
            var options = '';
            for (var i = 0; i < initialArray.length; i++) {
              options += '<option value="' + initialArray[i].value + '" />';
            }
            document.getElementById('Suggestions2').innerHTML = options;
          }
        });

</script>
		<form name="search_filter2"  method="post" action="">
		<select name="user_type2" class="form-control" id="user_type2" onchange="this.form.submit()" style="width:200px;left: 15px;">
				<option value="">Select a user type</option>
			  <!-- <option value="Photographer" <?php if(@$_REQUEST['user_type2']=="Photographer") { echo "selected"; } ?>>Photographer</option> -->
			    <option value="Realtor" <?php if(@$_REQUEST['user_type2']=="Realtor") { echo "selected"; } ?>>Realtor</option>
			  <option value="PCAdmin" <?php if(@$_REQUEST['user_type1']=="PCAdmin") { echo "selected"; } ?>>PCAdmin</option>
			    <!-- <option value="All" <?php if(@$_REQUEST['user_type2']=="All") { echo "selected"; } ?>>All</option> -->
  		</select>
		</form>
</div>


<hr class="space s">
					<table class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left"  style="width:100px;word-break:break-all;"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

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
				if(empty($_GET["page1"]))
				{
					@$_SESSION["page1"]=1;
				}
				else {
					@$_SESSION["page1"]=$_GET["page1"];
				}
				if(@$_SESSION["page1"] < 0)
				{
					@$_SESSION["page1"]=1;
				}
				if(isset($_REQUEST['user_type2']))
	      {
	      	if($_REQUEST['user_type2'] == "All"){
	      		@$_SESSION['usertype2']=$_REQUEST['user_type2'];
	      		$Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
	      	}
					elseif($_REQUEST['user_type2']=="PCAdmin")
					{


							@$_SESSION['usertype2']=$_REQUEST['user_type2'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$Pending = "select count(*) as total from admin_users WHERE is_approved='0' and type_of_user='".@$_SESSION['usertype2']."'";
					}
	      	else{
	     @$_SESSION['usertype2']=$_REQUEST['user_type2'];
	     $Pending = "select count(*) as total from user_login WHERE email_verified='0' AND type_of_user='".@$_SESSION['usertype2']."'" ;
	 }
	      }
	   elseif(!empty(@$_SESSION['usertype2']))
	     {
	     	if (@$_SESSION['usertype2'] =="All") {

	     		$Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
	     	}
				elseif(@$_SESSION['usertype2']=="PCAdmin")
				{
							$Pending = "select count(*) as total from admin_users WHERE is_approved='0' and type_of_user='".@$_SESSION['usertype2']."'";
				}
	     	else{
	     $Pending = "select count(*) as total from user_login WHERE email_verified='0' AND type_of_user='".@$_SESSION['usertype2']."'";
	 }
	      }
				// elseif(empty(@$_SESSION['usertype2']))
				//  {
				//   $Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
				// }


	if(isset($_REQUEST['user_name2']))
{
	$user2 = $_REQUEST['user_name2']." ";

$new2 = explode(" ",$user2);
$fname2 = $new2['0'];
$lname2 = $new2['1'];

if(@$_SESSION['usertype2']!='PCAdmin')
{

	$Pending = "select count(*) as total from user_login WHERE email_verified='0' AND (first_name='$fname1' AND last_name='$lname1') ";
}
else {
	$Pending = "select count(*) as total from admin_users WHERE  is_approved='0' AND (first_name='$fname1' AND last_name='$lname1') ";
}
}



				//$Pending="select count(*) as total from user_login WHERE type_of_user=''";
				@$pending1=mysqli_query($con,@$Pending);
				if(@$pending1 == "0"){
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				$data1=mysqli_fetch_assoc(@$pending1);
				$number_of_pages=5;

				// total number of user shown in database
				$total_no=$data1['total'];

				$Page_check=intval($total_no/$number_of_pages);
				$page_check1=$total_no%$number_of_pages;
				if($page_check1 == 0)
				;
				else{
					$Page_check=$Page_check+1;
				}
				if($Page_check<=@$_SESSION["page1"])
				{
					@$_SESSION["page1"]=$Page_check;
				}
				// how many entries shown in page

				//starting number to print the users shown in page
				$start_no_users = (@$_SESSION["page1"]-1) * $number_of_pages;

         $cnt=$start_no_users;
     }


if(isset($_REQUEST['user_type2']))
{
$user_type=$_REQUEST['user_type2'];
if($_REQUEST['user_type2'] == "All"){

$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type2']=="PCAdmin")
{

			$Pending_data = "SELECT *FROM admin_users WHERE is_approved='0' AND type_of_user='".@$_SESSION['usertype2']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
else{
$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' AND type_of_user='".@$_SESSION['usertype2']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty(@$_SESSION['usertype2']))
{
	if (@$_SESSION['usertype2'] =="All") {

		$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif(@$_SESSION['usertype2']=="PCAdmin")
	{

				$Pending_data = "SELECT *FROM admin_users WHERE is_approved='0' AND type_of_user='".$_SESSION['usertype2']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	else{
	$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' AND type_of_user='".@$_SESSION['usertype2']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty(@$_SESSION['usertype2']))
//  {
// 	$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;
// }


if(isset($_REQUEST['user_name2']))
{
	$userName2 = $_REQUEST['user_name2']." ";
$new_2 = explode(" ",$userName2);
$fname_2 = $new_2['0'];
$lname_2 = $new_2['1'];


if(@$_SESSION['usertype2']!='PCAdmin')
{
	$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' AND (first_name='$fname' AND last_name='$lname' )  LIMIT " . $start_no_users . ',' . $number_of_pages;
}
	else {
		$Pending_data = "SELECT *FROM admin_users WHERE is_approved='0' AND (first_name='$fname' AND last_name='$lname') LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
}

				@$pending_data1=mysqli_query($con,@$Pending_data);
				if(@$pending_data1 == "0"){
					?><h5 align="center"> <?php echo "No Pending Users are Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				while($pending_data2=mysqli_fetch_array($pending_data1))
				{
				$cnt++;
				   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;word-break:break-all;"><?php echo $pending_data2['first_name']; ?> <?php echo $pending_data2['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $pending_data2['organization']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['city']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $pending_data2["id"]; ?>">
				<img src="data:<?php echo $pending_data2['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($pending_data2['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $pending_data2['contact_number']; ?></td>
				<td class="text-left" style=""><?php if(@$_SESSION['usertype2']!='PCAdmin'){$approved=$pending_data2['email_verified']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }}else{$approved=$pending_data2['is_approved']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }} ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=0<?php  if(@$_SESSION['usertype2']!='PCAdmin'){ echo "&id=".$pending_data2['id']; }else{ echo "&id1=".$pending_data2['id']; }?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php } }?>

            </table>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page1=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page1=".(@$_SESSION["page1"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo @$_SESSION["page1"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page1=".(@$_SESSION["page1"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page1=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
									</div>
								</div>

</div>


<div class="panel" id="tab3">
<div>

		<span style="position: absolute;right: 25px">
				<form name="searchUser3" method="post" action="" onsubmit="return validate3()" style="margin-left:5px;">
				Search User Name :
				 <input type="text"  list="Suggestions3" class="form-control form-value" id="user_name3" name="user_name3" value="" style="display:inline;width:150px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions3"  >
 <?php
 if(empty(@$_SESSION['usertype3']))
 {

	 $user_name3=mysqli_query($con,"select * from user_login where email_verified=2 order by first_name");
 }
 if(!empty(@$_SESSION['usertype3']))
 {
 if(@$_SESSION['usertype1']!='PCAdmin')
 {
	 $user_name3=mysqli_query($con,"select * from user_login where email_verified=2 order by first_name");
 }
 else
 {
	 $user_name3=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=2 order by first_name");
 }
}
							while($user_first_name=mysqli_fetch_assoc($user_name3))
							{
							?>


							<option value="<?php echo $user_first_name['first_name'].' '.$user_first_name['last_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php } ?>
</datalist>
</form>
</span>
<script type="text/javascript">
 function validate3()
 {
    if(document.getElementById('user_name3').value == "")
        {
            var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Skriv inn brukernavn i søkefeltet";
		}
		else
		{
		alertmsg="Enter a user name in the search bar";
		}
alert(alertmsg);
            return false;
        }
}


var initialArray = [];
        initialArray = $('#Suggestions3 option');
        $("#user_name3").keyup(function() {
          var inputVal = $('#user_name3').val();
          var first = [];
          first = $('#Suggestions3 option');
          if (inputVal != '' && inputVal != 'undefined') {
            var options = '';
            for (var i = 0; i < first.length; i++) {
              if (first[i].value.toLowerCase().startsWith(inputVal.toLowerCase())) {
                options += '<option value="' + first[i].value + '" />';
              }
            }
            document.getElementById('Suggestions3').innerHTML = options;
          } else {
            var options = '';
            for (var i = 0; i < initialArray.length; i++) {
              options += '<option value="' + initialArray[i].value + '" />';
            }
            document.getElementById('Suggestions3').innerHTML = options;
          }
        });


</script>
		<form name="search_filter3" method="post" action="">
		<select name="user_type3" class="form-control"  id="user_type3" onchange="this.form.submit()" style="width:200px;left: 15px;">
				<option value="">Select a user type</option>
			   <!-- <option value="Photographer" <?php if(@$_REQUEST['user_type3']=="Photographer") { echo "selected"; } ?>>Photographer</option> -->
			    <option value="Realtor" <?php if(@$_REQUEST['user_type3']=="Realtor") { echo "selected"; } ?>>Realtor</option>
			 		<option value="PCAdmin" <?php if(@$_REQUEST['user_type1']=="PCAdmin") { echo "selected"; } ?>>PCAdmin</option>
			    <!-- <option value="All" <?php if(@$_REQUEST['user_type3']=="All") { echo "selected"; } ?>>All</option> -->
  		</select>
		</form>
</div>


<hr class="space s">
					<table class="table table-condensed table-hover table-striped bootgrid-table" aria-busy="false">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                S.No

                        </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left"  style="width:100px;word-break:break-all;"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

                                Name

                        </span>
						<span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left"><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text">

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
				if(empty($_GET["page2"]))
				{
					@$_SESSION["page2"]=1;
				}
				else {
					@$_SESSION["page2"]=$_GET["page2"];
				}
				if(@$_SESSION["page2"] < 0)
				{
					@$_SESSION["page2"]=1;
				}
				if(isset($_REQUEST['user_type3']))
	      {
	      	if($_REQUEST['user_type3'] == "All"){
	      		@$_SESSION['usertype3']=$_REQUEST['user_type3'];
	      		$denied = "select count(*) as total from user_login WHERE email_verified='2' ";
	      	}
					elseif($_REQUEST['user_type3']=="PCAdmin")
					{


							@$_SESSION['usertype3']=$_REQUEST['user_type3'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$denied = "select count(*) as total from admin_users WHERE is_approved='2' and type_of_user='".@$_SESSION['usertype3']."'";
					}
	      	else{
	     @$_SESSION['usertype3']=$_REQUEST['user_type3'];
	     $denied = "select count(*) as total from user_login WHERE email_verified='2' AND type_of_user='".@$_SESSION['usertype3']."'" ;
	 }
	      }
	   elseif(!empty(@$_SESSION['usertype3']))
	     {
	     	if (@$_SESSION['usertype3'] =="All") {

	     		$denied = "select count(*) as total from user_login WHERE email_verified='2' ";
	     	}
				elseif(@$_SESSION['usertype3'] =="PCAdmin")
				{



						// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
							$denied = "select count(*) as total from admin_users WHERE is_approved='2' and type_of_user='".@$_SESSION['usertype3']."'";
				}
	     	else{
	     $denied = "select count(*) as total from user_login WHERE email_verified='2' AND type_of_user='".@$_SESSION['usertype3']."'";
	      }
	  }
				// elseif(empty(@$_SESSION['usertype3']))
				//  {
				//   $denied = "select count(*) as total from user_login WHERE email_verified='2'  ";
				// }

// 				if(isset($_REQUEST['user_name3']))
// {
// 	$user3 = $_REQUEST['user_name3'];
//
// 	$denied = "select count(*) as total from user_login WHERE email_verified='2' AND first_name='$user3' ";
// }



			if(isset($_REQUEST['user_name3']))
{
	$user3 = $_REQUEST['user_name3']." ";



$new3 = explode(" ",$user3);
$fname3 = $new3['0'];
$lname3 = $new3['1'];

if(@$_SESSION['usertype3']!='PCAdmin')
{

	$denied = "select count(*) as total from user_login WHERE email_verified='2' AND (first_name='$fname1' AND last_name='$lname1') ";
}
else {
	$denied = "select count(*) as total from admin_users WHERE  is_approved='2' AND (first_name='$fname1' AND last_name='$lname1') ";
}
}


				//$denied="select count(*) as total from user_login WHERE type_of_user=''";
				@$denied1=mysqli_query($con,@$denied);
				if(@$denied1 == "0"){
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				$data2=mysqli_fetch_assoc($denied1);
				$number_of_pages=5;

				// total number of user shown in database
				$total_no=$data2['total'];

				$Page_check=intval($total_no/$number_of_pages);
				$page_check1=$total_no%$number_of_pages;
				if($page_check1 == 0)
				;
				else{
					$Page_check=$Page_check+1;
				}
				if($Page_check<=@$_SESSION["page2"])
				{
					@$_SESSION["page2"]=$Page_check;
				}
				// how many entries shown in page

				//starting number to print the users shown in page
				$start_no_users = (@$_SESSION["page2"]-1) * $number_of_pages;

         $cnt=$start_no_users;
     }
if(isset($_REQUEST['user_type3']))
{
$user_type=$_REQUEST['user_type3'];
if($_REQUEST['user_type3'] == "All"){

$denied_data = "SELECT *FROM user_login WHERE email_verified='2' LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type3']=="PCAdmin")
{

			$q = "SELECT *FROM admin_users WHERE is_approved='2' AND type_of_user='".@$_SESSION['usertype3']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
else{
$denied_data = "SELECT *FROM user_login WHERE email_verified='2' AND type_of_user='".@$_SESSION['usertype3']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty(@$_SESSION['usertype3']))
{
	if (@$_SESSION['usertype3'] =="All") {

		$denied_data = "SELECT *FROM user_login WHERE email_verified='2' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif(@$_SESSION['usertype3']=="PCAdmin")
	{

				$denied_data = "SELECT *FROM admin_users WHERE is_approved='2' AND type_of_user='".@$_SESSION['usertype3']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}

	else{
	$denied_data = "SELECT *FROM user_login WHERE email_verified='2' AND type_of_user='".@$_SESSION['usertype3']."' LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty(@$_SESSION['usertype3']))
//  {
// 	$denied_data = "SELECT *FROM user_login WHERE email_verified='2' and type_od_user LIMIT " . $start_no_users . ',' . $number_of_pages;
// }

if(isset($_REQUEST['user_name3']))
{
	$userName3 = $_REQUEST['user_name3']." ";
$new_3 = explode(" ",$userName3);
$fname_3 = $new_3['0'];
$lname_3 = $new_3['1'];


if(@$_SESSION['usertype3']!='PCAdmin')
{
	$denied_data = "SELECT *FROM user_login WHERE email_verified='2' AND (first_name='$fname' AND last_name='$lname' )  LIMIT " . $start_no_users . ',' . $number_of_pages;
}
	else {
		$denied_data = "SELECT *FROM admin_users WHERE is_approved='2' AND (first_name='$fname' AND last_name='$lname') LIMIT " . $start_no_users . ',' . $number_of_pages;
	}

}

				@$denied_data1=mysqli_query($con,@$denied_data);
				if(@$denied_data1 == "0"){
					?><h5 align="center"> <?php echo "No Denied Users Found";?> </h5>
          <?php
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				while($denied_data2=mysqli_fetch_array($denied_data1))
				{
				$cnt++;
				   //	---------------------------------  pagination starts ---------------------------------------
				?>
				<tr data-row-id="0">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;word-break:break-all;"><?php echo $denied_data2['first_name']; ?> <?php echo $denied_data2['last_name']; ?></td>
				<td class="text-left" style="word-break:break-all;"><?php echo $denied_data2['organization']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['city']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $denied_data2["id"]; ?>">
				<img src="data:<?php echo $denied_data2['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($denied_data2['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $denied_data2['contact_number']; ?></td>
				<td class="text-left" style=""><?php if(@@$_SESSION['usertype3']!='PCAdmin'){$approved=$denied_data2['email_verified']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }}else{$approved=$denied_data2['is_approved']; if($approved==0) { echo "<span style='color:red;font-weight:bold;'>Pending</span>"; } elseif($approved==2) { echo "<span style='color:red;font-weight:bold;'>Blocked</span>"; } else { echo "<span style='color:green;font-weight:bold;'>Approved</span>"; }} ?></td>
				<td class="text-left" style=""><a target="" href="userDetails.php?val=0<?php  if(@$_SESSION['usertype3']!='PCAdmin'){ echo "&id=".$denied_data2['id']; }else{ echo "&id1=".$denied_data2['id']; }?>" class="link">
				<i class="fa fa-external-link"></i></a></td>
				</tr>
				<?php }} ?>
            </table>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page2=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page2=".(@$_SESSION["page2"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo @$_SESSION["page2"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page2=".(@$_SESSION["page2"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page2=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
									</div>
								</div>

</div>




                </div>


            </div>
        </div>

</div>

<?php if(isset($_REQUEST['user_type1']) || isset($_REQUEST['user_name1']) || isset($_GET["page"]) )
{ ?>
<script>

$("#tab1").addClass("active");
$("#tab2").removeClass("active");
$("#tab3").removeClass("active");

$("#tab11").addClass("active");
$("#tab21").removeClass("active");
$("#tab31").removeClass("active");
</script>
<?php } ?>


<?php if(isset($_REQUEST['user_type2']) || isset($_REQUEST['user_name2']) || isset($_GET["page1"]) )
{ ?>
<script>
$("#tab2").addClass("active");
$("#tab1").removeClass("active");
$("#tab3").removeClass("active");

$("#tab21").addClass("active");
$("#tab11").removeClass("active");
$("#tab31").removeClass("active");
</script>
<?php } ?>


<?php if(isset($_REQUEST['user_type3']) || isset($_REQUEST['user_name3']) || isset($_GET["page2"]) )
{ ?>
<script>
$("#tab3").addClass("active");
$("#tab2").removeClass("active");
$("#tab1").removeClass("active");

$("#tab31").addClass("active");
$("#tab21").removeClass("active");
$("#tab11").removeClass("active");
</script>
<?php } ?>

<script>
$(document).ready(function(){
   window.location="users.php";
  });
});

</script>


		<?php include "footer.php";  ?>
