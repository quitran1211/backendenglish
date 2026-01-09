<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLessonProgress extends Model
{
    protected $table = 'user_progress';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'is_completed',
        'completed_at',
    ];
}
