<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * GET /api/lessons/{id}
     * Chi tiết lesson + vocabularies
     */
    public function show($id)
    {
        $lesson = Lesson::where('is_active', true)
            ->with([
                'level:id,level_name',
                'vocabularies' => function ($q) {
                    $q->where('vocabulary.is_active', true)
                        ->orderBy('lesson_vocabulary.display_order')
                        ->select([
                            'vocabulary.id',
                            'vocabulary.word',
                            'vocabulary.pronunciation',
                            'vocabulary.word_type',
                            'vocabulary.meaning_vi',
                            'vocabulary.meaning_en',
                        ]);
                },
            ])
            ->withCount([
                'vocabularies as word_count' => function ($q) {
                    $q->where('vocabulary.is_active', true);
                },
            ])
            ->findOrFail($id);

        return response()->json([
            'id' => $lesson->id,
            'title' => $lesson->title,
            'topic' => $lesson->topic,
            'description' => $lesson->description,

            // ✅ word_count được tính động
            'word_count' => $lesson->word_count,

            'is_free' => $lesson->is_free,
            'level' => $lesson->level,
            'vocabularies' => $lesson->vocabularies->map(function ($vocab) {
                return [
                    'id' => $vocab->id,
                    'word' => $vocab->word,
                    'pronunciation' => $vocab->pronunciation,
                    'word_type' => $vocab->word_type,
                    'meaning_vi' => $vocab->meaning_vi,
                    'meaning_en' => $vocab->meaning_en,
                    'order' => $vocab->pivot->display_order,
                ];
            }),
        ]);
    }
}
