<?php

include "connection.php";

$secret=$_REQUEST["secret_code"];

$get_raw_images=mysqli_query($con,"select * from raw_images where security_code='$secret'");
$raw_images=mysqli_fetch_assoc($get_raw_images);



function copy_folder($src, $dst) {

    // open the source directory
    $dir = opendir($src);

    // Make the destination directory if not exist
    @mkdir($dst);

    // Loop through the files in source directory
    while( $file = readdir($dir) ) {

        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) )
            {

                // Recursively calling custom copy function
                // for sub directory
                copy_folder($src . '/' . $file, $dst . '/' . $file);

            }
            else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }

    closedir($dir);
}
function getFileCount($path) {
        $size = 0;
        $ignore = array('.','..','cgi-bin','.DS_Store');
        $files = scandir($path);
        foreach($files as $t) {
            if(in_array($t, $ignore)) continue;
            if (is_dir(rtrim($path, '/') . '/' . $t)) {
                $size += getFileCount(rtrim($path, '/') . '/' . $t);
            } else {
                $size++;
            }
        }
        return $size;
    }


if(isset($_POST['ZIP']))
{
$id_url=$_REQUEST['Order_ID'];

$Order_ID=@$_REQUEST['Order_ID'];
if(!empty($Order_ID))
{
$getOrder=mysqli_query($con,"select status_id from orders where id='$Order_ID'");
$getOrder1=mysqli_fetch_array($getOrder);
$statusIs=$getOrder1['status_id'];

}


$OrderCityState=mysqli_query($con,"select * from orders where id='$id_url'");
$OrderCityState1=mysqli_fetch_array($OrderCityState);
$property_city=$OrderCityState1['property_city'];
$property_state=$OrderCityState1['property_state'];
$timeRandom=rand(1000000000,9999999999);
mkdir("./temp/$timeRandom");

  $dir = $_POST['folderToZip'];

copy_folder($dir,"./temp/$timeRandom");


// Get real path for our folder
$rootPath = realpath("./temp/$timeRandom");
 $zip_file = "Fotopia_".$property_city."_".$property_state."_Order_".$id_url."_".$timeRandom.".zip";

// Initialize archive object
$zip = new ZipArchive();
$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
$totalNumberOdFiles=getFileCount("./temp/$timeRandom");

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
    $filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($rootPath) + 1);

$x=1;
		$extn=$file->getExtension();
		$ParsedFileNameIS=explode("_",$relativePath);


		for($i=0;$i<$totalNumberOdFiles;$i++)
		{
		/*if($statusIs==4)
		{
		$ParsedFileNameIS=explode(".",$relativePath);
			$ParsedFileName=$ParsedFileNameIS[0].".".$file->getExtension();


		}
		else
		{ */
			$ParsedFileName=$ParsedFileNameIS[0]."-".$x.".".$file->getExtension();

		//}
    // echo $ParsedFileName;
    //   exit;
	$ParsedFileNameWithoutExtension=$ParsedFileNameIS[0]."-".$x;
		if (file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".jpg") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".png") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".jpeg") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".JPEG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".PNG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".gif") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".GIF") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".DNG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".dng") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".CR2") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".cr2") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".NEF") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".nef") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".ARW") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".arw")) {
		$x++;
		}
		else
		{
    //  echo "./temp/$timeRandom/".$relativePath;exit;
mysqli_query($con,"update image_naming set downloaded_raw_image_name='$ParsedFileName' where order_id='$Order_ID' and image_name='$relativePath'");



		rename("./temp/$timeRandom/".$relativePath,"./temp/$timeRandom/".$ParsedFileName);

		break 1;
		}
    }
	$zip->addFile("./temp/$timeRandom/".$ParsedFileName, $ParsedFileName);
        // Add current file to archive

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
unlinkr("./temp/$timeRandom");
rmdir("./temp/$timeRandom");
}


