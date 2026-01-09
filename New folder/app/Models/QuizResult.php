<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $table = 'quiz_results';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'score',
        'total_questions',
        'percentage',
        'time_spent',
        'completed_at',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    public $timestamps = false;

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
