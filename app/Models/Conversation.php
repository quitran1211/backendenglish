<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'conversations';

    protected $fillable = [
        'id',
        'title',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    // Helper: Generate conversation ID
    public static function generateId(int $userId): string
    {
        return 'conv_'.time().'_'.$userId;
    }
}