function delete_files($dir) {

foreach(glob($dir . '/*') as $file) {
  if(is_dir($file))
  delete_files($file);
  else unlink($file);

} ;


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
	 background:#AAD1D6!important;
    border-color:#AAD1D6!important;
    color: #000!important;
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
 
 
  .mfp-container

{

background:#000 !important;
opacity:1!important;

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
                        <a class="navbar-brand" href="index.php" style="padding-left:30px;"><img src="images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-6px;width:65px;height:60px">
						<span style="display:ineline;font-size:13px;color:#000;margin-left:-4px"><span style="color:#aad1d6;font-size:18px;padding-left:13px">f</span>otopia</span></a>

                    </div>
                    <?php
                     $editor_email=$raw_images["editor_email"];
                     $editor_name_split=explode("@",$editor_email);
                     $editor_name=$editor_name_split[0];
                      ?>
                      <p align="center" style="font-size: x-large;color: #000;margin-top: 10px;">welcome <?php echo $editor_name; ?></p>

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
<li class=" active "><a href="#" class="">View Raw/Rework Images</a></li>
<li class=""><a href="#" class="">Upload Finished images</a></li>

</ul>
<div class="panel active" >

  <?php
      $id_url=$raw_images["order_id"];
  if(@isset($_REQUEST["d"])) { ?>
              <div class="success-box" style="display:block;">
                  <center><div class="text-success"><i style="font-size: 12px;    color: #00b300;">Finished Images Upload Successfully</i></div></center>
              </div>
  <?php } ?>
    <center><a href="raw_image_history.php?id=<?php echo $id_url; ?><?php if($raw_images["service_name"]==1){ echo "&p=1";}else{ echo "&f=1";}?>" target="_blank" style="font-size:16px;color:blue;text-decoration:underline;">click here to view already uploaded raw images</a></center>
<br>
  <?php

  $get_order_query1=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
  $get_order1=mysqli_fetch_array($get_order_query1);
  ?>
  <?php
  if($get_order1['status_id']==4)
  {
      echo '<center><div class="text-success"><i style="font-size: 18px;color: black;">Images to rework</i></div></center>';
  }
  ?>



  <div class="maso-list gallery">
    <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;">
      <?php
	  $RowsFound=0;
	  $RowsFound=mysqli_num_rows($get_raw_images);
      if(mysqli_num_rows($get_raw_images))
      {

         if($raw_images["service_name"]==1)
         {
           $service="standard_photos";
           $service_id='1';
         }
         elseif($raw_images["service_name"]==2)
         {
            $service="floor_plans";
            $service_id='2';
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
$get_folder_querry="";
if(@$_REQUEST['rework'])
{
 $imagesDirectory = "rework_images/order_".$id_url."/".$service."/rework_approved";
 $get_folder_querry=mysqli_query($con,"SELECT * FROM `img_upload` WHERE order_id=$id_url and service_id=$service_id and raw_images=1 and comments!=''");

}
else
{
      $imagesDirectory = "raw_images/order_".$id_url."/".$service;
	  $get_folder_querry=mysqli_query($con,"SELECT DISTINCT dynamic_folder FROM `img_upload` WHERE order_id=$id_url and service_id=$service_id and dynamic_folder!=''");
	  }
    //echo $imagesDirectory;

   
 $opendirectory = opendir($imagesDirectory);

while (($image = readdir($opendirectory)) !== false)
 {
   if(($image == '.') || ($image == '..'))
   {
     continue;
   }
  
       // $imagesDirectory =".".trim($folder['dynamic_folder'],'.');
     //$image=@$folder['img'];
         $imgFileType = pathinfo($image,PATHINFO_EXTENSION);
         if(($imgFileType == 'jpg') || ($imgFileType == 'png') || ($imgFileType == 'DNG') || ($imgFileType == 'CR2') || ($imgFileType == 'NEF') || ($imgFileType == 'ARW'))
         {
          ?>
                  <div data-sort="1" class=" col-md-2 cat1" style="visibility: visible;margin-top:5px;border:solid 2px #aaa;padding:5px;background:#ddd;margin:15px;">
                    <?php
                    $get_comment_querry=mysqli_query($con,"SELECT * FROM `image_naming` WHERE order_id=$id_url and image_name='$image'");
                    $get_comment=mysqli_fetch_assoc($get_comment_querry);
                    $commented = $get_comment['description'];
                    ?>
                
                      <a class="img-box i-center" href="<?php echo "raw_images/order_".$id_url."/".$service."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
                          <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>
<?php if(@$_REQUEST['rework'])
{

?>
    <img alt="" src="<?php echo $imagesDirectory.'/'.$image; ?>" width="240" height="180" style="margin-bottom:0px;"/>

	<?php } else { ?>
	<img alt="" src="<?php echo $imagesDirectory.'/'.$image; ?>" width="240" height="180" style="margin-bottom:0px;"/>

	<?php } ?>
                      </a>
                      <?php
                      $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
                      $get_comment=mysqli_fetch_assoc($get_comment_querry);
                      ?>
                      <center><span style="text-align:center;margin-top: 5px;"><?php echo $commented."<br>"."Comments : ".$get_comment['comments']; ?></span></center>
                  </div>


          <?php

         // closedir($opendirectory);

      }
    }

      ?>
	  <div class="col-md-12">
      <?php
      if($RowsFound==0 && @$_REQUEST['rework']) {
       echo  "<p align='left' style='' ><b> No Images to display </b></p>";
       }
       if($RowsFound>0 && @$_REQUEST['rework']){?>
            <div style="font-size: 18px;color: black; font-style:italic;"><?php if(!empty($raw_images['comments'])){ echo "Comment :";} ?></span><?php echo "".$raw_images['comments'];?></i></div>
       <?php }
      ?>
	  </div>

  <form name="zipDownload" method="post" action="">
      <input type="hidden" name="folderToZip" value="<?php echo "./rework_images/order_".$id_url."/".$service."/rework_approved"; ?>">
     	<input type="hidden" name="Order_ID" value="<?php echo $id_url; ?>">
      <input type="hidden" name="service_ID" value="<?php echo $service; ?>">
      <hr class="space s">
      <?php if($RowsFound>0 && @$_REQUEST['rework'])
	  { ?> <input type="submit" class="btn adr-save" name="ZIP" value="ZIp and download rework Images">
	  <?php } ?>
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

        $user_id=0;
        $user_type="";
        if(isset($_SESSION['loggedin_id']))
        {
            $user_id=$_SESSION['loggedin_id'];
            $user_type=$_SESSION['user_type'];

        }
        elseif(isset($_SESSION['loggedin_id']))
        {
            $user_id=$_SESSION['admin_loggedin_id'];
            $user_type=$_SESSION['admin_loggedin_type'];
        }

        ?>

       <form action="./dropzone/upload1.php?id=<?php echo $order_id; ?>&type=<?php echo $type;?>&user_id=<?php echo $user_id;?>&user_type=<?php echo $user_type;?>" id='uploads' class="dropzone" style="100px">

        <span id="drop_files"></span>
        </form>
         <script>
          $(document).ready(function() {
            $("#drop_files").html("<br/><h3> Click or Drag and Drop to Upload Pictures </h3>");
            $("#drop_files").css('text-align', 'center');
            $("<div><p align='center'><img src='./dropzone/upload-icon.png' class='img-rounded' height='30px'  id='icon'></p></div>").insertAfter("#drop_files");
          });

        </script>
           <p align="right"><a href="#" id="submit" class="btn adr-save" style="position: relative; ">submit</a></p>

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
          if($get_images["status"] == 3)
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




 <?php 

include "footer.php";

 ?>


<div class="betternet-wrapper"></div></body></html>
