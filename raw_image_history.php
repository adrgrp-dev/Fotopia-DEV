<?php

include "connection.php";

$id_url=$_REQUEST['id'];
?>

 <div class="section-empty bgimage3">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">




			          </div>


                <div class="col-md-10" style="background:#FFF;color:#000;opacity:0.9;padding-left:10px;">
                  <p ><h3 style="text-align:center;padding:30px;">Raw Images History</h3></p>

                     <div>
                       <p ><h5 style="text-align:center;padding:30px;">Photos</h5></p>
                  <div class="row" style="overflow:scroll;height:300px;">

                  <?php
                  $get_order_query=mysqli_query($con,"select * from img_upload where order_id='$id_url' and raw_images=1 and service_id=1 order by upload_on desc");
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
                <div>
                  <p ><h5 style="text-align:center;padding:30px;">floor_plans</h5></p>
             <div class="row" style="overflow:scroll;height:300px;">

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
