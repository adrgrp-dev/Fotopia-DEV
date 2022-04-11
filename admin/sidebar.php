<?php ?>
<style>

#mySidenav a {
  position: absolute;

  transition: 0.3s;
  padding: 15px;
  width:fit-content;
  text-decoration: none;
  color: white;
  border-radius: 0 5px 5px 0;
}

#mySidenav a:hover {
  left: 0;
}
#mySidenav a i:hover {
 left: 0px;
}


.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12
{
padding-left:0px;
}

.menuTable a
{
color:#000!important;
line-height:23px;
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
          <br />
<!--
          <button name="Cal" id="home2" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(2)"><i class="fa fa-users text-l"></i>
          </button>
          <a href="subcsr_list1.php" name="Home" id="home21" class="btn btn-default fade-left text-m" style="transition-duration:padding:2px!important; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;width:font-size:12px!important;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(2)"><span style="font-size:14px!important">Photographers</span> &nbsp;<i class="fa fa-users"></i></a> -->

    <?php
  $loggedINID=$_SESSION['admin_loggedin_id'];
  $user_type=$_SESSION['admin_loggedin_type'];



   if($user_type=='PCAdmin')
   {
   $social_information_query=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=$loggedINID"); 
   $social_information=mysqli_fetch_assoc(@$social_information_query);
   }
   if($user_type=="CSR")
   {
    $social_information_query=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id=$loggedINID)"); 
    $social_information=mysqli_fetch_assoc(@$social_information_query);
   }

   if(!empty($social_information['facebook_id']))$facebook_id=@$social_information['facebook_id'];else $facebook_id="#";
   if(!empty($social_information['instagram_id']))$instagram_id=@$social_information['instagram_id']; else $instagram_id="#";
   if(!empty($social_information['twitter_id']))$twitter_id=@$social_information['twitter_id'];else $twitter_id="#";
   if(!empty($social_information['youtube_id']))$youtube_id=@$social_information['youtube_id'];else $youtube_id="#";
   if(!empty($social_information['linkedin_id']))$linkedin_id=@$social_information['linkedin_id'];else $linkedin_id="#";

  

    if($_SESSION['admin_loggedin_type']=="CSR")
    {


$pcadmin1=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id='$loggedINID')");
$pcadmin=mysqli_fetch_array($pcadmin1);






                      echo '<div class="hidden-xs hidden-sm" style="">



                   <table align="center" class="menuTable">
<tr><td id="homeMenu" style="padding:5px;background:#FFF;color:#000font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="subcsr_dashboard.php"><i class="fa fa-xs fa-home"></i><span adr_trans="label_home" style="padding-left:15px;font-size:13px;">Home</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="calendarMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="CSR_Calendar.php"><i class="fa fa-xs fa-calendar"></i><span adr_trans="label_calendar" style="padding-left:15px;font-size:13px;">Calendar</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="ordersMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="subcsrOrder_list1.php?status=1"><i class="fa fa-xs fa-stack-exchange"></i><span adr_trans="label_order" style="padding-left:15px;font-size:13px;">Orders</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="reportsMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="order_reports.php"><i class="fa fa-xs fa-bar-chart"></i><span adr_trans="label_order_reports" style="padding-left:15px;font-size:13px;">Order reports</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="notificationMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="csr_activity.php"><i class="fa fa-xs fa-bell-o"></i><span adr_trans="label_notification" style="padding-left:15px;font-size:13px;">Notification</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="productMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="csr_products.php"><i class="fa fa-xs fa-list"></i><span adr_trans="label_products" style="padding-left:15px;font-size:13px;">Products</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="profileMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;font-size:15px;"><a href="csr_profile.php"><i class="fa fa-xs fa-user"></i><span id="label_my_profile" adr_trans="label_my_profile" style="padding-left:15px;font-size:13px;">My Profile</span></a></td></tr>
<tr><td>&nbsp;</td></tr>
</table>

<div style="margin-left:7px;background:#F1F3F4!important;text-align:center;">
 <a target="_blank" href="'.$facebook_id.'"><i class="fa fa-facebook" style="font-size:10px;padding:5px;border-radius:20px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;background:#000;color:#FFF"></i></a>
 <a target="_blank" href="'.$instagram_id.'"><i class="fa fa-instagram" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$twitter_id.'"><i class="fa fa-twitter" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$youtube_id.'"><i class="fa fa-youtube-play" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$linkedin_id.'"><i class="fa fa-linkedin" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
                            </div>
