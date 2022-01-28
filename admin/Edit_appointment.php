<?php
ob_start();
 
include "connection1.php";

if(isset($_REQUEST['del']))
{

 $id=$_REQUEST['id'];
  mysqli_query($con,"UPDATE `orders` SET `status_id` = '6' WHERE id =$id");
  if($_SESSION["admin_loggedin_type"]!='SubCSR') {
       header("location:superOrder_detail.php?id=".$id);
     }
   else {
        header("location:subOrder_detail.php?id=".$id);
    }
}

$id_url=@$_REQUEST['id'];

$get_data_order=mysqli_query($con,"select * from orders where id='$id_url'");
$get_order=mysqli_fetch_array($get_data_order);
$_SESSION['from']=$get_order['session_from_datetime'];
$_SESSION['to']=$get_order['session_to_datetime'];



   if(isset($_REQUEST['edit_appointment']))
   {
     $property =$_REQUEST["property"];
     $plan=$_REQUEST["plan"];

     $area=$_REQUEST["area"];
    $address_same=$_REQUEST["address_same"];
     $property_address=$_REQUEST["property_address"];
     $property_city=$_REQUEST["property_city"];
     $property_state=$_REQUEST["property_state"];
     $property_country=$_REQUEST["property_country"];
     $property_zip=$_REQUEST["property_zip"];

if(empty($_REQUEST["property_contact_mobile"]))
{
  $property_contact_mobile="";
}
else
{
  $property_contact_mobile = $_REQUEST["property_contact_mobile"];
}

if(empty($_REQUEST["property_contact_email"]))
{
  $property_contact_email="";
}
else
{
  $property_contact_email = $_REQUEST["property_contact_email"];
}
	   $rental_dormitory=$_REQUEST["rental_dormitory"];
     $pht_id=$_REQUEST["pht_name"];
  //   print_r($pht_id);//--------------the line get from photographer_id value-------------------------------------------//
     $product=implode(",",$_REQUEST["product"]);
    // print_r($product);
     $notes=$_REQUEST["notes"];
     $status=1;
     $home_seller_id=$_REQUEST["hs_id"];
     $created_id=$_SESSION["admin_loggedin_id"];
     //-------------------------------------------------get value request method------------------------------------------//
     $from_date=$_REQUEST["from"];
    // print_r($from_date);
     $to_date=$_REQUEST["to"];
     $due_date=$_REQUEST["due"];
     //-------------------------------------------------timestam format change---------------------------------------------//
     $from_exp=explode("T",$from_date);
     $to_exp=explode("T",$to_date);
     // $due_exp=explode("T",$due_date);
     //-------------------------------------------------t replace to space -----------------------------------------------//
     $chk_from=$from_exp[0]." ".$from_exp[1];
     $chk_to=$to_exp[0]." ".$to_exp[1];
     // $chk_due=$due_exp[0]." ".$due_exp[1];



           //------------------------------------------------------- check date time in database-------------------------------------------//
      //print_r($from_exp[0]);


                   if(($_SESSION['from']==$chk_from)&&($_SESSION['to']==$chk_to))
                   {
                     mysqli_query($con,"UPDATE `orders` SET `property_type`='$property',`number_of_floor_plans`='$plan',`area`='$area',`property_address`='$property_address',`property_city`='$property_city',`property_state`='$property_state',`property_country`='$property_country',`property_zip`='$property_zip',`property_contact_mobile`='$property_contact_mobile',`property_contact_email`='$property_contact_email',`address_same`='$address_same',`rental_dormitory`='$rental_dormitory',`product_id`='$product',`booking_notes`='$notes' WHERE id='$id_url'");
                     header("location:superOrder_detail.php?id=".$id_url."&s=1");
                   }
          else
                {
                   //-------------------------------------------------------------value are insert in  database--------------------------------------------------------/
                   mysqli_query($con,"UPDATE `orders` SET `property_type`='$property',`number_of_floor_plans`='$plan',`area`='$area',`property_address`='$property_address',`property_city`='$property_city',`property_state`='$property_state',`property_country`='$property_country',`property_zip`='$property_zip',`property_contact_mobile`='$property_contact_mobile',`property_contact_email`='$property_contact_email',`address_same`='$address_same',`rental_dormitory`='$rental_dormitory',`product_id`='$product',`session_from_datetime`='$chk_from',`session_to_datetime`='$chk_to',`order_due_date`='$due_date',`booking_notes`='$notes' WHERE id='$id_url'");
                   mysqli_query($con,"UPDATE `appointments` SET `from_datetime`='$chk_from',`to_datetime`='$chk_to' WHERE order_id='$id_url'");
                   $loggedin_name=$_SESSION['admin_loggedin_name'];
                   $loggedin_id=$_SESSION['admin_loggedin_id'];
                   $insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Updated','$loggedin_name',$loggedin_id,$pht_id,$loggedin_id,now())");
                   mysqli_query("delete from order_products where order_id='$id_url' and photographer_id='$pht_id'");
$products=mysqli_query($con,"select * from products where id in($product)");

while($products1=mysqli_fetch_array($products))
{
$product_id=$products1['id'];
$photographer_id=$products1['photographer_id'];
$product_title=$products1['title'];
$total_price=$products1['total_price'];
$photographer_cost=$products1['photographer_bata'];
$other_cost=$products1['other_cost'];
mysqli_query($con,"insert into order_products(order_id,product_id,photographer_id,product_title,total_price,photographer_cost,other_cost,created_on)values('$order_id','$product_id','$photographer_id','$product_title','$total_price','$photographer_cost','$other_cost',now())");

}


         if($_SESSION["admin_loggedin_type"]!='SubCSR') {
              header("location:superOrder_detail.php?id=".$id_url."&s=1");
            }
          else {
               header("location:superOrder_detail.php?id=".$id_url."&s=1");
           }

           }



     }


     ?>

