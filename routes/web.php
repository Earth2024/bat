<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MT5Controller;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('test', function(){
    return view('test');
});


Route::get('/create-mt5-account', [MT5Controller::class, 'createAccount']);

require __DIR__.'/auth.php';
require __DIR__.'/user.php';

//new deriv logic 

Route::get('/logi', [AuthController::class, 'redirectToDeriv']);
Route::get('/oauth/callback', [AuthController::class, 'handleCallback']);
Route::get('/profile', [AuthController::class, 'getProfile']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('deriv-form', function(){
    return view('deriv-form');
});

Route::get('get-result', function(){
    dd(Session::get('access_token'));
});

Route::get('/signup', function () { return view('auth.register'); });
Route::post('/signup', [AuthController::class, 'register']);

Route::get('/logins', function () { return view('auth.login'); });
Route::post('/logins', [AuthController::class, 'login']);