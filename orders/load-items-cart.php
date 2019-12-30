<?php
if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");

    if (isset($_GET['idOrders'])) {
        $idOrders = $_GET['idOrders'];
        $listOrderDetails = show_order_details($idOrders);
    }
}

if (file_exists("../layout/scriptdatatables.php")) {
    include_once("../layout/scriptdatatables.php");
}

$totalPrice = 0;

$output = '';

$output .= '
    <div class="table-responsive" >
        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light">
                <tr>
                    <th>Action</th>
                    <th>Num</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody';
foreach ($listOrderDetails as $key => $item) {
    $key += 1;
    $output .= '    <tr>
                       <td><button type="button" class="btn-delete" name="delete-product" id="btn-delete" data-code="' .$item['ProductCode']. '" data-quantity="' .$item['Quantity']. '"><i class="fa fa-trash"></i></button></td>
                       <td>' . $key . '</td>
                       <td>' . $item['ProductName'] . '</td>
                       <td>' . $item['Price'] . '</td>
                       <td><input type="number" value="' . $item['Quantity'] . '" class="quantity btn" id="quantity" name="quantity" min="1"></td>
                       <td>' . number_format($item['TotalPrice']) . ' VND</td>
                       <td><button type="button" class="btn-update" id="btn-update" name="update" data-key="' .$key. '"data-code="' .$item['ProductCode']. '" data-quantity="' .$item['Quantity']. '"><i style="font-size:14px" class="fas">&#xf044;</i> </button></td>
                    </tr>';
    $totalPrice += $item['TotalPrice'];
}

$output .= '    
            </tbody>
        </table>
    </div>';

$output .= '<table style="border:0px; float: right; margin-right: 10px">
                <tr>
                    <th colspan="4"><p>Total price: &emsp;' .number_format($totalPrice). ' VND</p></th>
                </tr>

                <tr>
                    <th colspan="7"><input style="float: right;" type="button" id="pay" class="btn btn-primary" onclick="pay()" name="pay" value="Thanh toán"></th>
                </tr>
            </table>';

if (empty($idOrders && $totalPrice)) {
    echo "Price has not been updated";
} else {
    update_orders_totalprice($idOrders, $totalPrice);
    disconnect_db();
}

echo $output;