<style>

</style>
 <footer class="wide-area foo">
        <div class="content">
            <div class="container" style="color:#000!important;font-weight:bold;">
                <div class="row">
                    <div class="col-md-6 footer-left">
                        <p adr_trans="">Copyright © 2022 Fotopia App. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 footer-right">
                        <span style="color:#000!important;font-weight:bold;">support@fotopia.no</span>
                        <span class="space"></span>
                        <div class="btn-group navbar-social">
                            <div style="margin-left:7px;background:#FFF!important;text-align:center;">
 <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook" style="font-size:10px;padding:5px;border-radius:20px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="https://www.instagram.com/"><i class="fa fa-instagram" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="https://www.twitter.com/"><i class="fa fa-twitter" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="https://www.youtube.com/"><i class="fa fa-youtube-play" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
<a target="_blank" href="https://www.linkedin.com/"><i class="fa fa-linkedin" style="font-size:10px;padding:5px;border-radius:20px;padding:4px;background:#000;color:#FFF"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <link property="" rel="stylesheet" href="scripts/font-awesome/css/font-awesome.min.css">
        <script async src="scripts/bootstrap/js/bootstrap.min.js"></script>
		 <script src='scripts/flexslider/jquery.flexslider-min.js'></script>
        <script src="scripts/imagesloaded.min.js"></script>
        <script src='scripts/jquery.progress-counter.js'></script>
		  <script src='scripts/jquery.magnific-popup.min.js'></script>
		 <script src='scripts/jquery.flipster.min.js'></script>
        <script src='scripts/jquery.tab-accordion.js'></script>
        <script src='scripts/smooth.scroll.min.js'></script>
		<script src='scripts/parallax.min.js'></script>
    </footer>
    <script>
$( document ).ready(function() {
var lang="<?php if(isset($_SESSION['Selected_Language_Session'])) { echo $_SESSION['Selected_Language_Session']; } ?>";
changeLanguage(lang);
if(lang=="en")
{
loadfile="en.json";
}
else
{
loadfile="no.json";
}
var data="";


$.ajax({
type: "Get",
url: loadfile,
dataType: "json",
success: function(data) {



$("td[adr_trans],strong[adr_trans],th[adr_trans],b[adr_trans],div[adr_trans],p[adr_trans],span[adr_trans],button[adr_trans],a[adr_trans],h1[adr_trans],h2[adr_trans],h3[adr_trans],h4[adr_trans],h5[adr_trans]").each(function(){
// alert($(this).attr("id"));
var idIs=$(this).attr("adr_trans");
//var idIs=$(this).attr("id");




var htmlIs=$('[adr_trans="'+idIs+'"]').html();

if(htmlIs.indexOf("fa fa")!=-1)
{
//alert("coming");
var splitIs=htmlIs.split("</i>");

var actualFA=splitIs[0]+"</i>";
//alert(actualFA);
$('[adr_trans="'+idIs+'"]').html(actualFA+data[idIs]);
}
else
{
$('[adr_trans="'+idIs+'"]').html(data[idIs]);
}


});

},
error: function(){
 //alert("json not found");
}
});


$('input[type=text]').each(function(){
    $(this).attr("pattern","^[a-zA-Z0-9_]+.*$");
	$(this).attr("title","Input must contain atleast one character, No space at beginning and no symbol at beginning and must start with a character.");
})

$('input[type=email]').each(function(){
//[^@\s]+@[^@\s]+\.[^@\s]+
$(this).attr("type","text");
    $(this).attr("pattern","[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}");
	$(this).attr("title","Invalid email address");
})





});


</script>

<?php
@$usertype = $_SESSION["user_type"];
$currentPage=$_SERVER['PHP_SELF'];

