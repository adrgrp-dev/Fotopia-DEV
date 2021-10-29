<?php 
include "../project-environment.php";



$page="index.php";
 if(isset($_SESSION['admin_loggedin_id']))
{
$type=$_SESSION['admin_loggedin_type'];

if($type=="FotopiaAdmin")
{
 $page="dashboard.php";
}
if($type=="PCAdmin")
{
		$id=$_SESSION['admin_loggedin_id'];
		$pc_profile=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$id'");
		$pc_profile1=mysqli_fetch_array($pc_profile);
		$aboutPC=$pc_profile1['about_us'];
		
		$products=mysqli_query($con,"select * from products where pc_admin_id='$id'");
		$productsFound=mysqli_num_rows($products);
		
		if($aboutPC=='' && !@$_REQUEST['first']) { header("location:edit_company_profile.php?first=1"); exit; }
		if($productsFound==0 && !@$_REQUEST['first']) { header("location:products.php?first=1"); exit; }  
		



$page="PCAdmin_dashboard.php";
}
if($type=="CSR")
{
$page="subcsr_dashboard.php";
}
}





?>

<!DOCTYPE html>
<!--[if lt IE 10]> <html  lang="en" class="iex"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title id="label_administration" adr_trans="label_administration" >Administration</title>
    <meta name="description" content="About page with company informations.">
    <script src="../scripts/jquery.min.js"></script>

    <link rel="stylesheet" href="../scripts/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../scripts/font-awesome/css/font-awesome.css">
    <script src="../scripts/script.js"></script>
    <link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="../css/content-box.css">
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/image-box.css">
    <link rel="stylesheet" href="../css/animations.css">
     <link rel="icon" href="../images/favicon.png">
	  <link rel="stylesheet" href="../scripts/magnific-popup.css">
	 <link rel="stylesheet" href="../scripts/jquery.flipster.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
    <!-- Extra optional content header -->
  <style>
  .adr-save
	{
	background:#000!important;
	color:#FFF!important;
	border-color:#000!important;
	}
	.adr-cancel
	{
	/*background:#5cb85c!important;
	border-color:#5cb85c!important;*/
	background:#000!important;
	border-color:#000!important;
	color:#FFF!important;
	}
  .adr-success
	{
background:#000!important;
	border-color:#000!important;
	color:#FFF!important;
	}
	.row
	{
	width:100%;
	}
	.fc-today-button,.fc-button
{
border-radius:25px!important;
}
</style>
	<script>
function validate_email(val)
{
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {
        var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
	$("#Email_exist_error").html("E-posten er allerede i bruk, vennligst velg en annen e-post og fortsett");
		}
		else
		{
		$("#Email_exist_error").html("Email already in use, please choose different email and continue");
		}
	   $(".error_box").show();
	   $("#email").val("");
	    $("#email").focus();
     }
     else
     {
      $("#Email_exist_error").html();
	  $(".error_box").hide();
     }
    }
  };
  xhttp.open("GET","validate_email.php?id="+val,true);
  xhttp.send();
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script>
var lang1="";
var loadfile="";
function changeLanguage(lang1)
{
//alert(lang);

setLanguage(lang1);

//var lang=lang1;
if(lang1=="en")
{
loadfile="../en.json";
}
else
{
loadfile="../no.json";
}
var data="";


$.ajax({
    type: "Get",
    url: loadfile,
    dataType: "json",
    success: function(data) {



$("td[adr_trans],div[adr_trans],p[adr_trans],span[adr_trans],adr_trans,button[adr_trans],a[adr_trans],h3[adr_trans],h4[adr_trans],h5[adr_trans]").each(function(){
		// alert($(this).attr("id"));
		// var idIs=$(this).attr("id");

   // $("#"+idIs).html(data[idIs]);

   var idIs=$(this).attr("adr_trans");
//var idIs=$(this).attr("id");




var htmlIs=$('[adr_trans="'+idIs+'"]').html();

if(htmlIs.indexOf("fa fa")!=-1)
{
//alert("coming");
var splitIs=htmlIs.split("</i>");

var actualFA=splitIs[0]+"</i>";
//alert(actualFA);
$('[adr_trans="'+idIs+'"]').html(actualFA+data[idIs]);
}
else
{
$('[adr_trans="'+idIs+'"]').html(data[idIs]);
}


});

},
    error: function(){
        //alert("json not found");
    }
});





}

var langval="";
  function setLanguage(langval)
{
//alert(langval);
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){

    }
  };
  xhttp.open("POST","../set_language.php?lang="+langval,true);
  xhttp.send();
}

</script>
</head>
<body class="home">
    <div id="preloader"></div>

