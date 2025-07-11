<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = [
        'user_id', 'plan', 'amount', 'status', 'botKey', 'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'amount' => 'double',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

}
