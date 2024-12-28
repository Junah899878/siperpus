<?php
include("myconnection.php");

$sql = "SELECT * FROM anggota WHERE status = '1'";
$query = mysqli_query($koneksi, $sql);

?>

<?php include("header.php"); ?>

<h2 style="color: black;">Data Anggota</h2>
<p><a href="anggota_add.php" style="color: white;" class="btn btn-success">Tambah Anggota</a></p> <!-- untuk menambahkan anggota baru dengan cara melink data anggota dengan membuat file baru-->
<p><a href="export_word.php" class="btn btn-primary">Export-Word</a></p>
<p><a href="export_pdf.php" class="btn btn-primary">Export-PDF</a></p>


<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css">

<table id="dataTable" class="table table-hover table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Gabung</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while($data = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>". $no++ ."</td>";
            echo "<td>". $data['nama'] ."</td>";
            echo "<td>". $data['alamat'] ."</td>";
            echo "<td>". $data['tanggal_bergabung'] ."</td>";
            echo "<td>
                <a href='anggota_edit.php?id=".$data['id_anggota']."' class='btn btn-warning'>Edit</a>
                <a href='anggota_del.php?id=".$data['id_anggota']."' class='btn btn-danger' onclick='return confirm(\"Are You Sure?\")'>Hapus</a>
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
