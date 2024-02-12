<?php

require __DIR__ . '/vendor/autoload.php';

use Diego03\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

$servername = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db = $_ENV['DB_NAME'];

$connection = new PDO("mysql:host={$servername};dbname={$db}", $user, $pass, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);

/*
    Entidades:
    - Usuários
    - Streams
    - Messages
    - Like
*/

$router->get('/', function () use ($connection) {
    $query = $connection->prepare('SELECT * FROM streams');
    $query->execute();

    $streams = $query->fetchAll();

    // echo password_hash('12345678', PASSWORD_ARGON2I);

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
