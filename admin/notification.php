<?php
ob_start();

include "connection1.php";



?>

<?php include "header.php";  ?>

 <div class="section-empty bgimage1">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
      <hr class="space s">
                <div class="col-md-2">

     <?php include "sidebar.php";  ?>

                </div>
                <h5 class="text-center">Users Activities</h5>
<form name="search_filter" method="post" action="">
   <center><select name="module" class="form-control" style="width:175px;" id="module" onchange="this.form.submit()">
        <option value="">Select a module</option>
          <?php
              $modules=mysqli_query($con,"select distinct(module) from user_actions order by module");
              while($all_modules=mysqli_fetch_array($modules))
              {
              ?>
              <option value="<?php echo $all_modules['module']; ?>" <?php if(@$_REQUEST['module']==$all_modules['module']) { echo "selected"; } ?>><?php echo $all_modules['module']; ?></option>
              <?php } ?>
      </select>
      </center>
    </form>
<div class="col-md-10">

        <div class="col-md-12">



         <hr class="space s" />
      <table class="table table-striped" style="background:#000;color:#FFF;opacity:0.8;width:90%;border-radius:30px 30px 30px 30px!important;">
          <thead>
              <tr><th  class="text-center" style="">
                          S.No

                 </th><th  class="text-center" style="">
                          Module

                  </th><th  class="text-center" style="">
                          Action

                  </th><th  class="text-center" style="">
                          Action done by

                 </th><th  class="text-center" style="">
                          Action date

                 </th>
                 <!-- <th  class="text-center" style="">

                          Due date

                 </th> -->
                 </tr>
          </thead>
          <?php

            //  ---------------------------------  pagination starts ---------------------------------------
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
          //SELECT count(*) as total FROM orders where photographer_id='$loggedin_id' or created_by_id='$loggedin_id'
$count_query="select count(*) as total from user_actions";
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




     ?>

     <?php



  if (isset($_REQUEST['module'])) {
    $_SESSION['module_name']=$_REQUEST['module'];
 $new = $_SESSION['module_name'];

 $count_query="select count(*) as total from user_actions where module='$new' ";
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

  }

    elseif(!empty($_SESSION['module_name'])){
    $new = $_SESSION['module_name'];
  $count_query="select count(*) as total from user_actions where module='$new' ";
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

  }
  else{

    $new = "Appointment";
        $count_query="select count(*) as total from user_actions where module='$new' ";
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
  }

// $module_name=$_REQUEST['module'];



$entries_count=mysqli_query($con,"select count(*) as total from user_actions where module='$new'");
if($data_entries=mysqli_fetch_assoc($entries_count))
{

$total_entries=$data_entries['total'];
}
if($get_action_query=mysqli_query($con,"select * from user_actions where module='$new' limit $limit"))
{

 while($get_action=mysqli_fetch_assoc($get_action_query))
 {
   $cnt++;
   $date = date_create($get_action['action_date']);
   $date1=date_format($date, '  jS F Y, g:ia');

       if(($get_action['module']=="Appointment")||($get_action['module']=="Order")||($get_action['module']=="Finished images"))
        $redirect="notification.php";
        elseif($get_action['module']=="Profile")
        {
         $redirect="photographer_profile.php";
        }
        else{
          $redirect="Products.php";
        }
if($get_action['module']== $new)
{

  ?>
         <tr>
          <td class="text-center"><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?></td>
          <td class="text-center"><?php echo $get_action['module'] ?> </td>
          <td class="text-center"><?php echo $get_action['action'] ?> </td>
          <td class="text-center"><?php echo $get_action['action_done_by_name'] ?></td>
          <td class="text-center"><?php echo $date1 ?></td>
        </tr>

  <?php   }
}
}
?>
</tbody>
                  </table>

                  <div class="col-sm-6">
                        <ul class="pagination ">
                          <li class="first disabled" aria-disabled="true"><a href="./notification.php?page=1" class="button adr-save">«</a></li>
                          <li class="prev disabled" aria-disabled="true"><a href="<?php echo "./notification.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
                          <li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
                          <li class="next disabled" aria-disabled="true"><a href="<?php echo "./notification.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
                          <li class="last disabled" aria-disabled="true"><a href="<?php echo "./notification.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul>  </div>
                          <div class="col-sm-6 infoBar"style="margin-top:24px">
                          <div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to </span><?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_entries; ?><span adr_trans="label_entries"> entries</span></p></div>
                            <br>  <br>
                          </div>

<?php

 ?>


        </div>




                </div>


            </div>
        </div>


    <?php include "footer.php";  ?>
