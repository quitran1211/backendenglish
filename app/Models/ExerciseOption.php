<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExerciseOption extends Model
{
    use SoftDeletes;

    protected $table = 'exercise_options';

    protected $fillable = [
        'exercise_id',
        'option_text',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
