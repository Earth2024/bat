<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['user_id', 'balance'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function optionAccount(){
        return $this->hasOne(OptionAccount::class);
    }

    public function botAccount(){
        return $this->hasOne(BotAccount::class);
    }

    public function pin(){
        return $this->hasOne(Pin::class);
    }
}
