<?php

function dd() {
    echo '<pre>';
    var_dump( func_get_args() );
    echo '</pre>';
    die;
}

require __DIR__ . '/vendor/autoload.php';

use DevStream\Controllers\AuthController;
use DevStream\Controllers\StreamsController;
use DevStream\Controllers\UsersController;
use League\Route\Router;

define('ROOT_DIR', __DIR__);

session_start();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

// form spoofing
if (isset($request->getQueryParams()['_method'])) {
    $request = $request->withMethod($request->getQueryParams()['_method']);
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router;

$authController = new AuthController();

$router->get('/', [StreamsController::class, 'index']);
$router->get('/streams/create', [StreamsController::class, 'create']);
$router->post('/streams', [StreamsController::class, 'store']);
$router->get('/streams/{id}', [StreamsController::class, 'show']);
$router->put('/streams/{id}', [StreamsController::class, 'update']);
$router->get('/streams/{id}/edit', [StreamsController::class, 'edit']);

$router->get('/users/{id}', [UsersController::class, 'show']);
$router->get('/register', [UsersController::class, 'create']);
$router->post('/register', [UsersController::class, 'store']);

$router->get('/login', [AuthController::class, 'create']);
$router->post('/login', [AuthController::class, 'store']);
$router->get('/logout', [AuthController::class, 'destroy']);

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
