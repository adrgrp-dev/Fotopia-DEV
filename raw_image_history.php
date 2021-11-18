<?php

include "connection.php";

$id_url=$_REQUEST['id'];
?>
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

 <div class="section-empty bgimage3">
        <div class="" style="margin:40px;">
            <div class="row">
			  

                <div class="col-md-12" style="background:#FFF;color:#000;opacity:0.9;padding-left:10px;">
                  <p ><h3 style="text-align:center;padding:10px;">Raw Images</h3></p>

                     <div>
                       <p ><h4 style="text-align:center;padding:10px;">Photos</h4></p>
                  <div class="row" style="overflow:scroll;height:300px;box-shadow:10px 10px 10px 10px #ddd;background:#fff">

                  <?php
                  $get_order_query=mysqli_query($con,"select * from img_upload where order_id='$id_url' and raw_images=1 and service_id=1 order by upload_on desc");
                  while($get_order=mysqli_fetch_assoc($get_order_query))
                  {
                  $dynamic_folder=$get_order['dynamic_folder'];
                  $image=$get_order['img'];
                  $uploaded_on=date("d-m-Y h:i a",strtotime($get_order['upload_on']));

                              ?>
  <div class="col-md-2">
      <center>  <img src="<?php echo str_replace('../','./',$dynamic_folder).'/'.$image; ?>" alt="" width="180" height="150"><br>
    <span style="text-align:center"><?php echo $uploaded_on; ?></span></center>
  </div>
                  <?php
                  }
                  ?>
                  </div>
                </div>
                <div>
                  <p ><h4 style="text-align:center;padding:30px;background:#FFF!important">Floor Plans</h4></p>
           <div class="row" style="overflow:scroll;height:300px;box-shadow:10px 10px 10px 10px #ddd;background:#fff">

             <?php
             $get_order_query=mysqli_query($con,"select * from img_upload where order_id='$id_url' and raw_images=1 and service_id=2 order by upload_on desc");
             while($get_order=mysqli_fetch_assoc($get_order_query))
             {
			 
             $dynamic_folder=$get_order['dynamic_folder'];
             $image=$get_order['img'];
             $uploaded_on=date("d-m-Y h:i a",strtotime($get_order['upload_on']));

                         ?>
<div class="col-md-3">
 <img src="<?php echo str_replace('../','./',$dynamic_folder).'/'.$image; ?>" alt="" width="200" height="200"><br>
 <span style="text-align:center"><?php echo $uploaded_on; ?></span>
</div>
             <?php
             }
             ?>
             </div>
           </div>
                </div>



                 </div>
               </div>
             </div>
