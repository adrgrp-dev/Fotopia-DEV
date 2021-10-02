<?php
ob_start();

include "connection1.php";


  $id_url=$_REQUEST['id'];

  if(isset($_REQUEST['chattext']))
{
$created_by_id=$_REQUEST['created_by_id'];
$from_user_id=$_SESSION["loggedin_id"];
$chat_message=$_REQUEST['chattext'];
$order_id=$_REQUEST['order_id'];
//echo "insert into chat_message(to_user_id,from_user_id,chat_message,timestamp,order_id)values('$created_by_id','$from_user_id','$chat_message',now(),'$order_id'";exit;
mysqli_query($con,"insert into chat_message(to_user_id,from_user_id,chat_message,timestamp,order_id)values('$created_by_id','$from_user_id','$chat_message',now(),'$order_id')");
}
  if(isset($_POST['ZIP']))
  {

    $dir = $_POST['folderToZip'];
    $zip_file = "Fotopia".$_POST['Order_ID'].".zip";

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

  }


?>


<?php include "header.php";  ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>
<style>
.scrollbar
{
	margin-left: -10px;
	float: left;
  height: 385px;
  width: 191px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}

.padding
{
	padding-right: 334px;
}

#wrapper
{
	text-align: center;
	width: 500px;
	margin: auto;
}

/*
 *  STYLE 1
 */

#style-1::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar
{
	width: 80px;
	background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
}
.modal {
  display: none;
  overflow: hidden;
  position: fixed;
  top: 178px;
  right: 680px;
  bottom: 0;
  left: 300px;
  z-index: 1050;
  -webkit-overflow-scrolling: touch;
  outline: 0;
}

</style>
<script>
function Getcomment(data)
{
  var a=data;
  var c=$("#s"+data).val();

  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
 doucument.getElementById("s"+c).value=a;
 }
};
xhttp.open("GET","comment.php?id="+a+"&data="+c, true);
xhttp.send();
alert("comment changed");



}
</script>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">

	   <?php include "sidebar.php";  ?>

                </div>


                <div class="col-md-8" >

<div class="tab-box" data-tab-anima="show-scale">
<ul class="nav nav-tabs nav-justified">
<li class="active"><a href="#">Order Detail</a></li>
<li><a href="#">Homeseller Info</a></li>
<li><a href="#">Finished Images </a></li>

<?php
$get_order_query1=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
$get_order1=mysqli_fetch_array($get_order_query1);
if($get_order1['status_id']==3)
{
  $approved_check_query=mysqli_query($con,"SELECT * FROM `invoice` where order_id=".$id_url);
  $approved_check=mysqli_fetch_assoc($approved_check_query);
     if($approved_check['approved']==1)
       echo '<li><a id="click5" href="#tab5" data-toggle="tab">Invoice</a></li>';
}
?>
<li><a href="#">Add ons </a></li>
</ul>
<div class="panel active">

  <h4 class="text-center">Order Details</h4>

  <?php if(@isset($_REQUEST["s"])) { ?>

                   <div class="text-success text-center"><i>Order Details Edited successfully</i></div>

  <?php } ?>
  <?php

  $get_order_query=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
  $get_order=mysqli_fetch_array($get_order_query);
  $home_sell_id=$get_order['home_seller_id'];
  ?>
            <table class="table table-condensed table-hover table-striped bootgrid-table" style="margin-left:10px;" aria-busy="false">
            <tbody>
        <?php /*?> <tr><th>ID</th><td>:</td><td><?php echo $res1['id']; ?></td></tr><?php */?>


          <tr><th style="width:420px;">Property Type</th><td>:</td><td><?php echo $get_order['property_type']; ?></td></tr>
         <tr><th>Number of floor plans</th><td>:</td><td><?php echo $get_order['number_of_floor_plans']; ?></td></tr>
          <tr><th>Area</th><td>:</td><td><?php echo $get_order['area']?></td></tr>
           <tr><th>Product</th><td>:</td><td><?php  $product_id_is=$get_order['product_id'];
           //$product=mysqli_query($con,"select sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value,GROUP_CONCAT(title) as title from products where id in ($product_id_is)");
            $product=mysqli_query($con,"select sum(total_price)+sum(photographer_cost)+sum(other_cost) as total_value,GROUP_CONCAT(product_title) as title from order_products where order_id='$id_url' and product_id in ($product_id_is)");
            $product_detail=mysqli_fetch_array($product);
            echo $product_detail['title'];
            ?></td></tr>
               <tr><th>Total Cost</th><td>:</td><td><?php echo "$".$product_detail['total_value']; ?></td></tr>

            <?php
            $photographer_id=$get_order['photographer_id'];
            $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
            $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
            $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
            ?>
           <tr><th>Photographer Name</th><td>:</td><td><?php echo $photographer_Name ?></td></tr>
            <tr><th>From Date & Time</th><td>:</td><td><?php echo $get_order['session_from_datetime']; ?></td></tr>
              <tr><th>To Date & Time</th><td>:</td><td><?php echo $get_order['session_to_datetime']; ?></td></tr>
            <tr><th>Due date </th><td>:</td><td><?php echo $get_order['order_due_date']; ?></td></tr>
            <tr><th>Booking Notes</th><td>:</td><td><?php echo $get_order['booking_notes']; ?></td></tr>
            <tr><th>Created By</th><td>:</td><td><?php echo $_SESSION["loggedin_name"]; ?></td></tr>
           <tr><th>Created On</th><td>:</td><td><?php echo $get_order['created_datetime']; ?></td></tr>

          </tbody>

              </table>


  <p align="right"> <a class="anima-button circle-button btn-sm btn adr-save"  href="Edit_appointment.php?id=<?php echo$id_url;?>"><i class="fa fa-arrow-right"></i>Edit/Reshedule Order</a></p>


