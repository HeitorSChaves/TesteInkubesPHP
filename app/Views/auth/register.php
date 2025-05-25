<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2 class="mb-4 text-center">Cadastro</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-7 col-lg-6">
            <form id="register-form" autocomplete="off" class="card p-4 shadow-sm border-0 bg-white">
                <input type="text" name="name" required class="form-control mb-3" placeholder="Nome completo" maxlength="100" pattern="^[A-Za-zÀ-ÿ ']+$" title="Apenas letras e espaços" oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ ']/g, '')">
                <input type="email" name="email" required class="form-control mb-3" placeholder="Email" maxlength="100">
                <input type="password" name="password" required class="form-control mb-3" placeholder="Senha" minlength="6" maxlength="50" autocomplete="new-password">
                <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </form>
            <p class="mt-3 text-center">Já tem conta? <a href="<?= BASE_URL ?>/login">Faça login</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#register-form').on('submit', function(e) {
        e.preventDefault();
        // Validação extra JS
        var name = $('input[name=name]').val().trim();
        var email = $('input[name=email]').val().trim();
        var password = $('input[name=password]').val();
        var nameRegex = /^[A-Za-zÀ-ÿ ']+$/;
        var emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        if (!nameRegex.test(name)) {
            Swal.fire('Erro', 'Nome inválido. Use apenas letras e espaços.', 'error');
            return;
        }
        if (!emailRegex.test(email)) {
            Swal.fire('Erro', 'E-mail inválido.', 'error');
            return;
        }
        if (password.length < 6) {
            Swal.fire('Erro', 'A senha deve ter pelo menos 6 caracteres.', 'error');
            return;
        }
        $.ajax({
            url: '<?= BASE_URL ?>/register',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cadastro realizado!',
                        html: 'Seu usuário de acesso é:<br><b>' + resp.username + '</b><br>Redirecionando para o login...',
                        timer: 3500,
                        showConfirmButton: false
                    }).then(() => window.location.href = '<?= BASE_URL ?>/login');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/login'; }, 3600);
                } else {
                    Swal.fire('Erro', resp.error, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Erro', 'Erro ao cadastrar. Tente novamente.', 'error');
            }
        });
    });
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>
