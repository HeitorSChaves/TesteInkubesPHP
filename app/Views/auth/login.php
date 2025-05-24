<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2>Login</h2>
    <div id="login-alert"></div>
    <form id="login-form">
        <input type="email" name="email" required class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">Não tem conta? <a href="<?= BASE_URL ?>/register">Cadastre-se</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= BASE_URL ?>/login',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.success) {
                    $('#login-alert').html('<div class="alert alert-success">Login realizado! Redirecionando...</div>');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/tasks'; }, 1000);
                } else {
                    $('#login-alert').html('<div class="alert alert-danger">' + resp.error + '</div>');
                }
            },
            error: function(xhr) {
                $('#login-alert').html('<div class="alert alert-danger">Erro ao logar. Tente novamente.</div>');
            }
        });
    });
});
</script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
