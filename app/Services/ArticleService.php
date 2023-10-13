<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    public function create(array $data): Article
    {
        $imagePath = null;

        if (isset($data['image']))
            $imagePath = $this->saveImage($data['image']);

        $data['image'] = $imagePath;

        return Article::create($data);
    }

    public function update(Article $article, array $data): Article
    {
        $imagePath = $article->image;

        if (isset($data['image']))
            $imagePath = $this->saveImage($data['image']);

        if ($article->image && isset($data['image']))
            Storage::delete($article->image);

        $data['image'] = $imagePath;

        $article->update($data);

        return $article;
    }

    public function saveImage($file): string
    {
        $path = Storage::put('article', $file);

        return $path;
    }

    public function delete(Article $article)
    {
        $article->delete();
    }
}
