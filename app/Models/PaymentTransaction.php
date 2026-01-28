<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'plan_id',
        'transaction_code',
        'amount',
        'payment_method',
        'payment_gateway_transaction_id',
        'proof_image', // ⭐ Thêm dòng này
        'proof_uploaded_at', // ⭐ Thêm dòng này
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'proof_uploaded_at' => 'datetime', // ⭐ Quan trọng

    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // Helpers
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 0, ',', '.').' VNĐ';
    }

    public static function generateTransactionCode()
    {
        return 'TXN'.strtoupper(uniqid()).rand(1000, 9999);
    }
}
