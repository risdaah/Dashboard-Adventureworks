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
                        <strong>UAS DWO | SALES PRODUCT </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Pembelian 2011 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php 
                                            require_once "koneksi_sales.php";
                                      
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian from sales_fact sf
                                            JOIN time t ON sf.TimeID = t.TimeID
                                            WHERE tahun = 2011";
                                                
                                                $query = mysqli_query($koneksi, $sql);
                                                
                                                // Debugging jika query gagal
                                                if (!$query) {
                                                    die("Query Error: " . mysqli_error($koneksi));
                                                }
                                                
                                                // Tampilkan hasil
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                                }   
                                                
                                        ?>  
                                    </div>
                                    <div class="cardName">Pendapatan 2011</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ================ Pembelian 2012 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php   

                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian from sales_fact sf
                                            JOIN time t ON sf.TimeID = t.TimeID
                                            WHERE tahun = 2012";
                                                    
                                            $query = mysqli_query($koneksi, $sql);
                                                    
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($koneksi));
                                            }
                                                    
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                            echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            }     
                                            
                                        ?>  
                                    </div>
                                    <div class="cardName">Pendapatan 2012</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Pendapatan 2013 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                            <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php                                            

                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian from sales_fact sf
                                            JOIN time t ON sf.TimeID = t.TimeID
                                            WHERE tahun = 2013";
                                                    
                                            $query = mysqli_query($koneksi, $sql);
                                                    
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($koneksi));
                                            }
                                                    
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                            echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            }    
                                            
                                        ?>  
                                    </div>
                                    <div class="cardName">Pendapatan 2013</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fa-solid fa-calendar-days"></i>   
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Pembelian 2014 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php                                             

                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian from sales_fact sf
                                            JOIN time t ON sf.TimeID = t.TimeID
                                            WHERE tahun = 2014";
                                                        
                                            $query = mysqli_query($koneksi, $sql);
                                                        
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($koneksi));
                                            }
                                                        
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            } 
                                            
                                        ?> 
                                    </div>
                                    <div class="cardName">Pendapatan 2014</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx4">
                                    <i class="fa-solid fa-calendar-days"></i>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================ Chart ================= -->
                <div class="details">
                    <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Pendapatan Berdasarkan Sub Kategori</h2>
                            </div>

                            <!-- Bagian chart -->
                            <?php                               

                                // Query untuk chart utama (Total Sales berdasarkan ProductSubCategory)
                                $sql_top_products = "
                                    SELECT 
                                        p.ProductSubCategory AS ProductSubCategory, 
                                        SUM(sf.SalesAmount) AS TotalSales
                                    FROM 
                                        sales_fact sf
                                    JOIN 
                                        product p ON p.ProductID = sf.ProductID
                                    GROUP BY 
                                        p.ProductSubCategory
                                    ORDER BY 
                                        TotalSales DESC";
                                $result_top_products = $koneksi->query($sql_top_products);

                                $chart1_data = [];
                                while ($row = $result_top_products->fetch_assoc()) {
                                    $chart1_data[] = [
                                        'name' => $row['ProductSubCategory'],
                                        'y' => (float)$row['TotalSales'],
                                        'drilldown' => $row['ProductSubCategory'] // Tambahkan nama subkategori sebagai drilldown ID
                                    ];
                                }

                                // Query untuk chart drilldown (Penjualan berdasarkan tahun untuk setiap subkategori)
                                $sql_drilldown = "
                                    SELECT 
                                        p.ProductSubCategory, 
                                        t.Tahun, 
                                        SUM(sf.SalesAmount) AS TotalSales
                                    FROM 
                                        sales_fact sf
                                    JOIN 
                                        product p ON p.ProductID = sf.ProductID
                                    JOIN 
                                        time t ON t.TimeID = sf.TimeID
                                    GROUP BY 
                                        p.ProductSubCategory, t.Tahun";
                                $result_drilldown = $koneksi->query($sql_drilldown);

                                $drilldown_data = [];
                                while ($row = $result_drilldown->fetch_assoc()) {
                                    $drilldown_data[$row['ProductSubCategory']][] = [
                                        $row['Tahun'],
                                        (float)$row['TotalSales']
                                    ];
                                }

                                // Format data drilldown untuk Highcharts
                                $drilldown_series = [];
                                foreach ($drilldown_data as $subCategory => $data) {
                                    $drilldown_series[] = [
                                        'name' => $subCategory,
                                        'id' => $subCategory,
                                        'data' => $data
                                    ];
                                }

                                // Encode data untuk JavaScript
                                $json_chart1_data = json_encode($chart1_data);
                                $json_drilldown_data = json_encode($drilldown_series);

                                $koneksi->close();
                            ?>


                            <!-- Tampilan -->
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
                                        text: 'Klik di bagian titik untuk melihat detail pendapatan berdasarkan Tahun'
                                    },
                                    xAxis: {
                                        type: 'category',                                        
                                        title: {
                                            text: 'Tahun'
                                        }
                                    },
                                    yAxis: {
                                        labels: {
                                        formatter: function () {
                                            let value = this.value; // Ambil nilai asli
                                            if (value >= 1000000) {
                                                // Jika nilai lebih dari atau sama dengan 1 juta
                                                return '$' + (value / 1000000).toFixed(2) + 'M'; // Format dolar dalam juta
                                            } else {
                                                // Jika nilai kurang dari 1 juta
                                                return '$' + value.toLocaleString(); // Format dolar dengan koma
                                            }
                                        }
                                    },
                                        title: {
                                            text: 'Total Pendapatan'
                                        }
                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><br/>',
                                        pointFormat: 'Total Sales: <b>${point.y}</b>'
                                    },
                                    plotOptions: {
                                        series: {
                                        dataLabels: {
                                            enabled: true,
                                            format: '${point.y:,.0f}' // Menambahkan simbol dolar dan pemisah ribuan
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
                                        name: 'Total Sales', 
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

                            <!-- End Bagian Chart -->
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