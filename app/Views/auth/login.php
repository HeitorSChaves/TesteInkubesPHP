<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2>Login</h2>
    <form id="login-form">
        <input type="text" name="email" required class="form-control mb-2" placeholder="E-mail ou usuário">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">Não tem conta? <a href="<?= BASE_URL ?>/register">Cadastre-se</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Login realizado!',
                        text: 'Redirecionando...',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => window.location.href = '<?= BASE_URL ?>/tasks');
                } else {
                    Swal.fire('Erro', resp.error, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Erro', 'Erro ao logar. Tente novamente.', 'error');
            }
        });
    });
});
</script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
