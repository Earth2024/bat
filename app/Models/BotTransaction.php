<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotTransaction extends Model
{
    protected $fillable = [
        'symbol', 'lot', 'sl', 'tp', 'tsl', 'ticket',
        'price', 'type', 'placed_time', 'bot_account_id',
        'user_id'
    ];

    public function botAccount(){
        return $this->belongTo(BotAccount::class, 'bot_account_id', 'id');
    }
}
