# Sistem Manajemen Inventori Bengkel Adi Motor

Sistem informasi berbasis web untuk manajemen inventori Bengkel Adi Motor.

## Fitur yang Sudah Diimplementasikan

### 1. Client-side Programming

#### 1.1 Manipulasi DOM dengan JavaScript
- Form input yang sudah ada:
  - Username (pada halaman register)
  - Email
  - Password
  - Confirm Password (pada halaman register)
- Tampilan data dalam tabel HTML di halaman list_item.php
- Validasi form menggunakan JavaScript di script.js

#### 1.2 Event Handling
Implementasi event yang sudah ada dalam script.js:
1. `submit`: Validasi form sebelum pengiriman
2. `input`: Real-time validation untuk:
   - Email format
   - Password length
   - Password matching
3. Error message display/hide

### 2. Server-side Programming

#### 2.1 Pengelolaan Data dengan PHP
- Menggunakan metode POST untuk semua form
- Validasi server-side untuk:
  - Login credentials
  - Register new user
  - Add/Edit inventory items
- Database operations untuk user dan inventory

#### 2.2 Database Management

Database Configuration (db_config.php):
```php
$host = 'localhost';
$dbname = 'bengkel_adi_motor';
$username = 'root';
$password = '';
```

Struktur Database yang Ada:
1. Tabel `users`:
   - username
   - email
   - password

2. Tabel `items`:
   - name
   - quantity
   - price

### 3. State Management

#### 3.1 Session Management
- Implementasi session untuk autentikasi
- Session start di setiap halaman yang membutuhkan
- Penyimpanan username dalam session setelah login
- Pengecekan session untuk akses halaman tertentu

## Struktur File

```
bengkel-adi-motor/
├── assets/
│   ├── styles.css
│   ├── script.js
│   ├── logo.jpeg
│   └── adi_motor.png
├── includes/
│   ├── db_config.php
│   └── auth_check.php
├── index.php
├── login.php
├── register.php
├── add_item.php
├── edit_item.php
├── list_item.php
└── logout.php
```

## Setup dan Instalasi

1. Database Setup
```sql
-- Create Database
CREATE DATABASE bengkel_adi_motor;

-- Create Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create Items Table
CREATE TABLE items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL
);
```

2. Konfigurasi:
   - Update credential database di includes/db_config.php sesuai dengan konfigurasi local
   - Pastikan PHP dan MySQL sudah terinstall
   - Pastikan module PDO PHP sudah aktif

3. Instalasi:
   - Copy semua file ke direktori web server
   - Import struktur database
   - Akses melalui web browser

## Fitur yang Perlu Ditambahkan untuk Memenuhi Semua Requirement

1. Client-side Programming:
   - Tambah minimal 1 elemen input (checkbox/radio) di form
   - Implementasi lebih banyak event handling

2. Server-side Programming:
   - Tambah tracking browser type dan IP address
   - Implementasi PHP OOP
   - Tambah validasi server-side yang lebih komprehensif

3. Database Management:
   - Tambah kolom untuk tracking user (browser, IP)
   - Tambah timestamp untuk created_at dan updated_at

4. State Management:
   - Implementasi cookie untuk "Remember Me"
   - Tambah browser storage untuk menyimpan preferensi user

## Keamanan yang Sudah Diimplementasikan

1. Password Hashing menggunakan password_hash()
2. Prepared Statements untuk query database
3. Session-based authentication
4. Input validation

## Cara Penggunaan

1. Register user baru melalui halaman register.php
2. Login menggunakan email dan password
3. Akses fitur inventory management:
   - Lihat daftar barang
   - Tambah barang baru
   - Edit barang yang ada
   - Hapus barang

## Browser Support

- Sudah ditest di Chrome dan Firefox terbaru
- Responsive design untuk berbagai ukuran layar

## Credit

Dikembangkan untuk Bengkel Adi Motor sebagai sistem manajemen inventori.
