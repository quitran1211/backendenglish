<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExerciseResult extends Model
{
    protected $table = 'user_exercise_results';

    public $timestamps = false; // dùng answered_at

    protected $fillable = [
        'user_id',
        'exercise_id',
        'selected_option_id',
        'is_correct',
        'answered_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(ExerciseOption::class, 'selected_option_id');
    }
}
