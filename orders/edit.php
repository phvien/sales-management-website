<?php
// Code moi.
session_start();
include_once("dbconfig/db-driver.php");

// Show list products
$listProducts = show_products();

$total = 0;

if (isset($_GET['editOrders'])) {
    header('Location: edit.php');

    $ordersID = $_GET['ordersID'];
    setcookie("ordersID", $ordersID, time() + 7200);

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
}

if (isset($_COOKIE['ordersID'])) {
    $idOrders = $_COOKIE['ordersID'];
    $customerName = $_COOKIE['customerName'];

    $listOrderDetails = show_order_details($idOrders);
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../layout/meta_link.php"); ?>
    <?php include_once("../layout/cssdatatables.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="./imgs/icon-page.png" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./vendor/js/jquery-3.4.1.js"></script>
    <script src="./vendor/js/main.js"></script>
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
    <title>Edit orders | Order Management</title>
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include_once("../layout/sidebar.php"); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include_once("../layout/topbar.php"); ?>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800"><img src="./imgs/edit.png"><strong> Edit orders</strong></h1>

                    <div class="card shadow mb-4" style="border-radius: 20px;">

                        <div class="card-body">
                            <a href="./management.php">

                                <button type="submit" style="border-radius: 30px;" class="btn btn-light" name="back">
                                    <img src="./imgs/back.png"> Back
                                </button>

                            </a>
                            <hr>
                            <div class="table-responsive" id="load-products"></div>
                        </div>
                        <!-- End of card-body -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <table>
                                    <tr>
                                        <th><button type="button" style="border-radius: 12px;" class="btn btn-delete-order btn-outline-danger btn-sm" name="delete-order" id="btn-delete-order">
                                                <img src="./imgs/trash.png" alt="delete-order"> Delete Orders
                                            </button>
                                        </th>
                                        <th>

                                        </th>
                                        <th id="id-code-orders">&emsp;&emsp;Code orders: <?php echo $idOrders; ?></th>
                                        <th id="id-customer-name">&emsp;&emsp;Customer's name: <?php echo $customerName; ?></th>
                                        <input type="hidden" id="id-orders" value="<?php echo $idOrders; ?>">
                                    </tr>
                                </table>
                            </h6>
                            <!-- End of h6 -->

                        </div>
                        <!-- End of card-header, py-3 -->

                        <div class="card-body" id="load-items-cart">

                        </div>
                        <!-- End of card-body 2 -->

                    </div>
                    <!-- End of card, shadow, mb-4 -->

                </div>
                <!-- End of container-fluid -->

            </div>
            <!-- End of content -->

            <?php include_once("../layout/footer.php"); ?>
        </div>
        <!-- End of content-wrapper -->

        <?php
        include_once("../layout/topbutton.php");
        include_once("../layout/script.php");
        include_once("../layout/logout.php");
        include_once("../layout/scriptdatatables.php");
        ?>
    </div>
    <!-- End of wrapper -->
</body>

</html>