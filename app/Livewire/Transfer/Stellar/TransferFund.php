<?php

namespace App\Livewire\Transfer\Stellar;

use App\Models\Stellar;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TransferFund extends Component
{
    public array $wallets;
    public $amount;
    public $showModal = false;
    public $email;
    public $success;
    public $error;
    public $address;
    public $pin;


    // public function transfer()
    // {
    //     $wal = Stellar::first();
    //     $senderWallet = $wal->secret_key;
    //     $recipient = $wal->public_key;

    //     $payload = [
    //         'fromSecret' => $senderWallet,
    //         'toPublic' => $recipient,
    //         'amount' => $this->amount,
    //         'memo' => $this->email,
    //     ];

    //     //dd($payload);

    //     try {
    //         $response = Http::post('http://localhost:3000/api/internal-transfer', $payload);
    //         //dd($response);
    //         if ($response->successful()) {
    //             $this->success = 'Transfer completed!';
    //             $this->email = '';
    //             $this->amount = '';
    //         } 
    //     } catch (\Throwable $th) {
    //         dd($th->getMessage());
    //     }
    // }

    public function updatedPin()
    {
        
        $this->pin = preg_replace('/[^0-9.]/', '', $this->pin);

        if (strlen($this->pin)  > 4) {
                $this->addError('pin', 'Pin length must be 4 digits.');
            } else {
                $this->resetErrorBag('pin');
            }
    }

    public function mount()
    {
        $this->account = auth()->user()->account;
        $this->wallets = [
            'main' => $this->account,
        ];
    }

    public function updatedAmount($value){
        // Only validate when all required fields are present
        if (isset($this->wallets['main']) && is_numeric($value)) {
            $balance = $this->wallets['main']->balance ?? 0;

            if ((float) $value  > $balance) {
                $this->addError('amount', 'Insufficient balance in the selected wallet.');
            } else {
                $this->resetErrorBag('amount');
            }
        }
    }

    public function sendTransfer()
    {
        $this->validate([
            'address' => 'required|string',
            'amount' => 'required|numeric|between:0,20000', 
            'pin' => ['required', 'digits:4'],
        ]);

        if(!Hash::check((int) $this->pin, auth()->user()->account->pin->pin)){
            return back()->with('error', 'Incorrect pin');
        }

        $response = Http::post('http://localhost:3000/api/transfer', [
            'address' => $this->address,
            'amount' => $this->amount,
            'privateKey' => auth()->user()->bnb->privateKey,
        ]);

        if ($response->successful()) {
            session()->flash('message', 'Transfer initiated: ' . $response->json()['txHash']);
        } else {
            // session()->flash('error', 'Transfer failed: ' . $response->body());
            session()->flash('error', 'Insufficient fund');
        }
    }

    public function render()
    {
        return view('livewire.transfer.stellar.transfer-fund');
    }
}
