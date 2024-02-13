<?php

require __DIR__ . '/vendor/autoload.php';

use DevStream\Controllers\StreamsController;
use Diego03\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

define('ROOT_DIR', __DIR__);

// $connection = new PDO();

/*
    Entidades:
    - Usuários
    - Streams
    - Messages
    - Like
*/

// echo password_hash('12345678', PASSWORD_ARGON2I);
$streamsController = new StreamsController();

$router->get('/', fn () => $streamsController->index());
$router->get('/streams/:id', fn ($id) => $streamsController->show($id));

$route = $router->match(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

if ($route === null) {
    echo '404 Not Found';
    die;
}

echo $route['handler'](
    ...$route['params']
);
