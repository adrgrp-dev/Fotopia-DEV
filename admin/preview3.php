<?php
include "connection1.php";
include "header.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>
<script src="../dropzone/dropzone.js"></script>
<script src="../dropzone/validate.js"></script>
<style>
.mfp-container

{

background:#000 !important;
opacity:1!important;

}
</style>

<link rel="stylesheet" href="../dropzone/dropzone.css">
 <div class="section-empty bgimage9">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>
</div>
                <div class="col-md-8" style="background: white;border-radius: 5px;margin-top: 23px;padding: 10px;">
                  <br>

                  <a href="#" id="send" class="btn adr-save btn-sm"  style="margin-top: -10px;float: right;"><span adr_trans="label_send">send</span></a>
                  <center><h5 adr_trans="label_preview_and_naming">Preview And Naming</h5></center>

  <?php
     $id_url=$_REQUEST["id"];

  ?>
  <div class="maso-list gallery" style="margin-top: 20px;height:550px;overflow:scroll;">
    <div class="maso-box row no-margins" data-options="anima:fade-in" style="position: relative;margin-left: 7%;">
      <?php


         if(  $_REQUEST["type"]==1)
         {
           $service="standard_photos";
         }
         elseif(  $_REQUEST["type"]==2)
         {
            $service="floor_plans";
         }
         elseif( $_REQUEST["type"]==3) {
             $service="Drone_photos";
         }
         else {
           $service="HDR_photos";
         }


      $imagesDirectory = "../finished_images/order_".$id_url."/".$service;

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

                          <img alt="" src="<?php echo "../finished_images/order_".$id_url."/".$service."/".$image; ?>" width="240" height="180"/>
                      </a>
                      <?php
                      $get_comment_querry=mysqli_query($con,"SELECT * FROM `image_naming` WHERE order_id=$id_url and image_name='$image'");
                      $get_comment=mysqli_fetch_assoc($get_comment_querry);

                       $hdrpicCount=mysqli_num_rows($get_comment_querry);
                      
                       if(strpos($get_comment['description'],".")!=0)
                       {
                          $previewvalue="";
                       }
                       else{
                           $previewvalue=$get_comment['description'];
                       }
                      ?>
                      <input type="text" list="pic_type3" class="form-control stdImg"  id="myBtn<?php echo $get_comment['id']; ?>" value="<?php echo $previewvalue; ?>" style="width:webkit-fill-available;margin-top:10px;font-size: 12px;height: 30px;" onchange="myFunction(event,<?php echo  $get_comment['id'];?>,'<?php echo $service ?>')" required placeholder="Name the pic"/>
                      <datalist id="pic_type3" />


             <option value="">choose your description</option>
           <?php
             $description_query=mysqli_query($con,"SELECT * FROM `image_interior_exterior_name` ");
             while($description=mysqli_fetch_array($description_query))
             {
               ?>
               <option value="<?php echo $description['name'];?>" <?php if($get_comment['description']== $description['name']) {echo "selected";}?>><?php echo $description['name'];?></option>
       <?php  }?>
     </datalist>
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
                    xhttp.open("GET","../description.php?id="+data+"&id1="+a+"&type="+type+"&user=adminfinish", true);
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


   </div>

 </div>
  
</div>



</div>
</div>
</div>

<script>
$('#send').on('click', function (event) {
$(".stdImg").each(function(){

    if($.trim($(this).val()) === '') {
        alert('Please fill the naming for each image Photos.');
    exit(0);


    }
  });
 window.location='superOrder_detail.php?ff=1&id=<?php echo $id_url; ?>';
});


$('.stdImg').on('keypress', function (event) {
  var keyCode = (event.keyCode ? event.keyCode : event.which);
if (keyCode == 13) {
$(".stdImg").each(function(){

    if($.trim($(this).val()) === '') {
      $(this).css("border","solid 5px red");
      $(this).focus();
        // alert('Please fill the naming for each image in Standard Photos.');
    exit(0);
    return false;

    } else {
          $(this).css("border","none");

  return true;
        //console.log('Everything has a value.');
      }
    });
  }});
</script>

 <?php include "footer.php";  ?>
