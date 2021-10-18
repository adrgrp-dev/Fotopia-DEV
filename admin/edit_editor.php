<?php
ob_start();

include "connection1.php";

$editor_id=$_REQUEST['id'];

$editor1=mysqli_query($con,"select * from editor where id='$editor_id'");
$editor=mysqli_fetch_array($editor1);

//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}

function getName($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
} ?>
<?php
//Login Check
if(isset($_REQUEST['signupbtn']))
{
$id=$_REQUEST['id'];

	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$email=$_REQUEST['email'];
	$contactno=$_REQUEST['contactno'];
	$org=$_REQUEST['org'];

  if(empty($_REQUEST["org_website"]))
{
  $org_website=0;
}
else
{
$org_website = $_REQUEST["org_website"];
}

$photographer_id=$_REQUEST['photographer_id'];

	$email_verification_code=getName(10);


		//echo "insert into admin_users (first_name,last_name,email,password,contact_number,address_line1,address_line2,city,state,postal_code,country,profile_pic,profile_pic_image_type,registered_on)values('$fname','$lname','$email','$password','$contactno','$addressline1','$addressline2','$city','$state','$zip','$country','$imgData','$imageType',now())";exit;

	$res=mysqli_query($con,"update editor set first_name='$fname',last_name='$lname',email='$email',contact_number='$contactno',organization_name='$org',organization_website='$org_website',photographer_id='$photographer_id' where id='$id'");

	//echo "select * from user_login where email='$email' and password='$pass'";



	header("location:csr_list1.php?eu=1");

}
?>
<?php include "header.php";  ?>
	<div class="section-empty bgimage1" data-sub-height="238">
            <div class="row">


			<div class="col-md-2" style="margin-left:10px;">


	<?php include "sidebar.php"; ?>

			<script>
function validate_email(val)
{
  var xhttp= new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200){
     if(this.responseText == "true")
     {

        var langIs='<?php echo $_SESSION['Selected_Language_Session']; ?>';
		var alertmsg='';
		if(langIs=='no')
		{
	$("#Email_exist_error").html("E-posten er allerede i bruk, vennligst velg en annen e-post og fortsett");
		}
		else
		{
		$("#Email_exist_error").html("Email already in use, please choose different email and continue");
		}
	   $("#Email_exist_error").show();
	   $("#email").val("");
	    $("#email").focus();
     }
     else
     {
      $("#Email_exist_error").html();
	  $("#Email_exist_error").hide();
     }
    }
  };
  xhttp.open("GET","validate_email.php?id="+val,true);
  xhttp.send();
}
</script>
			</div>
                <div class="col-md-8" style="padding-top:30px;">









						  <form action="" class="form-box form-ajax" method="post" enctype="multipart/form-data" onsubmit="return validateData()" style="color: #000;box-shadow: 5px 5px 5px 5px #aaa;background: #E8F0FE;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;padding:20px;margin-left:30px;">
 <div class="col-md-12"><h5 align="center" id="label_edit_editor" adr_trans="label_edit_editor"> Edit Editor</h5></div>


  						<div class="col-md-6">
                                  <p id="label_first_name" adr_trans="label_first_name">First Name</p>
                                  <input id="fname" name="fname" placeholder="First name" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $editor['first_name']; ?>">
                              </div>

  							<div class="col-md-6">
                                  <p id="label_last_name" adr_trans="label_last_name">Last Name</p>
                                  <input id="lname" name="lname" placeholder="Last name" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $editor['last_name']; ?>">
                              </div>

                               <div class="col-md-6">
                                  <p id="label_email" adr_trans="label_email">Email<span style="margin-left:20px;color:red;display:none" id="Email_exist_error" align="center" class="alert-warning"></span>
            </p>
  <input id="email" name="email" placeholder="Email" type="email" autocomplete="off"  onblur="validate_email(this.value)" class="form-control form-value" required="" value="<?php echo $editor['email']; ?>">

                              </div>


                 <div class="col-md-6">
                                  <p id="label_contact_no" adr_trans="label_contact_no">Contact Number</p>
                                  <input id="contactno" name="contactno" placeholder="Contact number" type="number" autocomplete="off" class="form-control form-value" required="" value="<?php echo $editor['contact_number']; ?>">
                              </div>

                <div class="col-md-6">
                                <p id="label_organization" adr_trans="label_organization">Organization</p>
                                <input id="org" name="org" placeholder="Organization" type="text" autocomplete="off" class="form-control form-value" required="" value="<?php echo $editor['organization_name']; ?>">
                            </div>

                              <div class="col-md-6">
                                <p adr_trans="">Organization Website</p>
                                <input id="org_website" name="org_website" placeholder="Organization Website" type="text" autocomplete="off" class="form-control form-value" value="<?php echo $editor['organization_website']; ?>">
                            </div>       

         <div class="col-md-6">

          <?php

        $photographer_id =  $editor['photographer_id'];
        $res2=mysqli_query($con,"SELECT first_name FROM user_login where id='$photographer_id'");
        $res3=mysqli_fetch_array($res2);

          ?>
                                <p id="label_photographer" adr_trans="label_photographer">Photographer</p>
                               <select name="photographer_id" class="form-control form-value"  required="">
                               <option selected value="<?php echo $editor['photographer_id']; ?>" ><?php echo $res3['first_name']; ?> </option>
              <?php

              $type_of_user=$_SESSION['admin_loggedin_type'];
  $editorList=NULL;

              // if($type_of_user=="PCAdmin")
              // {
              $pc_admin_id=$_SESSION['admin_loggedin_id'];
              $editorList=mysqli_query($con,"select id,first_name from user_login where type_of_user='Photographer' and pc_admin_id='$pc_admin_id'");
              // }

              // $editor_ID=0;
              // if($type_of_user=="Photographer")
              // {
              // $editor_ID=$_SESSION['admin_loggedin_id'];
              // $findPCAdmin=mysqli_query($con,"select pc_admin_id from admin_users where id='$editor_ID'");
              // $findPCAdmin1=mysqli_fetch_array($findPCAdmin);

              // $pc_admin_id=$findPCAdmin1['pc_admin_id'];

              // $editorList=mysqli_query($con,"select id,first_name from admin_users where type_of_user='editor' and pc_admin_id='$pc_admin_id'");
              // }

              while($editorList1=mysqli_fetch_array($editorList))
              {
              ?>
              <option value="<?php echo $editorList1['id']; ?>"><?php echo $editorList1['first_name']; ?></option>
              <?php } ?>
              </select>
                            </div>






<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />


  						 <div class="row">
                              <div class="col-md-12"><center><hr class="space s">

  							<div class="error-box" style="display:none;">
                              <div class="alert alert-warning" id="error-msg">&nbsp;</div>
                          </div>

  						 <button id="label_update" adr_trans="label_update" class="anima-button circle-button btn-sm btn" type="submit" name="signupbtn"><i class="fa fa-sign-in"></i>Update</button>
                         &nbsp;&nbsp;<a id="label_cancel" adr_trans="label_cancel"  class="anima-button circle-button btn-sm btn" href="csr_list1.php"><i class="fa fa-times"></i>Cancel</a>
  </center>
  					   </div>

					   </form>

                          </div>


                  </div>


              </div>



        <script>


       </script>


		<?php include "footer.php";  ?>
