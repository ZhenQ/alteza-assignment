<?php

namespace App\Lib;


class Request
{
    public function path():string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function get(string $key):string
    {
        return $_REQUEST[$key];
    }

    public function method():string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
