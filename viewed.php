<?php
include "connection.php";
$id=$_REQUEST['id'];
echo "UPDATE `img_upload` SET `disapprove`=0 WHERE id=$id";
mysqli_query($con,"UPDATE `img_upload` SET `disapprove`=0 WHERE id=$id");
?>
