<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($order_id,$condition,$con)
{
	/* Exception class. */
	require 'C:\PHPMailer\src\Exception.php';

	/* The main PHPMailer class. */
	require 'C:\PHPMailer\src\PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'C:\PHPMailer\src\SMTP.php';

	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = $_SESSION['emailHost'];
	$mail->SMTPAuth = true;
	// //paste one generated by Mailtrap
	// //paste one generated by Mailtrap
	$mail->Username =$_SESSION['emailUserID'];
	$mail->Password =$_SESSION['emailPassword'];
	$mail->SMTPSecure = 'tls';
	$mail->Port = $_SESSION['emailPort'];
	//$mail->Port = 465;
	//From email address and name
	$mail->From = $_SESSION['emailUserID'];
	$mail->FromName = "Fotopia";
	 //echo "sarath";
 //   echo $condition;
 // exit;



	$order_id=$order_id;
	$get_orderdetail_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
	$get_detail=mysqli_fetch_array($get_orderdetail_query);
	$pc_admin_id=$get_detail['pc_admin_id'];
	$from_date=$get_detail['session_from_datetime'];
	$date=date_create($from_date);
	$realtor_email=$_SESSION['loggedin_email'];
  $formated_date=date_format($date,"Y/m/d H:i:s");
	$get_pcadmindetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin_id'");
	$get_pcadmindetail=mysqli_fetch_assoc($get_pcadmindetail_query);
	$get_org=$get_pcadmindetail['organization_name'];
	$PCAdmin_email=$get_pcadmindetail['email'];
	$photographer_id=@$get_detail['photographer_id'];
	$get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
	$get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
	$photographer_Name=@$get_name["first_name"]." ".@$get_name["last_name"];
	$csr_id=$get_name['csr_id'];

	 $csr_email="";
	 $pc_admin_user_id=$get_name['pc_admin_user_id'];

	 if($csr_id==0 && $pc_admin_user_id!=0)
	 {
	 $pc_admin_user1=mysqli_query($con,"select * from photo_company_admin where id='$pc_admin_user_id'");
	 $pc_admin_user=mysqli_fetch_array($pc_admin_user1);
	 $csr_email=$pc_admin_user['email'];
	 }
	 if($csr_id!=0)
	 {
	 $get_csrdetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$csr_id'");
	 $get_csrdetail=mysqli_fetch_assoc($get_csrdetail_query);
	 $csr_email=$get_csrdetail['email'];
	 }


  if($condition=="book now")
	{
		$mail->addAddress($PCAdmin_email);
		//$mail->AddCC($email);
		if(!empty($csr_email)){$mail->AddCC($csr_email);}if(!empty($realtor_email)){$mail->AddCC($realtor_email);}
		$mail->addReplyTo($_SESSION['emailUserID'], "Reply");
		$mail->isHTML(true);
	$mail->Subject = "New Order Created.";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">ORDER CREATED SUCCESSFULLY</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";

	$mail->Body.="Dear {{PCAdmin Company name}},</br>
  New Order has been created by {{Realtor_name}} successfully</br>
  Please login and check in the Orders page</br></br>
  Thanks,</br>
  Fotopia Team.";
  $mail->Body=str_replace('{{PCAdmin Company name}}', $get_org , $mail->Body);
	$mail->Body=str_replace('{{Realtor_name}}', $_SESSION['loggedin_name'] , $mail->Body);

	$mail->Body.="<br><br></td></tr></table></html>";
	// echo $mail->Body;
	// exit;
}
elseif($condition=="book online")
{
	$mail->addAddress($PCAdmin_email);
	if(!empty($csr_email)){$mail->AddCC($csr_email);}if(!empty($realtor_email)){$mail->AddCC($realtor_email);}
	//Address to which recipient will reply
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");
	$mail->isHTML(true);
	$mail->Subject = "New Appointment Created.";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">APPOINTMENT CREATEED SUCCESSFULLY</td><td align=\"right\">info@fotopia.com<br>343 4543 213</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";



	$mail->Body.="Hello {{PCAdmin Company name}},<br><br>

You Have a Photography Session Schedule For
{{DateAndTime}} with reference to Order # F{{orderId}}.<br>
Please arrive 10 minutes prior to your session,
for further details please login to <a href='{{project_url}}'>Fotopia</a>.<br>
Thank you for continued support.

<br><br>
Thanks,<br>
Fotopia Team.";
	 $mail->Body=str_replace('{{PCAdmin Company name}}', $get_org , $mail->Body);
	$mail->Body=str_replace('{{project_url}}', $_SESSION['project_url'] , $mail->Body);
	$mail->Body=str_replace('F{{orderId}}', $order_id , $mail->Body);
	$mail->Body=str_replace('{{DateAndTime}}',$formated_date, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";
	// echo $mail->Body;
	// exit;
}




	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		echo $e->getMessage();
	    echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

 if(isset($_REQUEST['save']))
   {

  $order_id=$_REQUEST['od'];
  $pc_admin_id=$_REQUEST['pc_admin_id'];
  $Photographer_id=$_REQUEST['Photographer_id'];
$home_seller_id=$_REQUEST['hs_id'];
//   $other_cost=$_REQUEST['other_cost'];




  $product_id=$_REQUEST['product_id'];
  $product_name=$_REQUEST['product_name'];
  $quantity=$_REQUEST['quantity'];
  $price=$_REQUEST['price'];
  $photographer_cost=$_REQUEST['photographer_cost'];

 $prodCount=count($quantity);

//echo "<pre>";
//print_r($_REQUEST);

mysqli_query($con,"delete from order_products where order_id='$order_id'");

  for($i=0;$i<$prodCount;$i++)
  {
 /* $pid=$prods[$i];
  $products=mysqli_query($con,"select * from products where id ='$pid'");

 $products1=mysqli_fetch_array($products);

 $product_id_name=explode("@@",$prods[$i]);
 $product_id=$product_id_name[0];
$product_title=$product_id_name[1];


  $photography_cost1=$product_id_name[2];
 $total_price1=$product_id_name[3];

*/

$qty=$quantity[$i];

if($qty!=0)
{

$product_id1=$product_id[$i];
$product_title=$product_name[$i];
$product_price=$price[$i];
$total_price1=$qty*$product_price;
$photography_cost1=$photographer_cost[$i];

 mysqli_query($con,"insert into order_products(order_id,product_id,photographer_id,product_title,quantity,price,total_price,photographer_cost,other_cost,created_on)values('$order_id','$product_id1','$Photographer_id','$product_title','$qty','$product_price','$total_price1','$photography_cost1','0',now())");
 }

 }
 $get_orderdetail_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
 $get_detail=mysqli_fetch_array($get_orderdetail_query);

 if(empty($_REQUEST['Photographer_id'])||$get_detail['session_from_datetime']=="0000-00-00 00:00:00")
 {
	 email($order_id,"book now",$con);
 }
 elseif($_REQUEST['Photographer_id']!=0)
 {
	 email($order_id,"book online",$con);
 }


   //Sending email
//email($photographer_Name,$order_id,$chk_from,$email_id);
	   header("location:summary.php?od=$order_id&pc_admin_id=$pc_admin_id&Photographer_id=$Photographer_id&hs_id=$home_seller_id");



}
?>


<?php include "header.php";  ?>
 <div class="section-empty bgimage7">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2"  style="margin-left:-15px;">
	<?php include "sidebar.php"; ?>
  <style>

.breadcrumb1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 6px;
  overflow: hidden;
  margin-top: 43px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

}

.breadcrumb1 a {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  text-decoration: none;
  margin: auto;
  height: 100%;
  padding-left: 38px;
  padding-right: 0;
  color: #666;
}

.breadcrumb1 a:first-child {
  padding-left: 10px;

}

.breadcrumb1 a:last-child {
  padding-right: 15.2px;
}

#firstStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  z-index: 1;

}
#secondStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #DDD;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  z-index: 1;
}


