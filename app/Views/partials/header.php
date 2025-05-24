<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>/tasks">Tarefas</a>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/logout">Logout</a>
            <?php else: ?>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
