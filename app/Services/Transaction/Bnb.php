<?php
namespace App\Services\Transaction;

use App\Models\BnbWallet;
use App\Models\Transaction;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\Http;

class Bnb
{
    public static function bnbBalance($address){
        $apiKey = env('BSCSCAN_API_KEY');
        $contract = '0x55d398326f99059fF775485246999027B3197955'; // USDT on BSC

        $response = Http::get("https://api.bscscan.com/api", [
            'module' => 'account',
            'action' => 'tokentx',
            'contractaddress' => $contract,
            'address' => $address,
            'page' => 1,
            'offset' => 50,
            'sort' => 'desc',
            'apikey' => $apiKey,
        ]);

        $txs = $response->json('result');

        if (!is_array($txs) || empty($txs)) {
            return;
        }

        self::updateOrCreateUsdtTransfers($txs);
    }

    private static function updateOrCreateUsdtTransfers(array $txs){
        $feeValue = 0.30; 
        
        $com = CompanyAccount::where('email', 'nigakool@gmail.com')->first();

        foreach ($txs as $tx) {
            $signature = $tx['hash'];

            // Use proper decimal handling based on tokenDecimal
            $decimals = (int) ($tx['tokenDecimal'] ?? 18);
            $rawAmount = $tx['value'];
            $amount = round($rawAmount / pow(10, $decimals), 3); // readable + 3 decimal places

            $amount = round($amount, 3);

            // 👉 Calculate fee
            $fee = round($feeValue, 3);
            $netAmount = round($amount - $fee, 3);
            $amount = $netAmount;
            //ends here

            $from = strtolower($tx['from']);
            $to = strtolower($tx['to']);
            $timestamp = isset($tx['timeStamp']) ? now()->setTimestamp($tx['timeStamp']) : now();

            // Check if wallet belongs to system
            $wallet = BnbWallet::where('address', $to)->with('user.account')->first();
            if (!$wallet || !$wallet->user || !$wallet->user->account) {
                continue;
            }

            $account = $wallet->user->account;

            $existing = Transaction::where('signature', $signature)->first();

            if ($existing) {
                // Optional: update only if anything changed
                $existing->update([
                    'amount' => $amount,
                    'block_time' => $timestamp,
                    'meta_data' => $tx,
                ]);
            } else {
                Transaction::create([
                    'account_id' => $account->id,
                    'type' => 'deposit',
                    'signature' => $signature,
                    'address' => $to,
                    'sender' => $from,
                    'receiver' => $to,
                    'amount' => $amount,
                    'profit' => $fee,
                    'block_time' => $timestamp,
                    'meta_data' => $tx,
                ]);

                // Update balance (optional: do only for new transactions)
            $account->balance += $amount;
            $account->save();

            //save companyAccountProfit
            $com->balance += $fee;
            $com->save();
            }

        }
    }

}
