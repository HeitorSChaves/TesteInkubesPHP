<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Cadastro</h2>
    <form id="register-form">
        <input type="text" name="name" required class="form-control mb-2" placeholder="Nome completo">
        <input type="email" name="email" required class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <p class="mt-3">Já tem conta? <a href="<?= BASE_URL ?>/login">Faça login</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#register-form').on('submit', function(e) {
        e.preventDefault();
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
