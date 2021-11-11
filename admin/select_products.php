<?php
ob_start();

include "connection1.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($order_id,$realtor_email,$con)
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

	//From email address and name
	$mail->From = $_SESSION['emailUserID'];
	$mail->FromName = "Fotopia";

	//To address and name
	// ;
	// // //Recipient name is optional
	// //;
	 // ;
	 $order_id=$order_id;
	 $get_orderdetail_query=mysqli_query($con,"SELECT * from orders WHERE id='$order_id'");
	 $get_detail=mysqli_fetch_array($get_orderdetail_query);
	 $home_seller_id=$get_detail['home_seller_id'];
	 $pc_admin_id=$get_detail['pc_admin_id'];
	 $from_date=@$get_detail['session_from_datetime'];
	 $date=date_create($from_date);
	 $get_pcadmin_profile_query=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
	 $get_profile=mysqli_fetch_assoc($get_pcadmin_profile_query);
	 $pcadmin_email=$get_profile['email'];
	 $pcadmin_contact=$get_profile['contact_number'];
	 $formated_date=date_format($date,"d F Y g:ia");
	 $get_pcadmindetail_query=mysqli_query($con,"SELECT * FROM admin_users where id='$pc_admin_id'");
	 $get_pcadmindetail=mysqli_fetch_assoc($get_pcadmindetail_query);
	 $get_org=$get_pcadmindetail['organization_name'];
	 $PCAdmin_email=$get_pcadmindetail['email'];
	 $photographer_id=@$get_detail['photographer_id'];
	 $get_photgrapher_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$photographer_id'");
	 $get_name=mysqli_fetch_assoc($get_photgrapher_name_query);
	 $photographer_Name=@$get_name["first_name"]."".@$get_name["last_name"];
	 $photographer_email=@$get_name["email"];
	 $csr_id=$get_name['csr_id'];
	  $csr_email="";
	 $pc_admin_user_id=$get_name['pc_admin_user_id'];
	 
	 if($csr_id==0 && $pc_admin_user_id['pc_admin_user_id']!=0)
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
	
	 $get_template_query=mysqli_query($con,"select * from email_template where pc_admin_id='$pc_admin_id' and template_title='Appointment updated'");
	 $get_template=mysqli_fetch_array($get_template_query);
	 $appointment_updated_template=$get_template['template_body_text'];
	 $get_hs_detail_query=mysqli_query($con,"select * from home_seller_info where id=$home_seller_id");
	 $get_hs_detail=mysqli_fetch_array($get_hs_detail_query);


  $mail->addAddress($realtor_email);
	if(!empty($csr_email))
	{
	$mail->AddCC($csr_email);
	}
	$mail->AddCC($pcadmin_email);
	if(!empty($photographer_email))
	{
	$mail->AddCC($photographer_email);
	}
	$mail->AddCC($get_hs_detail['email']);
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");
	$mail->isHTML(true);

	$mail->Subject = "Appointment updated";
	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">APPOINTMENT UPDATED SUCCESSFULLY</td>
  <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";

	$mail->Body.=$appointment_updated_template;
  $mail->Body.="<br>Hi! {{Photographer_Name}} will come for Photography session,<br>
Appointment Session Date & Time - {{from}}.<br>
Kindly check the order #4 in the orders page for any details, Thank you for continued support.<br>

  <br><br>
  Thanks,<br>
  Fotopia Team.";

  $mail->Body=str_replace('{{Order_ID}}', $order_id , $mail->Body);
	$mail->Body=str_replace('{{from}}', $formated_date , $mail->Body);
	$mail->Body=str_replace('{{Photographer_Name}}', $photographer_Name , $mail->Body);

	$mail->Body.="<br><br></td></tr></table></html>";


	 // echo $mail->Body;
	 // exit;



	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		// echo $e->getMessage();
	  //   echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

 if(isset($_REQUEST['save']))
   {

//  echo "<pre>";
  //print_r($_REQUEST);exit;
  $prods=$_REQUEST['prods'];
  //$product=implode(",",$prods);
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
 $order_id=$_REQUEST['od'];
 $get_realtor_name_query=mysqli_query($con,"select * from orders where id=$order_id");
 $get_realtor=mysqli_fetch_assoc($get_realtor_name_query);
   $realtor_id=$get_realtor['created_by_id'];
	 if($realtor_id==$_SESSION['admin_loggedin_id']&&$get_realtor['created_by_type']!="Realtor")
	 {
		 $get_realtor_name_query=mysqli_query($con,"SELECT * FROM admin_users where id='$realtor_id'");
	 }
	 else{
	 $get_realtor_name_query=mysqli_query($con,"SELECT * FROM user_login where id='$realtor_id'");
   }

	 $get_realtor_name=mysqli_fetch_assoc($get_realtor_name_query);
	 $get_realtor_name1=$get_realtor_name["first_name"]."".$get_realtor_name["last_name"];
	 $realtor_email=$get_realtor_name['email'];

$quickOrderStatus=1;
if(@$_REQUEST['quickOrder'])
{
$quickOrderStatus=1;
}
else
{
$quickOrderStatus=2;
}
  mysqli_query($con,"update orders set status_id='$quickOrderStatus' where id='$order_id'");


	email($order_id,$realtor_email,$con);


  if(@$_REQUEST['u']==1)
	{
		header("location:summary.php?od=$order_id&pc_admin_id=$pc_admin_id&Photographer_id=$Photographer_id&hs_id=$home_seller_id&edit=1");
	}
 else{
   //Sending email
//email($photographer_Name,$order_id,$chk_from,$email_id);
	   header("location:summary.php?od=$order_id&pc_admin_id=$pc_admin_id&Photographer_id=$Photographer_id&hs_id=$home_seller_id");
  }
}
?>


