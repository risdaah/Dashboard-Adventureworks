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
                        <strong>UAS DWO | SALES ORDER </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Pendapatan Components ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                        <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">

                                        <?php  
                                            require_once "koneksi_sales.php";

                                            // Cek koneksi
                                            if (!$koneksi) {
                                                die("Koneksi gagal: " . mysqli_connect_error());
                                            }

                                            // Ubah 'Components' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN product p ON sf.ProductID = p.ProductID
                                                    WHERE p.ProductCategory = 'Components'"; 

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
                    
                    <!-- ================ Pendapatan Accessories ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">

                                        <?php  
                                            
                                            // Ubah 'Accessories' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN product p ON sf.ProductID = p.ProductID
                                                    WHERE p.ProductCategory = 'Accessories'"; 

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
                                    <div class="cardName2">Accessories</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ================ Pendapatan Bikes ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                            
                                            // Cek koneksi
                                            if (!$koneksi) {
                                                die("Koneksi gagal: " . mysqli_connect_error());
                                            }

                                            // Ubah 'Bikes' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN product p ON sf.ProductID = p.ProductID
                                                    WHERE p.ProductCategory = 'Bikes'"; 

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

                    <!-- ================ Pendapatan Clothing ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                            
                                            // Cek koneksi
                                            if (!$koneksi) {
                                                die("Koneksi gagal: " . mysqli_connect_error());
                                            }

                                            // Ubah 'Clothing' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN product p ON sf.ProductID = p.ProductID
                                                    WHERE p.ProductCategory = 'Clothing'"; 

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
                </div>

                <!-- ================ Chart ================= -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Penjualan Berdasarkan Kategori</h2>
                        </div>                          
                        
                        <!-- Bagian chart -->
                        <?php
                            // Koneksi database
                            $dbHost = "localhost";
                            $dbDatabase = "schsales";
                            $dbUser = "root";
                            $dbPassword = "";

                            $mysqli = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);

                            // Hitung total quantity keseluruhan untuk persentase
                            $total_quantity_all = 0;
                            $sum_sql = "SELECT SUM(sf.Quantity) AS total_quantity FROM sales_fact sf";
                            $sum_result = mysqli_query($mysqli, $sum_sql);
                            if ($sum_result) {
                                $sum_row = mysqli_fetch_assoc($sum_result);
                                $total_quantity_all = (int)$sum_row['total_quantity'];
                            }

                            // Query utama untuk mendapatkan data kategori
                            $sql = "SELECT p.ProductCategory AS category, SUM(sf.Quantity) AS total_quantity
                                    FROM product p
                                    JOIN sales_fact sf ON p.ProductID = sf.ProductID
                                    GROUP BY p.ProductCategory";

                            $result = mysqli_query($mysqli, $sql);

                            if (!$result) {
                                die("Query gagal: " . mysqli_error($mysqli));
                            }

                            $data = []; // Data untuk pie chart
                            $drilldown_data = []; // Data untuk drilldown

                            while ($row = mysqli_fetch_assoc($result)) {
                                $category_name = $row['category'];
                                $total_quantity = (int)$row['total_quantity'];

                                // Hitung persentase kategori
                                $percentage = ($total_quantity / $total_quantity_all) * 100;

                                // Tambahkan data kategori ke array utama dengan persentase
                                $data[] = [
                                    'name' => $category_name,
                                    'y' => $percentage,  // Menampilkan persentase untuk kategori utama
                                    'drilldown' => $category_name
                                ];

                                // Query untuk mendapatkan SubCategory berdasarkan kategori
                                $sub_sql = "SELECT p.ProductSubCategory AS subcategory, SUM(sf.Quantity) AS total_quantity
                                            FROM product p
                                            JOIN sales_fact sf ON p.ProductID = sf.ProductID
                                            WHERE p.ProductCategory = '$category_name'
                                            GROUP BY p.ProductSubCategory";

                                $sub_result = mysqli_query($mysqli, $sub_sql);

                                $subcategory = [];
                                while ($sub_row = mysqli_fetch_assoc($sub_result)) {
                                    $sub_total_quantity = (int)$sub_row['total_quantity'];

                                    // Tambahkan data subkategori dengan jumlah unit
                                    $subcategory[] = [
                                        $sub_row['subcategory'],
                                        $sub_total_quantity // Menampilkan jumlah unit untuk subkategori
                                    ];
                                }

                                // Tambahkan data drilldown berdasarkan kategori
                                $drilldown_data[] = [
                                    'id' => $category_name,
                                    'name' => "SubCategory dari $category_name",
                                    'data' => $subcategory
                                ];
                            }

                            $json_data = json_encode($data); // Data utama
                            $json_drilldown_data = json_encode($drilldown_data); // Data drilldown
                        ?>

                        <!-- Tampilan Chart -->
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description"></p>
                        </figure>

                        <script type="text/javascript">
                            // Data dari PHP
                            const category = <?php echo $json_data; ?>;
                            const drilldownData = <?php echo $json_drilldown_data; ?>;

                            // Buat pie chart dengan drilldown
                            Highcharts.chart('container', {
                                chart: {
                                    type: 'pie'
                                },
                                title: {
                                    text: ''
                                },
                                subtitle: {
                                    text: 'Klik di potongan chart untuk melihat Detail Jumlah Unit berdasarkan Sub Kategori'
                                },
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true,
                                            formatter: function() {
                                                if (this.series.name === "Category") {
                                                    return `${this.point.name}: <br/>${this.y.toFixed(2)}%`; // Menampilkan persentase untuk kategori utama
                                                } else {
                                                    return `${this.point.name}: <br/>${this.y.toLocaleString()} unit`; // Menampilkan jumlah unit untuk subkategori
                                                }
                                            }
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
                                tooltip: {
                                    formatter: function() {
                                        if (this.series.name === "Category") {
                                            // Tooltip untuk kategori utama (persentase)
                                            return `<b>${this.point.name}</b><br/>${this.y.toFixed(2)}% dari total`;
                                        } else {
                                            // Tooltip untuk subkategori (jumlah unit)
                                            return `<b>${this.point.name}</b><br/>${this.y.toLocaleString()} unit`;
                                        }
                                    }
                                },
                                series: [{
                                    name: 'Category',
                                    colorByPoint: true,
                                    data: category // Data kategori utama
                                }],
                                drilldown: {
                                    series: drilldownData // Data drilldown (SubCategory)
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