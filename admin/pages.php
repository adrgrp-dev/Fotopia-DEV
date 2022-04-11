<?php
ob_start();

include "connection1.php";


//Login Check
if(isset($_REQUEST['loginbtn']))
{


	header("location:index.php?failed=1");
}
?>

<?php include "header.php";  ?>
<style>
@media only screen and (max-width: 600px) {
.infos
{
    margin-left: 0px !important;
    margin-top: -50px !important;
    margin-right: -35px !important;
}
}

tr:last-child > th
{
    background: #aad1d6;
    padding-top: 10px !important;
    padding-bottom: 10px;
    padding-left: 3px !important;
}
.infos p
{
  margin-right: -40px;
}
#undefined-footer
{
  background: white;
  padding: 0px 25px;
  border-radius: 0px 0px 5px 5px!important;
}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
                <div class="col-md-10" style="padding-left:15px;">





<h5><span adr_trans="cms_pages" style="color:#000;margin-left: 3px;">CMS Pages</span></h5>  
			<div style="width:100%;background:#FFF;border-radius: 5px 5px 0px 0px!important;margin-top: 10px;">
 <hr class="space xs" />
                            <table id="dataTable" class="table-striped" align="center" style="background:#FFF;color:#000;opacity:0.8;width:98%;">
                                  <thead>
                                      <tr><th data-column-id="id" class="text-left" style=""><span class="text" id="label_s.no" adr_trans="label_s.no">

                                            S.No

                                          </span><span class="icon fa "></span></th><th data-column-id="name" class="text-left" style=""><span class="text" id="label_property" adr_trans="page_title">
                                            Page Title
                                          </span>
                              <span class="icon fa "></span></th><th data-column-id="logo" class="text-left" style=""><span class="text" id="label_photographer" adr_trans="page_content">

                                           Page Content


                                          </span>


                              <span class="icon fa "></span></th><th data-column-id="more-info" class="text-left" style=""><span class="text" id="label_session_date_time" adr_trans="last_updated_date_time">

                                         Last updated on


                                          </span>

                              <span class="icon fa "></span></th><th data-column-id="link" class="text-left" style=""><span class="text" id="label_status" adr_trans="label_status">

                                                  Status

                                          </span>	</a></th></tr>
                                  </thead>
                                  <tbody>
                          <?php
                                     //	---------------------------------  pagination starts ---------------------------------------
																		 if(@$_GET["page"]<0)
																	   {
																	   $_GET["page"]=1;
																	   }
                          if(empty($_GET["page"]))
                          {
                            $_SESSION["page"]=1;
                          }
                          else {
                            $_SESSION["page"]=$_GET["page"];
                          }
                          if($_SESSION["page"] == 0)
                          {
                            $_SESSION["page"]=1;
                          }
$q1="select count(*) as total FROM `cms_pages`";
												//	echo $q1;

$res="";
                          $result=mysqli_query($con,$q1);
                          @$data=mysqli_fetch_assoc(@$result);
                          $number_of_pages=50;

                          // total number of user shown in database
                          $total_no=$data['total'];

                          $Page_check=intval($total_no/$number_of_pages);
                          $page_check1=$total_no%$number_of_pages;
                          if($page_check1 == 0)
                          ;
                          else {
                            $Page_check=$Page_check+1;

                          }
                          if($Page_check<=$_SESSION["page"])
                          {
                            $_SESSION["page"]=$Page_check;
                          }
                          // how many entries shown in page

                          //starting number to print the users shown in page
                          $start_no_users = ($_SESSION["page"]-1) * $number_of_pages;

                           $cnt=$start_no_users;


  $res="select * FROM `cms_pages` order by page_title limit $start_no_users ,$number_of_pages";
								@$res1=mysqli_query($con,@$res);
								// echo $res;


                          while(@$getCMSPages=mysqli_fetch_assoc($res1))
                          {
                          $cnt++;
                             //	---------------------------------  pagination starts ---------------------------------------
                          ?>
                          <tr data-row-id="0" class="listPageTR">
						   <td><?php echo $cnt; ?></td>
                          <td><?php echo $getCMSPages['page_title']; ?></td>
						   <td><a href="editPages.php?id=<?php echo $getCMSPages['id']; ?>" class="btn btn-primary btn-sm adr-save" style="height: 30px;font-size: 12px;">View / Edit</a></td>
						    <td><?php  echo $getCMSPages['last_updated_on']; ?></td>
							 <td><?php if($getCMSPages['status']==1) { echo "Active"; } else { echo "Inactive"; } ?></td>


                          </tr>
                          <tr><td class="listPageTRGap">&nbsp;</td></tr>
												<?php } ?>
												</tbody>
                              </table></div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled " aria-disabled="true"><a href="./pages.php?page=1" class="button">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./pages.php?page=".($_SESSION["page"]-1);?>" class="button">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./pages.php?page=".($_SESSION["page"]+1);?>" class="button">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./pages.php?page=".($Page_check);?>" class="button">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:24px">
																		<div class="infos"><p align="right"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?>&nbsp;<span adr_trans="label_to"> to </span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> &nbsp;of &nbsp;<?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></p><hr class="space s"></div>
																		</div>
																	</div>
																</div>



															<script type="text/javascript">
																		 function Orders(){
																			html2canvas($('#dataTable')[0], {
																					onrendered: function (canvas) {
																							var data = canvas.toDataURL();
																							var docDefinition = {
																									content: [{
																											image: data,
																											width: 500
																									}]
																							};
																							pdfMake.createPdf(docDefinition).download("Order_repots.pdf");
																					}
																			});
																		}

															</script>
                          </div>




                  </div>


                </div>

        </div>

<script src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>
<script src="export.js"></script>
<?php
if($_SESSION['admin_loggedin_type']=="CSR"){
?><script>

$("#photographer").css("display","none");
</script>
<?php }
?>
		<?php include "footer.php";  ?>
