<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'username', 'email', 'password', 'role', 'full_name', 'target_score', 'is_premium',
        'premium_expires_at',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_expires_at' => 'datetime',
    ];

    // Relationships
    public function currentLevel()
    {
        return $this->belongsTo(Level::class, 'current_level_id');
    }

    // ✅ SỬA: Đổi tên method cho rõ ràng
    public function completedLessons()
    {
        return $this->hasMany(UserLessonProgress::class, 'user_id')
            ->whereNotNull('completed_at');
    }

    // ✅ HOẶC giữ tên cũ nhưng sửa logic
    public function lessonCompletions()
    {
        return $this->hasMany(UserLessonProgress::class, 'user_id')
            ->whereNotNull('completed_at');
    }

    public function progress()
    {
        return $this->hasMany(UserLessonProgress::class, 'user_id');
    }

    // Relationships
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->active()
            ->latest();
    }

    public function transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    // Helpers
    public function isPremium()
    {
        return $this->is_premium
            && ($this->premium_expires_at === null || $this->premium_expires_at->isFuture());
    }

    public function canAccessLesson($lesson)
    {
        // Nếu bài free thì ai cũng học được
        if ($lesson->is_free) {
            return true;
        }

        // Nếu bài premium thì phải có premium
        return $this->isPremium();
    }
}
