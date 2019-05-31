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

    public function show(Request $request, array $params)
    {
        echo json_encode((new User())->get($params['userId']));
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
        return (new User())->update(1, [
            'name' => $request->get('name'),
            'role_id' => $request->get('role_id'),
        ]);
    }
}