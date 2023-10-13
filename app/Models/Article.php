<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_published',
        'image',
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->orderByDesc('created_at');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
