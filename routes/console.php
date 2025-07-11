<?php

use App\Models\BnbWallet;
use App\Models\EthWallet;
use App\Models\SolWallet;
use App\Services\Transaction\Bnb;
use App\Services\Transaction\Eth;
use App\Services\Transaction\Sol;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('app:check-wallet-balances')->everyMinute();