<?php include "header.php";  ?>
 <div class="section-empty bgimage7">
        <div class="container" style="margin-left:0px;height:inherit;">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" >
	<?php include "sidebar.php"; ?>
  <style>

.breadcrumb1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 6px;
  overflow: hidden;
  margin-top: 30px!important;
  text-align: center;
  top: 50%;
  width: 100%;
  height: 57px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  box-shadow: 0 1px 1px black, 0 4px 14px rgba(0, 0, 0, 0.7);
  z-index: 1;
  background-color: #ddd;
  font-size: 14px;

  box-shadow:10px 10px 10px #ccc;
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
  box-shadow: 1px -1px rgba(0, 0, 0, 0.25);
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
background-color:#000;
}

#thirdStep:hover {
background-color:#000;
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

	td,th
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
		th,td
		{
		padding:5px!important;
		text-align:left!important;
		}
		.nav-tabs > li.active > a, .current-active {
    background:#000!important;color:#FFF!important;
    border-radius: 20px 20px 0px 0px;
    opacity: 0.8;


}
.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}
.btn-default
{
border-radius:0px;
color:#FFF!important;
background:#000!important;
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
				<span class="breadcrumb__title" id="label_order" adr_trans="label_order">Order</span>
				<span class="breadcrumb__desc" id="label_fill_order" adr_trans="label_fill_order">Fill the order</span>
			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep"><i class="fa fa-calendar" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_appointment" adr_trans="label_appointment">Appointment</span>
				<span class="breadcrumb__desc" id="label_pick_appointment" adr_trans="label_pick_appointment">Pick appointment</span>

			</span>
		</a>
		<a href="#" id="thirdStep" class="btn btn-default"><i class="fa fa-database" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_products" adr_trans="label_products">Products</span>
				<span class="breadcrumb__desc" id="label_select_products" adr_trans="label_select_products">Select Products</span>

			</span>
		</a>
		<a href="#"><i class="fa fa-file-text-o" style="font-size:30px;padding-top:10px;"></i>
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_summary" adr_trans="label_summary">Summary</span>
				<span class="breadcrumb__desc" id="label_order_status" adr_trans="label_order_status">Order Status</span>
			</span>
		</a>
	</div>


			<div class="breadcrumb1 hidden-md hidden-lg hidden-xl" style="height:50px;">
		<a href="create_order.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="firstStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_order" adr_trans="label_order">Order</span>

			</span>
		</a>

		<a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" id="secondStep">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_appointment" adr_trans="label_appointment">Appointment</span>


			</span>
		</a>
		<a href="#" id="thirdStep" class="btn btn-default">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_products" adr_trans="label_products">Products</span>


			</span>
		</a>
		<a href="#">
			<span class="breadcrumb__inner">
				<span class="breadcrumb__title" id="label_summary" adr_trans="label_summary">Summary</span>

			</span>
		</a><br />
	</div>



           <div class="col-md-12">

          <form action=""  method="post" enctype="multipart/form-data" onsubmit="booking_chk();return check_appointment()" style="background: #E8F0FE;color:#000;padding:10px;opacity:0.9;border-radius:25px 25px 25px 25px">
           <input type="hidden" name="hs_id" value="<?php echo @$_REQUEST["hs_id"]; ?>"/>
		   <input type="hidden" name="pc_admin_id" value="<?php echo $_REQUEST['pc_admin_id']; ?>" />
						<input type="hidden" name="Photographer_id" value="<?php echo $_REQUEST['Photographer_id']; ?>" />
						<input type="hidden" name="od" value="<?php echo $_REQUEST['od']; ?>" />
						<input type="hidden" name="u" value="<?php echo $_REQUEST['u']; ?>" />
<div id="flip-scroll"><table class="table-stripped" width="100%"><thead>
<tr style="font-weight:600;"><td id="label_select" adr_trans="label_select">Select</td><td id="label_product_name" adr_trans="label_product_name">Product Name</td><td id="label_timeline" adr_trans="label_timeline">Timeline</td><td id="label_product_cost" adr_trans="label_product_cost">Product Cost</td>
<td id="label_quantity" adr_trans="label_quantity">Quantity</td><td id="label_sub_total" adr_trans="label_sub_total">Sub Total</td>
</tr></thead>

<?php
$pc_admin_id1=$_REQUEST['pc_admin_id'];
$Photographer_id1=$_REQUEST['Photographer_id'];
$product_result="";
if(@$Photographer_id1=="" || @$Photographer_id1=="undefined" || @$Photographer_id1==0)
{
$product_result=mysqli_query($con,"SELECT * FROM `products` WHERE pc_admin_id='$pc_admin_id1'");
}
else
{
$product_result=mysqli_query($con,"SELECT * FROM `products` WHERE id in (select product_id from  photographer_product_cost where photographer_id='$Photographer_id1')");
}
$order_id=$_REQUEST['od'];
$get_realtor_name_query=mysqli_query($con,"select * from orders where id=$order_id");
$get_realtor=mysqli_fetch_assoc($get_realtor_name_query);
$realtor_id=$get_realtor['created_by_id'];

$totalpriceIS=0;
while($product_result1=mysqli_fetch_array($product_result))
{
$productIDIS=$product_result1['id'];
$realtorDiscountPrice=$product_result1['total_cost'];
$ActualCostOfProduct=$product_result1['total_cost'];

$hs_id=@$_REQUEST['hs_id'];

$realtorID1=mysqli_query($con,"select id from user_login where type_of_user='Realtor' and  email=(select request_email from home_seller_info where lead_from='realtor' and id='$hs_id')");
$realtorID1EX=mysqli_num_rows($realtorID1);
if($realtorID1EX>0)
{
$realtorID=mysqli_fetch_array($realtorID1);
$realtor_id=$realtorID['id'];
}


$realtorCost1=mysqli_query($con,"select * from realtor_product_cost where pc_admin_id='$pc_admin_id1' and realtor_id='$realtor_id' and product_id='$productIDIS'");

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
<td><input type="number" name="quantity[]" id="qty<?php echo $product_result1['id']; ?>" value="<?php echo @$qtyIS; ?>" min="0"  style="width:80px;color:#000" class="form-control" onkeyup="updateSubTotal(<?php echo $product_result1['id']; ?>)"/><input type="hidden"  id="price<?php echo $product_result1['id']; ?>" value="<?php echo $realtorDiscountPrice;?>" /></td>
<td><input type="text" readonly  name="subtotal[]" id="subtotal<?php echo $product_result1['id']; ?>" value="<?php echo $subTotalIS; ?>"  style="width:80px;color:#000" class="sTotal form-control" /></td>
</tr>
<?php } ?>
</table></div>
<table class="table-stripped" width="100%" style="margin-top:20px;">
<tr><td colspan="2" align="right"><p align="right" style="margin-right:70px;font-size:20px;"><span adr_trans="label_total_value">Total Value</span> &nbsp;:&nbsp; $ <span id="totalValue"><?php echo sprintf("%.2f",$totalpriceIS); //echo $totalpriceIS; ?></span></p></td></tr>
<tr><td align="left"><a href="create_appointment.php?hs_id=<?php echo @$_REQUEST['hs_id']; ?>&pc_admin_id=<?php echo @$_REQUEST['pc_admin_id']; ?>&Photographer_id=<?php echo @$_REQUEST['Photographer_id']; ?>&od=<?php echo @$_REQUEST['od']; ?>" class="anima-button circle-button btn-sm btn"><i class="fa fa-chevron-circle-left"></i><span adr_trans="label_back">Back</span></a></td>

<td align="right"><button type="submit" id="saveBtn" name="save" class="anima-button circle-button btn-sm btn" onClick="return chkBox()" style="float:right;"><i class="fa fa-chevron-circle-right"></i><span adr_trans="label_submit">Submit</span></button></td></tr>
</table></div>


	</form>



</div>
            </div>
        </div>


		<?php include "footer.php";  ?>
