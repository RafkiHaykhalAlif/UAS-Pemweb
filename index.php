<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bengkel Adi Motor</title>
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
            <a href="index.php" class="nav-button active">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="list_item.php" class="nav-button">Inventory</a>
                <a href="add_item.php" class="nav-button">Add Items</a>
            <?php endif; ?>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-header">
            <h1>ADI MOTOR</h1>
            <img src="assets/adi_motor.png" alt="Bengkel Adi Motor" class="bengkel-image">
        </div>

        <section>
            <h2>Melayani : </h2>
            <ul class="services-list">
                <li>Servis Berkala Motor</li>
                <li>Ganti Oli Mesin</li>
                <li>Cek dan Perbaikan Kelistrikan</li>
                <li>Modifikasi Motor</li>
                <li>DII</li>
            </ul>
        </section>
    </main>

    <footer class="footer">
        <p>Bengkel Adi Motor | Bandar Lampung</p>
    </footer>
</body>
</html>