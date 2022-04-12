<?php
ob_start();

include "connection1.php";
$loggedin_id=$_SESSION['admin_loggedin_id'];
mysqli_query($con,"update user_actions set is_read=1,csr_read=1 where (action_done_by_id='$loggedin_id' or csr_id='$loggedin_id') and (is_read=0 or csr_read=0)");


?>

<style>
th{

    background: #aad1d6;
    padding-top: 10px !important;
    padding-bottom: 10px;
    padding-left: 3px !important;
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
      <h5 class="text-left"><span id="label_notification" adr_trans="label_notification" style="color:#000">Notifications</span>(<?php echo $countIs; ?>)</h5>
                <div class="col-md-10" style="background-color: white;margin-top: 0px;padding: 5px;border-radius: 5px;">
<?php

$csr_count_query="select count(*) as total from user_actions where ((action_done_by_id='$loggedin_id' and action_done_by_type='CSR') or csr_id='$loggedin_id') and (is_read=0 or csr_read=0)";
                  $csr_count_result=mysqli_query($con,$csr_count_query);
          $csr_data=mysqli_fetch_assoc($csr_count_result);
                  $countIs=$csr_data['total'];
 ?> 
  <hr class="space xs">            
<table class="" align="center" style="color: #000;opacity:0.9;width:98%;" aria-busy="false">
                  <thead>
                    <tr>
                       <th id="label_s.no" adr_trans="label_s.no" style="padding-left:30px!important;">Sno</th>
                      <th style="padding-left:30px!important;"><span adr_trans="label_activity">Activity</span></th>
					  <th style="padding-left:30px!important;"><span adr_trans="label_date_and_time">Date & Time</span></th>
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

$count_query="select count(*) as total from user_actions where ((action_done_by_id='$loggedin_id' and action_done_by_type='CSR') or csr_id='$loggedin_id') and is_read=1";
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

 if($get_action_query=mysqli_query($con,"select * from user_actions where (action_done_by_id='$loggedin_id' or csr_id='$loggedin_id') and is_read=1 ORDER BY id DESC limit $limit  "))
 {
 while($get_action=mysqli_fetch_assoc($get_action_query))
 {
   $cnt++;
   $date = date_create($get_action['action_date']);
   $date1=date_format($date, '  jS F Y, g:ia');



   if($_SESSION["admin_loggedin_type"]='CSR')
    {
       if(($get_action['module']=="Appointment")||($get_action['module']=="Order")||($get_action['module']=="Finished images")||($get_action['module']=="Canceled"))
        $redirect="subcsrOrder_list1.php";
        elseif($get_action['module']=="Profile")
        {
         $redirect="csr_profile.php";
        }
        elseif($get_action['module']=="Rating")
        {
         $redirect="#";
        }
        else{
          $redirect="csr_products.php";
        }
      }
      else
       {

     }
     ?>
     <?php
     if($get_action['module']=="Profile" || $get_action['module']=="Product")
     { ?>
         <tr class="listPageTR"><td style="padding-left:30px!important;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important;"><?php echo'<a href='.$redirect.' style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].' by You </a>';?></td><td style="color:blue;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
          <tr><td class="listPageTRGap">&nbsp;</td></tr>
                      <?php }
                      elseif($get_action['module']=="Chat Message" )
                                  {
                       $orderID=$get_action['order_id'];
                       ?>
                                      <tr class="listPageTR"><td style="padding-left:30px!important;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important;"><?php echo'<a href="superOrder_detail.php?id='.$orderID.'" style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].'';?></td><td style="color:#000;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
                                        <tr><td class="listPageTRGap">&nbsp;</td></tr>
                                 <?php }
                       else {  ?>
                          <tr class="listPageTR"><td style="padding-left:30px!important;"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td><td style="padding-left:30px!important;"><?php echo'<a href='.$redirect.' style="color:blue;font-size:12px;text-decoration:underline">'.$get_action['module'].' '.  $get_action['action'].' by '.$get_action['action_done_by_name']. '</a>';?></td><td style="color:#000;font-size:12px;padding-left: 30px!important"><?php echo $date1; ?></td></tr>
                            <tr><td class="listPageTRGap">&nbsp;</td></tr>

  <?php   } ?>

<?php } }?>
               </tbody>
                  </table>
              

                  <div class="col-sm-6">
                        <ul class="pagination " style="font-weight:bold!important;padding-left: 7px;">
                          <li class="first disabled" aria-disabled="true"><a href="./csr_activity.php?page=1" class="button">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./csr_activity.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./csr_activity.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./csr_activity.php?page=".($Page_check);?>" class="button">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:24px">
                          <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?>  of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></p></div>
                            <br> 
                          </div>



                  <!-- <p align="right" id="label_back_home" adr_trans="label_back_home">   <a href="subcsr_dashboard.php" class="anima-button circle-button btn-sm btn adr-cancel" style="margin-bottom: 10px;margin-right: 15px;" ><i class="fa fa-sign-out"></i>Back To Home</a></p>
 -->
        </div>




                </div>


            </div>
          </div>



		<?php include "footer.php";  ?>
