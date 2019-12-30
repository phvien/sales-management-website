<?php
	include_once("../session.php");
	include_once("customers.php");
	if (isset($_POST['addcustomer']))
	{
		$gender=$_POST['gender'];
		$birthday=$_POST['birthday'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$fullname=$_POST['fullname'];
		$phone=$_POST['phone'];
		$r=add_customer($fullname, $gender, $email, $phone, $address, $birthday);
		if ($r)
		{
			echo "<script>alert('Add customer successfully!')</script>";
		}
		else
		{
			echo "<script>alert('Add customer failed!')</script>";
			echo "<script>window.history.back();</script>";
		}
		disconnect_db();	
		echo "<script>window.location='customer_list.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>Customer Addition</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Add Customer</h1>
      				<!-- Form Add Customer -->
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					      				<tr>
						      				<td>Full name</td>
						      				<td>
						      					<input type="text" class="form-control" name="fullname" maxlength="50" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Gender</td>
					      					<td>
					      						<!-- <select class="form-control" name="gender">
			                            			<option value="Nam">Nam</option>
			                            			<option value="Nữ">Nữ</option>
			                        			</select> -->
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nam" checked>Nam&emsp;</label>
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nữ">Nữ&emsp;</label>
			                    			</td>
					      				</tr>
					      				<tr>
					      					<td>Phone</td>
					      					<td>
					      						<input type="text" class="form-control" name="phone" pattern="[0-9]{10,11}" title="Số điện thoại gồm 10 hoặc 11 chữ số!" required>
					      					</td>
					      				</tr>					      									      				
					      				<tr>
					      					<td>Email</td>
					      					<td>
					      						<input type="email" class="form-control" name="email" maxlength="50">
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday">
					      					</td>
					      				</tr>				      				
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address">
					      					</td>
					      				</tr>				      				
      								</table>
      								<a href="customer_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="addcustomer" value="Add">
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