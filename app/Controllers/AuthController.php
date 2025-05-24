<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function login() {
        $this->view('auth/login');
    }

    public function doLogin() {
        $userOrEmail = trim($_POST['email'] ?? '');
        $password = $_POST['password'];
        $response = ['success' => false];
        $user = $this->userModel->verify($userOrEmail, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $response['success'] = true;
        } else {
            $response['error'] = 'Credenciais inválidas';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function register() {
        $this->view('auth/register');
    }

    public function doRegister() {
        $name = trim($_POST['name'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $response = ['success' => false];
        if ($this->userModel->findByEmail($email)) {
            $response['error'] = 'E-mail já cadastrado.';
        } elseif (empty($name) || empty($email) || empty($password)) {
            $response['error'] = 'Preencha todos os campos.';
        } else {
            $username = $this->userModel->create($name, $email, $password);
            if ($username) {
                $response['success'] = true;
                $response['username'] = $username;
            } else {
                $response['error'] = 'Erro ao registrar.';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
    }
}
