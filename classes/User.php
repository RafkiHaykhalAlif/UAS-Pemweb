<?php
class User {
    private $db;
    private $table = 'users';

    public function __construct(Database $database) {
        $this->db = $database->getPdo();
    }

    public function login($username, $email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ? AND email = ?");
            $stmt->execute([$username, $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $this->logUserActivity($user['id'], 'login');
                $this->setUserCookie($user['id']);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function register($username, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (?, ?, ?)");
            $success = $stmt->execute([$username, $email, $hashedPassword]);
            
            if ($success) {
                $userId = $this->db->lastInsertId();
                $this->logUserActivity($userId, 'register');
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    private function logUserActivity($userId, $action) {
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        
        try {
            $stmt = $this->db->prepare("INSERT INTO user_activity_logs (user_id, action, browser, ip_address) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, $action, $browser, $ip]);
        } catch (PDOException $e) {
            error_log("Activity logging error: " . $e->getMessage());
        }
    }

    private function setUserCookie($userId) {
        $cookieValue = base64_encode($userId . '_' . time());
        setcookie('user_session', $cookieValue, time() + (86400 * 30), "/"); // 30 days
    }

    public function checkUserCookie() {
        if (isset($_COOKIE['user_session'])) {
            $cookieValue = base64_decode($_COOKIE['user_session']);
            list($userId, $timestamp) = explode('_', $cookieValue);
            return $userId;
        }
        return false;
    }
    
}
