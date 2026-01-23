<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\ExerciseOption;
use App\Models\Lesson;
use App\Models\UserExerciseResult;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    /**
     * GET /exercises?lesson_id=1
     * Trả về danh sách bài tập theo lesson (KHÔNG trả đáp án)
     */
    public function index(Request $request)
    {
        $lessonId = $request->query('lesson_id');

        if (! $lessonId) {
            return response()->json([
                'success' => false,
                'message' => 'lesson_id is required',
            ], 400);
        }

        $exercises = Exercise::with([
            'options:id,exercise_id,option_text',
        ])
            ->where('lesson_id', $lessonId)
            ->select('id', 'lesson_id', 'sentence')
            ->orderBy('id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $exercises->map(function ($e) {
                return [
                    'id' => $e->id,
                    'sentence' => $e->sentence,
                    'options' => $e->options->map(fn ($o) => [
                        'id' => $o->id,
                        'text' => $o->option_text,
                    ])->values(),
                ];
            }),
        ]);
    }

    /**
     * POST /exercises/submit
     * body:
     * {
     *   "user_id": 1,
     *   "answers": [
     *     { "exercise_id": 1, "option_id": 10 }
     *   ]
     * }
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'answers' => 'required|array|min:1',
            'answers.*.exercise_id' => 'required|exists:exercises,id',
            'answers.*.option_id' => 'nullable|exists:exercise_options,id',
        ]);

        $userId = (int) $validated['user_id'];
        $answers = $validated['answers'];

        $exerciseIds = collect($answers)->pluck('exercise_id')->unique();

        $correctOptions = ExerciseOption::whereIn('exercise_id', $exerciseIds)
            ->where('is_correct', 1)
            ->pluck('id', 'exercise_id'); // exercise_id => correct_option_id

        $score = 0;
        $details = [];

        DB::beginTransaction();
        try {
            foreach ($answers as $answer) {
                $exerciseId = (int) $answer['exercise_id'];
                $selectedOptionId = $answer['option_id'] ? (int) $answer['option_id'] : null;

                $correctOptionId = $correctOptions[$exerciseId] ?? null;
                $isCorrect = $correctOptionId && $selectedOptionId === (int) $correctOptionId;

                if ($isCorrect) {
                    $score++;
                }

                UserExerciseResult::create([
                    'user_id' => $userId,
                    'exercise_id' => $exerciseId,
                    'selected_option_id' => $selectedOptionId,
                    'is_correct' => $isCorrect ? 1 : 0,
                    'answered_at' => now(),
                ]);

                $details[] = [
                    'exercise_id' => $exerciseId,
                    'selected_option_id' => $selectedOptionId,
                    'correct_option_id' => $correctOptionId,
                    'correct' => $isCorrect,
                ];
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Submit failed',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'score' => $score,
            'total' => count($answers),
            'details' => $details,
        ]);
    }

    /**
     * POST /exercises/generate
     * body: { "lesson_id": 1, "limit": 10 }
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $lessonId = $validated['lesson_id'];
        $limit = $validated['limit'] ?? 10;

        $lesson = Lesson::with('vocabularies')->findOrFail($lessonId);

        if ($lesson->vocabularies->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson chưa có vocabulary để tạo bài tập',
            ], 400);
        }

        $templates = [
            'noun' => [
                'I want to eat _____.',
                'This is a _____.',
                'I bought a _____.',
            ],
            'verb' => [
                'I usually _____ in the morning.',
                'They _____ every weekend.',
            ],
            'adjective' => [
                'This movie is very _____.',
                'The weather today is _____.',
            ],
        ];

        $vocabularies = $lesson->vocabularies->shuffle()->take($limit);
        $created = [];

        DB::beginTransaction();
        try {
            foreach ($vocabularies as $vocab) {
                $type = strtolower($vocab->word_type);

                if (! isset($templates[$type])) {
                    continue;
                }

                $sentence = collect($templates[$type])->random();

                $distractors = Vocabulary::where('word_type', $type)
                    ->where('id', '!=', $vocab->id)
                    ->inRandomOrder()
                    ->limit(3)
                    ->pluck('word')
                    ->toArray();

                $options = array_merge($distractors, [$vocab->word]);
                shuffle($options);

                $exercise = Exercise::create([
                    'lesson_id' => $lessonId,
                    'vocabulary_id' => $vocab->id,
                    'sentence' => $sentence,
                    'sentence_full' => str_replace('_____', $vocab->word, $sentence),
                    'difficulty' => 'easy',
                ]);

                foreach ($options as $opt) {
                    ExerciseOption::create([
                        'exercise_id' => $exercise->id,
                        'option_text' => $opt,
                        'is_correct' => $opt === $vocab->word ? 1 : 0,
                    ]);
                }

                $created[] = $exercise->id;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Generate failed',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'lesson_id' => $lessonId,
            'created_count' => count($created),
            'exercise_ids' => $created,
        ]);
    }
}
