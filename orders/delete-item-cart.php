<?php

if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");
    if (isset($_GET['idOrders']) && isset($_GET['idProduct']) && isset($_GET['quantity'])) {
        $idOrders = $_GET['idOrders'];
        $idProduct = $_GET['idProduct'];
        $quantity = $_GET['quantity'];
        delete_product($idProduct, $idOrders, $quantity);

        $checkNumProduct = get_num_products($idOrders);

        if ($checkNumProduct == '') {
            delete_orders_empty($idOrders);
            echo "delete-empty-cart";
        }

    } else {
        echo "Delete failed";
    }
} else {
    echo "No database found!";
}
