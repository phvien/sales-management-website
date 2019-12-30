<?php
	include_once("../session.php");
	include_once("categories.php");
	if (isset($_POST['editcategory']))
	{
		$id=$_POST['id'];
		$description=$_POST['description'];
		$name=$_POST['name'];
		$r1=category_exist($id, $name);
		if ($r1)
		{
			echo "<script>alert('Category exists!')</script>";
			echo "<script>window.history.back();</script>";
		}
		else
		{
			$r2=edit_category($id, $name, $description);
			if ($r2)
			{
				echo "<script>alert('Edit category information successfully!')</script>";
			}
			else
			{
				echo "<script>alert('Edit category information failed!')</script>";
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
	<title>Category Editing</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Category Information</h1>
      				<!-- Form Infor Category -->
      				<?php
      					$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
      					if ($id)
      					{
    						$category = get_category($id);
    						disconnect_db();
						}

      					if (!$category)
      					{
   							echo "<script>window.location='category_list.php';</script>";
						}
      				?>
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      									<tr>
				      						<!-- <td>ID</td> -->
				      						<!-- <td> -->
				      							<input type="hidden" class="form-control" readonly="readonly" name="id" value="<?php echo $category['ca_id']; ?>">
				      						<!-- </td> -->
		      							</tr>
					      				<tr>
						      				<td>Name</td>
						      				<td>
						      					<input type="text" class="form-control" name="name" value="<?php echo $category['ca_name']; ?>" maxlength="50" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Description</td>
					      					<td>
					      						<textarea class="form-control" rows="3" name="description"><?php echo $category['ca_description']; ?></textarea>
					      					</td>
					      				</tr>
      								</table>
      								<a href="category_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="editcategory" value="Edit">
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