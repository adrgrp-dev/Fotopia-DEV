<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_REQUEST['email']))
{
  $realtor_id = $_SESSION['loggedin_id'];

$realtor_full_name=mysqli_query($con,"SELECT * FROM `user_login` WHERE id=$realtor_id");
$realtor_full_name1=mysqli_fetch_array($realtor_full_name);

  $realtor_name=$realtor_full_name1['first_name'].' '.$realtor_full_name1['last_name'];

  $email=$_REQUEST['email'];

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
    $mail->Port = $_SESSION['emailPort'];
    //$mail->Port = 465;
    //From email address and name
    $mail->From = $_SESSION['emailUserID'];
    $mail->FromName = "Fotopia";

    //To address and name
    // ;
    // // //Recipient name is optional
    // //;
    // ;
     $mail->addAddress($_REQUEST['email']);


    //Address to which recipient will reply
    $mail->addReplyTo($_SESSION['emailUserID'], "Reply");

    //CC and BCC
    //$mail->addCC("cc@example.com");
    //$mail->addBCC("bcc@example.com");

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Invitation to join Fotopia";
    $mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Invitation to join Fotopia</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
    //$mail->AltBody = "This is the plain text version of the email content";
    $mail->Body.="Hello {{receiver_email}},<br><br>

   You have been invited by {{realtor_name}} to join Fotopia.<br><br>
  <a href='{{link}}'
  target='_blank'>Click here</a> to register with Fotopia application.

  <br><br>
  Thanks,<br>
  Fotopia Team.
  ";
    // $mail->Body=str_replace('{{secret_code}}', $v , $mail->Body);
    // $link=explode('?',$_REQUEST['link1']);
    $link1=$_SESSION['project_url']."signup.php";
    $mail->Body=str_replace('{{link}}', $link1 , $mail->Body);
    // $mail->Body=str_replace('{{Photographer_Name}}', $x , $mail->Body);
    // $mail->Body=str_replace('F{{orderId}}',$z, $mail->Body);
      $mail->Body=str_replace('{{receiver_email}}',$_REQUEST['email'], $mail->Body);
      $mail->Body=str_replace('{{realtor_name}}',$realtor_name, $mail->Body);
    $mail->Body.="<br><br></td></tr></table></html>";
    // echo $mail->Body;exit;
    // exit;
    try {
        $mail->send();
        //echo "Message has been sent successfully";
    } catch (Exception $e) {
      echo $e->getMessage();
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

// echo $mail->Body;
// exit;


}



?>


<style>


.icon-box-cell:hover {
  /* Safari 3-4, iOS 1-3.2, Android 1.6- */
  -webkit-border-radius: 120px;

  /* Firefox 1-3.6 */
  -moz-border-radius: 120px;

  /* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
  border-radius: 120px;

  text-align:center;padding:5px;background:#000099; width:fit-content;
  padding-left:12px;padding-right:12px;
}
#mySidenav a {
  position: absolute;

  transition: 0.3s;
  width:fit-content;
  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 0 5px 5px 0;
}

#mySidenav a:hover {
  left: 0;
}
#mySidenav a i:hover {
 left: 0px;
}
#home1 {
  top: 20px;
  background-color: #4CAF50;
}
#home11 {
  top: 20px;
  background-color: #4CAF50;
}

#calendar {
  top: 80px;
   background-color: #2196F3;
}
#invoice {
  top: 200px;
   background-color: 	#f0ad4e;
}
#notification {
  top: 140px;
  background-color: #d9534f;
}

#blog {
  top: 200px;
  background-color: #f0ad4e
}
#blog1 {
  top: 260px;
  background-color: #5bc0de
}
.fade-top
{
animation: fadetop .5s;
opacity: 1 !important;
}


.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12
{
padding-left:0px;
}

.btn-default
{
padding-top:5px!important;
border-radius:20px;
}

th, td
{
vertical-align:top!important;
}
</style>

    <script>
	var a;
	function showHide(a)
	{
	$("#home"+a).hide();
	$("#home"+a+"1").show();
		}

		function showHide1(a)
	{
	$("#home"+a+"1").hide();
	$("#home"+a).show();

		}


	</script>

					<?php

					$user_type=$_SESSION['user_type'];



   $loggedin_id=$_SESSION['loggedin_id'];



   if($user_type=='Realtor')
   {
   $social_information_query=mysqli_query($con,"select * from realtor_profile where realtor_id=$loggedin_id"); 
   }
   if($user_type="Photographer")
   {
    

    $social_information_query=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=(select pc_admin_id from user_login where id=$loggedin_id)"); 
   }
   $social_information=mysqli_fetch_assoc($social_information_query);
   if(!empty($social_information['facebook_id']))$facebook_id=@$social_information['facebook_id'];else $facebook_id="#";
   if(!empty($social_information['instagram_id']))$instagram_id=@$social_information['instagram_id']; else $instagram_id="#";
   if(!empty($social_information['twitter_id']))$twitter_id=@$social_information['twitter_id'];else $twitter_id="#";
   if(!empty($social_information['youtube_id']))$youtube_id=@$social_information['youtube_id'];else $youtube_id="#";
   if(!empty($social_information['linkedin_id']))$linkedin_id=@$social_information['linkedin_id'];else $linkedin_id="#";




					if($user_type=="Realtor" || $user_type=="CSR")
					{
					//echo "select * from realtor_profile where relator_id='$loggedINID'";

					?>



<div class="hidden-xs hidden-sm" style="">
<br />



<table align="center">
<tr><td id="homeMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="csrRealtorDashboard.php"><i class="fa fa-xs fa-home"></i><span adr_trans="label_home" style="padding-left:15px;font-size:13px;">Home</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="calendarMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="csrRealtorCalendar.php"><i class="fa fa-xs fa-calendar"></i><span adr_trans="label_calendar" style="padding-left:15px;font-size:13px;">Calendar</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="ordersMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="order_list.php?status=1"><i class="fa fa-xs fa-stack-exchange"></i><span adr_trans="label_order" style="padding-left:15px;font-size:13px;">Orders</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="reportsMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="order_reports.php"><i class="fa fa-xs fa-bar-chart"></i><span adr_trans="label_order_reports" style="padding-left:15px;font-size:13px;">Order reports</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="notificationMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="realtor_activity.php"><i class="fa fa-xs fa-bell-o"></i><span adr_trans="label_notification" style="padding-left:15px;font-size:13px;">Notification</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="profileMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;font-size:15px;"><a href="realtor_profile.php"><i class="fa fa-xs fa-user"></i><span id="label_my_profile" adr_trans="label_my_profile" style="padding-left:15px;font-size:13px;">My Profile</span></a></td></tr>
<tr><td>&nbsp;</td></tr>
</table>

<div style="margin-left:7px;background:#F1F3F4!important;text-align:center;">
 <a target="_blank" href="<?php echo $facebook_id;?>"><i class="fa fa-facebook" style="font-size:10px;padding:5px;border-radius:20px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;background:#000;color:#FFF"></i></a>
 <a target="_blank" href="<?php echo $instagram_id;?>"><i class="fa fa-instagram" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $twitter_id;?>"><i class="fa fa-twitter" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $youtube_id;?>"><i class="fa fa-youtube-play" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $linkedin_id;?>"><i class="fa fa-linkedin" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
                            </div>
<br /><br />


 <div>
                                    <p style="margin-left: 80px;margin-top: 10px;"><a href="#tnc2" class=" lightbox link">
                                    <i style="
        color: #aad1d6;
        top: -43px;
        font-size: 30px;

        margin-right: 5px;
        " class="fa fa-envelope" aria-hidden="true"></i><br /><b style="position: relative;top: 3px;right: 14px;font-size: 10px;"><span adr_trans="label_send_invite">Send invite</span></b></a></p>
        </div>

        <div id="tnc2" class="box-lightbox white" style="padding:25px;border-radius:25px 25px 25px 25px;width:450px;height:230px;">
   <div class="subtitle g" style="color:#333333">
    <h5 style="color:#333333;font-style: italic;" align="center">“Fotopia is awesome! We recommend Realtors and Photo Company to join here”</h5>
    <br>
     <h5 style="color:#333333" align="center" id="label_enter_the_email" adr_trans="label_enter_the_email">Enter the Email</h5>
        <center><span class="sub" id="error" style="color:green;"></span></center>
        <form   method="post" name="stdform" action="" onsubmit="">
        <input id="email1" name="email" placeholder="Email" type="email" autocomplete="off" onblur="this.value=this.value.trim()" class="form-control form-value" required>
        <input type="hidden" name="pc_admin_id" id="pc_admin_id" value="<?php echo $pc_admin_id?>"/><br>
        <center><button class="btn adr-save" name="link" id="send" ><span adr_trans="label_send">Send</span></button></center>
        </form>
        <hr class="space l">




        </div>
               </div>


<br /><br />
	</div>
					<?php } ?>



						<?php

					$user_type=$_SESSION['user_type'];

					if($user_type=="Photographer")
					{

					?>





<div class="hidden-xs hidden-sm" style="">
<br />

<table align="center">
<tr><td id="homeMenu" style="padding:5px;background:#FFF;color:#000font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="photographerDashboard.php"><i class="fa fa-xs fa-home"></i><span adr_trans="label_home" style="padding-left:15px;font-size:13px;">Home</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="calendarMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="photographerCalendar.php"><i class="fa fa-xs fa-calendar"></i><span adr_trans="label_calendar" style="padding-left:15px;font-size:13px;">Calendar</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="ordersMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="photographerorder_list.php"><i class="fa fa-xs fa-stack-exchange"></i><span adr_trans="label_order" style="padding-left:15px;font-size:13px;">Orders</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="notificationMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;"><a href="photographeractivity.php"><i class="fa fa-xs fa-bell-o"></i><span adr_trans="label_notification" style="padding-left:15px;font-size:13px;">Notification</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="productsMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;font-size:15px;"><a href="Products.php"><i class="fa fa-xs fa-list"></i><span adr_trans="label_products" style="padding-left:15px;font-size:13px;">Products</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="profileMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:0px 5px 5px 0px;font-size:15px;"><a href="photographer_profile.php"><i class="fa fa-xs fa-user"></i><span id="label_my_profile" adr_trans="label_my_profile" style="padding-left:15px;font-size:13px;">My Profile</span></a></td></tr>
<tr><td>&nbsp;</td></tr>
</table>



<div style="margin-left:7px;background:#F1F3F4!important;text-align:center;">
<a target="_blank" href="<?php echo $facebook_id;?>"><i class="fa fa-facebook" style="font-size:10px;padding:5px;border-radius:20px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;background:#000;color:#FFF"></i></a>
 <a target="_blank" href="<?php echo $instagram_id;?>"><i class="fa fa-instagram" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $twitter_id;?>"><i class="fa fa-twitter" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $youtube_id;?>"><i class="fa fa-youtube-play" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="<?php echo $linkedin_id;?>"><i class="fa fa-linkedin" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
                            </div>
<br /><br />

	</div>



					<?php } ?>
