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
        $response = ['success' => false];
        $user = $this->userModel->verify($email, $password);
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
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $response = ['success' => false];
        if ($this->userModel->findByEmail($email)) {
            $response['error'] = 'E-mail já cadastrado.';
        } elseif ($this->userModel->create($email, $password)) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Erro ao registrar.';
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
