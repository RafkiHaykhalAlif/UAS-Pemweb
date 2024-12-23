<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/styles.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="add_item.php">Tambah Barang</a>
        <a href="list_item.php">Daftar Barang</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Selamat Datang di Bengkel Adi Motor</h1>
        <p>Layanan terbaik untuk kendaraan Anda.</p>
    </div>
</body>
</html>
