<?php
ob_start();

include "connection1.php";
$id_url=$_REQUEST['id'];

$get_data_order=mysqli_query($con,"select * from orders where id='$id_url'");
$get_order=mysqli_fetch_array($get_data_order);

$realtor_id = $get_order['created_by_id'];
   if(isset($_REQUEST['edit_appointment']))
   {
    $get_data_order1=mysqli_query($con,"select * from orders where id='$id_url'");
$get_order1=mysqli_fetch_array($get_data_order1);

$realtor_id = $get_order1['created_by_id'];
     $property =$_REQUEST["property"];
     $plan=$_REQUEST["plan"];

     $area=$_REQUEST["area"];
     $property_address=$_REQUEST["property_address"];

	   $rental_dormitory=@$_REQUEST["rental_dormitory"];
     $pht_id=$_REQUEST["pht_name"];
  //   print_r($pht_id);//--------------the line get from photographer_id value-------------------------------------------//
     $product=implode(",",$_REQUEST["product"]);
    // print_r($product);
     $notes=$_REQUEST["notes"];
     $status=1;
     $home_seller_id=$_REQUEST["hs_id"];
     $created_id=$_SESSION["loggedin_id"];
     //-------------------------------------------------get value request method------------------------------------------//
     $from_date=$_REQUEST["from"];
    // print_r($from_date);
     $to_date=$_REQUEST["to"];

     //-------------------------------------------------timestam format change---------------------------------------------//
     $from_exp=explode("T",$from_date);
     $to_exp=explode("T",$to_date);
     // $due_exp=explode("T",$due_date);
     //-------------------------------------------------t replace to space -----------------------------------------------//
     $chk_from=$from_exp[0]." ".$from_exp[1];
     $chk_to=$to_exp[0]." ".$to_exp[1];
     // $chk_due=$due_exp[0]." ".$due_exp[1];

     if(!empty($_REQUEST["due"]))
     {
     $due_date=$_REQUEST["due"];
     }
     else {
       $added_date=date("Y-m-d H:i:s",strtotime('+24 hours', strtotime($chk_to)));
 			$added_exp=explode(" ",$added_date);
 			$due_date=$added_exp[0]."T".$added_exp[1];
     }





                   //-------------------------------------------------------------value are insert in  database--------------------------------------------------------//

                 //  mysqli_query($con,"UPDATE `orders` SET `property_type`='$property',`number_of_floor_plans`='$plan',`area`='$area',`property_address`='$property_address',`rental_dormitory`='$rental_dormitory',`product_id`='$product',`session_from_datetime`='$chk_from',`session_to_datetime`='$chk_to',`order_due_date`='$due_date',`booking_notes`='$notes' WHERE id='$id_url'");
                  // mysqli_query($con,"UPDATE `appointments` SET `from_datetime`='$chk_from',`to_datetime`='$chk_to', WHERE order_id='$id_url'");
                    $loggedin_name=$_SESSION['loggedin_name'];
                   $loggedin_id=$_SESSION['loggedin_id'];
                //   echo "insert into appointment_updates (order_id,from_datetime,to_datetime,due_date,booking_notes,photographer_id,products)values('$id_url','$chk_from','$chk_to','$due_date','$notes','$loggedin_id','$product')";
                mysqli_query($con,"delete from appointment_updates where order_id='$id_url' and photographer_id='$loggedin_id' ");
              mysqli_query($con,"insert into appointment_updates (order_id,from_datetime,to_datetime,due_date,booking_notes,photographer_id,products)values('$id_url','$chk_from','$chk_to','$due_date','$notes','$loggedin_id','$product')");


                   $insert_action=mysqli_query($con,"INSERT INTO `user_actions`( `module`, `action`, `action_done_by_name`, `action_done_by_id`,`action_done_by_type`,`photographer_id`, `Realtor_id`,`action_date`) VALUES ('Appointment','Updated','$loggedin_name',$loggedin_id,'Photographer',$loggedin_id,$realtor_id,now())");





         if($_SESSION["user_type"]!='Photographer') {
              header("location:order_detail.php?id=".$id_url."&s=1#order");
            } else {
               header("location:Photographerorder_detail.php?id=".$id_url."&s=1#order");
           }

           }
           else
           {

                       echo '<script>alert("already booked");</script>';
           }

     }
     ?>

<?php include "header.php";  ?>
 <div class="section-empty bgimage8">
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
  //  alert("photo_id"+photo_id);

    var fromNew = new Date(document.getElementById("from").value);
//		alert("fromNew"+fromNew);
  var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes()-1)+":00";
  //  alert("fromNew1"+fromNew1);
  var toNew = new Date(document.getElementById("to").value);
