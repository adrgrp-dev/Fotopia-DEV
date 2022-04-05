<?php
ob_start();

include "connection1.php";



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

</style>
<?php include "header.php";  ?>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>


			</div>
                <div class="col-md-10">
              	<h5 class="text-center" >Recent Activities</h5>

                <table class="table table-condensed table-hover table-striped bootgrid-table" style="margin-left:10px;" aria-busy="false">
                  <thead>
                    <tr>
                      <th ><span  adr_trans="label_s.no">S.no</span></th>
                     <th ><span adr_trans="label_activity">Activity</span></th>
                   </tr>
                 </thead>
                <tbody>
                  <?php
                    //	---------------------------------  pagination starts ---------------------------------------
                        $loggedin_id=$_SESSION['loggedin_id'];
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
                  $count_query="select count(*) as total from user_actions where action_done_by_id='$loggedin_id' or realtor_id='$loggedin_id'";
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


                   $get_action_query=mysqli_query($con,"select * from user_actions where action_done_by_id='$loggedin_id' or realtor_id='$loggedin_id' ORDER BY id DESC limit $limit  ");
				   $sno=1;
                   while($get_action=mysqli_fetch_assoc($get_action_query))
                   {   $cnt++;

                     $date = date_create($get_action['action_date']);
                     $date1=date_format($date, '  jS F Y, g:ia');




                       ?>
                       <?php
                       if($get_action['module']=="Order" || $get_action['module']=="Appointment")
                       {?>
                           <tr><td><?php echo $sno; ?></td><td><?php echo'<a href="order_list.php" style="color:blue;font-size:12px;">'.$get_action['module'].' '.  $get_action['action'].' by You on'.$date1.'</a>';?></td></tr>
                      <?php } ?>

                  <?php $sno++; } ?>
               </tbody>
                  </table>

                  <div class="col-sm-6">
                        <ul class="pagination ">
                          <li class="first disabled" aria-disabled="true"><a href="./photographeractivity.php?page=1" class="button adr-save">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./photographeractivity.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:24px">
                          <div class="infos"><p align="right">Showing <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?> to <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?>entries</p></div>
                            <br>  <br>
                          </div>



                  <p align="right">   <a href="photographerDashboard.php" class="anima-button circle-button btn-sm btn adr-cancel" >Back To Home</a></p>

        </div>




                </div>


            </div>
        </div>

		</div>
		<?php include "footer.php";  ?>