</div>

<div class="panel">

  <h4 class="text-center">Home Seller Details</h4>

  <?php if(@isset($_REQUEST["a"])) { ?>

                   <div class="text-success text-center"><i>Home Seller Info Edited successfully</i></div>
                  <br>
  <?php } ?>

    <?php
    $home_sell_info_query=mysqli_query($con,"SELECT * FROM `home_seller_info` where id='$home_sell_id' ");
   $get_info=mysqli_fetch_array($home_sell_info_query);
    ?>
  <table class="table table-condensed table-hover table-striped bootgrid-table " style="margin-left:10px;"  aria-busy="false">
  <tbody>
  <?php /*?> <tr><th>ID</th><td>:</td><td><?php echo $res1['id']; ?></td></tr><?php */?>

  <tr ><th style="width:420px;">Name</th><td>:</td><td><?php echo $get_info['name']; ?></td></tr>
  <tr><th>Reference Number</th><td>:</td><td><?php echo $get_info['reference_number']; ?></td></tr>
  <tr><th>Address</th><td>:</td><td><?php echo $get_info['address']; ?></td></tr>
  <tr><th>Mobile number</th><td>:</td><td><?php echo $get_info['mobile_number']; ?></td></tr>
  <tr><th>Email</th><td>:</td><td><?php echo $get_info['email']?></td></tr>
  <tr><th>City</th><td>:</td><td><?php echo $get_info['city']; ?></td></tr>
  <tr><th>State</th><td>:</td><td><?php echo $get_info['state']; ?></td></tr>
  <tr><th>Zip</th><td>:</td><td><?php echo $get_info['zip']; ?></td></tr>
   <tr><th>Contact person name</th><td>:</td><td><?php echo $get_info['contact_person_name']; ?></td></tr>
  <tr><th>Contact person mobile </th><td>:</td><td><?php echo $get_info['contact_person_mobile']; ?></td></tr>
  <tr><th>Contact person email</th><td>:</td><td><?php echo $get_info['contact_person_email']; ?></td></tr>
  <!-- <tr><th>notes</th><td>:</td><td><?php echo $get_info['notes']; ?></td></tr> -->


  </tbody>

  </table>

  <p align="right"><a class="anima-button circle-button btn-sm btn adr-save"  href="Edit_order.php?id=<?php echo $id_url; ?>"><i class="fa fa-arrow-right"></i>Edit Home Seller Info</a></p>

</div>

<div class="panel">
  <!-- <script>
  var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
  </script> -->
  <p id="comment"></p>
<p align="right">  <input type="button" id="done_hide"  class="btn btn-primary" style="display:none;" onclick="done(<?php echo $id_url; ?>)"  value="Done"></p>

<?php

