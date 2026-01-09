<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // dùng class này!
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // ← hoặc 'users' nếu bạn dùng chung bảng

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
