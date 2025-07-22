<?php

namespace App\Livewire\Referral;

use Livewire\Component;
use App\Models\User as Users;
use App\Models\CompanyAccount;
use App\Models\ReferralWithdrawal;
use Livewire\Attributes\On;

class User extends Component
{
    // public $users;
    // public $url;
    // public $refAmount;
    // public $refwithdrawalAmount;

    public function withdrawFund(){
        $refAmount = auth()->user()->referralAccount;
        if($refAmount->balance < 5){
            return back()->with('error', 'The minimum withdrawal amount is 5 usd');
        }
        ReferralWithdrawal::create([
            'amount' => (float) ($refAmount->balance - 0.20),
            'referral_account_id' => $refAmount->id,
            'type' => 'withdrawal',
        ]);
        
        $total = round( ((float) $refAmount->balance - (float) 0.20), 2 );
        auth()->user()->account->increment('balance', (float) round($total, 2));
        $refAmount->update(['balance' => 0]);
        CompanyAccount::first()->increment('balance', 0.2);
        $updatedAmount = $refAmount;
        $this->dispatch('updatedAmount', $updatedAmount);
        return back()->with('success', 'You have successfully transferred funds to main wallet');
    }

    #[on('updatedAmount')]
    public function render()
    {
        $allUsers = Users::where('referrer_id', auth()->user()->id);
        $users = $allUsers->get();
        $url = url('/register?ref=' .auth()->user()->referral_code);
        $refAmount = auth()->user()->referralAccount;
        $referrer = auth()->user()->referralAccount;
        $refwithdrawalAmount = ReferralWithdrawal::where('referral_account_id', $referrer->id)
        ->where('type', 'withdrawal')
        ->sum('amount');
        return view('livewire.referral.user', compact('allUsers', 'users', 'url', 'refAmount', 'referrer', 'refwithdrawalAmount'));
    }
}
