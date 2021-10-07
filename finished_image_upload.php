<?php
include "connection.php";

?>

<?php
$order_id=@$_REQUEST["id"];
$type1=@$_REQUEST["type"];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($order_id,$con)
{
	/* Exception class. */
	require 'C:\PHPMailer\src\Exception.php';

	/* The main PHPMailer class. */
	require 'C:\PHPMailer\src\PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'C:\PHPMailer\src\SMTP.php';


	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = $_SESSION['emailHost'];
	$mail->SMTPAuth = true;
	// //paste one generated by Mailtrap
	// //paste one generated by Mailtrap
	$mail->Username =$_SESSION['emailUserID'];
	$mail->Password =$_SESSION['emailPassword'];
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	//From email address and name
	 $mail->From = $_SESSION['emailUserID'];
	 $mail->FromName = "Fotopia";

  $order_id=$order_id;
 	$get_orderdetail_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
 	$get_detail=mysqli_fetch_array($get_orderdetail_query);
 	$pc_admin_id=$get_detail['pc_admin_id'];
  $get_pcadmin_profile_query=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
  $get_profile=mysqli_fetch_assoc($get_pcadmin_profile_query);
  $pcadmin_email=$get_profile['email'];
  $pcadmin_contact=$get_profile['contact_number'];
 	$get_pcadmindetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin_id'");
 	$get_pcadmindetail=mysqli_fetch_assoc($get_pcadmindetail_query);
 	$PCAdmin_email=$get_pcadmindetail['email'];
 	$photographer_id=@$get_detail['photographer_id'];
 	$get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
 	$get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
 	$photographer_email=@$get_name["email"];
 	$csr_id=$get_name['csr_id'];
 	$get_csrdetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$csr_id'");
 	$get_csrdetail=mysqli_fetch_assoc($get_csrdetail_query);
 	$csr_email=$get_csrdetail['email'];
  $realtor_id=$get_detail['created_by_id'];
  $get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtor_id'");
  $get_realtor_name=mysqli_fetch_assoc($get_realtor_name_query);
  $realtor_email=$get_realtor_name['email'];
  $get_template_query=mysqli_query($con,"select * from email_template where pc_admin_id='$pc_admin_id' and template_title='Finished Images Upload'");
  $get_template=mysqli_fetch_array($get_template_query);
  $finished_image_upload_template=$get_template['template_body_text'];

  if($get_detail['created_by_type']=="Realtor")
  {
  $mail->addAddress($realtor_email);
  $mail->addCC($PCAdmin_email);
  $mail->addCC($csr_email);
  $mail->addCC($photographer_email);
  }
  else{
    $mail->addAddress($PCAdmin_email);
    $mail->addCC($csr_email);
    $mail->addCC($photographer_email);
  }
	$mail->addReplyTo("test.deve@adrgrp.com", "Reply");
	$mail->isHTML(true);

	$mail->Subject = "Finished Images Uploaded";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">FINISHED IMAGES UPLOADED</td>
  <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";

	$mail->Body.=$finished_image_upload_template;
  $mail->Body.="</br>Kindly check the order #{{Order_ID}} in your orders page for details</br>
Thank you for continued support.
 <br><br>
Thanks,<br>
Fotopia Team.";
 $mail->Body=str_replace('{{Order_ID}}',$order_id, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";


	 // echo $mail->Body;
	 // exit;



	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		// echo $e->getMessage();
	  //   echo "Mailer Error: " . $mail->ErrorInfo;
	}
}


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
  $type=@$_REQUEST['type'];
  $split=explode("/",$_SERVER["HTTP_REFERER"]);
  $url=$split[0]."//".$split[2]."/".$split[3]."/download_raw_images.php?secret_code=".$secret_code;
  $SESSION=$_SESSION["loggedin_id"];
  $photographer_id=$SESSION;
  $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
  $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
  $photographer_Name=$get_name["first_name"]."".$get_name["last_name"];
  $count=0;
  $check_link=mysqli_query($con,"select * from raw_images where order_id=$order_id and service_name=$type");
  $count=mysqli_num_rows(@$check_link);
  if(@$count==0)
  {
  $query="INSERT INTO `raw_images`(`images_url`, `security_code`, `order_id`,  `sent_by`, `sent_on`, `status`,`service_name`) VALUES ('$url','$secret_code',$order_id,$SESSION,now(),6,$type)";
  $insert=mysqli_query($con,$query);
  }
  // email($secret_code,$photographer_Name,$editor_email,$id_url);

    email($order_id,$con);

  header("location:preview3.php?id=".$order_id."&type=". $type);
  }
  ?>
  	<?php include "header.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>
<script src="dropzone/dropzone.js"></script>
<script src="dropzone/validate.js"></script>

<link rel="stylesheet" href="dropzone/dropzone.css">
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
    <form action="./dropzone/upload1.php?id=<?php echo $order_id; ?>&type=<?php echo $type1;?>&user_id=<?php echo $_SESSION['loggedin_id'];?>&user_type=<?php echo $_SESSION['user_type'];?>" id='uploads' class="dropzone" style="100px">

     <span id="drop_files"></span>
     </form>
      <script>
       $(document).ready(function() {
         $("#drop_files").html("<br/><h3> Click to Upload </h3>");
         $("#drop_files").css('text-align', 'center');
         $("<div><p align='center'><img src='./dropzone/upload-icon.png' class='img-rounded' height='30px'  id='icon'></p></div>").insertAfter("#drop_files");
       });

     </script>
        <a href="preview3.php?id=<?php echo $order_id?>&type=<?php echo $type1?>&send=1" class="btn btn-primary" style="background: black;float:left" adr_trans="label_preview">preview</a><p align="right"><a href="#" id="edit_button" class="btn btn-primary" style="background: black;position: relative; " adr_trans="label_upload">Upload</a></p>

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
       $("#error1").html("<center><h5 class='text-success'>please choose upload photos</h5></center>");
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
 xhttp.open("GET","./editor_update.php?id="+od+"&type="+type,true);
 xhttp.send();
 }
 </script>
 </div>
</div>

</div>
</div>
</div>




<?php include "footer.php"; ?>
