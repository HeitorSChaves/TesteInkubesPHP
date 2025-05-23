<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Registrar</h2>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= BASE_URL ?>/register">
        <input type="email" name="email" required class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
