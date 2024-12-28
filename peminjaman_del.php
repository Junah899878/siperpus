<?php
include("myconnection.php");

$id_peminjaman = $_GET['id'];

// Menghapus data peminjaman berdasarkan ID
$sql = "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman";

if(mysqli_query($koneksi, $sql)) {
    // Menyusun ulang ID agar tetap berurutan
    $reset_count_sql = "SET @count = 0";
    mysqli_query($koneksi, $reset_count_sql);

    // Memperbarui ID peminjaman
    $reorder_sql = "UPDATE peminjaman SET id_peminjaman = (@count := @count + 1)";
    mysqli_query($koneksi, $reorder_sql);

    // Mengatur ulang nilai AUTO_INCREMENT setelah ID disusun ulang
    $reset_sql = "ALTER TABLE peminjaman AUTO_INCREMENT = 1";
    mysqli_query($koneksi, $reset_sql);

    echo "Data peminjaman deleted and ID reordered!";
    header('Location: peminjaman.php');  // Redirect ke halaman peminjaman
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}
?>
