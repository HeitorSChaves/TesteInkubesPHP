<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2 class="mb-4 text-center">Login</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <form id="login-form" autocomplete="off" class="card p-4 shadow-sm border-0 bg-white">
                <input type="text" name="email" required class="form-control mb-3" placeholder="E-mail ou usuário" maxlength="100" pattern="^[A-Za-z0-9@._-]+$" title="Apenas letras, números e . _ - @">
                <input type="password" name="password" required class="form-control mb-3" placeholder="Senha" minlength="6" maxlength="50" autocomplete="current-password">
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <p class="mt-3 text-center">Não tem conta? <a href="<?= BASE_URL ?>/register">Cadastre-se</a></p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        // Validação extra JS
        var userOrEmail = $('input[name=email]').val().trim();
        var password = $('input[name=password]').val();
        var userRegex = /^[A-Za-z0-9@._-]+$/;
        if (!userRegex.test(userOrEmail)) {
            Swal.fire('Erro', 'Usuário ou e-mail inválido.', 'error');
            return;
        }
        if (password.length < 6) {
            Swal.fire('Erro', 'A senha deve ter pelo menos 6 caracteres.', 'error');
            return;
        }
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
