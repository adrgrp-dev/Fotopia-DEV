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


                 



			<div style="width:100%;overflow:scroll;border:solid 1px #000">

                            <table id="dataTable" class="table-striped" style="background:#FFF;color:#000;opacity:0.8;width:100%;border-radius:30px 30px 30px 30px!important;">
                                  <thead>
						<tr><th colspan="8" align="center" ><center><b><br /><span adr_trans="cms_pages">CMS Pages</span><br /></b></center></th></tr>
                                      <tr><th data-column-id="id" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_s.no" adr_trans="label_s.no">

                                            S.No

                                          </span><span class="icon fa "></span></a></th><th data-column-id="name" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_property" adr_trans="page_title">
                                            Page Title
                                          </span>
                              <span class="icon fa "></span></a></th><th data-column-id="logo" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_photographer" adr_trans="page_content">

                                           Content


                                          </span>


                              <span class="icon fa "></span></a></th><th data-column-id="more-info" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_session_date_time" adr_trans="last_updated_date_time">

                                         Last updated On


                                          </span>

                              <span class="icon fa "></span></a></th><th data-column-id="link" class="text-left" style=""><a href="javascript:void(0);" class="column-header-anchor sortable"><span class="text" id="label_status" adr_trans="label_status">

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
                          $number_of_pages=5;

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
                          <tr data-row-id="0">
						   <td><?php echo $cnt; ?></td>
                          <td><?php echo $getCMSPages['page_title']; ?></td>
						   <td><a href="editPages.php?id=<?php echo $getCMSPages['id']; ?>" class="btn btn-primary btn-sm">View / Edit</a></td>
						    <td><?php  echo $getCMSPages['last_updated_on']; ?></td>
							 <td><?php if($getCMSPages['status']==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
						  
						  
                          </tr>
												<?php } ?>
												</tbody>
                              </table></div>
															<div id="undefined-footer" class="bootgrid-footer container-fluid">
																<div class="row"><div class="col-sm-6">
																	<ul class="pagination">
																		<li class="first disabled " aria-disabled="true"><a href="./order_reports.php?page=1" class="button adr-save">«</a></li>
																		<li class="prev disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]-1);?>" class="button adr-save">&lt;</a></li>
																		<li class="page-1 active" aria-disabled="false" aria-selected="true"><a href="#1" class="button adr-save"><?php echo $_SESSION["page"]; ?></a></li>
																		<li class="next disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($_SESSION["page"]+1);?>" class="button adr-save">&gt;</a></li>
																		<li class="last disabled" aria-disabled="true"><a href="<?php echo "./order_reports.php?page=".($Page_check);?>" class="button adr-save">»</a></li></ul></div>
																		<div class="col-sm-6 infoBar"style="margin-top:24px">
																		<div class="infos"><p align="right" style="    margin-right: -px;"><span adr_trans="label_showing">Showing</span> <?php  if(($start_no_users+1)<0){ echo "0";}else{ echo $start_no_users+1;}?><span adr_trans="label_to"> to</span> <?php if($cnt<0){ echo "0";}else{ echo $cnt;} ?> of <?php echo $total_no; ?><span adr_trans="label_entries"> entries</span></p></div>
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
