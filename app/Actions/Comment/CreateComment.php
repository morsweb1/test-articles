<?php

namespace App\Actions\Comment;

use App\Models\Article;
use App\Models\Comment;

class CreateComment
{
    /**
     * @param Article $article
     * @param array $data
     * @return void
     */
    public function __invoke(Article $article, array $data): void
    {
        $comment = Comment::create([
            'title' => $data['title'],
            'text' => $data['text'],
        ]);

        $article->comments()->save($comment);
    }
}
