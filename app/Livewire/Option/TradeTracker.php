<?php
namespace App\Livewire\Option;

use App\Models\Option;
use Livewire\Component;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\Auth;

class TradeTracker extends Component
{
    protected $listeners = ['createTrade' => 'createTrade', 'finalizeTrade' => 'finalizeTrade'];

    public function createTrade(string $contract_id, $amount, string $contractType)
    {
        Option::create([
            'contract_id' => $contract_id,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'status' => 'pending',
            'type' => $contractType,
        ]);

    }

    public function finalizeTrade(string $contractId, $status, $profit)
    {
        $option = Option::where('contract_id', $contractId)->first();
    
        if (! $option || $option->user_id !== Auth::id()) {
            return;
        }
        $pro = round(((($profit * 100) / (double) 86) * 0.76), 2);
        $option->update([
            'status' => $status,
            'profit' => $profit > 0 ? $pro : 0,
        ]);

        if ($profit > 0) {
            $option->user->account->optionAccount->increment('balance', $option->amount + $pro);
            CompanyAccount::where('email', 'nigakool@gmail.com')->first()
            ->increment('balance', round( ((float) $profit - (float) $pro), 3) );
        }
    }

    public function render()
    {
        return view('livewire.option.trade-tracker');
    }
}
