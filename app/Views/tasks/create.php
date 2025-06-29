<?php require __DIR__ . '/../partials/header.php'; ?>

<h1 class="mb-4 text-center">Criar Tarefa</h1>
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-7">
        <form method="POST" action="<?= BASE_URL ?>/tasks/store" id="create-task-form" class="card p-4 shadow-sm border-0 bg-white">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="title" class="form-control" required maxlength="100">
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="description" class="form-control" required maxlength="1000"></textarea>
            </div>
            <button class="btn btn-success w-100">Salvar</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#create-task-form').on('submit', function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true);
        $.ajax({
            url: '<?= BASE_URL ?>/tasks/store',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Tarefa criada com sucesso!',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => window.location.href = '<?= BASE_URL ?>/tasks');
                    setTimeout(function(){ window.location.href = '<?= BASE_URL ?>/tasks'; }, 1300);
                } else {
                    Swal.fire('Erro', resp.error, 'error');
                    btn.prop('disabled', false);
                }
            },
            error: function(xhr) {
                Swal.fire('Erro', 'Erro ao criar tarefa.', 'error');
                btn.prop('disabled', false);
            }
        });
    });
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
