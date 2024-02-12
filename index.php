<?php

require __DIR__ . '/vendor/autoload.php';

use DevStream\Models\Stream;
use Diego03\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// $connection = new PDO();

/*
    Entidades:
    - Usuários
    - Streams
    - Messages
    - Like
*/

$router->get('/', function () {
    $streams = Stream::all();

    // echo password_hash('12345678', PASSWORD_ARGON2I);

    require __DIR__ . '/views/home.php';
});

$router->get('/streams/:id', function ($id) {
    $stream = Stream::find($id);

    require __DIR__ . '/views/stream.php';
});

$route = $router->match(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

if ($route === null) {
    echo '404 Not Found';
    die;
}

$route['handler'](
    ...$route['params']
);
