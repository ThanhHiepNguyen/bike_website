<?php
class PermissionUtils {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function getUserPermissions($userId) {
        $sql = "SELECT role FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        return $user['role'] ?? null;
    }

    public function updateUserRole($userId, $newRole) {
        if (!in_array($newRole, ['user', 'admin'])) {
            return false;
        }

        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newRole, $userId);
        return $stmt->execute();
    }
}