<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserLessonProgress;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showByUserId($userId)
    {
        $user = User::findOrFail($userId);

        $totalLessons = Lesson::count();

        $completedCount = UserLessonProgress::where('user_id', $user->id)
            ->where('is_completed', 1)
            ->count();

        $percent = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100, 1) : 0;
        $currentLevel = $this->calcLevelByPercent($percent);

        $recentCompleted = UserLessonProgress::with('lesson')
            ->where('user_id', $user->id)
            ->where('is_completed', 1)
            ->orderByDesc('completed_at')
            ->limit(10)
            ->get()
            ->map(fn ($p) => [
                'lesson_id' => $p->lesson_id,
                'lesson_title' => $p->lesson?->title,
                'completed_at' => optional($p->completed_at)->format('d/m/Y H:i'),
            ]);

        $inProgress = UserLessonProgress::with('lesson')
            ->where('user_id', $user->id)
            ->where(function ($q) {
                $q->whereNull('is_completed')->orWhere('is_completed', 0);
            })
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get()
            ->map(fn ($p) => [
                'lesson_id' => $p->lesson_id,
                'lesson_title' => $p->lesson?->title,
                'updated_at' => optional($p->updated_at)->format('d/m/Y H:i'),
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username ?? null,
                    'full_name' => $user->full_name ?? null,
                    'email' => $user->email ?? null,
                    'avatar' => $user->avatar ? asset('storage/'.$user->avatar) : null,
                    'created_at' => optional($user->created_at)->format('d/m/Y'),
                    'target_score' => $user->target_score ?? null,
                    'level' => $user->level ?? null,
                ],
                'progress' => [
                    'total_lessons' => $totalLessons,
                    'completed_lessons' => $completedCount,
                    'percent' => $percent,
                    'current_level' => $currentLevel,
                    'recent_completed' => $recentCompleted,
                    'in_progress' => $inProgress,
                ],
            ],
        ]);
    }

    public function updateByUserId(Request $request, $userId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'target_score' => 'nullable|integer|min:0',
        ]);

        $user = User::find($request->user_id);

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User không tồn tại',
            ], 404);
        }

        $data = $request->only(['full_name', 'target_score']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật hồ sơ thành công',
        ]);
    }

    private function calcLevelByPercent(float $percent): string
    {
        if ($percent >= 80) {
            return 'Advanced';
        }
        if ($percent >= 50) {
            return 'Intermediate';
        }
        if ($percent >= 20) {
            return 'Elementary';
        }

        return 'Beginner';
    }
}
