<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use SoftDeletes;

    protected $table = 'exercises';

    protected $fillable = [
        'lesson_id',
        'vocabulary_id',
        'sentence',
        'sentence_full',
        'difficulty',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class, 'vocabulary_id');
    }

    public function options()
    {
        return $this->hasMany(ExerciseOption::class, 'exercise_id');
    }

    public function results()
    {
        return $this->hasMany(UserExerciseResult::class, 'exercise_id');
    }
}
