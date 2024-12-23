<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

$database = new Database();
$user = new User($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username, $email, $password);
    
    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['username'] = $loggedInUser['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Username, Email atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel Adi Motor</title>
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
            <h2>Login</h2>
            <form class="auth-form" method="POST" id="loginForm" novalidate>
                <?php if (isset($error)): ?>
                    <div style="color: #DC2626; text-align: center; margin-bottom: 1rem;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <div class="error-message" id="usernameError"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <button type="submit" class="auth-button">Login</button>

                <div class="auth-links">
                    <p>Belum punya akun? <a href="register.php">Register</a></p>
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