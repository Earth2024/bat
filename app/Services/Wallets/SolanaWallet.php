<?php
namespace App\Services\Wallets;

use StephenHill\Base58;

class SolanaWallet{
    public function generateSolanaWallet()
    {
        // Generate Ed25519 keypair using Libsodium
        $keypair = sodium_crypto_sign_keypair();
        $privateKey = sodium_crypto_sign_secretkey($keypair);
        $publicKey = sodium_crypto_sign_publickey($keypair);

        // Encode keys in Base58 (Solana format)
        $base58 = new Base58();
        $privateKeyBase58 = $base58->encode($privateKey);
        $publicKeyBase58 = $base58->encode($publicKey);

        return [
            'name' => 'SOL',
            'address' => $publicKeyBase58,
            'privateKey' => $privateKeyBase58,
        ];
    }
}