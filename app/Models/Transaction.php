<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'transaction', 'profit', 'type', 'amount', 'meta_data', 'signature', 'address', 'sender', 'receiver', 'block_time'];

    protected $casts = [
        'meta_data' => 'array',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
