<?php
include "connection.php";

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photography App</title>
    <meta name="description" content="About page with company informations.">
    <script src="scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="scripts/bootstrap/css/bootstrap.css">
    <script src="scripts/script.js"></script>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="css/content-box.css">
	 <link rel="stylesheet" href="css/image-box.css">
	  <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="scripts/magnific-popup.css">
	 <link rel="stylesheet" href="scripts/jquery.flipster.min.css">

    <style>
	.adr-save
	{
	background:#AAD1D6!important;
	border-color:#AAD1D6!important;
	}
	.adr-cancel
	{
	/*background:#5cb85c!important;
	border-color:#5cb85c!important;*/
	background:#f0ad4e!important;
	border-color:#f0ad4e!important;
	}
  .adr-success
	{
	/*background:#5cb85c!important;
	border-color:#5cb85c!important;*/
	background:#AAD1D6!important;
	border-color:#AAD1D6!important;
	}
  .tab-black
  {
    background-color: white;
    color: black;
  }
  .tab-box > .panel, .tab-box > .panel-box > .panel{
    border-color: #585858;
  }
  th, th > span 
  {
    margin-left: 0px !important;
  }
	</style>

<script>
var calid;
function calDetails(calid)
{
$("#dayVal").val(calid);

}
</script>
<script src="dropzone/dropzone.js"></script>
<script src="dropzone/validate.js"></script>
<script>

</script>
<link rel="stylesheet" href="dropzone/dropzone.css">
     <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <!-- Extra optional content header -->
</head>
<body class="home device-l"><input type="hidden" name="dayVal" id="dayval" value="">

    <div id="preloader" style="display: none;"></div>
    <header data-menu-anima="fade-left">
        <div class="navbar navbar-default over wide-area" role="navigation">
            <div class="navbar navbar-main over">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index.php" style="padding-left:30px;"><img src="images/Fotopia-New-Logo1.png" alt="logo" style="margin-top:-6px;width:65px;height:60px">
						<span style="display:ineline;font-size:13px;color:#000;margin-left:-4px"><span style="color:#aad1d6;font-size:18px;">f</span>otopia</span></a>

                    </div>

                      <p align="center" style="font-size: x-large;color: #ffffff;margin-top: 10px;"> Share Order Cost</p>

                    </div>
                </div>
            </div>

    </header>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js" integrity="sha512-y3o0Z5TJF1UsKjs/jS2CDkeHN538bWsftxO9nctODL5W40nyXIbs0Pgyu7//icrQY9m6475gLaVr39i/uh/nLA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>

 <div class="section-empty">
   <hr class="space l">
        <div class="container-fluid" style="margin-left:0px;height:inherit;">
            <div class="row">
              <div class="col-md-12"><center style="color:black;font-size:20px"></center></div>
			<hr class="space l">

      <div class="col-md-1">
      </div>

<?php

$id = $_REQUEST['id'];

 ?>


                <div class="col-md-10">
  <p align="right"><a class="anima-button circle-button btn-sm btn adr-save" style="position: relative;color:black !important;" onClick="printPage()"><i class="fa fa-print" style="color: black;"></i><span adr_trans="label_print">Print</span></a></p>
