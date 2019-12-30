<?php
	include_once("../database.php");

	function get_all_producers()
	{
		global $conn;
		connect_db();
		$sql="select pr_id, pr_name from producers";
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

	function get_producer($id)
	{
		global $conn;
		connect_db();
		$sql = "select pr_id, pr_name, pr_description from producers where pr_id=$id";
		$query = mysqli_query($conn, $sql);
		$result = array();
		if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function edit_producer($id, $name, $description)
	{
		global $conn;
		connect_db();
		$sql="
			update producers set
			pr_name='$name',
			pr_description='$description'
			where pr_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function add_producer($name, $description)
	{
		global $conn;
		connect_db();
		$sql="insert into producers (pr_name, pr_description)
						values ('$name', '$description')";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function delete_producer($id)
	{
		global $conn;
		connect_db();
		$sql="delete from producers where pr_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function producer_exist($id, $name)
	{
		global $conn;
    	connect_db();
    	$sql="select * from producers where pr_name='$name' and not pr_id=$id";
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