#thirdStep:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 57px;
  height: 57px;
  top: 0;
  right: -28.14815px;
  background-color: #000;
  border-top-right-radius: 5px;
  -webkit-transform: scale(0.707) rotate(45deg);
          transform: scale(0.707) rotate(45deg);
  z-index: 1;
}



.breadcrumb1 a:last-child:after {
  content: none;
}

.breadcrumb__inner {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  margin: auto;
  z-index: 2;
}

.breadcrumb__title {
  font-weight: bold;
}



#thirdStep:after {
background-color:#aad1d6;
}

#thirdStep:hover {
background-color:#aad1d6;
}

#secondStep:after {
background-color:#DDD;
}

@media all and (max-width: 1000px) {
  .breadcrumb1 {
    font-size: 12px;
  }
}
@media all and (max-width: 710px) {
  .breadcrumb__desc {
    display: none;
  }

  .breadcrumb1 {
    height: 38px;
  }

  .breadcrumb1 a {
    padding-left: 25.33333px;
  }

  .breadcrumb a:after {
    content: "";
    width: 38px;
    height: 38px;
    right: -19px;
    -webkit-transform: scale(0.707) rotate(45deg);
            transform: scale(0.707) rotate(45deg);
  }
}



 @media only screen and (max-width: 1280px) {

	#select_products_table td,#select_products_table th
	{
	text-align:center;
	}
	}
	 @media only screen and (max-width: 800px) {



	#flip-scroll table { display: block; position: relative; width: 100%; }
	#flip-scroll thead { display: block; float: left; }
	#flip-scroll tbody { display: block; width: auto; position: relative; overflow-x: auto; white-space: nowrap; }
	#flip-scroll thead tr { display: block; }
	#flip-scroll th { display: block; text-align: left; }
	#flip-scroll tbody tr { display: inline-block; vertical-align: top; }
	#flip-scroll td { display: block; min-height: 1.25em; text-align: left; }


	/* sort out borders */

	#flip-scroll th { border-bottom: 0; border-left: 0; }
	#flip-scroll td { border-left: 0; border-right: 0; border-bottom: 0; }
	#flip-scroll tbody tr { border-left: 1px solid #babcbf; }
	#flip-scroll th:last-child,
	#flip-scroll td:last-child { border-bottom: 1px solid #babcbf; }
}
		#select_products_table th,#select_products_table td
		{
		padding:5px!important;
		text-align:left!important;
		}
		
