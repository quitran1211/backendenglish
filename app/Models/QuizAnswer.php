<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $table = 'quiz_answers';

    protected $fillable = [
        'quiz_result_id',
        'vocabulary_id',
        'user_answer',
        'correct_answer',
        'is_correct',
        'answered_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public $timestamps = false;

    // Relationships
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }
}
