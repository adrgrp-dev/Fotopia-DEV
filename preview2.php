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
	$ParsedFileName=$ParsedFileNameIS[0]."-".$x.".".$file->getExtension();
	$ParsedFileNameWithoutExtension=$ParsedFileNameIS[0]."-".$x;
		if (file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".jpg") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".png") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".jpeg") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".JPEG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".PNG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".gif") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".GIF") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".DNG") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".dng") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".CR2") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".cr2") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".NEF") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".nef") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".ARW") || file_exists("./temp/$timeRandom/".$ParsedFileNameWithoutExtension.".arw")) {
		$x++;
		}
		else
		{

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
	background:#aad1d6!important;
	border-color:#aad1d6!important;
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
  .tab-black
  {
    background-color: white;
    color: black;
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
						<span style="display:ineline;font-size:14px;color:#FFFFFF"><span style="color:#aad1d6;font-size:18px;">f</span ><span style="color: #000 !important;">otopia</span></a>

                    </div>
                    <?php
                     $editor_email=$raw_images["editor_email"];
                     $editor_name_split=explode("@",$editor_email);
                     $editor_name=$editor_name_split[0];
                      ?>
                      <p align="center" style="font-size: x-large;color: #ffffff;margin-top: 10px;"><span adr_trans="label_welcome">welcome</span> <?php echo $editor_name; ?></p>

                    </div>
                </div>
            </div>

    </header>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>

 <div class="section-empty bgimage5">
   <hr class="space l">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
              <div class="col-md-12"><center style="color:black;font-size:20px">Editor Dashboard</center></div>
			<hr class="space l">

      <div class="col-md-1">
        &nbsp;
      </div>
                <div class="col-md-8">

<div class="tab-box" data-tab-anima="show-scale">
<ul class="nav nav-tabs nav-justified">
<li class=" active "><a href="#" class="">Preview Naming</a></li>
</ul>
<a href="<?php echo "./download_raw_images.php?secret_code=$secret";?>" class="btn btn-default btn-sm anima-button adr-save" style="float: right;position: relative;top: -26px;border-radius: 5px;" adr_trans="label_send"><i class="fa fa-paper-plane adr-save"></i>send</a>
<div class="panel active" style="position: relative;top: 10px;">
  <?php
     $id_url=$raw_images["order_id"];
  $get_order_query1=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
  $get_order1=mysqli_fetch_array($get_order_query1);
  mysqli_query($con,"UPDATE `orders` SET `status_id`=2 WHERE id=$id_url");
  ?>
  
  <div class="maso-list gallery" style="overflow: scroll;height: 550px;width: 100% !important;">
    <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;margin-left: 7%;">
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
      $imagesDirectory = "./finished_images/order_".$id_url."/".$service;
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
         if(($imgFileType == 'jpg') || ($imgFileType == 'png') || ($imgFileType == 'DNG') || ($imgFileType == 'CR2') || ($imgFileType == 'NEF') || ($imgFileType == 'ARW'))
         {
          ?>
                  <div data-sort="1" class=" col-md-3 cat1" style="visibility: visible; margin-top:5px;border:solid 2px #aaa;padding:5px;background:#ddd;margin:15px;">

                      <a class="img-box i-center" href="<?php echo "finished_images/order_".$id_url."/".$service."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
                          <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

                          <img alt="" src="<?php echo "finished_images/order_".$id_url."/".$service."/".$image; ?>" width="240" height="180"/>
                      </a>
                      <?php
                      $get_comment_querry=mysqli_query($con,"SELECT * FROM `image_naming` WHERE order_id=$id_url and image_name='$image'");
                      $get_comment=mysqli_fetch_assoc($get_comment_querry);
                      ?>
                    <?php /*  <input type="text" list="pic_type" class="form-control stdImg" size="" id="myBtn<?php echo $get_comment['id']; ?>" value="<?php echo $get_comment['description']; ?>" style="width:120px;margin-top:10px;" onchange="myFunction(event,<?php echo  $get_comment['id'];?>,'<?php echo $service ?>')" required placeholder="Name the pic"/>
                      <datalist id="pic_type" />
                        <option value="">choose your description</option>
                      <?php
                        $description_query=mysqli_query($con,"SELECT * FROM `image_interior_exterior_name` ");
                        while($description=mysqli_fetch_array($description_query))
                        {
                          ?>
                          <option value="<?php echo $description['name'];?>" <?php if($get_comment['description']== $description['name']) {echo "selected";}?> ><?php echo $description['name'];?></option>
                  <?php  }?>
                </datalist>
                */ ?>
                    <center><span style="text-align:center"><?php echo $get_comment['description']."<br>".date("d-m-Y h:i a",strtotime($get_comment["created_on"]));?></span></center>
                  </div>

                  <script>
                  function myFunction(e,data,type)
                   {
                  var key = e.which;
                    if(1)
                    {
                      var a=$("#myBtn"+data).val();
                      var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                       if(this.responseText=="true")
                       {
                        // alert("description Uploaded");
                       }
                     }
                    };
                    xhttp.open("GET","description.php?id="+data+"&id1="+a+"&type="+type+"&user=editor", true);
                    xhttp.send();
                    }
                  }
                  </script>
          <?php
         }
        }
          closedir($opendirectory);
      }
      ?>
    <?php
    if(!is_dir($imagesDirectory)) {
     echo  "<p align='center' style='' ><b> No Images </b></p>";
     }
    ?>
	

   </div>

 </div>
</div>


<br>
<br>
<br>
<br>
<br>
<br>
</div>
</div>
</div>


</div>



 <?php include "footer.php";  ?>
