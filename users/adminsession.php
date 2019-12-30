<?php
	if ($_SESSION['r_id']!=1)
	{
		session_destroy();
		echo "<script>window.location='../users/login.php';</script>";
	}
?>