<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Editar Tarefa</h1>

<form method="POST" action="/testePhP/public/tasks/update/<?= $task['id'] ?>">
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

<?php require __DIR__ . '/../partials/footer.php'; ?>
