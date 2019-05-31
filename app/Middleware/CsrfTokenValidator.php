<?php

namespace App\Middleware;

use App\Contracts\Middleware;
use App\Lib\Request;

class CsrfTokenValidator implements Middleware
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): Request
    {
        // TODO: check request for csrf token
        return $request;
    }
}
