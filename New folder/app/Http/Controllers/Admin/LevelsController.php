<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::orderBy('display_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'level_code' => 'required|string|max:50|unique:levels,level_code',
            'level_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'target_score' => 'required|string|max:20',
            'total_words' => 'nullable|integer|min:0',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'level_code.required' => 'Mã cấp độ là bắt buộc',
            'level_code.unique' => 'Mã cấp độ đã tồn tại',
            'level_name.required' => 'Tên cấp độ là bắt buộc',
            'target_score.required' => 'Điểm mục tiêu là bắt buộc',
            'target_score.min' => 'Điểm mục tiêu phải từ 0 trở lên',
            'target_score.max' => 'Điểm mục tiêu không vượt quá 990',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Level::create($validated);

        return redirect()->route('levels.index')
            ->with('success', 'Thêm cấp độ mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return view('admin.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'level_code' => 'required|string|max:50|unique:levels,level_code,'.$level->id,
            'level_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'target_score' => 'required|string|max:20',
            'total_words' => 'nullable|integer|min:0',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'level_code.required' => 'Mã cấp độ là bắt buộc',
            'level_code.unique' => 'Mã cấp độ đã tồn tại',
            'level_name.required' => 'Tên cấp độ là bắt buộc',
            'target_score.required' => 'Điểm mục tiêu là bắt buộc',
            'target_score.min' => 'Điểm mục tiêu phải từ 0 trở lên',
            'target_score.max' => 'Điểm mục tiêu không vượt quá 990',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $level->update($validated);

        return redirect()->route('levels.index')
            ->with('success', 'Cập nhật cấp độ thành công!');
    }

    /**
     * Show trashed levels
     */
    public function trash()
    {
        $levels = Level::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('admin.levels.trash', compact('levels'));
    }

    /**
     * Restore a trashed level
     */
    public function restore($id)
    {
        $level = Level::onlyTrashed()->findOrFail($id);
        $level->restore();

        return redirect()->back()
            ->with('success', 'Khôi phục cấp độ thành công!');
    }

    /**
     * Force delete a level permanently
     */
    public function forceDelete($id)
    {
        $level = Level::onlyTrashed()->findOrFail($id);
        $level->forceDelete();

        return redirect()->back()
            ->with('success', 'Xóa vĩnh viễn cấp độ thành công!');
    }

    /**
     * Empty trash - delete all trashed levels
     */
    public function emptyTrash()
    {
        Level::onlyTrashed()->forceDelete();

        return redirect()->back()
            ->with('success', 'Đã xóa vĩnh viễn tất cả các mục trong thùng rác!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        try {
            // Kiểm tra xem có lesson nào đang sử dụng level này không
            if ($level->lessons()->count() > 0) {
                return redirect()->route('levels.index')
                    ->with('error', 'Không thể xóa cấp độ này vì đang có bài học sử dụng!');
            }

            $level->delete();

            return redirect()->route('levels.index')
                ->with('success', 'Xóa cấp độ thành công!');
        } catch (\Exception $e) {
            return redirect()->route('levels.index')
                ->with('error', 'Có lỗi xảy ra khi xóa cấp độ!');
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(string $id)
    {
        $level = Level::findOrFail($id);
        $level->is_active = ! $level->is_active;
        $level->save();

        $status = $level->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return redirect()->route('levels.index')->with('success', "Đã {$status} bài học thành công");
    }
}
