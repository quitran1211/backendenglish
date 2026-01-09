<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // GET /api/quizzes
    public function index(Request $request)
    {
        $query = Quiz::query()->where('is_active', 1);

        // Filter theo lesson_id, level_id, quiz_type nếu cần
        if ($request->lesson_id) {
            $query->where('lesson_id', $request->lesson_id);
        }
        if ($request->level_id) {
            $query->where('level_id', $request->level_id);
        }
        if ($request->quiz_type) {
            $query->where('quiz_type', $request->quiz_type);
        }

        $quizzes = $query->get();

        return response()->json([
            'success' => true,
            'data' => $quizzes,
        ]);
    }

    // GET /api/quizzes/{id}
    public function show($id)
    {
        $quiz = Quiz::find($id);

        if (! $quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $quiz,
        ]);
    }
}
