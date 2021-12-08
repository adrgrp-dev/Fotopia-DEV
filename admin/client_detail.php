<?php
ob_start();
include "connection1.php";
//Login Check
?>
<?php include "header.php";  ?>
 <div class="">
        <div class="container" style="margin-left:00px;height:fit-content;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2">
	<?php include "sidebar.php"; ?>
  <style>
/*  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {

  text-align: left;
  padding: 8px;
  color: black;
}*/



/*.nav-tabs > li.active > a, .current-active {
    background:#000!important;color:#FFF!important;
    border-radius: 20px 20px 0px 0px;
    opacity: 0.8;


}
.current-active
{
 background:#000!important;
 color:#FFF!important;border-bottom-color:#000!important;
}*/
  </style>
   <?php
      $realtor_id=@$_REQUEST['realtor_id'];

     $get_realtor_detail=mysqli_query($con,"select * from realtor_profile where realtor_id=$realtor_id");
     $get_data=mysqli_fetch_array($get_realtor_detail);

   ?>



			</div>
                <div class="col-md-10">

                  <div class="row">

                   <h5 align="center" style="color:#333333;">Client Details</h5><br />

                   <div class="col-md-1">


                   </div>


                   <div class="col-md-8">

             <a style="float:right" href="client.php" class="anima-button circle-button btn-sm btn adr-cancel"><i class="fa fa-chevron-circle-left"></i><span adr_trans="label_back_clients">Back to Clients</span></a>
			   <hr class="space s">
                     <table class="table-striped" style="width:100%; border:solid">
					 <tr><td rowspan="8" style="width:200px;">
					  <img style="border:none;" src="data:<?php echo @$get_data['logo_image_type']; ?>;base64,<?php echo base64_encode(@$get_data['logo']); ?>" width="190" height="200" />
					 </td></tr>
                       <tr>
                         <td align="left" class="text"><span adr_trans="label_name">Name</span></td>
                         <td>:</td>
                         <td align="left"><?php  echo @$get_data['first_name']?></td>
                       </tr>
                       <tr>
                         <td align="left"><span adr_trans="label_role">Role</span></td>
                         <td>:</td>
                         <td align="left"><span adr_trans="label_realtor">Realtor</span></td>
                       </tr>
                       <tr>
                         <td align="left"><span adr_trans="label_organization">Organization</span></td>
                         <td>:</td>
                         <td align="left"><?php echo @$get_data['organization_name']?></td>
                       </tr>
                       <tr>
                         <td align="left"><span adr_trans="label_contact">Contact</span></td>
                         <td>:</td>
                         <td align="left"><?php  echo @$get_data['contact_number'] ?> </td>
                       </tr>
                       <tr>
                         <td align="left"><span adr_trans="label_email">Email</span></td>
                         <td>:</td>
                         <td align="left"><?php echo @$get_data['email'] ?></td>
                       </tr>
                     </table>
                   </div>

                   </div>
                   <div class="col-md-1">

                   </div>

                   <div class="col-md-8">
                     <hr class="space s">
					 <div>
                      <h5 style="color:#333333" align="center" adr_trans="label_products">Products</h5>
                      <div style="margin-top: 5px;width:100%;border:solid 1px #000;background-color:white">
                     <table align="center" style="color: #000;opacity:0.9;width:98%;">
                          <tr >
                           <th style="color:black;"><span> S.no</span></th>
                             <th style="color:black;"><span adr_trans="label_product">Product</span></th>
                               <th style="color:black;"><span adr_trans="label_photo_company">Photo Company</span></th>
                                 <th style="color:black;"><span>Default Price</span></th>
                                   <th style="color:black;"><span adr_trans="label_discount">Discount</span></th>
                                     <th style="color:black;"><span adr_trans="label_timeline">Timeline</span></th>
                             </tr>
                             <?php
                             $cnt=1;
                             $pc_admin_id = $_SESSION['admin_loggedin_id'];
                             $get_product_query=mysqli_query($con,"SELECT * FROM `realtor_product_cost` WHERE realtor_id=$realtor_id and pc_admin_id=$pc_admin_id");
                             while($get_product=mysqli_fetch_assoc($get_product_query))
                             {
                             ?>
                             <tr class="listPageTR">

                              <td style="color:black;"><?php echo @$cnt++; ?> </td>
                              <?php
                              $product_id=@$get_product['product_id'];
                              $pc_admin_id=@$get_product['pc_admin_id'];

                              $get_product_query1=mysqli_query($con,"SELECT * FROM `products` WHERE pc_admin_id=$pc_admin_id and id=$product_id");
                              $get_product1=mysqli_fetch_assoc($get_product_query1);
                              ?>
                                <td style="color:black;"><?php echo @$get_product1['product_name']; ?></td>

                                   <?php

                                   $get_pcadmin_info=mysqli_query($con,"select * from admin_users where id=$pc_admin_id");
                                   $get_info=mysqli_fetch_assoc($get_pcadmin_info);
                                   ?>
                                  <td style="color:black;"><?php echo @$get_info['organization_name']; ?></td>
                                    <td style="color:black;"><?php echo @$get_product['product_cost']; ?></td>
                                      <td style="color:black;"><?php echo @$get_product['discount_price']; ?></td>
                                        <td style="color:black;"><?php echo @$get_product1['timeline']; ?></td>
                                </tr>
                                <tr><td class="listPageTRGap">&nbsp;</td></tr>
                              <?php } ?>
                     </table>
                   </div>
</div>
                     <div>

          </div>

        </div>

</div>

</div>




		<?php include "footer.php";  ?>
