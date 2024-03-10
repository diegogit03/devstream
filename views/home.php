<?php $this->layout('layout', ['title' => 'User Profile']) ?>

<?php $this->start('main') ?>
<div class="row g-2 pt-2">
    <?php foreach ($streams as $stream) { ?>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
                <img src="/uploads/<?= $stream->image_filename ?>" class="card-img-top" alt="...">
                <div class="card-body d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Devstream" style="width: 50px">
                    <div>
                        <a class="card-title" href="/streams/<?= $stream->id ?>"><?= $stream->title ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php $this->stop() ?>
