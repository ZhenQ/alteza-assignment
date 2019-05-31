<?php

namespace App\Lib;

use App\Contracts\Middleware;

class App
{
    protected $config;

    /**
     * @param array $config
     * @param Router $router
     */
    public function __construct(array $config, Router $router)
    {
        $this->config = $config;

        $request = $this->runMiddleware(new Request());
        $router->go($request);
    }

    /**
     * @param $initialRequest
     * @return Request
     */
    private function runMiddleware($initialRequest): Request
    {
        return array_reduce($this->config['middleware'], function ($request, Middleware $middleware) use (&$initialRequest) {
            return $middleware->handle($request ?? $initialRequest);
        });
    }
}
