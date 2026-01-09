<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('currentLevel')->orderBy('created_at', 'desc');

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Filter by level
        if ($request->has('current_level_id') && $request->current_level_id != '') {
            $query->where('current_level_id', $request->current_level_id);
        }

        // Filter by premium status
        if ($request->has('is_premium') && $request->is_premium != '') {
            $query->where('is_premium', $request->is_premium);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', '%'.$request->search.'%')
                    ->orWhere('username', 'like', '%'.$request->search.'%')
                    ->orWhere('full_name', 'like', '%'.$request->search.'%');
            });
        }

        $list = $query->paginate(15);
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.user.index', compact('list', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.user.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->full_name = $request->full_name;
        $user->role = $request->role ?? 'user';
        $user->current_level_id = $request->current_level_id;
        $user->target_score = $request->target_score;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $levels = Level::where('is_active', true)->orderBy('display_order')->get();

        return view('admin.user.edit', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->email = $request->email;
        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->role = $request->role ?? $user->role;
        $user->current_level_id = $request->current_level_id;
        $user->target_score = $request->target_score;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar_url && Storage::disk('public')->exists($user->avatar_url)) {
                Storage::disk('public')->delete($user->avatar_url);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function delete(string $id)
    {
        $user = User::findOrFail($id);

        // Không cho phép xóa chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('user.index')->with('error', 'Không thể xóa tài khoản của chính bạn');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trash()
    {
        $list = User::onlyTrashed()
            ->with('currentLevel')
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('admin.user.trash', compact('list'));
    }

    /**
     * Restore a soft-deleted resource.
     */
    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('user.trash')->with('success', 'Khôi phục người dùng thành công');
    }

    /**
     * Force delete a resource permanently.
     */
    public function destroy(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        // Delete avatar
        if ($user->avatar_url && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        $user->forceDelete();

        return redirect()->route('user.trash')->with('success', 'Xóa vĩnh viễn người dùng thành công');
    }

    /**
     * Toggle premium status.
     */
    public function togglePremium(string $id)
    {
        $user = User::findOrFail($id);
        $user->is_premium = ! $user->is_premium;
        $user->save();

        $status = $user->is_premium ? 'Premium' : 'Free';

        return redirect()->route('user.index')->with('success', "Đã chuyển tài khoản sang {$status}");
    }

    /**
     * Change user role.
     */
    public function changeRole(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required|in:admin,teacher,student',
        ]);

        $user = User::findOrFail($id);

        // Không cho phép thay đổi role của chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('user.index')->with('error', 'Không thể thay đổi quyền của chính bạn');
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Thay đổi quyền người dùng thành công');
    }

    /**
     * Reset user password.
     */
    public function resetPassword(Request $request, string $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.show', $id)->with('success', 'Đặt lại mật khẩu thành công');
    }

    /**
     * View user learning progress.
     */
    public function progress(string $id)
    {
        $user = User::with(['currentLevel', 'lessonCompletions.lesson'])->findOrFail($id);

        // Lấy tiến độ học tập
        $lessons = $user->lessonCompletions()
            ->with('lesson.level')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.user.progress', compact('user', 'lessons'));
    }

    /**
     * View user achievements.
     */
    public function achievements(string $id)
    {
        $user = User::with(['userAchievements.achievement'])->findOrFail($id);

        $earnedAchievements = $user->userAchievements()
            ->with('achievement')
            ->orderBy('earned_at', 'desc')
            ->get();

        return view('admin.user.achievements', compact('user', 'earnedAchievements'));
    }

    /**
     * Bulk actions.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate_premium,deactivate_premium,set_role',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'role' => 'required_if:action,set_role|in:admin,teacher,student',
        ]);

        $users = User::whereIn('id', $request->user_ids);

        // Loại bỏ user hiện tại khỏi bulk action
        $users->where('id', '!=', auth()->id());

        switch ($request->action) {
            case 'delete':
                $users->delete();
                $message = 'Xóa các người dùng thành công';
                break;
            case 'activate_premium':
                $users->update(['is_premium' => true]);
                $message = 'Kích hoạt Premium cho các người dùng thành công';
                break;
            case 'deactivate_premium':
                $users->update(['is_premium' => false]);
                $message = 'Hủy Premium cho các người dùng thành công';
                break;
            case 'set_role':
                $users->update(['role' => $request->role]);
                $message = 'Thay đổi quyền người dùng thành công';
                break;
            default:
                $message = 'Hành động không hợp lệ';
        }

        return redirect()->route('user.index')->with('success', $message);
    }

    /**
     * Export users to CSV.
     */
    public function export(Request $request)
    {
        $query = User::with('currentLevel');

        // Apply filters
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        $filename = 'users_'.date('Y-m-d_H-i-s').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header
            fputcsv($file, ['ID', 'Email', 'Username', 'Full Name', 'Role', 'Level', 'Target Score', 'Premium', 'Created At']);

            // Data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->email,
                    $user->username,
                    $user->full_name,
                    $user->role,
                    $user->currentLevel->level_name ?? 'N/A',
                    $user->target_score ?? 'N/A',
                    $user->is_premium ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
