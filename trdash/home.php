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
    <link rel="stylesheet" href="home.css">
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
                        <strong>UAS DWO | DASHBOARD </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Card Customer ================= -->
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers">
                                        <?php  
                                            require_once "koneksi_sales.php";

                                            // Query untuk menghitung jumlah pelanggan unik
                                            $sql = "SELECT COUNT(DISTINCT CustomerID) as jumlah_customer FROM sales_fact";
                                            $query = mysqli_query($koneksi, $sql);

                                            // Menampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                echo number_format($row2['jumlah_customer'], 0, ".", ","); // Format angka
                                            }

                                            
                                        ?>
                                    </div>
                                    <div class="cardName">Jumlah Pelanggan</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- ================ Card Produk ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers">
                                        <?php                                              
                                            $sql = "SELECT SUM(sf.Quantity) as jumlah_produk from sales_fact sf";
                                            $query = mysqli_query($koneksi, $sql);
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                echo number_format($row2['jumlah_produk'], 0, ".", ","); // Format angka
                                            }                                            
                                        ?>
                                    </div>
                                    <div class="cardName">Penjualan Produk</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Card Penjualan ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php                                    

                                            $sql = "SELECT SUM(SalesAmount) as total_penjualan from sales_fact";
                                            $query = mysqli_query($koneksi,$sql);
                                            while($row2=mysqli_fetch_array($query)){
                                                echo "$".number_format($row2['total_penjualan'],0,".",",");
                                            }
                                        ?>  
                                    </div>
                                    <div class="cardName2">Total Penjualan</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Card Pengeluaran ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                            <div class="card-body py-4">
                                    <div class="numbers2">
                                        <?php  
                                            require_once "koneksi_purchasing.php";

                                            $sql = "SELECT SUM(TotalCost) as total_pengeluaran from purchasing_fact";
                                            $query = mysqli_query($mysqli,$sql);
                                            while($row2=mysqli_fetch_array($query)){
                                                echo "$".number_format($row2['total_pengeluaran'],0,".",",");
                                            }

                                        ?>  
                                    </div>
                                    <div class="cardName2">Total Pengeluaran</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx4">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================ Details ================= -->
                <div class="details">

                    <!-- ================ Top 10 Pelanggan ================= -->
                    <div class="firstSection">
                        <div class="cardHeader">
                            <h2>Top 10 Pelanggan</h2>  
                            <i class="fa-solid fa-up-long"></i>                       
                        </div>
                            <?php

                                if (!$koneksi || $koneksi->connect_errno) {
                                    die("Koneksi tidak aktif: " . $koneksi->connect_error);
                                }

                                $sql = "SELECT c.CustomerID, 
                                            c.CustomerName, 
                                            COUNT(sf.SalesID) as BanyakTransaksi, 
                                            SUM(sf.SalesAmount) as TotalPembelian,
                                            st.TerritoryName
                                        FROM sales_fact sf
                                        JOIN customer c ON sf.CustomerID = c.CustomerID
                                        JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID
                                        GROUP BY c.CustomerID, c.CustomerName
                                        ORDER BY TotalPembelian DESC
                                        LIMIT 10";
                                $result = mysqli_query($koneksi, $sql);

                                if (!$result) {
                                    die("Error pada query: " . mysqli_error($koneksi));
                                }
                                
                            ?>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Transaksi</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Wilayah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['CustomerID']; ?></th>
                                        <td><?php echo $row['CustomerName']; ?></td>
                                        <td><?php echo $row['BanyakTransaksi']; ?></td>
                                        <td class="text-success"><?php echo '$ '.number_format($row['TotalPembelian'], 2, ".", ","); ?></td>
                                        <td><?php echo $row['TerritoryName']; ?></td>
                                    </tr>
                                <?php endwhile; 
                                    
                                ?>
                                
                            </tbody>
                        </table>
                    </div>

                    <!-- ================ Penjualan Pertahun ================= -->
                    <div class="secondSection"> 
                        <div class="cardHeader">
                            <h2>Penjualan Pertahun</h2> 
                            <i class="fa-solid fa-chart-simple"></i>  
                        </div>
                        <?php
                            
                            // QUERY TOTAL PENJUALAN
                            // query untuk menghitung total penjualan per tahun
                            $sql = "SELECT 
                                        t.Tahun AS Tahun, 
                                        COUNT(sf.SalesID) AS BanyakPembelian
                                    FROM 
                                        sales_fact sf
                                    JOIN 
                                        time t ON t.TimeID = sf.TimeID
                                    GROUP BY 
                                        t.Tahun
                                    ORDER BY 
                                        t.Tahun ASC";

                            $result = mysqli_query($koneksi, $sql);

                            // Debug error query
                            if (!$result) {
                                die("Error SQL: " . mysqli_error($koneksi));
                            }

                            // Ambil hasil query
                            $data_per_tahun = [];
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $data_per_tahun[] = [
                                        'Tahun' => $row['Tahun'],
                                        'BanyakPembelian' => (int)$row['BanyakPembelian']
                                    ];
                                }
                            } else {
                                die("Tidak ada data yang ditemukan.");
                            }

                            // Encode data ke JSON untuk digunakan di JavaScript
                            $json_chart_data = json_encode($data_per_tahun);
                            echo "<script>console.log(" . $json_chart_data . ");</script>"; // Debug data

                          
                        ?>
                        
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>

                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script type="text/javascript">
                            // Data Chart
                            const chartData = <?php echo $json_chart_data; ?>; 

                            // Format data untuk Highcharts
                            const categories = chartData.map(item => item.Tahun);
                            const salesData = chartData.map(item => item.BanyakPembelian); 

                            // Create Chart
                            Highcharts.chart('container', {
                                chart: {
                                    type: 'area'
                                },
                                title: {
                                    text: ''
                                },
                                xAxis: {
                                    title: {
                                        text: 'Tahun'
                                    },
                                    categories: categories
                                },
                                yAxis: {
                                    title: {
                                        text: 'Banyak Penjualan'
                                    },
                                    labels: {
                                        formatter: function () {
                                            return this.value.toLocaleString();
                                        }
                                    }
                                },
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true 
                                        },
                                        color: '#4dbfc0', 
                                        fillColor: {
                                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                            stops: [
                                                [0, 'rgba(77, 191, 192, 1)'], // Warna di atas (warna garis)
                                                [1, 'rgba(255, 255, 255, 0)'] // Warna di bawah (transparan)
                                            ]
                                        }
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px; font-weight:700"><b>{point.key}</b></span><br/>',
                                    pointFormat: 'Banyak Penjualan: <b>{point.y}</b>'
                                },
                                series: [{
                                    name: 'Banyak Penjualan',
                                    data: salesData,
                                    color: '#4dbfc0' 
                                }]
                            });
                        </script>
                    </div>

                    <!-- ================ Top 10 Penjualan Produk ================= -->
                    <div class="thirdSection">
                        <div class="cardHeader">
                            <h2>Top 10 Penjualan Produk</h2>
                            <i class="fa-solid fa-up-long"></i>
                        </div>
                        <?php
                            
                            $sql = "SELECT p.ProductID, 
                                        p.ProductName, 
                                        COUNT(sf.Quantity) as BanyakTerjual, 
                                        SUM(sf.SalesAmount) as TotalPendapatan,
                                        st.TerritoryName
                                    FROM sales_fact sf
                                    JOIN product p ON sf.ProductID = p.ProductID
                                    JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID
                                    GROUP BY p.ProductID, p.ProductName
                                    ORDER BY TotalPendapatan DESC
                                    LIMIT 10";
                            $result = mysqli_query($koneksi, $sql);

                            if (!$result) {
                                die("Error pada query: " . mysqli_error($koneksi));
                            }
                            
                            $koneksi -> close();
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Penjualan</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Wilayah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['ProductID']; ?></th>
                                        <td><?php echo $row['ProductName']; ?></td>
                                        <td><?php echo $row['BanyakTerjual']; ?></td>
                                        <td class="text-success"><?php echo '$ '.number_format($row['TotalPendapatan'], 2, ".", ","); ?></td>
                                        <td><?php echo $row['TerritoryName']; ?></td>
                                    </tr>
                                <?php endwhile; 
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================ Pembelian Pertahun ================= -->
                    <div class="fourthSection">
                        <div class="cardHeader">
                            <h2>Pembelian ke Vendor Pertahun</h2>
                            <i class="fa-solid fa-chart-simple"></i>  
                        </div>
                        <?php

                            // QUERY TOTAL PEMBELIAN
                            $sql = "SELECT 
                                        t.Tahun AS Tahun, 
                                        COUNT(pf.PurchaseOrderID) AS BanyakPembelian
                                    FROM 
                                        purchasing_fact pf
                                    JOIN 
                                        time t ON t.TimeID = pf.TimeID
                                    GROUP BY 
                                        t.Tahun
                                    ORDER BY 
                                        t.Tahun ASC";

                            $result = mysqli_query($mysqli, $sql);

                            if (!$result) {
                                die("Error SQL: " . mysqli_error($mysqli));
                            }

                            // Ambil hasil query
                            $dataPembelian = [];
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $dataPembelian[] = [
                                        'Tahun' => $row['Tahun'],
                                        'BanyakPembelian' => (int)$row['BanyakPembelian']
                                    ];
                                }
                            }

                            // Encode data ke JSON untuk digunakan di JavaScript
                            $jsonDataChart = json_encode($dataPembelian);

                            $mysqli -> close();
                            
                        ?>

                        <figure class="highcharts-figure">
                            <div id="chartContainer"></div>
                        </figure>

                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script type="text/javascript">
                            // Data Chart
                            const chartDataPembelian = <?php echo $jsonDataChart; ?>; 

                            // Format data untuk Highcharts
                            const tahunCategories = chartDataPembelian.map(item => item.Tahun);
                            const pembelianData = chartDataPembelian.map(item => item.BanyakPembelian); 

                            console.log('Tahun:', tahunCategories); // Debug data
                            console.log('Data Pembelian:', pembelianData);   // Debug data

                            // Create Chart
                            Highcharts.chart('chartContainer', {
                                chart: {
                                    type: 'area'
                                },
                                title: {
                                    text: ''
                                },
                                xAxis: {
                                    title: {
                                        text: 'Tahun'
                                    },
                                    categories: tahunCategories // Pastikan ini benar
                                },
                                yAxis: {
                                    title: {
                                        text: 'Banyak Pembelian'
                                    },
                                    labels: {
                                        formatter: function () {
                                            return this.value.toLocaleString();
                                        }
                                    }
                                },
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true 
                                        },
                                        color: '#9061f1', 
                                        fillColor: {
                                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                            stops: [
                                                [0, 'rgba(144, 97, 241, 1)'], // Warna di atas (warna garis)
                                                [1, 'rgba(255, 255, 255, 0)'] // Warna di bawah (transparan)
                                            ]
                                        }
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px; font-weight:700"><b>{point.key}</b></span><br/>',
                                    pointFormat: 'Banyak Pembelian: <b>{point.y}</b>'
                                },
                                series: [{
                                    name: 'Banyak Pembelian',
                                    data: pembelianData,
                                    color: '#9061f1' 
                                }]
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