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
                <span class="text-light me-3">Olá, <?= htmlspecialchars($name) ?>, <?= $greeting ?>! <small>(usuário: <b><?= htmlspecialchars($username) ?></b>)</small></span>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/logout">Logout</a>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                $(function() {
                    if (window.sessionStorage && !sessionStorage.getItem('username_shown')) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Bem-vindo!',
                            html: 'Seu usuário de acesso é:<br><b><?= htmlspecialchars($username) ?></b>',
                            confirmButtonText: 'OK'
                        });
                        sessionStorage.setItem('username_shown', '1');
                    }
                });
                </script>
            <?php else: ?>
                <a class="btn btn-outline-light" href="<?= BASE_URL ?>/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
