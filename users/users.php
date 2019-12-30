<?php
	include_once("../database.php");

	function logininfor_true($loginname, $password)
  	{
    	global $conn;
    	connect_db();

    	// Chống SQL Injection
    	$loginname=addslashes($loginname);
    	$password=$password;
    	$sql="select u_id, u_fullname, u_loginname, roles.r_id, roles.r_name from users, roles where users.r_id=roles.r_id and u_loginname='$loginname' and u_password='$password'";
    	$query=mysqli_query($conn, $sql);
    	$result = array();
    	if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function loginname_exist($loginname)
  	{
    	global $conn;
    	connect_db();

    	// Chống SQL Injection
    	$loginname=addslashes($loginname);
    	$sql="select u_id, u_fullname, u_loginname, roles.r_id, roles.r_name from users, roles where users.r_id=roles.r_id and u_loginname='$loginname'";
    	$query=mysqli_query($conn, $sql);
    	$result = array();
    	if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function get_all_users()
	{
		global $conn;
		connect_db();
		$sql="select u_id, u_fullname, u_email, u_phone, u_address, u_hometown, u_loginname, u_gender, users.r_id,r_name from users, roles where users.r_id = roles.r_id";
		$query=mysqli_query($conn, $sql);
		$result=array();
		if ($query)
		{
			while ($row=mysqli_fetch_assoc($query))
			{
				$result[]=$row;
			}
		}
		return $result;
	}

	function get_all_roles()
	{
		global $conn;
		connect_db();
		$sql="select r_id, r_name from roles";
		$query=mysqli_query($conn, $sql);
		$result=array();
		if ($query)
		{
			while ($row=mysqli_fetch_assoc($query))
			{
				$result[]=$row;
			}
		}
		return $result;
	}

	function get_user($id)
	{
		global $conn;
		connect_db();
		$sql = "select u_id, u_fullname, u_gender, u_email, u_phone, u_address, u_hometown, u_loginname, u_birthday, r_id from users where u_id=$id";
		$query = mysqli_query($conn, $sql);
		$result = array();
		if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function edit_user($id, $fullname, $gender, $email, $phone, $address, $hometown, $birthday, $role)
	{
		global $conn;
		connect_db();
		$fullname=addslashes($fullname);
		$gender=addslashes($gender);
		$email=addslashes($email);
		$phone=addslashes($phone);
		$address=addslashes($address);
		$hometown=addslashes($hometown);
		$role=addslashes($role);
		$sql="
			update users set
			u_fullname='$fullname',
			u_gender='$gender',
			u_email='$email',
			u_phone='$phone',
			u_address='$address',
			u_hometown='$hometown',
			u_birthday='$birthday',
			r_id=$role
			where u_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function edit_myself($id, $fullname, $gender, $email, $phone, $address, $hometown, $birthday)
	{
		global $conn;
		connect_db();
		$sql="
			update users set
			u_fullname='$fullname',
			u_gender='$gender',
			u_email='$email',
			u_phone='$phone',
			u_address='$address',
			u_hometown='$hometown',
			u_birthday='$birthday'
			where u_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function add_user($fullname, $gender, $email, $phone, $address, $hometown, $birthday, $loginname, $password, $role)
	{
		global $conn;
		connect_db();
		$sql="insert into users (u_fullname, u_gender, u_email, u_phone, u_address, u_hometown, u_birthday, u_loginname, u_password, r_id)
						values ('$fullname', '$gender', '$email', '$phone', '$address', '$hometown', '$birthday', '$loginname', '$password', $role)";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function delete_user($id)
	{
		global $conn;
		connect_db();
		$sql="delete from users where u_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function add_password_change_history($user_is_changed, $user_changed)
	{
		global $conn;
		connect_db();
		$sql="insert into password_change_history (user_is_changed, user_changed, change_at) values ('$user_is_changed', '$user_changed', now())";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function change_password($id, $password)
	{
		global $conn;
		connect_db();
		$password=md5($password);
		$sql="update users set u_password='$password' where u_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function get_password_change_history()
	{
		global $conn;
		connect_db();
		$sql="select id, user_is_changed, user_changed, change_at from password_change_history";
		$query=mysqli_query($conn, $sql);
		$result=array();
		if ($query)
		{
			while ($row=mysqli_fetch_assoc($query))
			{
				$result[]=$row;
			}
		}
		return $result;
	}

?>