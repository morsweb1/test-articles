<?php

namespace App\Http\Controllers;

use App\Actions\Comment\CreateComment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Article $article, CreateComment $createComment)
    {
        $createComment($article, $request->validated());

        return to_route('articles.show', [
            'article' => new ArticleResource($article)
        ]);
    }
}
