<?php

namespace App\Livewire\Deposit;

use Livewire\Component;
use App\Models\BnbWallet;
use App\Models\EthWallet;
use App\Models\SolWallet;

class Deposit extends Component
{
    public $bep = '';
    public $erc = '';
    public $sol = '';
    public $amount;
    public $name;
    public $wallet = '';
    public $hideWallet = false;
    public $cryptoName;

    public function updatedAmount()
    {
        
        $this->amount = preg_replace('/[^0-9.]/', '', $this->amount);
        $this->amount = min(max($this->amount, 0), 100000);
        
    }

    public function getAddress(){
        $this->cryptoName = $this->name;
        $this->validate([
            'cryptoName' => 'required',
            'amount' => 'required|numeric|min:4',
        ]);

        if($this->cryptoName === 'bep20'){
            $this->wallet = BnbWallet::where('name', strtoupper($this->cryptoName))->first()->address;
        }elseif($this->cryptoName === 'erc20'){
            $this->wallet = EthWallet::where('name', strtoupper($this->cryptoName))->first()->address;
        }elseif($this->cryptoName === 'sol'){
            $this->wallet = SolWallet::where('name', strtoupper($this->cryptoName))->first()->address;
        }
        
        
        $this->hideWallet = true;
    }

    public function goBack(){
        $this->hideWallet = false;
    }

    public function render()
    {
        return view('livewire.deposit.deposit');
    }
}
