<?php
include("myconnection.php");

$id = $_GET['id'];

//--$sql = "DELETE FROM anggota WHERE id_anggota = $id";--//
$sql = "UPDATE buku SET status ='0' WHERE id_buku = $id";
$query = mysqli_query($koneksi, $sql);

if(!$query){
    header("Location:buku.php");
}else{
    echo "Ada Error";
}


header("Location:buku.php");