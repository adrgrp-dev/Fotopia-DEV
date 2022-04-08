<?php

include "connection.php";

$id_url=$_REQUEST['id'];

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


$Order_ID=@$_REQUEST['id'];;
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
		if($statusIs==4)
		{
		$ParsedFileNameIS=explode(".",$relativePath);
			$ParsedFileName=$ParsedFileNameIS[0].".".$file->getExtension();


		}
		else
		{
			$ParsedFileName=$ParsedFileNameIS[0]."-".$x.".".$file->getExtension();

		}
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
 <style>
     

.adr-save
{
    background:#AAD1D6!important;
    border-color:#AAD1D6!important;
    color: #000!important;
}
standard_photos > 

 </style>

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
                    
                      <p align="center" style="font-size: x-large;color: #000;margin-top: 10px;margin-right: 110px;">Welcome to Fotopia</p>

                    </div>
                </div>
            </div>

    </header>

 <div class="section-empty bgimage3">
        <div class="" style="margin:40px;">
            <div class="row">


                <div class="col-md-8" align="center" style="background:#FFF;color:#000;opacity:0.9;padding-left:10px;border-radius: 10px;margin-left: 197px;">
                  <p><h5 style="text-align:center;padding:10px;margin-top: 10px;font-size: 16px;">Raw Images - Photos</h5></p>
                     <?php if(isset($_REQUEST['p'])){?>
                     <div style="position: relative;top: -45px;">
                       <?php
                       $RowsFound=0;
                       $get_order_query=mysqli_query($con,"select * from img_upload where order_id='$id_url' and raw_images=1 and service_id=1 and dynamic_folder!='' order by upload_on desc");
                       $RowsFound=mysqli_num_rows($get_order_query);?>
                       <form name="zipDownload" method="post" action="" style="padding-bottom:40px;">
                           <input type="hidden" name="folderToZip" value="<?php echo "./raw_images/order_".$id_url."/"."standard_photos"; ?>">
                           <?php if($RowsFound>0)
                         { ?> <input type="submit" class="btn adr-save" style="float:right;background: black;color:white;border-radius:25px;font-size: 12px;" name="ZIP" value="ZIP and Download Photos">
                         <?php } ?>
                         </form>
                         
                  <div class="row"  style="overflow:scroll;height:300px;background:#fff;width:100%;border-top: 1px solid fff;">


               <div id="standard_photos" style="margin-left:7%">
              <?php
                  while($get_order=mysqli_fetch_assoc($get_order_query))
                  {
                  $dynamic_folder=$get_order['dynamic_folder'];
                  $image=$get_order['img'];
                  $uploaded_on=date("d-m-Y h:i a",strtotime($get_order['upload_on']));
$getImgName=mysqli_query($con,"SELECT * FROM `image_naming` WHERE image_name='$image'");
$getImgName1=mysqli_fetch_array($getImgName);
                              ?>
  <div class="col-md-2" style="margin-top:5px;border:solid 2px #aaa;padding:5px;background:#ddd;margin:15px;width: 190px;">
      <center><img src="<?php echo str_replace('../','./',$dynamic_folder).'/'.$image; ?>" alt="" width="240" height="180" style="border-radius:5px;"><br />
    <span style="text-align:center"><?php echo $getImgName1['description']."<br>".$uploaded_on; ?></span></center>
  </div>
                  <?php
                  }
                  ?>
                  </div>
                  </div>
                </div>
              <?php } ?>
              <?php if(isset($_REQUEST['f'])){?>
                <p ><h4 style="text-align:center;padding:10px;margin-top:35px;font-size: 16px;">Raw Images - Floor Plans</h4></p>
                <div style="position: relative;top: -45px;">
                  
                  <?php
                  $RowsFound1=0;
                  $get_order_query=mysqli_query($con,"select * from img_upload where order_id='$id_url' and raw_images=1 and service_id=2 and dynamic_folder!='' order by upload_on desc");
                  $RowsFound1=mysqli_num_rows($get_order_query);?>
                  <form name="zipDownload" method="post" action="" style="padding-bottom:40px;">
                      <input type="hidden" name="folderToZip" value="<?php echo "./raw_images/order_".$id_url."/"."floor_plans"; ?>">
                      <?php if($RowsFound1>0)
                	  { ?> <input type="submit" class="btn adr-save" style="float:right;background: black;color:white;border-radius:25px;font-size: 12px;" name="ZIP" value="ZIP and Download  Floor Plans">
                	  <?php } ?>
                  	</form>
                     
           <div class="row" style="overflow:scroll;height:300px;background:#fff;width:100%;border-top: 1px solid fff;">
    
           <div style="margin-left: 7%;">
          <?php
             while($get_order=mysqli_fetch_assoc($get_order_query))
             {

             $dynamic_folder=$get_order['dynamic_folder'];
             $image=$get_order['img'];
             $uploaded_on=date("d-m-Y h:i a",strtotime($get_order['upload_on']));
$getImgName=mysqli_query($con,"SELECT * FROM `image_naming` WHERE image_name='$image'");
$getImgName1=mysqli_fetch_array($getImgName);
                         ?>
<div class="col-md-2" style="margin-top:5px;border:solid 2px #aaa;padding:5px;background:#ddd;margin:15px;width: 190px;"> 
 <center><img src="<?php echo str_replace('../','./',$dynamic_folder).'/'.$image; ?>" alt="" width="240" height="180" style="border-radius:5px;"><br>
 <span style="text-align:center"><?php echo $getImgName1['description']."<br>".$uploaded_on; ?></span></center>
</div>
             <?php
             }
             ?>
             </div>
             </div>
           </div>
         <?php } ?>
                </div>



                 </div>
               </div>
             </div>

<?php 

include "footer.php";

 ?>