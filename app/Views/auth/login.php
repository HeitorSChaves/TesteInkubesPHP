<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Login</h2>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= BASE_URL ?>/login">
        <input type="email" name="email" required class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
