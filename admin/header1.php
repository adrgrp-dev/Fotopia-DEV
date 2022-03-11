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
if($type=="SuperCSR")
{
$page="csr_dashboard.php";
}
 if($type=="SubCSR")
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
    <title>Administration</title>
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

    <!-- Extra optional content header -->
  <style>
   .adr-save,.adr-save:hover
    {
    background:#AAD1D6!important;
    border-color:#AAD1D6!important;
    color: #000 !important;
    border-radius: 5px !important;
    }
    .adr-cancel
    {
    /*background:#5cb85c!important;
    border-color:#5cb85c!important;*/
    background:#F2ADA8!important;
    border-color:#F2ADA8!important;
    color: #000 !important;
    border-radius: 5px !important;
     
    }
    .adr-success
    {
    /*background:#5cb85c!important;
    border-color:#5cb85c!important;*/
    background:#AAD1D6!important;
    border-color:#AAD1D6!important;
     color: #000 !important;
     border-radius: 5px !important;
    }
    .btn-default
    {

    border: none !important;
    padding-top:20px;
    background:#AAD1D6!important;
    color: #000 !important;
    border-radius: 5px !important;
    }

    a.adr-save > i,button.adr-save > i,a.adr-cancel > i,button.adr-cancel > i,a.adr-save > span,a.btn-default > i,button.btn-default > i
{
  color: #000 !important;

} 

	.row
	{
	width:100%;
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
</head>
<body class="home">
    <div id="preloader"></div>
    <header data-menu-anima="fade-left">
	
        <div class="navbar navbar-default over" role="navigation">
		
            <div class="navbar navbar-main over">
			
              <div class="row">
<div class="col-md-5">
                     <div class="col-md-3 hidden-xs hidden-sm" style="margin-left:20px;">
                      <a class="navbar-brand" href="<?php echo $page; ?>"><img src="../images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-6px;width:65px;height:60px">
          <span style="display:inline;font-size:13px;color:#000;margin-left:-4px"><span style="color:#aad1d6;font-size:18px;padding-left:13px">f</span>otopia</span></a>
                  </div>
				  
				   <div class="col-md-3 hidden-md hidden-lg hidden-xl" style="margin-left:20px;">
                      <a class="navbar-brand" href="<?php echo $page; ?>"><img src="../images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-4px;width:40px;height:30px;">
          <span style="display:inline;font-size:13px;color:#000;margin-left:-4px"><span style="color:#aad1d6;font-size:18px;padding-left:13px">f</span>otopia</span></a>
                  </div>
				 
</div>
         <div class="col-md-7">
       <p style="font-weight:bold;margin-top:20px;color:#000;float:left;display:inline-table;" ><span adr_trans="label_photo_app_admin">Photography App - Adminstration</span></p>
	 

</div>

</div>
</div>

</div>
        
    </header>
