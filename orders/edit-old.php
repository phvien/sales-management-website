<?php
session_start();
include_once("dbconfig/db-driver.php");
// Get data orders ID and Customer name from orders.php
$total = 0;

if (isset($_GET['editOrders'])) {
    echo "<script>window.location='edit.php';</script>";

    $ordersID = $_GET['ordersID'];
    setcookie("ordersID", "$ordersID", time() + 7200);
    
    $customerName = $_GET['customerName'];
    setcookie("customerName", "$customerName", time() + 7200);
    
    $customerAddress = $_GET['customerAddress'];
    setcookie("customerAddress", "$customerAddress", time() + 7200);
    
    $customerPhone = $_GET['customerPhone'];
    setcookie("customerPhone", "$customerPhone", time() + 7200);
    
    $createDate = $_GET['createDate'];
    setcookie("createDate", "$createDate", time() + 7200);
    
    $staffCreate = $_GET['staffCreate'];
    setcookie("staffCreate", "$staffCreate", time() + 7200);
    
    $ordersID = $_COOKIE['ordersID'];
}

if (isset($_POST['save'])) {
    echo "<script>window.location='edit.php';</script>";
    $customerName       = $_POST['customerName'];
    $customerBirthday   = $_POST['customerBirthday'];
    $customerAddress    = $_POST['customerAddress'];
    $customerEmail      = $_POST['customerEmail'];
    $customerPhone      = $_POST['customerPhone'];
    $customerGender     = $_POST['customerGender'];
    setcookie("customerName", "$customerName", time() + 72000);
    if (empty($customerName && $customerAddress && $customerPhone)) {
        echo "<script>alert('Couldn't customer!');</script>";
    } else {
        insert_customer($customerName, $customerEmail, $customerAddress, $customerGender, $customerPhone, $customerBirthday);
    }

    if (isset($_SESSION['u_id'])) {

        $staffID = $_SESSION['u_id'];
        $dateCreated = date("Y-m-d h:i");
        create_orders($customerName, $staffID, $dateCreated);

        $getID = get_orders_id($customerName);

        foreach ($getID as $value) {
            $id = $value['OrdersID'];
            # code...
            setcookie("ordersID", "$id", time() + 7200);
            print_r("<pre>");
            print_r(var_dump($id));
        }
    } else {
        echo "<script>alert('Please login agian!');</script>";
    }
}

// Check customer name and ordersID in cookie 
if (isset($_COOKIE['customerName'])) {
    if (isset($_COOKIE['ordersID'])) {
        $customerName       = $_COOKIE['customerName'];
        $ordersID           = $_COOKIE['ordersID'];
        $customerAddress    = $_COOKIE['customerAddress'];
        $customerPhone      = $_COOKIE['customerPhone'];
        $createDate         = $_COOKIE['createDate'];
        $staffCreate        = $_COOKIE['staffCreate'];
        $listOrderDetails   = show_order_details($ordersID);
    } else {
        echo "<script>alert('Couldn't order ID!');</script>";
    }
} else {
    echo "<script>alert('Couldn't customer's name!');</script>";
}


// Delete an order
if (isset($_GET['deleteOrders'])) {
    // Delete a product in orders
    $numProduct = get_num_products($ordersID);

    if ($numProduct == '') {
        delete_orders_empty($ordersID);
        echo "<script>alert('Deleting the cart successful!');</script>";
        echo "<script>window.location='management.php';</script>";
    } else {
        foreach ($numProduct as $key => $value) {
            $ordersID   = $value['OrdersID'];
            $productID  = $value['ProductID'];
            $quantity   = $value['Quantity'];

            if ($key == '0') {
                delete_foreign_key();
            }

            // Deleting each product
            delete_product_orderdetails($ordersID, $productID);
            update_quantity_delete($productID, $quantity);
        }

        // Deleting a orders when it's empty
        delete_orders_empty($ordersID);
        echo "<script>alert('Deleting the cart successful!');</script>";
        echo "<script>window.location='management.php';</script>";
    }
    disconnect_db();
}

// Insert the product into the orderdetails table
if (isset($_GET['addProduct'])) {
    $quantity = $_GET['quantity'];
    $productID = $_GET['productID'];
    $checkProduct = get_quantity($ordersID, $productID);
    // print_r("<pre>");
    // print_r(var_dump($checkProduct));
    if ($quantity == '0') {
        echo "<script>alert('In stock products is not enough')</script>";
    } else if ($checkProduct[0]['QuantityOld'] == NULL) {
        insert_order_details($productID, $ordersID);
        echo "<script>window.location='edit.php';</script>";
    } else {
        // Get the current number of products 
        $quantityPresent = $checkProduct[0]['QuantityOld'];
        update_quantity_add($ordersID, $productID, $quantityPresent);
        echo "<script>window.location='edit.php';</script>";
    }
}

