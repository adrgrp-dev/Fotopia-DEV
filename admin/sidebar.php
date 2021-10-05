<?php ?>
<style>

#mySidenav a {
  position: absolute;

  transition: 0.3s;
  padding: 15px;
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


.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12
{
padding-left:0px;
}
th, td
{
vertical-align:top!important;
padding:5px;
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
  
    if($_SESSION['admin_loggedin_type']=="CSR")
    {


$pcadmin1=mysqli_query($con,"select * from photo_company_profile where pc_admin_id=(select pc_admin_id from admin_users where id='$loggedINID')");
$pcadmin=mysqli_fetch_array($pcadmin1);






                      echo '<div class="hidden-xs hidden-sm" style="margin-top:-30px;height:670px;border-radius:0px 30px 30px 0px;box-shadow:10px 10px 10px 10px #DDD;background:#E8F0FE!important">

<br />

                   <button name="Home" id="home1" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(1)"><i class="fa fa-home text-l"></i>
                   </button>
                   <a href="subcsr_dashboard.php" name="Home" id="home11" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(1)"><span adr_trans="label_home">Home</span> &nbsp;<i class="fa fa-home"></i></a>

                   <button name="Cal" id="home4" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(4)"><i class="fa fa-calendar" style="font-size:21px;"></i>
                   </button>
                   <a href="CSR_Calendar.php" name="Home" id="home41" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(4)"><span adr_trans="label_calendar">Calender</span> &nbsp;<i class="fa fa-calendar"></i></a>

                    <button name="Cal" id="home5" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(5)"><i class="fa fa-stack-exchange text-l"></i>
                   </button>
                   <a href="subcsrOrder_list1.php" name="Home" id="home51" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(5)"><span adr_trans="label_order">Order</span> &nbsp;<i class="fa fa-stack-exchange"></i></a>


                   <button name="Cal" id="home8" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(8)"><i class="fa fa-bar-chart"  style="font-size:21px;"></i>
              </button>
             <a href="order_reports.php" name="Home" id="home81" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;font-size:14px;" onmouseleave="showHide1(8)"><span adr_trans="label_order_reports" style="font-size:14px;">Order reports</span> &nbsp;<i class="fa fa-file"></i></a>

             <button name="Cal" id="home12" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(12)"><i class="fa fa-bell" style="font-size:21px;"></i>
        </button>
       <a href="csr_activity.php" name="Home" id="home121" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(12)"><span adr_trans="label_notification">Notification</span> &nbsp;<i class="fa fa-bell"></i></a>

             <button name="Home" id="home9" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(9)"><i class="fa fa-list" style="font-size:21px;"></i>
              </button>
              <a href="csr_products.php" name="Home" id="home91" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(9)"><span adr_trans="label_products">Products</span> &nbsp;<i class="fa fa-list"></i></a>

             <button name="Home" id="home10" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(10)"><i class="fa fa-user text-l"></i>
              </button>
              <a href="csr_profile.php" name="Home" id="home101" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(10)"><span adr_trans="label_my_profile">My profile</span> &nbsp;<i class="fa fa-user"></i></a>


<br /><br />
<div style="margin-left:7px;">
 <a target="_blank" href="#"><i class="fa fa-facebook" style="color:#3B5998!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-twitter" style="color:#3B8ACA!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-instagram" style="color:#125688!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-youtube" style="color:#cc181e!important;font-size:18px;padding:5px;"></i></a>
                            </div>
<br /><br />

                   </div>';

  }

             if($_SESSION['admin_loggedin_type']=="PCAdmin")
     {
$pcadmin1=mysqli_query($con,"select * from photo_company_profile where pc_admin_id='$loggedINID'");
$pcadmin=mysqli_fetch_array($pcadmin1);
?>

<div class="hidden-xs hidden-sm" style="margin-left:-10px;padding:10px;width:100%;border-bottom:solid 1px #DDD; box-shadow:10px 10px 10px 10px #DDD;margin-top:-20px;border-radius:0px 30px 30px 0px;height:670px;background:#E8F0FE!important">


<?php
       echo '<button name="Home" id="home1" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(1)"><i class="fa fa-home text-l"></i>
              </button>
              <a href="PCAdmin_dashboard.php" name="Home" id="home11" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(1)"><span adr_trans="label_home">Home</span> &nbsp;<i class="fa fa-home"></i></a>
<br>

             <button name="Cal" id="home4" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(4)"><i class="fa fa-calendar" style="font-size:23px"></i>
             </button>
             <a href="PCAdmin_Calender.php" name="Home" id="home41" class="btn btn-default fade-left text-m" style="transition-duration:padding:8px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(4)"><span adr_trans="label_calendar">Calender</span> &nbsp;<i class="fa fa-calendar"></i></a>

             <button name="Cal" id="home5" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(5)"><i class="fa fa-stack-exchange text-l"></i>
             </button>
             <a href="superorder_list1.php" name="Home" id="home51" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(5)"><span adr_trans="label_order">Order</span> &nbsp;<i class="fa fa-stack-exchange"></i></a>

             <button name="Home" id="home7" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:18px;border-radius:0px 20px 20px 0px;" onclick="showHide(7)"><i class="fa fa-bar-chart" style="font-size:21px;"></i>
              </button>
              <a href="order_reports.php" name="Home" id="home71" class="btn btn-default fade-left" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;font-size:14px;" onmouseleave="showHide1(7)"><span adr_trans="label_order_reports">Order reports</span> &nbsp;<i class="fa fa-bar-chart" style="font-size:15px;"></i></a>


             <button name="Cal" id="home12" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(12)"><i class="fa fa-bell" style="font-size:23px;"></i>
             </button>
             <a href="pc_admin_activity.php" name="Home" id="home121" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(12)"><span adr_trans="label_notification">Notification</span> &nbsp;<i class="fa fa-bell"></i></a>

            <button name="Home" id="home10" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(10)"><i class="fa fa-user-secret text-l"></i>
             </button>
             <a href="client.php" name="Home" id="home101" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(10)"><span adr_trans="label_clients">Clients</span> &nbsp;<i class="fa fa-user-secret"></i></a>

             <button name="Cal" id="home6" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(6)"><i class="fa fa-list"  style="font-size:20px;"></i>
              </button>
              <a href="products.php" name="Home" id="home61" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(6)"><span adr_trans="label_products">Products</span> &nbsp;<i class="fa fa-list"></i></a>


             <button name="Cal" id="home2" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(2)"><i class="fa fa-users" style="font-size:20px;"></i>
             </button>
              <a href="csr_list1.php" name="Home" id="home21" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(2)"><span adr_trans="label_users">Users</span> &nbsp;<i class="fa fa-users"></i></a>

              <button name="Home" id="home9" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(9)"><i class="fa fa-user text-l"></i>
              </button>
              <a href="company_profile.php" name="Home" id="home91" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(9)"><span adr_trans="label_company_profile">Company profile</span> &nbsp;<i class="fa fa-user"></i></a>



<br /><br />
<div style="margin-left:7px;">
 <a target="_blank" href="#"><i class="fa fa-facebook" style="color:#3B5998!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-twitter" style="color:#3B8ACA!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-instagram" style="color:#125688!important;font-size:18px;padding:5px;"></i></a>
<a target="_blank" href="#"><i class="fa fa-youtube" style="color:#cc181e!important;font-size:18px;padding:5px;"></i></a>
                            </div>
<br /><br />




              </div>';


}?>


<?php   if($_SESSION['admin_loggedin_type']=="FotopiaAdmin")
     { ?>

      <div class="hidden-xs hidden-sm">
<button name="Home" id="home1" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(1)"><i class="fa fa-home text-l"></i>
</button>
<a href="dashboard.php" name="Home" id="home11" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(1)"><span adr_trans="label_home">Home</span> &nbsp;<i class="fa fa-home"></i></a><br/>


<button name="Cal" id="home2" class="btn btn-default" style="display:block;padding-left:20px;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onclick="showHide(2)"><i class="fa fa-users text-l"></i>
</button>
<a href="users.php" name="Home" id="home21" class="btn btn-default fade-left text-m" style="transition-duration:padding:10px; 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(2)"><span adr_trans="label_users">Users</span> &nbsp;<i class="fa fa-users"></i></a>


<button name="Home" id="home3" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:20px;border-radius:0px 20px 20px 0px;" onclick="showHide(3)"><i class="fa fa-bell text-l"></i>
</button>
<a href="notification.php" name="Home" id="home31" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(3)"><span adr_trans="label_notification">Notification</span> &nbsp;<i class="fa fa-bell"></i></a>


<button name="Home" id="home5" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:18px;border-radius:0px 20px 20px 0px;" onclick="showHide(5)"><i class="fa fa-line-chart text-l"></i>
</button>
<a href="#" name="Home" id="home51" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(5)"><span adr_trans="label_statistics">Statistics</span> &nbsp;<i class="fa fa-line-chart"></i></a>


<button name="Home" id="home6" class="btn btn-default" style="margin-bottom:10px;padding-left:20px;transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 3ms;border-radius:0px 20px 20px 0px;" onclick="showHide(6)"><i class="fa fa-user-secret text-l"></i>
</button>
<a href="admin_users.php" name="Home" id="home61" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(6)"><span adr_trans="label_admin_users">Admin Users</span> &nbsp;<i class="fa fa-user-secret"></i></a>
<br />


<button name="Home" id="home7" class="btn btn-default" style="display:block;margin-bottom:10px;padding-left:18px;border-radius:0px 20px 20px 0px;" onclick="showHide(7)"><i class="fa fa-bar-chart text-l"></i>
</button>
<a href="order_reports.php" name="Home" id="home71" class="btn btn-default fade-left text-m" style="transition-duration: 300ms; animation-duration: 300ms; transition-timing-function: ease; transition-delay: 0ms;display:none;margin-bottom:10px;border-radius:0px 20px 20px 0px;" onmouseleave="showHide1(7)"><span adr_trans="label_reports">Reports</span> &nbsp;<i class="fa fa-bar-chart text-l"></i></a>
</div>


<?php } ?>
