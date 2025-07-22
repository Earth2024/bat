<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralAccount extends Model
{
    protected $fillable = [ 'user_id', 'balance'];

    protected $casts = [
        'balance' => 'float',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function referralWithdrawals(){
        return $this->hasMany(ReferralWithdrawal::class);
    }
}
