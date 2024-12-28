<?php

if(isset($_POST['proses'])){
echo "<pre>";
print_r($_FILES); //berguna untuk mengecek print_r//
echo "</pre>";

$namaFile = $_FILES['berkas']['name'];
$namaTemp = $_FILES['berkas']['tmp_name'];

$folderupload = "cover/";

$terupload = move_uploaded_file($namaTemp, $folderupload.$namaFile);

if($terupload){
    echo "Unggah/Upload sukses<br>";
     echo "Link: <a href='".$folderupload.$namaFile."'>".$namaFile."</a>";
}else{
    echo "Unggah gagal!";
}
}
?>
<!-- Fungsi print_r() mencetak informasi tentang suatu variabel dengan cara yang lebih mudah dibaca manusia-->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Unggah dan Upload dalam PHP</h1>
    
<form action="" method="post" enctype="multipart/form-data"> 
    <label for="">BERKAS</label>
    <input type="file" name="berkas">
    <input type="submit" name="proses" value="unggah">
</form> 
    
</body>
</html>
<!-- form action jika kosong berarti mengirim ke dirinya sendiri -->