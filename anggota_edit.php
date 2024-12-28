<?php

include("myconnection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM anggota WHERE id_anggota = $id";
    $query = mysqli_query($koneksi, $sql);

    $data = mysqli_fetch_array($query);
}


if(isset($_POST['simpan'])){
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tanggal_bergabung = $_POST['tanggal_bergabung'];

    $sql = "UPDATE anggota
    SET nama='$nama', alamat='$alamat', tanggal_bergabung='$tanggal_bergabung' WHERE id_anggota = $id";


$query = mysqli_query($koneksi, $sql);
if($query){
    header("Location:anggota.php");

}

}

?>

<?php include("header.php"); ?>
    
    <h2>Form Edit Anggota</h2>
    <form action="" method="post">
    

        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?=$data['nama']?>" class="form-control">  
        <br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?=$data['alamat']?>" class="form-control">
        <br>
    

        <label for="tanggal_bergabung">Tanggal Gabung</label>
        <input type="date" name="tanggal_bergabung" value="<?=$data['tanggal_bergabung']?>" class="form-control">
        <br>
        
        <input type="hidden" name="id" value="<?=$data['id_anggota']?>">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-success">
    </form>

    <?php include("footer.php"); ?>