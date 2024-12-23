<?php
session_start();
require_once 'includes/auth_check.php';
require 'includes/db_config.php';
checkAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO items (name, quantity, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $quantity, $price]);

    header('Location: list_item.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item - Bengkel Adi Motor</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header class="top-header">
        <h1>Management Inventory Bengkel Adi Motor</h1>
        <a href="logout.php" class="login-btn">Logout</a>
    </header>

    <aside class="sidebar">
        <div class="logo-container">
            <img src="assets/logo.jpeg" alt="Adi Motor Logo">
        </div>
        
        <h2 class="nav-title">Menu Navigation</h2>
        <nav>
            <a href="index.php" class="nav-button">Home</a>
            <a href="list_item.php" class="nav-button">Inventory</a>
            <a href="add_item.php" class="nav-button active">Add Items</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-header">
            <h1>TAMBAHKAN BARANG</h1>
        </div>

        <form class="add-item-form" method="POST">
            <div class="form-group">
                <label for="name">Nama Barang:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" required>
            </div>

            <button type="submit" class="submit-btn">Tambah Barang</button>
        </form>
    </main>

    <footer class="footer">
        <p>Bengkel Adi Motor | Bandar Lampung</p>
    </footer>
</body>
</html>