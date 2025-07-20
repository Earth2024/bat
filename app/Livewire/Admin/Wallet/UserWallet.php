<?php

namespace App\Livewire\Admin\Wallet;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Http;


class UserWallet extends Component
{
    public $users; 
    public $address;
    public $bal;

    public $gosi = false;
    public $acc;
    public $error;



    public function checkBalance($id){
        $this->gosi = true;
        $user = User::find($id);
        $ad = $user->bnb;
        $this->acc = $user->account->balance;
        if($ad){
            $this->bal = $this->bnbBalance($ad->address);
        }
        
    }

    public function BackTo(){
        $this->gosi = false;
    }

    public function render()
    {
        $this->users = User::all();
        return view('livewire.admin.wallet.user-wallet');
    }

    private function bnbBalance($address){
        $apiKey = env('BSCSCAN_API_KEY');
        $contract = '0x55d398326f99059fF775485246999027B3197955'; // USDT on BSC

        $response = Http::get("https://api.bscscan.com/api", [
            'module' => 'account',
            'action' => 'tokentx',
            'contractaddress' => $contract,
            'address' => $address,
            'page' => 1,
            'offset' => 50,
            'sort' => 'desc',
            'apikey' => $apiKey,
        ]);
            //dd($response->json()["message"]);
        try {

            $txs = $response->json('result');

            $rawAmount = $txs[0]['value'];
            $amount = round(($rawAmount / 1000000000000000000), 3); // readable + 3 decimal places

            return $bal = round($amount, 3);
            } catch (\Throwable $th) {
            $this->error = $response->json()["message"];
        }


    }


}

