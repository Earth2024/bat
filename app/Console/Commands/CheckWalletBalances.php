<?php

namespace App\Console\Commands;

use App\Models\BnbWallet;
use App\Models\EthWallet;
use App\Models\SolWallet;
use Illuminate\Console\Command;
use App\Services\Transaction\Bnb;
use App\Services\Transaction\Eth;
use App\Services\Transaction\Sol;
use Illuminate\Support\Facades\DB;

class CheckWalletBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-wallet-balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(){
        $bnbA = BnbWallet::pluck('address')->toArray();
        foreach($bnbA as $bnb){
            Bnb::bnbBalance($bnb);
        }

        $ethA = EthWallet::pluck('address')->toArray();
        foreach($ethA as $eth){
            Eth::EthBalance($eth);
        }

        $solA = SolWallet::pluck('address')->toArray();
        foreach($solA as $sol){
            Sol::solBalance($sol);
    }
    }

}
