<?php

require __DIR__ . '/vendor/autoload.php';

use Diego03\Router\Router;

$router = new Router();

/*
    Entidades:
    - Usuários
    - Streams
    - Messages
    - Like
*/

$router->get('/', function () {
    require __DIR__ . '/views/home.php';
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
