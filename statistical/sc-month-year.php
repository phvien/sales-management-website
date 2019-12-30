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
		$sql = "SELECT DISTINCT customers.CUS_ID, customers.CUS_FULLNAME, COUNT(customers.CUS_ID) as TOTAL_ORDERS, SUM(orders.or_totalprice) AS TOTAL_PRICE FROM customers, orders WHERE orders.cus_id = customers.cus_id AND YEAR(orders.OR_CREATEDDATE) = '".$year."' $scpt GROUP BY customers.cus_id" ;
		$query = mysqli_query($conn,$sql);
		$i = 1;
		// echo $sql;
				while ($row = mysqli_fetch_assoc($query)) {
			echo "<tr>";
			echo "<td>".$row['CUS_ID']."</td>";
			echo "<td>".$row['CUS_FULLNAME']."</td>";
			echo "<td align='right'>".$row['TOTAL_ORDERS']."</td>";
			echo "<td align='right'>".number_format($row['TOTAL_PRICE'])	." VNĐ"."</td>";			
			echo "</tr>";

				}	

	}

?>