.btn-default
{
border-radius:0px;
color:#000!important;
background:#aad1d6!important;
}

.strikethrough {
  position: relative;
}
.strikethrough:before {
  position: absolute;
  content: "";
  left: 0;
  top: 45%;
  right: 0;
  border-top: 2px solid;
  border-color: inherit;
  color:red;
  -webkit-transform:rotate(-7deg);
  -moz-transform:rotate(-7deg);
  -ms-transform:rotate(-7deg);
  -o-transform:rotate(-7deg);
  transform:rotate(-7deg);
}
  </style>
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

   var photo_id=document.getElementById('photo_id').value;

    var fromNew = new Date(document.getElementById("from").value);

	var fromNew1=fromNew.getFullYear()+"-"+zeroPadded(fromNew.getMonth()+1)+"-"+zeroPadded(fromNew.getDate())+" "+zeroPadded(fromNew.getHours())+":"+zeroPadded(fromNew.getMinutes()-1)+":00";

	var toNew = new Date(document.getElementById("to").value);

	var toNew1=toNew.getFullYear()+"-"+zeroPadded(toNew.getMonth()+1)+"-"+zeroPadded(toNew.getDate())+" "+zeroPadded(toNew.getHours())+":"+zeroPadded(toNew.getMinutes()-1)+":00";


   var value= $('#pht').val();

   var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
		$("#appointments_exist").val(this.responseText);
    }
  };
  xhttp.open("GET","check_appointment.php?photographer_id="+photo_id+"&fromDate="+fromNew1+"&toDate="+toNew1,true);
  xhttp.send();
  }
	function check_appointment()
	{
	var appointments_exist=$("#appointments_exist").val();
		if(appointments_exist!=0)
		{
		var from=document.getElementById('from').value;

    var to=document.getElementById('to').value;
		$("#appointments_exist_error").html("There is another appoinment scheduled for the selected photographer <br> in between "+from+" and "+to+", Kindly choose different Date & Time.");
		 // $("#error1").html(this.responseText);
		return false;
		}
		else
		{
		return true;
		}
	}

