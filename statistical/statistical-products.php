<?php
	include_once('../session.php');
?>
<!DOCTYPE html>
<html lang="vi">
 
<head>
<link rel="shortcut icon" type="image/png" href="./imgs/statistics-market-icon.png" />  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script language="javascript" src="jquery-3.4.0.js"></script>

	<?php
		include_once("../layout/meta_link.php");
	?>
	<!-- Custom styles for this page -->
	<?php
		include_once("../layout/cssdatatables.php")
	?>
	<title>Statistical Product</title>
</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../layout/sidebar.php");
		?>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
					<div id="content">
						<!-- Topbar -->
						<?php
							include_once("../layout/topbar.php");
						?>
						<!-- End of Topbar -->
						<!-- Begin Page Content -->
						<?php
							include("statistical.php");
						$statistical = get_products_now();
							disconnect_db();
						?>
						
						<br>
						<!-- DataTales Users -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Order List</h6>
							</div>
							<div class="card-body">
											<div class="col-sm-6 col-md-6">
											<div class="dataTables_length" id="dataTable_length">
							<?php
					$sql="SELECT * FROM ORDERS WHERE OR_CREATEDDATE >= CURDATE() AND OR_CREATEDDATE < CURDATE() + INTERVAL 1 DAY";
							?>
					<a onclick="myFunction()"  ><i class="fas fa-chevron-down"></i>  Products From Day To Day </a>
									<div id="myDIV">
												<label> From <input type="date" name="dataTable_length" aria-controls="dataTable"
																class="custom-input custom-input-sm form-control form-control-sm" id="getday">                                
												</label>
												<label> To <input type="date" name="dataTable_length" aria-controls="dataTable"
																class="custom-input custom-input-sm form-control form-control-sm" id="getday1" value="<?php echo date('Y-m-d'); ?>">                                
												</label>
												<br>
						                        <label> Products sold today <input type="submit" name="dataTable_length" aria-controls="dataTable"
						                                class="custom-input custom-input-sm form-control form-control-sm" id="gettoday" value="From Today">                                
						                        </label>
									 </div>
												<br>


												<label>Month <select name="dataTable_length" aria-controls="dataTable"
                            class="custom-select custom-select-sm form-control form-control-sm" id="getmonth">
									<option value="allmonth"> All months</option>
                            <?php for( $m=1; $m<=12; ++$m ) { 
                                    $month_label = date('F', mktime(0, 0, 0, $m, 1));
                                    ?>
                                    <option value="<?php echo +$m; ?>" <?php if ($m==date('m')) echo 'selected'; ?>><?php echo $month_label; ?></option>
                                    <?php } ?>
                          </select>
                          
                         <div id="result">
                         	
                         </div>
                          
                        </label>
												
												<label>Year <select name="dataTable_length" aria-controls="dataTable"
														class="custom-select custom-select-sm form-control form-control-sm" id="getyear">
															
														<?php 
																$year = date('Y');
																$min = $year - 60;
																$max = $year;
																for( $i=$max; $i>=$min; $i-- ) {
																		echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
													</select> 
												</label>
											</div>

										</div>
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
														<tr>
																<th>Product ID</th>
																<th>Product Name</th>
																<th>Total Quantity</th>
																<th>Total Price</th>
														</tr>
												</thead>
												
												<tbody id="ajax-clear">

													<?php
														foreach ($statistical as $statistical)
														{
													?>
													<tr>
														<td><?php echo $statistical['PRO_ID']; ?></td>
														<td><?php echo $statistical['PRO_NAME']; ?></td>
														<td align="right"><?php echo $statistical['TOTAL']; ?></td>
														<td align="right"><?php echo number_format($statistical['TOTAL_PRICE'])."&nbspVNĐ"; ?></td>
														
													</tr>
													<?php
														}
													?>
													
												</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- End of Page Content -->
					</div>
					<!-- End of Main Content -->
					<!-- Footer -->
					<?php
						include_once("../layout/footer.php");
					?>
					<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<?php
		include_once("../layout/topbutton.php");
	?>
	<!-- Logout Modal-->
	<?php
		include_once("../layout/logout.php");
	?>
	<?php
		include_once("../layout/script.php");
	?>
	<!-- Page level -->
	<?php
		include_once("../layout/scriptdatatables.php");
	?>
</body>
</html>
<script type="text/javascript">
	$( "#getday" ).change(function() {
		var getday = $('#getday').val();
		var getday1 = $('#getday1').val();
			$.ajax({
						url : "sp-date.php",
						type : "post",
						dataType:"text",
						data : {
								day : $('#getday').val(),
								day1 : $('#getday1').val()
						},
						success : function (result){
								if (result != "") {
									$('#ajax-clear').html(result);
								}
								else{
									$("#ajax-clear").html("<tr><td colspan='5'><h5 style='text-align:center;'>No data</h5></td></tr>")
								}
						}
				});
	});
	$( "#getday1" ).change(function() {
		var getday = $('#getday').val();
		var getday1 = $('#getday1').val();
			$.ajax({
						url : "sp-date.php",
						type : "post",
						dataType:"text",
						data : {
								day : $('#getday').val(),
								day1 : $('#getday1').val()
						},
						success : function (result){
								if (result != "") {
									$('#ajax-clear').html(result);
								}
								else{
									$("#ajax-clear").html("<tr><td colspan='5'><h5 style='text-align:center;'>No data</h5></td></tr>")
								}
						}
				});
	});
	$( "#getyear" ).change(function() {
			 
			$.ajax({
						url : "sp-month-year.php",
						type : "post",
						dataType:"text",
						data : {
								year : $('#getyear').val(),
								month : $('#getmonth').val()
						},
						success : function (result){
							if (result != "") {
									$('#ajax-clear').html(result);
								}
								else{
									$("#ajax-clear").html("<tr><td colspan='5'><h5 style='text-align:center;'>No data </h5></td></tr>")
								}
						}
				});
	});
		$( "#getmonth" ).change(function() {
			 
			$.ajax({
						url : "sp-month-year.php",
						type : "post",
						dataType:"text",
						data : {
								year : $('#getyear').val(),
								month : $('#getmonth').val()
						},
						success : function (result){
							if (result != "") {
									$('#ajax-clear').html(result);
								}
								else{
									$("#ajax-clear").html("<tr><td colspan='5'><h5 style='text-align:center;'>No data </h5></td></tr>")
								}
						}
				});
	});
$( "#gettoday" ).click(function() {
      today = new Date();
      var dayday = today.getDate();
      $.ajax({
            url : "sp-today.php",
            type : "post",
            dataType:"text",
            data : {
                day : dayday
            },
            success : function (result){
              if (result != "") {
                  $('#ajax-clear').html(result);
                }
                else{
                  $("#ajax-clear").html("<tr><td colspan='5'><h5 style='text-align:center;'>No data </h5></td></tr>")
                }
            }
        });
  });

</script>
<script>
function myFunction() {
	var x = document.getElementById("myDIV");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}
</script>