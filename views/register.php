<?php $this->layout('layout') ?>

<?php $this->start('main') ?>
<form action="/register" method="POST" class="card">
    <div class="card-header">
        Registrar-se
    </div>
    <div class="card-body">
        <div class="mb-2">
            <label for="name" class="form-label">Nome:</label>
            <input id="name" class="form-control" type="text" name="name" placeholder="Nome" required>
        </div>
        <div class="mb-2">
            <label for="email" class="form-label">E-mail:</label>
            <input id="email" class="form-control" type="email" name="email" placeholder="E-mail" required>
        </div>
        <div>
            <label for="password" class="form-label">Senha:</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="Senha" required>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</form>
<?php $this->stop() ?>
