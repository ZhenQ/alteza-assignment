<?php

use App\Controllers\ArticleController;
use App\Lib\Router;

use App\Controllers\IndexController;
use App\Controllers\UserController;

$router = new Router();

//home
$router->get('/', [new IndexController, 'show']);

//users
$router->get('/users', [new UserController, 'index']);
$router->get('/users/:userId', [new UserController, 'show']);
$router->post('/users', [new UserController, 'store']);
$router->put('/users', [new UserController, 'update']);

//articles
$router->get('/articles', [new ArticleController, 'create']);
$router->get('/articles/:articleId', [new ArticleController, 'show']);
