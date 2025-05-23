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
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $user = $this->userModel->verify($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: ' . BASE_URL . '/tasks');
        } else {
            $_SESSION['error'] = 'Credenciais inválidas';
            header('Location: ' . BASE_URL . '/login');
        }
    }

    public function register() {
        $this->view('auth/register');
    }

    public function doRegister() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if ($this->userModel->create($email, $password)) {
            $_SESSION['success'] = 'Registrado com sucesso! Faça login.';
            header('Location: ' . BASE_URL . '/login');
        } else {
            $_SESSION['error'] = 'Erro ao registrar';
            header('Location: ' . BASE_URL . '/register');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
    }
}
