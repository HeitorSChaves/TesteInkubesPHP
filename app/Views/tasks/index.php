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
                    <td>
                    <?php
                        $status = 'Pendente';
                        if (isset($task['is_completed'])) {
                            if ($task['is_completed'] == 1) {
                                $status = 'Concluída';
                            } elseif ($task['is_completed'] == 2) {
                                $status = 'Em andamento';
                            } elseif ($task['is_completed'] == 3) {
                                $status = 'Aguardando revisão';
                            }
                        }
                        echo $status;
                    ?>
                    </td>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    // Criar tarefa
    $('#btn-create-task').on('click', function(e) {
        e.preventDefault();
        window.location.href = '<?= BASE_URL ?>/tasks/create';
    });

    // Editar tarefa
    $('.btn-edit-task').on('click', function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').data('id');
        window.location.href = '<?= BASE_URL ?>/tasks/edit/' + id;
    });

    // Excluir tarefa
    $('.btn-delete-task').on('click', function(e) {
        e.preventDefault();
        if(confirm('Tem certeza?')) {
            var id = $(this).closest('tr').data('id');
            $.ajax({
                url: '<?= BASE_URL ?>/tasks/delete/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(resp) {
                    if(resp.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: 'Tarefa excluída com sucesso!',
                            timer: 1200,
                            showConfirmButton: false
                        }).then(() => location.reload());
                        setTimeout(function(){ location.reload(); }, 1300);
                    } else {
                        Swal.fire('Erro', resp.error, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Erro', 'Erro ao excluir tarefa.', 'error');
                }
            });
        }
    });

    <?php if(isset($_SESSION['user_id'])): ?>
    <?php
        $db = (new \App\Core\Database())->getConnection();
        $stmt = $db->prepare('SELECT username FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        $username = $user ? $user['username'] : '';
    ?>
    $(document).ready(function() {
        if (window.sessionStorage && !sessionStorage.getItem('username_shown')) {
            Swal.fire({
                icon: 'info',
                title: 'Bem-vindo!',
                html: 'Seu usuário de acesso é:<br><b><?= htmlspecialchars($username) ?></b>',
                confirmButtonText: 'OK'
            });
            sessionStorage.setItem('username_shown', '1');
        }
    });
    <?php endif; ?>
});
</script>
<style>
@media (max-width: 768px) {
    .table-responsive { overflow-x: auto; }
    .table { font-size: 0.95rem; }
    .btn { font-size: 0.95rem; padding: 0.4rem 0.7rem; }
    h1.mb-4 { font-size: 1.3rem; }
}
</style>
<?php require __DIR__ . '/../partials/footer.php'; ?>
