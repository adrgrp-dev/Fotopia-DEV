<?php
ob_start();

include "connection1.php";
$loggedin_id=$_SESSION['loggedin_id'];
mysqli_query($con,"update user_actions set is_read=1,realtor_read=1 where (action_done_by_id='$loggedin_id' or realtor_id='$loggedin_id') and (is_read=0 or realtor_read=0)");




?>

<style>

#calendar
{
background-color:#FFFFFF;
}



.gmailEvent0
{
background:#D9534F!important;
color:white!important;
padding-left:5px;
}
th
{
  background: #aad1d6;
  padding-top: 10px !important;
  padding-bottom: 10px !important;
  padding-left: 2px !important;
}
th:last-child > span
{
  vertical-align: text-top;
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
 <div class="section-empty bgimage5">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="margin-left:-7px;">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">
<?php

$realtor_count_query="select count(*) as total from user_actions where ((action_done_by_id='$loggedin_id' and action_done_by_type='Realtor') or realtor_id='$loggedin_id') and (is_read=0 or realtor_read=0) ";
                  $realtor_count_result=mysqli_query($con,$realtor_count_query);
                  $realtor_data=mysqli_fetch_assoc($realtor_count_result);
                  $countIs=$realtor_data['total'];

 ?>

              	<h5 class="text-left"><span adr_trans="label_notification">Notifications</span>(<?php echo $countIs; ?>)</h5>

               <div style="background-color:white;padding-top: 10px;border-radius: 5px;">
 <table class="" align="center" style="color: #000;background: white;opacity:0.9;width:98%;padding-left:3px;" aria-busy="false">
                  <thead>
                    <tr>
                      <th class="text-left" style="padding-left:20px!important;width:100px;"><span  adr_trans="label_s.no">S.no</span></th>
                     <th class="text-left"><span adr_trans="label_activity">Activity</span></th>
           <th class="text-left"><span adr_trans="label_date_and_time">Date & Time</span></th>
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

                  $count_query="select count(*) as total from user_actions where (realtor_id='$loggedin_id') and is_read=1";

				  //   $count_query="select count(*) as total from user_actions where (action_done_by_id='$loggedin_id' or realtor_id='$loggedin_id') and is_read=1";
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


                    //starting number to print the users shown in page
                  $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

                  $cnt=$start_no_users;

                  $limit=$start_no_users. ',' . $number_of_pages;

                  if($get_action_query=mysqli_query($con,"select * from user_actions where (realtor_id='$loggedin_id') and is_read=1 ORDER BY id DESC limit $limit  "))
                   {
                   while($get_action=mysqli_fetch_assoc($get_action_query))
                   {   $cnt++;

                     $date = date_create($get_action['action_date']);
                     $date1=date_format($date, '  jS F Y, g:ia');


                       ?>
                       <?php
                       if($get_action['module']=="Order" || $get_action['module']=="Rework" || $get_action['module']=="Appointment" || $get_action['module']=="Profile"||$get_action['module']=="Canceled")
                       {?>
                           <tr class="listPageTR"><td style="padding-left:20px!important;width:100px;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href="order_list.php" style="color:#0000ff;font-size:12px;text-decoration:underline;">'.$get_action['module'].' '.  $get_action['action'].' by You </a>';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
                      <?php }
                      elseif($get_action['module']=="Rating" )
                      {?>
                          <tr class="listPageTR"><td style="padding-left:20px!important;width:100px;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href="#" style="color:#0000ff;font-size:12px;text-decoration:underline;">'.$get_action['module'].' '.  $get_action['action'].' by You </a>';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
                     <?php }
					  elseif($get_action['module']=="Finished images" )
                      {?>
                          <tr class="listPageTR"><td style="padding-left:20px!important;width:100px;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href="#" style="color:#0000ff;font-size:12px;text-decoration:underline;">'.$get_action['module'].' '.  $get_action['action'].'ed';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
                     <?php }
					 elseif($get_action['module']=="Chat Message" )
                      {
					  $orderID=$get_action['order_id'];
					  ?>
                          <tr class="listPageTR"><td style="padding-left:20px!important;width:100px;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href="order_detail.php?id='.$orderID.'" style="color:#000;font-size:12px;text-decoration:underline;color:#0000ff;">'.$get_action['module'].' '.  $get_action['action'].'';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
                     <?php }
                         else {
                             $get_action_done_name=explode("@",$get_action['action_done_by_name']);
                        ?>
                          <tr class="listPageTR"><td style="padding-left:20px!important;width:100px;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td><?php echo'<a href="order_list.php" style="color:#000;font-size:12px;text-decoration:underline;color:#0000ff;">'.$get_action['module'].' '.  $get_action['action'].' by '.$get_action_done_name[0].'</a>';?></td><td style="color:#000;font-size:12px;"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>
                  <?php  }
                } }?>
               </tbody>
                  </table>
                </div>
                  <div id="undefined-footer">
                  <div class="col-sm-6">
                        <ul class="pagination ">
                          <li class="first disabled" aria-disabled="true"><a href="./realtor_activity.php?page=1" class="button">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./realtor_activity.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./realtor_activity.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./realtor_activity.php?page=".($Page_check);?>" class="button">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:22px;">
                          <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span><?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> <span adr_trans="label_to">to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of&nbsp; <?php echo $total_no; ?> <span adr_trans="label_entries">entries</span></p></div>
                            <br>  <br>
                          </div>



                <!--   <p align="right">   <a href="./csrRealtorDashboard.php" class="anima-button circle-button btn-sm btn adr-cancel" adr_trans="label_back_home">Back To Home</a></p> -->
                </div>

        </div>




                </div>


            </div>


		<?php include "footer.php";  ?>
