<?php

if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");
    if (isset($_GET['idOrders'])  && isset($_GET['idProduct']) && isset($_GET['quantity'])) {
        $idOrders = $_GET['idOrders'];
        $idProduct = $_GET['idProduct'];
        $quantity = $_GET['quantity'];
        $checkProduct = get_quantity($idOrders, $idProduct);

        if ($checkProduct[0]['QuantityOld'] == NULL) {
            insert_order_details($idProduct, $idOrders);
        } else {
            $quantityPresent = $checkProduct[0]['QuantityOld'];
            update_quantity_add($idOrders, $idProduct, $quantityPresent);
        }
    }
} else {
    echo "No database found!";
}
