<?php
include "connection1.php";

?>

<?php
$order_id=@$_REQUEST["id"];
$type1=@$_REQUEST["type"];


function getName($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

if(isset($_REQUEST['send']))
{
  $secret_code=getName(16);
  // $editor_email=@$_REQUEST["floor_email"];
  $type1=@$_REQUEST['type'];
  $split=explode("/",$_SERVER["HTTP_REFERER"]);
  $url=$split[0]."//".$split[2]."/".$split[3]."/download_raw_images.php?secret_code=".$secret_code;

  $get_admin_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$admin_users_id'");
  $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
  $admin_Name=$get_name["first_name"]."".$get_name["last_name"];
  $query="INSERT INTO `raw_images`(`images_url`, `security_code`, `order_id`,`sent_on`, `status`,`service_name`) VALUES ('$url','$secret_code',$order_id,now(),6,$type1)";
  $insert=mysqli_query($con,$query);
  // email($secret_code,$photographer_Name,$editor_email,$id_url);
  header("location:preview3.php?id=".$order_id."&type=". $type1);
  }
  ?>
  	<?php include "header.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>
<script src="../dropzone/dropzone.js"></script>
<script src="../dropzone/validate.js"></script>

<link rel="stylesheet" href="../dropzone/dropzone.css">
 <div class="section-empty bgimage9">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


</div>
<div class="col-md-10">
  <div id="standard_photos_div" >
        <div id="error1" ></div>
    <form action="../dropzone/upload1.php?id=<?php echo $order_id; ?>&type=<?php echo $type1;?>&user_id=<?php echo $_SESSION['admin_loggedin_id'];?>&user_type=<?php echo $_SESSION['admin_loggedin_type'];?>" id='uploads' class="dropzone" style="100px">

     <span id="drop_files"></span>
     </form>
      <script>
       $(document).ready(function() {
         $("#drop_files").html("<br/><h3 adr_trans='label_click_to_upload'> Click to Upload </h3>");
         $("#drop_files").css('text-align', 'center');
         $("<div><p align='center'><img src='../dropzone/upload-icon.png' class='img-rounded' height='30px'  id='icon'></p></div>").insertAfter("#drop_files");
       });

     </script>
        <a href="preview3.php?id=<?php echo $order_id?>&type=<?php echo $type1?>&send=1" class="btn btn-primary" style="float:left"><span adr_trans="label_preview">preview</span></a><p align="right"><a href="#" id="edit_button" class="btn btn-primary" style="position: relative; "><span adr_trans="label_upload">Upload</span></a></p>

      <input type="hidden"  id="order_id"  value="<?php echo $order_id?>"/>
       <input type="hidden"  id="service_name"  value="<?php echo $type1?>"/>
 <script>
 $("#edit_button").click(function(){
     var c=document.getElementsByClassName('dz-preview dz-processing dz-image-preview dz-success dz-complete').length;

     if(c!=0)
     {
     ajax();
     window.location='<?php echo "finished_image_upload.php?id=".$order_id."&type=". $type1?>&send=1';
     }
     else {
           $("#error1").html("<center><h5 class='text-success' adr_trans='label_choose_upload_photos'>please choose upload photos</h5></center>");
     }


 });
 function ajax()
 {
   var od=$("#order_id").val();
   var type=$("#service_name").val();

  // console.log(od);
   var xhttp= new XMLHttpRequest();

   xhttp.onreadystatechange = function()
   {
   if(this.readyState == 4 && this.status == 200){

    $("#view_msg").html(this.responseText);
   }
 };
 xhttp.open("GET","../editor_update.php?id="+od+"&type="+type,true);
 xhttp.send();
 }
 </script>
 </div>
</div>

</div>
</div>
</div>




<?php include "footer.php"; ?>
