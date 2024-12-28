<?php
session_start();

// Menghapus semua session
session_unset();

// Menghancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit();
?>
