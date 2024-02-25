<?php $this->layout('layout') ?>

<?php $this->start('assets') ?>
    <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->start('main') ?>
<div class="row">
    <div class="col-12 col-md-8">
        <video id='stream-player' class="video-js vjs-default-skin w-100" width="400" height="300" controls>
            <source type="application/x-mpegURL" src="https://a803272ee73cc7.lhr.life/hls/<?= $stream->record_id ?>.m3u8">
        </video>
        <h2><?= $stream->title ?></h2>
    </div>
    <div class="col-12 col-md-4">
        <h3>Chat</h3>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('scripts') ?>
    <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script>

    <script>
        var player = videojs('stream-player');
        player.play();
    </script>
<?php $this->stop() ?>
