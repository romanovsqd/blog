<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasSlug, HasFactory;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
        ? asset('storage/' . $this->image)
        : 'https://placehold.co/600x400';
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when(
            $search,
            function (Builder $query, string $search) {
                $query->where(function (Builder $q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            }
        );
    }

    public function scopeCategory(Builder $query, ?string $category): Builder
    {
        return $query->when(
            $category,
            function (Builder $query, string $category) {
                $query->whereHas('category', function (Builder $q) use ($category) {
                    $q->where('slug', $category);
                });
            }
        );
    }

    public function scopeSortByDate (Builder $query, ?string $sort): Builder
    {
        return $sort === 'oldest' ? $query->oldest() : $query->latest();
    }
}
