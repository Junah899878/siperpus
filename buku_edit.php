<?php
include("myconnection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM buku WHERE id_buku = $id";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
}

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);

    // Penanganan upload file
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['cover']['tmp_name'];
        $fileName = uniqid() . '-' . $_FILES['cover']['name'];
        $fileSize = $_FILES['cover']['size'];
        $fileType = $_FILES['cover']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array($fileExtension, $allowedfileExtensions)){
            $uploadFileDir = './cover/';
            $dest_path = $uploadFileDir . $fileName;

            if(!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            if(move_uploaded_file($fileTmpPath, $dest_path)){
                echo 'File berhasil diunggah.';
                $cover = $fileName;
            } else {
                echo 'Ada beberapa kesalahan saat memindahkan file ke direktori unggah.';
            }
        } else {
            echo 'Unggahan gagal. Jenis file yang diperbolehkan: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $cover = isset($data['cover']) ? $data['cover'] : '';
    }

    if (!empty($cover)) {
        $sql = "UPDATE buku SET judul='$judul', cover='$cover', pengarang='$pengarang', tahun_terbit='$tahun_terbit', penerbit='$penerbit' WHERE id_buku = $id";
        $query = mysqli_query($koneksi, $sql);
        if($query){
            header("Location:buku.php");
        } else {
            echo 'Kesalahan dalam memperbarui data.';
        }
    } else {
        echo 'Cover buku tidak boleh kosong.';
    }
}
?>






?>

<?php include("header.php"); ?>

    <h2>Form Edit Buku</h2>
    <form action="" method="post" enctype="multipart/form-data">
    
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="<?=$data['judul']?>" class="form-control">
        <br>

        <label for="cover">Cover</label> <input type="file" name="cover" class="form-control"> <br>

        <label for="pengarang">Pengarang</label>
        <input type="text" name="pengarang" value="<?=$data['pengarang']?>" class="form-control">
        <br>

        <label for="tahun_terbit">Tahun Terbit</label>
        <input type="date" name="tahun_terbit" value="<?=$data['tahun_terbit']?>" class="form-control">
        <br>
        
        <label for="penerbit">Penerbit</label>
        <input type="text" name="penerbit" value="<?=$data['penerbit']?>" class="form-control">
        <br>
        
        <input type="hidden" name="id" value="<?=$data['id_buku']?>">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-success">
    </form>
  
<?php include("footer.php"); ?>