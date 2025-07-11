<?php

namespace App\Services\Wallets;

use kornrunner\Ethereum\Address;
use kornrunner\Keccak;
use Elliptic\EC;

class BnbWallet{

    public function generateBnbWallet(){
        $ec = new EC('secp256k1');
        $keyPair = $ec->genKeyPair();

        $privateKey = $keyPair->getPrivate('hex');
        $publicKey = $keyPair->getPublic(false, 'hex'); // uncompressed
        $publicKeyHex = substr($publicKey, 2); // remove '04' prefix

        $hash = Keccak::hash(hex2bin($publicKeyHex), 256);
        $address = '0x' . substr($hash, -40);

        return [
            'name' => 'BEP20',
            'address' => $address,
            'privateKey' => '0x' . $privateKey,
        ];
    }
}
