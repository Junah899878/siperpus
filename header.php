<?php
//memulai fungsi session
session_start();
// Periksa session log in
if(!isset($_SESSION['login'])){
header("Location:login.php");
exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-Perpus</title>

    
    <!-- Tambahkan di header.php -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


     <!-- Latest compiled and minified CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

         <!-- Latest compiled JavaScript -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

         
        <style> body { background-color: #f8f9fa; /* Warna background untuk body */ } .container { background-color: #ffffff; /* Warna background untuk container */ padding: 50px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); } </style>
</head>
<body>
    
<div class="container">
    <?php include("menu.php"); ?>