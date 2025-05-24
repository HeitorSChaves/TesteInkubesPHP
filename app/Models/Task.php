<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Task extends Model
{
    public function all($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $user_id)
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, user_id, created_at) VALUES (:title, :description, :user_id, NOW())");
        return $stmt->execute([
            'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
            'user_id' => $user_id
        ]);
    }

    public function update($id, $title, $description, $completed)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = :title, description = :description, is_completed = :completed WHERE id = :id");
        return $stmt->execute([
            'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
            'completed' => $completed,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function complete($id)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET completed = 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
