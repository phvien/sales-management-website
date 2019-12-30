<?php
	include_once("../database.php");

	function get_all_categories()
	{
		global $conn;
		connect_db();
		$sql="select ca_id, ca_name from categories";
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

	function get_category($id)
	{
		global $conn;
		connect_db();
		$sql = "select ca_id, ca_name, ca_description from categories where ca_id=$id";
		$query = mysqli_query($conn, $sql);
		$result = array();
		if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function edit_category($id, $name, $description)
	{
		global $conn;
		connect_db();
		$sql="
			update categories set
			ca_name='$name',
			ca_description='$description'
			where ca_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function add_category($name, $description)
	{
		global $conn;
		connect_db();
		$sql="insert into categories (ca_name, ca_description)
						values ('$name', '$description')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function delete_category($id)
	{
		global $conn;
		connect_db();
		$sql="delete from categories where ca_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function category_exist($id, $name)
	{
		global $conn;
    	connect_db();
    	$sql="select * from categories where ca_name='$name' and not ca_id=$id";
    	$query=mysqli_query($conn, $sql);
    	$result = array();
    	if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}
?>