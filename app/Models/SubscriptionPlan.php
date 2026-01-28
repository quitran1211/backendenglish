<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration_days',
        'price',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'duration_days' => 'integer',
        'sort_order' => 'integer',
    ];

    // Relationships
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // Helpers
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.').' VNĐ';
    }

    public function getDurationTextAttribute()
    {
        if ($this->duration_days >= 365) {
            return round($this->duration_days / 365).' năm';
        } elseif ($this->duration_days >= 30) {
            return round($this->duration_days / 30).' tháng';
        } else {
            return $this->duration_days.' ngày';
        }
    }
}
