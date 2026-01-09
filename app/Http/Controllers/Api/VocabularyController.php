<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{
    /**
     * GET /api/vocabularies/{id}
     * Chi tiết 1 từ vựng + các lesson đang sử dụng
     */
    public function show($id)
    {
        $vocabulary = Vocabulary::where('is_active', true)
            ->with([
                'lessons' => function ($q) {
                    $q->where('lessons.is_active', true)
                        ->orderBy('lesson_vocabulary.display_order')
                        ->select(
                            'lessons.id',
                            'title',
                            'topic',
                            'level_id'
                        );
                },
            ])
            ->findOrFail($id);

        return response()->json([
            'id' => $vocabulary->id,
            'word' => $vocabulary->word,
            'pronunciation' => $vocabulary->pronunciation,
            'word_type' => $vocabulary->word_type,
            'meaning_vi' => $vocabulary->meaning_vi,
            'meaning_en' => $vocabulary->meaning_en,
            'lessons' => $vocabulary->lessons->map(function ($lesson) {
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'level_id' => $lesson->level_id,
                    'order' => $lesson->pivot->display_order,
                ];
            }),
        ]);
    }

    /**
     * GET /api/lessons/{lessonId}/vocabularies
     * Danh sách từ vựng của 1 lesson (API phụ trợ, nhẹ)
     */
    public function getByLesson($lessonId)
    {
        $lesson = Lesson::where('is_active', true)
            ->with([
                'vocabularies' => function ($q) {
                    $q->where('is_active', true)
                        ->orderBy('lesson_vocabulary.display_order')
                        ->select(
                            'vocabulary.id',
                            'word',
                            'pronunciation',
                            'word_type',
                            'meaning_vi',
                            'meaning_en'
                        );
                },
            ])
            ->findOrFail($lessonId);

        return response()->json([
            'lesson_id' => $lesson->id,
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
