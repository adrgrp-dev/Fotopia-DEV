<?php
include "header.php";
include "connection.php";
 ?>
<div>
  <?php
  $get_comment_querry=mysqli_query($con,"select * from img_upload where order_id=16 and img='1618480758-1618480758-images.jpg'");
  $get_comment=mysqli_fetch_assoc($get_comment_querry);

  ?>
<input type="text" id="comment" value="<?php echo $get_comment['comments'];?>">
</div>

<script>
$('#comment').keypress(function (e) {
var key = e.which;
if(key == 13)
{
  alert("sasdaasd");
  var a="1618480758-1618480758-images.jpg";
  var b=16;
  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
  //document.getElementById("demo").innerHTML = this.responseText;
 }
};
xhttp.open("GET","comment.php?id="+b+"&img_id="+a, true);
xhttp.send();

}
});
</script>
