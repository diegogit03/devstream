<?php $this->layout('layout') ?>

<?php $this->start('assets') ?>
    <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">
    <style>
        .chat-body {
            height: 400px;
            overflow-y: scroll;
        }

        .chat-body ul {
            list-style: none;
            padding: 0
        }
    </style>
<?php $this->end() ?>

<?php $this->start('main') ?>
<div class="row pt-2">
    <div class="col-12 col-md-8 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <video id='stream-player' class="video-js vjs-default-skin w-100" width="400" height="300" controls>
                        <source type="application/x-mpegURL" src="http://localhost:8080/hls/<?= $stream->record_id ?>.m3u8">
                    </video>
                </div>
                <h2><?= $stream->title ?></h2>
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="https://ui-avatars.com/api/?name=<?= $user->name ?>" alt="" style="width: 50px;">
                        <span><?= $user->name ?></span>
                    </div>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-heart"></i>
                        38
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Chat</h4>
            </div>
            <div class="card-body chat-body">
                <ul>
                    <li><span class="text-secondary">Diego:</span> Olá, mundo</li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enviar uma mensagem">
                    <button class="input-group-text btn btn-primary">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </div>
        </div>
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
