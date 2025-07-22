<?php

namespace App\Livewire\Evaluation;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\CompanyAccount;
use App\Services\Evaluation\Evaluation;

class Purchase extends Component
{
    public bool $funding = false;
    public bool $evaluation = true;
    public int $amount =  1000;
    public int $drawDown = 50;
    public int $maxDrawDown = 100;
    public int $profitTarget = 120;
    public int $profitTargetTwo = 80;
    public int $purchaseAmount = 21;
    public bool $paid = false;

    public function getEvaluation($text){
        if($text === 'funding'){
            $this->funding = true;
            $this->evaluation = false;
            $this->amount = 20000;
            $this->maxDrawDown = 2000;
            $this->drawDown = 1000;
            $this->purchaseAmount = 150;
        }elseif($text === 'evaluation'){
            $this->evaluation = true;
            $this->funding = false;
            $this->amount = 1000;
            $this->maxDrawDown = 100;
            $this->drawDown = 50;
            $this->purchaseAmount = 21;
        }
    }

    public function getAmount($amount){
        $this->amount = $amount;
        $this->drawDown = ($amount * (double) 0.05);
        $this->maxDrawDown = ($amount * (double) 0.10);
        $this->profitTarget = ($amount * (double) 0.12);
        $this->profitTargetTwo = ($amount * (double) 0.08);
        if($amount == 1000){
            if($this->funding === true){
                $this->purchaseAmount = 41;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 21;
            }
        }elseif($amount == 5000){
            if($this->funding === true){
                $this->purchaseAmount = 61;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 32;
            }
        }elseif($amount == 10000){
            if($this->funding === true){
                $this->purchaseAmount = 90;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 44;
            }
        }elseif($amount == 20000){
            if($this->funding === true){
                $this->purchaseAmount = 150;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 84;
            }
        }elseif($amount == 50000){
            if($this->funding === true){
                $this->purchaseAmount = 230;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 140;
            }
        }elseif($amount == 100000){
            if($this->funding === true){
                $this->purchaseAmount = 380;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 180;
            }
        }elseif($amount == 200000){
            if($this->funding === true){
                $this->purchaseAmount = 540;
                $this->evaluation = false;
            }else{
                $this->purchaseAmount = 210;
            }
        }
    }

    public function makePayment(){
        try {
            
            $account = auth()->user()->account;
            if($account->balance >= $this->purchaseAmount){
                $fee = 4;
                $paidAmount = $this->purchaseAmount - (int) $fee;
                $dataEvaluationAccount = [
                        'initial_balance' => $this->purchaseAmount,
                        'status' => 'active', 
                        'purchased_at' => Carbon::now(),
                        'user_id' => auth()->user()->id,
                    ];

                    //storing evaluationAccount;

                    $evaluationAccount = Evaluation::storeEvaluationAccount($dataEvaluationAccount);

                    $dataEvaluationMetric = [
                        'evaluation_account_id' => $evaluationAccount->id,
                        'profit' => $this->profitTarget,
                        'max_drawdown' => $this->maxDrawDown,
                        'drawDown' => $this->drawDown,
                    ];

                    
                    $dataTransaction = [
                        'account_id' => $account->id,
                        'profit' => $fee,
                        'type' => 'evaluation',
                        'amount' => $paidAmount,
                        'meta_data' => [
                            'evaluation_account_id' => $evaluationAccount->id,
                            'total_amount_paid' => $this->purchaseAmount,
                            'user_id' => auth()->user()->id,
                            'challenge_account_amount' => $this->amount,
                            'drawDown' => $this->drawDown,
                            'maxDrawDown' => $this->maxDrawDown,
                            'account_challenge_type' => $this->evaluation === true ? 'Evaluation' : 'Funding',
                        ],   
                    ];

                    $newBalance = $account->balance;
                    $newBalance -= $this->purchaseAmount;
                    $dataAccount = [
                        'balance' => $newBalance,
                    ];
                    $user = User::find(auth()->user()->referrer_id);
                    if($user){
                        $user->referralAccount->increment('balance', round(((float) $this->amount * 0.06), 2));
                    }
                    
                    $company = CompanyAccount::where('email', 'nigakool@gmail.com')->first();
                    $comBal = $company->balance;
                    $comBal += $this->purchaseAmount;
                    $dataAccountCompany = [
                        'balance' => $comBal,
                    ];

                    $don = Evaluation::makePayment($dataEvaluationMetric, $dataTransaction, $dataAccount, $dataAccountCompany);
                    //if($don){
                        $this->paid = true;
                        session()->flash('success', "Congratulations! Your account purchase is successful");
                   // }
            }else{
                session()->flash('error', "You don't have sufficient funds. Please fund your account");
            }

        } catch (\Throwable $th) {
            // Optional: Log the error
            \Log::error('Payment processing error: ' . $th->getMessage(), [
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'trace' => $th->getTraceAsString()
            ]);
            // Optional: Show generic error to user
            session()->flash('error', 'An unexpected error occurred while processing your payment. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.evaluation.purchase');
    }
}
