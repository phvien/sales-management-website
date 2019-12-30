<?php
// Include files
include_once("../session.php");

// Query database
include("dbconfig/db-driver.php");
$listProducts = show_products();
$listCustomers = show_customers();
// disconnect_db();

// Customer registration
global $tmp;
global $customerName;
global $customerBirthday;
global $customerAddress;
global $customerEmail;
global $customerPhone;
global $customerGender;

global $quantities;
global $choosesID;
global $productsName;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include_once("../layout/meta_link.php");
        include_once("../layout/cssdatatables.php");
    ?>
    <link rel="shortcut icon" type="image/png" href="./imgs/icon-page.png" />
    <title>New orders | Order Management </title>
    <!-- <link rel="stylesheet" href="./vendor/mystyle/style.css"> -->
    <script type="text/javascript">
        function get_customer_name() {
            var customerName = document.getElementById('customer-Name').value;
            // alert(customerName);
            return customerName;
        }
    </script>
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Inlcude sidebar of the page -->
        <?php include_once("../layout/sidebar.php"); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Include the topbar of the page  -->
                <?php include_once("../layout/topbar.php"); ?>

                <div class="container-fluid">

                    <h2 class="h3 mb-2 text-gray-800"><img src="./imgs/create.png"> Create a new orders</h2>

                    <!-- Show list of the products -->
                    <div class="card shadow mb-4" style="border-radius: 20px;">

                        <div class="card-body">

                            <a href="./management.php">
                                <button type="submit" style="border-radius: 20px;" class="btn btn-light" name="back">
                                    <img src="./imgs/back.png"> Back
                                </button>
                            </a>
                            <hr>

                            <!-- </div> -->

                            <form method="POST" name="register" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8">

                                <div class="col-sm-10">

                                    <div class="table-responsive">

                                        <table width="80%" cellspacing="0">
                                            <tr>

                                                <td>
                                                    <h5><b>Select customer (&#42;):</b></h5>
                                                </td>

                                                <!-- <td><input type="text" style="border-radius: 15px;" class="form-control" name="customerName" placeholder="Enter customer's full name" id="customerName"></td> -->
                                                <td>
                                                    <select name="selectCustomer" id="select-customer" class="form-control custom-select select-customer">
                                                        <option value='' selected>--- Select ---</option>
                                                        <?php foreach ($listCustomers as $customer) { ?>

                                                            <option value="<?php echo $customer['CustomerName']; ?>"><?php echo $customer['CustomerName']; ?></option>

                                                        <?php } ?>
                                                    </select>

                                                </td>

                                                <td>&emsp;
                                                    <button type="button" style="border-radius: 100px;" class=" btn btn-light" name="createCustomer" data-toggle="modal" data-target="#register">
                                                        <img src="./imgs/plus.png">
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr class="hr-customise">

                                <?php
                                if (isset($_POST['smOrders'])) {
                                    global $selectCustomer;
                                    $selectCustomer = $_POST['selectCustomer'];
                                    $quantities     = $_POST['quantities'];
                                    if (isset($_POST['choosesID']))
                                        $choosesID      = $_POST['choosesID'];
                                    $productsName   = $_POST['productsName'];
                                    if ($selectCustomer == '' || empty($selectCustomer)) { ?>
                                        <div class="alert alert-warning" style="border-radius: 20px;">
                                            <strong>Warning!</strong> Please select a customer or click the (+) button to create a customer.
                                        </div>
                                    <?php } else {
                                        if (isset($_SESSION['u_id'])) {

                                            if (!empty($choosesID)) {

                                                $staffID = $_SESSION['u_id'];
                                                $dateCreated = date("Y-m-d h:i");
                                                create_orders($selectCustomer, $staffID, $dateCreated);

                                                foreach ($choosesID as $key => $productID) {
                                                    // Get a value of a choose
                                                    $index = ($productID - 1);

                                                    // Check the quantity of product
                                                    if ($quantities[$index] != '0') {
                                                        insert_order_details_plus($productID, $selectCustomer);
                                                    } else {
                                                        echo "<script>window.alert('Products out of stock');</script>";
                                                        echo "<script>window.location='./new-orders.php';</script>";
                                                    }
                                                }
                                                echo "<script>window.alert('Create successful orders for customers name: {$selectCustomer}');</script>";
                                                echo "<script>window.location='./management.php';</script>";
                                            } else {
                                                // if-else of Check the number of product (choosesID)
                                                ?>
                                                <div class="alert alert-warning" style="border-radius: 20px;">
                                                    <strong>Warning!</strong> Please select a product to add to the new cart.
                                                </div>

                                            <?php }
                                        } else {
                                            // if-else of check SESSION 
                                            echo "<script>alert('Please login agian!');</script>";
                                        }
                                    }
                                } ?>
                                <!-- End of the submit order -->

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

                                                    <td>
                                                        <label class="container">
                                                            <input type="checkbox" name="choosesID[]" value="<?php echo $product['ProductCode']; ?>">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td><?php echo $product['ProductCode']; ?></td>
                                                    <td>
                                                        <?php echo $product['ProductName']; ?>
                                                        <input type="hidden" name="productsName[]" value="<?php echo $product['ProductName']; ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $product['Quantity']; ?>
                                                        <input type="hidden" name="quantities[]" value="<?php echo $product['Quantity']; ?>">
                                                    </td>
                                                    <td><?php echo $product['Price']; ?> VND</td>
                                                    <td><?php echo $product['Details']; ?></td>

                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success btn-md btn-block" name="smOrders">Add orders</button>
                            </form>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of list of products -->
            <?php include_once("../layout/footer.php"); ?>
        </div>
        <!-- End of main content -->
        <!-- Footer -->
        <!-- End of footer -->
    </div>
    <!-- End of page wrapper -->

    </div>
    <!-- Begin modal customer registraion -->
    <div class="modal fade  bd-example-modal-lg" id="register" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><img src="./imgs/customer.png"> Customer registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit.php" method="POST">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <label for="customer-name"> Full name (&#42;):</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-general" name="customerName" id="customer-Name" required oninvalid="this.setCustomValidity('Enter customer\'s full name')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="customer-birthday"> Birthday :</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control text-date" name="customerBirthday" id="customer-Birthday">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="customer-address"> Address (&#42;):</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-general" name="customerAddress" id="customer-Address" required oninvalid="this.setCustomValidity('Enter customer\'s address')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="customer-email"> Email:</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-general" name="customerEmail" id="customer-Email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="customer-phone"> Phone (&#42;):</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-general" name="customerPhone" id="customer-Phone" required oninvalid="this.setCustomValidity('Enter customer\'s phone number')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="customer-gender"><span></span> Gender:</label>
                                </div>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="customerGender" class="text-general" id="customer-Gender" value="Nam" checked> Male
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="customerGender" class="text-general" id="customer-Gender" value="Nữ"> Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <!-- <form action="#" method="get"> -->
                            <button type="submit" class="btn btn-light" name="save"><img src="./imgs/save.png" alt="save"> Save</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal"><img src="./imgs/close.png" alt="cancel" height="18px" width="18px"> Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Begin modal message -->
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" id="success" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Message</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Create successful customers: <strong><?php echo $customerName; ?></strong>
                    <p style="padding-left: 20px;color:coral;">Please select customer to add a product to the cart!</p>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

<?php
    include_once("../layout/topbutton.php");
    include_once("../layout/script.php");
    include_once("../layout/logout.php");
    include_once("../layout/scriptdatatables.php");
?>

</body>
</html>