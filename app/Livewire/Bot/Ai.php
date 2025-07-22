<?php

namespace App\Livewire\Bot;

use App\Models\Bot;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\CompanyAccount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Ai extends Component
{
    public $plan;
    public $amount;
    public $expires_at;
    public $paid = false;
    public $botKey;

    public function buyBot($amount, $plan, $expiresAt) {
        $genBotKey = self::generateBotKey();
        $this->botKey = $genBotKey;
        $this->paid = true;
        $this->amount = $amount;
        $this->expires_at = Carbon::parse($expiresAt);
        $this->plan = $plan;
        try {

            $account = auth()->user()->account;
            if($account->balance >= $amount){
                //updating user account
                $bal = $account->balance;
                $bal -= (double) $amount;
                $account->update(['balance' => $bal]);
                
                //updating company's account
                $com = CompanyAccount::where('email', 'nigakool@gmail.com')->first();
                $comBal = $com->balance;
                $comBal += (double) $amount;
                $com->update(['balance' => $comBal]);

                Bot::create([
                'user_id' => Auth::id(),
                'plan' => $plan,
                'amount' => (double) $amount,
                'status' => 'active',
                'botKey' => $genBotKey,
                'expires_at' => Carbon::parse($expiresAt),
                ]);

                Transaction::create([
                    'profit' => (double) $amount,
                    'account_id' => $account->id,
                    'type' => 'bot',
                    'amount' => (double) $amount,
                    'meta_data' => [
                        'plan' => $plan,
                        'expires_at' => Carbon::parse($expiresAt),
                    ],

                ]);

                $user = User::find(auth()->user()->referrer_id);
                if($user){
                    $user->referralAccount->increment('balance', round(((float) $this->amount * 0.06), 2));
                }

                session()->flash('success', 'You have successfully purchased trading Bot. ');
            }else{
                session()->flash('error', 'Insufficient funds. Please fund your account to proceed');
            }

        } catch (\Throwable $th) {
            // Optional: Log the error
            \Log::error('Buy bot processing error: ' . $th->getMessage(), [
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'trace' => $th->getTraceAsString()
            ]);
            // Optional: Show generic error to user
            session()->flash('error', 'An unexpected error occurred while processing your payment. Please try again later.');
        }
    }

    private static function generateBotKey(){
        $key = strtoupper(Str::random(24)); // Will include lowercase too
        $key = preg_replace('/[^A-Z0-9]/', '', $key); // Strip unwanted characters

        while (strlen($key) < 32) {
            $key .= strtoupper(Str::random(1));
            $key = preg_replace('/[^A-Z0-9]/', '', $key);
        }
        return $key = substr($key, 0, 24);
    }

    public function render()
    {
        return view('livewire.bot.ai');
    }
}
