<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    /**
     * Danh sách câu hỏi theo quiz
     */
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()
            ->with('vocabulary:id,word')
            ->orderBy('display_order')
            ->get();

        return view('admin.quiz_questions.index', compact('quiz', 'questions'));
    }

    /**
     * Form tạo câu hỏi
     */
    public function create(Quiz $quiz)
    {
        $vocabularies = Vocabulary::select('id', 'word')->get();

        return view('admin.quiz_questions.create', compact('quiz', 'vocabularies'));
    }

    /**
     * Lưu câu hỏi
     */
    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'vocabulary_id' => 'nullable|exists:vocabulary,id',
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'correct_answer' => 'required|string',
            'option_a' => 'nullable|string',
            'option_b' => 'nullable|string',
            'option_c' => 'nullable|string',
            'option_d' => 'nullable|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'display_order' => 'required|integer|min:1',
        ]);

        $data['quiz_id'] = $quiz->id;

        QuizQuestion::create($data);

        return redirect()
            ->route('quizzes.questions.index', $quiz->id)
            ->with('success', 'Thêm câu hỏi thành công');
    }

    /**
     * Form chỉnh sửa câu hỏi
     */
    public function edit(QuizQuestion $question)
    {
        $vocabularies = Vocabulary::select('id', 'word')->get();

        return view('admin.quiz_questions.edit', compact('question', 'vocabularies'));
    }

    /**
     * Cập nhật câu hỏi
     */
    public function update(Request $request, QuizQuestion $question)
    {
        $data = $request->validate([
            'vocabulary_id' => 'nullable|exists:vocabulary,id',
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'correct_answer' => 'required|string',
            'option_a' => 'nullable|string',
            'option_b' => 'nullable|string',
            'option_c' => 'nullable|string',
            'option_d' => 'nullable|string',
            'explanation' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'display_order' => 'required|integer|min:1',
        ]);

        $question->update($data);

        return back()->with('success', 'Cập nhật câu hỏi thành công');
    }

    /**
     * Soft delete câu hỏi
     */
    public function destroy(QuizQuestion $question)
    {
        $question->delete();

        return back()->with('success', 'Đã đưa câu hỏi vào thùng rác');
    }

    /**
     * Trash câu hỏi theo quiz
     */
    public function trash($quizId)
    {
        $questions = QuizQuestion::onlyTrashed()
            ->where('quiz_id', $quizId)
            ->with('vocabulary:id,word')
            ->orderBy('display_order')
            ->get();

        return view('admin.quiz_questions.trash', compact('questions'));
    }

    /**
     * Khôi phục câu hỏi
     */
    public function restore($id)
    {
        $question = QuizQuestion::onlyTrashed()->findOrFail($id);
        $question->restore();

        return back()->with('success', 'Khôi phục câu hỏi thành công');
    }

    /**
     * Xoá vĩnh viễn câu hỏi
     */
    public function forceDelete($id)
    {
        $question = QuizQuestion::onlyTrashed()->findOrFail($id);
        $question->forceDelete();

        return back()->with('success', 'Đã xoá vĩnh viễn câu hỏi');
    }

    public function delete(string $id)
    {
        $question = QuizQuestion::findOrFail($id);
        $question->delete();

        return redirect()->route('quizzes.questions.index')->with('success', 'Xóa bài học thành công');
    }

    public function show(string $id)
    {
        return view('admin.quiz_questions.show', compact('question'));
    }
}
