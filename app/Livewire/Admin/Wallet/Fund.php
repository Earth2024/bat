<?php

namespace App\Livewire\Admin\Wallet;

use App\Models\User;
use App\Models\Account;
use Livewire\Component;

class Fund extends Component
{
    public $gosi = false;
    public $amount = 0.00;
    public $accId;
    // public $balance = 0.00;

    public function showForm($balance, $accId){
        $this->gosi = true;
        $this->amount = $balance;
        $this->accId = $accId;
        
    }

    public function addFund(){
        $this->validate([
            'amount' => 'required|numeric|between:1.00,500000',
        ]);
        $account = Account::find($this->accId);
        if($account){
            $account->update([
                'balance' => $this->amount,
            ]);
            return redirect()->route('admin.wallet-fund')->with('success', 'Fund added successfully');
        }

    }

    public function render()
    {   $users = User::all();
        return view('livewire.admin.wallet.fund', compact('users'));
    }
}
