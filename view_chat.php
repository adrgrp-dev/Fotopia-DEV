<?php

include "connection1.php";
$chat_List_options="";
$id_url=$_REQUEST['id'];
$logged_id=$_REQUEST['id1'];
$msg1=mysqli_query($con,"select * from chat_message where order_id='$id_url'");
while($msg=mysqli_fetch_array($msg1))
{
  $from_user_id=$msg['from_user_id'];
  $get_name_query=mysqli_query($con,"select * from user_login where id='$from_user_id'");
  $get_name=mysqli_fetch_assoc($get_name_query);
  $user_name=$get_name["first_name"];
?>

<?php

 //<tr class="padding"><td><b style="float:left;color:blue">' echo $user_name;'</b><br /><span style="float:left;">' echo $msg['chat_message'];'</span><br /><span style="font-size:1opx;float:left;color:black;">' echo $msg['timestamp'] '</span></td></tr>';
if($_SESSION["loggedin_id"]==$msg['from_user_id'])
{

  $chat_List_options="<tr class='padding'><td align='right'><b style='float:right;color:yellow'>".$user_name." :</b><br /><span style='float:right;color:white'>".$msg['chat_message']."</span><br /><span style='font-size:10px;float:right;color:black;'>".$msg['timestamp']."</span></td></tr>";
  echo   $chat_List_options;
}
else {

  $chat_List_options="<tr class='padding'><td align='left'><b style='float:left;color:#66ff33'>".$user_name." :</b><br /><span style='float:left;color:white'>".$msg['chat_message']."</span><br /><span style='font-size:10px;float:left;color:black;'>".$msg['timestamp']."</span></td></tr>";
  echo   $chat_List_options;
}


} ?>
