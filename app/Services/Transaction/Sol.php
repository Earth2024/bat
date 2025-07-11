<?php
namespace App\Services\Transaction;
use App\Models\SolWallet;
use App\Models\Transaction;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\Http;

class Sol{

    public static function solBalance($address){
        //step1. fetch recent transaction signature. Limit of 5.
        $response = Http::post('https://api.mainnet-beta.solana.com', [
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'getSignaturesForAddress',
            'params' => [
                $address,
                [ 'limit' => 5 ]
            ]
        ]);

        $signaturesData = $response->json();

        //second step to fetch the balance

        if (!isset($signaturesData['result'])) {
        return dd(['error' => 'No signatures found', 'raw' => $signaturesData]);
        }

        $signatures = array_column($signaturesData['result'], 'signature');
    
        // Step 2: For each signature, fetch full transaction details
   
        self::updateOrCreateSolTrans($signatures);
    }


    //this is for native solana
    // private static function updateOrCreateSolTrans(array $signatures){
    //     foreach ($signatures as $signature) {
    //         $response = Http::post('https://api.devnet.solana.com', [
    //             'jsonrpc' => '2.0',
    //             'id' => 1,
    //             'method' => 'getTransaction',
    //             'params' => [$signature, 'jsonParsed']
    //         ]);

    //         $result = $response->json('result');

    //         if (!$result || empty($result['transaction']['message']['instructions'])) {
    //             continue; // Skip empty or invalid transactions
    //         }

    //         $instructions = $result['transaction']['message']['instructions'];

    //         foreach ($instructions as $ix) {
    //             if (
    //                 isset($ix['parsed']) &&
    //                 $ix['parsed']['type'] === 'transfer' &&
    //                 $ix['program'] === 'system'
    //             ) {
    //                 $info = $ix['parsed']['info'];

    //                 $sol = SolWallet::where('address', $info['destination'])->with('user.account')->first();
    //                 if (!$sol || !$sol->user || !$sol->user->account) {
    //                     continue; // Skip if wallet, user, or account is missing
    //                 }

    //                 $account = $sol->user->account;

    //                 // Only proceed if signature doesn't exist yet
    //                 $exists = Transaction::where('signature', $signature)->exists();
    //                 if ($exists) {
    //                     continue; // Don't duplicate or double-charge
    //                 }

    //                 $transaction = Transaction::create([
    //                     'account_id'     => $account->id,
    //                     'type'           => 'deposit',
    //                     'signature'      => $signature,
    //                     'address'        => $info['destination'],
    //                     'sender'         => $info['source'],
    //                     'receiver'       => $info['destination'],
    //                     'amount'         => $info['lamports'] / 1e9,
    //                     'block_time'     => isset($result['blockTime']) ? now()->setTimestamp($result['blockTime']) : now(),
    //                     'meta_data'      => $result,
    //                 ]);

    //                 // Update the account balance
    //                 if ($transaction->type === 'deposit') {
    //                     $account->balance += $transaction->amount;
    //                 } elseif ($transaction->type === 'withdrawal') {
    //                     $account->balance -= $transaction->amount;
    //                 }

    //                 $account->save();
    //             }
    //         }
    //     }
    // }

    //this is for usdt solana i.e spl-token
    private static function updateOrCreateSolTrans(array $signatures){
        $usdtMint = 'Es9vMFrzaCER8DD6CeRBKZYZAbFtXwPENXZhVm4ZUV6s'; // USDT mainnet mint

         $feeValue = 0.30; 
         $com = CompanyAccount::where('email', 'nigakool@gmail.com')->first();
        foreach ($signatures as $signature) {
            $response = Http::post('https://api.mainnet-beta.solana.com', [
                'jsonrpc' => '2.0',
                'id' => 1,
                'method' => 'getTransaction',
                'params' => [$signature, 'jsonParsed']
            ]);

            $result = $response->json('result');

            if (!$result || empty($result['transaction']['message']['instructions'])) {
                continue; // Skip if response is bad or lacks instructions
            }

            $instructions = $result['transaction']['message']['instructions'];

            foreach ($instructions as $ix) {
                // Focus only on SPL token transfers (USDT)
                if (
                    isset($ix['parsed']) &&
                    $ix['parsed']['type'] === 'transfer' &&
                    $ix['program'] === 'spl-token' &&
                    isset($ix['parsed']['info']['mint']) &&
                    $ix['parsed']['info']['mint'] === $usdtMint
                ) {
                    $info = $ix['parsed']['info'];

                    $amount = $info['amount'] / 1e6; // USDT = 6 decimals
                    $destination = $info['destination'];
                    $source = $info['source'];

                    $sol = SolWallet::where('address', $destination)->with('user.account')->first();
                    if (!$sol || !$sol->user || !$sol->user->account) {
                        continue;
                    }

                    $amount = round($amount, 3);

                    // 👉 Calculate fee
                    $fee = round($feeValue, 3);
                    $netAmount = round($amount - $fee, 3);
                    $amount = $netAmount;
                    //ends here
                    $account = $sol->user->account;

                    // Prevent duplicate transaction processing
                    if (Transaction::where('signature', $signature)->exists()) {
                        continue;
                    }

                    $transaction = Transaction::create([
                        'account_id'     => $account->id,
                        'type'           => 'deposit',
                        'signature'      => $signature,
                        'address'        => $destination,
                        'sender'         => $source,
                        'receiver'       => $destination,
                        'amount'         => $amount,
                        'profit'         => $fee,
                        'block_time'     => isset($result['blockTime']) ? now()->setTimestamp($result['blockTime']) : now(),
                        'meta_data'      => $result,
                    ]);

                    $account->balance += $amount;
                    $account->save();

                    //save companyAccountProfit
                    $com->balance += $fee;
                    $com->save();
                }
            }
        }
    }


}