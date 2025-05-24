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
        return $stmt->fetch();
    }

    public function create($name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // Gera username: primeiro e último nome, minúsculo, separados por ponto, sem acentos, + 4 dígitos aleatórios
        $parts = preg_split('/\s+/', trim($name));
        $primeiro = isset($parts[0]) ? $parts[0] : '';
        $ultimo = isset($parts[count($parts)-1]) ? $parts[count($parts)-1] : '';
        $base = strtolower(preg_replace('/[^a-z0-9]+/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $primeiro))) . '.' . strtolower(preg_replace('/[^a-z0-9]+/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $ultimo)));
        $username = $base . rand(1000, 9999);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, username) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $hash, $username])) {
            return $username;
        }
        return false;
    }

    public function findByUsernameOrEmail($userOrEmail) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$userOrEmail, $userOrEmail]);
        return $stmt->fetch();
    }

    public function verify($userOrEmail, $password) {
        $user = $this->findByUsernameOrEmail($userOrEmail);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
