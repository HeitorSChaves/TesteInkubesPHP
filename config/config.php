<?php

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'teste-php');
define('DB_USER', 'root');
define('DB_PASS', '');

define('BASE_URL', '/testePhP/TesteInkubesPHP/public');

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
