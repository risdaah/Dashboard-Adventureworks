<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "schaccount";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}