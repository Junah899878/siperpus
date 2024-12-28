<?php
if (file_exists('fpdf.php')) {
    echo "FPDF file found.";
} else {
    echo "FPDF file not found!";
}

require('fpdf.php'); // Pastikan file ini ada di direktori yang tepat
include("myconnection.php"); // Pastikan koneksi ke database benar

// Buat instance FPDF
$pdf = new FPDF(); // Langsung membuat objek FPDF dengan default parameters
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Judul
$pdf->Cell(190, 10, 'Data Anggota', 0, 1, 'C');
$pdf->Ln(10);

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(80, 10, 'Alamat', 1, 0, 'C');
$pdf->Cell(50, 10, 'Tanggal Gabung', 1, 1, 'C');

// Ambil data dari database
$pdf->SetFont('Arial', '', 12);
$sql = "SELECT * FROM anggota WHERE status = '1'";
$query = mysqli_query($koneksi, $sql);

$no = 1;
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(50, 10, $data['nama'], 1, 0, 'L');
    $pdf->Cell(80, 10, $data['alamat'], 1, 0, 'L');
    $pdf->Cell(50, 10, $data['tanggal_bergabung'], 1, 1, 'L');
}

// Output PDF
$pdf->Output('D', 'Data_Anggota.pdf'); // Mengunduh file langsung
?>
