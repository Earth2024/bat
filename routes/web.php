<?php

use App\Models\Country;
use StephenHill\Base58;
use Illuminate\Http\Request;
use App\Services\Transaction\Bnb;
use App\Services\Transaction\Eth;
use App\Services\Transaction\Sol;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\DB;
use App\Livewire\Settings\Password;
use Illuminate\Support\Facades\Http;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MT5Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MT5AccountController;
use App\Http\Controllers\BinaryLoginController;
use App\Http\Controllers\BinaryRegisterController;


//Route::post('/create-mt5-account', [MT5AccountController::class, 'createAccount'])->name('mt_5');

Route::get('login', [BinaryLoginController::class, 'showLoginForm'])->name('login');

Route::get('register', [BinaryRegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('register', [BinaryRegisterController::class, 'register'])->name('bat.register');

Route::post('login', [BinaryLoginController::class, 'login'])->name('bat.login');

Route::get('/', function () {
    return view('frontend.page.index');
})->name('home');


Route::get('user-test', function () {
    return view('deriv-form');
});


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
    return view('test2');
});

Route::get('testo', function(){
    return view('test3');
});

Route::get('bank', function(){
    return view('bank');
});

Route::get('tasty', function(){
    return view('bot');
});

Route::get('seven-rise', function(){
    return view('seven-dollar-rise');
});

Route::get('opt', function(){
    dd(Cache::get('opt'));
});

require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';

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


Route::get('sol', function(){

    $sol = app()->call('App\\Services\\Wallets\\SolanaWallet@generateSolanaWallet');
    $bnb = app()->call('App\\Services\\Wallets\\BnbWallet@generateBnbWallet');
    $eth = app()->call('App\\Services\\Wallets\\EtherWallet@generateEthereumWallet');
    dd([$bnb['address'], $eth['address'], $sol['address'] ]);
});


// Route::get('/oauth/callback', function (Request $request) {
//     $token = $request->query('access_token');
    
//     // Fetch user details from Deriv API
//     $response = Http::get("https://api.deriv.com/v2/userinfo", [
//         'headers' => [
//             'Authorization' => "Bearer " . $token
//         ]
//     ]);

//     $userData = $response->json();

//     // Store user details in session or database
//     session([
//         'oauth_token' => $token,
//         'user_name' => $userData['name'],
//         'user_email' => $userData['email']
//     ]);

//     return redirect('/dashboard'); // Redirect user after login
// });

// Route::get('/dashboard', function () {
//     if (!session('oauth_token')) {
//         return redirect('/'); // Redirect if not logged in
//     }

//     return view('dashboard', ['user' => session()]);
// });

// Route::get('/logout', function () {
//     session()->forget(['oauth_token', 'user_name', 'user_email']);
//     return redirect('/');
// });

Route::get('doke', function(){
    // return view('deriv-form');
    $bnbA = DB::table('bnb_wallets')->pluck('address')->toArray();
    foreach($bnbA as $bnb){
        Bnb::bnbBalance($bnb);
    }
    $ethA = DB::table('eth_wallets')->pluck('address')->toArray();
    foreach($ethA as $eth){
        Eth::EthBalance($eth);
    }
    $solA = DB::table('sol_wallets')->pluck('address')->toArray();
    foreach($solA as $sol){
        Sol::solBalance($sol);
    }
    
    // $address = '0xcd46b5cffe248dc6a67a2012d1f1674f57859d09'; //erc20
    // $address2 = '0xeeb03a25d76f5751fddad750e70b27c152fc25ce'; //bep20;
    // $address3 = 'FjvJkAKq59KU4dv85xMZ7u3AFeepakpMYKHok764mMiN'; //sol
    // $eth = Eth::ethBalance($address);
    // $bnb = Bnb::bnbBalance($address2);
    // $sol = Sol::solBalance($address3);
    return 'Everything went well';
});


Route::get('ai-trade', function(){

    $base58Key = '2ZddpxuPSUMWE4S4mDvMUdnHSEphZ29r3pfFe5GiCMCQ82B2ibCdsG6gCC2oWDeUkYQ1M8zxnPJigmAVbRGoPb9u';

    $base58 = new Base58();
    $decoded = $base58->decode($base58Key);

    // Convert to array of integers and reindex it
    $byteArray = array_values(unpack('C*', $decoded));

    // Output as JSON-style number array
    echo '[' . implode(',', $byteArray) . ']';
        //return view('ai-trade');
});
//important route
Route::get('/country-search', function (\Illuminate\Http\Request $request) {
    $search = $request->get('q');

    return \App\Models\Country::where('name', 'like', "%{$search}%")
    ->limit(5)
    ->get(['code', 'name'])
    ->map(function ($country) {
        return [
            'id' => strtolower($country->code ?? ''),
            'name' => $country->name,
        ];
    });

})->name('country.search');