<?php include "header.php";  ?>
 <div class="section-empty">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" >
	<?php include "sidebar.php"; ?>

  <script>
  function setSecondDate()
  {
var days = 1;
  var d = new Date(document.getElementById("from").value);

 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);
   $("#to").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes()));
  document.getElementById("to").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());

   $("#due").attr("min",d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes()));
  document.getElementById("due").value = d.getFullYear()+"-"+zeroPadded(d.getMonth()+1)+"-"+zeroPadded(d.getDate())+"T"+zeroPadded(d.getHours()+1)+":"+zeroPadded(d.getMinutes());


  }
  function zeroPadded(val) {
  if (val >= 10)
    return val;
  else
    return '0' + val;
}
  //---------------------------------------- validate greater than or not-----------------------------//
  function booking_chk()
  {
    var from=document.getElementById('from').value;

    var to=document.getElementById('to').value;
  //	alert("to"+to);
   var photo_id=document.getElementById('photo_id').value;
   //alert("photo_id"+photo_id);

    var fromNew = new Date(document.getElementById("from").value);
  //		alert("fromNew"+fromNew);
  var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes()-1)+":00";
  var fromNew2=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes())+":00";

  //  alert("fromNew1"+fromNew1);
  var toNew = new Date(document.getElementById("to").value);
  //	alert("toNew"+toNew);
  var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes()-1)+":00";
  var toNew2=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes())+":00";

   //alert("toNew1"+toNew1);
  // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);



   // var value= $('#photographer_name').val();
   // alert("pht"+value);
   var a=0;
   var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
      alert(this.responseText);
      a=this.responseText;

    }

  };
  xhttp.open("GET","check_edit_appointment.php?photographer_id="+photo_id+"&fromDate="+fromNew1+"&toDate="+toNew1+"&fromDate1="+fromNew2+"&toDate1="+toNew2,true);
  xhttp.send();
  if(a!=0)
  {
    alert("no");
   // $("#error1").html("There is another appoinment scheduled for the selected photographer <br> in between "+from+" and "+to+", Kindly choose different Date & Time.");
   // $("#error1").html(this.responseText);
  return false;
  }
  else
  {
    alert("yes");
  return true;
  }
  }

