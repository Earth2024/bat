<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'email', 'amount', 'sender',
    ];

    protected $casts = [
        'amount' => 'float',
    ];
}
