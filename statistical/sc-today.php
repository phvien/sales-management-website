<?php
$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
	mysqli_set_charset($conn, 'utf8');
if(isset($_POST['day'])){
		$today = $_POST['day'];
		
		$sql = "SELECT DISTINCT customers.CUS_ID, customers.CUS_FULLNAME, COUNT(customers.CUS_ID) as TOTAL_ORDERS, SUM(orders.or_totalprice) AS TOTAL_PRICE FROM customers, orders WHERE orders.cus_id = customers.cus_id  and  date(orders.OR_CREATEDDATE)  = date(now()) GROUP BY customers.cus_id ";
		$query = mysqli_query($conn,$sql);
		
		$query = mysqli_query($conn,$sql);
		
		$i = 1;
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