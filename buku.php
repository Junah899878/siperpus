<?php
 include("myconnection.php");

 $sql = "SELECT * FROM buku WHERE status = '1'";
 $query = mysqli_query($koneksi, $sql);

?>


<?php include("header.php"); ?>

        <h2>Data Buku</h2>
        <p><a href="buku_add.php" class="btn btn-success">Tambah Buku</a></p> <!-- untuk menambahkan anggota baru dengan cara melink data anggota dengan membuat file baru-->
   
        <!-- Include DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css">

<table id="dataTable" class="table table-hover table-striped">
    <thead>
        <tr>
            <th>No. </th>
            <th>Cover</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tanggal Terbit</th>
            <th>Penerbit</th>
            <th>Opsi</th>
        </tr>
        </thead>

        <?php
        $no = 1;
        while($data = mysqli_fetch_array($query)){ //-- mysqli fetch array untuk
         echo "<tr>";
        echo "<td>". $no++ ."</td>";
        echo "<td><img src='cover/".$data['cover']."' alt='cover' width='50'></td>";
        echo "<td>". $data['judul'] ."</td>";
        echo "<td>". $data['pengarang'] ."</td>";
        echo "<td>". $data['tahun_terbit'] ."</td>";
        echo "<td>". $data['penerbit'] ."</td>";
        echo "<td>


        <a href='buku_edit.php?id=".$data['id_buku']."' class='btn btn-warning'>Edit</a>
        <a href='buku_del.php?id=".$data['id_buku']."' class='btn btn-danger' onclick='return confirm(\"Are You Sure?\")'>Hapus</a>
        </td>";


         echo "</tr>";
  
        }
        ?>
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

    
    