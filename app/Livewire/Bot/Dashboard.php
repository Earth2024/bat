<?php

namespace App\Livewire\Bot;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\BotTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class Dashboard extends Component
{
    public $symbol = 'Step Index',$id, $ticket, $price, $trade_time, $type, $lot = 0.01, $sl = 1, $tp = 1.2, $tsl, $strategy = 1;
    public $trades;

    protected $rules = [
        'symbol' => 'required|string',
        'lot' => 'required|numeric|min:0.001',
        'sl' => 'required|numeric|min:1',
        'tp' => 'required|numeric|min:1.2',
        'tsl' => 'nullable|numeric|min:1.2',
    ];

    //protected $listeners = ['tradeUpdated' => 'handleTradeUpdate'];

    public function handleTradeUpdate($trade)
    {
        $this->trades = json_decode(json_encode($trade));
        //dd($this->trades);
        
    }


    public function mount()
    {
        $this->loadTrades();
    }

    public function submit()
    {
        $this->validate([
            'symbol' => 'required|string',
            'lot' => 'required|numeric|min:0.01',
            'sl' => 'required|numeric|min:1',
            'tp' => 'required|numeric|min:1.2',
            'tsl' => 'nullable|numeric|min:1',
        ]);
        
        try {
            $trade = BotTransaction::create([
            'bot_account_id' => auth()->user()->account->botAccount->id,
            'user_id' =>  auth()->user()->id,
            'symbol' => $this->symbol,
            'lot' => (float) $this->lot,
            'sl' => (float) $this->sl,
            'tp' => (float) $this->tp,
            'tsl' => (float) $this->tsl,
            'placed_time' => Carbon::now(),
        ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        $this->id = $trade->id;
        // Send to Node.js backend
        Http::post('http://127.0.0.1:3000/signal', [
            'user_id' => $trade->id,
            'symbol' => $trade->symbol,
            'lot' => $trade->lot,
            'sl' => $trade->sl,
            'tp' => $trade->tp,
            //'user_id' => $trade->user_id,
            'tsl' => $this->tsl,
            'strategy' => $this->strategy,
        ]);
        session()->flash('status', 'Trade request sent successfully!');
        $this->reset(['symbol', 'lot', 'sl', 'tp', 'strategy']);
        //$this->loadTrades();
    }

    public function stopTrade($ticket)
    {   //dd($ticket, $this->id);
        try {
            $response = Http::post('http://127.0.0.1:3000/stop-trade', [
                'ticket' => $ticket,
                'user_id' => $this->id,
            ]);

            if ($response->ok()) {
                session()->flash('status', 'Stop request sent successfully!');
            } else {
                session()->flash('error', 'Failed to send stop request.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function closeTrade($ticket)
    {
        $response = Http::post('http://127.0.0.1:3000/close-trade', [
            'ticket' => $ticket,
        ]);

        if ($response->successful()) {
            session()->flash('success', "Trade #$ticket queued for closure.");
        } else {
            session()->flash('error', "Failed to queue trade #$ticket for closure.");
        }
    }

    public function fetchTrades()
    {
        $response = Http::get('http://127.0.0.1:3000/trades');
        if ($response->successful()) {
            $trad = $response->json();
        }
    }

    public function loadTrades()
    {
       $this->trades = BotTransaction::where('bot_account_id', auth()->user()->account->botAccount->id)->latest()->get();
    }
    
    public function render()
    {   $this->loadTrades();
        return view('livewire.bot.dashboard');
    }
}
