<?php
$id_url=$_REQUEST['id'];
$imagesDirectory = "./finished_images/order_".$id_url;

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
     echo "<img src='./finished_images/order_".$id_url."/".$image."' width='200' style='padding:10px;'>";
   }
  }

    closedir($opendirectory);

}
else
{
    echo "<p align='center' style='padding:170px 0px;font-size:large' ><b> No Images <b></p>";
}
?>
