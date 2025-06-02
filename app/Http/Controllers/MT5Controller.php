<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DerivApiService;

class MT5Controller extends Controller
{
    protected $derivApiService;

    public function __construct(DerivApiService $derivApiService)
    {
        $this->derivApiService = $derivApiService;
    }

    public function createAccount(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:8',
        //     'phone' => 'required|string',
        //     'address' => 'required|string',
        //     'country' => 'required|string',
        // ]);

        $data = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'password' => '1234567890',
            'phone' => '2349087328476',
            'address' => '4 Aminu Kano Crescent, Wuse 2, Abuja',
            'country' => 'Nigeria',
        ];

        $response = $this->derivApiService->createMT5Account($data);

        return response()->json($response);
    }
}
