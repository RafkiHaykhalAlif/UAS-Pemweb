<?php
class Inventory {
    private $db;
    private $table = 'items';

    public function __construct(Database $database) {
        $this->db = $database->getPdo();
    }

    public function getAllItems() {
        try {
            $stmt = $this->db->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Get items error: " . $e->getMessage());
            return [];
        }
    }

    public function addItem($name, $quantity, $price) {
        try {
            $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, quantity, price) VALUES (?, ?, ?)");
            return $stmt->execute([$name, $quantity, $price]);
        } catch (PDOException $e) {
            error_log("Add item error: " . $e->getMessage());
            return false;
        }
    }

    public function updateItem($id, $name, $quantity, $price) {
        try {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET name = ?, quantity = ?, price = ? WHERE id = ?");
            return $stmt->execute([$name, $quantity, $price, $id]);
        } catch (PDOException $e) {
            error_log("Update item error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteItem($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete item error: " . $e->getMessage());
            return false;
        }
    }
}