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
                        <strong>UAS DWO | PURCHASE PRODUCT </strong>
                    </div>

                    <div class="user">
                        <?php echo $_SESSION['nama']; ?>
                        <img src="images/profile-pic.jpeg" alt="">
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                
                    <!-- ================ Pengeluaran 2011 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php 
                                            require_once "koneksi_purchasing.php";
                                      
                                            $sql = "SELECT SUM(pf.TotalCost) as jumlah_pembelian from purchasing_fact pf
                                            JOIN time t ON pf.TimeID = t.TimeID
                                            WHERE tahun = 2011";
                                                
                                                $query = mysqli_query($mysqli, $sql);
                                                
                                                // Debugging jika query gagal
                                                if (!$query) {
                                                    die("Query Error: " . mysqli_error($mysqli));
                                                }
                                                
                                                // Tampilkan hasil
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                                }   
                                                
                                        ?>  
                                    </div>
                                    <div class="cardName">Pengeluaran 2011</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ================ Pengeluaran 2012 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php   

                                            $sql = "SELECT SUM(pf.TotalCost) as jumlah_pembelian from purchasing_fact pf
                                            JOIN time t ON pf.TimeID = t.TimeID
                                            WHERE tahun = 2012";
                                                    
                                            $query = mysqli_query($mysqli, $sql);
                                                    
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }
                                                    
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                            echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            }     
                                            
                                        ?>  
                                    </div>
                                    <div class="cardName">Pengeluaran 2012</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx2">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Pengeluaran 2013 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                            <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php                                            

                                            $sql = "SELECT SUM(pf.TotalCost) as jumlah_pembelian from purchasing_fact pf
                                            JOIN time t ON pf.TimeID = t.TimeID
                                            WHERE tahun = 2013";
                                                    
                                            $query = mysqli_query($mysqli, $sql);
                                                    
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }
                                                    
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                            echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            }    
                                            
                                        ?>  
                                    </div>
                                    <div class="cardName">Pengeluaran 2013</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconBx3">
                                    <i class="fa-solid fa-calendar-days"></i>   
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================ Pengeluaran 2014 ================= -->
                    <div class="card">
                        <div class="row g-0">                            
                            <div class="col-md-8">
                                <div class="card-body py-4">
                                    <div class="numbers3">
                                        <?php                                             

                                            $sql = "SELECT SUM(pf.TotalCost) as jumlah_pembelian from purchasing_fact pf
                                            JOIN time t ON pf.TimeID = t.TimeID
                                            WHERE tahun = 2013";
                                                        
                                            $query = mysqli_query($mysqli, $sql);
                                                        
                                            // Debugging jika query gagal
                                            if (!$query) {
                                                die("Query Error: " . mysqli_error($mysqli));
                                            }
                                                        
                                            // Tampilkan hasil
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                echo "$" . number_format($row2['jumlah_pembelian'], 0, ".", ",");
                                            } 
                                            
                                        ?> 
                                    </div>
                                    <div class="cardName">Pengeluaran 2014</div>
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
                            <h2>Pengeluaran Berdasarkan Sub Kategori</h2>
                        </div>

                        <!-- Bagian Chart -->
                        <?php                          

                            //QUERY CHART PERTAMA

                            $sql = "SELECT sum(TotalCost) as tot from purchasing_fact";
                            $tot = mysqli_query($mysqli,$sql);
                            $tot_amount = mysqli_fetch_row($tot);

                        
                            $sql = "SELECT concat('name:', p.ProductSubCategory) as name, 
                                        concat('y:', ROUND(sum(pf.TotalCost))) as y, 
                                        concat('drilldown:', p.ProductSubCategory) as drilldown
                                    FROM product p
                                    JOIN purchasing_fact pf ON (p.ProductID = pf.ProductID)
                                    GROUP BY name
                                    ORDER BY y DESC";        
                                    //echo $sql;
                            $all_kat = mysqli_query($mysqli,$sql);
                            
                            while($row = mysqli_fetch_all($all_kat)) {
                                $data[] = $row;
                            }
                            
                            $json_all_kat = json_encode($data);
                            
                            //CHART KEDUA (DRILL DOWN)

                            $sql = "SELECT p.ProductSubCategory AS ProductSubCategory, sum(pf.TotalCost) as tot_kat
                                FROM product p
                                JOIN purchasing_fact pf ON (p.ProductID = pf.ProductID)
                                GROUP BY p.ProductSubCategory";
                            $hasil_kat = mysqli_query($mysqli,$sql);

                            while($row = mysqli_fetch_all($hasil_kat)){
                                $tot_all_kat[] = $row;
                            }
                            
                            function cari_tot_kat($kat_dicari, $tot_all_kat){
                            $counter = 0;
                            while( $counter < count($tot_all_kat[0]) ){
                                    if($kat_dicari == $tot_all_kat[0][$counter][0]){
                                        $tot_kat = $tot_all_kat[0][$counter][1];
                                        return $tot_kat;
                                    }
                                    $counter++;        
                                }
                            }

                            //query untuk ambil penjualan di kategori berdasarkan bulan (clean)
                            $sql = "SELECT p.ProductSubCategory AS ProductSubCategory, 
                                t.bulan AS bulan, 
                                sum(pf.TotalCost) AS pendapatan_kat
                                FROM product p
                                JOIN purchasing_fact pf ON (p.ProductID = pf.ProductID)
                                JOIN time t ON (t.TimeID = pf.TimeID)
                                GROUP BY p.ProductSubCategory, t.bulan";
                            $det_kat = mysqli_query($mysqli,$sql);
                        
                            while($row = mysqli_fetch_all($det_kat)) {
                                //echo $row;
                                $data_det[] = $row;        
                            }

                            //PERSIAPAN DATA DRILL DOWN - TEKNIK CLEAN  
                            $i = 0;

                            //inisiasi string DATA
                            $string_data = "";
                            $string_data .= '{name:"' . $data_det[0][$i][0] . '", id:"' . $data_det[0][$i][0] . '", data: [';

                            foreach($data_det[0] as $a){

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

                        ?>
                        
                        <!-- Tampilan Chart -->
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
                                text: 'Klik di bagian balok untuk melihat detail pengeluaran berdasarkan Bulan'
                            },
                            xAxis: {
                                type: 'category', // Mengatur xAxis sebagai kategori
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
                                    text: 'Total Biaya'
                                },
                                
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
                                    name: "Biaya Berdasarkan Sub Kategori",
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
                                            $mysqli->close();
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