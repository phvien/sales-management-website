<?php

if (file_exists("./dbconfig/db-driver.php")) {
    include_once("./dbconfig/db-driver.php");
    $listProducts = show_products();
}

if (file_exists("../layout/scriptdatatables.php")) {
    include_once("../layout/scriptdatatables.php");
}

$output = '';

$output .= '
        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light">
                <tr>
                    <th>Action</th>
                    <th>Product Code</th>
                    <th>Product name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody';
foreach ($listProducts as $product) {
    $output .= ' <tr>
                    <td><button type="button" class="btn-add" name="add-product" id="btn-add" data-code="' .$product["ProductCode"]. '"  data-quantity="' .$product["Quantity"]. '"><i class="fas fa-plus"></i></button></td>
                    <td class="product-code" >' . $product['ProductCode'] . '</td>
                    <td class="product-name">' . $product['ProductName'] . '</td>
                    <td class="product-quantity">' . $product['Quantity'] . '</td>
                    <td class="product-price">' . $product['Price'] . ' VND</td>
                    <td class="product-details">' . $product['Details'] . '</td>
                </tr>';
}

$output .= '</tbody>
        </table>';

echo $output;