if (is_dir("./finished_images/order_".$id_url."/standard_photos")||is_dir("./finished_images/order_".$id_url."/floor_plans")||is_dir("./finished_images/order_".$id_url."/Drone_photos"))
{
 echo '<script>$("#done_hide").show();</script>';
}
?>
  <hr class="space s">

<h5 style="border-bottom:solid 2px #a94442;border-left:solid 12px #a94442;padding:10px">Standard Photos</h5>
<div class="maso-list gallery">
  <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;">
  <?php
  $imagesDirectory_standard = "./finished_images/order_".$id_url."/standard_photos";

  if (is_dir($imagesDirectory_standard))
  {
   $opendirectory = opendir($imagesDirectory_standard);


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

          <a class="img-box i-center" href="<?php echo $imagesDirectory_standard."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
              <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

              <img alt="" id="img" src="<?php echo $imagesDirectory_standard."/".$image; ?>" width="100" height="80"/>

          </a>
          <?php
          $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
          $get_comment=mysqli_fetch_assoc($get_comment_querry);

          ?>
          <div id="myModal<?php echo $get_comment['id'];?>" class="modal" style="">
            <!-- Modal content -->

            <div class="modal-content" style="height:260px;">
               <span class="close" onclick="document.getElementById('myModal<?php echo $get_comment['id'];?>').style='display:none'" style="margin: 10px;font-size: 25px;color: black;">&times;</span>

               <center> <img alt="" id="img" src="<?php echo $imagesDirectory_standard."/".$image; ?>" width="180" height="200" style="float:left;margin-left:40px;margin-right:40px"/></center>
               <div style="float: left;margin-right: 20px;border-left:1px solid #DDD;">
                 <?php
                 $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
                 $get_comment=mysqli_fetch_assoc($get_comment_querry);

                 ?>
         <textarea id="s<?php echo $get_comment['id'];?>"  rows="4" cols="35" style="margin-left:20px;margin-top:30px"><?php echo $get_comment['comments'];?></textarea>
         <hr class="space s">
             <center><input type="button" class="btn btn-primary" id="btn1" style=""  onclick="Getcomment('<?php echo $get_comment['id'];?>')" value="comment"/>&nbsp;&nbsp;&nbsp;<span class="hiddens"><input type="button" class="btn btn-primary" style="" onclick="Getstandard('<?php echo "./finished_images/order_".$id_url."/standard_photos"."/".$image;?>')" value="Rework"/></span></center>
               </div>
            </div>

          </div>
           <center class=""><input type="button" class="btn btn-primary btn-sm" id="myBtn" style="" onclick="document.getElementById('myModal<?php echo$get_comment['id'];?>').style='display:block'" value="Comment"/></center>





      </div>

      <?php

     }

    }

      closedir($opendirectory);
  }
  ?>
  <script>
  function Getstandard(data)
  {
    var a=data;
    var c=$("#getdata").val();
    alert(a);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
    {
    //  document.getElementById("drone_msg").innerHTML = this.responseText;
    }
    };
     xhttp.open("GET","rework.php?id="+a+"&od="+c, true);
     xhttp.send();
     location.reload();
  }
  </script>
  <?php
  $get_standard_comment_querry=mysqli_query($con,"select * from raw_images where order_id=$id_url and service_name=1");
  $get_Standard_comment=mysqli_fetch_assoc($get_standard_comment_querry);

  ?>
  <center><input type="text" id="comment1" placeholder="enter the comment " value="<?php echo $get_Standard_comment['comments'];?>" style="width: -webkit-fill-available;" /></center>
  <form name="zipDownload" method="post" action="">
  <input type="hidden" name="folderToZip" value="<?php echo "./finished_images/order_".$id_url."/standard_photos"; ?>">
  <input type="hidden" name="Order_ID" value="<?php echo $id_url; ?>">
  <input type="hidden" name="service_ID" value="<?php echo $service; ?>">

  <hr class="space s">

  <center><input type="submit" class="btn btn-primary" name="ZIP" id="zip_standard" value="ZIp and download all Images">&nbsp;<input type="button" class="btn btn-primary" name="send1" id="send1" value="send"></center>
  </form>

  <script>
  $('#comment1').keypress(function (e) {
  var key = e.which;
  if(key == 13)
  {
    var b=$("#order_id").val();
    var c=$("#comment1").val();
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
    //document.getElementById("demo").innerHTML = this.responseText;
   }
  };
  xhttp.open("GET","comment_all.php?id="+b+"&id1=1&comments="+c, true);
  xhttp.send();
  }
  });


  </script>

  <?php
   if(!is_dir($imagesDirectory_standard))
   {
    echo    "<p align='center' style='' ><b> No Images </b></p>";
    echo    "<script>$('#zip_standard').hide();$('#send1').hide();</script>";
    // echo count(glob($imagesDirectory_standard));
   }
  ?>

  </div>
  </div>
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

       if(($imgFileType == 'jpg') || ($imgFileType == 'png'))
       {
        ?>



        <div data-sort="1" class=" col-md-2 cat1" style="visibility: visible; height:fit-content; padding:20px;">

            <a class="img-box i-center" href="<?php echo $imagesDirectory_floor."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
                <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

                <img alt="" id="img" src="<?php echo $imagesDirectory_floor."/".$image; ?>" width="100" height="80"/>

            </a>
            <?php
            $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
            $get_comment=mysqli_fetch_assoc($get_comment_querry);

            ?>
            <div id="myModal<?php echo $get_comment['id'];?>" class="modal" style="">
              <!-- Modal content -->

              <div class="modal-content" style="height:260px;">
                 <span class="close" onclick="document.getElementById('myModal<?php echo $get_comment['id'];?>').style='display:none'" style="margin: 10px;font-size: 25px;color: black;">&times;</span>

                 <center> <img alt="" id="img" src="<?php echo $imagesDirectory_floor."/".$image; ?>" width="180" height="200" style="float:left;margin-left:40px;margin-right:40px"/></center>
                 <div style="float: left;margin-right: 20px;border-left:1px solid #DDD;">
                   <?php
                   $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
                   $get_comment=mysqli_fetch_assoc($get_comment_querry);

                   ?>
           <textarea id="s<?php echo $get_comment['id'];?>"  rows="4" cols="35" style="margin-left:20px;margin-top:30px"><?php echo $get_comment['comments'];?></textarea>
           <hr class="space s">
               <center><input type="button" class="btn btn-primary" id="btn1" style=""  onclick="Getcomment('<?php echo $get_comment['id'];?>')" value="comment"/>&nbsp;&nbsp;&nbsp;<span class="hiddens"><input type="button" class="btn btn-primary" style="" onclick="Getfloor('<?php echo "./finished_images/order_".$id_url."/floor_plans"."/".$image;?>')" value="Rework"/></span></center>
                 </div>
              </div>

            </div>
             <center class=""><input type="button" class="btn btn-primary btn-sm" id="myBtn" style="" onclick="document.getElementById('myModal<?php echo $get_comment['id'];?>').style='display:block'" value="Comment"/></center>

        </div>

        <?php

       }

      }

        closedir($opendirectory);
    }
    ?>
    <script>
    function Getfloor(data)
    {
      var a=data;
      var c=$("#getdata").val();
      alert(a);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
      {
      //  document.getElementById("drone_msg").innerHTML = this.responseText;
      }
      };
       xhttp.open("GET","rework.php?id="+a+"&od="+c, true);
       xhttp.send();
       location.reload();
    }
    </script>
    <?php
    $get_floor_comment_querry=mysqli_query($con,"select * from raw_images where order_id=$id_url and service_name=2");
    $get_floor_comment=mysqli_fetch_assoc($get_floor_comment_querry);

    ?>
        <center><input type="text" id="comment2"  value="<?php echo $get_floor_comment['comments']; ?>"placeholder="enter the comment " style="width: -webkit-fill-available;" /></center>
    <form name="zipDownload" method="post" action="">
    <input type="hidden" name="folderToZip" value="<?php echo "./finished_images/order_".$id_url."/floor_plans"; ?>">
    <input type="hidden" name="Order_ID" id="getdata" value="<?php echo $id_url; ?>">
    <input type="hidden" name="service_ID" value="<?php echo $service; ?>">
    <hr class="space s">

   <center><input type="submit" class="btn btn-primary done" name="ZIP" id="zip_floor" value="ZIp and download all Images">&nbsp;<input type="button" class="btn btn-primary" name="send2" id="send2" value="send"></center>
    </form>

    <script>
    $('#comment2').keypress(function (e) {
    var key = e.which;
    if(key == 13)
    {

      var b=$("#order_id").val();
      var c=$("#comment2").val();
      alert(c);
      alert(b);

      var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("demo").innerHTML = this.responseText;
     }
    };
    xhttp.open("GET","comment_all.php?id="+b+"&id1=2&comments="+c, true);
    xhttp.send();
    }
    });


    </script>


    <?php
     if(!is_dir($imagesDirectory_floor)) {
      echo    "<p align='center' style='' ><b> No Images </b></p>";
      echo    "<script>$('#zip_floor').hide();$('#send2').hide();</script>";
    }

    ?>

    </div>
    </div>
  <hr class="space l">
