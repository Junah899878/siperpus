<?php
include("myconnection.php");

$id = $_GET['id'];

//--$sql = "DELETE FROM anggota WHERE id_anggota = $id";--//
$sql = "UPDATE anggota SET status ='0' WHERE id_anggota = $id";
$query = mysqli_query($koneksi, $sql);

if(!$query){
    header("Location:anggota.php");
}else{
    echo "Ada Error";
}


header("Location:anggota.php");