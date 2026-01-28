<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // 🔹 Lấy thông tin user hiện tại (AUTHENTICATED)
    public function me(Request $request)
    {
        $user = $request->user();

        // Load relationships
        $user->load(['activeSubscription.plan']);

        // ✅ Sử dụng lessonCompletions (đã sửa trong User model)
        $completedLessons = $user->lessonCompletions()->count();
        $totalLessons = \App\Models\Lesson::count();
        $percent = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // ✅ Recent completed lessons - Join với bảng lessons
        $recentCompleted = $user->lessonCompletions()
            ->join('lessons', 'user_progress.lesson_id', '=', 'lessons.id')
            ->select(
                'user_progress.lesson_id',
                'lessons.title as lesson_title',
                'user_progress.completed_at'
            )
            ->orderBy('user_progress.completed_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'lesson_id' => $item->lesson_id,
                    'lesson_title' => $item->lesson_title,
                    'completed_at' => $item->completed_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'full_name' => $user->full_name,
                    'avatar' => $user->avatar,
                    'avatar_url' => $user->avatar ? asset($user->avatar) : null,
                    'target_score' => $user->target_score ?? null,
                    'is_premium' => $user->is_premium,
                    'premium_expires_at' => $user->premium_expires_at,
                    'created_at' => $user->created_at,
                ],
                'progress' => [
                    'completed_lessons' => $completedLessons,
                    'total_lessons' => $totalLessons,
                    'percent' => $percent,
                    'current_level' => $this->getCurrentLevel($percent),
                    'recent_completed' => $recentCompleted,
                ],
            ],
        ]);
    }

    // Helper method
    private function getCurrentLevel($percent)
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

    // 🔹 Lấy trạng thái Premium
    public function premiumStatus(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'is_premium' => $user->is_premium,
            'subscription' => $user->activeSubscription ? [
                'plan_name' => $user->activeSubscription->plan->name,
                'expires_at' => $user->activeSubscription->expires_at,
                'days_left' => $user->activeSubscription->expires_at
                    ? $user->activeSubscription->expires_at->diffInDays(now())
                    : null,
            ] : null,
        ]);
    }

    // 🔹 Lấy subscription hiện tại
    public function mySubscription(Request $request)
    {
        $user = $request->user();
        $subscription = $user->activeSubscription;

        if (! $subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa có gói đăng ký nào',
                'subscription' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'subscription' => $subscription->load('plan'),
        ]);
    }

    // 🔹 Lấy lịch sử giao dịch
    public function myTransactions(Request $request)
    {
        $user = $request->user();

        $transactions = $user->paymentTransactions()
            ->with(['subscription', 'plan'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'transactions' => $transactions,
        ]);
    }

    // 🔹 Cập nhật profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'target_score' => 'sometimes|nullable|integer|min:0|max:990',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();
            $path = 'users/avatars/'.$filename;

            // Save to public disk
            Storage::disk('public')->put($path, file_get_contents($file));

            // Delete old avatar if exists
            if ($user->avatar && $user->avatar !== 'users/avatars/default_avatar.png') {
                $oldPath = str_replace('storage/', '', $user->avatar);
                Storage::disk('public')->delete($oldPath);
            }

            $validated['avatar'] = 'storage/'.$path;
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin thành công',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'full_name' => $user->full_name,
                    'avatar' => $user->avatar,
                    'avatar_url' => $user->avatar ? asset($user->avatar) : null,
                    'target_score' => $user->target_score,
                    'is_premium' => $user->is_premium,
                    'premium_expires_at' => $user->premium_expires_at,
                ],
            ],
        ]);
    }

    // 🔹 Đăng xuất
    public function logout(Request $request)
    {
        // Nếu dùng Sanctum
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công',
        ]);
    }

    // 🔹 Lấy danh sách tất cả user (ADMIN)
    public function list()
    {
        return response()->json(User::all());
    }

    // 🔹 Lấy 1 user theo query param ?id=1
    public function row(Request $request)
    {
        $id = $request->query('id');
        if (! $id) {
            return response()->json(['error' => 'ID is required'], 400);
        }

        $users = User::find($id);
        if (! $users) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($users);
    }

    // 🔹 Đăng ký user mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $users = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công',
            'user' => $users,
        ], 201);
    }

    // 🔹 Đăng nhập user
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $users = User::where('email', $validated['login'])
            ->orWhere('username', $validated['login'])
            ->first();

        if (! $users || ! password_verify($validated['password'], $users->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên đăng nhập hoặc mật khẩu không đúng',
            ], 401);
        }

        // Tạo token nếu dùng Sanctum
        $token = $users->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'user' => [
                'id' => $users->id,
                'username' => $users->username,
                'email' => $users->email,
                'full_name' => $users->full_name,
                'is_premium' => $users->is_premium, // ← QUAN TRỌNG
            ],
            'token' => $token,
        ]);
    }

    // 🔹 Đổi mật khẩu
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        if (! Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'error' => 'Mật khẩu cũ không chính xác!',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Đổi mật khẩu thành công!',
        ]);
    }

    // 🔹 Lấy thống kê học tập
    public function getLearningStats(Request $request)
    {
        $user = $request->user();

        $stats = [
            'total_lessons_completed' => $user->completedLessons()->count(),
            'total_quizzes_taken' => $user->quizResults()->count(),
            'total_study_time' => $user->totalStudyTime(), // Method cần implement trong User model
            'current_streak' => $user->currentStreak(), // Method cần implement
            'total_vocabulary_learned' => $user->learnedVocabulary()->count(),
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats,
        ]);
    }

    // 🔹 Lấy streak hiện tại
    public function getDailyStreak(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'streak' => [
                'current' => $user->currentStreak(),
                'longest' => $user->longestStreak(),
                'last_activity' => $user->lastActivityDate(),
            ],
        ]);
    }
}
