<?php

namespace App\Controllers;

use App\Lib\Request;
use App\Models\Article;

class IndexController extends Controller
{
    public function show(Request $request)
    {
        echo $this->twig->load('index.twig')->render([
            'articles' => (new Article())->get(),
        ]);
    }
}