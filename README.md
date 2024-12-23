# UAS-Pemweb
# Sistem Manajemen Inventori Bengkel Adi Motor

Sistem manajemen inventori untuk Bengkel Adi Motor dengan fitur autentikasi, pengelolaan barang, dan tracking user.

## Fitur Utama

1. Autentikasi User (Login/Register)
2. Manajemen Inventori (CRUD)
3. Tracking User (Browser, IP)
4. State Management
5. Form Validation (Client & Server side)

## Spesifikasi Teknis

### 1. Client-side Programming (30%)

#### 1.1 Manipulasi DOM (15%)
- Form input dengan multiple elements:
  - Username (text)
  - Email (text)
  - Password (password)
  - Remember Me (checkbox)
  - User Type (radio: admin/staff)
- Tabel HTML dinamis untuk menampilkan data inventori
- Real-time form validation feedback

#### 1.2 Event Handling (15%)
Implementasi events:
1. `submit`: Validasi form sebelum pengiriman
2. `input`: Real-time validation saat user mengetik
3. `change`: Update UI berdasarkan pilihan user
4. `focus/blur`: Menampilkan/sembunyikan hint text

### 2. Server-side Programming (30%)

#### 2.1 Pengelolaan Data PHP (20%)
- Implementasi metode POST untuk forms
- Validasi server-side untuk semua input
- Tracking dan penyimpanan data:
  - Browser type
  - IP Address
  - Last login
  - Session duration

#### 2.2 OOP Implementation (10%)
Class utama:
1. `UserManager`: Pengelolaan user
2. `InventoryManager`: Pengelolaan inventori
3. `DatabaseManager`: Koneksi dan operasi database

### 3. Database Management (20%)

#### 3.1 Database Tables
1. `users`:
   - id (PRIMARY KEY)
   - username
   - email
   - password
   - user_type
   - browser_info
   - ip_address
   - last_login
   - created_at

2. `items`:
   - id (PRIMARY KEY)
   - name
   - quantity
   - price
   - created_by
   - created_at
   - updated_at

#### 3.2 Database Connection
- Implementasi PDO untuk koneksi database
- Connection pooling
- Error handling

#### 3.3 Data Manipulation
- CRUD operations untuk items
- User management
- Tracking logs

### 4. State Management (20%)

#### 4.1 Session Management (10%)
- Session start pada setiap halaman
- Penyimpanan data user:
  - User ID
  - Username
  - User Type
  - Last Activity
  - Login Status

#### 4.2 Cookie & Browser Storage (10%)
- Cookies:
  - Remember Me functionality
  - Theme preference
  - Language selection
- Local Storage:
  - User preferences
  - Form draft autosave
  - Recent activities

## File Structure

```
bengkel-adi-motor/
├── assets/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── includes/
│   ├── config.php
│   ├── auth_check.php
│   ├── UserManager.php
│   ├── InventoryManager.php
│   └── DatabaseManager.php
├── index.php
├── login.php
├── register.php
├── dashboard.php
├── add_item.php
├── edit_item.php
├── list_item.php
└── logout.php
```

## Setup Instructions

1. Database Setup:
```sql
-- Create Database
CREATE DATABASE bengkel_adi_motor;

-- Create Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'staff') DEFAULT 'staff',
    browser_info TEXT,
    ip_address VARCHAR(45),
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Items Table
CREATE TABLE items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

2. Configuration:
   - Update database credentials in `includes/config.php`
   - Ensure proper permissions for file uploads
   - Configure session timeout in PHP settings

3. Installation:
   - Clone repository ke web server directory
   - Import database structure
   - Set up virtual host (optional)
   - Configure file permissions

4. Running the Application:
   - Access via web browser
   - Default admin credentials:
     - Username: admin
     - Email: admin@bengkeladimotot.com
     - Password: admin123

## Security Features

1. Password Hashing (bcrypt)
2. SQL Injection Prevention (Prepared Statements)
3. XSS Protection
4. CSRF Protection
5. Session Security
6. Input Validation

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
