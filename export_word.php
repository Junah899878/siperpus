<?php
include("myconnection.php");

// Mengatur header untuk menghasilkan file Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Anggota.doc");

$sql = "SELECT * FROM anggota WHERE status = '1'";
$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Anggota</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Gabung</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $data['nama'] . "</td>";
                echo "<td>" . $data['alamat'] . "</td>";
                echo "<td>" . $data['tanggal_bergabung'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
