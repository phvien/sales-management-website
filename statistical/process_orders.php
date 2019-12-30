

<?php
$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
    if (isset($_GET['q'])) {
        $date = $_GET['q'];
    
        if($vl == "2") {
            
            // $result = mysqli_query($conn, " SELECT * FROM `orderdetails`, orders 
            // WHERE orderdetails.or_id = orders.or_id and  `orders`.`OR_CREATEDDATE` = '$date(Y-2-d)' ");
            // $row = mysqli_fetch_assoc($result);
        echo "<h1> 1 </h1>";
        }
    }    
?>