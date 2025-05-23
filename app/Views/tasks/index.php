<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4">Minhas Tarefas</h1>

<a class="btn btn-primary mb-3" href="/testePhP/public/tasks/create">Criar Nova Tarefa</a>

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
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= $task['completed'] ? 'Concluída' : 'Pendente' ?></td>
                <td>
                    <a href="/testePhP/public/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/testePhP/public/tasks/delete/<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../partials/footer.php'; ?>
