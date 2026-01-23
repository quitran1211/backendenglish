<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Danh sách exercise
     */
    public function index()
    {
        $exercises = Exercise::with('lesson')
            ->latest()
            ->paginate(10);

        return view('admin.exercises.index', compact('exercises'));
    }

    public function getVocabularies(Lesson $lesson)
    {
        $vocabularies = $lesson->vocabularies()
            ->select(
                'vocabulary.id',
                'vocabulary.word'
            )
            ->orderBy('lesson_vocabulary.display_order')
            ->get();

        return response()->json($vocabularies);
    }

    /**
     * Thùng rác
     */
    public function trash()
    {
        $exercises = Exercise::onlyTrashed()
            ->with('lesson')
            ->latest('deleted_at')
            ->paginate(10);

        return view('admin.exercises.trash', compact('exercises'));
    }

    /**
     * Form tạo mới
     */
    public function create()
    {
        return view('admin.exercises.create', [
            'lessons' => Lesson::whereNull('deleted_at')->get(),
            'vocabularies' => collect(), // để không bị Undefined variable
        ]);
    }

    /**
     * Lưu exercise mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'vocabulary_id' => 'required|exists:vocabulary,id',
            'sentence_full' => 'required|string',
            'sentence' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard',
        ]);

        Exercise::create($request->only([
            'lesson_id',
            'vocabulary_id',
            'sentence_full',
            'sentence',
            'difficulty',
        ]));

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Tạo exercise thành công');
    }

    /**
     * Chi tiết exercise
     */
    public function show($id)
    {
        $exercise = Exercise::with(['lesson', 'options'])
            ->findOrFail($id);

        return view('admin.exercises.show', compact('exercise'));
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $exercise = Exercise::with('options')->findOrFail($id);
        $lessons = Lesson::all();

        return view('admin.exercises.edit', compact('exercise', 'lessons'));
    }

    /**
     * Cập nhật exercise
     */
    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);

        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'sentence_full' => 'required|string',
            'sentence' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard',
        ]);

        $exercise->update($request->only([
            'lesson_id',
            'vocabulary_id',
            'sentence_full',
            'sentence',
            'difficulty',
        ]));

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Cập nhật exercise thành công');
    }

    /**
     * Xóa mềm
     */
    public function destroy($id)
    {
        Exercise::findOrFail($id)->delete();

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Exercise đã được đưa vào thùng rác');
    }

    /**
     * Khôi phục
     */
    public function restore($id)
    {
        Exercise::onlyTrashed()->findOrFail($id)->restore();

        return redirect()
            ->route('exercises.trash')
            ->with('success', 'Khôi phục exercise thành công');
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete($id)
    {
        $exercise = Exercise::onlyTrashed()->findOrFail($id);

        $exercise->options()->delete();
        $exercise->forceDelete();

        return redirect()
            ->route('exercises.trash')
            ->with('success', 'Đã xóa vĩnh viễn exercise');
    }
}
