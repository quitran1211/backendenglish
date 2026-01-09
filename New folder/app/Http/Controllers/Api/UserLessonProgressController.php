<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserLessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLessonProgressController extends Controller
{
    /**
     * Đánh dấu lesson hoàn thành
     */
    public function markCompleted(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $progress = UserLessonProgress::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Lesson marked as completed',
            'data' => $progress,
        ]);
    }

    /**
     * Kiểm tra trạng thái lesson
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|integer',
        ]);

        $userId = Auth::id();

        $progress = UserLessonProgress::where('user_id', $userId)
            ->where('lesson_id', $request->lesson_id)
            ->first();

        return response()->json([
            'lesson_id' => $request->lesson_id,
            'is_completed' => $progress?->is_completed ?? false,
            'completed_at' => $progress?->completed_at,
        ]);
    }

    /**
     * Lấy danh sách lesson đã hoàn thành
     */
    public function completedLessons(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $lessons = UserLessonProgress::where('user_id', $request->user_id)
            ->where('is_completed', true)
            ->pluck('lesson_id');

        return response()->json($lessons);
    }
}