<h5 style="border-bottom:solid 2px #357d8f;border-left:solid 12px #357d8f;padding:10px">Drone Photos</h5>
<hr>
<div id="drone_msg"></div>
<div class="maso-list gallery">
  <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;">
  <?php
  $imagesDirectory_Drone = "./finished_images/order_".$id_url."/Drone_photos";

  if (is_dir($imagesDirectory_Drone))
  {
   $opendirectory = opendir($imagesDirectory_Drone);


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

          <a class="img-box i-center" href="<?php echo $imagesDirectory_Drone."/".$image; ?>" data-anima="show-scale" data-trigger="hover" data-anima-out="hide" style="opacity: 1;">
              <i class="fa fa-photo anima" aid="0.22880302434786803" style="transition-duration: 500ms; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms; opacity: 0;"></i>

              <img alt="" id="img" src="<?php echo $imagesDirectory_Drone."/".$image; ?>" width="100" height="80"/>

          </a>
          <?php
          $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
          $get_comment=mysqli_fetch_assoc($get_comment_querry);

          ?>
          <div id="myModal<?php echo $get_comment['id'];?>" class="modal" style="">
            <!-- Modal content -->

            <div class="modal-content" style="height:260px;">
               <span class="close" onclick="document.getElementById('myModal<?php echo $get_comment['id'];?>').style='display:none'" style="margin: 10px;font-size: 25px;color: black;">&times;</span>

               <center> <img alt="" id="img" src="<?php echo $imagesDirectory_Drone."/".$image; ?>" width="180" height="200" style="float:left;margin-left:40px;margin-right:40px"/></center>
               <div style="float: left;margin-right: 20px;border-left:1px solid #DDD;">
                 <?php
                 $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=$id_url and img='$image'");
                 $get_comment=mysqli_fetch_assoc($get_comment_querry);

                 ?>
         <textarea id="s<?php echo $get_comment['id'];?>"  rows="4" cols="35" style="margin-left:20px;margin-top:30px"><?php echo $get_comment['comments'];?></textarea>
         <hr class="space s">
             <center><input type="button" class="btn btn-primary" id="btn1" style=""  onclick="Getcomment('<?php echo $get_comment['id'];?>')" value="comment"/>&nbsp;&nbsp;&nbsp;<span class="hiddens"><input type="button" class="btn btn-primary" style="" onclick="Getdrone('<?php echo "./finished_images/order_".$id_url."/Drone_photos"."/".$image;?>')" value="Rework"/></span></center>
               </div>
            </div>

          </div>
           <center class=""><input type="button" class="btn btn-primary btn-sm" id="myBtn" style="" onclick="document.getElementById('myModal<?php echo$get_comment['id'];?>').style='display:block'" value="Comment"/></center>
      </div>



      <?php

     }

    }

    closedir($opendirectory);
}


