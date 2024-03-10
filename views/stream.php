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
                        <source type="application/x-mpegURL" src="https://e3a8ea657b92bb.lhr.life/hls/<?= $stream->record_id ?>.m3u8">
                        <!-- <source type="application/x-mpegURL" src="https://demo.unified-streaming.com/k8s/features/stable/video/tears-of-steel/tears-of-steel.ism/.m3u8"> -->
                    </video>
                </div>
                <h2><?= $stream->title ?></h2>
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="https://ui-avatars.com/api/?name=<?= $stream->user->name ?>" alt="" style="width: 50px;">
                        <span><?= $stream->user->name ?></span>
                    </div>
                    <button id="like-button" type="button" class="btn btn-primary">
                        <i class="bi bi-heart"></i>
                        <span id="likes-count">38</span>
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
                <ul id="messages-container">
                    <?php foreach ($stream->messages as $message) { ?>
                        <li><span class="text-secondary"><?= $message->user->name ?>:</span> <?= $message->content ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="card-footer">
                <form id="message-form" class="input-group">
                    <input id="message-input" type="text" class="form-control" placeholder="Enviar uma mensagem">
                    <button class="input-group-text btn btn-primary">
                        <i class="bi bi-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('scripts') ?>
    <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.0/socket.io.js" integrity="sha512-arrjWL9j77mqBliRaQx5EutCwBC7259LWHAkOhDVpCoGVx4sRMcnYBBs0HedwvLvWqn7/bmBlr20eiESgHe2tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var player = videojs('stream-player');
        player.play();

        const socket = io('http://localhost:2021');

        socket.emit('join_chat', {
            stream_id: <?= $stream->id ?>,
            user_id: <?= $user_id ?>
        });

        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input')
        const messagesContainer = document.getElementById('messages-container');

        const likesCount = document.getElementById('likes-count');
        const likeButton = document.getElementById('like-button');

        function addMessage(message) {
            const messageEl = document.createElement('li');
            messageEl.innerHTML = `<span class="text-secondary">${message.name}:</span> ${message.message}`;
            messagesContainer.appendChild(messageEl);
        }

        messageForm.addEventListener('submit', e => {
            e.preventDefault();

            socket.emit('message', messageInput.value);
        });

        socket.on('message', message => {
            addMessage(message);
        });

        likeButton.addEventListener('click', function () {
            this.disabled = true;
            socket.emit('like');
        });

        socket.on('like',() => {
            likesCount.innerText = Number(likesCount.innerText) + 1;
        });
    </script>
<?php $this->stop() ?>
