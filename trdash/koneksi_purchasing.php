<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "schpurchasing";

$mysqli = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$mysqli) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>