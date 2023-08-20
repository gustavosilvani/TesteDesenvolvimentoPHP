<?php

require_once 'vendor/autoload.php';
require_once 'src/Application.php';

use src\Application;

$app = new Application();
$app->run();
