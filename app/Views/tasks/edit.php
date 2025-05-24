<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Editar Tarefa</h1>
<div id="edit-task-alert"></div>
<form id="edit-task-form">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" required><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" name="completed" class="form-check-input" <?= $task['completed'] ? 'checked' : '' ?>>
        <label class="form-check-label">Concluída</label>
    </div>
    <button class="btn btn-primary">Atualizar</button>
</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    $('#edit-task-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= BASE_URL ?>/tasks/update/<?= $task['id'] ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.success) {
                    $('#edit-task-alert').html('<div class="alert alert-success">Tarefa atualizada!</div>');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/tasks'; }, 1000);
                } else {
                    $('#edit-task-alert').html('<div class="alert alert-danger">' + resp.error + '</div>');
                }
            },
            error: function(xhr) {
                $('#edit-task-alert').html('<div class="alert alert-danger">Erro ao atualizar tarefa.</div>');
            }
        });
    });
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
