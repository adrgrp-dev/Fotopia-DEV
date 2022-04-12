<?php
ob_start();

include "connection1.php";
$loggedin_id=$_SESSION['loggedin_id'];
mysqli_query($con,"update user_actions set is_read=1,photographer_read=1 where (action_done_by_id='$loggedin_id' or photographer_id='$loggedin_id') and (is_read=0 or photographer_read=0)");


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
/*th,td
{
padding:15px!important;
}*/
th
{
  background: #aad1d6;
  padding-top: 10px !important;
  padding-bottom: 10px !important;
  padding-left: 3px !important;
}
.infobar .infos p
{
  margin-right: -10px;
}
#undefined-footer
{
  background: white;
  padding:10px 10px;
}
</style>
<?php include "header.php";  ?>
 <div class="section-empty bgimage2">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10" style="font-family:Arial, Helvetica, sans-serif">
<?php

$photographer_count_query="select count(*) as total from user_actions where ((action_done_by_id='$loggedin_id' and action_done_by_type='Photographer') or photographer_id='$loggedin_id') and (is_read=0 or photographer_read=0)";
                  $photographer_count_result=mysqli_query($con,$photographer_count_query);
          $photographer_data=mysqli_fetch_assoc($photographer_count_result);
                  $countIs=$photographer_data['total'];


 ?>


	      	<h5 class="text-left"><span id="label_notification" adr_trans="label_notification" style="color:#000">Notifications</span>(<?php echo $countIs; ?>)</h5>
          <div style="background-color:white;border-radius:5px;padding-top: 10px;">
                <table class="" align="center" style="color: #000;opacity:0.9;width:98%;" aria-busy="false">
          <thead>
                    <tr>
                       <th style="padding-left:25px!important"><span  adr_trans="label_s.no">S.no</span></th>
                      <th style="padding-left:30px!important"><span adr_trans="label_activity">Activity</span></th>
					  <th style="padding-left:30px!important"><span adr_trans="label_date_and_time">Date & Time</span></th>
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

$count_query="select count(*) as total from user_actions where ((action_done_by_id='$loggedin_id' and action_done_by_type='Photographer') or photographer_id='$loggedin_id') and is_read=1";
$count_result=mysqli_query($con,$count_query);
$data=mysqli_fetch_assoc($count_result);
$total_no=$data['total'];
$number_of_pages=50;
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

 if($get_action_query=mysqli_query($con,"select * from user_actions where (action_done_by_id='$loggedin_id' or photographer_id='$loggedin_id') and is_read=1 ORDER BY id DESC limit $limit  "))
 {
 while($get_action=mysqli_fetch_assoc($get_action_query))
 {
   $cnt++;
   $date = date_create($get_action['action_date']);
   $date1=date_format($date, '  jS F Y, g:ia');



   if($_SESSION["user_type"]='Photographer')
    {
       if(($get_action['module']=="Appointment")||($get_action['module']=="Order")||($get_action['module']=="Finished images"))
        $redirect="photographerorder_list.php";
        elseif($get_action['module']=="Profile")
        {
         $redirect="photographer_profile.php";
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
     if($get_action['module']=="Profile" || $get_action['module']=="Product")
     { ?>
         <tr class="listPageTR"><td style="padding-left:30px!important"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important"><?php echo'<a href='.$redirect.' style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].' by You </a>';?></td><td style="color:#000;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
          <tr><td class="listPageTRGap">&nbsp;</td></tr>  
                      <?php }

                      elseif($get_action['module']=="Chat Message" )
                                  {
                       $orderID=$get_action['order_id'];
                       ?>
                                      <tr class="listPageTR"><td style="padding-left:30px!important"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important"><?php echo'<a href="photographerorder_detail.php?id='.$orderID.'" style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].'';?></td><td style="color:#000;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
                                        <tr><td class="listPageTRGap">&nbsp;</td></tr>  
                                 <?php }
                       else {  ?>
                          <tr class="listPageTR"><td style="padding-left:30px!important"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important"><?php echo'<a href='.$redirect.' style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].' by '.$get_action['action_done_by_name']. '</a>';?></td><td style="color:#000;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>  

  <?php   } ?>

<?php } }?>
               </tbody>
                  </table>
                </div>
                <div id="undefined-footer">
                  <div class="col-sm-6">
                        <ul class="pagination " style="font-weight:bold!important;">
                          <li class="first disabled" aria-disabled="true"><a href="./photographeractivity.php?page=1" class="button">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($Page_check);?>" class="button">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:22px">
                          <div class="infos" style="color: black"><p align="right"><span adr_trans="label_showing">Showing</span><?php if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of &nbsp;<?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                            <br>  <br>
                          </div>



                  <!-- <p align="right">   <a href="photographerDashboard.php" class="anima-button circle-button btn-sm btn adr-cancel" adr_trans="label_back_home"><i class="fa fa-sign-out"></i>Back To Home</a></p> -->
                </div>

        </div>
                </div>


            </div>



		<?php include "footer.php";  ?>