?>
<script>
function Getdrone(data)
{
  var a=data;
  var c=$("#getdata").val();
  alert(a);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200)
  {
  //  document.getElementById("drone_msg").innerHTML = this.responseText;
  }
  };
   xhttp.open("GET","rework.php?id="+a+"&od="+c, true);
   xhttp.send();
   location.reload();
}
</script>
<?php
$get_drone_comment_querry=mysqli_query($con,"select * from raw_images where order_id=$id_url and service_name=3");
$get_drone_comment=mysqli_fetch_assoc($get_drone_comment_querry);

?>
<center><input type="text" id="comment3" value="<?php echo $get_drone_comment['comments']; ?>" placeholder="enter the comment " style="width: -webkit-fill-available;" /></center>
<form name="zipDownload" method="post" action="">
<input type="hidden" name="folderToZip" value="<?php echo "./finished_images/order_".$id_url."/Drone_photos"; ?>">
<input type="hidden" name="Order_ID" value="<?php echo $id_url; ?>">
<input type="hidden" name="service_ID" value="<?php echo $service; ?>">
<hr class="space s">
<center><input type="submit" class="btn btn-primary" name="ZIP" id="zip_Drone" value="ZIp and download all Images" />&nbsp;<input type="button" class="btn btn-primary" name="send3" id="send3" value="send" /></center>
</form>
<script>
$('#comment3').keypress(function (e) {
var key = e.which;
if(key == 13)
{
  var b=$("#order_id").val();
  var c=$("#comment3").val();
  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
  //document.getElementById("demo").innerHTML = this.responseText;
 }
};
xhttp.open("GET","comment_all.php?id="+b+"&id1=3&comments="+c, true);
xhttp.send();
}
});


