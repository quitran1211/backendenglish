<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'level_code',
        'level_name',
        'description',
        'color',
        'target_score',
        'total_words',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'target_score' => 'string',
        'total_words' => 'integer',
        'display_order' => 'integer',
    ];

    /**
     * Get the lessons for the level.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('display_order');
    }

    /**
     * Scope active levels.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get level badge class.
     */
    public function getBadgeClassAttribute()
    {
        $colorMap = [
            'success' => 'badge-success',
            'info' => 'badge-info',
            'primary' => 'badge-primary',
            'warning' => 'badge-warning',
            'danger' => 'badge-danger',
            'orange' => 'badge-warning',
        ];

        return $colorMap[$this->color] ?? 'badge-secondary';
    }
}