var photographer_id;
  function Get_Products()
{
  var value= $('#pht').val();
  var photographer_id=$('#options [value="' + value + '"]').data('value');
  document.getElementById('photo_id').value=photographer_id;
  //console.log(d);
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
var valIs="";
function showHideFloors(valIs)
{
if(valIs=="EmptyLand")
{
$("#plan").attr("readonly","readonly");
$("#plan").attr("style","background:#CCC");
$("#plan").removeAttr("placeholder");
$("#plan").val("");
}
else
{
$("#plan").removeAttr("readonly");

$("#plan").attr("style","background:#E8EFFC");
$("#plan").attr("placeholder","Enter the floor number");
}

}

             function setpropertyAddress(){
var property_address="<?php echo $_SESSION['property_address']; ?>";
var property_city="<?php echo $_SESSION['property_city']; ?>";
var property_state="<?php echo $_SESSION['property_state']; ?>";
var property_country="<?php echo $_SESSION['property_country']; ?>";
var property_zip="<?php echo $_SESSION['property_zip']; ?>";
var property_contact_mobile="<?php echo $_SESSION['property_contact_mobile']; ?>";
var property_contact_email="<?php echo $_SESSION['property_contact_email']; ?>";


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




function chkBox()
{
 var requiredCheckboxes = $("input[type=checkbox]:checked");
 var lengthIs = $("input[type=checkbox]:checked").length;
   //alert(lengthIs);
        if(lengthIs>0) {
            $(".prodsSelected").removeAttr('required');
        } else {

		var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
		alertmsg="Vennligst velg minst ett produkt";
		}
		else
		{
		alertmsg="Please select at least one product";
		}
alert(alertmsg);
		return false;
            $(".prodsSelected").attr('required', 'required');
        }

}

function updateSubTotal(id)
{
var qty=$("#qty"+id).val();
var price=$("#price"+id).val();
var subTotal=0;
if(qty!=0)
{
subTotal=qty*price;
$("#checkBox"+id).attr("checked","checked");
}
else
{
$("#checkBox"+id).removeAttr("checked");
}
$("#subtotal"+id).val(subTotal);

var TotalValueis=0;
var $changeInputs = $('input.sTotal');
    $changeInputs.each(function(idx, el) {
      TotalValueis += Number($(el).val());
      });

	  $("#totalValue").html(TotalValueis);


}

function checkProduct(id1,price)
{

const cb = document.getElementById('checkBox'+id1);
if(cb.checked)
{
$("#qty"+id1).val(1);
$("#subtotal"+id1).val(price);
}
else
{
$("#qty"+id1).val(0);
$("#subtotal"+id1).val(0);
}

var TotalValueis=0;
var $changeInputs = $('input.sTotal');
    $changeInputs.each(function(idx, el) {
      TotalValueis += Number($(el).val());
      });

	  $("#totalValue").html(TotalValueis);

}


           </script>
			</div>
			      <div class="col-md-10" style="padding-top:10px;">

                	<div class="breadcrumb1 hidden-xs hidden-sm">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep"><i class="fa fa-camera-retro" style="font-size:40px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title"  adr_trans="label_order">Order</span>
        <span class="breadcrumb__desc"  adr_trans="label_fill_order">Fill the order</span>
			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep"><i class="fa fa-calendar" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title"  adr_trans="label_appointment">Appointment</span>
        <span class="breadcrumb__desc"  adr_trans="label_pick_appointment">Pick appointment</span>

			</span>
		</a>
		<a href="#" id="thirdStep" class="btn btn-default"><i class="fa fa-database" style="font-size:30px;color:#000;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title"  adr_trans="label_products">Products</span>
				<span class="breadcrumb__desc"  adr_trans="label_select_products">Select Products</span>

			</span>
		</a>
		<a href="#"><i class="fa fa-file-text-o" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title"  adr_trans="label_summary">Summary</span>
				<span class="breadcrumb__desc"  adr_trans="label_order_status">Order Status</span>
			</span>
		</a>
	</div>


			<div class="breadcrumb1 hidden-md hidden-lg hidden-xl" style="height:50px;">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title">Order</span>

			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title">Appointment</span>


			</span>
		</a>
		<a href="#" id="thirdStep" class="btn btn-default">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title">Products</span>


			</span>
		</a>
		<a href="#">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title">Summary</span>

			</span>
		</a><br />
	</div>



           <div class="col-md-12">

          <form action=""  method="post" enctype="multipart/form-data" onsubmit="booking_chk();return check_appointment()" style="color: #000;background: #fff;padding-left:8px;padding-bottom: 20px;border-radius: 5px;">
           <input type="hidden" name="hs_id" value="<?php echo @$_REQUEST["hs_id"]; ?>"/>
		   <input type="hidden" name="pc_admin_id" value="<?php echo $_REQUEST['pc_admin_id']; ?>" />
						<input type="hidden" name="Photographer_id" value="<?php echo $_REQUEST['Photographer_id']; ?>" />
						<input type="hidden" name="od" value="<?php echo $_REQUEST['od']; ?>" />
						<input type="hidden" name="u" value="<?php echo $_REQUEST['u']; ?>" />
<div id="flip-scroll"><table class="table-stripped" id="select_products_table" width="100%"><thead>
<tr style="font-weight:600;"><td>Select</td><td>Product Name</td><td>Timeline</td><td>Product Cost</td><td>Quantity</td><td>Sub Total</td></tr></thead>

<?php
$pc_admin_id1=$_REQUEST['pc_admin_id'];
$Photographer_id1=$_REQUEST['Photographer_id'];
$product_result="";
if(@$Photographer_id1=="" || @$Photographer_id1=="undefined")
{
$product_result=mysqli_query($con,"SELECT * FROM `products` WHERE pc_admin_id='$pc_admin_id1'");
}
else
{
$product_result=mysqli_query($con,"SELECT * FROM `products` WHERE id in (select product_id from  photographer_product_cost where photographer_id='$Photographer_id1')");
}

$totalpriceIS=0;
while($product_result1=mysqli_fetch_array($product_result))
{
$productIDIS=$product_result1['id'];
$realtorDiscountPrice=$product_result1['total_cost'];
$ActualCostOfProduct=$product_result1['total_cost'];
$realtorCost1=mysqli_query($con,"select * from realtor_product_cost where pc_admin_id='$pc_admin_id1' and realtor_id='$_SESSION[loggedin_id]' and product_id='$productIDIS'");

$rowsFound=mysqli_num_rows($realtorCost1);
if($rowsFound>0)
{
$realtorCost=mysqli_fetch_array($realtorCost1);
$realtorDiscountPrice=$realtorCost['discount_price'];
}
$photographyCostIs=0;
$PhotographyCost1=mysqli_query($con,"select * from photographer_product_cost where pc_admin_id='$pc_admin_id1' and photographer_id='$Photographer_id1' and product_id='$productIDIS'");

$rowsFound1=mysqli_num_rows($PhotographyCost1);
if($rowsFound1>0)
{
$PhotographyCost=mysqli_fetch_array($PhotographyCost1);
$photographyCostIs=$PhotographyCost['photography_cost'];
}


$selectProductIDs="";
$qtyIS=0;
$priceIS=0;

$subTotalIS=0;
if(@$_REQUEST['u'])
{
$prodid=$product_result1['id'];
$order_products1=mysqli_query($con,"select * from order_products where order_id='$_REQUEST[od]' and product_id='$prodid'");
$rowsexist=mysqli_num_rows($order_products1);
if($rowsexist>0)
{
$order_products=mysqli_fetch_array($order_products1);
$qtyIS=$order_products['quantity'];
$priceIS=$order_products['price'];
$subTotalIS=$qtyIS*$priceIS;
$totalpriceIS+=$order_products['total_price'];
$selectProductIDs="checked";
}
}


?>
<tr><td>


<input type="checkbox" name="prods[]" id="checkBox<?php echo $product_result1['id']; ?>" value="<?php echo $product_result1['id']."@@".$product_result1['product_name']."@@".$photographyCostIs."@@".$realtorDiscountPrice; ?>" class="prodsSelected" <?php echo @$selectProductIDs; ?> onchange="checkProduct(<?php echo $product_result1['id']; ?>,<?php echo $realtorDiscountPrice;?>);"></td><td><?php echo $product_result1['product_name']; ?>

<input type="hidden" name="product_id[]" value="<?php echo $product_result1['id']; ?>" />
<input type="hidden" name="product_name[]" value="<?php echo $product_result1['product_name']; ?>" />
<input type="hidden" name="photographer_cost[]" value="<?php echo $product_result1['id']; ?>" />
<input type="hidden" name="price[]" value="<?php echo $realtorDiscountPrice; ?>" />

</td><td><?php echo $product_result1['timeline'];?></td><td align="center"><?php echo $realtorDiscountPrice;?><?php if($ActualCostOfProduct!=$realtorDiscountPrice) { ?><span class="strikethrough" style="margin-left:20px"><?php echo $ActualCostOfProduct; ?></span>&nbsp;&nbsp;<i class="fa fa-exclamation-circle" title="Special discount price for you from Photo Company"></i><?php } ?></td>
<td><input type="number" name="quantity[]" id="qty<?php echo $product_result1['id']; ?>" value="<?php echo @$qtyIS; ?>" min="0"  style="width:80px;color:#000" class="form-control" onchange="updateSubTotal(<?php echo $product_result1['id']; ?>)"/><input type="hidden"  id="price<?php echo $product_result1['id']; ?>" value="<?php echo $realtorDiscountPrice;?>" /></td>
<td><input type="text" readonly  name="subtotal[]" id="subtotal<?php echo $product_result1['id']; ?>" value="<?php echo $subTotalIS; ?>"  style="width:80px;color:#000" class="sTotal form-control" /></td>
</tr>
<?php } ?>
</table></div>
<table class="table-stripped" width="100%" style="margin-top:20px;">
<tr><td colspan="2" align="right"><p align="right" style="margin-right:70px;font-size:20px;"><span adr_trans="label_total_value">Total Value</span>&nbsp;:&nbsp; $ <span id="totalValue"><?php echo sprintf("%.2f",$totalpriceIS); //echo $totalpriceIS; ?></span></p><hr class="space xs"></td>
</tr>

<tr><td align="left"><a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" class="anima-button circle-button btn-sm btn adr-cancel"><i class="fa fa-chevron-circle-left"></i><span adr_trans="label_back">Back</span></a></td>

<td align="right"><button type="submit" id="saveBtn" name="save" class="anima-button circle-button btn-sm btn adr-save" onClick="return chkBox()" style="float:right;"><i class="fa fa-chevron-circle-right"></i><span adr_trans="label_submit">Submit</span></button></td></tr>
</table></div>


	</form>



</div>
            </div>
        </div>


		<?php include "footer.php";  ?>
