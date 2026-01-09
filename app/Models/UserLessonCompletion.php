<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLessonCompletion extends Model
{
    protected $table = 'user_lesson_completion';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'is_completed',
    ];
}