// Delete existing record in a orderdetails table
if (isset($_GET['deleteProduct'])) {
    $quantity = $_GET['quantity'];
    $productID = $_GET['productID'];
    delete_product($productID, $ordersID, $quantity);
    echo "<script>window.location='edit.php';</script>";
}

if (isset($_GET['updateQuantity'])) {
    $quantityUpdate = $_GET['quantity'];
    $productID = $_GET['productID'];
    $quantityOld = get_quantity($ordersID, $productID);
    $quantityProduct = get_quantity_product($productID);
    $count = 0;
    $count = $quantityUpdate - $quantityOld[0]['QuantityOld'];

    if ($count > 0) {
        if ($quantityProduct[0]['QuantityProduct'] != '0') {
            if ($count <= $quantityProduct[0]['QuantityProduct']) {
                update_quantity_increase($ordersID, $productID, $quantityUpdate, $count);
                echo "<script>alert('Update successful!')</script>";
                echo "<script>window.location='edit.php';</script>";
            } else {
                echo "<script>alert('Quantity not enough!')</script>";
            }
        } else {
            echo "<script>alert('In stock products is not enough!')</script>";
        }
    } else {
        $count = $quantityOld[0]['QuantityOld'] - $quantityUpdate;
        // echo "So luong giam: " . $count . "<br>";
        update_quantity_decrease($ordersID, $productID, $quantityUpdate, $count);
        echo "<script>alert('Update successful!')</script>";
        echo "<script>window.location='edit.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../layout/meta_link.php"); ?>
    <?php include_once("../layout/cssdatatables.php"); ?>
    <link rel="shortcut icon" type="image/png" href="./imgs/icon-page.png" />
    <script src="vendor/js/jquery-3.4.1.js"></script>
    <title>Edit orders | Order Management</title>
    <style>
        input[type=number] {
            width: 80px;
            background-color: #e4e6e7;
            color: black
        }

        .btn-add {
            background-color: #668cff;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-delete {
            background-color: #ff6666;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-delete-order {
            border: 0px solid #c2d6d6;
            background-color: #ffcccc;
            color: gray;
            padding: 6px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-update {
            background-color: #ffa366;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        /* Darker background on mouse-over */
        .btn-add:hover {
            background-color: #3366ff;
        }

        .btn-delete:hover {
            background-color: #ff0000;
        }

        .btn-update:hover {
            background-color: #ff6600;
        }
    </style>
</head>

<body id="page-top">
    <!-- Eng modal -->
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include_once("../layout/sidebar.php"); ?>
        <!-- End sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main content -->
            <div id="content">
                <!-- Topbar  -->
                <?php include_once("../layout/topbar.php"); ?>
                <!-- End of topbar -->
                <!-- Begin page content -->
                <?php
                include_once("dbconfig/db-driver.php");
                $listProducts = show_products();
                // $listOrderDetails = ShowOrderDetails($ordersID);
                ?>
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800"><img src="./imgs/edit.png"><strong> Edit orders </strong></h1>

                    <!-- List of products -->
                    <div class="card shadow mb-4" style="border-radius: 20px;">

                        <div class="card-body">

                            <a href="./management.php">

                                <button type="submit" style="border-radius: 30px;" class="btn btn-light" name="back">
                                    <img src="./imgs/back.png"> Back
                                </button>

                            </a>
                            <hr>
                            <div class="table-responsive">
                                <!-- <form method="GET"> -->
                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Action</th>
                                            <th>ProductCode</th>
                                            <th>ProductName</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($listProducts as $product) {
                                            ?>
                                            <tr>
                                                <form id="get-id-product" method="GET">
                                                    <td>
                                                        <!-- <input type="submit" class="btn btn-outline-primary btn-sm" name="addProduct" value="Add"> -->
                                                        <button type="submit" class="btn-add" name="addProduct"><i class="fas fa-plus"></i> Add</button>
                                                        <input type="hidden" name="productID" value="<?php echo $product['ProductCode']; ?>">
                                                    </td>
                                                    <td><?php echo $product['ProductCode']; ?></td>
                                                    <td><?php echo $product['ProductName']; ?></td>
                                                    <td>
                                                        <?php echo $product['Quantity']; ?>
                                                        <input type="hidden" name="quantity" value="<?php echo $product['Quantity']; ?>">
                                                    </td>
                                                    <td><?php echo $product['Price']; ?> VND</td>
                                                    <td><?php echo $product['Details']; ?></td>

                                                </form>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <table>
                                    <tr>
                                        <form action="#" method="GET">
                                            <th>
                                                <button type="submit" style="border-radius: 12px;" class="btn btn-delete-order btn-outline-danger btn-sm" name="deleteOrders">
                                                    <img src="./imgs/trash.png"> Delete order
                                                </button>
                                            </th>
                                        </form>
                                        <th>&emsp;&emsp;Code Orders: <?php echo "#$ordersID" ?></th>
                                        <th>&emsp;&emsp;Customer's Name: <?php echo $customerName ?></th>
                                    </tr>
                                </table>
                            </h6>
                        </div>
                        <!-- End of card-header, py-3 -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Action</th>
                                            <th>NumericalOrder</th>
                                            <th>ProductName</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>TotalPrice</th>
                                            <th>UpdateQuantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($listOrderDetails)) { ?>
                                            <div class="alert alert-warning">
                                                <strong>The cart is empty</strong>
                                            </div>
                                        <?php
                                        } else {
                                            foreach ($listOrderDetails as $key => $orderDetails) {
                                                ?>
                                                <tr>
                                                    <form method="GET">
                                                        <td>
                                                            <!-- <input type="submit" class="btn btn-outline-danger btn-sm" name="delProduct" value="Delete"> -->
                                                            <button type="submit" class="btn-delete" name="deleteProduct"><i class="fa fa-trash"></i> Delete</button>
                                                            <input type="hidden" name="productID" value="<?php echo $orderDetails['ProductCode']; ?>">
                                                        </td>
                                                        <td><?php echo $key + 1; ?></td>
                                                        <td><?php echo $orderDetails['ProductName']; ?></td>
                                                        <td><?php echo number_format($orderDetails['Price']); ?> VND</td>
                                                        <td><input value="<?php echo $orderDetails['Quantity']; ?>" type="number" class="btn" name="quantity" min="1"></td>
                                                        <td><?php echo number_format($orderDetails['TotalPrice']); ?> VND</td>
                                                        <td style="float: right;">
                                                            <button type="submit" class="btn-update" id="update" name="updateQuantity">
                                                                <i style='font-size:14px' class='fas'>&#xf044;</i> Update
                                                            </button>
                                                        </td>
                                                        <?php
                                                        $total += $orderDetails['TotalPrice'];
                                                        ?>
                                                    </form>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            if (!empty($ordersID && $total)) {
                                                update_orders_totalprice($ordersID, $total);
                                            } else {
                                                echo "<script>alert('Price has not been updated');</script>";
                                            }
                                            disconnect_db();
                                        } ?>
                                    </tbody>
                                </table>
                                <!-- thanh toán tiền -->
                                <table style="border:0px; float: right; margin-right: 10px">
                                    <!-- <tr>
                                        <th colspan="4">Money Received :</th>
                                        <th colspan="3"><input style="text-align:right; width:100%" class="btn" type="number" name="" value="1,000,000"></th>
                                    </tr> -->
                                    <tr>
                                        <th colspan="4">Total: </th>
                                        <th style="text-align: right;" colspan="3"><?php echo number_format($total); ?> VND</th>
                                    </tr>
                                    <!-- <tr>
                                        <th colspan="4"></th>
                                        <th style="text-align: right;" colspan="3">0 VND</th>
                                    </tr> -->
                                    <tr>
                                        <th colspan="7"> <input style="float: right;" type="submit" class="btn btn-primary" onclick="pay()" name="pay" value="Thanh toán"></th>
                                        <script>
                                            function pay() {
                                                if (window.confirm("Do you want print a the bill ?")) {
                                                    window.open("inhd.php");
                                                }
                                            }
                                        </script>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of list of products -->
            </div>
            <!-- End of main content -->
            <!-- Footer -->
            <?php include_once("../layout/footer.php"); ?>
            <!-- End of footer -->
        </div>
        <!-- End of content-wrapper -->

        <?php
        include_once("../layout/topbutton.php");
        include_once("../layout/script.php");
        include_once("../layout/logout.php");
        include_once("../layout/scriptdatatables.php");
        ?>

    </div>

</body>

</html>