if ($usertype == 'Realtor'){ 

 if(strpos($currentPage, "csrRealtorDashboard") !== false || strpos($currentPage, "change_email_password") !== false)
 {
 echo "<script> $('#homeMenu').css('background','#aad1d6');  </script>";
 }

 if(strpos($currentPage, "order_list") !== false || strpos($currentPage, "create_order") !== false || strpos($currentPage, "order_detail") !== false || strpos($currentPage, "Edit_appointment") !== false || strpos($currentPage, "Edit_order") !== false || strpos($currentPage, "create_appointment") !== false || strpos($currentPage, "summary") !== false || strpos($currentPage, "rating") !== false || strpos($currentPage, "select_products") !== false)
 {
 echo "<script> $('#ordersMenu').css('background','#aad1d6');  </script>";
 }

  if(strpos($currentPage, "csrRealtorCalendar") !== false || strpos($currentPage, "photographerCalendar1") !== false)
 {
 echo "<script> $('#calendarMenu').css('background','#aad1d6'); </script>";
 }

  if(strpos($currentPage, "realtor_activity") !== false)
 {
 echo "<script> $('#notificationMenu').css('background','#aad1d6');  </script>";
 }

  if(strpos($currentPage, "order_reports") !== false || strpos($currentPage, "payment_reports") !== false)
 {
 echo "<script> $('#reportsMenu').css('background','#aad1d6');  </script>";
 }

  if(strpos($currentPage, "realtor_profile") !== false || strpos($currentPage, "edit_realtor_profile") !== false)
 {
 echo "<script> $('#profileMenu').css('background','#aad1d6');  </script>";
 }


 }

 elseif ($usertype == 'Photographer'){

// || strpos($currentPage, "change_email_password") !== false

    if(strpos($currentPage, "photographerDashboard") !== false || strpos($currentPage, "change_email_password") !== false)
 {
 echo "<script> $('#homeMenu').css('background','#aad1d6');  </script>";
 }

 if(strpos($currentPage, "photographerCalendar") !== false)
 {
 echo "<script> $('#calendarMenu').css('background','#aad1d6'); </script>";
 }

  if(strpos($currentPage, "editor_list") !== false)
 {
 echo "<script> showHide(9); </script>";
 }



 if(strpos($currentPage, "photographerorder_list") !== false || strpos($currentPage, "create_order") !== false  || strpos($currentPage, "create_appointment") !== false || strpos($currentPage, "Edit_appointment1") !== false || strpos($currentPage, "photographerorder_detail") !== false || strpos($currentPage, "preview1") !== false || strpos($currentPage, "summary") !== false || strpos($currentPage, "finished_image_upload") !== false || strpos($currentPage, "preview3") !== false)
 {
 echo "<script> $('#ordersMenu').css('background','#aad1d6');  </script>";
 }

 if(strpos($currentPage, "photographeractivity") !== false)
 {
 echo "<script> $('#notificationMenu').css('background','#aad1d6'); </script>";
 }

 if(strpos($currentPage, "photographerorder_list") !== false)
 {
 echo "<script> $('#ordersMenu').css('background','#aad1d6');  </script>";
 }

 if(strpos($currentPage, "photographer_profile") !== false || strpos($currentPage, "photographer_profile") !== false)
 {
 echo "<script> $('#profileMenu').css('background','#aad1d6');  </script>";
 }



 if(strpos($currentPage, "Products") !== false)
 {

 echo "<script> $('#productsMenu').css('background','#aad1d6');  </script>";
 }
  if(strpos($currentPage, "select_Products") !== false)
 {
    
 echo "<script> $('#productsMenu').css('background','white');  </script>";
 }

 }

if(strpos($currentPage, "photographerorder_detail") != true && strpos($currentPage, "order_detail") != true  && strpos($currentPage, "signup") != true)
{
 ?>
<script>

var form_enabled = true;
$().ready(function(){
       // allow the user to submit the form only once each time the page loads
       $('form').on('submit', function(){
               if (form_enabled) {
                       form_enabled = false;
                       return true;
               }

               return false;
        });
		
		
});

</script>
<?php } ?>
<script>

$(window).bind('load', function() {
  $('img').each(function() {
    if( (typeof this.naturalWidth != "undefined" && this.naturalWidth == 0) 
    ||  this.readyState == 'uninitialized'                                  ) {
       // $(this).attr('src', 'missing.jpg');
	   $(this).css("visibility","hidden");
	   
    }
  });
});
</script>
</body>
</html>
