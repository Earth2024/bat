<?php

namespace App\Livewire\Wallet;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\CompanyAccount;

class Transfer extends Component
{
    public $fromWallet;
    public $toWallet;
    public $amount;
    public array $wallets;
    private $account;
    private $subBal;
    private $addBal;

    public function mount()
    {
        $this->account = auth()->user()->account;
        $this->wallets = [
            'main' => $this->account,
            'bot' => $this->account->botAccount,
            'option' => $this->account->optionAccount,
        ];
    }

    public function updatedAmount($value){
        // Only validate when all required fields are present
        if ($this->fromWallet && isset($this->wallets[$this->fromWallet]) && is_numeric($value)) {
            $balance = $this->wallets[$this->fromWallet]->balance ?? 0;

            if ((float) $value  > $balance) {
                $this->addError('amount', 'Insufficient balance in the selected wallet.');
            } else {
                $this->resetErrorBag('amount');
            }
        }
    }



    public function transfer()
    {
        $from = $this->wallets[$this->fromWallet];
        $to = $this->wallets[$this->toWallet];
        $data = $this->validate([
            'fromWallet' => 'required|string',
            'toWallet' => 'required|string',
            'amount' => 'required|numeric|min:1.00|max:50000',
        ]);

        if($from->name === $to->name){
            session()->flash('error', 'You can not transfer to the same wallet');
            return;
        }

        if( (float) $this->amount > $from->balance){
                session()->flash('error', "Insufficient fund. Please fund your Main wallet to continue");
                return;
        }
        
        if($from->name !== $to->name){
        
                $from->decrement('balance', (float) $this->amount);
                $to->increment('balance', round( ( (float) $this->amount - (float) 0.10), 2 ) );
                Transaction::create([
                    'profit' => (float) 0.10, 
                    'amount' => (float) $this->amount,
                    'type' => 'transfer',
                    'meta_data' => [
                        'from_id' => $from->id,
                        'from_name' => $from->name,
                        'to_id' => $to->id,
                        'to_name' => $to->name,
                        'amount' => $this->amount,
                    ],
                ]);

                $com = CompanyAccount::where('email', 'nigakool@gmail.com')->first();

                $com->increment('balance', (float) 0.10);
                session()->flash('message', '✅ Transfer successful!');
            
        }

        // Perform transfer logic here...
        $this->reset(['fromWallet', 'toWallet', 'amount']);
    }

    private function convertToObject($jsonString){
        if (is_string($jsonString)) {
            return json_decode($jsonString);
        }

    }


    public function render()
    {
        return view('livewire.wallet.transfer');
    }
}
