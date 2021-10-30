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
    $mail->Port = 587;
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


					if($user_type=="Realtor" || $user_type=="CSR")
					{
					//echo "select * from realtor_profile where relator_id='$loggedINID'";

					?>



<div class="hidden-xs hidden-sm" style="margin-left:10px;box-shadow:20px 20px 20px 20px #DDD;height:590px;border-radius:0px 30px 30px 0px;background:#E8F0FE!important">
<br />


<button name="Home" id="home1" class="btn btn-default" style="margin-bottom:10px;padding-left:18px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(1)"><i class="fa fa-sm fa-home text-l"></i>
</button>
<a href="csrRealtorDashboard.php" name="Home" id="home11" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(1)"><span id="label_home" adr_trans="label_home">Home</span> &nbsp;<i class="fa fa-sm fa-home"></i></a>
<br>

<button name="Cal" id="home3" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(3)"><i class="fa fa-sm fa-calendar" style="font-size:23px;"></i>
</button>
<a href="csrRealtorCalendar.php" name="Home" id="home31" class="btn btn-default fade-left text-m" style="transition-duration: 300ms;padding:10px; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(3)"><span id="label_calendar" adr_trans="label_calendar">Calendar</span> &nbsp;<i class="fa fa-sm fa-calendar"></i></a>


<button name="Cal" id="home2" class="btn btn-default" style="display:block;padding-left:22px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(2)"><i class="fa fa-sm fa-stack-exchange text-l"></i>
</button>
<a href="order_list.php?status=1" name="Home2" id="home21" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;padding-right:30px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(2)"><span id="label_order" adr_trans="label_order">Order</span> &nbsp;&nbsp;<i class="fa fa-sm fa-stack-exchange 	"></i></a>

<button name="cal" id="home5" class="btn btn-default" style="display:block;padding:10px;padding-left:22px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(5)"><i class="fa fa-sm fa-bar-chart" style="font-size:20px;"></i>
</button>
<a href="order_reports.php" name="Home" id="home51" class="btn btn-default fade-left" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;font-size:16px;" onmouseleave="showHide1(5)"><span id="label_order_reports" adr_trans="label_order_reports">Order reports</span> &nbsp;<i class="fa fa-sm fa-bar-chart" style="size:2px;"></i></a>


<button name="Home" id="home4" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(4)"><i class="fa fa-sm fa-bell" style="font-size:23px;"></i>
</button>
<a href="realtor_activity.php" name="Home" id="home41" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(4)"><span id="label_notification" adr_trans="label_notification">Notification</span> &nbsp;<i class="fa fa-sm fa-bell"></i></a>

<button name="Home" id="home6" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(6)"><i class="fa fa-sm fa-user text-l"></i>
</button>
<a href="realtor_profile.php" name="Home" id="home61" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(6)"><span id="label_my_profile" adr_trans="label_my_profile">My Profile</span> &nbsp;<i class="fa fa-sm fa-user"></i></a><br />


<br />
<div style="margin-left:7px;background:#E8F0FE!important">
 <a target="_blank" href="#"><i class="fa fa-facebook" style="color:#3B5998!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-twitter" style="color:#3B8ACA!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-instagram" style="color:#125688!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-youtube" style="color:#cc181e!important;font-size:18px;padding:5px;"></i></a>
                            </div>


 <div>
                                    <p style="margin-left: 40px;margin-top: 40px;"><a href="#tnc2" class=" lightbox link">
                                    <i style="
        color: blue;
        top: -43px;
        font-size: 50px;

        margin-right: 5px;
        " class="fa fa-envelope" aria-hidden="true"></i><br /><b style="position: relative;top: 3px;right: 20px;font-size: 16px;"><span adr_trans="label_send_invite">Invite to Join Fotopia</span></b></a></p>
        </div>

        <div id="tnc2" class="box-lightbox white" style="padding:25px;border-radius:25px 25px 25px 25px;width:300px;height:200px;">
   <div class="subtitle g" style="color:#333333">
     <h5 style="color:#333333" align="center" id="label_enter_the_email" adr_trans="label_enter_the_email">Enter the Email</h5>
        <hr>
        <center><span class="sub" id="error" style="color:green;"></span></center>
        <form   method="post" name="stdform" action="" onsubmit="">
        <input id="email1" name="email" placeholder="Email" type="email" autocomplete="off" class="form-control form-value" required>
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





<div class="hidden-xs hidden-sm" style="box-shadow:20px 20px 20px 20px #DDD;height:590px;border-radius:0px 30px 30px 0px;background:#E8F0FE!important">
<br />




<button name="Home" id="home1" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(1)"><i class="fa fa-sm fa-home text-l"></i>
</button>
<a href="photographerDashboard.php" name="Home" id="home11" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(1)"><span id="label_home" adr_trans="label_home">Home</span> &nbsp;<i class="fa fa-sm fa-home"></i></a>


<button name="Cal" id="home2" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(2)"><i class="fa fa-sm fa-calendar" style="font-size:23px;"></i>
</button>
<a href="photographerCalendar.php" name="Home" id="home21" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(2)"><span id="label_calendar" adr_trans="label_calendar">Calendar</span> &nbsp;<i class="fa fa-sm fa-calendar"></i></a>

<button name="Cal" id="home8" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(8)"><i class="fa fa-sm fa-stack-exchange text-l" style="padding-right: 6px;"></i>
</button>
<a href="photographerorder_list.php" name="Home81" id="home81" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;padding-right:31px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(8)"><span id="label_order" adr_trans="label_order">Orders</span> &nbsp;&nbsp;<i class="fa fa-sm fa-stack-exchange" ></i></a>

<button name="Home" id="home3" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(3)"><i class="fa fa-sm fa-bell" style="font-size:23px;"></i>
</button>
<a href="photographeractivity.php" name="Home" id="home31" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(3)"><span id="label_notification" adr_trans="label_notification">Notification</span> &nbsp;<i class="fa fa-sm fa-bell"></i></a>


<!-- <button name="Home" id="home9" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(9)"><i class="fa fa-sm fa-users" style="font-size:21px;"></i>
</button>
<a href="editor_list.php" name="Home" id="home91" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(9)"><span id="label_editors" adr_trans="label_editors">Editors</span> &nbsp;<i class="fa fa-sm fa-users"></i></a> -->


<button name="Home" id="home7" class="btn btn-default" style="display:block;padding:7px;padding-left:22px;border-radius:0px 20px 20px 0px;margin-bottom:10px;" onclick="showHide(7)"><i class="fa fa-sm fa-list"  style="font-size:20px;"></i>
</button>
<a href="products.php" name="" id="home71" class="btn btn-default fade-left  text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;padding:10px;border-radius:0px 20px 20px 0px;margin-bottom:10px;" onmouseleave="showHide1(7)"><span id="label_products" adr_trans="label_products">Products</span> &nbsp;&nbsp;<i class="fa fa-sm fa-list"></i></a>


<button name="Home" id="home6" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(6)"><i class="fa fa-sm fa-user" style="font-size:25px;"></i>
</button>
<a href="photographer_profile.php" name="Home" id="home61" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(6)"><span id="label_my_profile" adr_trans="label_my_profile">My Profile</span> &nbsp;<i class="fa fa-sm fa-user"></i></a>



<br /><br />
<div style="margin-left:7px;background:#E8F0FE!important">
 <a target="_blank" href="#"><i class="fa fa-facebook" style="color:#3B5998!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-twitter" style="color:#3B8ACA!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-instagram" style="color:#125688!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-youtube" style="color:#cc181e!important;font-size:18px;padding:5px;"></i></a>
                            </div>
<br /><br />

	</div>



					<?php } ?>
