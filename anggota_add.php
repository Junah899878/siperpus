<?php

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];

    include("myconnection.php");

    $sql = "INSERT INTO anggota(nama, alamat, tanggal_bergabung, status) VALUES('$nama', '$alamat', '$tanggal_bergabung', '1')";

    $query = mysqli_query($koneksi, $sql);

    if($query){
        header("Location:anggota.php");
    }else{
        die("Eror!");
    }
}

?>

<?php include("header.php"); ?>


    <h2>FORM Tambah Anggota</h2>
    <form action="" method="post">

        <label for="nama">Nama</label>
        <input type="text" name="nama" class="form-control">
        <br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" class="form-control">
        <br>

        <label for="tanggal_bergabung">Tanggal Gabung</label>
        <input type="date" name="tanggal_bergabung" class="form-control">
        <br>
        <input type="submit" value="Simpan" name="simpan" class="btn btn-success">

    </form>
  
<?php include("footer.php"); ?>