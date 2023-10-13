<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Articles/Index', [
            'articles' => ArticleResource::collection(
                Article::orderByDesc('created_at')->paginate(12)
            )
        ]);
    }

    public function show(Article $article)
    {
        return Inertia::render('Articles/Show', [
            'article' => new ArticleResource($article)
        ]);
    }
}
