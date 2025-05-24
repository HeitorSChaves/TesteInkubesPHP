<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Minhas Tarefas</h1>
<div id="tasks-alert"></div>
<a class="btn btn-primary mb-3" href="#" id="btn-create-task">Criar Nova Tarefa</a>
<div id="tasks-list">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tasks as $task): ?>
                <tr data-id="<?= $task['id'] ?>">
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td><?= $task['completed'] ? 'Concluída' : 'Pendente' ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning btn-edit-task">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete-task">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="task-form-modal" style="display:none;"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
// Funções AJAX para CRUD de tarefas
// ... (implementação será feita nos arquivos de create/edit)
</script>
<?php require __DIR__ . '/../partials/footer.php'; ?>
