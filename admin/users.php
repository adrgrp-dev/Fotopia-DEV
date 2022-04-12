<?php
ob_start();

include "connection1.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
//header("location:users.php");
// if(@$_REQUEST['user_type'])
// {
// 	$_SESSION['usertype1']="Realtor";
// 	$_SESSION['usertype2']="Realtor";
// 	$_SESSION['usertype3']="Realtor";
// }
?>


<style>
   .infos{
		margin-left: 269px;
		margin-top: 20px;
		margin-right: -40px;
	 }

	 .nav-tabs
{
 border: none !important; 
 margin-top: 5px !important ;
}

.nav-tabs > li
{
  margin-left: 0px !important;
}
.nav-tabs > li > a:hover
{
  padding-bottom: 8px;
}
.nav-tabs > li.active > a:hover
{
  padding-bottom: 2px;
}


.nav-tabs > li > a
{
  border-radius: 5px!important;
}

.tab-box .nav-tabs li.active 
{
  padding-top: 6px!important;
    padding-bottom: 6px!important;
    padding-left: 0px!important;
    padding-right: 0px!important;
}

@media only screen and (max-width: 600px) {
.infos
{
margin-left: 0px !important;
margin-top: -20px !important;
margin-right: -35px !important;
}
.col-md-10 > a
{
	margin-top: -35px !important;
}
}	
th
{
    background: #aad1d6;
    padding-top: 10px !important;
    padding-bottom: 10px;
    padding-left: 3px !important;
} 
input[type="submit"]
{
	padding: 6px 10px;
}
	</style>

<?php include "header.php";  ?>
 <div class="section-empty bgimage5">
        <div class="" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:15px;">
	<?php include "sidebar.php"; ?>

 
			</div>

                <div class="col-md-10" style="margin-top:19px;">
									<a href="create_organization.php" class="circle-button btn adr-save" style="float:right;font-size: 12px;height: 30px;margin-top:5px;"><i class="fa fa-plus fa-xs"></i>Create</a>
                	<div class="tab-box" data-tab-anima="show-scale">
                   
                    <ul class="nav nav-tabs">
<li  id="tab11" class="active"><a onclick="" class="click" href="#">Approved Users</a></li>
<li id="tab21"><a class="click" href="#">Pending Users</a></li>
<li id="tab31"><a href="#">Denied Users</a></li>
</ul>

