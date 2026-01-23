<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')
            ->orderBy('order')
            ->paginate(20);

        return view('admin.blog.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_categories,slug',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        BlogCategory::create($validated);

        return back()->with('success', 'Tạo danh mục thành công!');
    }

    public function update(Request $request, BlogCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_categories,slug,'.$category->id,
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $category->update($validated);

        return back()->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(BlogCategory $category)
    {
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'Không thể xóa danh mục có bài viết!');
        }

        $category->delete();

        return back()->with('success', 'Xóa danh mục thành công!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer',
        ]);

        foreach ($request->orders as $id => $order) {
            BlogCategory::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    public function restore($id)
    {
        $category = BlogCategory::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()
            ->route('blog.categories.index')
            ->with('success', 'Khôi phục danh mục bài viết thành công!');
    }
}
