<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User;

class ReferralSystem extends Component
{
    public $referralLink;

    public function mount()
    {
        $user = auth()->user();
        if (!$user->referral_code) {
            $user->referral_code = strtoupper(Str::random(8));
            $user->save();
        }

        $this->referralLink = url('/register?ref=' .auth()->user()->referral_code);
    }

    public function render()
    {   $this->referralLink = url('/register?ref=' .auth()->user()->referral_code);
        return view('livewire.referral-system');
    }
}
