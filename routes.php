<?php

use App\Controllers\AuthController;
use App\Controllers\ArticleController;
use App\Controllers\IndexController;
use App\Controllers\UserController;

use App\Lib\Router;


$router = new Router();

//home
$router->get('/', [new IndexController, 'show']);

//users
$router->get('/users', [new UserController, 'index']);
$router->get('/users/:userId/edit', [new UserController, 'edit']);
$router->post('/users', [new UserController, 'store']);
$router->post('/users/update', [new UserController, 'update']);

//articles
$router->get('/articles', [new ArticleController, 'create']);
$router->get('/articles/:articleId', [new ArticleController, 'show']);
$router->post('/articles', [new ArticleController, 'store']);

//auth
$router->post('/login', [new AuthController, 'login']);