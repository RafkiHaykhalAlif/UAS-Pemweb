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
## 5. Hosting Aplikasi Web
### Langkah-langkah yang dilakukan untuk meng-host aplikasi web
1. Membuat Akun di InfinityFree:
Saya mendaftar akun di InfinityFree.net yang menyediakan hosting gratis.

2. Membuat Domain atau Subdomain:
Saya menggunakan domain/subdomain gratis yang disediakan oleh InfinityFree atau menghubungkan domain khusus yang telah saya beli.

3. Mengunggah File Aplikasi Web:
File aplikasi diunggah ke server menggunakan File Manager bawaan InfinityFree atau melalui aplikasi FTP seperti FileZilla.

4. Membuat Database:
Saya membuat database MySQL melalui cPanel di InfinityFree, dan mencatat informasi seperti hostname, username, dan password database.

5. Mengkonfigurasi Aplikasi:
Saya mengonfigurasi file aplikasi web untuk menghubungkan database dengan detail yang disediakan.

6. Mengaktifkan SSL:
Saya mengaktifkan sertifikat SSL gratis dari InfinityFree untuk memastikan koneksi HTTPS.

7. Menguji Aplikasi:
Setelah semuanya diatur, saya menguji aplikasi web melalui URL untuk memastikan semuanya berfungsi.

### Memilih penyedia hosting web yang paling cocok:
Saya memilih InfinityFree karena:
1. Gratis: Tidak ada biaya bulanan, cocok untuk aplikasi dengan kebutuhan dasar.
2. Fitur Lengkap: Menyediakan PHP, MySQL, dan SSL gratis, yang cukup untuk aplikasi web standar.
3. Tidak Ada Iklan Paksa: InfinityFree tidak menampilkan iklan pada aplikasi web.
4. Kemudahan Penggunaan: cPanel yang intuitif memudahkan pengelolaan file, database, dan domain.

### Memastikan keamanan aplikasi web:
1. Menggunakan HTTPS:
Saya mengaktifkan sertifikat SSL gratis untuk mengenkripsi data antara server dan pengguna.

2. Validasi Input:
Menambahkan validasi input di sisi server untuk mencegah serangan seperti SQL Injection dan XSS.

3. Pengaturan File Permissions:
Mengatur file permissions untuk mencegah akses tidak sah ke file sensitif.

4. Menghindari Menyimpan Informasi Sensitif di Public Directory:
Konfigurasi file seperti config.php diletakkan di luar public directory.

5. Pembaruan Aplikasi:
Saya secara rutin memperbarui kode aplikasi dan library yang digunakan untuk menutup celah keamanan.

6. Firewall dan Proteksi Hosting:
InfinityFree memiliki proteksi bawaan terhadap serangan DDoS dan akses tidak sah.

### Konfigurasi server yang diterapkan:

1. Memaksa penggunaan HTTPS.
2. Mengatur pengalihan URL untuk meningkatkan SEO.


## Teknologi yang Digunakan
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- State Management: PHP Sessions & Cookies
