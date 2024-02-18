<?php

require __DIR__ . '/vendor/autoload.php';

use DevStream\Controllers\AuthController;
use DevStream\Controllers\StreamsController;
use League\Route\Router;

define('ROOT_DIR', __DIR__);

session_start();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router;

// echo password_hash('12345678', PASSWORD_ARGON2I);
$streamsController = new StreamsController();
$authController = new AuthController();

$router->get('/', [StreamsController::class, 'index']);
$router->get('/streams/create', [StreamsController::class, 'create']);
$router->post('/streams', [StreamsController::class, 'store']);
$router->get('/streams/{id}', [StreamsController::class, 'show']);

$router->get('/login', fn () => $authController->create());
$router->post('/login', fn () => $authController->store());
$router->get('/logout', fn () => $authController->destroy());

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
