<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
       // dd($user);
        // Automatically create a Deriv MT5 account
        $derivAccount = $this->createMT5Account($user);
        dd($derivAccount);
        // Store Deriv details
        $user->update(['deriv_account_id' => $derivAccount['account_id']]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'mt5_account' => $derivAccount,
        ]);
    }


    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = Auth::user();

        // Validate Deriv account silently
        $derivValidation = $this->validateDerivAccount($user->deriv_account_id);

        if (!$derivValidation || !$derivValidation['success']) {
            return response()->json(['message' => 'Error validating Deriv account'], 401);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'deriv_status' => $derivValidation,
        ]);
    }

    private function createMT5Account($user) {
        return Http::post(env('DERIV_API_URL').'/create_mt5_account', [
            'account_type' => 'real',
            'currency' => 'USD',
            'leverage' => 100,
            'name' => $user->name,
            'token' => env('DERIV_API_TOKEN')
        ])->json();
    }


    private function validateDerivAccount($account_id) {
        return Http::get(config('api.deriv_base_url').'/verify_mt5_account', [
            'account_id' => $account_id,
            'token' => config('api.api_token')
        ])->json();
    }
}
