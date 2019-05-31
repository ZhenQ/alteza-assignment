<?php

namespace App\Middleware;

use App\Contracts\Middleware;
use App\Lib\Request;

class Trim implements Middleware
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): Request
    {
        //TODO trim whitespaces off incoming request inputs
    }
}