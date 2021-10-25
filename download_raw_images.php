<?php
include "connection.php";

$secret=$_REQUEST["secret_code"];

$get_raw_images=mysqli_query($con,"select * from raw_images where security_code='$secret'");
$raw_images=mysqli_fetch_assoc($get_raw_images);

?>
<?php

if(isset($_POST['ZIP']))
{

  $dir = $_POST['folderToZip'];
  $zip_file = "Fotopia".$_POST['Order_ID'].time().".zip";

// Get real path for our folder
$rootPath = realpath($dir);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();


header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($zip_file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($zip_file));
readfile($zip_file);

  unlink($zip_file);
}

 ?>


<html lang="en">
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
    <link rel="stylesheet" href="scripts/magnific-popup.css">
	 <link rel="stylesheet" href="scripts/jquery.flipster.min.css">

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
  .tab-black
  {
    background-color: white;
    color: black;
  }
	</style>

<script>
var calid;
function calDetails(calid)
{
$("#dayVal").val(calid);

}
</script>
<script src="dropzone/dropzone.js"></script>
<script src="dropzone/validate.js"></script>
<script>

</script>
<link rel="stylesheet" href="dropzone/dropzone.css">
     <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <!-- Extra optional content header -->
</head>
<body class="home device-l"><input type="hidden" name="dayVal" id="dayval" value="">

    <div id="preloader" style="display: none;"></div>
    <header data-menu-anima="fade-left">
        <div class="navbar navbar-default over wide-area" role="navigation">
            <div class="navbar navbar-main over">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index.php" style="padding-left:30px;"><img src="images/logo-1.png" alt="logo" style="margin-top:-6px;">
						<span style="display:ineline;font-size:14px;color:#FFFFFF"><span style="color:#00A8F3;font-size:18px;">f</span>otopia</span></a>

                    </div>
                    <?php
                     $editor_email=$raw_images["editor_email"];
                     $editor_name_split=explode("@",$editor_email);
                     $editor_name=$editor_name_split[0];
                      ?>
                      <p align="center" style="font-size: x-large;color: #ffffff;margin-top: 10px;">welcome <?php echo $editor_name; ?></p>

                    </div>
                </div>
            </div>

    </header>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>

 <div class="section-empty">
   <hr class="space l">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
              <div class="col-md-12"><center style="color:black;font-size:20px">Editor Dashboard</center></div>
			<hr class="space l">

      <div class="col-md-1">
      </div>




                <div class="col-md-10">

<div class="tab-box" data-tab-anima="show-scale">
<ul class="nav nav-tabs ">
<li class=" active "><a href="#" class="">View Raw Images</a></li>
<li class=""><a href="#" class="">Upload images</a></li>

</ul>
<div class="panel active" >

  <?php if(@isset($_REQUEST["d"])) { ?>
              <div class="success-box" style="display:block;">
                  <center><div class="text-success"><i style="font-size: 12px;    color: #00b300;">Finished Images Upload Successfully</i></div></center>
              </div>
  <?php } ?>


  <?php
     $id_url=$raw_images["order_id"];
  $get_order_query1=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
  $get_order1=mysqli_fetch_array($get_order_query1);
  if($get_order1['status_id']==4)
  {
      echo '<center><div class="text-success"><i style="font-size: 18px;color: black;">Rework</i></div></center>';
  }
  ?>

  <div class="maso-list gallery">
    <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;">
      <?php
      if(mysqli_num_rows($get_raw_images))
      {

         if($raw_images["service_name"]==1)
         {
           $service="standard_photos";
         }
         elseif($raw_images["service_name"]==2)
         {
            $service="floor_plans";
         }
         elseif($raw_images["service_name"]==3) {
             $service="Drone_photos";
         }
         elseif($raw_images["service_name"]==4) {
             $service="HDR_photos";
         }
      }
      else{
         $id_url="";
         $service="";
       }

      $imagesDirectory = "./raw_images/order_".$id_url."/".$service;

      if (is_dir($imagesDirectory))
      {
       $opendirectory = opendir($imagesDirectory);
          while (($image = readdir($opendirectory)) !== false)
       {
         if(($image == '.') || ($image == '..'))
         {
           continue;
         }
         $imgFileType = pathinfo($image,PATHINFO_EXTENSION);
         if(($imgFileType == 'jpg') || ($imgFileType == 'png'))
         {
          ?>
                  <div data-sort="1" class=" col-md-2 cat1" style="visibility: visible; height:fit-content; padding:20px;">
                    <?php
                    $get_comment_querry=mysqli_query($con,"SELECT * FROM `image_naming` WHERE order_id=$id_url and image_name='$image'");
                    $get_comment=mysqli_fetch_assoc($get_comment_querry);
                    ?>
                    <p><span style="color:red;">*</span><?php echo $get_comment['description']; ?></p>

                      <a class="img-box i-center" href="<?php echo "raw_images/order_".$id_url."/".$service."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
                          <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

                          <img alt="" src="<?php echo "raw_images/order_".$id_url."/".$service."/".$image; ?>" width="100" height="80"/>
                      </a>
                      <?php
                      $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
                      $get_comment=mysqli_fetch_assoc($get_comment_querry);
                      ?>
                      <p><span style="color:red;"></span><?php echo $get_comment['comments'];?></p>
                  </div>


          <?php
         }
        }

          closedir($opendirectory);

      }

      ?>
	  <div class="col-md-12">
      <?php
      if(!is_dir($imagesDirectory)) {
       echo  "<p align='left' style='' ><b> No Images to display </b></p>";
       }
       else{?>
            <div style="font-size: 18px;color: black; font-style:italic;"><?php if(!empty($raw_images['comments'])){ echo "Comment :";} ?></span><?php echo "".$raw_images['comments'];?></i></div>
       <?php }
      ?>
	  </div>
  <form name="zipDownload" method="post" action="">
      <input type="hidden" name="folderToZip" value="<?php echo "./raw_images/order_".$id_url."/".$service; ?>">
     	<input type="hidden" name="Order_ID" value="<?php echo $id_url; ?>">
      <input type="hidden" name="service_ID" value="<?php echo $service; ?>">
      <hr class="space s">
      <input type="submit" class="btn btn-primary" name="ZIP" value="ZIp and download all Images">
  	</form>

   </div>
   </div>

   </div>
