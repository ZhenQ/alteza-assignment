<?php

$config = [
    'json_token' => 'randomly-generated-token',
    'middleware' => [
        new \App\Middleware\CsrfTokenValidator(),
        new \App\Middleware\JwtValidator(),
        new \App\Middleware\Auth(),
    ]
];
