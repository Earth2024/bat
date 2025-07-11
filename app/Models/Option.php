<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'contract_id', 'status', 'amount', 'profit', 'user_id', 'type',
    ];

    protected $casts = [
        'amount' => 'double',
        'profit' => 'double',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
