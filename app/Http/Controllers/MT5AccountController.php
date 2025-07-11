<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\DerivApiService;

class MT5AccountController extends Controller {
    protected $derivService;

    public function __construct(DerivApiService $derivService) {
        $this->derivService = $derivService;
    }

    public function createAccount(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'currency' => 'required|string',
            'leverage' => 'required|integer',
            'password' => 'required',
        ]);

        $account = $this->derivService->createMT5Account($validated);
        dd(response()->json($account));
        return response()->json($account);
    }
}
