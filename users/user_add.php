<?php
	include_once("../session.php");
	include_once("adminsession.php");
	include_once("users.php");
	if (isset($_POST['adduser']))
	{
		$gender=$_POST['gender'];
		$birthday=$_POST['birthday'];
		$role=$_POST['role'];
		$errors = array();
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$hometown=$_POST['hometown'];
		$loginname=$_POST['loginname'];
		$password=md5($_POST['password']);
		$r1=loginname_exist($loginname);
		if ($r1)
		{
			echo "<script>alert('Login name exists!')</script>";
			echo "<script>window.history.back();</script>";
		}
		else
		{
			$r2=add_user($fullname, $gender, $email, $phone, $address, $hometown, $birthday, $loginname, $password, $role);
			if ($r2)
			{
				echo "<script>alert('Add user successfully!')</script>";
			}
			else
			{
				echo "<script>alert('Add user failed!')</script>";
				echo "<script>window.history.back();</script>";
			}
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
	<title>User Addition</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Add User</h1>
      				<!-- Form Add User -->
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
					      						<input type="email" class="form-control" maxlength="50" name="email" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Hometown</td>
					      					<td>
					      						<input type="text" class="form-control" name="hometown" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Login name</td>
					      					<td>
					      						<input type="text" class="form-control" name="loginname" maxlength="20" pattern="^[a-zA-Z0-9_.-]*$" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Password</td>
					      					<td>
					      						<input type="password" class="form-control" name="password" maxlength="20" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Role</td>
					      					<td>
					      						<!-- <select class="form-control" name="role">
					      							<option value="1">Quản trị viên</option>
			                            			<option value="2">Nhân viên</option>
			                        			</select> -->
			                        			<label class="radio-inline"><input type="radio" name="role" value="1">Quản trị viên&emsp;</label>
			                        			<label class="radio-inline"><input type="radio" name="role" value="2" checked>Nhân viên&emsp;</label>
					      					</td>
					      				</tr>
      								</table>
      								<!-- <button style="float: right;" class="btn btn-secondary" onclick="window.location='user_list.php';">Cancel</button> -->
      								<a href="user_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="adduser" value="Add">
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