<?php

if(isset($_POST['simpan'])){
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit= $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];

    include("myconnection.php");

    $sql = "INSERT INTO buku(judul, pengarang, tahun_terbit, penerbit) VALUES('$judul', '$pengarang', '$tahun_terbit','$penerbit')";

    $query = mysqli_query($koneksi, $sql);

    if($query){
        header("Location:buku.php");
    }else{
        die("Eror!");
    }
}

?>

<?php include("header.php"); ?>

    <h2>FORM Tambah Buku</h2>
    
    <form action="" method="post">
    

        <label for="judul">Judul</label>
        <input type="text" name="judul" class="form-control">
        <br>

        <label for="pengarang">Pengarang</label>
        <input type="text" name="pengarang" class="form-control">
        <br>

        <label for="tahun_terbit">Tahun Terbit</label>
        <input type="date" name="tahun_terbit" class="form-control">
        <br>

        <label for="penerbit">Penerbit</label>
        <input type="text" name="penerbit" class="form-control">
        <br>

        <input type="submit" value="Simpan" name="simpan" class="btn btn-success">
        
    </form>
    
<?php include("footer.php"); ?>