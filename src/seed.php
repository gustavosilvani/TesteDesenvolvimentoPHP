<?php

require 'vendor/autoload.php';

use src\Infrastructure\seeds\DatabaseSeeder;
use src\Infrastructure\DatabaseConnection;

$databaseConnection = new DatabaseConnection();

$databaseSeeder = new DatabaseSeeder($databaseConnection);

$databaseSeeder->seed();