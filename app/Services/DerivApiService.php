<?php

namespace App\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DerivApiService
{
    protected $client;
    protected $apiUrl = "https://api.deriv.com/v2/";
    protected $apiToken;

    public function __construct() {
        $this->client = new Client();
        $this->apiToken = env('DERIV_API_TOKEN_2'); // Store token in .env
    }

    public function createMT5Account($userData) {
        $response = $this->client->post($this->apiUrl . "new_account_real", [
            'headers' => [
                'Authorization' => "Bearer " . $this->apiToken,
                'Content-Type' => 'application/json'
            ],
            'json' => $userData
        ]);
        return json_decode($response->getBody(), true);
    }
}
