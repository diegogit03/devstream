<?php

function dd() {
    echo '<pre>';
    var_dump( func_get_args() );
    echo '</pre>';
    die;
}

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_DIR', __DIR__);

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();
