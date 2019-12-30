<?php
    include_once("../session.php");
    include("config.php");
    include("function.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <?php
        include_once("../layout/meta_link.php");
    ?>
  <!-- Custom styles for this page -->
    <?php
        include_once("../layout/cssdatatables.php");
    ?>
    <title>Quản lý người dùng</title>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    <!-- Sidebar -->
    <?php
        include_once("../layout/sidebar.php");
    ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                    include_once("../layout/topbar.php");
                ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php 
                                                $allPro = countAllProduct($conn);
                                                while ($row_ds = mysqli_fetch_array($allPro))
                                                {
                                            ?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Product</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                echo $row_ds["allPro"];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Revenue (Month)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    $allRe = revenueByMonth($conn);
                                                    while ($row_ds3 = mysqli_fetch_array($allRe)){
                                                        echo $row_ds3["tong"];
                                                    }
                    
                                                ?>
                                                VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All Products</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php 
                                                            $allProIn = countAllProductInventory($conn);
                                                            while ($row_ds1 = mysqli_fetch_array($allProIn)){
                                                                echo round($row_ds1["allProIn"]);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php  echo round($row_ds1["allProIn"]/$row_ds["allPro"]*100); ?>%" aria-valuenow="50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                                                <?php 
                                                    $allProIn = countAllUser($conn);
                                                    while ($row_ds1 = mysqli_fetch_array($allProIn)){      
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php   echo round($row_ds1["allUser"]); ?></div>
                                                <?php
                                                    }
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                    <!-- Content Row -->

                    <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-6">
                            <h1>Number Of Purchases</h1>
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Customer Name</th>
                                                    <th>Number Of Purchases</th>
                                                    <th>Customer Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i  = 1;
                                                    $getCustomer = getCustomer($conn);
                                                    while ($row_getCS = mysqli_fetch_array($getCustomer)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row_getCS["CUS_FULLNAME"]; ?></td>
                                                    <td><?php echo $row_getCS["Purchases"]; ?></td>
                                                    <td><?php echo $row_getCS["CUS_ADDRESS"]; ?></td>
                                                </tr>
                                                <?php 
                                                    $i++;
                                                    } 
                                                ?>
                                            </tbody>
                                      </table>
                                  </div>

        <div class="col-lg-12 mb-6">
                <h1>Product sold today</h1>
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <thead>
                          <?php 
                              $getProductNow = getProductNow($conn);
                               while ($row_getPN = mysqli_fetch_array($getProductNow)){
                           ?>
                            <tr>
                              <td><?php echo $row_getPN["PRO_ID"]; ?></td>
                              <td><?php echo $row_getPN["PRO_NAME"]; ?></td>
                              <td><?php echo $row_getPN["TOTAL"]; ?></td>
                              <td><?php echo $row_getPN["TOTAL_PRICE"]; ?></td>
                            </tr>
                            <?php } ?>
                        </thead>
                  </table>
                </div

           
           </div>
         </div>
              <!-- Approach -->
              

            </div>
          </div>

        </div>
            <!-- End of Page Content -->
          </div>
          <!-- End of Main Content -->
          <!-- Footer -->
          <?php
            include_once("../layout/footer.php");
          ?>
          <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <?php
    include_once("../layout/topbutton.php");

    // Logout Modal
    include_once("../layout/logout.php");

    include_once("../layout/script.php");
  
    // Page level
    include_once("../layout/scriptdatatables.php");
  ?>
  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
</body>
</html>