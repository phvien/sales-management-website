<?php
	include_once("../session.php");
	include_once("users.php");
	$id=$_SESSION['u_id'];
	$loginname=$_SESSION['u_loginname'];
	if (isset($_POST['changepassword']))
	{
		$passwordold=md5($_POST['passwordold']);
		$passwordnew=$_POST['passwordnew'];
		$passwordnewagain=$_POST['passwordnewagain'];
		$r1=logininfor_true($loginname, $passwordold);
		if ($r1)
		{
			if ($passwordnew==$passwordnewagain)
			{
				$r2=change_password($id, $passwordnew);
				if ($r2)
				{
					add_password_change_history($loginname, $_SESSION['u_loginname']);
					echo "<script>alert('Change password successfully!')</script>";
					session_destroy();
					echo "<script>window.location='../users/login.php';</script>";
				}
				else
				{
					echo "<script>alert('Change password failed!')</script>";
				}
			}
			else
			{
				echo "<script>alert('New password again is incorrect!')</script>";
			}
		}
		else
		{
			echo "<script>alert('Old password is incorrect!')</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>Personal Password Editing</title>
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
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					      				<tr>
					      					<td>Old Password</td>
					      					<td>
					      						<input type="password" class="form-control" name="passwordold" maxlength="20" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>New Password</td>
					      					<td>
					      						<input type="password" class="form-control" name="passwordnew" maxlength="20" required>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>New Password again</td>
					      					<td>
					      						<input type="password" class="form-control" name="passwordnewagain" maxlength="20" required>
					      					</td>
					      				</tr>
      								</table>
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