var photographer_id;
  function Get_Products()
{
  var value= $('#photographer_name').val();
  var photographer_id=$('#options [value="' + value + '"]').data('value');
  document.getElementById('photo_id').value=photographer_id;
  //console.log(d);
  var order_id=document.getElementById('od_id').value;
  console.log(order_id);
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){


       $("#products").html(this.responseText);


    }
  };
  xhttp.open("GET","Get_Products_for_edit.php?id="+order_id,true);
  xhttp.send();
}
  </script>
			</div>
                <div class="col-md-7">


                <hr class="space l" />
                <h3 class="text-center" style="" id="label_edit_appointment" adr_trans="label_edit_appointment"> Edit Appointment</h3>

                <hr class="space s" />
                <form action="" style="width: 100%;" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return booking_chk()">
                <!-- <input type="hidden" name="hs_id" value="<?php echo $_REQUEST["hs_id"]; ?>"/> -->
                <input type="hidden" name="od_id" id="od_id" value="<?php echo $id_url; ?>"/>
                 <div class="col-md-12">

             <input id="address_same" value="<?php if($get_order['address_same'] == 1){ echo '1';}else {echo 0;} ?>" <?php if($get_order['address_same'] == 1){ echo 'checked';} ?>  onchange="setpropertyAddress()" name="address_same" type="checkbox" class=" form-value">&nbsp;&nbsp;<span id="label_diff_property" adr_trans="label_diff_property">The property address is different from seller's address</span>

           </div>
            <script>

  function setpropertyAddress(){

var property_address="<?php echo @$get_order['property_address']; ?>";
var property_city="<?php echo @$get_order['property_city']; ?>";
var property_state="<?php echo @$get_order['property_state']; ?>";
var property_country="<?php echo @$get_order['property_country']; ?>";
var property_zip="<?php echo @$get_order['property_zip']; ?>";
var property_contact_mobile="<?php echo @$get_order['property_contact_mobile']; ?>";
var property_contact_email="<?php echo @$get_order['property_contact_email']; ?>";

              if($("#address_same").prop('checked') == true)
                {
                $("#property_address").val("");
                $("#property_city").val("");
                $("#property_state").val("");
                $("#property_country").val("");
                $("#property_zip").val("");
                $("#property_contact_mobile").val("");
                $("#property_contact_email").val("");


                $("#property_address").removeAttr("readonly");
                $("#property_city").removeAttr("readonly");
                $("#property_state").removeAttr("readonly");
                $("#property_country").removeAttr("readonly");
                $("#property_zip").removeAttr("readonly");
                $("#property_contact_mobile").removeAttr("readonly");
                $("#property_contact_email").removeAttr("readonly");
                }
                else
                {
                $("#property_address").val(property_address);
                $("#property_city").val(property_city);
                $("#property_state").val(property_state);
                $("#property_country").val(property_country);
                $("#property_zip").val(property_zip);
                $("#property_contact_mobile").val(property_contact_mobile);
                $("#property_contact_email").val(property_contact_email);


                $("#property_address").attr("readonly","readonly");
                $("#property_city").attr("readonly","readonly");
                $("#property_state").attr("readonly","readonly");
                $("#property_country").attr("readonly","readonly");
                $("#property_zip").attr("readonly","readonly");
                $("#property_contact_mobile").attr("readonly","readonly");
                $("#property_contact_email").attr("readonly","readonly");
                }
             }


                          </script>
                <div class="col-md-4">
                <p id="label_type_property" adr_trans="label_type_property">TYPE OF PROPERTY</p>
                <select name="property" class="form-control form-value" value="<?php echo  $get_order['property_type'];?>" required="">
                <option value="<?php echo $get_order['property_type']; ?>" selected  hidden><?php echo $get_order['property_type']; ?></option>
                <option value="Apartment">Apartment</option>
        				<option value="Home">Home</option>
                <option value="HolidayHome">Holiday Home</option>
                <option value="EmptyLand">Empty Land</option>
                </select>
                </div>
                <div class="col-md-4">
                <p id="label_floor_plans" adr_trans="label_floor_plans">NO. OF FLOOR PLANS</p>
                <input id="plan" name="plan" placeholder="Enter The Floor Number " value="<?php echo  $get_order['number_of_floor_plans'];?>" type="number" min="0"  autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-4">
                <p id="label_area" adr_trans="label_area">AREA (Sq.Mt)</p>
                <input id="area" name="area" placeholder="Enter The Area" value="<?php echo  $get_order['area'];?>" type="number"min="0" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-12" class="l">
                  <p id="label_property_address" adr_trans="label_property_address">Property Address</p>
                    <input id="property_address" name="property_address" readonly value="<?php echo  $get_order['property_address'];?>" placeholder="Enter The Address" type="text" autocomplete="off" class="form-control form-value" required="">
                </div>

                <div class="col-md-6">
       <p id="label_property_city" adr_trans="label_property_city">Property City</p>
      <select id="property_city" name="property_city" readonly class="form-control form-value" required="">
        <option value="<?php echo $get_order['property_city']; ?>" selected  hidden><?php echo $get_order['property_city']; ?></option>
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
       <p id="label_property_state" adr_trans="label_property_state">Property State</p>
      <select id="property_state" name="property_state" readonly class="form-control form-value"  required="">
       <option value="<?php echo $get_order['property_state']; ?>" selected  hidden><?php echo $get_order['property_state']; ?></option>
                   <?php
              $state1=mysqli_query($con,"select distinct(states) from norway_states_cities order by states asc ");
              while($state=mysqli_fetch_array($state1))
              {
              ?>
              <option value="<?php echo $state['states']; ?>"><?php echo $state['states']; ?></option>
              <?php } ?>
                    </select>
      </div>
     <div class="col-md-6">
                        <p id="label_property_zip" adr_trans="label_property_zip">Property Zip code</p>
                        <input id="property_zip" readonly name="property_zip" value="<?php echo  $get_order['property_zip'];?>" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value"   required="">
                    </div>


    <div class="col-md-6">
       <p id="label_property_country" adr_trans="label_property_country">Property Country</p>
      <select name="property_country" readonly class="form-control form-value" required="">
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p id="label_property_phone" adr_trans="label_property_phone">Property Phone No.</p>
                              <input id="property_contact_mobile" readonly name="property_contact_mobile" placeholder="Enter The mobile Number" value="<?php echo  $get_order['property_contact_mobile'];?>" type="number" autocomplete="off" class="form-control form-value">
                          </div>

          <div class="col-md-6">
                              <p id="label_property_email" adr_trans="label_property_email">Property Email</p>
                              <input id="property_contact_email" readonly name="property_contact_email" placeholder="Enter The email id" value="<?php echo  $get_order['property_contact_email'];?>" type="email" autocomplete="off" class="form-control form-value" >
                              <br>
                          </div>

                <div class="col-md-6">
                <p id="label_photographer_name" adr_trans="label_photographer_name">PHOTOGRAPHER NAME</p>
                <!-- <select name="pht_name" class="form-control form-value" required="" onchange="Get_Products(this.value);"> -->
                <?php
                $photographer_id=$get_order['photographer_id'];


                $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                $photographer_Name=@$get_name["first_name"];
                ?>
                <input list="options" name="pht" class="form-control form-value" id="photographer_name" value="" required="" placeholder="Select Photographer" onclick="get_product()" />
                <datalist id="options">
 	              <option value="">Select a Photographer</option>
                    <?php
                   if($_SESSION['admin_loggedin_type'] == 'SuperCSR'){
                  $super_csr_id = $_SESSION['admin_loggedin_id'];
                  $photographers="select * from user_login where type_of_user='Photographer' AND pc_admin_id='$super_csr_id'  order by first_name";

                   }
                   elseif ($_SESSION['admin_loggedin_type'] == 'SubCSR') {

                      $sub_csr_id = $_SESSION['admin_loggedin_id'];
                      $photographers="select * from user_login where type_of_user='Photographer' AND csr_id='$sub_csr_id'  order by first_name";
                   }

                $Photographers_list=mysqli_query($con,$photographers);
                while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
                {?>
                  <?php echo $Photographers_list1["first_name"]; ?>
                <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1["first_name"];?>">
                <?php } ?>
                <!-- </select> -->
                </datalist>

                <input id="rental_dormitory"  value="<?php if($get_order['rental_dormitory'] == 1){ echo '1';}else {echo 0;} ?>" <?php if($get_order['rental_dormitory'] == 1){ echo 'checked';} ?> name="rental_dormitory"  type="checkbox" class=" form-value">&nbsp;&nbsp; <span id="label_diff_property" adr_trans="label_diff_property">This Property has a Rental Apartment/Dormitory </span>

                </div>
                <input type="hidden" name="pht_name" id="photo_id" valuue="$get_order['']"/>
                <div class="col-md-6">
                <p id="label_product" adr_trans="label_product">PRODUCT</p>
                <select name="product[]" id="products" class="form-control form-value" placeholder="Select Multiple Products" required="" multiple size=3>

                </select>
                </div>
                <hr class="space s" />
                <div class="col-md-4">
                <p id="label_appointment_from" adr_trans="label_appointment_from">APPOINTMENT FROM DATE & TIME  </p>
                <input id="from" name="from" placeholder="select FromDate" value="<?php echo  str_replace(" ","T",$get_order['session_from_datetime']);?>" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" type="datetime-local" onchange="setSecondDate();" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-4">
                <p id="label_appointment_to" adr_trans="label_appointment_to">APPOINTMENT TO DATE & TIME</p>
                <input id="to" name="to" placeholder="Select ToDate" value="<?php echo   str_replace(" ","T",$get_order['session_to_datetime']);?>" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" type="datetime-local" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-4">
                <p id="label_due_date_time" adr_trans="label_due_date_time">DUE DATE & TIME</p>
                <input id="due" name="due" placeholder="Select DueDate" value="<?php echo  $get_order['order_due_date']."T".date('h:m');?>" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" type="datetime-local" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-12">
                <p id="label_booking_notes" adr_trans="label_booking_notes">BOOKING NOTES</p>
                <input id="notes" name="notes" placeholder="enter the notes" value="<?php echo  $get_order['booking_notes'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="row">
                <div class="col-md-12"><center><hr class="space s">
                <div id="error1"></div>


                   <?php if($_SESSION["admin_loggedin_type"]!='Photographer') {  ?>
                     &nbsp;&nbsp;<a id="label_decline_order" adr_trans="label_decline_order"  class="anima-button circle-button btn-sm btn adr-cancel float-left" style="float:left;"href="Edit_appointment.php?del=1&id=<?php echo $id_url;?>"><i class="fa fa-times"></i>Decline the Order</a>
                     <button id="label_update_order" adr_trans="label_update_order" class="anima-button circle-button btn-sm btn adr-success float-right"  style="float:right;" type="submit" name="edit_appointment"><i class="fa fa-sign-in"></i>Update the Order</button>

                    <?php } else { ?>
                      <button id="label_update_appointment<" adr_trans="label_update_appointment" class="anima-button circle-button btn-sm btn adr-success" type="submit" name="edit_appointment"><i class="fa fa-sign-in"></i>update Appointment</button>
                              &nbsp;&nbsp;<a  id="label_cancel" adr_trans="label_cancel" class="anima-button circle-button btn-sm btn adr-cancel" href="superOrder_detail.php?id=<?php echo $id_url;?>#order"><i class="fa fa-times"></i>Cancel</a>
                     <?php } ?>


               </center>
               </div>

               </div>
               </form>

               </div>
                              <div class="col-md-2">
                <br/>
                <br/>
                 <h5 style="margin-left: 80%;margin-top: 18%;"id="label_upcoming" adr_trans="label_upcoming">Upcoming</h5><br/>