<!-- For laptop, desktop and other larger devices header code below -->

    <header data-menu-anima="fade-left" class="hidden-sm hidden-xs">

        <div class="navbar navbar-default over" role="navigation">

            <div class="navbar navbar-main over">

              <div class="row">
<div class="col-md-5">
                     <div class="col-md-3 hidden-xs hidden-sm" style="margin-left:20px;">
                      <a class="navbar-brand" href="<?php echo $page; ?>"><img src="../images/logo-1.png" alt="logo" style="margin-top:-4px;">
          <span style="display:inline;font-size:14px;color:#FFFFFF"><span style="color:#00A8F3;font-size:18px;">f</span>otopia</span></a>
                  </div>

				   <div class="col-md-3 hidden-md hidden-lg hidden-xl" style="margin-left:20px;">
                      <a class="navbar-brand" href="<?php echo $page; ?>"><img src="../images/logo-1.png" alt="logo" style="margin-top:-4px;width:40px;height:30px;">
          <span style="display:inline;font-size:14px;color:#FFFFFF"><span style="color:#00A8F3;font-size:18px;">f</span>otopia</span></a>
                  </div>

</div>
         <div class="col-md-4">
       <p style="font-weight:bold;margin-top:20px;color:white;float:left;display:inline-table;"><span adr_trans="label_photo_app_admin" style="color:white">Photography App - Adminstration</span></p>


</div>

<div class="col-md-3">

<!-- start -->
<div class="col-md-3">

   </div>


<div class="col-md-12">
<?php


$detailsOdUser="";
$detailsOdUser1="";
	$loggedINID=$_SESSION['admin_loggedin_id'];
		$loggedin_name=$_SESSION['admin_loggedin_name'];

		if($_SESSION['admin_loggedin_type']=='PCAdmin')
		{
		$detailsOdUser=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedINID'");
$detailsOdUser1=mysqli_fetch_array($detailsOdUser);

$pc_admin_profile=mysqli_query($con,"select * from admin_users where id='$loggedINID'");
$pc_admin_profile1=mysqli_fetch_array($pc_admin_profile);

}
if($_SESSION['admin_loggedin_type']=='CSR')
{
$detailsOdUser=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id='$loggedINID')");
$detailsOdUser1=mysqli_fetch_array($detailsOdUser);
}

						?>

<?php
       if(isset($_SESSION['admin_loggedin_email']))
       {
           $loggedin_name=$_SESSION['admin_loggedin_name'];
                     ?>


                               <ul class="nav navbar-nav" style="display:inline-block;float:right;">
                                   <li class="dropdown current-active">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Hi <?php echo substr($loggedin_name,0,6)."..."; ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu">
        <li><a href="change_email_password.php"><i class="fa fa-key" style="padding-right:10px;"></i><span adr_trans="label_my_account">My Account</span></a></li>
  <li><a href="cms.php?id=1"><i class="fa fa-camera-retro" style="padding-right:10px;"></i>About Fotopia</a></li>
				  <li><a href="cms.php?id=3"><i class="fa fa-question" style="padding-right:10px;"></i>FAQ</a></li>
				  <li><a href="cms.php?id=4"><i class="fa fa-envelope-o" style="padding-right:10px;"></i>Help & Support</a></li>
				  <li><a href="cms.php?id=2"><i class="fa fa-check-square-o" style="padding-right:10px;"></i>Terms & Conditions</a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out" style="padding-right:10px;"></i><span adr_trans="label_logout">Logout</span></a></li>
                                       </ul>
                                  </li>


		<?php
  $countIs=0;

$loggedin_id=$_SESSION['admin_loggedin_id'];

 $count_query="select count(*) as total from user_actions";
                  $count_result=mysqli_query($con,$count_query);
          $data=mysqli_fetch_assoc($count_result);
                  $countIs=$data['total'];


  ?>

<?php

if($_SESSION['admin_loggedin_type'] == 'PCAdmin')
{
?>

      <a href="pc_admin_activity.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>
<?php }
elseif ($_SESSION['admin_loggedin_type'] == 'CSR') { ?>
  <a href="csr_activity.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>
<?php }

else { ?>


      <a href="notification.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>

<?php } ?>

<?php if($_SESSION['admin_loggedin_type']=='FotopiaAdmin') 
{
?>

<img src="../logo.png" width="50" height="50" style="border-radius:60px;margin-left:5px;margin-top:10px; display:inline-block" />
<?php } else { ?>


				<img src="data:<?php echo @$pc_admin_profile1['profile_pic_image_type']; ?>;base64,<?php echo base64_encode(@$pc_admin_profile1['profile_pic']); ?>" width="50" height="50" style="border-radius:60px;margin-left:5px;margin-top:10px; display:inline-block" />

<?php } ?>




	<select class="selectpicker sss" data-width="fit" onChange="changeLanguage(this.value)">
			 <option  data-content='<span class="flag-icon flag-icon-us"></span> US' value='en' <?php if($_SESSION['Selected_Language_Session']=='en') { echo "selected"; } ?>>English</option>
    <option data-content='<span class="flag-icon flag-icon-no"></span> NO' value='no' <?php if($_SESSION['Selected_Language_Session']=='no') { echo "selected"; } ?>>Norwegian</option>
</select>
<input type="hidden" name="Selected_Language" id="Selected_Language" value="en" />

<script>
$(function(){
  $('.selectpicker').selectpicker();
   $('.dropdown-toggle').removeClass("btn btn-default");
  $('.selectpicker.dropdown-toggle').attr("style","border-radius:8px;background:#000;border:none;margin-left:10px;margin-top:20px;");


});
</script>


	</ul>


<?php } ?>



