<?php

namespace App\Middleware;

use App\Contracts\Middleware;
use App\Lib\Request;

class Auth implements Middleware
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): Request
    {
        // TODO: Check if user is authenticated
        return $request;
    }
}