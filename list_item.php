<?php
session_start();
require_once 'includes/auth_check.php';
require 'includes/db_config.php';
checkAuth();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: list_item.php');
    exit;
}

$items = $pdo->query("SELECT * FROM items")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Bengkel Adi Motor</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <a href="list_item.php" class="nav-button active">Inventory</a>
            <a href="add_item.php" class="nav-button">Add Items</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-header">
            <h1>INVENTORY LIST</h1>
        </div>

        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td class="action-buttons">
                        <a href="edit_item.php?id=<?= $item['id'] ?>" class="edit-btn">Edit</a>
                        <a href="list_item.php?delete=<?= $item['id'] ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')" 
                           class="delete-btn">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer class="footer">
        <p>Bengkel Adi Motor | Bandar Lampung</p>
    </footer>
</body>
</html>