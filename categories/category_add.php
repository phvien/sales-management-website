<?php
	include_once("../session.php");
	include_once("categories.php");
	if (isset($_POST['addcategory']))
	{
		$name=$_POST['name'];
		$description=$_POST['description'];
		$r1=category_exist(0, $name);
		if ($r1)
		{
			echo "<script>alert('Category exists!')</script>";
			echo "<script>window.history.back();</script>";
		}
		else
		{
			$r2=add_category($name, $description);
			if ($r2)
			{			
				echo "<script>alert('Add category successfully!')</script>";			
			}
			else
			{
				echo "<script>alert('Add category failed!')</script>";
				echo "<script>window.history.back();</script>";
			}
		}
		disconnect_db();
		echo "<script>window.location='category_list.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>Category Addition</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Add Category</h1>
      				<!-- Form Add Category -->
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					      				<tr>
						      				<td>Name</td>
						      				<td>
						      					<input type="text" class="form-control" name="name" maxlength="50" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Description</td>
					      					<td>
					      						<textarea class="form-control" name="description"></textarea>
					      					</td>
					      				</tr>
      								</table>
      								<a href="category_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="addcategory" value="Add">
      							</div>
      						</div>
      					</div>
      				</form>
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
	?>
</body>
</html>