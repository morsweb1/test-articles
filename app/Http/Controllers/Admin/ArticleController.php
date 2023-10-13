<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    protected int $paginateCount = 12;

    public function index()
    {
        return Inertia::render('Admin/Articles/Index', [
            'articles' => ArticleResource::collection(
                Article::orderByDesc('created_at')->get()
            )
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Articles/Create');
    }

    public function store(ArticleStoreRequest $request, ArticleService $service)
    {
        $service->create($request->validated());

        return to_route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        return Inertia::render('Admin/Articles/Edit', ['article' => $article]);
    }

    public function update(ArticleUpdateRequest $request, Article $article, ArticleService $service)
    {
        $service->update($article, $request->validated());

        return to_route('admin.articles.index');
    }

    public function destroy(Article $article, ArticleService $service)
    {
        $service->delete($article);

        return to_route('admin.articles.index');
    }
}
