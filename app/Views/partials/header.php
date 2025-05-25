<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <style>
        body { background: #f4f6fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .container, .container-fluid { max-width: 900px; }
        .card { border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .btn-primary, .btn-success, .btn-warning, .btn-danger { border-radius: 8px; }
        .table { background: #fff; border-radius: 10px; overflow: hidden; }
        .table th { background: #f1f3f7; font-weight: 600; }
        .form-control, textarea { border-radius: 8px; }
        @media (max-width: 768px) {
            .container, .container-fluid { max-width: 100%; padding: 0 8px; }
            .table-responsive { overflow-x: auto; }
            .table { font-size: 0.95rem; }
            .btn { font-size: 0.95rem; padding: 0.4rem 0.7rem; }
            h1.mb-4, h2 { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>/tasks">Tarefas</a>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php
                    $username = '';
                    $name = '';
                    $greeting = '';
                    if(isset($_SESSION['user_id'])) {
                        $db = (new \App\Core\Database())->getConnection();
                        $stmt = $db->prepare('SELECT username, name FROM users WHERE id = ?');
                        $stmt->execute([$_SESSION['user_id']]);
                        $user = $stmt->fetch();
                        if($user) {
                            $username = $user['username'];
                            $name = $user['name'];
                        }
                        $hour = (int)date('H');
                        if ($hour >= 5 && $hour < 12) {
                            $greeting = 'Bom dia';
                        } elseif ($hour >= 12 && $hour < 18) {
                            $greeting = 'Boa tarde';
                        } else {
                            $greeting = 'Boa noite';
                        }
                    }
                ?>
                <span class="text-light me-3 d-none d-md-inline">Olá, <?= htmlspecialchars($name) ?>, <?= $greeting ?>! <small>(usuário: <b><?= htmlspecialchars($username) ?></b>)</small></span>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/logout">Logout</a>
            <?php else: ?>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container my-4">
