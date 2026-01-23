<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\ExerciseOption;
use Illuminate\Http\Request;

class ExerciseOptionController extends Controller
{
    /**
     * Danh sách đáp án của exercise
     */
    public function index(Exercise $exercise)
    {
        $list = $exercise->options()
            ->orderByDesc('is_correct')
            ->paginate(10);

        return view('admin.exercise_options.index', compact('exercise', 'list'));
    }

    /**
     * Form tạo đáp án
     */
    public function create(Exercise $exercise)
    {
        return view('admin.exercise_options.create', compact('exercise'));
    }

    /**
     * Lưu đáp án mới
     */
    public function store(Request $request, Exercise $exercise)
    {
        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct' => 'nullable|boolean',
        ]);

        // Nếu chọn là đáp án đúng → reset các đáp án khác
        if ($request->boolean('is_correct')) {
            ExerciseOption::where('exercise_id', $exercise->id)
                ->update(['is_correct' => false]);
        }

        ExerciseOption::create([
            'exercise_id' => $exercise->id,
            'option_text' => $request->option_text,
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()
            ->route('exercise.options.index', $exercise->id)
            ->with('success', 'Thêm đáp án thành công');
    }

    /**
     * Chi tiết đáp án
     */
    public function show(Exercise $exercise, ExerciseOption $option)
    {
        $this->checkOwner($exercise, $option);

        return view('admin.exercise_options.show', compact('exercise', 'option'));
    }

    /**
     * Form chỉnh sửa đáp án
     */
    public function edit(Exercise $exercise, ExerciseOption $option)
    {
        $this->checkOwner($exercise, $option);

        return view('admin.exercise_options.edit', compact('exercise', 'option'));
    }

    /**
     * Cập nhật đáp án
     */
    public function update(Request $request, Exercise $exercise, ExerciseOption $option)
    {
        $this->checkOwner($exercise, $option);

        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_correct')) {
            ExerciseOption::where('exercise_id', $exercise->id)
                ->where('id', '!=', $option->id)
                ->update(['is_correct' => false]);
        }

        $option->update([
            'option_text' => $request->option_text,
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()
            ->route('exercise.options.index', $exercise->id)
            ->with('success', 'Cập nhật đáp án thành công');
    }

    /**
     * Xóa mềm đáp án
     */
    public function destroy(Exercise $exercise, ExerciseOption $option)
    {
        $this->checkOwner($exercise, $option);

        $option->delete();

        return redirect()
            ->back()
            ->with('success', 'Đã đưa đáp án vào thùng rác');
    }

    /**
     * Danh sách thùng rác
     */
    public function trash(Exercise $exercise)
    {
        $list = ExerciseOption::onlyTrashed()
            ->where('exercise_id', $exercise->id)
            ->paginate(10);

        return view('admin.exercise_options.trash', compact('exercise', 'list'));
    }

    /**
     * Khôi phục đáp án
     */
    public function restore(Exercise $exercise, $id)
    {
        $option = ExerciseOption::onlyTrashed()->findOrFail($id);
        $this->checkOwner($exercise, $option);

        $option->restore();

        return redirect()
            ->back()
            ->with('success', 'Khôi phục đáp án thành công');
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete(Exercise $exercise, $id)
    {
        $option = ExerciseOption::onlyTrashed()->findOrFail($id);
        $this->checkOwner($exercise, $option);

        $option->forceDelete();

        return redirect()
            ->back()
            ->with('success', 'Đã xóa vĩnh viễn đáp án');
    }

    /**
     * Check option thuộc exercise
     */
    private function checkOwner(Exercise $exercise, ExerciseOption $option)
    {
        if ($option->exercise_id !== $exercise->id) {
            abort(404);
        }
    }
}
