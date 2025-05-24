<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Cadastro</h2>
    <div id="register-alert"></div>
    <form id="register-form">
        <input type="email" name="email" required class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" required class="form-control mb-2" placeholder="Senha">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <p class="mt-3">Já tem conta? <a href="<?= BASE_URL ?>/login">Faça login</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                    $('#register-alert').html('<div class="alert alert-success">Cadastro realizado com sucesso! Redirecionando...</div>');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/login'; }, 1500);
                } else {
                    $('#register-alert').html('<div class="alert alert-danger">' + resp.error + '</div>');
                }
            },
            error: function(xhr) {
                $('#register-alert').html('<div class="alert alert-danger">Erro ao cadastrar. Tente novamente.</div>');
            }
        });
    });
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>
