<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Criar Tarefa</h1>
<div id="create-task-alert"></div>
<form id="create-task-form">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <button class="btn btn-success">Salvar</button>
</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    $('#create-task-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= BASE_URL ?>/tasks/store',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.success) {
                    $('#create-task-alert').html('<div class="alert alert-success">Tarefa criada!</div>');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/tasks'; }, 1000);
                } else {
                    $('#create-task-alert').html('<div class="alert alert-danger">' + resp.error + '</div>');
                }
            },
            error: function(xhr) {
                $('#create-task-alert').html('<div class="alert alert-danger">Erro ao criar tarefa.</div>');
            }
        });
    });
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
