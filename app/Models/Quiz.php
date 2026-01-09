<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'level_id',
        'title',
        'description',
        'quiz_type',
        'time_limit',
        'passing_score',
        'is_active',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('display_order');
    }
}
