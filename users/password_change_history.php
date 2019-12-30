<?php
	include_once("../session.php");
	include_once("adminsession.php");
	include("users.php");
	$items = get_password_change_history();
    disconnect_db();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<!-- Custom styles for this page -->
	<?php
		include_once("../layout/cssdatatables.php")
	?>
	<title>Password change history</title>
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
      			<div class="container-fluid">
      				<p class="mb-4">When deleting users or changing passwords, the system will automatically record and present here.</p>
                  	<!-- DataTales Password change history -->
      				<div class="card shadow mb-4">
      					<div class="card-header py-3">
      						<h6 class="m-0 font-weight-bold text-primary">Password change history</h6>
      					</div>
      					<div class="card-body">
      						<div class="table-responsive">
      							<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
      								<thead>
			                    		<tr>
				                      		<!-- <th>ID</th> -->
					                      	<th>User is changed</th>
					                      	<th>User changed</th>
					                      	<th>Change at</th>
			                    		</tr>
					                </thead>
					                <tfoot>
					                    <tr>
					                      	<!-- <th>ID</th> -->
					                      	<th>User is change</th>
					                      	<th>User changed</th>
					                      	<th>Change at</th>
				                    	</tr>
					                </tfoot>
					                <tbody>
					                	<?php
					                		foreach ($items as $item)
					                		{
					                	?>
					                	<tr>
					                		<!-- <td><?php echo $item['id']; ?></td> -->
					                		<td><?php echo $item['user_is_changed']; ?></td>
					                		<td><?php echo $item['user_changed']; ?></td>
					                		<td><?php echo $item['change_at']; ?></td>
					                	</tr>
					                	<?php
					                		}
					                	?>
				                	</tbody>
      							</table>
      						</div>
      					</div>
      				</div>
      			</div>
      			<!-- End of Page Content -->
      		</div>
      		<!-- End of Main Content -->

      		<?php
      			// Footer
      			include_once("../layout/footer.php");
      		?>
      		<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->

	<?php
		// Scroll to Top Button
		include_once("../layout/topbutton.php");
		include_once("../layout/script.php");

		// Logout Modal
		include_once("../layout/logout.php");

		// Page level
		include_once("../layout/scriptdatatables.php")
	?>
</body>
</html>