<div id="printtable"></div>
    <div id="print">

        <h1 id="inv_h1" style="font-size:50px; text-align: center;" adr_trans="label_order_cost">Order Cost</h1>
      <link rel="stylesheet" href="./css/style_invoice.css">
      <header id="inv_header" >
        <?php
        // @$invoice_check_query=mysqli_query($con,"select * from invoice where order_id=$id");
        // @$invoice_check=mysqli_fetch_assoc(@$invoice_check_query);
        // $id=$invoice_check['order_id'];
        // echo $id;
        $get_summary_query=mysqli_query($con,"SELECT * from orders WHERE id='$id'");
        $get_summary=mysqli_fetch_array($get_summary_query);
        $hs_id=$get_summary['home_seller_id'];
        ?>



        <hr class="space s">
        <table style="width: 100%;margin-bottom: 10px;">

          <tr>
            <th>
              <p style="font-size:14px;float: left;"><strong adr_trans="label_order_number">ORDER NO.</strong><br></p>
            </th>
            <th>
              <p style="font-size: 14px;float: right;"><strong adr_trans="label_date_issue"> DATE OF ISSUE </strong><br></p>
            </th>
          </tr>
          <tr>
            <td>
              <p style="font-size:11px;margin-left: 10px;"> <?php echo $id; ?></p>
            </td>
            <td>
              <p style="
       font-size:11px;float: right;
       "> <?php echo date("d/m/y"); echo " ("; echo date("h:i:a"); echo ")"; ?></p>
            </td>
          </tr>
        </table>

        <table style="margin-top: 10px;display: inline;">

          <?php
              $id_fetch=mysqli_query($con,"SELECT * FROM home_seller_info where id='$hs_id'");
              $get_id=mysqli_fetch_array($id_fetch);

              if ($get_id['lead_from'] == "realtor") {
              ?>
              <tr><th><p style="font-size:14px;float:left"><strong adr_trans="label_billed_to"> BILLED TO </strong><br></p></th></tr>
              <tr>
                <th><p style="font-size:11px;float:left"><strong><?php  echo $get_id['request_name']; ?> </strong><br></p> </th> </tr>
                <tr><td><p style="font-size:11px;margin-left:5px"> <?php  echo $get_id['request_address']; ?></p></td></tr>
                <tr><td><p style="font-size:11px;margin-left:5px"> <?php   echo $get_id['request_email']; ?><br></p></td></tr>
           <tr><td><p style="font-size:11px;margin-left:5px"> <?php  echo $get_id['request_contact_no']; ?></p></td></tr>
              <?php
              }
              elseif ($get_id['lead_from'] == "homeseller") {
                ?>
                <tr><th><p style="font-size:14px;float:left"><strong adr_trans="label_billed_to"> BILLED TO </strong><br></p></th></tr>
                <tr>
                  <th><p style="font-size:11px;float:left"><strong><?php  echo $get_id['name']; ?> </strong><br></p></th></tr>
                 <tr> <td><p style="font-size:11px;margin-left:5px"> <?php   echo $get_id['address']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px;margin-left:5px"> <?php   echo $get_id['city']; echo " , "; echo $get_id['state']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px;margin-left:5px"> <?php  echo "Zip Code : "; echo $get_id['zip']; ?><br></p></td></tr>
              <?php
              }
              else {
                 $created_Nam=$get_summary["pc_admin_id"];
                $get_created_name_query=mysqli_query($con,"SELECT * FROM admin_users where id=".$created_Nam);
                $get_name_create=mysqli_fetch_assoc($get_created_name_query);
                ?>
                <tr><th><p style="font-size:14px;float:left"><strong adr_trans="label_billed_to"> BILLED TO </strong></p></th></tr>
                <tr>
                  <th><p style="font-size:11px;float:left"><strong><?php  echo $get_name_create["first_name"]." ".$get_name_create["last_name"]?> </strong><br></p></th></tr>
                  <tr><td><p style="font-size:11px;margin-left:5px"> <?php   echo $get_name_create['address_line1']; echo " , ";
                  echo $get_name_create['address_line2']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px;margin-left:5px"> <?php   echo $get_name_create['city']; echo " , "; echo $get_name_create['state']; ?><br></p></td></tr>
                  <tr><td><p style="font-size:11px;margin-left:5px"> <?php  echo "Zip Code : "; echo $get_name_create['postal_code']; ?><br></p></td></tr>
                  <br>
                <?php
              }
           ?>
          </table>

     
          <table style="float:right;text-align: right;">
            <div style="display: inline;">
         
          <?php

    $get_order_query=mysqli_query($con,"SELECT * FROM orders where id='$id'");
    $get_order=mysqli_fetch_array($get_order_query);

    ?>

    <?php
              $pc_admin_id=$get_order['pc_admin_id'];
              $get_photo_info=mysqli_query($con,"SELECT * FROM photo_company_profile where pc_admin_id='$pc_admin_id'");
              $get_information=mysqli_fetch_assoc($get_photo_info);

              ?>
  <tr><th><p style="font-size:14px;text-align:right"><strong adr_trans="label_billed_from"> Billed From </strong><br></p></th></tr>
  <tr><th><p style="font-size:11px;text-align: right"><strong><?php  echo $get_information['organization_name']; ?> </strong><br></p></th></tr>
  <tr><td><p style="font-size:11px" > <?php   echo $get_information['address_line1']; echo " ,<br> "; echo $get_information['address_line2']; ?></p></td></tr>
  <tr><td><p style="font-size:11px" > <?php   echo $get_information['city']; echo " , "; echo $get_information['state']; ?><br></p></td></tr>
  <tr><td><p style="font-size:11px" > <?php  echo "Zip Code : "; echo $get_information['postal_code']; ?><br></p></td></tr>
       </div>
        </table>
      </header>
      <article>
        <br>
        <br>

        <table id="inv_table1" class="inventory"  style="width:100%">
          <thead>
            <tr>
              <th id="inv_th" style="width:10% ;margin-left : 10px;
       padding-left : 10px;"><span adr_trans="label_product_desc"> PRODUCTS DESCRIPTION</span></th>
       <th id="inv_th" style="width:10% ;text-align: center;"><span>QUANTITY</span></th>
              <th id="inv_th" style="width:10% ;text-align: center;"><span adr_trans="label_costs">COSTS</span></th>
              <!-- <th id="inv_th" style="width:15%;text-align: center;"><span >OTHER COSTS</span></th>
              <th id="inv_th" style="width:15%;text-align: center;"><span >TOTAL COSTS</span></th> -->
            </tr>
          </thead>
          <tbody>
            <tr >
              <td id="inv_td" style="margin-left : 10px;

       padding-left : 10px;" ><span ><?php
        // echo "select group_concat(product_id) as product_id from order_products WHERE order_id='$id'";
       $prodsList=mysqli_query($con,"select group_concat(product_id) as product_id,group_concat(product_title) as product_title,group_concat(quantity) as quantity,sum(total_price)+sum(other_cost) as total from order_products WHERE order_id='$id'");
      $prodsList1=mysqli_fetch_array($prodsList);
      $product_id_is=$prodsList1['product_id'];
    //
    // echo "select GROUP_CONCAT(product_name) as title from products where id in ($product_id_is)";
                               // $product_query=mysqli_query($con,"select GROUP_CONCAT(product_name) as title from products where id in ($product_id_is)");
                               //  $product_detail=mysqli_fetch_array($product_query);
                                $title_split = @$prodsList1['product_title'];
                                // echo $prodsList1['product_title'];
                                $splited_title =  explode(',',$title_split);
                                foreach($splited_title as $new_title)
                                {
                                    echo $new_title; ?> <br/><?php
                                }?>

                                </span></td>

                                <td id="inv_td" style="text-align:center;"><span data-prefix></span><span><?php
                $quantity_split=$prodsList1['quantity'];
               $var=explode(',',$quantity_split);
               foreach($var as $row)
                {

               echo $row; ?> <br/><?php

                }

        ?></span></td>

            <td id="inv_td" style="text-align:center;"><span data-prefix></span><span><?php
              $product_id_split=$prodsList1['product_id'];
             $var=explode(',',$product_id_split);
             foreach($var as $row)
              {
               // echo "SELECT * FROM order_products where product_id='$row' and order_id='$id'";
              $price=mysqli_query($con,"SELECT * FROM order_products where product_id='$row' and order_id='$id'");
              $get_price_info=mysqli_fetch_assoc($price);
             $total_cost=@$get_price_info["total_price"];
             echo "$".@$total_cost; ?> <br/><?php

              }

      ?></span></td>

            </tr>
          <?php   $invoice_check_query=mysqli_query($con,"select * from invoice where order_id=$id");
            @$invoice_check=mysqli_fetch_assoc(@$invoice_check_query);?>
            <tr>
