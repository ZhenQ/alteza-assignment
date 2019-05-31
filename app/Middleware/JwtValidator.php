<?php

namespace App\Middleware;

use App\Contracts\Middleware;
use App\Lib\Request;

class JwtValidator implements Middleware
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): Request
    {
        //TODO check jwt token validity
        return $request;
    }
}