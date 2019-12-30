<?php
if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");
}

if (isset($_GET['idProduct']) && isset($_GET['idOrders'])) {
    $idProduct = $_GET['idProduct'];
    $idOrders = $_GET['idOrders'];
    insert_order_details($idProduct, $idOrders);
    echo "<script>alert('Process!');</script>";
} else {
    echo "<script>alert('Add product to card failed!');</script>";
    exit();
}
