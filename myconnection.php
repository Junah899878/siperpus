<?php
$host = "localhost";  // Nama host, biasanya localhost
$uname = "root";      // Username database
$pword = "";          // Password, biasanya kosong pada XAMPP
$dbname = "perpustakaan";  // Nama database Anda

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $uname, $pword, $dbname);

// Mengecek koneksi
if(!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
