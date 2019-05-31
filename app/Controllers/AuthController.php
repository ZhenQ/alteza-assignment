<?php

namespace App\Controllers;


use App\Lib\Request;
use App\Models\User;

class AuthController
{
    public function login(Request $request)
    {
        $name = $request->get('name');

        $user = (new User())->query("SELECT * FROM Users WHERE name = '$name'")->fetch();

        if (password_verify($request->get('password'), $user['password'])) {
            //User sign in and redirect
        }

        http_response_code(401);
        die('Unauthorized');
    }
}