<?php 
include("myconnection.php");

$sql = "SELECT 
    peminjaman.id_peminjaman,
    buku.judul,
    buku.cover,
    anggota.nama,
    peminjaman.tanggal_pinjam,
    peminjaman.tanggal_kembali
FROM 
    peminjaman
INNER JOIN 
    buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN 
    anggota ON peminjaman.id_anggota = anggota.id_anggota;
";

$query = mysqli_query($koneksi, $sql);

?>

<?php include("header.php"); ?>

<h2>Data Peminjaman</h2>
<p><a href="peminjaman_add.php" class="btn btn-success">Form Tambah Peminjaman</a></p>


<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css">

<table id="dataTable" class="table table-hover table-striped">
    <thead>
    <tr>
        <th>ID Peminjaman</th>
        <th>Cover</th>
        <th>Judul Buku</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Opsi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Menampilkan data peminjaman dengan menggabungkan data buku dan anggota
    while($data = mysqli_fetch_assoc($query)){
        echo "<tr>";
        echo "<td>".$data['id_peminjaman']."</td>";
        echo "<td><img src='cover/".$data['cover']."' alt='cover' width='50'></td>"; // Menampilkan gambar cover
        echo "<td>".$data['judul']."</td>";
        echo "<td>".$data['nama']."</td>";
        echo "<td>".$data['tanggal_pinjam']."</td>";
        echo "<td>".$data['tanggal_kembali']."</td>";
        echo "<td>
            <a href='peminjaman_edit.php?id=".$data['id_peminjaman']."' class='btn btn-warning'>Edit</a>
            <a href='peminjaman_del.php?id=".$data['id_peminjaman']."' class='btn btn-danger' onclick='return confirm(\"Are You Sure?\")'>Hapus</a>
        </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php include("footer.php"); ?>

<!-- Include jQuery and DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/Indonesian.json"
            }
        });
    });
</script>
