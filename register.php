<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';

$database = new Database();
$user = new User($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    if ($password === $confirm_password) {
        if ($user->register($username, $email, $password)) {
            header('Location: login.php');
            exit;
        } else {
            $error = "Gagal membuat akun. Username atau email sudah terdaftar.";
        }
    } else {
        $error = "Password dan konfirmasi password tidak cocok.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bengkel Adi Motor</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        .error-message {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        .error-message.show {
            display: block;
        }
        .form-group input.error {
            border-color: #DC2626;
        }
    </style>
</head>
<body>
    <header class="top-header">
        <h1>Management Inventory Bengkel Adi Motor</h1>
    </header>

    <main class="main-content" style="margin-left: 0; display: flex; justify-content: center; align-items: center;">
        <div class="auth-container">
            <h2>Register</h2>
            <form class="auth-form" method="POST" id="registerForm" novalidate>
                <?php if (isset($error)): ?>
                    <div style="color: #DC2626; text-align: center; margin-bottom: 1rem;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="username" required>
                    <div class="error-message" id="nameError">Name is required.</div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error-message" id="emailError">Email is required.</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <div class="error-message" id="passwordError">Password is required.</div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <div class="error-message" id="confirm_passwordError">Please confirm your password.</div>
                </div>

                <button type="submit" class="auth-button">Register</button>

                <div class="auth-links">
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer" style="width: 100%; margin-left: 0;">
        <p>Bengkel Adi Motor | Bandar Lampung</p>
    </footer>
    
    <script src="assets/script.js"></script>
</body>
</html>