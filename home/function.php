<?php
 include("config.php");
function danhsachsanpham($conn){
		$sql= "SELECT products.PRO_ID ,products.PRO_NAME, products.PRO_DETAIL, products.PRO_PRICE, products.PRO_QUANTITY, producers.PR_NAME, categories.CA_NAME FROM products,producers,categories where producers.PR_ID = products.PR_ID and products.CA_ID = categories.CA_ID";
		return mysqli_query($conn,$sql);
	}
function xoasp($conn,$idsp){
		$sql = "DELETE FROM products WHERE PRO_ID = $idsp";	
		$conn->query($sql);
	}
function getLoaiSanPham($conn){
		$sql = "SELECT * FROM categories";
		return mysqli_query($conn, $sql);
	}
function getNSX($conn){
		$sql = "SELECT * FROM producers";
		return mysqli_query($conn, $sql);
	}
function getSanPhamTheoID($conn, $idsp){
		$sql= "SELECT products.PRO_ID ,products.PRO_NAME, producers.PR_ID,categories.CA_ID, products.PRO_DETAIL, products.PRO_PRICE, products.PRO_QUANTITY, producers.PR_NAME, categories.CA_NAME FROM products,producers,categories where producers.PR_ID = products.PR_ID and products.CA_ID = categories.CA_ID and PRO_ID = $idsp";
		return mysqli_query($conn, $sql);
	}
function countAllProduct($conn){
	$sql = "SELECT COUNT(PRO_ID) as allPro FROM products";
	return mysqli_query($conn, $sql);
}
function countAllProductInventory($conn){
	$sql = "SELECT SUM(PRO_QUANTITY) as allProIn FROM products";
	return mysqli_query($conn, $sql);
}
function revenueByMonth($conn){
	// $sql = "SELECT orders.OR_ID, orderdetails.OD_QUANTITY, orderdetails.OD_PRICE, orders.OR_CREATEDDATE from orders,orderdetails where orders.OR_ID = orderdetails.OR_ID and OD_PRICE>=1 and OD_QUANTITY>=1";
	$sql = "select sum(or_totalprice) as tong from orders where MONTH(OR_CREATEDDATE) = MONTH(NOW()) and YEAR(OR_CREATEDDATE) = YEAR(NOW())";

	return mysqli_query($conn, $sql);
	
}
function countAllUser($conn){
	$sql = "SELECT COUNT(U_ID) as allUser FROM users";
	return mysqli_query($conn, $sql);
}
function categories($conn){
	$sql = "SELECT categories.CA_ID,categories.CA_NAME, products.PRO_QUANTITY  from products, categories
	where categories.CA_ID = products.CA_ID";
}
function getProductNow($conn){
	$sql = "SELECT DISTINCT products.PRO_ID, products.PRO_NAME, SUM(orderdetails.OD_QUANTITY) as TOTAL, SUM(products.PRO_PRICE) AS TOTAL_PRICE FROM products,`orderdetails`, orders WHERE orderdetails.`PRO_ID` = products.`PRO_ID` and orders.or_id = orderdetails.or_id and day(orders.or_createddate) = day(now()) and year(orders.or_createddate) = year(now()) GROUP BY products.PRO_ID";
	return mysqli_query($conn, $sql);
}
function getCustomer($conn){
	$sql = "SELECT  customers.CUS_FULLNAME,customers.CUS_ADDRESS, COUNT(OR_ID) as Purchases FROM orders,customers WHERE customers.CUS_ID = orders.CUS_ID GROUP BY customers.CUS_FULLNAME HAVING COUNT(OR_ID) order by Purchases desc ";
	return mysqli_query($conn, $sql);
}
?>
