<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuizAnswer;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizResultController extends Controller
{
    /**
     * Lưu kết quả quiz sau khi hoàn thành
     * POST /api/quiz-results/save
     */
    public function saveResult(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'lesson_id' => 'required|integer|exists:lessons,id',
            'answers' => 'required|array|min:1',
            'answers.*.vocabulary_id' => 'required|integer|exists:vocabulary,id',
            'answers.*.user_answer' => 'required|string',
            'answers.*.correct_answer' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
            'time_spent' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            $answers = $request->answers;

            // Tính điểm
            $score = collect($answers)->where('is_correct', true)->count();
            $totalQuestions = count($answers);
            $percentage = ($score / $totalQuestions) * 100;

            // Lưu quiz result
            $quizResult = QuizResult::create([
                'user_id' => $request->user_id,
                'lesson_id' => $request->lesson_id,
                'score' => $score,
                'total_questions' => $totalQuestions,
                'percentage' => round($percentage, 2),
                'time_spent' => $request->time_spent,
                'completed_at' => now(),
            ]);

            // Lưu chi tiết câu trả lời
            foreach ($answers as $answer) {
                QuizAnswer::create([
                    'quiz_result_id' => $quizResult->id,
                    'vocabulary_id' => $answer['vocabulary_id'],
                    'user_answer' => $answer['user_answer'],
                    'correct_answer' => $answer['correct_answer'],
                    'is_correct' => $answer['is_correct'],
                    'answered_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Quiz result saved successfully',
                'data' => [
                    'quiz_result_id' => $quizResult->id,
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'percentage' => round($percentage, 2),
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error saving quiz result',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Lấy lịch sử làm bài của user
     * GET /api/quiz-results/history?user_id=1
     */
    public function getHistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $results = QuizResult::where('user_id', $request->user_id)
            ->with('lesson:id,title')
            ->orderBy('completed_at', 'desc')
            ->get();

        return response()->json($results);
    }

    /**
     * Lấy chi tiết kết quả quiz
     * GET /api/quiz-results/detail?quiz_result_id=1
     */
    public function getDetail(Request $request)
    {
        $request->validate([
            'quiz_result_id' => 'required|integer',
        ]);

        $quizResult = QuizResult::with([
            'lesson:id,title',
            'answers.vocabulary:id,word,meaning_vi',
        ])->find($request->quiz_result_id);

        if (! $quizResult) {
            return response()->json([
                'message' => 'Quiz result not found',
            ], 404);
        }

        return response()->json($quizResult);
    }

    /**
     * Lấy thống kê theo lesson
     * GET /api/quiz-results/stats?user_id=1&lesson_id=5
     */
    public function getStats(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'lesson_id' => 'required|integer',
        ]);

        $stats = QuizResult::where('user_id', $request->user_id)
            ->where('lesson_id', $request->lesson_id)
            ->selectRaw('
                COUNT(*) as attempt_count,
                AVG(percentage) as avg_percentage,
                MAX(percentage) as best_percentage,
                MAX(score) as best_score,
                AVG(time_spent) as avg_time_spent
            ')
            ->first();

        return response()->json([
            'lesson_id' => $request->lesson_id,
            'attempt_count' => $stats->attempt_count ?? 0,
            'avg_percentage' => round($stats->avg_percentage ?? 0, 2),
            'best_percentage' => round($stats->best_percentage ?? 0, 2),
            'best_score' => $stats->best_score ?? 0,
            'avg_time_spent' => round($stats->avg_time_spent ?? 0),
        ]);
    }

    /**
     * Kiểm tra đã làm quiz chưa
     * GET /api/quiz-results/check?user_id=1&lesson_id=5
     */
    public function checkCompleted(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'lesson_id' => 'required|integer',
        ]);

        $lastResult = QuizResult::where('user_id', $request->user_id)
            ->where('lesson_id', $request->lesson_id)
            ->orderBy('completed_at', 'desc')
            ->first();

        return response()->json([
            'has_completed' => $lastResult ? true : false,
            'last_score' => $lastResult?->score,
            'last_percentage' => $lastResult?->percentage,
            'last_completed_at' => $lastResult?->completed_at,
        ]);
    }

    /**
     * Lấy danh sách từ hay sai
     * GET /api/quiz-results/vocabulary-errors?user_id=1&limit=10
     */
    public function getVocabularyErrors(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $limit = $request->limit ?? 10;

        $errors = QuizAnswer::whereHas('quizResult', function ($query) use ($request) {
            $query->where('user_id', $request->user_id);
        })
            ->where('is_correct', false)
            ->select('vocabulary_id', DB::raw('COUNT(*) as error_count'))
            ->groupBy('vocabulary_id')
            ->orderBy('error_count', 'desc')
            ->limit($limit)
            ->with('vocabulary:id,word,meaning_vi')
            ->get();

        return response()->json($errors);
    }
}
