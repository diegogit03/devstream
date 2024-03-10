<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use DevStream\Models\Like;
use DevStream\Models\Message;
use DevStream\Models\User;
use Workerman\Worker;
use PHPSocketIO\SocketIO;

$sockets = [];

$io = new SocketIO(2021);
$io->on('connection', function ($socket) use ($io) {
    $socket->on('join_chat', function ($data) use ($socket) {
        global $sockets;

        $sockets[$socket->id] = $data;
        $socket->join($data['stream_id']);
    });

    $socket->on('message', function ($msg) use ($io, $socket) {
        global $sockets;

        $stream_id = $sockets[$socket->id]['stream_id'];
        $user = User::find($sockets[$socket->id]['user_id']);

        Message::create([
            'stream_id' => $stream_id,
            'user_id' => $user->id,
            'content' => $msg
        ]);

        $io->to($stream_id)->emit('message', [
            'message' => $msg,
            'name' => $user->name
        ]);
    });

    $socket->on('like', function () use ($io, $socket) {
        global $sockets;

        $socket_data = $sockets[$socket->id];

        $stream_id = $socket_data['stream_id'];

        $exists = Like::where('stream_id', $socket_data['stream_id'])
            ->where('user_id', $socket_data['user_id'])
            ->first();

        if ($exists) return;

        Like::create($socket_data);

        $io->to($stream_id)->emit('like');
    });
});

Worker::runAll();
