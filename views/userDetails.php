<?php $this->layout('layout') ?>

<?php $this->start('main') ?>
    <h2><?= $user->name ?></h2>
    <ul>
        <?php foreach($streams as $stream) { ?>
            <li><a href="/streams/<?= $stream->id ?>"><?= $stream->title ?></a></li>
        <?php } ?>
    </ul>
<?php $this->stop() ?>
