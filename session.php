<?php
	session_start();
	if (!isset($_SESSION['u_loginname']))		
	{
		echo "<script>window.location='../users/login.php';</script>";
	}
?>