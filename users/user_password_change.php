<?php
	include_once("../session.php");
	include_once("adminsession.php");
	include_once("users.php");
	if (isset($_POST['changepassword']))
	{
		$id=$_POST['id'];
		$loginname=$_POST['loginname'];	
		$password=$_POST['password'];
		$r=change_password($id, $password);
		if ($r)
		{
			add_password_change_history($loginname, $_SESSION['u_loginname']);
			echo "<script>alert('Change password successfully!')</script>";
		}
		else
		{
			echo "<script>alert('Change password failed!')</script>";
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
	<title>User Password Editing</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Change Password</h1>
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
						      					<input type="text" class="form-control" name="fullname" value="<?php echo $user['u_fullname']; ?>" maxlength="50" required readonly>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Login name</td>
					      					<td>
					      						<input type="text" class="form-control" name="loginname" value="<?php echo $user['u_loginname']; ?>" readonly>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Password</td>
					      					<td>
					      						<input type="password" class="form-control" name="password" maxlength="20" required>
					      					</td>
					      				</tr>
      								</table>
      								<!-- <button style="float: right;" class="btn btn-secondary" onclick="window.history.back();">Cancel</button> -->
      								<a href="user_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="changepassword" value="Change">
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