<br /><br />

                   </div>';

  }

             if($_SESSION['admin_loggedin_type']=="PCAdmin")
     {
$pcadmin1=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedINID'");
$pcadmin=mysqli_fetch_array($pcadmin1);
?>

<div class="hidden-xs hidden-sm" style="">



<?php
       echo '<table align="center" class="menuTable">
<tr><td id="homeMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="PCAdmin_dashboard.php"><i class="fa fa-xs fa-home"></i><span adr_trans="label_home" style="padding-left:15px;font-size:13px;">Home</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="calendarMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="PCAdmin_Calender.php"><i class="fa fa-xs fa-calendar"></i><span adr_trans="label_calendar" style="padding-left:15px;font-size:13px;">Calendar</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="ordersMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="superorder_list1.php?status=1"><i class="fa fa-xs fa-stack-exchange"></i><span adr_trans="label_order" style="padding-left:15px;font-size:13px;">Orders</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="reportsMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="order_reports.php"><i class="fa fa-xs fa-bar-chart"></i><span adr_trans="label_order_reports" style="padding-left:15px;font-size:13px;">Order reports</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="notificationMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="pc_admin_activity.php"><i class="fa fa-xs fa-bell-o"></i><span adr_trans="label_notification" style="padding-left:15px;font-size:13px;">Notification</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="clientMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="client.php"><i class="fa fa-xs fa-user-secret"></i><span adr_trans="label_clients" style="padding-left:15px;font-size:13px;">Client</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="productMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="products.php"><i class="fa fa-xs fa-list"></i><span adr_trans="label_products" style="padding-left:15px;font-size:13px;">Products</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="userMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="csr_list1.php"><i class="fa fa-xs fa-users"></i><span adr_trans="label_users" style="padding-left:15px;font-size:13px;">Users</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="profileMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;font-size:15px;"><a href="company_profile.php"><i class="fa fa-xs fa-user"></i><span id="label_my_profile" adr_trans="label_my_profile" style="padding-left:15px;font-size:13px;">My Profile</span></a></td></tr>
<tr><td>&nbsp;</td></tr>
</table>

<div style="margin-left:7px;background:#F1F3F4!important;text-align:center;">
 <a target="_blank" href="'.$facebook_id.'"><i class="fa fa-facebook" style="font-size:10px;padding:5px;border-radius:20px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;background:#000;color:#FFF"></i></a>
 <a target="_blank" href="'.$instagram_id.'"><i class="fa fa-instagram" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$twitter_id.'"><i class="fa fa-twitter" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$youtube_id.'"><i class="fa fa-youtube-play" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="'.$linkedin_id.'"><i class="fa fa-linkedin" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
                            </div>
<br /><br />




          </div>    ';


}?>



<?php   if($_SESSION['admin_loggedin_type']=="FotopiaAdmin")
     { ?>

      <div class="hidden-xs hidden-sm">
<table align="center" class="menuTable">
<tr><td id="homeMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="dashboard.php"><i class="fa fa-xs fa-home"></i><span adr_trans="label_home" style="padding-left:15px;font-size:13px;">Home</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="userMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="users.php?user_type=1"><i class="fa fa-xs fa-user-secret"></i><span adr_trans="label_users" style="padding-left:15px;font-size:13px;">Users</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="notificationMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="notification.php"><i class="fa fa-xs fa-bell-o"></i><span adr_trans="label_notification" style="padding-left:15px;font-size:13px;">Notification</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="statisticMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="#"><i class="fa fa-xs fa-stack-exchange"></i><span adr_trans="label_statistics" style="padding-left:15px;font-size:13px;">Statistics</span></a></td></tr>

<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="adminuserMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="admin_users.php?user_type=1"><i class="fa fa-xs fa-users"></i><span adr_trans="label_admin_users" style="padding-left:15px;font-size:13px;">Admin users</span></a></td></tr>




<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="reportsMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;"><a href="order_reports.php"><i class="fa fa-xs fa-bar-chart"></i><span adr_trans="label_order_reports" style="padding-left:15px;font-size:13px;">Order reports</span></a></td></tr>


<tr style="line-height:8px;"><td>&nbsp;</td></tr>
<tr><td id="pagesMenu" style="padding:5px;background:#FFF;color:#000;font-weight:bold;width:150px;border-radius:5px 5px 5px 5px;font-size:15px;"><a href="pages.php"><i class="fa fa-xs fa-user"></i><span  adr_trans="label_pages" style="padding-left:15px;font-size:13px;">Pages</span></a></td></tr>
<tr><td>&nbsp;</td></tr>
</table>

</div>
<?php } ?>
