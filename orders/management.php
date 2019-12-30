<?php
// code moi.
include_once("../session.php");

// Query database
include("dbconfig/db-driver.php");
$listOrders = show_orders();
disconnect_db();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <?php
        include_once("../layout/meta_link.php");

		// Custom styles for this page
		include_once("../layout/cssdatatables.php");
    ?>
    <link rel="shortcut icon" type="image/png" href="./imgs/icon-page.png" />
    <title>Orders Management</title>
    <style>
        input[type=number] {
            width: 80px;
            background-color: #e4e6e7;
            color: black
        }

        .btn1 {
            border: 0px solid #c2d6d6;
            background-color: white;
            color: black;
            padding: 8px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-new {
            border: 0px solid #c2d6d6;
            background-color: #f2f2f2;
            color: #666666;
            padding: 8px 10px;
            font-size: 16px;
            cursor: pointer;
        }


        .btn-edit {
            border: 0px solid #c2d6d6;
            background-color: #e6e6ff;
            color: gray;
            padding: 6px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-delete {
            border: 0px solid #c2d6d6;
            background-color: #ffcccc;
            color: black;
            padding: 6px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-edit:hover {
            background-color: #3366ff;
            color: white;
        }

        /* Gray */
        .btn-default {
            border-color: #ccccff;
            color: #666666;
        }

        .btn-default:hover {
            background: #ff9900;
            color: white;
        }
    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once("../layout/sidebar.php"); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main content -->

            <div id="content">
                <!-- Topbar  -->
                <?php include_once("../layout/topbar.php"); ?>

                <div class="container-fluid">

                    <h2 class="h3 mb-2 text-gray-800"><img src="./imgs/management.png"> Orders Management</h2>

                    <!-- Show list of products -->
                    <div class="card shadow mb-4" style="border-radius: 20px;">

                        <div class="card-body">

                            <a href="./new-orders.php">

                                <button type="button" style="border-radius: 50px;" class="btn1 btn-new btn-default" name="new-orders">
                                    <img src="./imgs/cart.png" height="24px" width="24px"> New orders
                                </button>

                            </a>
                            <hr>

                            <div class="table-responsive">

                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">

                                    <thead class="thead-light">

                                        <tr>
                                            <th>Action</th>
                                            <th>CodeOrders</th>
                                            <th>CustomerName</th>
                                            <th>CreateDate</th>
                                            <th>StaffCreated</th>
                                            <th>Quantity</th>
                                            <th>TotalPrice</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($listOrders as $order) { ?>

                                            <tr>
                                                    <td>
                                                        <form action="edit.php" method="GET">
                                                            <button type="submit" style="border-radius: 12px;" class="btn1 btn-edit btn-outline-primary btn-sm" name="editOrders">
                                                                <img src="./imgs/edit.png"> Edit
                                                            </button>

                                                            <input type="hidden" name="ordersID" value="<?php echo $order['OrdersID']; ?>">

                                                            <input type="hidden" name="customerName" value="<?php echo $order['CustomerName']; ?>">

                                                            <input type="hidden" name="productID" value="<?php echo $order['ProductID']; ?>">

                                                            <input type="hidden" name="customerAddress" value="<?php echo $order['CustomerAddress']; ?>">

                                                            <input type="hidden" name="customerPhone" value="<?php echo $order['CustomerPhone']; ?>">

                                                            <input type="hidden" name="staffCreate" value="<?php echo $order['StaffCreated']; ?>">

                                                            <input type="hidden" name="createDate" value="<?php echo $order['CreateDate']; ?>">

                                                        </form>
                                                    </td>

                                                <td><?php echo $order['OrdersID']; ?></td>

                                                <td><?php echo $order['CustomerName']; ?></td>

                                                <td><?php echo $order['CreateDate']; ?></td>

                                                <td><?php echo $order['StaffCreated']; ?></td>

                                                <td><?php echo $order['Quantity']; ?></td>

                                                <td><?php echo number_format($order['Total']); ?> VND</td>

                                            </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- End of list of products -->

            </div>

            <!-- Footer -->
            <?php include_once("../layout/footer.php"); ?>

        </div>
        <!-- End of page wrapper -->

    </div>
    <?php
        include_once("../layout/topbutton.php");
        include_once("../layout/script.php");
        include_once("../layout/logout.php");
        include_once("../layout/scriptdatatables.php");
    ?>
</body>
</html>