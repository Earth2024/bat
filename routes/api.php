<?php

use App\Http\Controllers\MT5AccountController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);


Route::post('/create-mt5-account', [MT5AccountController::class, 'createAccount']);

Route::post('/api/stellar/deposit', function (Request $request) {
    Deposit::create([
        'email' => $request->uid,
        'sender' => $request->sender,
        'amount' => $request->amount
    ]);
    return response()->json(['status' => 'success']);
});

