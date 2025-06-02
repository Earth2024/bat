<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DerivApiService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = env('DERIV_API_URL');
        $this->apiToken = env('DERIV_API_TOKEN');
    }

    public function createMT5Account($userData)
    {
        $response = Http::post("{$this->apiUrl}/v2/mt5/new_account", [
            'account_type' => 'demo', // or 'real'
            'currency' => 'USD',
            'leverage' => 100,
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'phone' => $userData['phone'],
            'address' => $userData['address'],
            'country' => $userData['country'],
            'api_token' => $this->apiToken,
        ]);

        return $response->json();
    }

    public function getAccountDetails($accountId)
    {
        $response = Http::get("{$this->apiUrl}/v2/account/details", [
            'account_id' => $accountId,
            'api_token' => $this->apiToken,
        ]);

        return $response->json();
    }
}
