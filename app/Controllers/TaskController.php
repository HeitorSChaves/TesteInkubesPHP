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
        if (!isset($_SESSION['user_id'])) {
            $this->showPermissionError();
            return;
        }
        $this->view('tasks/create');
    }

    public function store()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        $response = ['success' => false];
        if (!$user_id) {
            $response['error'] = 'Usuário não autenticado.';
        } else {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            if ($this->taskModel->create($title, $description, $user_id)) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Erro ao criar tarefa.';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->showPermissionError();
            return;
        }
        $task = $this->taskModel->find($id);
        if (!$task || $task['user_id'] != $_SESSION['user_id']) {
            $this->showPermissionError();
            return;
        }
        $this->view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->showPermissionError();
            return;
        }
        $task = $this->taskModel->find($id);
        if (!$task || $task['user_id'] != $_SESSION['user_id']) {
            $this->showPermissionError();
            return;
        }
        $response = ['success' => false];
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $completed = isset($_POST['completed']) ? 1 : 0;
        if ($this->taskModel->update($id, $title, $description, $completed)) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Erro ao atualizar tarefa.';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function delete($id)
    {
        $response = ['success' => false];
        if ($this->taskModel->delete($id)) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Erro ao excluir tarefa.';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    private function showPermissionError()
    {
        echo '<div style="max-width:500px;margin:60px auto;text-align:center;">
        <div class="alert alert-danger">Você não tem permissão para acessar essa tela.</div>
        <a href="'.BASE_URL.'/login" class="btn btn-primary">Voltar para o Login</a>
        </div>';
        exit;
    }
}
