<?php
// auth_check.php - Create this new file in includes folder
session_start();
function checkAuth() {
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }
}

// Modify header section in all pages (index.php, add_item.php, list_item.php, edit_item.php)
// Replace the existing header with:
?>