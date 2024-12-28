<?php

// Menyertakan file header
include("header.php"); 

// Koneksi ke database menggunakan objek mysqli
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Menghitung jumlah buku aktif
$sql_buku_aktif = "SELECT COUNT(*) as total_aktif FROM buku WHERE status = 1";
$result_buku_aktif = $koneksi->query($sql_buku_aktif);
$buku_aktif = $result_buku_aktif->fetch_assoc()['total_aktif'];

// Menghitung jumlah buku tidak aktif
$sql_buku_tidak_aktif = "SELECT COUNT(*) as total_tidak_aktif FROM buku WHERE status = 0";
$result_buku_tidak_aktif = $koneksi->query($sql_buku_tidak_aktif);
$buku_tidak_aktif = $result_buku_tidak_aktif->fetch_assoc()['total_tidak_aktif'];

// Menghitung jumlah anggota aktif
$sql_anggota_aktif = "SELECT COUNT(*) as total_aktif FROM anggota WHERE status = 1";
$result_anggota_aktif = $koneksi->query($sql_anggota_aktif);
$anggota_aktif = $result_anggota_aktif->fetch_assoc()['total_aktif'];

// Menghitung jumlah anggota tidak aktif
$sql_anggota_tidak_aktif = "SELECT COUNT(*) as total_tidak_aktif FROM anggota WHERE status = 0";
$result_anggota_tidak_aktif = $koneksi->query($sql_anggota_tidak_aktif);
$anggota_tidak_aktif = $result_anggota_tidak_aktif->fetch_assoc()['total_tidak_aktif'];

// Mengambil data peminjaman
$sql_peminjam = "
    SELECT a.nama, b.judul
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN buku b ON p.id_buku = b.id_buku
";
$result_peminjam = $koneksi->query($sql_peminjam);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

    <style>
        /* Sidebar Style */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #2c3e50;
            color: white;
            padding-top: 30px;
            padding-left: 20px;
            transition: all 0.3s ease;
        }

        .sidebar h1 {
            font-size: 1.5rem;
            color: white;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar img {
            display: block;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            width: 170px;
            height: 170px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #34495e;
            border-radius: 5px;
            padding: 10px;
        }

        .sidebar .active {
            background-color: #1abc9c;
            border-radius: 5px;
            padding: 10px;
        }

        /* Main content area */
        .content {
            margin-left: 250px;
            padding: 30px;
        }

        /* Card statistics */
        .card-statistic {
            border-radius: 5px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .card-statistic:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        

        .card-statistic a {
            color: white;
            text-decoration: none;
        }

    .bg-active-books { background: linear-gradient(to right, #2980b9, #6dd5fa); /* medium blue to lighter blue */ } 
    .bg-inactive-books { background: linear-gradient(to right,rgb(234, 64, 64),rgb(249, 127, 143)); /* light grey to gentle pink */ } 
    .bg-active-members { background: linear-gradient(to left,rgb(88, 216, 191),rgb(9, 158, 128)); /* vibrant orange to lighter orange */ } 
    .bg-inactive-members { background: linear-gradient(to right,rgb(223, 164, 28),rgb(247, 207, 95)); /* deep purple to lighter lavender */}
        
        .card-header {
    background-color: #1abc9c; /* Hijau pastel */
    color: #333333; /* Warna teks yang lebih gelap */
    border-radius: 8px 8px 0 0; /* Sudut atas melengkung */
    font-weight: bold; /* Teks tebal */
    padding: 10px; /* Ruang di dalam header */
}
.card-statistic svg { margin-right: 15px; width: 40px; height: 40px; animation: bounce 2s infinite; } 
@keyframes bounce { 0%, 20%, 50%, 80%, 100% { transform: translateY(0); } 40% { transform: translateY(-15px); } 60% { transform: translateY(-10px); } }


        


    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <img src="https://i.pinimg.com/736x/ca/b7/da/cab7da6d6615a0ef49e3747da4211d1a.jpg" alt="Library Icon">
    <h1>SI Perpus</h1>
    <a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
    <a href="buku.php"><i class="fas fa-book"></i> Buku</a>
    <a href="anggota.php"><i class="fas fa-users"></i> Anggota</a>
    <a href="peminjaman.php"><i class="fas fa-book-reader"></i> Peminjaman</a>
    <a href="laporan.php"><i class="fas fa-chart-bar"></i> Laporan</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Main content -->
<div class="content">
    <div class="row">
        <!-- Buku Aktif -->
        <div class="col-md-3 mb-4">
            <div class="card-statistic bg-active-books">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"> <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM7 9h2v6H7zm8 0h2v6h-2z" fill="#FFF"></path> </svg>
                <h4>Buku Aktif</h4>
                <p><?php echo $buku_aktif; ?></p>
                <a href="buku.php">Lihat Buku</a>
            </div>
        </div>
        <!-- Buku Tidak Aktif -->
        <div class="col-md-3 mb-4">
            <div class="card-statistic bg-inactive-books" >
            <i class="material-icons">book_off</i>
                <h4>Buku Tidak Aktif</h4>
                <p><?php echo $buku_tidak_aktif; ?></p>
                <a href="buku.php">Lihat Buku</a>
            </div>
        </div>
        <!-- Anggota Aktif -->
        <div class="col-md-3 mb-4">
            <div class="card-statistic bg-active-members" >
            <i class="material-icons">people</i>
                <h4>Anggota Aktif</h4>
                <p><?php echo $anggota_aktif; ?></p>
                <a href="anggota.php">Lihat Anggota</a>
            </div>
        </div>
        <!-- Anggota Tidak Aktif -->
        <div class="col-md-3 mb-4">
            <div class="card-statistic bg-inactive-members">
            <i class="material-icons">person_off</i>
                <h5>Anggota Tidak Aktif</h5>
                <p><?php echo $anggota_tidak_aktif; ?></p>
                <a href="anggota.php">Lihat Anggota</a>
            </div>
        </div>

       <!-- Daftar Peminjaman -->
<div class="card">
    <div class="card-header">Daftar Peminjaman</div>
    <div class="card-body">
        <div class="row">
            <?php
            if ($result_peminjam->num_rows > 0) {
                while ($row = $result_peminjam->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary"><i class="fas fa-user"></i> <?php echo $row['nama']; ?></h5>
                                <p class="card-text">
                                    <i class="fas fa-book text-success"></i> <strong><?php echo $row['judul']; ?></strong>
                                </p>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <span class="badge bg-info">Dipinjam</span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>Tidak ada peminjaman yang tercatat.</p></div>";
            }
            ?>
        </div>
    </div>
</div>


<?php 
// Menyertakan file footer
include("footer.php"); 

// Menutup koneksi
$koneksi->close();
?> 

<!-- Include jQuery, DataTables JS, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
