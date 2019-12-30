<?php
	include_once("../database.php");

	function user_exist($username, $password)
  	{
    	global $conn;
    	connect_db();
    	$sql="select * from users where u_loginname='$username' and u_password='$password'";
    	$query=mysqli_query($conn, $sql);
    	if (mysqli_num_rows($query)==0)
    	{
      	return false;
    	}
    	else
    	{
      	return true;
    	}
	}

	function get_all_order()
	{
		global $conn;
		global $total_price;
		connect_db();
		$date = getdate();
		//$sql = "SELECT * ,sum(`orderdetails`.`OD_PRICE`) as TONG FROM `orders`, customers, users, orderdetails where orders.cus_id = customers.cus_id and orders.u_id = users.u_id and orderdetails.or_id = orders.or_id and MONTH(orders.OR_CREATEDDATE) = month(now()) and YEAR(orders.OR_CREATEDDATE) = year(now()) group by orders.or_id";
		$sql="SELECT DISTINCT * FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id INNER JOIN users ON users.u_id = orders.u_id  WHERE MONTH(orders.OR_CREATEDDATE) = MONTH(now()) AND YEAR(orders.OR_CREATEDDATE) = YEAR(now())  ";
		
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

	function get_products_now()
	{
		global $conn;
		connect_db();
		$date = getdate();
		
		$sql = "SELECT DISTINCT products.PRO_ID, products.PRO_NAME, SUM(orderdetails.OD_QUANTITY) as TOTAL, SUM(products.PRO_PRICE) AS TOTAL_PRICE FROM products,`orderdetails`, orders WHERE orderdetails.`PRO_ID` = products.`PRO_ID` and orders.or_id = orderdetails.or_id and month(orders.or_createddate) = month(now()) and year(orders.or_createddate) = year(now()) GROUP BY products.PRO_ID";
		// $sql="SELECT DISTINCT * FROM products,`orderdetails`, orders WHERE orderdetails.`PRO_ID` = products.`PRO_ID` and orders.or_id = orderdetails.or_id and month(orders.or_createddate) = month(now()) and year(orders.or_createddate) = year(now()) ";
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

	function get_customers_now()
	{
		global $conn;
		connect_db();
		$date = getdate();
		
		$sql = "SELECT DISTINCT customers.CUS_ID, customers.CUS_FULLNAME, COUNT(customers.CUS_ID) as TOTAL_ORDERS, SUM(orders.or_totalprice) AS TOTAL_PRICE FROM customers, orders WHERE orders.cus_id = customers.cus_id and date(orders.OR_CREATEDDATE) = date(now()) GROUP BY customers.cus_id ";
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