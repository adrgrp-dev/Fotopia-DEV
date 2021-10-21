<?php

include "connection1.php";
$chat_List_options="";
$id_url=$_REQUEST['id'];
$logged_id=$_REQUEST['id1'];
$msg1=mysqli_query($con,"select * from chat_message where order_id='$id_url'");
while($msg=mysqli_fetch_array($msg1))
{

?>

<?php

 //<tr class="padding"><td><b style="float:left;color:blue">' echo $user_name;'</b><br /><span style="float:left;">' echo $msg['chat_message'];'</span><br /><span style="font-size:1opx;float:left;color:black;">' echo $msg['timestamp'] '</span></td></tr>';
if($_SESSION["admin_loggedin_id"]==$msg['from_user_id'] && $_SESSION["admin_loggedin_type"]==$msg['from_user_type'])
{

  $chat_List_options="<tr class='padding'><td align='right'><b style='float:right;color:#006600;font-size:9px!important;'>".$msg['from_user_type']." :</b><br /><span style='float:right;color:#000080;font-size:9px;text-align:justify;font-weight:600!important'>".$msg['chat_message']."</span><br /><span style='font-size:9px;float:right;color:black;'>".date("d M y h:i a",strtotime($msg['timestamp']))."</span></td></tr>";
  echo   $chat_List_options;
}
else {

  $chat_List_options="<tr class='padding'><td align='left'><b style='float:left;color:#006600;font-size:9px!important;'>".$msg['from_user_type']." :</b><br /><span style='float:left;color:#000080;font-size:9px;text-align:justify;font-weight:600!important'>".$msg['chat_message']."</span><br /><span style='font-size:9px;float:left;color:#000;'>".date("d M y h:i a",strtotime($msg['timestamp']))."</span></td></tr>";
  echo   $chat_List_options;
}


} ?>
