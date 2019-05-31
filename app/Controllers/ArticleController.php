<?php

namespace App\Controllers;

use App\Lib\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Request $request, array $params)
    {
        echo json_encode((new Article())->get($params['articleId']));
    }

    public function create(Request $request)
    {
        echo $this->twig->load('articles.twig')->render();
    }

    public function store(Request $request)
    {
        (new Article())->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $request->get('user_id'),
        ]);

        $this->create($request);
    }

    public function update(Request $request): bool
    {
        return (new article())->update(1, [
            'title' => $request->get('role_id'),
            'body' => $request->get('body'),
        ]);
    }

    public function reactions()
    {

    }
}