<div class="panel" >

  <div class="container pt-5">
   <div class="row">

    <div class="col-md-8" style="margin-left:160px;" id="upload_raw_images" >
    <center>  <div id="view_msg" class="text-success"></div></center>
       <hr class="space l">
        <?php
        $order_id=$raw_images["order_id"];
        $type=$raw_images["service_name"];
        ?>
       <form action="./dropzone/upload1.php?id=<?php echo $order_id; ?>&type=<?php echo $type;?>&user_id=<?php echo '0';?>&user_type=<?php echo ' ';?>" id='uploads' class="dropzone" style="100px">

        <span id="drop_files"></span>
        </form>
         <script>
          $(document).ready(function() {
            $("#drop_files").html("<br/><h3> Click to Upload </h3>");
            $("#drop_files").css('text-align', 'center');
            $("<div><p align='center'><img src='./dropzone/upload-icon.png' class='img-rounded' height='30px'  id='icon'></p></div>").insertAfter("#drop_files");
          });

        </script>
           <p align="right"><a href="#" id="submit" class="btn btn-primary" style="position: relative; ">submit</a></p>

         <input type="hidden"  id="order_id"  value="<?php echo $order_id?>">
          <input type="hidden"  id="service_name"  value="<?php echo $type?>">
    <script>
     $("#submit").click(function(){
      var c=document.getElementsByClassName('dz-preview dz-processing dz-image-preview dz-success dz-complete').length;
      if(c==0)
      {
         document.getElementById('view_msg').innerHTML="<center><h5 class='text-success'>please choose upload photos</h5></center>";
      }
      else
      {

        ajax();
      }

    })
    function ajax()
    {
      var od=$("#order_id").val();
      var type=$("#service_name").val();


      var xhttp= new XMLHttpRequest();


      xhttp.onreadystatechange = function()
      {
      if(this.readyState == 4 && this.status == 200){

        window.location="<?php echo "./preview2.php?secret_code=$secret";?>";
      }
    };
    xhttp.open("GET","./editor_update.php?id="+od+"&type="+type,true);
    xhttp.send();
    }
    </script>
    <?php $get_rawimages_query=mysqli_query($con,"SELECT * FROM `raw_images` WHERE order_id=$id_url and service_name=$type");
      if($get_images=mysqli_fetch_assoc($get_rawimages_query))
      {
          if($get_images["status"] == 6||$get_images["status"] == 3)
          {
		  if($_SESSION['Selected_Language_Session']=='en')
		  {
            echo '<script>$("#uploads").hide();$("#upload_raw_images").html("<center>Finished Images has been uploaded already</center>");$("#upload_raw_images").css({"color": "green", "padding": "140px"})</script>';
			}
			else
			{
			echo '<script>$("#uploads").hide();$("#upload_raw_images").html("<center>De klare bildene har blitt lastet opp allerede</center>");$("#upload_raw_images").css({"color": "green", "padding": "140px"})</script>';
			}
          }
      }
      ?>
      </div>
    </div>
   </div>
  </div>
 </div>
</div>
      <div class="col-md-1">
      </div>

   	</div>
	</div>
</div>




 <footer class="wide-area foo">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 footer-left">
                        <p>Copyright © 2021 Photography App. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 footer-right">
                        <span>+1 800 123 21 05</span>
                        <span class="space"></span>
                        <div class="btn-group navbar-social">
                            <div class="btn-group social-group">
                                <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-instagram"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <link property="" rel="stylesheet" href="scripts/font-awesome/css/font-awesome.min.css">
        <script async="" src="scripts/bootstrap/js/bootstrap.min.js"></script>
		 <script src="scripts/flexslider/jquery.flexslider-min.js"></script>
        <script src="scripts/imagesloaded.min.js"></script>
        <script src="scripts/jquery.progress-counter.js"></script>
		  <script src="scripts/jquery.magnific-popup.min.js"></script>
		 <script src="scripts/jquery.flipster.min.js"></script>
        <script src="scripts/jquery.tab-accordion.js"></script>
        <script src="scripts/smooth.scroll.min.js"></script>
		<script src="scripts/parallax.min.js"></script>
    </footer>


<div class="betternet-wrapper"></div></body></html>
