<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationAccount extends Model
{
    protected $fillable = [
        'user_id', 'initial_balance', 'status', 'purchased_at', 'expires_at',
    ];
}
