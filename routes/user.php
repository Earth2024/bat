<?php

// use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\BinaryLoginController;
use App\Http\Middleware\EnsureUserHasActiveBotKey;
use App\Http\Controllers\EvaluationAccountController;


Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [BinaryLoginController::class, 'dashboard'])->name('dashboard');
    Route::get('deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::get('evaluation-account', [EvaluationAccountController::class, 'create'])->name('evaluation.create');
    Route::get('expert-adviser', [BotController::class, 'create'])->name('bot.create');
    Route::post('expert-adviser/store', [BotController::class, 'store'])->name('bot.store');
    Route::get('expert-adviser/dashboard', [BotController::class, 'dashboard'])->name('bot.dashboard')
    ->middleware([EnsureUserHasActiveBotKey::class]);
    //options routes
    Route::get('option/', [OptionController::class, 'index'])->name('option');
    Route::post('option/place-trade', [OptionController::class, 'place'])->name('option.place');
    Route::get('options', [OptionController::class, 'test'])->name('option.test');
    Route::post('/option/update-trade', [OptionController::class, 'update_trade'])->name('option.update');
    //wallet-transfer route
    Route::get('wallets', [WalletController::class, 'index'])->name('wallets');
    Route::get('transfer', function(){
        return view('backend.stellar.transferFund');
    })->name('user.transfer');

    Route::get('profile', function(){
        return view('backend.profile.profile');
    })->name('user.profile');
});

