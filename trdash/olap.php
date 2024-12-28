<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

// Handle sign out
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to login page
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS DWO | Talia-Risda</title>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/593d3369da.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="olap.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fas fa-layer-group"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">TRDash</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="home.php" class="sidebar-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>Purchasing</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="purchase_location.php" class="sidebar-link">Location</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="purchase_product.php" class="sidebar-link">Product</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="purchase_stock.php" class="sidebar-link">Stock</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Sales</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="sales_order.php" class="sidebar-link">Order</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="sales_product.php" class="sidebar-link">Product</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="sales_territory.php" class="sidebar-link">Territory</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="olap.php" class="sidebar-link">
                        <i class="fa-solid fa-database"></i>
                        <span>OLAP</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <!-- ========================= Main ==================== -->
        <div class="main">
                <div class="topbar">
                    <div class="search">
                        <strong>UAS DWO | OLAP </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>
               
                <!-- ================ OLAP ================= -->
                
                    <div class="olapWrap">                        
                            <h2>Tampilan OLAP - Mondrian</h2>
                        <iframe name="mondrian" src="http://localhost:8080/mondrian/index.html" style="height:300px; width:100%; border:none; align-content:center"> </iframe>     
                    </div>

            <!-- ================ Footer ================= -->
            <footer class="footer">
                <div class="container-fluid">
                    <span>&copy; 2024 UAS DWO. Talia - Risda All Rights Reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- =========== Scripts =========  -->    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="home.js"></script>
    <script src="script.js"></script>
</body>

</html>