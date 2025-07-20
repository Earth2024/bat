<?php

namespace App\Livewire\Admin\Wallet;

use App\Models\Stellar;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateAddress extends Component
{
    public $activateCreate = false;
    public $wallets;

    public function showForm(){
        $this->activateCreate = true;
    
    }

    public function createWallet()
    {
        $response = Http::get('http://localhost:3000/api/create-wallet', [
            'token' => env('ADMIN_TOKEN')
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $this->wallet = Stellar::create([
                'public_key' => $data['publicKey'],
                'secret_key' => $data['secretKey'],
                'funded' => $data['funded'],
                'friendbot_response' => json_encode($data['friendbot'] ?? [])
            ]);
        } else {
            $this->error = 'Wallet creation failed.';
        }
    }

    public function render()
    {
        $this->wallets = Stellar::all();
        return view('livewire.admin.wallet.create-address');
    }
}
