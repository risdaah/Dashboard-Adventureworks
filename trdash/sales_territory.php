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
                        <strong>UAS DWO | SALES TERRITORY </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ North America ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                        <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                           require_once "koneksi_sales.php";

                                           // Ubah 'Clothing' menjadi string yang benar dalam query
                                           $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                   FROM sales_fact sf
                                                   JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID
                                                   WHERE st.Group = 'North America'"; 

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
                                    <div class="cardName">North America</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fa-solid fa-map"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ================ Pacific ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                            
                                            // Ubah 'Clothing' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID
                                                    WHERE st.Group = 'Pacific'"; 

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
                                    <div class="cardName2">Pacific</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-map"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ================ Europe ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                            
                                            // Ubah 'Clothing' menjadi string yang benar dalam query
                                            $sql = "SELECT SUM(sf.SalesAmount) as jumlah_pembelian 
                                                    FROM sales_fact sf
                                                    JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID
                                                    WHERE st.Group = 'Europe'"; 

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
                                    <div class="cardName">Europe</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fa-solid fa-map"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ All ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php  
                                            
                                            // Query untuk mendapatkan total pendapatan dari semua grup
                                            $sql = "SELECT SUM(sf.SalesAmount) as total_pendapatan 
                                                    FROM sales_fact sf
                                                    JOIN salesterritory st ON sf.TerritoryID = st.TerritoryID";

                                            $query = mysqli_query($koneksi, $sql);

                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($koneksi));
                                            }

                                            // Tampilkan hasil
                                            $row = mysqli_fetch_assoc($query);
                                            echo "$" . number_format($row['total_pendapatan'], 0, ".", ",");

                                        ?>
                                    </div>
                                    <div class="cardName">Total Semua</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx4">
                                    <i class="fa-solid fa-map"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================ Chart ================= -->
                <div class="details">
                    <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Pendapatan Berdasarkan Wilayah</h2>
                            </div>

                            <!-- Bagian chart -->
                            <?php
                               
                                //QUERY CHART PERTAMA

                                //query untuk tahu SUM(Amount) semuanya
                                $sql = "SELECT sum(SalesAmount) as tot from sales_fact";
                                $tot = mysqli_query($koneksi,$sql);
                                $tot_amount = mysqli_fetch_row($tot);

                                //echo $tot_amount[0];

                                //query untuk ambil penjualan berdasarkan kategori, query sudah dimodifikasi
                                //ditambahkan label variabel DATA. (teknik gak jelas :D)

                                $sql = "SELECT concat('name:',st.TerritoryName) as name, concat('y:', ROUND(sum(sf.SalesAmount))) as y, concat('drilldown:', st.TerritoryName) as drilldown
                                        FROM salesterritory st
                                        JOIN sales_fact sf ON (st.TerritoryID = sf.TerritoryID)
                                        GROUP BY name
                                        ORDER BY y DESC";         
                                        //echo $sql;
                                $all_kat = mysqli_query($koneksi,$sql);
                                
                                while($row = mysqli_fetch_all($all_kat)) {
                                    $data[] = $row;
                                }
                                

                                $json_all_kat = json_encode($data);
                                
                                //CHART KEDUA (DRILL DOWN)

                                //query untuk tahu SUM(Amount) semua kategori
                                $sql = "SELECT st.TerritoryName AS TerritoryName, sum(sf.SalesAmount) as tot_kat
                                    FROM sales_fact sf
                                    JOIN salesterritory st ON (st.TerritoryID = sf.TerritoryID)
                                    GROUP BY st.TerritoryName";
                                $hasil_kat = mysqli_query($koneksi,$sql);

                                while($row = mysqli_fetch_all($hasil_kat)){
                                    $tot_all_kat[] = $row;
                                }

                                //print_r($tot_all_kat);
                                //function untuk nyari total_per_kat 

                                //echo count($tot_per_kat[0]);
                                //echo $tot_per_kat[0][0][1];
                                
                                function cari_tot_kat($kat_dicari, $tot_all_kat){
                                $counter = 0;
                                // echo $tot_all_kat[0];
                                while( $counter < count($tot_all_kat[0]) ){
                                        if($kat_dicari == $tot_all_kat[0][$counter][0]){
                                            $tot_kat = $tot_all_kat[0][$counter][1];
                                            return $tot_kat;
                                        }
                                        $counter++;        
                                }
                                }

                                //query untuk ambil penjualan di kategori berdasarkan bulan (clean)
                                $sql = "SELECT st.TerritoryName AS TerritoryName, 
                                    t.bulan AS bulan, 
                                    sum(sf.SalesAmount) AS pendapatan_kat
                                    FROM salesterritory st
                                    JOIN sales_fact sf ON (st.TerritoryID = sf.TerritoryID)
                                    JOIN time t ON (t.TimeID = sf.TimeID)
                                    GROUP BY st.TerritoryName, t.bulan";
                                $det_kat = mysqli_query($koneksi,$sql);
                            
                                while($row = mysqli_fetch_all($det_kat)) {
                                    //echo $row;
                                    $data_det[] = $row;        
                                }

                                //print_r($data_det);

                                //PERSIAPAN DATA DRILL DOWN - TEKNIK CLEAN  
                                $i = 0;

                                //inisiasi string DATA
                                $string_data = "";
                                $string_data .= '{name:"' . $data_det[0][$i][0] . '", id:"' . $data_det[0][$i][0] . '", data: [';


                                // echo cari_tot_kat("Action", $tot_all_kat);
                                foreach($data_det[0] as $a){
                                    //echo cari_tot_kat($a[0], $tot_all_kat);

                                    if($i < count($data_det[0])-1){
                                        if($a[0] != $data_det[0][$i+1][0]){
                                            $string_data .= '["' . $a[1] . '", ' . 
                                                $a[2]*100/cari_tot_kat($a[0], $tot_all_kat) . ']]},';
                                            $string_data .= '{name:"' . $a[0] . '", id:"' . $a[0]    . '", data: [';
                                        }
                                        else{
                                            $string_data .= '["' . $a[1] . '", ' . 
                                            $a[2]*100/cari_tot_kat($a[0], $tot_all_kat) . '], ';
                                        }            
                                    }
                                    else{
                                        
                                        $string_data .= '["' . $a[1] . '", ' . 
                                        $a[2]*100/cari_tot_kat($a[0], $tot_all_kat). ']]}';
                                        
                                    }      
                                    $i = $i+1;
                                }  

                                $koneksi -> close();
                            ?>

                            <figure class="highcharts-figure">
                                <div id="container"></div>
                                <p class="highcharts-description">
                                
                                </p>
                            </figure>

                            <script type="text/javascript">
                            // Create the chart
                            Highcharts.chart('container', {
                                chart: {
                                    type: 'column' // Menggunakan tipe kolom untuk chart vertikal
                                },
                                title: {
                                    text: ''
                                },
                                subtitle: {
                                    text: 'Klik di bagian balok untuk melihat detail pendapatan berdasarkan Bulan'
                                },
                                xAxis: {
                                    type: 'category', // Mengatur xAxis sebagai 
                                    title: {
                                        text: 'Bulan' // Judul sumbu X
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
                                        text: 'Jumlah Pendapatan'
                                    }
                                },

                                accessibility: {
                                    announceNewData: {
                                        enabled: true
                                    },
                                    point: {
                                        valueSuffix: '%'
                                    }
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

                                tooltip: {
                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>${point.y:,.2f}</b><br/>'
                                },


                                series: [
                                    {
                                        name: "Pendapatan Wilayah",
                                        colorByPoint: true,
                                        data: 
                                            <?php 
                                                // Format data untuk Highcharts
                                                $datanya =  $json_all_kat; 
                                                $data1 = str_replace('["','{"',$datanya) ;   
                                                $data2 = str_replace('"]','"}',$data1) ;  
                                                $data3 = str_replace('[[','[',$data2);
                                                $data4 = str_replace(']]',']',$data3);
                                                $data5 = str_replace(':','" : "',$data4);
                                                $data6 = str_replace('"name"','name',$data5);
                                                $data7 = str_replace('"drilldown"','drilldown',$data6);
                                                $data8 = str_replace('"y"','y',$data7);
                                                $data9 = str_replace('",',',',$data8);
                                                $data10 = str_replace(',y','",y',$data9);
                                                $data11 = str_replace(',y : "',',y : ',$data10);
                                                echo $data11;
                                            ?>
                                        
                                    }
                                ],

                                drilldown: {
                                    series: [
                                        <?php 
                                            echo $string_data;
                                        ?>               
                                    ]
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