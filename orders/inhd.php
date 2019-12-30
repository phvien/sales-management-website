<?php
session_start();
include_once("dbconfig/db-driver.php");
// Get data orders ID and Customer name from orders.php
if (isset($_GET['pay'])) {
  echo "<script>window.location='inhd.php';</script>";
  $ordersID = $_GET['ordersID'];
  setcookie("ordersID", "$ordersID", time() + 7200);

  $createDate = $_GET['createDate'];
  setcookie("createDate", "$createDate", time() + 7200);

  $staffCreate = $_GET['staffCreate'];
  setcookie("staffCreate", "$staffCreate", time() + 7200);

  $ordersID = $_COOKIE['ordersID'];
  $customerName = $_GET['customerName'];
  setcookie("customerName", "$customerName", time() + 7200);

  $customerAddress = $_GET['customerAddress'];
  setcookie("customerAddress", "$customerAddress", time() + 7200);

  $customerPhone = $_GET['customerPhone'];
  setcookie("customerPhone", "$customerPhone", time() + 7200);
  
}
$createDate = $_COOKIE['createDate'];
$staffCreate = $_COOKIE['staffCreate'];
$customerName = $_COOKIE['customerName'];
$customerAddress = $_COOKIE['customerAddress'];
$customerPhone = $_COOKIE['customerPhone'];
$ordersID = $_COOKIE['ordersID'];

$listOrderDetails = show_order_details($ordersID);
global $total;
disconnect_db();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title> </title>
  <!-- <link rel="stylesheet" href="vendor/mystyle/style.css" media="all" /> -->
  <link rel="stylesheet" href="style.css" media="all">
</head>

<body onload="window.print()">
  <main>
    <h1 class="clearfix"> <img class="logo" src="imgs/logo_cty.png" /> <b>BILL OF SALE</b> </h1>
    <div class="container">
      <div id="grid">
        <style>
          #grid {
            display: grid;
            width: 100%;
            grid-template-columns: 2fr 1fr;

          }
        </style>
        <div id="infoOrder">
          <?php
          $date = getdate();
          ?>
          <b>ID: <?php echo "#$ordersID" ?></b><br />
          <b>Day for sales: </b><?php echo $createDate ?><br />
          <b>Sales unit: </b>PC-HOUSE <br />
          <b>Address: </b>11 Phan Đình Phùng, Tân An, Ninh Kiều, TP.Cần Thơ<br />
          <b>Phone: </b>0292 3760 999 <br />
          <b>Salesman: </b><?php echo $staffCreate ?>
          <style>
            #infoOrder {
              line-height: 2;
            }
          </style>
        </div>
        <div id="infoCustomer">
          <?php
          include_once("dbconfig/db-driver.php");
          ?>
          <b>Customer: </b> <?php echo $customerName ?> <br />
          <b>Address: </b> <?php echo $customerAddress ?> <br />
          <b>Phone: </b> <?php echo $customerPhone ?><br />
          <style>
            #infoCustomer {
              line-height: 2;
            }
          </style>
        </div>
      </div>
    </div>
    <br />
    <hr size="2px">
    <br />
    <div>
      <table class="table table-sm" style="width: 100%">
        <thead>
          <tr>
            <th style="text-align: center;"><b>No.</b></th>
            <th style="text-align: center;"><b>Product Name</b></th>
            <th style="text-align: center;"><b>Quantity</b></th>
            <th style="text-align: center;"><b>Price</b></th>
            <th style="text-align: center;"><b>Total Price</b></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (empty($listOrderDetails)) { ?>
            <div class="alert alert-warning">
              <strong>Cart is empty!</strong>
            </div>
          <?php
          } else {
            foreach ($listOrderDetails as $key => $orderDetails) {
              $key += 1;
              ?>
              <tr>
                <td style="text-align: center;"><?php echo $key;  ?></td>
                <td style="text-align: center;"><?php echo $orderDetails['ProductName']; ?></td>
                <td style="text-align: center;"><?php echo $orderDetails['Quantity']; ?></td>
                <td style="text-align: center;"><?php echo number_format($orderDetails['Price']); ?> VND</td>
                <td style="text-align: right;"><?php echo number_format($orderDetails['TotalPrice']); ?> VND</td>
                <?php $total += $orderDetails['TotalPrice']; ?>
              </tr>

            <?php } ?>
          <?php } ?>
          <tr>
            <th style="text-align: right; color: black;" colspan="4"><b><p> Total Price: </p></b></th>
            <th style="text-align: right; color: black;" colspan="3"><b><?php echo number_format($total); ?> VND</b></th>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="details" class="clearfix">
      <div id="project">
        <div class="arrow">Customer's signature:</div>
        <br />
        <br />
        <br />
        <div class="arrow"><b><?php echo $customerName ?></b></div>
      </div>
      <div id="company">
        <div class="arrow back">Salesman's signature:</div>
        <br />
        <br />
        <br />
        <div class="arrow back"> <b><?php echo $staffCreate ?></b> </div>
      </div>

    </div>
    <div id="notices">
      <div class="notice">Thanks! See you agian.</div>
  </main>
</body>

</html>