//	alert("toNew"+toNew);
  var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes()-1)+":00";
   //alert("toNew1"+toNew1);
 // d.setDate(d.getDate() + 1);

  // d.setTime(d.getTime()+ 1);



   var value= $('#pht').val();
   alert("pht"+value);
   var a=0;
   var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){

      a=parseInt(this.responseText);
        alert(a);
       return check_app(a);
    }
  };
  xhttp.open("GET","check_appointment.php?photographer_id="+photo_id+"&fromDate="+fromNew1+"&toDate="+toNew1,true);
  xhttp.send();
  }
  function check_app(val)
  {
    if(val!=0)
    {
      alert("there is appointment");
     // $("#error1").html("There is another appoinment scheduled for the selected photographer <br> in between "+from+" and "+to+", Kindly choose different Date & Time.");
     // $("#error1").html(this.responseText);
    return false;
    }
    else
    {
      alert("no appointment");
    return true;
    }
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
                <h3 class="text-center" style=""> Edit Appointment</h3>

                <hr class="space s" />
                <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return booking_chk()" style="width: 100%;background:#000;color:#FFF;padding:10px;opacity:0.9;border-radius:25px 25px 25px 25px">
                <input type="hidden" name="hs_id" value="<?php echo @$_REQUEST["hs_id"]; ?>"/>
                <input type="hidden" name="od_id" id="od_id" value="<?php echo $id_url; ?>"/>
                <div class="col-md-4">
                <p>TYPE OF PROPERTY</p>
                <select name="property" class="form-control form-value" value="<?php echo  $get_order['property_type'];?>" required="" disabled="true">
                <option value="<?php echo $get_order['property_type']; ?>" selected  hidden><?php echo $get_order['property_type']; ?></option>
                <option value="Apartment">Apartment</option>
        				<option value="Home">Home</option>
                <option value="HolidayHome">Holiday Home</option>
                <option value="EmptyLand">Empty Land</option>
                </select>
                </div>
                <div class="col-md-4">
                <p>NO. OF FLOOR PLANS</p>
                <input id="plan" name="plan" placeholder="Enter The Floor Number " value="<?php echo  $get_order['number_of_floor_plans'];?>" type="number" min="0"  autocomplete="off" class="form-control form-value" required="" readonly>
                </div>
                <div class="col-md-4">
                <p>AREA (Sq.Mt)</p>
                <input id="area" name="area" placeholder="Enter The Area" value="<?php echo  $get_order['area'];?>" type="number"min="0" autocomplete="off" class="form-control form-value" required="" readonly>
                </div>
                <div class="col-md-12" class="l">
                  <p>Property Address</p>
                    <input id="property_address" name="property_address" value="<?php echo  $get_order['property_address'];?>" placeholder="Enter The Address" type="text" autocomplete="off" class="form-control form-value" required="" readonly>
                </div>

                <div class="col-md-6">
       <p>Property City</p>
      <select id="property_city" name="property_city" class="form-control form-value" required="" readonly>
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
       <p>Property State</p>
      <select id="property_state" name="property_state" class="form-control form-value"  required="" readonly>
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
                        <p>Property Zip code</p>
                        <input id="property_zip" name="property_zip" value="<?php echo  $get_order['property_zip'];?>" placeholder="Zip code" type="number" autocomplete="off" class="form-control form-value" readonly  required="">
                    </div>


    <div class="col-md-6">
       <p>Property Country</p>
      <select name="property_country" class="form-control form-value" readonly required="">
                    <option value="Norway">Norway</option>
                    <option value="US">US</option>
                    </select>
      </div>

          <div class="col-md-6">
                              <p>Property Phone No.</p>
                              <input id="property_contact_mobile" name="property_contact_mobile" placeholder="Enter The mobile Number" value="<?php echo  $get_order['property_contact_mobile'];?>" type="number" autocomplete="off" readonly class="form-control form-value">
                          </div>

          <div class="col-md-6">
                              <p>Property Email</p>
                              <input id="property_contact_email" name="property_contact_email" placeholder="Enter The email id" value="<?php echo  $get_order['property_contact_email'];?>" type="email" autocomplete="off" readonly class="form-control form-value" >
                              <br>
                          </div>
                <div class="col-md-6">
                <p>PHOTOGRAPHER NAME</p>
                <!-- <select name="pht_name" class="form-control form-value" required="" onchange="Get_Products(this.value);"> -->
                <?php
                $photographer_id=$get_order['photographer_id'];
                $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
                $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
                $photographer_Name=$get_name["first_name"];
                ?>
                <input list="options" name="pht" class="form-control form-value" id="photographer_name" value="<?php echo  $photographer_Name;?>" required="" placeholder="Select Photographer" onclick="Get_Products()" readonly/>
                <datalist id="options">
 	              <option value="">Select a Photographer</option>
                <?php $photographers="select * from user_login where type_of_user='Photographer' order by first_name";
                $Photographers_list=mysqli_query($con,$photographers);
                while($Photographers_list1=mysqli_fetch_assoc($Photographers_list))
                {?>
                <option data-value="<?php echo $Photographers_list1["id"]; ?>" value="<?php echo $Photographers_list1["first_name"];?>">
                <?php } ?>
                <!-- </select> -->
                </datalist>

                <input id="rental_dormitory"  value="<?php if($get_order['rental_dormitory'] == 1){ echo '1';}else {echo 0;} ?>" <?php if($get_order['rental_dormitory'] == 1){ echo 'checked';} ?> name="rental_dormitory"  type="checkbox" class=" form-value" readonly>&nbsp;&nbsp; This Property has a Rental Apartment/Dormitory

                </div>
                <input type="hidden" name="pht_name" id="photo_id" valuue="$get_order['']"/>
                <div class="col-md-6">
                <p>PRODUCT</p>
                <select name="product[]" id="products" class="form-control form-value" placeholder="Select Multiple Products" required="" multiple size=3>

                </select>
                </div>
                <hr class="space s" />
                <div class="col-md-4">
				<?php

				$get_appointment=mysqli_query($con,"select * from appointments where order_id='$id_url'");
				$get_appointment1=mysqli_fetch_array($get_appointment);

				?>
                <p>APPOINTMENT FROM DATE & TIME  </p>
                <input id="from" name="from" placeholder="select FromDate" value="<?php echo  str_replace(" ","T",$get_appointment1['from_datetime']);?>" type="datetime-local" onchange="setSecondDate()" autocomplete="off" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" class="form-control form-value" required="">
                </div>
                <div class="col-md-4">
                <p>APPOINTMENT TO DATE & TIME</p>
                <input id="to" name="to" placeholder="Select ToDate" value="<?php echo   str_replace(" ","T",$get_appointment1['to_datetime']);?>" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>" type="datetime-local" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="col-md-4">
                <p>DUE DATE & TIME</p>
                <input id="due" name="due" placeholder="Select DueDate" value="<?php echo  $get_order['order_due_date']."T".date('h:m');?>" min="<?php echo date('Y-m-d')."T".date('h:m'); ?>"  type="datetime-local" autocomplete="off" class="form-control form-value" required="" >
                </div>
                <div class="col-md-12">
                <p>BOOKING NOTES</p>
                <input id="notes" name="notes" placeholder="enter the notes" value="<?php echo  $get_order['booking_notes'];?>" type="text" autocomplete="off" class="form-control form-value" required="">
                </div>
                <div class="row">
                <div class="col-md-12"><center><hr class="space s">
                <div id="error1"></div>

                <p align="right">
                   <?php if($_SESSION["user_type"]!='Photographer') {  ?>
                     <button class="anima-button circle-button btn-sm btn adr-success" type="submit" name="edit_appointment"><i class="fa fa-sign-in"></i>update Appointment</button>
                             &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="order_detail.php?id=<?php echo $id_url;?>#order"><i class="fa fa-times"></i>Cancel</a>
                    <?php } else { ?>
                      <button class="anima-button circle-button btn-sm btn adr-success" type="submit" name="edit_appointment"><i class="fa fa-sign-in"></i>update Appointment</button>
                              &nbsp;&nbsp;<a class="anima-button circle-button btn-sm btn adr-cancel" href="Photographerorder_detail.php?id=<?php echo $id_url;?>#order"><i class="fa fa-times"></i>Cancel</a>
                     <?php } ?>


               </center>
               </div>

               </div>
               </form>

               </div>

                              <div class="col-md-2">
                <br/>
                <br/>
                 <h5 style="margin-left: 80%;margin-top: 18%;">Upcoming</h5><br/>

<table style="margin-left: 80px;background:#000;color:#FFF;border-radius:25px 25px 25px 25px;width: 250px;" class="table-responsive" aria-busy="false">
          <thead>
              <tr>
                <th style="padding: 5px;" class="text-center">

                          Date

                  </th>

                  <th style="padding: 5px;" class="text-center">

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
           <td  style="padding: 5px!important;"class="text-center"><?php echo $get_appointment_datetime['fromtime']."-". $get_appointment_datetime['totime'];  ?></td>
</tr>


<?php } ?>
</tbody>
</table>



            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
   $("#photographer_name").click();
    });
    </script>


		<?php include "footer.php";  ?>