</div>





<!-- end -->
</div>






</div>
</div>

</div>

    </header>






<!-- For mobile, tablet and other small devices header code below -->
<header data-menu-anima="fade-left" class="hidden-xl hidden-md hidden-lg">
        <div class="navbar navbar-default over" role="navigation">

            <div class="navbar navbar-main over">

              <div class="row">
			  <div class="col-sm-12">
<div class="col-sm-2">


				   <div class="col-md-3 hidden-md hidden-lg hidden-xl" style="margin-left:20px;">
                      <a class="navbar-brand" href="<?php echo $page; ?>"><img src="../images/logo-1.png" alt="logo" style="margin-top:-4px;width:40px;height:30px;">
          <span style="display:inline;font-size:14px;color:#FFFFFF"><span style="color:#00A8F3;font-size:18px;">f</span>otopia</span></a>
                  </div>

</div>


<!-- start -->
<div class="col-sm-2">

   </div>


<div class="col-sm-4" style="float:left;margin-right:0px;width:100px;margin-left:-10px;">

<?php

           $loggedin_name=$_SESSION['admin_loggedin_name'];
                     ?>


                               <ul class="nav navbar-nav" style="display:inline-block">
                                   <li class="dropdown current-active">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Hi <?php echo substr($loggedin_name,0,5).".."; ?> <span class="caret"></span>  </a>
                           <ul class="dropdown-menu">
        <li><a href="change_email_password.php"><i class="fa fa-key" style="padding-right:0px;"></i><span adr_trans="label_my_account">My Account</span></a></li>
  <li><a href="cms.php?id=1"><i class="fa fa-camera-retro" style="padding-right:10px;"></i>About Fotopia</a></li>
				  <li><a href="cms.php?id=3"><i class="fa fa-question" style="padding-right:10px;"></i>FAQ</a></li>
				  <li><a href="cms.php?id=4"><i class="fa fa-envelope-o" style="padding-right:10px;"></i>Help & Support</a></li>
				  <li><a href="cms.php?id=2"><i class="fa fa-check-square-o" style="padding-right:10px;"></i>Terms & Conditions</a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out" style="padding-right:0px;"></i><span adr_trans="label_logout">Logout</span></a></li>
                                       </ul>
                               </li>

							   	</ul>

								<?php

  $countIs=0;

$loggedin_id=$_SESSION['admin_loggedin_id'];

 $count_query="select count(*) as total from user_actions";
                  $count_result=mysqli_query($con,$count_query);
          $data=mysqli_fetch_assoc($count_result);
                  $countIs=$data['total'];


  ?>



  <?php

if($_SESSION['admin_loggedin_type'] == 'PCAdmin')
{
?>

      <a href="pc_admin_activity.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>

<?php }
elseif ($_SESSION['admin_loggedin_type'] == 'CSR') { ?>
  <a href="csr_activity.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>
<?php }
else { ?>

   <a href="notification.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-left:5px;"  aria-hidden="true"></i>
</a>

<?php } ?>

</div>
<?php if($_SESSION['admin_loggedin_type']=='FotopiaAdmin') 
{
?>

<img src="../logo.png" width="50" height="50" style="border-radius:60px;margin-left:5px;margin-top:10px; display:inline-block" />
<?php } else { ?>


			<img src="data:<?php echo @$detailsOdUser1['logo_image_type']; ?>;base64,<?php echo base64_encode(@$detailsOdUser1['logo']); ?>" width="50" height="50" style="border-radius:60px;margin-left:-5px;margin-top:0px; display:inline-block" />
<?php } ?>

	


		   <a href="notification.php" >
