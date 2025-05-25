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
        <?php if(isset($_SESSION['user_id'])): ?>
        <div class="d-flex align-items-center ms-auto flex-wrap flex-row gap-2">
            <?php
            require_once __DIR__ . '/../../Core/UserGreeting.php';
            $greetingObj = new \App\Core\UserGreeting($_SESSION);
            ?>
            <span class="text-light d-flex align-items-center flex-wrap" style="gap:0.5rem;">
                Olá, <b><?= $greetingObj->getFirstName() ?></b>, <?= $greetingObj->getGreeting() ?>!
                <span id="navbar-clock" class="text-light fw-bold" style="font-family:monospace;"></span>
                <small class="ms-1">(usuário: <b><?= $greetingObj->getUsername() ?></b>)</small>
            </span>
            <a class="btn btn-outline-light ms-2" href="<?= BASE_URL ?>/logout">Logout</a>
        </div>
        <?php endif; ?>
    </div>
</nav>
<?php if(isset($_SESSION['user_id'])): ?>
<script>
function updateNavbarClock() {
    fetch('<?= BASE_URL ?>/clock.php')
        .then(resp => resp.text())
        .then(time => {
            document.getElementById('navbar-clock').textContent = time;
        });
}
setInterval(updateNavbarClock, 1000);
updateNavbarClock();
</script>
<style>
@media (max-width: 991px) {
    .navbar .d-flex.align-items-center {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 0.3rem !important;
    }
    .navbar .d-flex.align-items-center span {
        font-size: 1rem;
        flex-wrap: wrap;
    }
    .navbar .btn {
        width: 100%;
        margin-left: 0 !important;
    }
}
@media (max-width: 600px) {
    .navbar .d-flex.align-items-center span {
        font-size: 0.95rem;
    }
    .navbar .btn {
        font-size: 0.95rem;
        padding: 0.4rem 0.7rem;
    }
}
</style>
<?php endif; ?>
<div class="container my-4">
