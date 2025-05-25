<?php
namespace App\Core;

use App\Controllers\TaskController;
use App\Controllers\AuthController;

class Router
{
    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = '/TesteInkubesPHP/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        $uri = $uri ?: '/';

        // Auth rotas
        if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            (new AuthController)->login();
            return;
        } elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AuthController)->doLogin();
            return;
        } elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            (new AuthController)->register();
            return;
        } elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AuthController)->doRegister();
            return;
        } elseif ($uri === '/logout') {
            (new AuthController)->logout();
            return;
        }

        // Task rotas
        $controller = new TaskController();
        if ($uri === '/' || $uri === '/tasks') {
            $controller->index();
        } elseif ($uri === '/tasks/create' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->create();
        } elseif ($uri === '/tasks/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } elseif (preg_match('#^/tasks/edit/(\d+)$#', $uri, $matches)) {
            $controller->edit($matches[1]);
        } elseif (preg_match('#^/tasks/update/(\d+)$#', $uri, $matches)) {
            $controller->update($matches[1]);
        } elseif (preg_match('#^/tasks/delete/(\d+)$#', $uri, $matches)) {
            $controller->delete($matches[1]);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Página não encontrada";
        }
    }
}