<i class="fa fa-bell fa-1x" style="color:#FFF;margin-right:5px;margin-top:15px;"  aria-hidden="true"></i>
</a>		   <select class="selectpicker sss" data-width="fit" onChange="changeLanguage(this.value)">
			 <option  data-content='<span class="flag-icon flag-icon-us"></span> US' value='en' <?php if($_SESSION['Selected_Language_Session']=='en') { echo "selected"; } ?>>English</option>
    <option data-content='<span class="flag-icon flag-icon-no"></span> NO' value='no' <?php if($_SESSION['Selected_Language_Session']=='no') { echo "selected"; } ?>>Norwegian</option>
</select>
<input type="hidden" name="Selected_Language" id="Selected_Language" value="en" />

<script>
$(function(){
  $('.selectpicker').selectpicker();
   $('.bootstrap-select').attr("style","margin-right:-30px;float:right");
   $('.dropdown-toggle').removeClass("btn btn-default");
  $('.selectpicker.dropdown-toggle').attr("style","margin-top:20px;border-radius:8px;background:#000;border:none;margin-left:5px;float:right");


});
</script>




<div class="col-sm-2" style="float:right;margin-top:0px;">
<ul class="nav navbar-nav" style="margin-left:-13px;">
<li class="dropdown current-active">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="float:right;margin-right:5px;"><i class="fa fa-bars"></i></span></a>
                           <ul class="dropdown-menu" style="top:30px;position:absolute;background-color:#000000;color:white;right:70px;">


<?php

 if($_SESSION['admin_loggedin_type']=="CSR")
    {
?>
<li><a href="subcsr_dashboard.php"><i class="fa fa-home" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_home">Home</span></a></li>
<li><a  href="CSR_Calendar.php"><i class="fa fa-calendar" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_calendar">Calendar</span></a></li>
<li><a href="subcsrOrder_list1.php"><i class="fa fa-stack-exchange" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_order">Orders</span></a></li>
<li><a href=""><i class="fa fa-stack-exchange" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_order_reports">Order reports</span></a></li>
<li><a  href="csr_activity.php"><i class="fa fa-bell" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_notification">Notification</span></a></li>
<li><a  href="csr_products.php"><i class="fa fa-list" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_products">Products</span></a></li>
<li><a href="csr_profile.php"><i class="fa fa-user" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_my_profile">My profile</span></a></li>


<?php } ?>

<?php

 if($_SESSION['admin_loggedin_type']=="PCAdmin")
    {
?>
<li><a href="PCAdmin_dashboard.php"><i class="fa fa-home" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_home">Home</span></a></li>
<li><a href="PCAdmin_Calender.php"><i class="fa fa-calendar" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_calendar">Calendar</span></a></li>
<li><a href="superorder_list1.php"><i class="fa fa-stack-exchange" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_order">Order</span></a></li>
<li><a href="order_reports.php"><i class="fa fa-stack-exchange" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_order_reports">Order reports</span></a></li>
<li><a href="pc_admin_activity.php"><i class="fa fa-bell" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_notification">Notification</span></a></li>
<li><a href="client.php"><i class="fa fa-user-secret" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_clients">Clients</span></a></li>
<li><a href="products.php"><i class="fa fa-list" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_products">Products</span></a></li>
<li><a href="csr_list1.php"><i class="fa fa-users" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_users">Users</span></span></a></li>
<li><a href="company_profile.php"><i class="fa fa-user" style="padding-right:10px;margin-left:-15px"></i><span adr_trans="label_company_profile">Company profile</span></a></li>


<?php } ?>

<?php

 if($_SESSION['admin_loggedin_type']=="FotopiaAdmin")
    {
?>
<li><a href="dashboard.php"><i class="fa fa-home" style="padding-right:10px;"></i><span adr_trans="label_home">Home</span></a></li>
<li><a href="users.php"><i class="fa fa-users" style="padding-right:10px;"></i><span adr_trans="label_users">Users</span></a></li>
<li><a href="notification.php"><i class="fa fa-bell" style="padding-right:10px;"></i><span adr_trans="label_notification">Notification</span></a></li>
<li><a  href=""><i class="fa fa-line-chart" style="padding-right:10px;"></i><span adr_trans="label_statistics">Statistics</span></a></li>
<li><a  href="admin_users.php"><i class="fa fa-user-secret" style="padding-right:10px;"></i><span adr_trans="label_admin_users">Admin users</span></a></li>
<li><a  href="csr_list.php"><i class="fa fa-user" style="padding-right:10px;"></i><span adr_trans="label_csr">CSR</span></a></li>
<li><a  href="order_reports.php"><i class="fa fa-stack-exchange" style="padding-right:10px;"></i><span adr_trans="label_reports">Reports</span></a></li>

<?php } ?>





                                       </ul>
                                  </li>
								</ul>

</div>


	</div>







<!-- end -->
</div>






</div>
</div>

</div>

    </header>
