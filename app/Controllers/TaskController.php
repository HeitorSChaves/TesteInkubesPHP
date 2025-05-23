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
        $tasks = $this->taskModel->all();
        $this->view('tasks/index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $this->view('tasks/create');
    }

    public function store()
    {
        $this->taskModel->create($_POST);
        header('Location: /tasks');
    }

    public function edit($id)
    {
        $task = $this->taskModel->find($id);
        $this->view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        $this->taskModel->update($id, $_POST);
        header('Location: /tasks');
    }

    public function delete($id)
    {
        $this->taskModel->delete($id);
        header('Location: /tasks');
    }
}
