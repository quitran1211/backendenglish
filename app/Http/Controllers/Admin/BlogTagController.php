<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('posts')
            ->orderBy('name')
            ->paginate(50);

        return view('admin.blog.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:blog_tags,name',
            'slug' => 'nullable|string|unique:blog_tags,slug',
        ]);

        BlogTag::create($validated);

        return back()->with('success', 'Tạo tag thành công!');
    }

    public function update(Request $request, BlogTag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:blog_tags,name,'.$tag->id,
            'slug' => 'nullable|string|unique:blog_tags,slug,'.$tag->id,
        ]);

        $tag->update($validated);

        return back()->with('success', 'Cập nhật tag thành công!');
    }

    public function destroy(BlogTag $tag)
    {
        $tag->delete();

        return back()->with('success', 'Xóa tag thành công!');
    }

    /**
     * API search tags (select2)
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $tags = BlogTag::where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'name']);

        return response()->json($tags);
    }

    /**
     * Tạo tag nhanh
     */
    public function quickCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:blog_tags,name',
        ]);

        $tag = BlogTag::create($validated);

        return response()->json([
            'success' => true,
            'tag' => $tag,
        ]);
    }

    /**
     * Merge tags
     */
    public function merge(Request $request)
    {
        $request->validate([
            'source_ids' => 'required|array',
            'source_ids.*' => 'exists:blog_tags,id',
            'target_id' => 'required|exists:blog_tags,id|different:source_ids.*',
        ]);

        $targetTag = BlogTag::findOrFail($request->target_id);
        $sourceTags = BlogTag::whereIn('id', $request->source_ids)->get();

        foreach ($sourceTags as $sourceTag) {
            foreach ($sourceTag->posts as $post) {
                if (! $post->tags->contains($targetTag->id)) {
                    $post->tags()->attach($targetTag->id);
                }
            }

            $sourceTag->delete();
        }

        return back()->with('success', 'Gộp tags thành công!');
    }
}
