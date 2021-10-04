<?php
ob_start();

include "connection1.php";
$loggedin_id=$_SESSION['admin_loggedin_id'];
mysqli_query($con,"update user_actions set is_read=1 where (action_done_by_id='$loggedin_id' or pc_admin_id='$loggedin_id') and is_read=0");


?>

<style>

#calendar
{
background-color:#FFFFFF;
}

table td[class*="col-"], table th[class*="col-"]
{
background:#EEE;

}

.gmailEvent0
{
background:#D9534F!important;
color:white!important;
padding-left:5px;
}
th,td
{
padding:15px!important;
}
</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage2">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	 	<?php include "sidebar.php";?>


			</div>
                <div class="col-md-10" style="font-family:Arial, Helvetica, sans-serif">
<?php

$pc_admin_count_query="select count(*) as total from user_actions where (action_done_by_id='$loggedin_id' or pc_admin_id='$loggedin_id') and is_read=0";
                  $pc_admin_count_result=mysqli_query($con,$pc_admin_count_query);
          $pc_admin_data=mysqli_fetch_assoc($pc_admin_count_result);
                  $countIs=$pc_admin_data['total'];


 ?>

              	<h4 class="text-center"><span id="label_notification" adr_trans="label_notification">Notifications</span>(<?php echo $countIs; ?>)</h4>

 <table class="" style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.9;width:100%;border-radius:25px;" aria-busy="false">
                   <thead>
                    <tr>
                      <th id="label_s.no" adr_trans="label_s.no">Sno</th>
                      <th><span adr_trans="label_activity">Activity</span></th>
					  <th><span adr_trans="label_date_and_time">Date & Time</span></th>
                   </tr>
                 </thead>
                <tbody>
                 <?php
  //	---------------------------------  pagination starts ---------------------------------------

  if(@$_GET["page"]<0)
  {
  $_GET["page"]=1;
  }
if(empty($_GET["page"]))
{
  $_SESSION["page"]=1;
}
else {
  $_SESSION["page"]=$_GET["page"];
}
if($_SESSION["page"] == 0)
{
  $_SESSION["page"]=1;
}

$count_query="select count(*) as total from user_actions where (action_done_by_id='$loggedin_id' or pc_admin_id='$loggedin_id') and is_read=1";
$count_result=mysqli_query($con,$count_query);
$data=mysqli_fetch_assoc($count_result);
$total_no=$data['total'];
$number_of_pages=5;
$Page_check=intval($total_no/$number_of_pages);
$page_check1=$total_no%$number_of_pages;
if($page_check1 == 0)
;
else {
  $Page_check=$Page_check+1;

}
if($Page_check<=$_SESSION["page"])
{
  $_SESSION["page"]=$Page_check;
}
  // how many entries shown in page

  //starting number to print the users shown in page
$start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

$cnt=$start_no_users;

$limit=$start_no_users. ',' . $number_of_pages;

 if($get_action_query=mysqli_query($con,"select * from user_actions where (action_done_by_id='$loggedin_id' or pc_admin_id='$loggedin_id') and is_read=1 ORDER BY id DESC limit $limit  "))
 {
 while($get_action=mysqli_fetch_assoc($get_action_query))
 {
   $cnt++;
   $date = date_create($get_action['action_date']);
   $date1=date_format($date, '  jS F Y, g:ia');



   if($_SESSION["admin_loggedin_type"]='PCAdmin')
    {
       if(($get_action['module']=="Appointment")||($get_action['module']=="Order")||($get_action['module']=="Finished images")||($get_action['module']=="Canceled"))
        {
          if($get_action['action']=="completed")
          {
             $redirect="superorder_list1.php?c=1";
          }
          elseif($get_action['action']=="Created")
          {
             $redirect="superorder_list1.php";
          }
          else
           {
               $redirect="superorder_list1.php?o=1";
           }
        }
        elseif($get_action['module']=="Profile")
        {
         $redirect="company_profile.php";
        }
        elseif($get_action['module']=="Rating")
        {
         $redirect="#";
        }
        else{
          $redirect="Products.php";
        }
      }
      else
       {

     }
     ?>
     <?php
     if($get_action['module']=="Profile" || $get_action['module']=="Product" || $get_action['module']=="Declined" || $get_action['module']=="Working")
     { ?>
         <tr><td><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href='.$redirect.' style="color:#000;font-size:12px;">'.$get_action['module'].' '.  $get_action['action'].' by You </a>';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                      <?php }
                       else {  ?>
                          <tr><td><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href='.$redirect.' style="color:#000;font-size:12px;">'.$get_action['module'].' '.  $get_action['action'].' by '.$get_action['action_done_by_name']. '</a>';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>

  <?php   } ?>

<?php } }?>
               </tbody>
                  </table>

                  <div class="col-sm-6">
                        <ul class="pagination " style="font-weight:bold!important;">
                          <li class="first disabled" aria-disabled="true"><a href="./pc_admin_activity.php?page=1" class="button adr-save">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./pc_admin_activity.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./pc_admin_activity.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./pc_admin_activity.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:24px">
                          <div class="infos"><p align="right" style="    margin-right: -px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></p></div>
                            <br>  <br>
                          </div>



                  <p align="right">   <a href="PCAdmin_dashboard.php" id="label_back_home" adr_trans="label_back_home" class="anima-button circle-button btn-sm btn adr-cancel" ><i class="fa fa-sign-out"></i>Back To Home</a></p>

        </div>




                </div>


            </div>



		<?php include "footer.php";  ?>
