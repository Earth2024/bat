<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', function(){
        return view('backend.admin.dashboard');
    })->name('admin.dashboard');

    Route::get('admin/wallet', function(){
        return view('backend.admin.wallet.fund');
    })->name('admin.wallet-fund');

    Route::get('admin/stellar-wallet/creation', function(){
        return view('backend.admin.wallet.create-wallet');
    })->name('admin.wallet-create');

    Route::get('admin/wallet/users', function(){
        return view('backend.admin.wallet.user-wallet');
    })->name('admin.wallet-users');

    Route::get('admin/users', function(){
        return view('backend.admin.user.index');
    })->name('admin.users');
});