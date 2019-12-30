<?php
	include_once("../session.php");
	include_once("products.php");
	if (isset($_POST['addproduct']))
	{
		$name=$_POST['name'];
		$price=$_POST['price'];
		$ca_id=$_POST['category'];
		$pr_id=$_POST['producer'];
		$detail=$_POST['detail'];
		$r1=product_exist(0, $name);
		if ($r1)
		{
			echo "<script>alert('Product exists!')</script>";
			echo "<script>window.history.back();</script>";
		}
		else
		{
			$r2=add_product($name, $price, $ca_id, $pr_id, $detail);
			if ($r2)
			{			
				echo "<script>alert('Add product successfully!')</script>";			
			}
			else
			{
				echo "<script>alert('Add product failed!')</script>";
				echo "<script>window.history.back();</script>";
			}
		}
		disconnect_db();
		echo "<script>window.location='product_list.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>Product Addition</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Add Product</h1>
      				<!-- Form Add Product -->
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					      				<tr>
						      				<td>Name</td>
						      				<td>
						      					<input type="text" class="form-control" name="name" maxlength="100" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Price</td>
					      					<td>
					      						<input type="number" class="form-control" name="price" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Category</td>
					      					<td>
					      						<select class="form-control" name="category">
					      							<?php
					      								include_once("../categories/categories.php");
					      								$categories=get_all_categories();
					      								foreach ($categories as $category)
					      								{
					      									echo "<option value='" .$category['ca_id']. "'>" .$category['ca_name']. "</option>";
					      								}
					      							?>
					      						</select>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Producer</td>
					      					<td>
					      						<select class="form-control" name="producer">
					      							<?php
					      								include_once("../producers/producers.php");
					      								$producers=get_all_producers();
					      								foreach ($producers as $producer)
					      								{
					      									echo "<option value='" .$producer['pr_id']. "'>" .$producer['pr_name']. "</option>";
					      								}
					      							?>
					      						</select>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Detail</td>
					      					<td>
					      						<textarea class="form-control" name="detail"></textarea>
					      					</td>
					      				</tr>
      								</table>
      								<a href="product_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="addproduct" value="Add">
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