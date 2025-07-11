<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotAccount extends Model
{
    protected $fillable = ['account_id', 'balance'];

    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
