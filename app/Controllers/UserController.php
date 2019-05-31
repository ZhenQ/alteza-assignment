<?php

namespace App\Controllers;

use App\Lib\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        echo $this->twig->load('users.twig')->render([
            'users' => (new User())->get(),
        ]);
    }

    public function edit(Request $request, array $params)
    {
        echo $this->twig->load('user_edit.twig')->render([
            'user' => (new User())->get($params['userId'])[0],
        ]);
    }

    public function store(Request $request)
    {
        (new User())->create([
            'name' => $request->get('name'),
            'role_id' => $request->get('role_id'),
        ]);

        $this->index();
    }

    public function update(Request $request): bool
    {
        (new User())->update(1, [
            'name' => $request->get('name'),
            'role_id' => $request->get('role_id'),
        ]);

        $this->index();
    }
}