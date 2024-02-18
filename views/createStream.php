<?php $this->layout('layout', ['title' => 'User Profile']) ?>

<?php $this->start('main') ?>
    <form action="/streams" method="POST">
        <input class="form-control" type="text" name="title" id="">
        <button class="btn btn-primary" type="submit">Criar</button>
    </form>
<?php $this->stop() ?>
