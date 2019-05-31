<?php

namespace App\Contracts;

use App\Lib\Request;

interface Middleware
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request):Request;
}
