<?php

if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");

    if (isset($_GET['idOrders'])) {
        $idOrders = $_GET['idOrders'];

        $checkNumProduct = get_num_products($idOrders);

        if ($checkNumProduct == '') {
            delete_orders_empty($idOrders);
            echo "Deleting the cart successful!";
        } else {
            foreach ($checkNumProduct as $key => $value) {
                $idOrders   = $value['OrdersID'];
                $idProduct  = $value['ProductID'];
                $quantity   = $value['Quantity'];

                if ($key == '0') {
                    delete_foreign_key();
                }

                delete_product_orderdetails($idOrders, $idProduct);
                update_quantity_delete($idProduct, $quantity);
            }
            delete_orders_empty($idOrders);
            echo "Deleting the cart successful!";
        }
    } else {
        echo "Please reload the page!";
    }
} else {
    echo "No database found";
}