<td id="inv_th" colspan="1" style="text-align: right;"><span ></span></td>
            <td id="inv_th"  style="text-align: right;"><span adr_trans="label_other_cost" >Other cost</span><span><?php echo "(".$invoice_check['other_cost_comment'].")"?></span><span >:</span></td>
            <td id="inv_td" style="text-align: center;"><span data-prefix>$</span><span><?php echo $invoice_check['other_cost']; ?></span></td>
            </tr>
            <tr>
              <td id="inv_th" colspan="1" style="text-align: right;"><span ></span></td>
            <td id="inv_th"  style="text-align: right;"><span ><span adr_trans="label_tax">Tax</span>(<?php echo $get_information['tax']; ?>%)</span><span >:</span></td>
            <?php
            $percentage = $get_information['tax'];
            $totalcost = $prodsList1['total']+$invoice_check['other_cost'];
            $new_cost = ($percentage / 100) * $totalcost;
             ?>
            <td id="inv_td" style="text-align: center;"><span data-prefix>$</span><span><?php echo $new_cost; ?></span></td>
            </tr>

            <tr>
              <td id="inv_th" colspan="1" style="text-align: right;"><span ></span></td>
              <?php $final_value=$prodsList1['total']+$invoice_check['other_cost']+$new_cost?>
            <td id="inv_th"  style="text-align: right;"><span adr_trans="label_total">Total</span><span >:</span></td>
            <td id="inv_td" style="text-align: center;"><span data-prefix>$</span><span><?php echo $final_value; ?></span></td>
            </tr>
            <tr>
