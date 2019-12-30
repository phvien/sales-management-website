<?php
    include_once("../session.php");
    include_once("adminsession.php");
	include_once("users.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
        $user=get_user($id);
    	$r=delete_user($id);
    	if ($r)
    	{
            add_password_change_history($user['u_loginname'], $_SESSION['u_loginname']);
    		echo "<script>alert('Delete user {$user['u_fullname']} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('User {$user['u_fullname']} cannot be deleted because there is a order in this user!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='user_list.php';</script>";
?>