</script>

<?php
if(!is_dir($imagesDirectory_Drone)) {
  echo    "<p align='center' style='' ><b> No Images </b></p>";
  echo    "<script>$('#zip_Drone').hide();$('#send3').hide();</script>";
}
?>
<script>
 function done(order_id)
  {
   if(confirm("order completed"))
   {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200)
   {
   //  document.getElementById("drone_msg").innerHTML = this.responseText;
   }
   };
    xhttp.open("GET","done.php?id="+order_id, true);
    xhttp.send();
    window.location.href = "order_list.php";
  }
   }
</script>



  </div>
  </div>
<br>
<br>
<!-- <?php

$get_order_query1=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
$get_order1=mysqli_fetch_array($get_order_query1);
if($get_order1['status_id']==3)
{
  echo '<script>$(".hiddens").hide();</script>';
}
?> -->

</div>
<div class="panel" id="tab4">

<form action="" method="GET" align="center">
<input class="search-field" id="search" type="text" placeholder="Type here" value="<?php echo $get_info['address']; ?>">
<input id="submit" type="submit" value="Search">
</form>

<hr class="space" />

</div>
<div class="panel" id="tab5">
  <div id="printtable"></div>
    <div id="print">
      <link rel="stylesheet" href="./css/style_invoice.css">
      <header id="inv_header" >
        <?php

        {

        }


        ?>
        <h1 id="inv_h1" style="font-size:50px; text-align: center;">INVOICE</h1><p align="right"><a class="anima-button circle-button btn-sm btn adr-save" style="position: relative;margin-top: -100px;color:white;" onclick="printPage()"><i class="fa fa-print"></i>Print</a></p>

        <hr class="space s">
        <table style="margin-left : 30px;padding-left : 30px;">

          <tr>
            <th>
              <p style="font-size:14px"><strong>ORDER NO.</strong><br></p>
            </th>
            <th>
              <p style="font-size:14px; margin-left : 50px;
       padding-left : 50px;"><strong> DATE OF ISSUE </strong><br></p>
            </th>
          </tr>
          <tr>
            <td>
              <p style="font-size:11px;text-align:center;"> <?php echo $get_info['id']; ?></p>
            </td>
            <td>
              <p style="font-size:11px;margin-left : 50px;
       padding-left : 50px;"> <?php echo date("d/m/y"); echo " ("; echo date("h:i:a"); echo ")"; ?></p>
            </td>
          </tr>
        </table>

        <table style="margin-left : 30px;
       padding-left : 30px;">

          <?php
              $id_fetch=mysqli_query($con,"SELECT * FROM home_seller_info where id='$home_sell_id'");
              $get_id=mysqli_fetch_array($id_fetch);

              if ($get_id['lead_from'] == "realtor") {
              ?>
              <tr><th><p style="font-size:14px"><strong> BILLED TO </strong><br></p></th></tr>
              <tr>
                <th><p style="font-size:11px"><strong><?php  echo $get_id['request_name']; ?> </strong><br></p> </th> </tr>
                <tr><td><p style="font-size:11px"> <?php  echo $get_id['request_address']; ?></p></td></tr>
                <tr><td><p style="font-size:11px"> <?php   echo $get_id['request_email']; ?><br></p></td></tr>
           <tr><td><p style="font-size:11px"> <?php  echo $get_id['request_contact_no']; ?></p></td></tr>




              <?php

              }

              elseif ($get_id['lead_from'] == "homeseller") {
                ?>
                <tr><th><p style="font-size:14px"><strong> BILLED TO </strong><br></p></th></tr>
                <tr>
                  <th><p style="font-size:11px"><strong><?php  echo $get_id['name']; ?> </strong><br></p></th></tr>
                 <tr> <td><p style="font-size:11px"> <?php   echo $get_id['address']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px"> <?php   echo $get_id['city']; echo " , "; echo $get_id['state']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px"> <?php  echo "Zip Code : "; echo $get_id['zip']; ?><br></p></td></tr>




              <?php

              }

              else {
                 $created_Nam=$_SESSION["loggedin_id"];
                $get_created_name_query=mysqli_query($con,"SELECT * FROM user_login where id=".$created_Nam);
                $get_name_create=mysqli_fetch_assoc($get_created_name_query);
                ?>

                <tr><th><p style="font-size:14px"><strong> BILLED TO </strong></p></th></tr>
                <tr>
                  <th><p style="font-size:11px"><strong><?php  echo $get_name_create["first_name"]." ".$get_name_create["last_name"]?> </strong><br></p></th></tr>
                  <tr><td><p style="font-size:11px"> <?php   echo $get_name_create['address_line1']; echo " , ";
                  echo $get_name_create['address_line2']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px"> <?php   echo $get_name_create['city']; echo " , "; echo $get_name_create['state']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px"> <?php  echo "Zip Code : "; echo $get_name_create['postal_code']; ?><br></p></td></tr>
                  <br>


                <?php
              }

           ?>
          </table>

      <br/><br/>
          <table style="margin-left: 27.7%;
    padding-left: 55.7%;
    margin-top: -16.7%;">
          <div >
          <?php

    $get_order_query=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
    $get_order=mysqli_fetch_array($get_order_query);

    ?>

    <?php
              $photographer_id=$get_order['photographer_id'];
              $get_photographer_info=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
              $get_information=mysqli_fetch_assoc($get_photographer_info);
              $photographer_Name=$get_information["first_name"]."".$get_information["last_name"];
              ?>
  <tr><th><p style="font-size:14px"><strong> PHOTOGRAPHER </strong><br></p></th></tr>
  <tr><th><p style="font-size:11px"><strong><?php  echo $photographer_Name ?> </strong><br></p></th></tr>
  <tr><td><p style="font-size:11px" > <?php   echo $get_information['address_line1']; echo " , "; echo $get_information['address_line2']; ?></p></td></tr>
  <tr><td><p style="font-size:11px" > <?php   echo $get_information['city']; echo " , "; echo $get_information['state']; ?><br></p></td></tr>
  <tr><td><p style="font-size:11px" > <?php  echo "Zip Code : "; echo $get_information['postal_code']; ?><br></p></td></tr>





        </div>
        </table>




      </header>
      <article>


        <br>
        <br>

        <table id="inv_table1" class="inventory"  style="width:100%">
          <thead>
            <tr>
              <th id="inv_th" style="width:60% ;margin-left : 10px;
       padding-left : 10px;"><span > PRODUCTS DESCRIPTION</span></th>
              <th id="inv_th" style="width:10% ;text-align: center;"><span >COSTS</span></th>
              <th id="inv_th" style="width:15%;text-align: center;"><span >OTHER COSTS</span></th>
              <th id="inv_th" style="width:15%;text-align: center;"><span >TOTAL COSTS</span></th>
            </tr>
          </thead>
          <tbody>
            <tr >
              <td id="inv_td" style="margin-left : 10px;
       padding-left : 10px;" ><span ><?php  $product_id_is=$get_order['product_id'];
                               $product=mysqli_query($con,"select sum(total_price)+sum(photographer_bata)+sum(other_cost) as total_value,GROUP_CONCAT(title) as title from products where id in ($product_id_is)");
                                $product_detail=mysqli_fetch_array($product);
                                $title_split = $product_detail['title'];
                                $splited_title =  explode(',',$title_split);
                                foreach($splited_title as $new_title)
                                {
                                    echo $new_title; ?> <br/><?php
                                }?>

                                </span></td>
            <td id="inv_td" style="text-align:center;"><span data-prefix></span><span><?php
              $product_id_split=$get_order['product_id'];
             $var=explode(',',$product_id_split);
             foreach($var as $row)
              {

              $price=mysqli_query($con,"SELECT * FROM products where id='$row'");
              $get_price_info=mysqli_fetch_assoc($price);
             $total_cost=$get_price_info["total_price"];
             echo "$".$total_cost; ?> <br/><?php

              }

      ?></span></td>
            <td id="inv_td" style="text-align:center;"><span data-prefix></span><span><?php
              $product_id_split=$get_order['product_id'];
             $var=explode(',',$product_id_split);
             foreach($var as $row)
              {

              $price=mysqli_query($con,"SELECT * FROM products where id='$row'");
              $get_price_info=mysqli_fetch_assoc($price);
             $total_cost=$get_price_info["other_cost"];
             echo "$".$total_cost; ?> <br/><?php

              }

      ?></span></td>

              <td id="inv_td" style="text-align:center;"><span data-prefix></span><span><?php
              $product_id_split=$get_order['product_id'];
             $var=explode(',',$product_id_split);
             foreach($var as $row)
              {

              $price=mysqli_query($con,"SELECT * FROM products where id='$row'");
              $get_price_info=mysqli_fetch_assoc($price);
             $total_cost=$get_price_info["total_price"] + $get_price_info["other_cost"];
             echo "$".$total_cost; ?> <br/><?php

              }

      ?></span></td>
            </tr>
            <tr>
      <td id="inv_th" colspan="3" style="text-align: center;"><span >Total Price</span></td>
      <td id="inv_td" style="text-align: center;"><span data-prefix>$</span><span><?php echo $product_detail['total_value']; ?></span></td>
    </tr>
          </tbody>
        </table>


      </article>
      <br/><br/>
  <table style="margin-left : 10px;
       padding-left : 10px;">
    <tr>
      <th><p>Terms and condtions </p></th>
    </tr>
    <td><p>E.g. Please pay invoice by MM/DD/YYYY</p></td>
  </table>

    </div>
    <script>
    function printPage()
    {
      var tableData =document.getElementById('print').innerHTML;
      var data = '<button onclick="window.print()">Print this page</button>'+tableData;
      myWindow=window.open('','','width=800,height=600');
      myWindow.innerWidth = screen.width;
      myWindow.innerHeight = screen.height;
      myWindow.screenX = 0;
      myWindow.screenY = 0;
      myWindow.document.write(data);
      myWindow.focus();
};

  </script>

