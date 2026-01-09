<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;

class LevelController extends Controller
{
    /**
     * GET /api/levels
     * Danh sách level + lessons + word_count (tính động)
     */
    public function index()
    {
        $levels = Level::where('is_active', true)
            ->orderBy('display_order')
            ->with([
                'lessons' => function ($q) {
                    $q->where('is_active', true)
                        ->withCount([
                            'vocabularies as word_count' => function ($q) {
                                $q->where('is_active', true)
                                    ->whereNull('vocabulary.deleted_at');
                            },
                        ])
                        ->orderBy('display_order');
                },
            ])
            ->get();

        return response()->json($levels);
    }

    /**
     * GET /api/levels/{id}
     * Chi tiết 1 level
     */
    public function show($id)
    {
        $level = Level::where('is_active', true)
            ->with([
                'lessons' => function ($q) {
                    $q->where('is_active', true)
                        ->withCount([
                            'vocabularies as word_count' => function ($q) {
                                $q->where('is_active', true)
                                    ->whereNull('vocabulary.deleted_at');
                            },
                        ])
                        ->orderBy('display_order');
                },
            ])
            ->findOrFail($id);

        return response()->json($level);
    }
}