<table style="margin-left: 80px;background:#000;color:#FFF;border-radius:25px 25px 25px 25px;width: 250px;" class="table-responsive" aria-busy="false">
          <thead>
              <tr>
                <th style="padding: 5px;" class="text-center" id="label_date" adr_trans="label_date">

                          Date

                  </th>

                  <th style="padding: 5px;" class="text-center" id="label_timing" adr_trans="label_timing">

                          Timing

                 </th>

                </tr>

              </thead>
 <tbody>
              <?php

             $right_side_orderID = $_REQUEST['id'];

$get_order_photographer=mysqli_query($con,"SELECT photographer_id FROM `orders` where id='$right_side_orderID'");
$get_order_photographerID=mysqli_fetch_array($get_order_photographer);

$exact_order_photographerID = $get_order_photographerID['photographer_id'];



$get_appointment_details = mysqli_query($con,"SELECT date(from_datetime) as fromdate,time_format(from_datetime,'%h:%i %p') as fromtime,time_format(to_datetime,'%h:%i %p') as totime FROM `appointments` where photographer_id='$exact_order_photographerID' and from_datetime>now() limit 10");

 while($get_appointment_datetime=mysqli_fetch_array($get_appointment_details))
          {
          ?>

          <tr>
          <td style="padding: 5px!important;" class="text-center"><?php echo $get_appointment_datetime['fromdate'];  ?></td>
           <td style="padding: 5px!important;" class="text-center"><?php echo $get_appointment_datetime['fromtime']."-". $get_appointment_datetime['totime'];  ?></td>
</tr>


<?php } ?>
</tbody>
</table>


               </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
   $("#photographer_name").click();
    });
    </script>


		<?php include "footer.php";  ?>
