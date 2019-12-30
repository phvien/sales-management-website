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
		$sql = "SELECT DISTINCT * FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id INNER JOIN users ON users.u_id = orders.u_id  WHERE YEAR(orders.OR_CREATEDDATE) = '".$year."' $scpt" ;
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
			$total_price +=$row['or_totalprice'];
			$to = $i++;
			
			
			}	

				echo "<tr>";
				echo "<td colspan='4' align='right'> Total Orders in " .$month." - ".$year."</td>";
				echo "<td  align='right'>".$to." orders</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td colspan='4' align='right'> Total Price in " .$month." - ".$year."</td>";
				echo "<td  align='right'>".number_format($total_price)." VND</td>";
				echo "</tr>";

	}

?>