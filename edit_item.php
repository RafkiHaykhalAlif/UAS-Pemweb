<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require 'includes/db_config.php';

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch();
    
    if (!$item) {
        header('Location: list_item.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE items SET name = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $quantity, $price, $item_id]);
    
    header('Location: list_item.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Bengkel Adi Motor</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="top-header">
        <h1>Management Inventory Bengkel Adi Motor</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php" class="login-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </header>

    <aside class="sidebar">
        <div class="logo-container">
            <img src="assets/logo.jpeg" alt="Adi Motor Logo">
        </div>
        
        <h2 class="nav-title">Menu Navigation</h2>
        <nav>
            <a href="index.php" class="nav-button">Home</a>
            <a href="list_item.php" class="nav-button">Inventory</a>
            <a href="add_item.php" class="nav-button">Add Items</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-header">
            <h1>EDIT DATA BARANG</h1>
        </div>

        <form class="add-item-form" method="POST">
            <div class="form-group">
                <label for="name">Nama Barang:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" value="<?= htmlspecialchars($item['price']) ?>" required>
            </div>

            <button type="submit" class="submit-btn">Update Barang</button>
        </form>
    </main>

    <footer class="footer">
        <p>Bengkel Adi Motor | Bandar Lampung</p>
    </footer>
</body>
</html>