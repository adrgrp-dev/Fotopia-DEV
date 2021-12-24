<?php
include "project-environment.php";

 $page="index.php";
 if(isset($_SESSION['loggedin_id']))
{
$type=$_SESSION['user_type'];

if($type=="Realtor")
{
 $page="csrRealtorDashboard.php";
}
if($type=="Photographer")
{
$page="photographerDashboard.php";
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
    <title>Photography App</title>
    <meta name="description" content="About page with company informations.">
    <script src="scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="scripts/bootstrap/css/bootstrap.css">
    <script src="scripts/script.js"></script>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="css/content-box.css">
	 <link rel="stylesheet" href="css/image-box.css">
	  <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href='scripts/magnific-popup.css'>
	 <link rel="stylesheet" href="scripts/jquery.flipster.min.css">




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
loadfile="en.json";
}
else
{
loadfile="no.json";
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

   var idIs=$(this).attr("id");

var htmlIs=$("#"+idIs).html();

if(htmlIs.indexOf("fa fa")!=-1)
{
//alert("coming");
var splitIs=htmlIs.split("</i>");

var actualFA=splitIs[0]+"</i>";
//alert(actualFA);
$("#"+idIs).html(actualFA+data[idIs]);
}
else
{
$("#"+idIs).html(data[idIs]);
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
  xhttp.open("POST","set_language.php?lang="+langval,true);
  xhttp.send();
}

</script>

    <style>
	.adr-save
	{
	background:#0275d8!important;
	border-color:#0275d8!important;
	}
	.adr-cancel
	{
	/*background:#5cb85c!important;
	border-color:#5cb85c!important;*/
	background:#f0ad4e!important;
	border-color:#f0ad4e!important;
	}
  .adr-success
	{
	/*background:#5cb85c!important;
	border-color:#5cb85c!important;*/
	background:#6cc070!important;
	border-color:#6cc070!important;
	}
.caret
{

}

 .btn-default
{

border:none;
padding-top:20px;
background:#1D1E1F!important;
}
/*.navbar {
    -webkit-box-shadow: 0 8px 6px -6px #999;
    -moz-box-shadow: 0 8px 6px -6px #999;
    box-shadow: 0 8px 6px -6px #999;

} */
.td,.th
{
width:fit-content;
max-width:150px;
word-break:break-all;
}
	</style>

<script>
var calid;
function calDetails(calid)
{
$("#dayVal").val(calid);

}
</script>
     <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <!-- Extra optional content header -->
</head>
<input type="hidden" name="dayVal" id="dayval" value="">
<body class="home">
    <div id="preloader"></div><header data-menu-anima="fade-left">
        <div class="navbar navbar-default over wide-area" role="navigation">
            <div class="navbar navbar-main over">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                <a class="navbar-brand" href="<?php echo $page; ?>" style="padding-left:30px;"><img src="images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-6px;width:65px;height:60px">
						       <span style="display:inline;font-size:13px;color:#FFFFFF;margin-left:-4px"><span style="color:#00A8F3;font-size:18px;">f</span>otopia</span></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav over mega-menu-fullwidth">
                          <?php

						  if(!isset($_SESSION['loggedin_id']))
							{

						  ?>

						    <li class="dropdown current-active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" adr_trans="">Home <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $page; ?>">Home</a></li>


                                </ul>
                            </li>


							 <li class="dropdown current-active">
                                <a href="about.php" class="dropdown-toggle" data-toggle="dropdown" role="button">About Us <span class="caret"></span></a>

                            </li>

                            <li class="dropdown">
                                <a href="overview.php" class="dropdown-toggle" data-toggle="dropdown" role="button">Overview <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="gallery-grid.html">overview 1</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="keyfeatures.php">Key Features <span class="caret"></span></a>
                                <div class="mega-menu dropdown-menu multi-level row bg-menu" style="background-image:url(images/menu-bg.jpg);">
                                    <div class="col">
                                        <h5>Portfolio 1</h5>
                                        <ul class="fa-ul text-s">
                                            <li><i class="fa-li fa fa-desktop"></i><a href="portfolio-1-gutted-boxed.html">Gutted boxed</a></li>
                                            <li><i class="fa-li fa fa-desktop"></i><a href="portfolio-1-gutted-full-width.html">Gutted full width</a></li>
                                        </ul>

                                    </div>

                                </div>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="testimonial.php">Testimonial <span class="caret"></span></a>
                                <div class="mega-menu dropdown-menu multi-level row bg-menu" style="background-image:url(images/menu-bg.jpg)">
                                    <div class="col">
                                        <ul class="fa-ul text-s">
                                            <li><i class="fa-li fa fa-newspaper-o"></i><a href="blog-1.html">Blog 1</a></li>
                                            <li><i class="fa-li fa fa-newspaper-o"></i><a href="blog-2.html">Blog 2</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Contacts <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="contacts-1.html">Contacts 1</a></li>

                                </ul>
                            </li>
							<?php } ?>
                        </ul>
                       <div class="nav navbar-nav navbar-right">

                           <div class="collapse navbar-collapse">
								<?php



if(isset($_SESSION['loggedin_email']))
{
		$loggedin_name=$_SESSION['loggedin_name'];
							?>


                        <ul class="nav navbar-nav over mega-menu-fullwidth">
                            <li class="dropdown current-active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Hi <?php echo substr($loggedin_name,0,3)."..."; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                  <li><a href="change_email_password.php"><i class="fa fa-key" style="padding-right:10px;" adr_trans="label_my_account"></i>My Account</a></li>
   <li><a href="logout.php"><i class="fa fa-sign-out" style="padding-right:10px;" adr_trans="label_logout"></i>Logout</a></li>
                                </ul>
                            </li>


<?php } else { ?>
<div class="btn-group navbar-left navbar-social" style="padding-right:10px;">
                                <div class="btn-group social-group">
				<a href="login.php" style="font-weight:bold;vertical-align:middle;margin-top:10px;color:#FFFFFF">Login
	&nbsp;&nbsp; | &nbsp;&nbsp; </a>
	<a target="" href="signup.php" style="font-weight:bold;vertical-align:middle;margin-top:10px;color:#FFFFFF">Signup</a>
	</div>
<?php } ?></div>

<div class="btn-group navbar-left navbar-social">
                                <div class="btn-group social-group">

<?php
if(isset($_SESSION['loggedin_id']))
{
$user_type=$_SESSION['user_type'];
$countIs=0;
$link="";
$loggedin_id=$_SESSION['loggedin_id'];
if($user_type=='Photographer')
{
 $photographer_count_query="select count(*) as total from user_actions where (action_done_by_id='$loggedin_id' or photographer_id='$loggedin_id') and is_read=0";
                  $photographer_count_result=mysqli_query($con,$photographer_count_query);
				  $photographer_data=mysqli_fetch_assoc($photographer_count_result);
                  $countIs=$photographer_data['total'];
				  $link="./photographeractivity.php";
}
else
{
 $realtor_count_query="select count(*) as total from user_actions where (action_done_by_id='$loggedin_id' or realtor_id='$loggedin_id') and is_read=0";
                  $realtor_count_result=mysqli_query($con,$realtor_count_query);
                  $realtor_data=mysqli_fetch_assoc($realtor_count_result);
                  $countIs=$realtor_data['total'];
				   $link="./realtor_activity.php";
}
?>
<a href="<?php echo $link; ?>" onMouseOver="this.style.backgroundColor='#01A8F2'" onMouseOut="this.style.backgroundColor='#1D1E1F'" title="You have <?php echo $countIs; ?> unread notifications.Click here to view">
<?php /* ?><i class="fa fa-bell" style="width:fit-content"><?php if($countIs>0) { ?><?php echo $countIs; ?><?php } ?></i> <?php */ ?>

<div id="ex4">
<span class="p1 fa-stack fa-2x has-badge" data-count="<?php echo $countIs; ?>">

<i class="p3 fa fa-bell fa-stack-1x xfa-inverse" style="width:fit-content" data-count="4b"></i>
</span>
</div>
<style>
#ex4 .p1[data-count]:after{
position:absolute;
right:25%;
top:8%;
content: attr(data-count);
font-size:35%;
padding:4%;
border-radius:50%;
line-height:100%;
color: white;
background:rgba(255,0,0,.85);
text-align:center;
min-width: 20%;
font-weight:bold;
}
</style>
</a>
<?php } ?>


								 <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-instagram"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-youtube"></i></a>
                                </div>
                            </div>

			<select class="selectpicker" data-width="fit" onChange="changeLanguage(this.value)" style="margin-top:10px;">
			 <option  data-content='<span class="flag-icon flag-icon-us"></span> US' value='en' <?php if($_SESSION['Selected_Language_Session']=='en') { echo "selected"; } ?>>English</option>
    <option data-content='<span class="flag-icon flag-icon-no"></span> NO' value='no' <?php if($_SESSION['Selected_Language_Session']=='no') { echo "selected"; } ?>>Norwegian</option>
</select>
<input type="hidden" name="Selected_Language" id="Selected_Language" value="en" />

<script>
$(function(){
  $('.selectpicker').selectpicker();
   $('.dropdown-toggle').removeClass("btn");
  $('.selectpicker.btn-default').attr("style","margin-top:15px;");
});
</script>







<ul class="nav navbar-nav" style="width:100px;color:#000!important;z-index:999">
<li class="dropdown current-active">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="float:right;right:0"><i class="fa fa-bars"></i></span></a>
                           <ul class="dropdown-menu" style="top:30px;position:absolute;background-color:#FFF;color:#000!important;right:20px;z-index:999">


<?php

 if($_SESSION['loggedin_type']=="Realtor")
    {
?>
<li style="color:#000!important;"><a href="csrRealtorDashboard.php" style="color:#000!important;"><i class="fa fa-home" style="padding-right:10px;" adr_trans="label_home"></i>Home</a></li>
<li><a href="csrRealtorCalendar.php" style="color:#000!important;"><i class="fa fa-calendar" style="padding-right:10px;" adr_trans="label_calendar"></i>Calendar</a></li>
<li><a href="order_list.php"><i class="fa fa-stack-exchange" style="padding-right:10px;" adr_trans="label_order"></i>Orders</a></li>
<li><a href=""><i class="fa fa-file" style="padding-right:10px;"  adr_trans="label_order_reports"></i>Order reports</a></li>
<li><a href="realtor_activity.php"><i class="fa fa-bell" style="padding-right:10px;" adr_trans="label_notification"></i>Notification</a></li>
<li><a href="realtor_profile.php"><i class="fa fa-user" style="padding-right:10px;" adr_trans="label_my_profile"></i>My profile</a></li>


<?php } ?>

<?php

 if($_SESSION['loggedin_type']=="Photographer")
    {
?>
<li><a href="photographerDashboard.php"><i class="fa fa-home" style="padding-right:10px;" adr_trans="label_home"></i>Home</a></li>
<li><a href="photographerCalendar.php"><i class="fa fa-calendar" style="padding-right:10px;" adr_trans="label_calendar"></i>Calendar</a></li>
<li><a href="photographerorder_list.php"><i class="fa fa-stack-exchange" style="padding-right:10px;" adr_trans="label_order"></i>Orders</a></li>
<li><a href="photographeractivity.php"><i class="fa fa-bell" style="padding-right:10px;" adr_trans="label_notification"></i>Notification</a></li>
<li><a href="editor_list.php"><i class="fa fa-users" style="padding-right:10px;" adr_trans="label_editors"></i>Editors</a></li>
<li><a href="products.php"><i class="fa fa-list" style="padding-right:10px;" adr_trans="label_products"></i>Products</a></li>
<li><a href="photographer_profile.php"><i class="fa fa-user" style="padding-right:10px;" adr_trans="label_my_profile"></i>My profile</a></li>

<?php } ?>







                                       </ul>
                                  </li>
								</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