</div>


</div>
  </div>
  <div class="col-md-2" style="border:solid 2px #000;padding:10px;height:497px">
  <p style="color:#000080;font-weight:600;padding-bottom:10px;" align="center"> Chat with <b> <?php

  $realtor1=mysqli_query($con,"select * from user_login where id='$photographer_id'");
  $realtor=mysqli_fetch_array($realtor1);
    echo $realtor["first_name"];  ?></p>
  <div id="wrapper">
  <div class="scrollbar" id="style-default">
  <table class="force-overflow table table-striped" id="ChatBox" style="border:solid 1px #000080;">

  </table>
</div>
</div>
  <input type="hidden" name="created_by_id" id="created_by_id" value="<?php echo $get_order["created_by_id"]; ?>" />
   <input type="hidden" name="order_id" id="order_id" value="<?php echo $get_order["id"]; ?>" />
   <input type="hidden" name="logged_id" id="logged_id" value="<?php echo $_SESSION["loggedin_id"]; ?>" />
  <input type="text" name="chattext" id="chattext1" placeholder="Type your msg, hit enter" required />


  </div>
  <script>

  $('#chattext1').keypress(function (e) {
 var key = e.which;
 if(key == 13)
  {
    var a=$("#created_by_id").val();
    var b=$("#order_id").val();
    var c=$("#logged_id").val();
    var d= $("#chattext1").val();
    var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
    //document.getElementById("demo").innerHTML = this.responseText;
   }

 };
 xhttp.open("GET","insert_chat.php?created_by_id="+a+"&logged_id="+c+"&chattext="+d+"&order_id="+b, true);
 xhttp.send();
 viewchat();

  }
});

function viewchat()
{
  var b=$("#order_id").val();
  var c=$("#logged_id").val();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("ChatBox").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET","view_chat.php?id="+b+"&id1="+c, true);
  xhttp.send();
}

//   $(document).ready(function() {
// InitOverviewDataTable();
// setTimeout(function() {
//    AutoReload();
// }, 30000);
// });
//
// function AutoReload
// {
// var getit=$("#ChatBox").html();
// }
  </script>
    <script>viewchat();</script>
  </div>
	</div>
	</div>
</div>



		<?php include "footer.php";  ?>
