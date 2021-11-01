
<hr class="space l">
<h5 style="border-bottom:solid 2px #4caf50;border-left:solid 12px #4caf50;padding:10px">Floor Plans</h5>
<hr>
<div class="maso-list gallery">
  <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;">
  <?php
  $imagesDirectory_floor = "./finished_images/order_".$id_url."/floor_plans";

  if (is_dir($imagesDirectory_floor))
  {
   $opendirectory = opendir($imagesDirectory_floor);


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



              <div data-sort="1" class=" col-md-2 cat1" style="visibility: visible; height:fit-content; padding:20px;">
                  <a class="img-box i-center" href="<?php echo $imagesDirectory_floor."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
                      <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

                      <img alt="" src="<?php echo $imagesDirectory_floor."/".$image; ?>" width="100" height="80"/>
                  </a>

                 <center><input type="button" class="btn btn-primary" style="" onclick="GetDetail('<?php echo $imagesDirectory_floor."/".$image;?>')" value="Rework"/></center>

              </div>

      <?php

     }

    }

      closedir($opendirectory);
  }
  ?>
  <form name="zipDownload" method="post" action="">
  <input type="hidden" name="folderToZip" value="<?php echo "./finished_images/order_".$id_url."/floor_plans"; ?>">
  <input type="hidden" name="Order_ID" id="getdata" value="<?php echo $id_url; ?>">
  <input type="hidden" name="service_ID" value="<?php echo $service; ?>">
  <hr class="space s">
<center><input type="submit" class="btn btn-primary" name="ZIP" id="zip_floor" value="ZIp and download all Images"></center>
  </form>

  <!-- <?php
   if(!is_dir($imagesDirectory_floor)) {
    echo    "<p align='center' style='' ><b> No Images <b></p>";
    echo    "<script>$('#zip_floor').hide();</script>";
  }

  ?> -->

  </div>
  </div>
