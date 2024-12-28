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
    <!-- chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="schema.css">
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
                        <strong>UAS DWO | PURCHASE STOCK </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Components ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php                                             
                                            require_once "koneksi_purchasing.php";

                                            $sql = "SELECT p.ProductCategory, SUM(pf.ReceivedQty) as total_qty
                                                FROM purchasing_fact pf
                                                JOIN product p ON pf.ProductID = p.ProductID
                                                WHERE p.ProductCategory = 'Components'
                                                GROUP BY p.ProductCategory";


                                            $query = mysqli_query($mysqli, $sql);

                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }

                                            // Tampilkan hasil
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo number_format($row['total_qty'], 0, ".", ",");
                                            }                                
                                        ?>  
                                    </div>
                                    <div class="cardName">Components</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fa-solid fa-gears"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ================ Accessories ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                    <?php 
                                        
                                        $sql = "SELECT p.ProductCategory, SUM(pf.ReceivedQty) as total_qty
                                            FROM purchasing_fact pf
                                            JOIN product p ON pf.ProductID = p.ProductID
                                            WHERE p.ProductCategory = 'Accessories'
                                            GROUP BY p.ProductCategory";


                                            $query = mysqli_query($mysqli, $sql);

                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }

                                            // Tampilkan hasil
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo number_format($row['total_qty'], 0, ".", ",");
                                            }                                
                                        ?> 
                                    </div>
                                    <div class="cardName">Accessories</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <!-- ================ Clothing ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php 
                                           
                                            $sql = "SELECT p.ProductCategory, SUM(pf.ReceivedQty) as total_qty
                                                FROM purchasing_fact pf
                                                JOIN product p ON pf.ProductID = p.ProductID
                                                WHERE p.ProductCategory = 'Clothing'
                                                GROUP BY p.ProductCategory";

                                            $query = mysqli_query($mysqli, $sql);

                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }

                                            // Tampilkan hasil
                                            $row = mysqli_fetch_array($query);
                                            if ($row['total_qty'] !== null) {
                                                echo number_format($row['total_qty'], 0, ".", ",");
                                            } else {
                                                echo "No data found for products excluding the specified ones.";
                                            }
                                        ?>
                                    </div>
                                    <div class="cardName">Clothing</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx4">
                                    <i class="fa-solid fa-shirt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Bikes ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php                                             

                                            $sql = "SELECT 
                                            p.ProductCategory, 
                                            COALESCE(SUM(pf.ReceivedQty), 0) as total_qty
                                            FROM 
                                            product p
                                            LEFT JOIN 
                                            purchasing_fact pf ON pf.ProductID = p.ProductID
                                            WHERE 
                                            p.ProductCategory = 'Bikes'
                                            GROUP BY 
                                            p.ProductCategory

                                            UNION ALL

                                            SELECT 
                                            'Bikes' AS ProductCategory, 
                                            0 as total_qty
                                            WHERE 
                                            NOT EXISTS (SELECT 1 FROM purchasing_fact pf WHERE pf.ProductID IN (SELECT ProductID FROM product WHERE ProductCategory = 'Bikes'))";



                                            $query = mysqli_query($mysqli, $sql);

                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }

                                            // Tampilkan hasil
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo number_format($row['total_qty'], 0, ".", ",");
                                            }                                
                                        ?> 
                                    </div>
                                    <div class="cardName">Bikes</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fa-solid fa-bicycle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================ Chart ================= -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Stock Berdasarkan Tahun</h2>
                        </div>

                            <!-- Bagian chart -->
                            <?php 
                            $sql_top_products = "
                                    SELECT 
                                        t.Tahun AS Tahun, 
                                        SUM(pf.ReceivedQty) AS TotalStock
                                    FROM 
                                        purchasing_fact pf
                                    JOIN 
                                        time t ON t.TimeID = pf.TimeID
                                    GROUP BY 
                                        t.Tahun
                                    ORDER BY 
                                        t.Tahun ASC";

                                $result_top_products = $mysqli->query($sql_top_products);

                                $chart1_data = [];
                                while ($row = $result_top_products->fetch_assoc()) {
                                    $chart1_data[] = [
                                        'name' => $row['Tahun'],
                                        'y' => (float)$row['TotalStock'],
                                        'drilldown' => $row['Tahun'] // Drilldown ID sesuai dengan Tahun
                                    ];
                                }

                                // Query untuk chart drilldown (Stok per kategori dari tahun tertentu)
                                $sql_drilldown = "
                                    SELECT 
                                        t.Tahun, 
                                        p.ProductSubCategory, 
                                        SUM(pf.ReceivedQty) AS TotalStock
                                    FROM 
                                        purchasing_fact pf
                                    JOIN 
                                        product p ON p.ProductID = pf.ProductID
                                    JOIN 
                                        time t ON t.TimeID = pf.TimeID
                                    GROUP BY 
                                        t.Tahun, p.ProductSubCategory
                                    ORDER BY 
                                        t.Tahun, p.ProductSubCategory";

                                $result_drilldown = $mysqli->query($sql_drilldown);

                                $drilldown_data = [];
                                while ($row = $result_drilldown->fetch_assoc()) {
                                    $drilldown_data[$row['Tahun']][] = [
                                        $row['ProductSubCategory'],
                                        (float)$row['TotalStock']
                                    ];
                                }

                                // Format data drilldown untuk Highcharts
                                $drilldown_series = [];
                                foreach ($drilldown_data as $tahun => $data) {
                                    $drilldown_series[] = [
                                        'name' => "$tahun",
                                        'id' => $tahun,
                                        'data' => $data
                                    ];
                                }

                                // Encode data untuk JavaScript
                                $json_chart1_data = json_encode($chart1_data, JSON_NUMERIC_CHECK);
                                $json_drilldown_data = json_encode($drilldown_series, JSON_NUMERIC_CHECK);

                                // Tutup koneksi
                                $mysqli->close();
                            ?>


                            <!-- Highcharts Container -->
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>

                            <script>
                            // Data untuk chart utama
                            const chart1Data = <?php echo $json_chart1_data; ?>;

                            // Data untuk drilldown
                            const drilldownData = <?php echo $json_drilldown_data; ?>;

                            // Membuat chart
                            Highcharts.chart('container', {
                                chart: {
                                    type: 'line'
                                },
                                title: {
                                    text: ''
                                },
                                subtitle: {
                                    text: 'Klik di titik data untuk melihat Detail Stock berdasarkan Sub Kategori'
                                },
                                xAxis: {
                                    type: 'category',
                                    title: {
                                        text: 'Sub Category'
                                    }
                                },
                                yAxis: {
                                    title: {
                                        text: 'Total Stok'
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><br/>',
                                    pointFormat: 'Total Stock: <b>{point.y}</b>'
                                },
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true,
                                            format: '{point.y:,.0f}'
                                        }
                                    }
                                },
                                colors: [
                                    '#fac955', // Kuning
                                    '#fe6283', // Pink
                                    '#4dbfc0', // Hijau
                                    '#9866fe', // Ungu
                                    '#ff9d43', // Orange
                                    '#2677f4', // Biru
                                ],
                                series: [{
                                    name: 'Total Stock',
                                    colorByPoint: true,
                                    data: chart1Data,
                                }],
                                drilldown: {
                                    series: drilldownData
                                },
                                responsive: {
                                    rules: [{
                                        condition: {
                                            maxWidth: 500
                                        },
                                        chartOptions: {
                                            legend: {
                                                enabled: false
                                            }
                                        }
                                    }]
                                }
                            });
                            </script>
                    </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="js/demo/chart-bar-demo2.js"></script>
</body>

</html>