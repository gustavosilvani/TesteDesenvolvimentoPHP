<?php

require_once 'vendor/autoload.php';
require_once 'src/Application.php';

use src\Application;
use src\Infrastructure\DatabaseConnection;
use src\Infrastructure\seeds\DatabaseSeeder;

$databaseConnection = new DatabaseConnection();
$databaseSeeder = new DatabaseSeeder($databaseConnection);
$databaseSeeder->seed();
$app = new Application();
$app->run();
