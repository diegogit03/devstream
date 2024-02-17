<?php $this->layout('layout', ['title' => 'User Profile']) ?>

<?php $this->start('main') ?>
    <form action="/login" method="post">
        <input class="form-control" type="email" name="email" placeholder="e-mail" required>
        <input class="form-control" type="password" name="password" placeholder="senha" required>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
<?php $this->stop() ?>
