<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, Sluggable;

    // 17 + 3 = 20
    const EXCERPT_LENGHT = 17;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'category_id',
        'body',
        'creator_id',
        'published_at',
    ];

    public function excerpt(){
        // default ends: ...
        // return 20 characters of body
        return Str::limit($this->body, self::EXCERPT_LENGHT);
    }
    /**
     * Retrieves the category that this object belongs to.
     *
     * @return BelongsTo A relationship instance.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * A description of the entire PHP function.
     *
     * @param $query The query object.
     * @return The query object sorted by 'views' in descending order.
     */
    public function scopeMostviewed($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Returns a query builder instance for the 'information' category.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, string $category)
    {
        return $query->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    public function scopeSearch($query, string $searchQuery)
    {
        return $query->where(function ($query) use ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('body', 'like', '%' . $searchQuery . '%');
        });
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
            ->where('status', 'PUBLISHED')
            ->where('accepted', 1)
            ->orderBy('published_at', 'desc');
    }

    public function scopeAccepted($query)
    {
        return $query->where('accepted', true);
    }
}
