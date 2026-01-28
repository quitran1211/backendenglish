<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'lessons';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'level_id',
        'title',
        'topic',
        'description',
        'display_order',
        'is_free',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_free' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the level that owns the lesson.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * The vocabularies that belong to the lesson.
     */
    public function vocabularies()
    {
        return $this->belongsToMany(
            Vocabulary::class,
            'lesson_vocabulary',
            'lesson_id',
            'vocabulary_id'
        )->withPivot('display_order')
            ->withTimestamps()
            ->orderBy('lesson_vocabulary.display_order');
    }

    /**
     * Get the lesson completions.
     */
    public function completions()
    {
        return $this->hasMany(UserLessonCompletion::class);
    }

    /**
     * Get the user progress for this lesson.
     */
    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    /**
     * Get the quizzes for this lesson.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Scope a query to only include active lessons.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include free lessons.
     */
    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    /**
     * Scope a query to filter by level.
     */
    public function scopeByLevel($query, $levelId)
    {
        return $query->where('level_id', $levelId);
    }

    /**
     * Get the lesson's status text.
     */
    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'Hoạt động' : 'Không hoạt động';
    }

    /**
     * Get the lesson's free status text.
     */
    public function getFreeStatusTextAttribute()
    {
        return $this->is_free ? 'Miễn phí' : 'Trả phí';
    }

    /**
     * Get the lesson's status badge class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->is_active ? 'badge-success' : 'badge-secondary';
    }

    /**
     * Get the lesson's free badge class.
     */
    public function getFreeBadgeClassAttribute()
    {
        return $this->is_free ? 'badge-success' : 'badge-warning';
    }

    /**
     * Get completion rate for this lesson.
     */
    public function getCompletionRateAttribute()
    {
        $totalUsers = $this->completions()->distinct('user_id')->count();

        if ($totalUsers === 0) {
            return 0;
        }

        $completedUsers = $this->completions()->where('is_completed', true)->count();

        return round(($completedUsers / $totalUsers) * 100, 2);
    }

    /**
     * Check if lesson has vocabularies.
     */
    public function hasVocabularies()
    {
        return $this->vocabularies()->count() > 0;
    }

    /**
     * Get total students enrolled in this lesson.
     */
    public function getTotalStudentsAttribute()
    {
        return $this->completions()->distinct('user_id')->count();
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-update word_count when vocabularies change
        static::saved(function ($lesson) {
            // You can add logic here if needed
        });
    }

    public function isPremium(): bool
    {
        return ! $this->is_free;
    }

    // Scope: bài premium
    public function scopePremium($query)
    {
        return $query->where('is_free', false);
    }
}
