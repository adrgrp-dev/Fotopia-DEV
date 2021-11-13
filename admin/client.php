<?php
ob_start();
include "connection1.php";
//Login Check

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function getName($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function email($template,$pc_admin_id,$email,$organization,$fname,$con)
{
	/* Exception class. */
	require 'C:\PHPMailer\src\Exception.php';

	/* The main PHPMailer class. */
	require 'C:\PHPMailer\src\PHPMailer.php';

	/* SMTP class, needed if you want to use SMTP. */
	require 'C:\PHPMailer\src\SMTP.php';
  $pc_admin_id=$_SESSION['admin_loggedin_id'];
  //echo "SELECT * FROM `photo_company_profile` WHERE id=$pc_admin_id";
  $get_pcadmin_profile_query=mysqli_query($con,"SELECT * FROM `photo_company_profile` WHERE pc_admin_id=$pc_admin_id");
  $get_profile=mysqli_fetch_assoc($get_pcadmin_profile_query);
  $pcadmin_email=$get_profile['email'];
  $pcadmin_contact=$get_profile['contact_number'];



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

	//To address and name
	// ;
	// // //Recipient name is optional
	// //;
	// ;
	$mail->addAddress($email);
 // $mail->addAddress("sidambara.selvan@adrgrp.com");


	//Address to which recipient will reply
	$mail->addReplyTo($_SESSION['emailUserID'], "Reply");

	//CC and BCC
	//$mail->addCC("cc@example.com");
	//$mail->addBCC("bcc@example.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);
   //$data=$get_profile['logo_image_type'].";base64,".base64_encode($get_profile['logo']);
   //echo $data;
  //echo $get_profile['logo_image_type'];
   //echo base64_encode($get_profile['logo']);
   //$mail->AddStringAttachment("data:".$get_profile['logo_image_type'].";base64,".base64_encode($get_profile['logo']));







//  exit;

	$mail->Subject = "Invitation to join Fotopia";

  //<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Send invite successfully</td>
  //<td align=\"right\"><img src=\"data:".$get_profile['logo_image_type'].";base64,".base64_encode($get_profile['logo'])."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>

	$mail->Body = "<html><head><style>.titleCss {font-family: \"Roboto\",Helvetica,Arial,sans-serif;font-weight:600;font-size:18px;color:#0275D8 }.emailCss { width:100%;border:solid 1px #DDD;font-family: \"Roboto\",Helvetica,Arial,sans-serif; } </style></head><table cellpadding=\"5\" class=\"emailCss\"><tr><td align=\"left\"><img src=\"".$_SESSION['project_url']."logo.png\" /></td><td align=\"center\" class=\"titleCss\">Invitation to join Fotopia</td>
  <td align=\"right\"><img src=\"".$_SESSION['project_url'].$get_profile['logo_image_url']."\" width=\"110\" height=\"80\"/></td>  </tr><tr><td align=\"left\">info@fotopia.com<br>343 4543 213</td><td colspan=\"2\" align=\"right\">".strtoupper($get_profile['organization_name'])."<br>".$pcadmin_email."<br>".$pcadmin_contact."</td></tr><tr><td colspan=\"2\"><br><br>";
	//$mail->AltBody = "This is the plain text version of the email content";



	$mail->Body.=$template;

	$mail->Body=str_replace('{{project_url}}', $_SESSION['project_url'] , $mail->Body);
  $mail->Body=str_replace('{{organization}}', $organization , $mail->Body);
	$mail->Body=str_replace('{{name}}',$fname, $mail->Body);
	$mail->Body.="<br><br></td></tr></table></html>";

    echo $mail->Body;
   //exit;


	try {
	    $mail->send();
	    echo "Message has been sent successfully";
	} catch (Exception $e) {
		echo $e->getMessage();
	    echo "Mailer Error: " . $mail->ErrorInfo;
	}
}
if(isset($_REQUEST['loginbtn']))
{
	header("location:index.php?failed=1");
}
if(isset($_REQUEST['email']))
{
  $pc_admin_id=$_SESSION['admin_loggedin_id'];
	$get_template_query=mysqli_query($con,"SELECT * FROM `email_template` WHERE template_title='Inviting new clients' and pc_admin_id='$pc_admin_id'");
  $get_template=mysqli_fetch_assoc($get_template_query);
	$template=$get_template['template_body_text'];
	$email=$_REQUEST['email'];
	$get_organization_query=mysqli_query($con,"select * from admin_users where id=$pc_admin_id");
	$get_organization=mysqli_fetch_assoc($get_organization_query);
	$organization=$get_organization['organization'];
	$fname=$get_organization['first_name'];

	email($template,$pc_admin_id,$email,$organization,$fname,$con);
 header('location:client.php');
}
?>
<?php include "header.php";  ?>
 <div class="">
        <div class="" style="margin-left:00px;height:fit-content;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:10px;">
	<?php include "sidebar.php"; ?>
  <style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {

  text-align: center;
  padding: 8px;
  color: black;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
@media only screen and (max-width: 600px) {
td
{
min-width:100px!important;
}
.tab-box
{
margin-left:15px!important;
width:100%!important;
}
}
  </style>
<script>
function favourite(realtor_id,pc_admin_id)
{
  if(confirm('Are you sure want to add this realtor to your favourite list?'))
var xhttp= new XMLHttpRequest();
  xhttp.onload = function() {
      window.location.href = "client.php";
    }
  xhttp.open("GET", "client_favourite.php?realtor_id="+realtor_id+"&pc_admin_id="+pc_admin_id, true);
  xhttp.send();
}
function unfavourite(realtor_id,pc_admin_id)
{
  if(confirm('Are you sure want to remove this realtor from your favourite list?'))
var xhttp= new XMLHttpRequest();
  xhttp.onload = function() {
      window.location.href = "client.php";
    }
  xhttp.open("GET", "client_unfavourite.php?realtor_id="+realtor_id+"&pc_admin_id="+pc_admin_id, true);
  xhttp.send();
}

</script>
 

			</div>
                <div class="col-md-10">
                  <?php   //echo $_SESSION['project_url'];?>
                   <a href="Realtor_registration.php" class="anima-button circle-button btn-sm btn"  style="float:right;margin-top:-6px;"><i class="fa fa-plus"></i>Add Realtor</a>

<?php if(@isset($_REQUEST["a"])) { ?>
                        <div class="success-box" style="display:block;margin-left:300px;">
                            <div class="text-success">Realtor has been successfully added and an invite has been sent successfully </br></br></div>
                        </div>
						<?php }  ?>

                  <div class="col-md-12" style="margin-left:20px;">

                              <div class="tab-box " data-tab-anima="fade-right" style="">


                                  <ul class="nav nav-tabs  nav-justified" style="border-bottom:1px solid #000;">
                                      <li id="click1" class="active current-active"><a href="#" id="label_all_realtor" adr_trans="label_all_realtor">All Realtor</a></li>
                                      <li id="click2"><a href="#" id="label_favourite_realtor" adr_trans="label_favourite_realtor">My Favourite Realtor</a></li>

                                  </ul>
                                  <div class="panel active" style="" id="tab1">
                                    <div class="col-md-9">

																		<form name="realtorSearch" method="post" action="client.php" >
																	  <input type="text" class="form-control form-value" name="filter_realtor" placeholder="Name,City,Organization" onBlur="this.form.submit()" style=""/>
																		</form>
																		</div><div class="col-md-3">
																		<p style="float:right"><a href="#tnc" class=" lightbox link">
																		<i style="
				color: blue;
				top: -43px;
				font-size: 50px;

				margin-right: 5px;
				" class="fa fa-envelope" aria-hidden="true"></i><br /><b style="position: relative;top: 3px;right: 20px;font-size: 16px;"><span adr_trans="label_send_invite">Send Invite</span></b></a></p>
				</div>
                                    <hr class="space s">

									 <div style="width:100%;overflow:scroll;height:500px;">
                                    <table style="width:100%" class="table-stripped">
                                       <tr>
                                         <th><span adr_trans="label_first_name">Firstname</span></th>
                                         <th><span adr_trans="label_last_name">Lastname</span></th>
										<th><span adr_trans="label_organization">Organization</span></th>
                                         <th><span adr_trans="label_address">Address</span></th>
                                            <th><span adr_trans="label_city">City</span></th>
                                               <th><span adr_trans="label_state">state</span></th>
                                               <th><span adr_trans="label_country">Country</span></th>
                                                  <th><span adr_trans="label_details">Details</span></th>
                                                  <th><span adr_trans="label_add_favourite">Add to favourite</span></td>
                                       </tr>
                                       <?php
                                       $loggedin_id=$_SESSION['admin_loggedin_id'];


$realtor_query="";

if(@$_REQUEST['filter_realtor'])
{
$searchKey=$_REQUEST['filter_realtor'];
$conditions="and (first_name like '%$searchKey%' or last_name like '%$searchKey%' or organization_name like '%$searchKey%' or city like '%$searchKey%')";
$realtor_query=mysqli_query($con,"select * from user_login where type_of_user='Realtor' $conditions");
}
else
{
// $realtor_query=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and id not in(select realtor_id from company_favourite_realtor where pc_admin_id='$loggedin_id')");
	$realtor_query=mysqli_query($con,"select * from user_login where type_of_user='Realtor'");
}






                       // $realtor_query=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and id not in(select realtor_id from company_favourite_realtor where pc_admin_id='$loggedin_id')");
                                       while($realtor=mysqli_fetch_assoc($realtor_query))
                                       {
                                          ?>
                                          <tr>
                                            <td><?php echo @$realtor['first_name'];?></td>
                                                <td><?php echo @$realtor['last_name'];?></td>
						<td><?php echo @$realtor['organization_name'];?></td>
                                                    <td><?php echo @$realtor['address_line1'];?></td>
                                                        <td><?php echo @$realtor['city'];?></td>
                                                        <td><?php echo @$realtor['state'];?></td>
                                                       <td><?php echo @$realtor['country'];?></td>
                               <td><a href="client_detail.php?realtor_id=<?php echo $realtor['id'];?>"><i class="fa fa-external-link"></i></a></td>
                          <?php 

                          $realtor_id=$realtor['id'];

                          $find_fav_realtor=mysqli_query($con,"SELECT count(*) as total FROM `company_favourite_realtor` where realtor_id='$realtor_id' and pc_admin_id='$loggedin_id'");

                          $find_fav_realtor1=mysqli_fetch_assoc($find_fav_realtor);

                          if($find_fav_realtor1['total']==0)
                          {
                          ?>

                           <td><a title="Add to favorites" onclick="favourite('<?php echo $realtor['id'];?>','<?php echo $loggedin_id;?>');"><i class="fa fa-heart-o"></i></a></td>
                           <?php 

                       }

                       else{ 
                       	?>

                       	<td><a title="Already added to favourites"><i class="fa fa-heart" style="color:green;"></i></a></td>

					<?php } ?>

                                          </tr>

                                          <?php  } ?>

                                     </table></div>
                                  </div>
                                  <div class="panel" id="tab2">
											<div class="col-md-9">
			<form name="realtorSearch" method="post" action="client.php?favourite=1">
	  <input type="text" class="form-control form-value" name="filter_realtor_favourite" placeholder="Name,City,Organization" onBlur="this.form.submit()" style="width:100%;display:inline-block"/>
			</form>
		</div>
		<div class="col-md-3">
				<p style="float:right"><a href="#tnc" class=" lightbox link">
			<i style="
				color: blue;
				top: -43px;
				font-size: 50px;

				margin-right: 5px;
				" class="fa fa-envelope" aria-hidden="true"></i><br /><b style="position: relative;top: 3px;right: 20px;font-size: 16px;"><span adr_trans="label_send_invite">Send Invite</span></b></a></p>
				</div>
                                    <hr class="space s">
									 <div style="width:100%;overflow:scroll;height:500px;">
                                    <table style="width:100%" class="table-striped">
                                       <tr>
                                         <th><span adr_trans="label_first_name">Firstname</span></th>
                                         <th><span adr_trans="label_last_name">Lastname</span></th>
										<th><span adr_trans="label_organization">Organization</span></th>
                                         <th><span adr_trans="label_address">Address</span></th>
                                            <th><span adr_trans="label_city">City</span></th>
                                               <th><span adr_trans="label_state">state</span></th>
                                               <th><span adr_trans="label_country">Country</span></th>
                                                  <th><span adr_trans="label_details">Details</span></th>
                                                  <th><span adr_trans="label_favourite">Favourite</span></td>
                                       </tr>
                                       <?php
																 $realtor_query1="";

			   if(@$_REQUEST['filter_realtor_favourite'])
				  {

				 $searchKey1=$_REQUEST['filter_realtor_favourite'];

			$conditions1="and (first_name like '%$searchKey1%' or last_name like '%$searchKey1%' or organization_name like '%$searchKey1%' or city like '%$searchKey1%')";

			$realtor_query1=mysqli_query($con,"select * from user_login where type_of_user='Realtor' $conditions1 and id in(select realtor_id from company_favourite_realtor where pc_admin_id='$loggedin_id')");

					}

				else
				{

		$realtor_query1=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and id in(select realtor_id from company_favourite_realtor where pc_admin_id='$loggedin_id')");

				}
                                       // $realtor_query=mysqli_query($con,"select * from user_login where type_of_user='Realtor' and id in(select realtor_id from company_favourite_realtor where pc_admin_id='10')");
                                       while($realtor1=mysqli_fetch_assoc($realtor_query1))
                                       {
                                          ?>
                                          <tr>
                                            <td><?php echo @$realtor1['first_name'];?></td>
                                                <td><?php echo @$realtor1['last_name'];?></td>
																									  <td><?php echo @$realtor1['organization'];?></td>
                                                    <td><?php echo @$realtor1['address_line1'];?></td>
                                                        <td><?php echo @$realtor1['city'];?></td>
                                                            <td><?php echo @$realtor1['state'];?></td>
                                                                <td><?php echo @$realtor1['country'];?></td>
                                                                    <td><a href="client_detail.php?realtor_id=<?php echo $realtor1['id'];?>"><i class="fa fa-external-link"></i></a></td>
                                                                        <td><a title="Remove from favourites" onclick="unfavourite('<?php echo $realtor1['id'];?>','<?php echo $loggedin_id;?>');"><i class="fa fa-heart" style="color:green;"></i></a></td>
                                          </tr>
                                          <?php
                                      }
                                       ?>

                                     </table></div>

                                  </div>
																	<?php
                                    if(@$_REQUEST['favourite'])
																		{
																			?>
																			<script>
																			$("#click1").removeClass('active');
																			$("#click2").addClass('active');
																			$("#tab1").removeClass('active');
																			$("#tab2").addClass('active');

																			</script>
																			<?php
																		}
																	?>

                              </div>
                          </div>
          </div>
        </div>
</div>
</div>

<div id="tnc" class="box-lightbox white" style="padding:25px;border-radius:25px 25px 25px 25px;width:300px;height:200px;">
	 <div class="subtitle g" style="color:#333333">
		 <h5 style="color:#333333" align="center" id="label_enter_the_email" adr_trans="label_enter_the_email">Enter the Email</h5>
				<hr>
				<center><span class="sub" id="error" style="color:green;"></span></center>
				<form   method="post" name="stdform" action="" onsubmit="">
				<input id="email1" name="email" placeholder="Email" type="email" autocomplete="off" class="form-control form-value" required>
				<input type="hidden" name="pc_admin_id" id="pc_admin_id" value="<?php echo $pc_admin_id?>"/><br>
				<center><button class="btn adr-save" name="link" id="send" ><span adr_trans="label_send">Send</span></button></center>
				</form>
				<hr class="space l">




				</div>
							 </div>



		<?php include "footer.php";  ?>
