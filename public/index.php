<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config.php';
require __DIR__ . '/../routes.php'; //register routes

$app = new \App\Lib\App($config, $router);
