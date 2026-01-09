<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username', 'email', 'password', 'role',
    ];

    // Relationships
    public function currentLevel()
    {
        return $this->belongsTo(Level::class, 'current_level_id');
    }

    public function lessonCompletions()
    {
        return $this->hasMany(UserLessonCompletion::class);
    }
}
