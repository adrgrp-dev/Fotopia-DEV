<?php
ob_start();

include "connection1.php";


$id_url=$_REQUEST['id'];
$order_id=trim(" ",$id_url);
$get_order_query=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
$get_order=mysqli_fetch_array($get_order_query);
$home_sell_id=$get_order['home_seller_id'];
if(isset($_REQUEST['UpdateOrder']))
{
$fnd_address = $_REQUEST["fnd_address"];
$sell_name = $_REQUEST["sell_name"];
$address = $_REQUEST["address"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zip = $_REQUEST["zip"];
$country = $_REQUEST["country"];
$mobile_no = $_REQUEST["mobile_no"];
$email_id = $_REQUEST["email_id"];
if(empty($_REQUEST["ref_no"]))
{
  $ref_no=0;
}
else
{
$ref_no = $_REQUEST["ref_no"];
}
//--------------------------------------------------contact person name--------------------------------------------
if(empty($_REQUEST["name"]))
{
  $name="";
}
else
{
$name = $_REQUEST["name"];
}
//-----------------------------------------------------contact person mobileno-----------------------------------------
if(empty($_REQUEST["mobile_no1"]))
{
  $mobile_no1="";
}
else
{
$mobile_no1 = $_REQUEST["mobile_no1"];
}
//--------------------------------------------------contact person emailid---------------------------------------------------
if(empty($_REQUEST["email_id1"]))
{
  $email_id1="";
}
else
{
  $email_id1 = $_REQUEST["email_id1"];
}

$update_homeseller=mysqli_query($con,"UPDATE `home_seller_info` SET `name`='$sell_name',`address`='$address',`mobile_number`='$mobile_no',`email`= ' $email_id ',`city`='$city',`state`='$state',`country`='Norway',`zip`='$zip',`reference_number`='$ref_no',`contact_person_name`='$name',`contact_person_mobile`='$mobile_no1',`contact_person_email`='$email_id1',`notes`=' ' where id='$home_sell_id'");
$loggedin_name=$_SESSION['loggedin_name'];
$loggedin_id=$_SESSION['loggedin_id'];
$insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`, `Realtor_id`,`action_date`) VALUES ('Order','Updated','$loggedin_name',$loggedin_id,'Realtor',$loggedin_id,now())");

            if($_SESSION["user_type"]!='Photographer') {
             header("location:order_detail.php?id=".$id_url."&a=1#home");

             } else {
              header("location:Photographerorder_detail.php?id=".$id_url."&a=1#home");
             }

}



 ?>
<?php include "header.php";  ?>

<script>
$('#anc1').removeAttr('onclick');
function myfunc()
{
  var today = new Date();
  var dd = ("0" + today.getDate()).slice(-2)
  var mm = ("0" + (today.getMonth() + 1)).slice(-2);
  var yyyy = today.getFullYear();
  var date=yyyy+'-'+mm+'-'+dd+'T00:00';
document.getElementById('from').min=date;
  document.getElementById('to').min=date;
  document.getElementById('due').min=date;

}
//---------------------------------------- validate greater than or not-----------------------------//
function booking_chk()
{
  var from=document.getElementById('from').value;
  var to=document.getElementById('to').value;
  var err=document.getElementById('error');
   err.style.display="block";
    err.style.color="red";
  if((from =="")||(to =="")){
    err.innerHTML="Please select fromdate and todate"; return false;}
  else
  {
    if(from < to)
      return true;
    else
    {
      err.innerHTML="To date must be greater than From Date";
      return false;
    }
  }
}
function unactive()
{
  console.log("clicked");
var c = document.getElementById("activechange1").

}
function unactive1()
{
  document.getElementById('activechange2');

}

var photographer_id;
function Get_Products(photographer_id)
{
var xhttp= new XMLHttpRequest();
xhttp.onreadystatechange = function()
{
  if(this.readyState == 4 && this.status == 200){


     $("#products").html(this.responseText);


  }
};
xhttp.open("GET","Get_Products.php?photographer_id="+photographer_id,true);
xhttp.send();
}
</script>

 <div class="section-empty">
        <div class="container" style="margin-left:0px;height:inherit">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>

			</div>


      <div class="col-md-10" style="padding-top:30px;">


           <h3 class="text-center" style="">Edit Order</h3>
           <hr class="space s" />
           <?php if(@isset($_REQUEST["st"])) { ?>
                        <div class="success-box" style="display:block;">
                            <div class="text-success"><i>Congratulations. Your message has been sent successfully</i></div>
                        </div>
           <?php } ?>

           <?php
           $id_url=$_REQUEST['id'];
           $get_order_query=mysqli_query($con,"SELECT * FROM orders where id='$id_url'");
           $get_order=mysqli_fetch_array($get_order_query);
           $home_sell_id=$get_order['home_seller_id'];?>
           <?php
           $get_data_homeseller=mysqli_query($con,"select * from home_seller_info where id='$home_sell_id'");
           $get_homeseller=mysqli_fetch_array($get_data_homeseller);
           ?>
    <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="">

    <div class="col-md-12">
                        <p>FIND ADDRESS</p>
                        <input id="fnd_address" name="fnd_address" placeholder="Update The Address" type="text" autocomplete="off" class="form-control form-value">
                        <span style="float:right;margin-top:-30px;"><i class="fa fa-search" style="margin-left:-25px;"></i></span>
    </div>

    <div class="col-md-6">
                        <p>HOME SELLER NAME</p>
                        <input id="sell_name" name="sell_name" placeholder="Update The home seller name" value="<?php echo  $get_homeseller['name'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
    </div>
    <div class="col-md-6">
                        <p>Assignment no</p>
                        <input id=" ref_no" name="ref_no" placeholder="Update The Assignment Number" value="<?php echo  $get_homeseller['reference_number'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
    </div>
    <div class="col-md-12">
                        <p>ADDRESS</p>
                        <input id="address" name="address" placeholder="Update The Address" value="<?php echo  $get_homeseller['address'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
                      </div>
    <div class="col-md-6">
       <p>CITY</p>
      <select name="city" class="form-control form-value" value="<?php echo  $get_homeseller['city'];?>" required="">
        	<option value="<?php echo $get_homeseller['city']; ?>" selected  hidden><?php echo $get_homeseller['city']; ?></option>
                    <?php
							$city1=mysqli_query($con,"select cities from norway_states_cities order by cities asc");
							while($city=mysqli_fetch_array($city1))
							{
							?>
							<option value="<?php echo $city['cities']; ?>"><?php echo $city['cities']; ?></option>
							<?php } ?>
                    </select>
      </div>

      <div class="col-md-6">
       <p>STATE</p>
      <select name="state" class="form-control form-value" value="<?php echo  $get_homeseller['state'];?>" required="">
            	<option value="<?php echo $get_homeseller['state']; ?>" selected  hidden><?php echo $get_homeseller['state']; ?></option>
                   <?php
							$state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc");
							while($state=mysqli_fetch_array($state1))
							{
							?>
							<option value="<?php echo $state['states']; if($state['states'] == $get_homeseller['state'] ){ echo "selected"; }?>"><?php echo $state['states']; ?></option>
							<?php } ?>
                    </select>
      </div>
     <div class="col-md-6">
                        <p>ZIP CODE</p>
                        <input id="zip" name="zip" placeholder="Update Zip code"value="<?php echo  $get_homeseller['zip'];?>" type="number" autocomplete="off" class="form-control form-value" required="">
                    </div>


    <div class="col-md-6">
       <p>COUNTRY</p>
      <select name="country" class="form-control form-value"  value="<?php echo  $get_homeseller[''];?>" required="">
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p>MOBILE NO</p>
                              <input id="mobile_no" name="mobile_no" placeholder="Update The mobile Number" value="<?php echo  $get_homeseller['mobile_number'];?>" type="number" autocomplete="off" class="form-control form-value" required="">
                          </div>

          <div class="col-md-6">
                              <p>EMAIL ID</p>
                              <input id="email_id" name="email_id" placeholder="Update The email id" value="<?php echo  $get_homeseller['email'];?>" type="email" autocomplete="off" class="form-control form-value" required="">
                              <br>
                          </div>

          <div class="col-md-12" >
          <h4><b> CONTACT PERSON</b></h4>

         </div>

          <div class="col-md-6">
                              <p>NAME</p>
                              <input id="name" name="name" placeholder="Update The name" visibility="hidden" value="<?php echo  $get_homeseller['contact_person_name'];?>" type="text" autocomplete="off" class="form-control form-value" >

          </div>
        <div class="col-md-6">
                        <p>MOBILE NO</p>
                        <input id="mobile_no1" name="mobile_no1" placeholder="Update The mobile number" value="<?php echo  $get_homeseller['contact_person_mobile'];?>" type="number" autocomplete="off" class="form-control form-value">
        </div>

        <div class="col-md-6">
                        <p>EMAIL ID</p>
                          <input id="email_id1" name="email_id1" placeholder="Update The email id" value="<?php echo  $get_homeseller['contact_person_email'];?>" type="email" autocomplete="off" class="form-control form-value">
        </div>


     <div class="row">
                    <div class="col-md-12"><center><hr class="space s">


                         <?php if($_SESSION["user_type"]!='Photographer') {  ?>
                           <button class="anima-button circle-button btn-sm btn adr-success" type="submit" name="UpdateOrder"><i class="fa fa-sign-in"></i>Update order</button>
                                     &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="order_detail.php?id=<?php echo$id_url;?>#home"><i class="fa fa-times"></i>Cancel</a>
                          <?php } else { ?>
                            <button class="anima-button circle-button btn-sm btn adr-success" type="submit" name="UpdateOrder"><i class="fa fa-sign-in"></i>Update order</button>
                                      &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="Photographerorder_detail.php?id=<?php echo$id_url;?>#home"><i class="fa fa-times"></i>Cancel</a>
                           <?php }  ?>



</center>
     </div>



                </div>
                 </form>



            </div>
        </div>
     </div>
   </div>



		<?php include "footer.php";  ?>
