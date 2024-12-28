<?php
include("myconnection.php");

// Mendapatkan data peminjaman berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT peminjaman.*, anggota.nama, buku.judul 
            FROM peminjaman
            JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
            JOIN buku ON peminjaman.id_buku = buku.id_buku
            WHERE id_peminjaman = $id";
    $query = mysqli_query($koneksi, $sql);

    if (!$query) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_array($query);
}

// Mengupdate data peminjaman
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $sql = "UPDATE peminjaman 
            SET id_buku = '$id_buku', id_anggota = '$id_anggota', 
                tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali'
            WHERE id_peminjaman = $id";

    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header("Location:peminjaman.php");
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5">
    <h2>Form Edit Peminjaman</h2>
    <form action="" method="post" class="mt-4">
        <div class="mb-3">
            <label for="id_buku" class="form-label">Judul Buku</label>
            <select name="id_buku" class="form-control" required>
                <?php
                $sql_buku = "SELECT * FROM buku WHERE status = '1'";
                $query_buku = mysqli_query($koneksi, $sql_buku);
                while ($buku = mysqli_fetch_array($query_buku)) {
                    $selected = ($buku['id_buku'] == $data['id_buku']) ? "selected" : "";
                    echo "<option value='{$buku['id_buku']}' $selected>{$buku['judul']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_anggota" class="form-label">Nama Anggota</label>
            <select name="id_anggota" class="form-control" required>
                <?php
                $sql_anggota = "SELECT * FROM anggota WHERE status = '1'";
                $query_anggota = mysqli_query($koneksi, $sql_anggota);
                while ($anggota = mysqli_fetch_array($query_anggota)) {
                    $selected = ($anggota['id_anggota'] == $data['id_anggota']) ? "selected" : "";
                    echo "<option value='{$anggota['id_anggota']}' $selected>{$anggota['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" 
                   value="<?= $data['tanggal_pinjam'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" 
                   value="<?= $data['tanggal_kembali'] ?>" required>
        </div>

        <input type="hidden" name="id" value="<?= $data['id_peminjaman'] ?>">
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </form>
</div>

<?php include("footer.php"); ?>