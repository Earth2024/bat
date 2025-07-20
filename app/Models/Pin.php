<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $fillable = [
        'pin', 'expires_at', 'reset_code', 'account_id',
    ];

    protected $casts = [
        'pin' => 'string',
    ];
}
