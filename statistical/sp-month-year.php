<?php

	$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
	mysqli_set_charset($conn, 'utf8');
	global $total_price;
	if(isset($_POST['year'])){
		$year = $_POST['year'];
		$month = $_POST['month'];
		if ($month == 'allmonth') {
			$scpt = ''; 
		}else{
			$scpt =  'AND  MONTH(orders.OR_CREATEDDATE) = '.$month;
		}
		$sql = "SELECT DISTINCT products.PRO_ID, products.PRO_NAME, SUM(orderdetails.OD_QUANTITY) as TOTAL, SUM(products.PRO_PRICE) AS TOTAL_PRICE FROM products,`orderdetails`, orders WHERE orderdetails.`PRO_ID` = products.`PRO_ID` and orders.or_id = orderdetails.or_id and YEAR(orders.OR_CREATEDDATE) = '".$year."' $scpt GROUP BY products.PRO_ID ";
		// $sql = "SELECT * FROM orderdetails INNER JOIN orders ON orderdetails.OR_ID = orders.OR_ID INNER JOIN users ON users.U_ID = orders.U_ID INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID WHERE YEAR(orders.OR_CREATEDDATE) = '".$year."' $scpt" ;
		$query = mysqli_query($conn,$sql);
		
				while ($row = mysqli_fetch_assoc($query)) {
			echo "<tr>";
			echo "<td>".$row['PRO_ID']."</td>";
			echo "<td>".$row['PRO_NAME']."</td>";
			echo "<td align='right'>".$row['TOTAL']."</td>";	
			echo "<td align='right'>".number_format($row['TOTAL_PRICE'])." VNĐ</td>";		
			echo "</tr>";
			
			 
			}	

				

	}

?>