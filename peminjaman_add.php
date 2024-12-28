<?php
    include("myconnection.php");

    // Ambil data buku dari tabel buku
$sql_buku = "SELECT id_buku, judul FROM buku";
$result_buku = $koneksi->query($sql_buku);
// mengeCek apakah data berhasil diambil
if (!$result_buku) {
    die("Error: " . $koneksi->error);
}

// menyiapkan data buku
$bukuOptions = [];
while ($row = $result_buku->fetch_assoc()) {
    $bukuOptions[] = $row;
}

// Ambil data anggota dari tabel anggota
$sql_anggota = "SELECT id_anggota, nama  FROM anggota";
$result_anggota = $koneksi->query($sql_anggota);
// mengecek apakah data berhasil diambil
if (!$result_anggota) {
    die("Error: ". $koneksi->error);
}
//menyiapkan data angggota
$anggotaOptions = [];
while ($row = $result_anggota->fetch_assoc()) {
    $anggotaOptions[] = $row;

}

if(isset($_POST['simpan'])){
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_buku = $_POST['id_buku'];
    $id_anggota= $_POST['id_anggota'];
    $tanggal_pinjam= $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $sql = "INSERT INTO peminjaman(id_peminjaman, id_buku, id_anggota, tanggal_pinjam, tanggal_kembali) VALUES('$id_peminjaman', '$id_buku','$id_anggota', '$tanggal_pinjam', '$tanggal_kembali')";

    $query = mysqli_query($koneksi, $sql);

    if($query){
        header("Location:peminjaman.php");
    }else{
        die("Eror!");
    }
}

?>

<?php include("header.php"); ?>

    <h2>FORM Tambah Peminjaman</h2>
    
    <form action="" method="post">

    <label for="id_buku">Pilih Buku:</label>
    <select id="id_buku" name="id_buku" onchange="updateJudulBuku()" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?php
            // Tampilkan opsi buku berdasarkan id_buku
            foreach ($bukuOptions as $buku) {
                echo "<option value='" . $buku['id_buku'] . "'>" . $buku['judul'] . "</option>";
            }
            ?>
        </select>

    <!-- ID Anggota (List View) -->
    <label for="id_anggota">Pilih Anggota:</label>
    <select id="id_anggota" name="id_anggota" onchange="updateNamaAnggota()" class="form-control">
            <option value="">-- Pilih Nama Anggota --</option>
            <?php
            // Tampilkan opsi buku berdasarkan id_buku
            foreach ($anggotaOptions as $anggota) {
                echo "<option value='" . $anggota['id_anggota'] . "'>" . $anggota['nama'] . "</option>";
            }
            ?>
        </select>
    
        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control">
        <br>

        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control">
        <br>

        <input type="submit" value="Simpan" name="simpan" class="btn btn-success">
        
    </form>
    
<?php include("footer.php"); ?>