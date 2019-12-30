<?php

if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");

    if (isset($_GET['idOrders']) && isset($_GET['idProduct']) && isset($_GET['quantityUpdate'])) {
        $idOrders = $_GET['idOrders'];
        $idProduct = $_GET['idProduct'];

        // The value is changed
        $quantityUpdate = $_GET['quantityUpdate'];

        // Get the current number of products
        // $quantityOld = get_quantity($idOrders, $idProduct);
        $quantityOld = $_GET['quantityCurrent'];

        // Variables are used to check the number of products in stock 
        $quantityProduct = get_quantity_product($idProduct);

        // The variable used to calculate the value has changed
        $count = 0;

        $count = $quantityUpdate - $quantityOld;

        // Check if the number of changes is increased or decreased
        if ($count > 0) {
            if ($quantityProduct[0]['QuantityProduct'] != '0') {
                if ($count <= $quantityProduct[0]['QuantityProduct']) {
                    update_quantity_increase($idOrders, $idProduct, $quantityUpdate, $count);
                    echo "Update successful!";
                } else {

                    echo "Quantity not enough!";
                }
            } else {

                echo "Products out of stock!";
            }
        } else {

            $count = $quantityOld[0]['QuantityOld'] - $quantityUpdate;
            update_quantity_decrease($idOrders, $idProduct, $quantityUpdate, $count);
            echo "Update successful!";
        }
    } else {
        echo "Update failed!!!";
    }
} else {
    echo "No database found";
}
