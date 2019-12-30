<?php

	$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
	mysqli_set_charset($conn, 'utf8');
	if(isset($_POST['day1'])){
		$day = $_POST['day'];
		$day1 = $_POST['day1'];
		$d1 =  'AND date(orders.OR_CREATEDDATE) <=' .$day1;
		$sql = "SELECT DISTINCT * FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id INNER JOIN users ON users.u_id = orders.u_id  WHERE date(orders.OR_CREATEDDATE) BETWEEN '".$day."' AND '".$day1."'";
		$query = mysqli_query($conn,$sql);
		
		$i = 1;
		while ($row = mysqli_fetch_assoc($query)) {
			echo "<tr>";
			echo "<td>".$row['OR_ID']."</td>";
			echo "<td>".$row['CUS_FULLNAME']."</td>";
			echo "<td>".$row['U_FULLNAME']."</td>";
			/*$date=date_create($row['OR_CREATEDDATE']);			
			echo "<td>".date_format($date,"s:i:H - d/m/Y")."</td>";*/
			echo "<td>".$row['OR_CREATEDDATE']."</td>";
			echo "<td align='right'>".number_format($row['or_totalprice'])." VND</td>";
			echo "</tr>";
			$to = $i++;

			$total_price +=$row['or_totalprice'];
			
		}
				echo "<tr>";
				echo "<td colspan='4' align='right'> Total Orders from " .$day." to ".$day1."</td>";
				echo "<td  align='right'>".$to." orders</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td colspan='4' align='right'> Total Price in " .$day." to ".$day1."</td>";
				echo "<td  align='right'>".number_format($total_price)." VND</td>";
				echo "</tr>";

	}



?>