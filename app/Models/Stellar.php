<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stellar extends Model
{
    protected $fillable = [
        'funded', 'public_key', 'secret_key', 'friendbot_response',
    ];

    protected $casts = [
        'friendbot_response' => 'array',
    ];
}
