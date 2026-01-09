<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quiz_id',
        'vocabulary_id',
        'question_text',
        'question_type',
        'correct_answer',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'explanation',
        'points',
        'display_order',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }
}
