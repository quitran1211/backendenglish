<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    // GET /api/quizzes/{quiz_id}/questions
    public function index($quiz_id)
    {
        $questions = QuizQuestion::where('quiz_id', $quiz_id)
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question_text' => $q->question_text,
                    'question_type' => $q->question_type,
                    'options' => [
                        'A' => $q->option_a,
                        'B' => $q->option_b,
                        'C' => $q->option_c,
                        'D' => $q->option_d,
                    ],
                    'points' => $q->points,
                    'explanation' => $q->explanation,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $questions,
        ]);
    }

    // POST /api/quizzes/{quiz_id}/submit
    public function submit(Request $request, $quiz_id)
    {
        $answers = $request->answers; // ['question_id' => 'A', ...]

        $results = [];
        $totalScore = 0;

        foreach ($answers as $question_id => $selected_answer) {
            $question = QuizQuestion::find($question_id);
            if (! $question) {
                continue;
            }

            $isCorrect = strtoupper($selected_answer) === strtoupper($question->correct_answer);
            $score = $isCorrect ? $question->points : 0;
            $totalScore += $score;

            $results[] = [
                'question_id' => $question_id,
                'selected_answer' => $selected_answer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'points' => $score,
            ];
        }

        return response()->json([
            'success' => true,
            'total_score' => $totalScore,
            'results' => $results,
        ]);
    }
}
