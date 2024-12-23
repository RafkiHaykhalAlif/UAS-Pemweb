# Sistem Manajemen Inventory Bengkel Adi Motor

Sistem manajemen inventory untuk Bengkel Adi Motor yang mengimplementasikan berbagai fitur client-side dan server-side programming.

## 1. Client-side Programming

### 1.1 Manipulasi DOM dengan JavaScript
- Implementasi form input pada halaman register.php dan login.php dengan elemen:
  - Input text untuk username
  - Input email
  - Input password
  - Konfirmasi password (pada register)

Contoh implementasi di register.php:
```html
<form class="auth-form" method="POST" id="registerForm" novalidate>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="username" required>
        <div class="error-message" id="nameError">Name is required.</div>
    </div>
    <!-- Input lainnya -->
</form>
```

### 1.2 Event Handling
Implementasi 3 event handling dalam script.js:
1. Form submission validation
2. Real-time input validation
3. Error message handling

Contoh implementasi:
```javascript
loginForm.addEventListener('submit', (e) => {
    if (!validateForm(loginForm)) {
        e.preventDefault();
    }
});

input.addEventListener('input', () => {
    hideError(input);
    if (input.value.trim()) {
        validateInput(input);
    }
});
```

## 2. Server-side Programming

### 2.1 Pengelolaan Data dengan PHP
- Menggunakan metode POST untuk form login dan register
- Validasi server-side pada User.php
- Menyimpan data browser dan IP pengguna

Contoh implementasi di User.php:
```php
private function logUserActivity($userId, $action) {
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $stmt = $this->db->prepare("INSERT INTO user_activity_logs (user_id, action, browser, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $action, $browser, $ip]);
}
```

### 2.2 Objek PHP Berbasis OOP
Implementasi class User dan Database dengan berbagai metode:
- Class Database: koneksi dan manajemen database
- Class User: login, register, dan manajemen aktivitas

## 3. Database Management

### 3.1 & 3.2 Konfigurasi Database
Implementasi di Database.php:
```php
class Database {
    private $host = 'localhost';
    private $dbname = 'bengkel_adi_motor';
    private $username = 'root';
    private $password = '';
    private $pdo;
    
    public function __construct() {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", 
                            $this->username, 
                            $this->password);
    }
}
```

### 3.3 Manipulasi Data
Implementasi CRUD operations di Inventory.php:
- Create: addItem()
- Read: getAllItems()
- Update: updateItem()
- Delete: deleteItem()

## 4. State Management

### 4.1 Session Management
Implementasi di berbagai file:
```php
session_start();
$_SESSION['user_id'] = $loggedInUser['id'];
$_SESSION['username'] = $loggedInUser['username'];
```

### 4.2 Cookie Management
Implementasi di User.php:
```php
private function setUserCookie($userId) {
    $cookieValue = base64_encode($userId . '_' . time());
    setcookie('user_session', $cookieValue, time() + (86400 * 30), "/");
}
```

## Teknologi yang Digunakan
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- State Management: PHP Sessions & Cookies

## Cara Instalasi
1. Clone repository ini
2. Import database bengkel_adi_motor.sql
3. Sesuaikan konfigurasi database di Database.php
4. Jalankan di web server dengan PHP
