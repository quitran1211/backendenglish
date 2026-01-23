<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Hiển thị danh sách bài viết
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author', 'tags']);

        // Lọc theo category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Lọc theo trạng thái
        if ($request->has('status')) {
            if ($request->status == 'published') {
                $query->published();
            } elseif ($request->status == 'draft') {
                $query->where('is_published', false);
            } elseif ($request->status == 'featured') {
                $query->featured();
            }
        }

        // Tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        // Sắp xếp
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $posts = $query->paginate(20);
        $categories = BlogCategory::active()->get();

        return view('admin.blog.index', compact('posts', 'categories'));
    }

    /**
     * Hiển thị form tạo bài viết mới
     */
    public function create()
    {
        $categories = BlogCategory::active()->get();
        $tags = BlogTag::orderBy('name')->get();

        return view('admin.blog.create', compact('categories', 'tags'));
    }

    /**
     * Lưu bài viết mới
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['author_id'] = auth('admin')->id();

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()
            ->route('blog.index')
            ->with('success', 'Tạo bài viết thành công!');
    }

    /**
     * Hiển thị chi tiết bài viết
     */
    public function show(BlogPost $post)
    {
        $post->load(['category', 'author', 'tags']);

        return view('admin.blog.show', compact('post'));
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::active()->get();
        $tags = BlogTag::orderBy('name')->get();
        $post->load('tags');

        return view('admin.blog.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Cập nhật bài viết
     */
    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug,'.$post->id,
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        if ($validated['is_published'] && ! $post->is_published && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()
            ->route('blog.index')
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Xóa bài viết (soft delete)
     */
    public function destroy(BlogPost $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('blog.index')
            ->with('success', 'Xóa bài viết thành công!');
    }

    public function trash()
    {
        $posts = BlogPost::onlyTrashed()
            ->with(['category', 'author'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(20);

        return view('admin.blog.trash', compact('posts'));
    }

    /**
     * Khôi phục bài viết đã xóa
     */
    public function restore($id)
    {
        $post = BlogPost::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()
            ->route('blog.index')
            ->with('success', 'Khôi phục bài viết thành công!');
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete($id)
    {
        $post = BlogPost::withTrashed()->findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->forceDelete();

        return redirect()
            ->route('blog.index')
            ->with('success', 'Xóa vĩnh viễn bài viết thành công!');
    }

    /**
     * Toggle featured
     */
    public function toggleFeatured(BlogPost $post)
    {
        $post->update(['is_featured' => ! $post->is_featured]);

        return back()->with('success', 'Cập nhật trạng thái nổi bật thành công!');
    }

    /**
     * Toggle published
     */
    public function togglePublished(BlogPost $post)
    {
        $isPublished = ! $post->is_published;
        $data = ['is_published' => $isPublished];

        if ($isPublished && ! $post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return back()->with('success', 'Cập nhật trạng thái xuất bản thành công!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,unpublish,feature,unfeature',
            'ids' => 'required|array',
            'ids.*' => 'exists:blog_posts,id',
        ]);

        $posts = BlogPost::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'delete':
                $posts->delete();
                $message = 'Xóa bài viết thành công!';
                break;
            case 'publish':
                $posts->update(['is_published' => true, 'published_at' => now()]);
                $message = 'Xuất bản bài viết thành công!';
                break;
            case 'unpublish':
                $posts->update(['is_published' => false]);
                $message = 'Hủy xuất bản bài viết thành công!';
                break;
            case 'feature':
                $posts->update(['is_featured' => true]);
                $message = 'Đánh dấu nổi bật thành công!';
                break;
            case 'unfeature':
                $posts->update(['is_featured' => false]);
                $message = 'Bỏ đánh dấu nổi bật thành công!';
                break;
        }

        return back()->with('success', $message);
    }
}
