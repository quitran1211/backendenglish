<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Helper: format author object
     */
    private function formatAuthor($author)
    {
        if (! $author) {
            return [
                'id' => null,
                'username' => null,
                'name' => 'Ẩn danh',
                'avatar' => null,
            ];
        }

        return [
            'id' => $author->id,
            'username' => $author->username ?? null,
            'name' => $author->name ?? 'Ẩn danh',
            'avatar' => $author->avatar
                ? (str_starts_with($author->avatar, 'http')
                    ? $author->avatar
                    : asset('storage/'.$author->avatar))
                : null,
        ];
    }

    /**
     * Danh sách bài viết
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author', 'tags'])
            ->published();

        if ($request->filled('category') && $request->category !== 'Tất cả') {
            $query->whereHas('category', fn ($q) => $q->where('name', $request->category)
            );
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $query->orderBy(
            $request->get('sort', 'published_at'),
            'desc'
        );

        $posts = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'data' => $posts->map(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'image' => $post->image ? asset('storage/'.$post->image) : null,
                'author' => $this->formatAuthor($post->author),
                'date' => optional($post->published_at)->format('d/m/Y'),
                'category' => $post->category->name,
                'readTime' => $post->read_time.' phút đọc',
                'tags' => $post->tags->pluck('name'),
                'views' => $post->views,
                'featured' => $post->is_featured,
            ]),
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
            ],
        ]);
    }

    /**
     * Chi tiết bài viết
     */
    public function show($slug)
    {
        $post = BlogPost::with(['category', 'author', 'tags'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'image' => $post->image ? asset('storage/'.$post->image) : null,
                'author' => $this->formatAuthor($post->author),
                'date' => optional($post->published_at)->format('d/m/Y'),
                'category' => [
                    'name' => $post->category->name,
                    'slug' => $post->category->slug,
                ],
                'readTime' => $post->read_time.' phút đọc',
                'tags' => $post->tags->map(fn ($tag) => [
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                ]),
                'views' => $post->views,
            ],
        ]);
    }

    /**
     * Danh mục
     */
    public function categories()
    {
        $categories = BlogCategory::active()
            ->withCount('posts')
            ->get()
            ->map(fn ($cat) => [
                'name' => $cat->name,
                'slug' => $cat->slug,
                'icon' => $cat->icon,
                'count' => $cat->posts_count,
            ]);

        $categories->prepend([
            'name' => 'Tất cả',
            'slug' => 'all',
            'icon' => '📚',
            'count' => BlogPost::published()->count(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Tags
     */
    public function tags()
    {
        $tags = BlogTag::has('posts')
            ->withCount(['posts' => fn ($q) => $q->published()])
            ->orderByDesc('posts_count')
            ->limit(20)
            ->get()
            ->map(fn ($tag) => [
                'name' => $tag->name,
                'slug' => $tag->slug,
                'count' => $tag->posts_count,
            ]);

        return response()->json([
            'success' => true,
            'data' => $tags,
        ]);
    }

    /**
     * Bài viết phổ biến
     */
    public function popular(Request $request)
    {
        $posts = BlogPost::published()
            ->orderByDesc('views')
            ->limit($request->get('limit', 5))
            ->get()
            ->map(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'views' => $post->views,
                'image' => $post->image ? asset('storage/'.$post->image) : null,
            ]);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    /**
     * Bài viết nổi bật
     */
    public function featured()
    {
        $posts = BlogPost::with(['category', 'author'])
            ->published()
            ->featured()
            ->orderByDesc('published_at')
            ->limit(3)
            ->get()
            ->map(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'image' => $post->image ? asset('storage/'.$post->image) : null,
                'author' => $this->formatAuthor($post->author),
                'date' => optional($post->published_at)->format('d/m/Y'),
                'category' => $post->category->name,
                'views' => $post->views,
            ]);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    /**
     * Bài viết liên quan
     */
    public function related($slug)
    {
        $post = BlogPost::with('tags')->where('slug', $slug)->firstOrFail();

        $related = BlogPost::with(['category', 'author'])
            ->published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category_id', $post->category_id)
                    ->orWhereHas('tags', fn ($t) => $t->whereIn('blog_tags.id', $post->tags->pluck('id'))
                    );
            })
            ->limit(4)
            ->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'excerpt' => $p->excerpt,
                'image' => $p->image ? asset('storage/'.$p->image) : null,
                'category' => $p->category->name,
                'author' => $this->formatAuthor($p->author),
            ]);

        return response()->json([
            'success' => true,
            'data' => $related,
        ]);
    }

    /**
     * Tăng lượt xem (chống tăng 2 lần)
     */
    public function increaseView(Request $request, $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $key = 'viewed_post_'.$post->id.'_'.$request->ip();

        if (! cache()->has($key)) {
            $post->increment('views');
            cache()->put($key, true, now()->addMinutes(30));
        }

        return response()->json(['success' => true]);
    }
}
