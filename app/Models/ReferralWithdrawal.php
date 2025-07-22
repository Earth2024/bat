<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralWithdrawal extends Model
{
    protected $fillable = [
        'referral_account_id', 'type', 'amount',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function referralAccount(){
        return $this->belongsTo(ReferralAccount::class);
    }
}
