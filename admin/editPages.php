<?php
ob_start();

include "connection1.php";


//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}

if(isset($_REQUEST['savepage']))
{
$pageId=$_REQUEST['pageId'];
$pageTitle=$_REQUEST['pageTitle'];
$pageContent=addslashes($_REQUEST['pageContent']);

mysqli_query($con,"update cms_pages set page_title='$pageTitle',page_content='$pageContent' where id='$pageId'");
header("location:pages.php");
}
?>

<?php include "header.php";  ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	
	
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
	
	
 <div class="section-empty bgimage2">
        <div class="" style="margin-left:0px;height:inherit;width:100%">
            <div class="row">
			<hr class="space s">
                <div class="col-md-2" style="padding-left:15px;">

	<?php	if($_SESSION['admin_loggedin_type']=="PCAdmin"){
 	include "sidebar.php";
 } else {
 	include "sidebar.php";
 }
  $supercsr=$_SESSION['admin_loggedin_id'];
  ?>


			</div>
                <div class="col-md-8" style="padding: 15px;margin-top: 14px;">


                 <?php 
				 $pageId=$_REQUEST['id'];
				 
				 $pageIs=mysqli_query($con,"select * from cms_pages where id='$pageId'");
				 $page=mysqli_fetch_array($pageIs);
				 ?>



			<div style="width:100%;background-color: #fff;border-radius: 5px;padding-left: 92px;padding-top: 10px;">
			<form  name="savePages" method="post" action="">
			<input type="hidden" name="pageId" value="<?php echo @$_REQUEST['id']; ?>" />
			<table class="table-stripped">
			
			<tr><td>Page Title<br />
			<input type="text" name="pageTitle" class="form-control" value="<?php echo $page['page_title']; ?>" readonly="" />
			</td></tr>
			<tr><td>Page Content<br />
			<textarea name="pageContent" class="form-control" id="editor"><?php echo $page['page_content']; ?></textarea>
			</td></tr>
			<tr><td><hr class="space xs"><input type="submit" name="savepage" class="btn adr-save" style="height:30px;font-size: 12px;float:right" value="Save" />&nbsp;&nbsp;<a href="pages.php" style="height:30px;font-size: 12px;float:right;margin-right: 10px;" class="btn adr-cancel">Cancel</a><hr class="space xs"></td></tr>
			</table>
			
			</form>

                            </div>
														


                          </div>




                  </div>


                </div>

        </div>

<script src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>
<script src="export.js"></script>
<script>
 CKEDITOR.replace('editor', {
	  width:'100%',
      toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
		{
          "name": "color",
          "groups": ["color"]
        },
        {
          "name": "paragraph",
          "groups": ["list"]
        },
        
        {
          "name": "styles",
          "groups": ["styles"]
        },
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Strike,Subscript,Superscript,Anchor,Specialchar,PasteFromWord'
    });
</script>
<?php
if($_SESSION['admin_loggedin_type']=="CSR"){
?><script>

$("#photographer").css("display","none");
</script>
<?php }
?>
		<?php include "footer.php";  ?>
