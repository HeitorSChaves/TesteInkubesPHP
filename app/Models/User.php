<?php
namespace App\Models;

use App\Core\Database;

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $parts = preg_split('/\s+/', trim($name));
        $primeiro = isset($parts[0]) ? $parts[0] : '';
        $ultimo = isset($parts[count($parts)-1]) ? $parts[count($parts)-1] : '';
        $primeiro = strtolower(preg_replace('/[^a-z0-9]/i', '', iconv('UTF-8', 'ASCII//TRANSLIT', $primeiro)));
        $ultimo = strtolower(preg_replace('/[^a-z0-9]/i', '', iconv('UTF-8', 'ASCII//TRANSLIT', $ultimo)));
        $base = $primeiro . '.' . $ultimo;
        $username = $base . rand(1000, 9999);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, username) VALUES (?, ?, ?, ?)");
        try {
            if ($stmt->execute([
                htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                $email,
                $hash,
                $username
            ])) {
                return $username;
            }
        } catch (\PDOException $e) {
            return false;
        }
        return false;
    }

    public function findByUsernameOrEmail($userOrEmail) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$userOrEmail, $userOrEmail]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function verify($userOrEmail, $password) {
        $user = $this->findByUsernameOrEmail($userOrEmail);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
