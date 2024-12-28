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
                        <strong>UAS DWO | PURCHASE LOCATION </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Lokasi Warehouse ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                        <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers">
                                        <?php  
                                            require_once "koneksi_purchasing.php";

                                            // Memeriksa koneksi
                                            if (!$mysqli) {
                                                die("Koneksi gagal: " . mysqli_connect_error());
                                            }

                                            // Query untuk menghitung jumlah pelanggan unik
                                            $sql = "SELECT COUNT(DISTINCT LocationID) as jumlah_lokasi FROM purchasing_fact";
                                            $query = mysqli_query($mysqli, $sql);

                                            // Memeriksa eksekusi query
                                            if (!$query) {
                                                die("Error SQL: " . mysqli_error($mysqli));
                                            }

                                            // Menampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                echo number_format($row2['jumlah_lokasi'], 0, ".", ","); // Format angka
                                            }

                                        ?>
                                    </div>
                                    <div class="cardName">Jumlah Lokasi</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fas fa-map-pin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ================ Barang Masuk ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php  

                                            $sql = "SELECT SUM(pf.ReceivedQty) as jumlah_barang from purchasing_fact pf";
                                            $query = mysqli_query($mysqli, $sql);
                                            if ($query) {
                                                $row2 = mysqli_fetch_array($query);
                                                if ($row2) {
                                                    echo number_format($row2['jumlah_barang'], 0, ".", ",");
                                                } else {
                                                    echo "Tidak ada data.";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($mysqli);
                                            }

                                        ?>
                                    </div>
                                    <div class="cardName2">Barang Masuk</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ================ Barang Ditolak ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers">
                                        <?php  

                                            $sql = "SELECT SUM(pf.RejectedQty) as jumlah_barang from purchasing_fact pf";
                                            $query = mysqli_query($mysqli, $sql);
                                            if ($query) {
                                                $row2 = mysqli_fetch_array($query);
                                                if ($row2) {
                                                    echo number_format($row2['jumlah_barang'], 0, ".", ",");
                                                } else {
                                                    echo "Tidak ada data.";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($mysqli);
                                            }

                                        ?>
                                    </div>
                                    <div class="cardName">Barang Ditolak</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fas fa-square-xmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Barang yang Diantar ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers">
                                        <?php  

                                            $sql = "SELECT SUM(pf.OnOrderQty) as jumlah_barang from purchasing_fact pf";
                                            $query = mysqli_query($mysqli, $sql);
                                            if ($query) {
                                                $row2 = mysqli_fetch_array($query);
                                                if ($row2) {
                                                    echo number_format($row2['jumlah_barang'], 0, ".", ",");
                                                } else {
                                                    echo "Tidak ada data.";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($mysqli);
                                            }

                                        ?>
                                        </div>
                                    <div class="cardName">Proses Antar</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx4">
                                    <i class="fas fa-truck-pickup"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================ Chart ================= -->
                <div class="details">
                    <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Jumlah Stock di Lokasi Penyimpanan</h2>
                            </div>

                           <!-- Bagian chart --> 
                           <?php

                                // Hitung total ReceivedQty keseluruhan untuk persentase
                                $total_received_qty = 0;
                                $sum_sql = "SELECT SUM(pf.ReceivedQty) AS total_qty FROM purchasing_fact pf";
                                $sum_result = mysqli_query($mysqli, $sum_sql);
                                if ($sum_result) {
                                    $sum_row = mysqli_fetch_assoc($sum_result);
                                    $total_received_qty = (int)$sum_row['total_qty'];
                                }

                                // Query utama untuk mendapatkan data lokasi
                                $sql = "
                                    SELECT sl.LocationName AS name, SUM(pf.ReceivedQty) AS total_qty
                                    FROM storage_location sl
                                    JOIN purchasing_fact pf ON sl.LocationID = pf.LocationID
                                    GROUP BY sl.LocationName
                                ";

                                $result = mysqli_query($mysqli, $sql);

                                if (!$result) {
                                    die("Query gagal: " . mysqli_error($mysqli));
                                }

                                $data = []; // Data untuk pie chart
                                $drilldown_data = []; // Data untuk drilldown

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $location_name = $row['name'];
                                    $total_qty = (int)$row['total_qty'];

                                    // Hitung persentase lokasi
                                    $percentage = ($total_qty / $total_received_qty) * 100;

                                    // Tambahkan data lokasi ke array utama dengan persentase
                                    $data[] = [
                                        'name' => $location_name,
                                        'y' => $percentage, // Menampilkan persentase untuk lokasi utama
                                        'drilldown' => $location_name
                                    ];

                                    // Query untuk mendapatkan kategori produk berdasarkan lokasi
                                    $sub_sql = "
                                        SELECT p.ProductCategory AS category, SUM(pf.ReceivedQty) AS jumlah_unit
                                        FROM product p
                                        JOIN purchasing_fact pf ON p.ProductID = pf.ProductID
                                        JOIN storage_location sl ON sl.LocationID = pf.LocationID
                                        WHERE sl.LocationName = '$location_name'
                                        GROUP BY p.ProductCategory
                                    ";

                                    $sub_result = mysqli_query($mysqli, $sub_sql);

                                    $subcategory = [];
                                    while ($sub_row = mysqli_fetch_assoc($sub_result)) {
                                        $jumlah_unit = (int)$sub_row['jumlah_unit'];

                                        // Tambahkan data subkategori dengan jumlah unit
                                        $subcategory[] = [
                                            $sub_row['category'], // Nama kategori produk
                                            $jumlah_unit // Jumlah unit untuk subkategori
                                        ];
                                    }

                                    // Tambahkan data drilldown berdasarkan lokasi
                                    $drilldown_data[] = [
                                        'id' => $location_name,
                                        'name' => "Kategori di $location_name",
                                        'data' => $subcategory
                                    ];
                                }

                                $json_data = json_encode($data); // Data utama
                                $json_drilldown_data = json_encode($drilldown_data); // Data drilldown

                                $mysqli->close();

                                ?>

                                <!-- Tampilan Chart -->
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                    <p class="highcharts-description"></p>
                                </figure>

                                <script type="text/javascript">
                                    // Data dari PHP
                                    const locationData = <?php echo $json_data; ?>;
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
                                            text: 'Klik di potongan chart untuk melihat Detail Jumlah Unit berdasarkan Kategori'
                                        },
                                        plotOptions: {
                                            series: {
                                                dataLabels: {
                                                    enabled: true,
                                                    formatter: function() {
                                                        if (this.series.name === "Lokasi") {
                                                            return `${this.point.name}: <br/>${this.y.toFixed(2)}%`; // Persentase untuk lokasi utama
                                                        } else {
                                                            return `${this.point.name}: <br/>${this.y.toLocaleString()} unit`; // Jumlah unit untuk kategori
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
                                                if (this.series.name === "Lokasi") {
                                                    // Tooltip untuk lokasi utama (persentase)
                                                    return `<b>${this.point.name}</b><br/>${this.y.toFixed(2)}% dari total`;
                                                } else {
                                                    // Tooltip untuk kategori (jumlah unit)
                                                    return `<b>${this.point.name}</b><br/>${this.y.toLocaleString()} unit`;
                                                }
                                            }
                                        },
                                        series: [{
                                            name: 'Lokasi',
                                            colorByPoint: true,
                                            data: locationData // Data lokasi utama
                                        }],
                                        drilldown: {
                                            series: drilldownData // Data drilldown (kategori)
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