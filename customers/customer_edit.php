<?php
	include_once("../session.php");
	include_once("customers.php");
	if (isset($_POST['editcustomer']))
	{
		$id=$_POST['id'];
		$gender=$_POST['gender'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$birthday=$_POST['birthday'];
		$fullname=$_POST['fullname'];
		$phone=$_POST['phone'];
		$r=edit_customer($id, $fullname, $gender, $email, $phone, $address, $birthday);
		if ($r)
		{
			echo "<script>alert('Edit customer information successfully!')</script>";
		}
		else
		{
			echo "<script>alert('Edit customer information failed!')</script>";
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
	<title>Customer Editing</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Customer Information</h1>
      				<!-- Form Infor Customer -->
      				<?php
      					$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
      					if ($id)
      					{
    						$customer = get_customer($id);
    						disconnect_db();
						}
      					if (!$customer)
      					{
   							echo "<script>window.location='customer_list.php';</script>";
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
				      							<input type="hiddens" class="form-control" readonly="readonly" name="id" value="<?php echo $customer['cus_id']; ?>">
				      						<!-- </td> -->
		      							</tr>
					      				<tr>
						      				<td>Full name</td>
						      				<td>
						      					<input type="text" class="form-control" name="fullname" value="<?php echo $customer['cus_fullname']; ?>" maxlength="50" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Gender</td>
					      					<td>
					      						<!-- <select class="form-control" name="gender">
			                            			<option value="Nam">Nam</option>
			                            			<option value="Nữ" <?php if ($customer['cus_gender'] == 'Nữ') echo 'selected'; ?> >Nữ</option>
			                        			</select> -->
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nam" <?php if ($customer['cus_gender'] == 'Nam') echo 'checked' ?>>Nam&emsp;</label>
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nữ" <?php if ($customer['cus_gender'] == 'Nữ') echo 'checked' ?>>Nữ&emsp;</label>
			                    			</td>
					      				</tr>
					      				<tr>
					      					<td>Phone</td>
					      					<td>
					      						<input type="text" class="form-control" name="phone" value="<?php echo $customer['cus_phone']; ?>" pattern="[0-9]{10,11}" title="Số điện thoại gồm 10 hoặc 11 chữ số!" required>
					      					</td>
					      				</tr>		      				
					      				<tr>
					      					<td>Email</td>
					      					<td>
					      						<input type="email" class="form-control" name="email" value="<?php echo $customer['cus_email']; ?>" maxlength="50">
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday" value="<?php echo $customer['cus_birthday']; ?>">
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address" value="<?php echo $customer['cus_address']; ?>" >
					      					</td>
					      				</tr>
      								</table>
      								<a href="customer_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="editcustomer" value="Edit">
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