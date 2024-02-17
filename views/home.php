<?php $this->layout('layout', ['title' => 'User Profile']) ?>

<?php $this->start('main') ?>
    <?php foreach ($streams as $stream) { ?>
        <a href="/streams/<?= $stream->id ?>"><?= $stream->title ?></a>
    <?php } ?>
<?php $this->stop() ?>
