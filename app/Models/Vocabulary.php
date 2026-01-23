<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vocabulary extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'vocabulary';

    protected $fillable = [
        'word',
        'pronunciation',
        'word_type',
        'meaning_vi',
        'meaning_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the lessons that include this vocabulary.
     */
    public function lessons()
    {
        return $this->belongsToMany(
            Lesson::class,
            'lesson_vocabulary',
            'vocabulary_id',
            'lesson_id'
        )->withPivot('display_order')->withTimestamps();
    }

    /**
     * Get the examples for the vocabulary.
     */
    public function examples()
    {
        return $this->hasMany(Example::class)->orderBy('display_order');
    }

    /**
     * Get the tags for the vocabulary.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'vocabulary_tags');
    }

    /**
     * Get the audio files for the vocabulary.
     */
    public function audioFiles()
    {
        return $this->hasMany(AudioFile::class);
    }

    /**
     * Scope active vocabularies.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'vocabulary_id');
    }
}
