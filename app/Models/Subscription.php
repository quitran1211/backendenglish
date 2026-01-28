<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'started_at',
        'expires_at',
        'payment_method',
        'amount_paid',
        'notes',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }

    public function transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeExpiringSoon($query, $days = 7)
    {
        return $query->where('status', 'active')
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays($days)]);
    }

    // Helpers
    public function isActive()
    {
        return $this->status === 'active'
            && ($this->expires_at === null || $this->expires_at->isFuture());
    }

    public function getDaysRemainingAttribute()
    {
        if (! $this->expires_at) {
            return null;
        }

        return max(0, now()->diffInDays($this->expires_at, false));
    }

    public function getIsExpiringSoonAttribute()
    {
        if (! $this->expires_at) {
            return false;
        }

        return $this->isActive() && $this->days_remaining <= 7;
    }

    // Update user premium status
    public function updateUserPremiumStatus()
    {
        if ($this->isActive()) {
            $this->user->update([
                'is_premium' => true,
                'premium_expires_at' => $this->expires_at,
            ]);
        } else {
            $this->user->update([
                'is_premium' => false,
                'premium_expires_at' => null,
            ]);
        }
    }
}
