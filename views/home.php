<?php $this->layout('layout', ['title' => 'User Profile']) ?>

<?php $this->start('main') ?>
<ul>
    <?php foreach ($streams as $stream) { ?>
        <li><a href="/streams/<?= $stream->id ?>"><?= $stream->title ?></a></li>
    <?php } ?>
</ul>
<?php $this->stop() ?>
