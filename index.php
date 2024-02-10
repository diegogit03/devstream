<?php

require __DIR__ . '/vendor/autoload.php';

use Diego03\Router\Router;

$router = new Router();

$router->get('/', function () {
    echo '<h1>Hello World!</h1>';
});

$route = $router->match(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

$route['handler'](
    ...$route['params']
);
