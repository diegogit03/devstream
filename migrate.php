<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Events\Dispatcher;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$capsule = new Capsule();

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container = Container::getInstance();
$databaseMigrationRepository = new DatabaseMigrationRepository($capsule->getDatabaseManager(), 'migration');
if (!$databaseMigrationRepository->repositoryExists()) {
    $databaseMigrationRepository->createRepository();
}
$container->instance(MigrationRepositoryInterface::class, $databaseMigrationRepository);
$container->instance(ConnectionResolverInterface::class, $capsule->getDatabaseManager());

$paths = [
    __DIR__ . '/migrations',
];

/** @var Migrator $migrator */
$migrator = $container->make(Migrator::class);

$type = $argv[1] ?? '';

if ($type === 'rollback') {
    $migrator->rollback($paths);
    die;
}

if ($type === 'refresh') {
    $migrator->rollback($paths);
    $migrator->run($paths);
    die;
}

$migrator->run($paths);


