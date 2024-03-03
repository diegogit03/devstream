<?php $this->layout('layout') ?>

<?php $this->start('main') ?>
<form action="/login" method="POST" class="card">
    <div class="card-header">
        Entrar
    </div>
    <div class="card-body">
        <div class="mb-2">
            <label for="email" class="form-label">E-mail:</label>
            <input id="email" class="form-control" type="email" name="email" placeholder="e-mail" required>
        </div>
        <div>
            <label for="password" class="form-label">Senha:</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="senha" required>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="/register" class="btn btn-secondary">Registrar-se</a>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>
<?php $this->stop() ?>
