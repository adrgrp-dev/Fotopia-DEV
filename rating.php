<?php
ob_start();

include "connection1.php";


  $order_id=$_REQUEST['order_id'];

  $order=mysqli_query($con,"select * from orders where id='$order_id'");
$order1=mysqli_fetch_array($order);

$photographer_id=$order1['photographer_id'];
$created_by_id=$order1['created_by_id'];

$userDetail=mysqli_query($con,"select * from user_login where id='$photographer_id'");
$userDetail1=mysqli_fetch_array($userDetail);

$first_name = $userDetail1['first_name'];
$last_name = $userDetail1['last_name'];

if(isset($_REQUEST['RateNow']))
{
$photographer_id=$_REQUEST['photographer_id'];

$getSuperCSRID=mysqli_query($con,"select pc_admin_id from user_login where id='$photographer_id'");
$getSuperCSRID1=mysqli_fetch_array($getSuperCSRID);

$super_csr_id=$getSuperCSRID1['pc_admin_id'];
$realtor_id=$_REQUEST['realtor_id'];
$order_id=$_REQUEST['order_id'];
$rating=$_REQUEST['rating'];
$comment=$_REQUEST['comment'];
mysqli_query($con,"insert into photographer_rating(photographer_id,super_csr_id,realtor_id,order_id,rating,comment,rating_date)values('$photographer_id','$super_csr_id','$realtor_id','$order_id','$rating','$comment',now())");

$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];
$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `photographer_id`,`action_date`) VALUES ('Rating','provided','$loggedin_name',$loggedin_id,'Realtor',$photographer_id,now())");

header("location:order_list.php?rate=1");
}

?>


<?php include "header.php";  ?>


<script>
var rateIs;
function RateNow(rateIs)
{
$("#rateNumber").text(rateIs);
$("#rating").val(rateIs);

for(var j=1;j<=5;j++)
{
$("#star-"+j).removeClass("fa-star");
$("#star-"+j).addClass("fa-star-o");
}

for(var i=1;i<=rateIs;i++)
{
$("#star-"+i).removeClass("fa-star-o");
$("#star-"+i).addClass("fa-star");
}

}


function confirmRating()
{
var rateingIs=$("#rating").val();
if(rateingIs==0)
{
alert("Please click on stars and provide rating.");
return false;
}
 var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Er du sikker på at du vil sende inn vurderingen";
		}
		else
		{
		alertmsg="Are you sure want to submit the rating";
		}

if(confirm(alertmsg+"?"))
{
return true;
}
else
{
return false;
}
}
</script>
 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">

	   <?php include "sidebar.php";  ?>

                </div>


                <div class="col-md-8" >
				<!-- <p align="center"><h5 class="text-center" adr_trans="label_photographer_rating"><br>Photographer Rating</h5></p> -->
				<table class="table-responsive" align="center"  style="background: #FFF;margin-top:30px;width:50%;border-radius:10px!important;">
				<tr><td align="center" style="color:#337AB7;font-size:15px;padding:20px;"><span adr_trans="label_">Rate the Photographer </span>- <?php echo $first_name." ".$last_name; ?></td></tr>
				<tr><td align="center" style="font-size:18px;padding-top:30px;">
				<p align="center" style="padding-bottom:20px;"><label id="rateNumber">0</label> Out of 5</p>
				<i class="fa fa-star-o" id="star-1" style="padding:5px;color:#337AB7;" onClick="RateNow(1)"></i>
				<i class="fa fa-star-o" id="star-2" style="padding:5px;color:#337AB7;" onClick="RateNow(2)"></i>
				<i class="fa fa-star-o" id="star-3" style="padding:5px;color:#337AB7;" onClick="RateNow(3)"></i>
				<i class="fa fa-star-o" id="star-4" style="padding:5px;color:#337AB7;" onClick="RateNow(4)"></i>
				<i class="fa fa-star-o" id="star-5" style="padding:5px;color:#337AB7;" onClick="RateNow(5)"></i>
				</td></tr>
				<tr><td align="center" style="padding-top:30px;">
				<form name="ratingForm" method="post" action="" onSubmit="return confirmRating();">
				<input type="hidden" name="rating" id="rating" value="0">
				<input type="hidden" name="order_id"  value="<?php echo $order_id; ?>">
				<input type="hidden" name="realtor_id"  value="<?php echo $_SESSION['loggedin_id']; ?>">
				<input type="hidden" name="photographer_id"  value="<?php echo $photographer_id; ?>">
				<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span adr_trans="label_comments">Comment</span></p>
				<textarea name="comment" class="form-control" style="margin:10px;width:350px"  placeholder="Type your comments"></textarea>
				<input type="submit" name="RateNow" value="Submit" class="btn btn-primary adr-save" style="margin:20px;">
				</form>
				</td></tr>
				</table>
  </div>
	</div>
	</div>
</div>



		<?php include "footer.php";  ?>
