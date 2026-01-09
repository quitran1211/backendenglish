<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Danh sách quiz (active / trash)
     */
    public function index(Request $request)
    {
        $quizzes = Quiz::with(['lesson:id,title', 'level:id,level_name'])
            ->when($request->status === 'trash', fn ($q) => $q->onlyTrashed())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Form tạo quiz
     */
    public function create()
    {
        $lessons = Lesson::select('id', 'title')->get();
        $levels = Level::select('id', 'level_name')->get();

        return view('admin.quizzes.create', compact('lessons', 'levels'));
    }

    /**
     * Lưu quiz mới
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quiz_type' => 'required|string',
            'time_limit' => 'nullable|integer',
            'passing_score' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        Quiz::create($data);

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Tạo quiz thành công');
    }

    /**
     * Form chỉnh sửa quiz
     */
    public function edit(Quiz $quiz)
    {
        $lessons = Lesson::select('id', 'title')->get();
        $levels = Level::select('id', 'level_name')->get();

        return view('admin.quizzes.edit', compact('quiz', 'lessons', 'levels'));
    }

    /**
     * Cập nhật quiz
     */
    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quiz_type' => 'required|string',
            'time_limit' => 'nullable|integer',
            'passing_score' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $quiz->update($data);

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Cập nhật quiz thành công');
    }

    public function show(string $id)
    {
        $quiz = Quiz::with(['level', 'lesson'])->findOrFail($id);

        return view('admin.quizzes.show', compact('quiz'));
    }

    /**
     * Toggle the status of a quiz (active/inactive).
     */
    public function toggleStatus(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->is_active = ! $quiz->is_active;
        $quiz->save();

        $status = $quiz->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return redirect()->route('quizzes.index')->with('success', "Đã {$status} bài học thành công");
    }

    /**
     * Soft delete quiz
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return back()->with('success', 'Quiz đã được đưa vào thùng rác');
    }

    public function delete(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Xóa bài học thành công');
    }

    /**
     * Danh sách quiz trong thùng rác
     */
    public function trash()
    {
        $quizzes = Quiz::onlyTrashed()
            ->with(['lesson:id,title', 'level:id,level_name'])
            ->paginate(20);

        return view('admin.quizzes.trash', compact('quizzes'));
    }

    /**
     * Khôi phục quiz
     */
    public function restore(string $id)
    {
        $quiz = Quiz::withTrashed()->findOrFail($id);
        $quiz->restore();

        return redirect()->route('quizzes.trash')->with('success', 'Khôi phục bài học thành công');
    }

    /**
     * Xoá vĩnh viễn quiz + câu hỏi
     */
    public function forceDelete($id)
    {
        $quiz = Quiz::onlyTrashed()->findOrFail($id);

        // Xóa vĩnh viễn toàn bộ câu hỏi
        $quiz->questions()->withTrashed()->forceDelete();

        $quiz->forceDelete();

        return redirect()
            ->route('quizzes.trash')
            ->with('success', 'Đã xoá vĩnh viễn quiz');
    }
}