<div class="panel active" id="tab1">
<div>
<?php
								// echo $q1;
								$q="";
								$q1="";
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
				if($_SESSION["page"] < 0)
				{
					$_SESSION["page"]=1;
				}
				if(isset($_REQUEST['user_type1']))
	      {
	      	$_SESSION['usertype1']=$_REQUEST['user_type1'];

					if($_REQUEST['user_type1']=="PCAdmin")
					{


							$_SESSION['usertype1']=$_REQUEST['user_type1'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$q1 = "select count(*) as total from admin_users WHERE is_approved='1' and type_of_user='".$_SESSION['usertype1']."'";
					}
	      	else{
	     $_SESSION['usertype1']=$_REQUEST['user_type1'];
	     $q1 = "select count(*) as total from user_login WHERE email_verified='1' AND type_of_user='".$_SESSION['usertype1']."'" ;
	 }
	      }
	   elseif(!empty($_SESSION['usertype1']))
	     {
	     	if ($_SESSION['usertype1'] =="All") {

	     		// echo "coimmg";

	     		$q1 = "select count(*) as total from user_login WHERE email_verified='1' ";
	     	}
				elseif($_SESSION['usertype1']=="PCAdmin")
				{

							$q1 = "select count(*) as total from admin_users WHERE is_approved='1' and type_of_user='".$_SESSION['usertype1']."'";
				}
	     	else{
	     $q1 = "select count(*) as total from user_login WHERE email_verified='1' AND type_of_user='".$_SESSION['usertype1']."'";


	 }
	      }
				


				// elseif(empty($_SESSION['usertype1']))
				//  {
				//   $q1 = "select count(*) as total from user_login WHERE email_verified='1' ";
				// }

			if(isset($_REQUEST['user_name1']))
{
	$user1 = trim($_REQUEST['user_name1']);

// $new1 = explode(" ",$user1);
//  $fname1 = $new1['0'];
//  $lname1 = $new1['1'];
if('PCAdmin'!=$_SESSION['usertype1'])
{

	$q1 = "select count(*) as total from user_login WHERE type_of_user='Realtor' AND email_verified='1' AND (first_name like '%$user1%' or last_name like '%$user1%' or organization_name like '%$user1%') ";
}
else {
	$q1 = "select count(*) as total from admin_users WHERE type_of_user='PCAdmin' AND  is_approved='1' AND (first_name like '%$user1%' or last_name like '%$user1%' or organization_name like '%$user1%') ";
}
}

// print_r($_SESSION);

// print_r($_REQUEST);

if (empty($_SESSION['usertype1']) && @$_REQUEST['user_type1']=='') {
	// code...
$q1 = "SELECT COUNT(first_name) as total FROM (SELECT first_name FROM `admin_users` where type_of_user='PCAdmin' and is_approved=1 UNION ALL SELECT first_name FROM `user_login` where type_of_user='Realtor' and email_verified=1) AS total;";
}

//echo $q1;
				//$q1="select count(*) as total from user_login WHERE type_of_user=''";
				$result=mysqli_query($con,$q1);
				if(@$result == "0"){
					$cnt =0;
			     	$total_no=0;
			     	$start_no_users= -1;
				}
				else{
				$data=mysqli_fetch_assoc(@$result);
				$number_of_pages=50;

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
     }


	 // echo $q;
if(isset($_REQUEST['user_type1']))
{
$user_type=$_REQUEST['user_type1'];

if($_REQUEST['user_type1'] == "All"){

$q = "SELECT *FROM user_login WHERE email_verified='1' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type1']=="PCAdmin")
{
      echo "";
			$q = "SELECT *FROM admin_users WHERE is_approved='1' AND type_of_user='".$_SESSION['usertype1']."' order by id desc LIMIT " . $start_no_users . ',' .$number_of_pages;
}
else{
$q = "SELECT *FROM user_login WHERE email_verified='1' AND type_of_user='".$_SESSION['usertype1']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty($_SESSION['usertype1']))
{
	if ($_SESSION['usertype1'] =="All") {

		$q = "SELECT *FROM user_login WHERE email_verified='1' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif($_SESSION['usertype1']=="PCAdmin")
	{

				$q = "SELECT *FROM admin_users WHERE is_approved='1' AND type_of_user='".$_SESSION['usertype1']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	else{
	$q = "SELECT *FROM user_login WHERE email_verified='1' AND type_of_user='".$_SESSION['usertype1']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty($_SESSION['usertype1']))
//  {
// 	$q = "SELECT *FROM user_login WHERE email_verified='1' LIMIT " . $start_no_users . ',' . $number_of_pages;
// }

if(isset($_REQUEST['user_name1']))
{
	// echo "coimng".$_SESSION['usertype1'];
	$userName1 = trim($_REQUEST['user_name1']);
// $new = explode(" ",$userName1);
// $fname = $new['0'];
// $lname = $new['1'];
if('PCAdmin'!=$_SESSION['usertype1'])
{
	$q = "SELECT *FROM user_login WHERE type_of_user='Realtor' AND email_verified='1' AND (first_name like '%$userName1%' or last_name like '%$userName1%' or organization_name like '%$userName1%') order by id desc  LIMIT " . $start_no_users . ',' . $number_of_pages;
	// echo "coimng1111";
}
	else {
		$q = "SELECT *FROM admin_users WHERE type_of_user='PCAdmin' AND is_approved='1' AND (first_name like '%$userName1%' or last_name like '%$userName1%' or organization_name like '%$userName1%') order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;

			// echo "coimng2222";
	}
}

// print_r($_SESSION);
// echo 'a'.$_REQUEST['user_type1'].'b';
if (empty($_SESSION['usertype1']) && @$_REQUEST['user_type1']=='') {
	// code...

	 $q = "SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,is_approved,registered_on FROM `admin_users` where type_of_user='PCAdmin' and is_approved=1 UNION ALL SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,email_verified as is_approved,registered_on FROM `user_login` where type_of_user='Realtor' AND email_verified=1 order by registered_on desc LIMIT " . $start_no_users . ',' . $number_of_pages;

}
// echo $q;
?>

     <div class="row" style="margin-left: 0px;">
     	<div class="col-md-3">
     		<span style="">

				<form name="searchUser1" method="post" id="searchUser1" action="users.php" onsubmit="return validate1()" style="">
				Search :
				 <input type="text"  list="Suggestions1" class="form-control form-value" id="user_name1" name="user_name1" value="" style="display:inline;width:150px;height: 30px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions1"  >
 <?php
							$user_name="";
							if(!empty($_SESSION['usertype1']))
							{
							if($_SESSION['usertype1']!='PCAdmin')
							{
								$user_name=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and email_verified=1 order by id desc");
							}
							else
							{
								$user_name=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=1 order by id desc");
						  }
						}
						else
						{
						$user_name=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=1 order by id desc");

						}

							while(@$user_first_name=mysqli_fetch_assoc(@$user_name))
							{
							?>
							<option value="<?php echo $user_first_name['first_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php } ?>
</datalist>

</form>
</span>
     	</div>
     	<div class="col-md-9" style="padding-right: 0px;">
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

		<div class="" style="float:right">
		<form name="clear_approved_user_filter" method="post" action="">
		<input type="hidden" name="user_type1" value="<?php if(isset($_SESSION['usertype1'])){echo $_SESSION['usertype1'];} ?>" />
		<input type="submit" name="clear_approved_user_filter_btn " value="Clear Filter" class="btn btn-primary btn-sm adr-save" style="height:30px;font-size: 12px;color: #000;" />
		</form>
		</div>
<div class="" style="float:right;margin-right: 10px;">
		<form name="search_filter1" method="post" action="users.php">
   <select name="user_type1" class="form-control" id="user_type1" onchange="this.form.submit()" style="width:160px;left: 15px;display:inline;height:30px;font-size: 12px;color: #000;">
				<option value="">Select a user type</option>
			
			    <option value="Realtor" <?php if(isset($_SESSION['usertype1']) && $_SESSION['usertype1']=='Realtor' ) { echo "selected"; } else { echo " "; }  ?>>Realtor</option>
			
					<option value="PCAdmin" <?php if(isset($_SESSION['usertype1']) && $_SESSION['usertype1']=='PCAdmin' ) { echo "selected"; } else { echo " "; }  ?>>PCAdmin</option>
  		</select>
		</form>
		</div>

     	</div>
     </div>
		

</div>

<div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
					<table class="table-stripped" aria-busy="false" style="width:100%">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><span class="text">

                                S.No

                        </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style="width:100px;"><span class="text">

                                Name

                        </span>
						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                Organization

                        </span>


						<span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text">

                                Type

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

						<span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text">

                                Status

                        </span>

						<span class="icon fa "></span></th><th data-column-id="link-icon" class="text-center" style=""><span class="text">

                                Details

                        </span><span class="icon fa "></span></th></tr>
                </thead>
                <tbody>

    <?php
                   //	---------------------------------  pagination starts ---------------------------------------
if(!isset($_REQUEST['user_type1']) || @$_REQUEST['user_type1']==''){ ?>

	      		
<script>
 document.getElementById('searchUser1').style.display = "none";
</script>


<?php

// unset($_SESSION['usertype1']);

if (isset($_REQUEST['user_name1']) || !empty($_SESSION['usertype1'])) {

?>

<script>
 document.getElementById('searchUser1').style.display = "block";
</script>

<?php }

	      	}
				// echo $q;				
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
				<tr data-row-id="0" class="listPageTR">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;"><?php echo $res1['first_name']; ?> <?php echo $res1['last_name']; ?></td>
				<td class="text-left" style="width:100px;"><?php echo $res1['organization_name']; ?></td>
				<td class="text-left" style=""><?php echo $res1['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $res1['city']; ?></td>
				<td class="text-left" style=""><?php echo $res1['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $res1["id"]; ?>">
				<img src="data:<?php echo $res1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($res1['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $res1['contact_number']; ?></td>

				<td class="text-left" style=""><span style='color: #000; font-weight: bold;display: block; background:#76EA97;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Approved</span></td>

				<td class="text-center" style=""><a target="" href="userDetails.php?val=0<?php  if($res1['type_of_user']!='PCAdmin'){ echo "&id=".$res1['id']; }else{ echo "&id1=".$res1['id']; }?>" class="link">
				<i class="fa fa-chevron-circle-right fa-lg"></i></a></td>
				</tr>
				<tr><td class="listPageTRGap">&nbsp;</td></tr>
				<?php }} ?>
            </table>
        </div>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
									</div>
								</div>

</div>

<div class="panel" id="tab2">
<div>


<?php 


				if(empty($_GET["page1"]))
				{
					$_SESSION["page1"]=1;
				}
				else {
					$_SESSION["page1"]=$_GET["page1"];
				}
				if($_SESSION["page1"] < 0)
				{
					$_SESSION["page1"]=1;
				}

				if(isset($_REQUEST['user_type2']))
	      {
	      	if($_REQUEST['user_type2'] == "All"){
	      		$_SESSION['usertype2']=$_REQUEST['user_type2'];
	      		$Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
	      	}

					elseif($_REQUEST['user_type2']=="PCAdmin")
					{


							$_SESSION['usertype2']=$_REQUEST['user_type2'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$Pending = "select count(*) as total from admin_users WHERE is_approved='0' and type_of_user='".$_SESSION['usertype2']."'";
					}
	      	else{
	     $_SESSION['usertype2']=$_REQUEST['user_type2'];
	     $Pending = "select count(*) as total from user_login WHERE email_verified='0' AND type_of_user='".$_SESSION['usertype2']."'" ;
	 }
	      }
	   elseif(!empty($_SESSION['usertype2']))
	     {
	     	if ($_SESSION['usertype2'] =="All") {

	     		$Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
	     	}
				elseif($_SESSION['usertype2']=="PCAdmin")
				{
							$Pending = "select count(*) as total from admin_users WHERE is_approved='0' and type_of_user='".$_SESSION['usertype2']."'";
				}
	     	else{
	     $Pending = "select count(*) as total from user_login WHERE email_verified='0' AND type_of_user='".$_SESSION['usertype2']."'";
	 }
	      }
		 // echo "coming 2 ".$Pending;
				// elseif(empty($_SESSION['usertype2']))
				//  {
				//   $Pending = "select count(*) as total from user_login WHERE email_verified='0' ";
				// }


	if(isset($_REQUEST['user_name2']))
{
	$user2 = trim($_REQUEST['user_name2']);

// $new2 = explode(" ",$user2);
// $fname2 = $new2['0'];
// $lname2 = $new2['1'];

if($_SESSION['usertype2']!='PCAdmin')
{

	$Pending = "select count(*) as total from user_login WHERE type_of_user='Realtor' AND email_verified='0' AND (first_name like '%$user2%' or last_name like '%$user2%' or organization_name like '%$user2%') ";
}
else {
	$Pending = "select count(*) as total from admin_users WHERE type_of_user='PCAdmin' AND is_approved='0' AND (first_name like '%$user2%' or last_name like '%$user2%' or organization_name like '%$user2%') ";
}
}

if (empty($_SESSION['usertype2']) && @$_REQUEST['user_type2']=='') {

  $Pending="SELECT COUNT(first_name) as total FROM (SELECT first_name FROM `admin_users` where type_of_user='PCAdmin' and is_approved=0 UNION ALL SELECT first_name FROM `user_login` where type_of_user='Realtor' and email_verified=0) AS total;";

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
				$number_of_pages=50;

				// total number of user shown in database
				$total_no=$data1['total'];

				$Page_check=intval($total_no/$number_of_pages);
				$page_check1=$total_no%$number_of_pages;
				if($page_check1 == 0)
				;
				else{
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
     }

$Pending_data="SELECT * FROM user_login WHERE email_verified='0' and type_of_user='Realtor' order by id desc";
if(isset($_REQUEST['user_type2']))
{
$user_type=$_REQUEST['user_type2'];
if($_REQUEST['user_type2'] == "All"){

$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type2']=="PCAdmin")
{

			$Pending_data = "SELECT *FROM admin_users WHERE is_approved='0' AND type_of_user='".$_SESSION['usertype2']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
else{
$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' AND type_of_user='".$_SESSION['usertype2']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty($_SESSION['usertype2']))
{
	if ($_SESSION['usertype2'] =="All") {

		$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif($_SESSION['usertype2']=="PCAdmin")
	{

				$Pending_data = "SELECT *FROM admin_users WHERE is_approved='0' AND type_of_user='".$_SESSION['usertype2']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	else{
	$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' AND type_of_user='".$_SESSION['usertype2']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty($_SESSION['usertype2']))
//  {
// 	$Pending_data = "SELECT *FROM user_login WHERE email_verified='0' LIMIT " . $start_no_users . ',' . $number_of_pages;
// }


if(isset($_REQUEST['user_name2']))
{
	$userName2 = trim($_REQUEST['user_name2']);
// $new_2 = explode(" ",$userName2);
// $fname_2 = $new_2['0'];
// $lname_2 = $new_2['1'];


if($_SESSION['usertype2']!='PCAdmin')
{
	$Pending_data = "SELECT *FROM user_login WHERE type_of_user='Realtor' AND email_verified='0' AND (first_name like '%$userName2%' or last_name like '%$userName2%' or organization_name like '%$userName2%')  order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
	else {
		$Pending_data = "SELECT *FROM admin_users WHERE type_of_user='PCAdmin' AND is_approved='0' AND (first_name like '%$userName2%' or last_name like '%$userName2%' or organization_name like '%$userName2%') order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
}


if (empty($_SESSION['usertype2']) && @$_REQUEST['user_type2']=='') {
	// code...

	 $Pending_data = "SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,is_approved,registered_on FROM `admin_users` where type_of_user='PCAdmin' and is_approved=0 UNION ALL SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,email_verified as is_approved,registered_on FROM `user_login` where type_of_user='Realtor' AND email_verified=0 order by registered_on desc LIMIT " . $start_no_users . ',' . $number_of_pages;

}


?>
    
    <div class="row" style="margin-left: 0px;">
    	<div class="col-md-3">
    		<span >
				<form name="searchUser2" id="searchUser2" method="post" action="" onsubmit="return validate2()" style="margin-left:0px;">
				Search :
				 <input type="text"  list="Suggestions2" class="form-control form-value" id="user_name2" name="user_name2" value="" style="display:inline;width:150px;height: 30px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions2"  >
 <?php
 // if(empty($_SESSION['usertype2']))
 // {
 //
	//  $user_name2=mysqli_query($con,"select * from user_login where email_verified=0 order by id desc");
 // }
 if(!empty($_SESSION['usertype2']))
 {
 if($_SESSION['usertype2']!='PCAdmin')
 {
	 $user_name2=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and email_verified=0 order by id desc");
 }
 else
 {
	 $user_name2=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=0 order by id desc");
 }

							while($user_first_name=mysqli_fetch_assoc($user_name2))
							{
							?>

							<option value="<?php echo $user_first_name['first_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php } }?>

</datalist>
</form>
</span>
    	</div>
    	<div class="col-md-9" style="padding-right: 0px;">
    		
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

	<div class="" style="float:right">
		<form name="clear_pending_user_filter" method="post" action="">
		<input type="hidden" name="user_type2" value="<?php if(isset($_SESSION['usertype2'])){echo $_SESSION['usertype2'];} ?>" />
		<input type="submit" name="clear_pending_user_filter_btn " value="Clear Filter" class="btn btn-primary btn-sm adr-save" style="height:30px;font-size: 12px;color: #000;"/>
		</form>
		</div>

		<div class="" style="float:right;margin-right:10px;">
	<form name="search_filter2" method="post" action="users.php">
<select name="user_type2" class="form-control" id="user_type2" onchange="this.form.submit()" style="width:160px;left: 15px;height:30px;font-size: 12px;color: #000;">
				<option value="">Select a user type</option>
			
			    <option value="Realtor" <?php if(isset($_SESSION['usertype2']) && $_SESSION['usertype2']=='Realtor' ) { echo "selected"; } else { echo " "; }  ?>>Realtor</option>
			
					<option value="PCAdmin" <?php if(isset($_SESSION['usertype2']) && $_SESSION['usertype2']=='PCAdmin' ) { echo "selected"; } else { echo " "; }  ?>>PCAdmin</option>
		
  		</select>
		</form>
	</div>

    	</div>
    </div>

		
</div>

<div style="width:100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
					<table class="table-stripped" aria-busy="false" style="width: 100%;">
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><span class="text">

                                S.No

                        </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left"  style="width:100px;"><span class="text">

                                Name

                        </span>
						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text">

                                Organization

                        </span>


						<span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text">

                                Type

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

						<span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text">

                                Status

                        </span>

						<span class="icon fa "></span></th><th data-column-id="link-icon" class="text-center" style=""><span class="text">

                                Details

                        </span><span class="icon fa "></span></th></tr>
                </thead>
                <tbody>


    <?php
                   //	---------------------------------  pagination starts ---------------------------------------
if(!isset($_REQUEST['user_type2']) || @$_REQUEST['user_type2']==''){ ?>

	      		
<script>
 document.getElementById('searchUser2').style.display = "none";
</script>


<?php

// unset($_SESSION['usertype1']);

if (isset($_REQUEST['user_name2'])) {

?>

<script>
 document.getElementById('searchUser2').style.display = "block";
</script>

<?php }

	      	}
                   //	---------------------------------  pagination starts ---------------------------------------
				 


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
				<tr data-row-id="0" class="listPageTR">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;"><?php echo $pending_data2['first_name']; ?> <?php echo $pending_data2['last_name']; ?></td>
				<td class="text-left" style="width:100px;"><?php echo $pending_data2['organization_name']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['city']; ?></td>
				<td class="text-left" style=""><?php echo $pending_data2['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $pending_data2["id"]; ?>">
				<img src="data:<?php echo $pending_data2['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($pending_data2['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $pending_data2['contact_number']; ?></td>


				<td class="text-left" style=""><span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Pending</span></td>

				<td class="text-center" style=""><a target="" href="userDetails.php?val=0<?php  if($pending_data2['type_of_user']!='PCAdmin'){ echo "&id=".$pending_data2['id']; }else{ echo "&id1=".$pending_data2['id']; }?>" class="link">
				<i class="fa fa-chevron-circle-right fa-lg"></i></a></td>
				</tr>
				<tr><td class="listPageTRGap">&nbsp;</td></tr>  
				<?php } }?>

            </table>
        </div>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page1=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page1=".($_SESSION["page1"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page1"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page1=".($_SESSION["page1"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page1=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
									</div>
								</div>

</div>


<div class="panel" id="tab3">
<div style="width:100%">

	<?php

 

				if(empty($_GET["page2"]))
				{
					$_SESSION["page2"]=1;
				}
				else {
					$_SESSION["page2"]=$_GET["page2"];
				}
				if($_SESSION["page2"] < 0)
				{
					$_SESSION["page2"]=1;
				}
				if(isset($_REQUEST['user_type3']))
	      {
	      	if($_REQUEST['user_type3'] == "All"){
	      		$_SESSION['usertype3']=$_REQUEST['user_type3'];
	      		$denied = "select count(*) as total from user_login WHERE email_verified='2' ";
	      	}
					elseif($_REQUEST['user_type3']=="PCAdmin")
					{


							$_SESSION['usertype3']=$_REQUEST['user_type3'];
							// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
								$denied = "select count(*) as total from admin_users WHERE is_approved='2' and type_of_user='".$_SESSION['usertype3']."'";
					}
	      	else{
	     $_SESSION['usertype3']=$_REQUEST['user_type3'];
	     $denied = "select count(*) as total from user_login WHERE email_verified='2' AND type_of_user='".$_SESSION['usertype3']."'" ;
	 }
	      }
	   elseif(!empty($_SESSION['usertype3']))
	     {
	     	if ($_SESSION['usertype3'] =="All") {

	     		$denied = "select count(*) as total from user_login WHERE email_verified='2' ";
	     	}
				elseif($_SESSION['usertype3'] =="PCAdmin")
				{



						// echo "select count(*) as total from admin_users WHERE is_approved='1' type_of_user='PCAdmin';
							$denied = "select count(*) as total from admin_users WHERE is_approved='2' and type_of_user='".$_SESSION['usertype3']."'";
				}
	     	else{
	     $denied = "select count(*) as total from user_login WHERE email_verified='2' AND type_of_user='".$_SESSION['usertype3']."'";
	      }
	  }
				// elseif(empty($_SESSION['usertype3']))
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
	$user3 = trim($_REQUEST['user_name3']);



// $new3 = explode(" ",$user3);
// $fname3 = $new3['0'];
// $lname3 = $new3['1'];

if($_SESSION['usertype3']!='PCAdmin')
{

	$denied = "select count(*) as total from user_login WHERE type_of_user='Realtor' AND email_verified='2' AND (first_name like '%$user3%' or last_name like '%$user3%' or organization_name like '%$user3%') ";
}
else {
	$denied = "select count(*) as total from admin_users WHERE type_of_user='PCAdmin' AND is_approved='2' AND (first_name like '%$user3%' or last_name like '%$user3%' or organization_name like '%$user3%') ";
}
}

if (empty($_SESSION['usertype3']) && @$_REQUEST['user_type3']=='') {

$denied = "SELECT COUNT(first_name) as total FROM (SELECT first_name FROM `admin_users` where type_of_user='PCAdmin' and is_approved=2 UNION ALL SELECT first_name FROM `user_login` where type_of_user='Realtor' and email_verified=2) AS total;";

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
				$number_of_pages=50;

				// total number of user shown in database
				$total_no=$data2['total'];

				$Page_check=intval($total_no/$number_of_pages);
				$page_check1=$total_no%$number_of_pages;
				if($page_check1 == 0)
				;
				else{
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
     }

	$denied_data = "SELECT *FROM admin_users WHERE is_approved='2' AND type_of_user='PCAdmin' LIMIT " . $start_no_users . ',' . $number_of_pages;
	// $denied_data="";

if(isset($_REQUEST['user_type3']))
{
$user_type=$_REQUEST['user_type3'];
if($_REQUEST['user_type3'] == "All"){

$denied_data = "SELECT *FROM user_login WHERE email_verified='2' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;

}
elseif($_REQUEST['user_type3']=="PCAdmin")
{

		$q = "SELECT *FROM admin_users WHERE is_approved='2' AND type_of_user='".$_SESSION['usertype3']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
else{

$denied_data = "SELECT *FROM user_login WHERE email_verified='2' AND type_of_user='".$_SESSION['usertype3']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
elseif(!empty($_SESSION['usertype3']))
{

	if ($_SESSION['usertype3'] =="All") {

		$denied_data = "SELECT *FROM user_login WHERE email_verified='2' LIMIT " . $start_no_users . ',' . $number_of_pages;
	}
	elseif($_SESSION['usertype3']=="PCAdmin")
	{

				$denied_data = "SELECT *FROM admin_users WHERE is_approved='2' AND type_of_user='".$_SESSION['usertype3']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
	}

	else{

	$denied_data = "SELECT *FROM user_login WHERE email_verified='2' AND type_of_user='".$_SESSION['usertype3']."' order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
}
// elseif(empty($_SESSION['usertype3']))
//  {
// 	$denied_data = "SELECT *FROM user_login WHERE email_verified='2' and type_od_user LIMIT " . $start_no_users . ',' . $number_of_pages;
// }

//echo $denied_data;

if(isset($_REQUEST['user_name3']))
{
	$userName3 = trim($_REQUEST['user_name3']);
// $new_3 = explode(" ",$userName3);
// $fname_3 = $new_3['0'];
// $lname_3 = $new_3['1'];


if($_SESSION['usertype3']!='PCAdmin')
{

	$denied_data = "SELECT *FROM user_login WHERE type_of_user='Realtor' AND email_verified='2' AND (first_name like '%$userName3%' or last_name like '%$userName3%' or organization_name like '%$userName3%')  order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
}
	else {

		$denied_data = "SELECT *FROM admin_users WHERE type_of_user='PCAdmin' AND is_approved='2' AND (first_name like '%$userName3%' or last_name like '%$userName3%' or organization_name like '%$userName3%') order by id desc LIMIT " . $start_no_users . ',' . $number_of_pages;
	}

}

if (empty($_SESSION['usertype3']) && @$_REQUEST['user_type3']=='') {
	// code...

	 $denied_data = "SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,is_approved,registered_on FROM `admin_users` where type_of_user='PCAdmin' and is_approved=2 UNION ALL SELECT id,first_name,last_name,organization_name,type_of_user,city,state,profile_pic_image_type,profile_pic,contact_number,email_verified as is_approved,registered_on FROM `user_login` where type_of_user='Realtor' AND email_verified=2 order by registered_on desc LIMIT " . $start_no_users . ',' . $number_of_pages;

}

	 ?>
        <div class="row" style="margin-left: 0px;">
        	<dic class="col-md-3">
        		<span style="">
				<form name="searchUser3" id="searchUser3" method="post" action="" onsubmit="return validate3()" style="margin-left:0px;">
				Search :
				 <input type="text"  list="Suggestions3" class="form-control form-value" id="user_name3" name="user_name3" value="" style="display:inline;width:150px;height:30px;" />
 <button type="submit" style="padding:2px!important;background:white;border:none;"><i class="fa fa-search" style="color:#006600"></i></button>

 <datalist id="Suggestions3"  >
 <?php
 // if(empty($_SESSION['usertype3']))
 // {

	//  $user_name3=mysqli_query($con,"select * from user_login where email_verified=2 order by id desc");
 // }
 if(!empty($_SESSION['usertype3']))
 {
 if($_SESSION['usertype3']!='PCAdmin')
 {
	 $user_name3=mysqli_query($con,"select * from user_login  where type_of_user='Realtor' and email_verified=2 order by id desc");
 }
 else
 {
	 $user_name3=mysqli_query($con,"select * from admin_users where type_of_user='PCAdmin' AND is_approved=2 order by id desc");
 }

							while($user_first_name=mysqli_fetch_assoc($user_name3))
							{
							?>


							<option value="<?php echo $user_first_name['first_name']; ?>"><?php echo $user_first_name['first_name'].' '.$user_first_name['last_name'];  ?></option>

							<?php }} ?>
</datalist>
</form>
</span>
        	</dic>
        	<div class="col-md-9" style="padding-right: 0px;">
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

	<div class="" style="float:right;">
		<form name="clear_blocked_user_filter" method="post" action="">
		<input type="hidden" name="user_type3" value="<?php if(isset($_SESSION['usertype3'])){echo $_SESSION['usertype3'];} ?>" />
		<input type="submit" name="clear_blocked_user_filter_btn " value="Clear Filter" class="btn btn-primary btn-sm adr-save" style="height:30px;font-size: 12px;color: #000;" />
		</form>
		</div>

		<div class="" style="float:right;margin-right: 10px;">
		<form name="search_filter3" method="post" action="users.php">
<select name="user_type3" class="form-control" id="user_type3" onchange="this.form.submit()" style="width:160px;left: 15px;;height:30px;font-size: 12px;color: #000;">
				<option value="">Select a user type</option>
			
			    <option value="Realtor" <?php if(isset($_SESSION['usertype3']) && $_SESSION['usertype3']=='Realtor' ) { echo "selected"; } else { echo " "; }  ?>>Realtor</option>
			
					<option value="PCAdmin" <?php if(isset($_SESSION['usertype3']) && $_SESSION['usertype3']=='PCAdmin' ) { echo "selected"; } else { echo " "; }  ?>>PCAdmin</option>
		
  		</select>
		</form>
	</div>

        	</div>
        </div>
		

</div>

<div style="width: 100%;scrollbar-width: none;overflow-x: scroll;overflow-y:hidden">
					<table class="table-stripped" aria-busy="false" style="width: 100%;" >
                <thead>
                    <tr><th data-column-id="id" class="text-left" style=""><span class="text">

                                S.No

                        </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left"  style="width:100px;"><span class="text">

                                Name

                        </span>
						<span class="icon fa "></span></th><th data-column-id="logo" class="text-left"><span class="text">

                                Organization

                        </span>


						<span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text">

                                Type

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

						<span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text">

                                Status

                        </span>

						<span class="icon fa "></span></th><th data-column-id="link-icon" class="text-center" style=""><span class="text">

                                Details

                        </span><span class="icon fa "></span></th></tr>
                </thead>
                <tbody>
				
    <?php
                   //	---------------------------------  pagination starts ---------------------------------------
if(!isset($_REQUEST['user_type3']) || @$_REQUEST['user_type3']==''){ ?>

	      		
<script>
 document.getElementById('searchUser3').style.display = "none";
</script>


<?php

// unset($_SESSION['usertype1']);

if (isset($_REQUEST['user_name3'])) {

?>

<script>
 document.getElementById('searchUser3').style.display = "block";
</script>

<?php }

	      	}
				  


				$denied_data1=mysqli_query($con,@$denied_data);
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
				<tr data-row-id="0" class="listPageTR">
				<td class="text-left" style=""><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
				<td class="text-left" style="width:100px;"><?php echo $denied_data2['first_name']; ?> <?php echo $denied_data2['last_name']; ?></td>
				<td class="text-left" style="width:100px;"><?php echo $denied_data2['organization_name']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['type_of_user']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['city']; ?></td>
				<td class="text-left" style=""><?php echo $denied_data2['state']; ?></td>
				<td class="text-left" style=""><a class="lightbox" href="imageView.php?image_id=<?php echo $denied_data2["id"]; ?>">
				<img src="data:<?php echo $denied_data2['profile_pic_image_type']; ?>;base64,<?php echo base64_encode($denied_data2['profile_pic']); ?>" width="50" height="50" /></td>

				<td class="text-left" style=""><?php echo $denied_data2['contact_number']; ?></td>

				<td class="text-left" style=""><span style='color: #000; font-weight: bold;display: block; background:#F58883;padding-top: 5px; max-width: 200px;padding-bottom: 5px;text-align: center;'>Blocked</span></td>

				<td class="text-center" style=""><a target="" href="userDetails.php?val=0<?php  if($denied_data2['type_of_user']!='PCAdmin'){ echo "&id=".$denied_data2['id']; }else{ echo "&id1=".$denied_data2['id']; }?>" class="link">
				<i class="fa fa-chevron-circle-right fa-lg"></i></a></td>
				</tr>
				<tr><td class="listPageTRGap">&nbsp;</td></tr>
				<?php }} ?>
            </table>
        </div>




			<div id="undefined-footer" class="bootgrid-footer container-fluid">
				<div class="row">
					<div class="col-sm-6"><ul class="pagination"><li class="first disabled" aria-disabled="true"><a href="./users.php?page2=1" class="button">«</a></li><li class="prev disabled" aria-disabled="true">
						<a href="<?php echo "./users.php?page2=".($_SESSION["page2"]-1);?>" class="button">&lt;</a></li><li class="page-1 active" aria-disabled="false" aria-selected="true">
							<a href="#1" class="button"><?php echo $_SESSION["page2"]; ?></a></li><li class="next disabled" aria-disabled="true">
								<a href="<?php echo "./users.php?page2=".($_SESSION["page2"]+1);?>" class="button">&gt;</a></li><li class="last disabled" aria-disabled="true">
									<a href="<?php echo "./users.php?page2=".($Page_check);?>" class="button">»</a></li></ul></div><div class="col-sm-6 infoBar">
										<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">  to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries">  entries</span></p></div></div>
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




		<?php include "footer.php";  ?>
