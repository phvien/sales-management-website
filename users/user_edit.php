<?php
	include_once("../session.php");
	include_once("adminsession.php");
	include_once("users.php");
	if (isset($_POST['edituser']))
	{
		$id=$_POST['id'];
		$gender=$_POST['gender'];
		$birthday=$_POST['birthday'];
		$role=$_POST['role'];		
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$hometown=$_POST['hometown'];
		$r=edit_user($id, $fullname, $gender, $email, $phone, $address, $hometown, $birthday, $role);
		if ($r)
		{
			echo "<script>alert('Edit user information successfully!')</script>";
		}
		else
		{
			echo "<script>alert('Edit user information failed!')</script>";
			echo "<script>window.history.back();</script>";
		}	
		disconnect_db();
		echo "<script>window.location='user_list.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>User Editing</title>
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
      				<h1 class="h3 mb-2 text-gray-800">User Information</h1>
      				<!-- Form Infor User -->
      				<?php
      					$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
      					if ($id)
      					{
    						$user = get_user($id);
    						disconnect_db();
						}
      					if (!$user)
      					{
   							echo "<script>window.location='user_list.php';</script>";
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
				      							<input type="hidden" class="form-control" readonly="readonly" name="id" value="<?php echo $user['u_id']; ?>">
				      						<!-- </td> -->
		      							</tr>
					      				<tr>
						      				<td>Full name</td>
						      				<td>
						      					<input type="text" class="form-control" name="fullname" value="<?php echo $user['u_fullname']; ?>" maxlength="50" required>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Gender</td>
					      					<td>
					      						<!-- <select class="form-control" name="gender">
			                            			<option value="Nam">Nam</option>
			                            			<option value="Nữ" <?php if ($user['u_gender'] == 'Nữ') echo 'selected'; ?> >Nữ</option>
			                        			</select> -->
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nam" <?php if ($user['u_gender'] == 'Nam') echo 'checked' ?>>Nam&emsp;</label>
			                        			<label class="radio-inline"><input type="radio" name="gender" value="Nữ" <?php if ($user['u_gender'] == 'Nữ') echo 'checked' ?>>Nữ&emsp;</label>
			                    			</td>
					      				</tr>
					      				<tr>
					      					<td>Phone</td>
					      					<td>
					      						<input type="text" class="form-control" name="phone" value="<?php echo $user['u_phone']; ?>" pattern="[0-9]{10,11}" title="Số điện thoại gồm 10 hoặc 11 chữ số!" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Email</td>
					      					<td>
					      						<input type="email" class="form-control" name="email" value="<?php echo $user['u_email']; ?>" maxlength="50" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday" value="<?php echo $user['u_birthday']; ?>" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address" value="<?php echo $user['u_address']; ?>" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Hometown</td>
					      					<td>
					      						<input type="text" class="form-control" name="hometown" value="<?php echo $user['u_hometown']; ?>" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Login name</td>
					      					<td>
					      						<input type="text" class="form-control" name="loginname" value="<?php echo $user['u_loginname']; ?>" readonly>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Role</td>
					      					<td>
					      						<!-- <select class="form-control" name="role">
					      							<option value="1">Quản trị viên</option>
			                            			<option value="2" <?php if ($user['r_id'] == 2) echo 'selected'; ?> >Nhân viên</option>
			                        			</select> -->
			                        			<label class="radio-inline"><input type="radio" name="role" value="1" <?php if ($user['r_id'] == '1') echo 'checked' ?>>Quản trị viên&emsp;</label>
			                        			<label class="radio-inline"><input type="radio" name="role" value="2" <?php if ($user['r_id'] == '2') echo 'checked' ?>>Nhân viên&emsp;</label>
					      					</td>
					      				</tr>
      								</table>
      								<!-- <button style="float: right;" class="btn btn-secondary" onclick="window.location='user_list.php';">Cancel</button> -->
      								<a href="user_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="edituser" value="Edit">
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