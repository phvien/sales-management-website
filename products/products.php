<?php
	include_once("../session.php");
	include_once("../database.php");
	function get_all_products()
	{
		global $conn;
		connect_db();
		$sql="select pro_id, pro_name, pro_price, pro_quantity, ca_name, pr_name from products, categories, producers where products.ca_id=categories.ca_id and products.pr_id=producers.pr_id";
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

	function delete_product($id)
	{
		global $conn;
		connect_db();
		$sql="delete from products where pro_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function product_exist($id, $name)
	{
		global $conn;
    	connect_db();
    	$sql="select * from products where pro_name='$name' and not pro_id=$id";
    	$query=mysqli_query($conn, $sql);
    	$result = array();
    	if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function add_product($name, $price, $ca_id, $pr_id, $detail)
	{
		global $conn;
		connect_db();
		$sql="insert into products (pro_name, pro_price, ca_id, pr_id, pro_detail, pro_quantity)
						values ('$name', $price, $ca_id, $pr_id, '$detail', 0)";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function edit_product($id, $name, $price, $ca_id, $pr_id, $detail)
	{
		global $conn;
		connect_db();
		$sql="
			update products set
			pro_name='$name',
			pro_price=$price,
			ca_id=$ca_id,
			pr_id=$pr_id,
			pro_detail='$detail'
			where pro_id=$id
		";
		$query = mysqli_query($conn, $sql);
		return $query;
	}

	function get_product($id)
	{
		global $conn;
		connect_db();
		$sql = "select pro_id, pro_name, pro_price, pro_quantity, ca_id, pr_id, pro_detail from products where pro_id=$id";
		$query = mysqli_query($conn, $sql);
		$result = array();
		if (mysqli_num_rows($query) > 0)
		{
        	$row = mysqli_fetch_assoc($query);
        	$result = $row;
    	}
    	return $result;
	}

	function add_quantity($id, $quantity)
	{
		global $conn;
		connect_db();
		$sql="update products set pro_quantity=pro_quantity+$quantity where pro_id=$id";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
?>