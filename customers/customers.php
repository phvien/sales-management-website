<?php
	include_once("../database.php");

	function get_all_customers()
	{
		global $conn;
		connect_db();
		$sql="select cus_id, cus_fullname, cus_email, cus_phone, cus_gender from customers";
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

	function get_customer($id)
	{
		global $conn;
		connect_db();
		$sql = "select cus_id, cus_fullname, cus_gender, cus_email, cus_phone, cus_address, cus_birthday from customers where cus_id=$id";
		$query = mysqli_query($conn, $sql);
		$result = array();
		if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function edit_customer($id, $fullname, $gender, $email, $phone, $address, $birthday)
	{
		global $conn;
		connect_db();
		$sql="
			update customers set
			cus_fullname='$fullname',
			cus_gender='$gender',
			cus_email='$email',
			cus_phone='$phone',
			cus_address='$address',
			cus_birthday='$birthday'
			where cus_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function add_customer($fullname, $gender, $email, $phone, $address, $birthday)
	{
		global $conn;
		connect_db();
		$sql="insert into customers (cus_fullname, cus_gender, cus_email, cus_phone, cus_address, cus_birthday)
						values ('$fullname', '$gender', '$email', '$phone', '$address', '$birthday')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function delete_customer($id)
	{
		global $conn;
		connect_db();
		$sql="delete from customers where cus_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

?>