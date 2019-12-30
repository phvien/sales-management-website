<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home/homepage.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PC House</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="../home/homepage.php">
            <span>Home</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
            <span>Orders</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Page1</a>
                <a class="collapse-item" href="#">Page2</a>
            </div>
        </div>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="../orders/management.php"><span>Orders</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="../customers/customer_list.php"><span>Customers</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="../products/product_list.php">Products</a>
                <a class="collapse-item" href="../categories/category_list.php">Categories</a>
                <a class="collapse-item" href="../producers/producer_list.php">Producers</a>
            </div>
        </div>
    </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStatistical" aria-expanded="true" aria-controls="collapseStatistical">
            <span>Statistical</span>
        </a>
        <div id="collapseStatistical" class="collapse" aria-labelledby="headingStatistical" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="../statistical/statistical-orders.php">Statistics orders</a>
                <a class="collapse-item" href="../statistical/statistical-products.php">Statistics products</a>
                <a class="collapse-item" href="../statistical/statistical-customers.php">Statistics customers</a>
            </div>
        </div>
    </li>
    <?php
        if ($_SESSION['r_id']==1)
        {
            // Divider
            echo "<hr class='sidebar-divider'>";
            echo "<li class='nav-item'>";
                echo "<a class='nav-link collapsed' href='#'' data-toggle='collapse' data-target='#collapseUsers' aria-expanded='true' aria-controls='collapseUsers'>";
                    echo "<span>Users</span>";
                echo "</a>";
                echo "<div id='collapseUsers' class='collapse' aria-labelledby='headingUsers' data-parent='#accordionSidebar'>";
                    echo "<div class='bg-white py-2 collapse-inner rounded'>";
                        echo "<a class='collapse-item' href='../users/user_list.php'>Users</a>";
                        echo "<a class='collapse-item' href='../users/password_change_history.php'>Password change history</a>";
                    echo "</div>";
                echo "</div>";
            echo "</li>";
        }
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->