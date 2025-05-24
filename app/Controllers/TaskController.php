<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $tasks = $this->taskModel->all($user_id);
        $this->view('tasks/index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $this->view('tasks/create');
    }

    public function store()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $this->taskModel->create($title, $description, $user_id);
        header('Location: ' . BASE_URL . '/tasks');
    }

    public function edit($id)
    {
        $task = $this->taskModel->find($id);
        $this->view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $completed = isset($_POST['completed']) ? 1 : 0;
        $this->taskModel->update($id, $title, $description, $completed);
        header('Location: ' . BASE_URL . '/tasks');
    }

    public function delete($id)
    {
        $this->taskModel->delete($id);
        header('Location: /tasks');
    }
}