<td id="inv_th" colspan="1" style="text-align: right;"><span ></span></td>
      <td id="inv_th"  style="text-align: center;"><span adr_trans="label_total_price">Total Price</span></td>
      <td id="inv_td" style="text-align: center;"><span data-prefix>$</span><span><?php echo $final_value; ?></span></td>
    </tr>
          </tbody>
        </table>


      </article>
      <br/><br/>
  <table style="margin-left : 10px;
       padding-left : 10px;">
    <tr>
      <th><p adr_trans="label_terms_condition">Terms and condtions </p></th>
    </tr>
    <td><p>E.g. Please pay Order Cost by MM/DD/YYYY</p></td>
  </table>

    </div>
    <script>

    function printPage()
    {
       var divToPrint=document.getElementById("print");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }
  </script>

</div>


      <div class="col-md-1">
      </div>

   	</div>
	</div>
</div>

<div id="tnc" class="box-lightbox white" style="padding:25px;border-radius:25px 25px 25px 25px;width:300px;height:200px;">
   <div class="subtitle g" style="color:#333333">
     <h5 style="color:#333333" align="center" adr_trans="label_enter_the_email">Enter the Email</h5>
        <hr>
        <center><span class="sub" id="error" style="color:green;"></span></center>
        <form   method="post" name="stdform" action="" onSubmit="">
        <input id="email1" name="email" placeholder="Email" onBlur="this.value=this.value.trim()" type="email" autocomplete="off" class="form-control form-value" required>
        <input type="hidden" name="link1" id="link" value="<?php echo "secret_code=".$secret?>">
        <!-- <input type="hidden" name="sharename" value="<?php echo $loggedin_name;?>"  /> -->
        <hr class="space s">
        <center><button class="btn adr-save" name="link" id="send" ><span adr_trans="label_send">Send</span></button></center>
        </form>
        <hr class="space l">




        </div>
               </div>




 <?php include "footer.php";
