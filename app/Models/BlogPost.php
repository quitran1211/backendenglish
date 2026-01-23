<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category_id',
        'author_id',
        'views',
        'read_time',
        'is_featured',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'read_time' => 'integer',
    ];

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

            if (empty($post->read_time)) {
                $wordCount = str_word_count(strip_tags($post->content));
                $post->read_time = ceil($wordCount / 150);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

            if ($post->isDirty('content')) {
                $wordCount = str_word_count(strip_tags($post->content));
                $post->read_time = ceil($wordCount / 150);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'post_id', 'tag_id')
            ->withTimestamps();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                ->orWhere('content', 'like', "%{$searchTerm}%")
                ->orWhereHas('tags', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%{$searchTerm}%");
                });
        });
    }

    // Helpers
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getReadTimeAttribute($value)
    {
        return $value.' phút đọc';
    }
}
