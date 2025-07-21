<?php
namespace ElimuHub\Models;

use ElimuHub\Config\Database;

class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function authenticate(string $email, string $password): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        return ($user && password_verify($password, $user['password'])) 
            ? $user 
            : null;
    }
}
?>