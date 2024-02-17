<?php

require __DIR__ . '/vendor/autoload.php';

use DevStream\Controllers\AuthController;
use DevStream\Controllers\StreamsController;
use Diego03\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

define('ROOT_DIR', __DIR__);

session_start();

/*
    Entidades:
    - Usuários
    - Streams
    - Messages
    - Like
*/

// echo password_hash('12345678', PASSWORD_ARGON2I);
$streamsController = new StreamsController();
$authController = new AuthController();

$router->get('/', fn () => $streamsController->index());
$router->get('/streams/:id', fn ($id) => $streamsController->show($id));
$router->get('/streams/create', fn ($id) => $streamsController->show($id));

$router->get('/login', fn () => $authController->create());
$router->post('/login', fn () => $authController->store());
$router->get('/logout', fn () => $authController->destroy());

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
