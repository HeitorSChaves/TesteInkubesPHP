<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Criar Tarefa</h1>

<form method="POST" action="/testePhP/public/tasks/store">
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

<?php require __DIR__ . '/../partials/footer.php'; ?>
