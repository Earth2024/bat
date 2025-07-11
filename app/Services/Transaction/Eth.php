<?php
namespace App\Services\Transaction;

use App\Models\EthWallet;
use App\Models\Transaction;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\Http;

class Eth
{
    public static function ethBalance($address){
        $apiKey = env('ETHERSCAN_API_KEY');
        $contract = '0xdAC17F958D2ee523a2206206994597C13D831ec7'; // USDT mainnet contract

        $response = Http::get("https://api.etherscan.io/api", [
            'module' => 'account',
            'action' => 'tokentx',
            'contractaddress' => $contract,
            'address' => $address,
            'page' => 1,
            'offset' => 5,
            'sort' => 'desc',
            'apikey' => $apiKey,
        ]);

        $txs = $response->json('result');

        if (empty($txs)) return;

        self::updateOrCreateUsdtTransfers($txs);
    }

    private static function updateOrCreateUsdtTransfers(array $txs){
        $feeValue = 0.30; 
         $com = CompanyAccount::where('email', 'nigakool@gmail.com')->first();
        foreach ($txs as $tx) {
            $signature = $tx['hash'];
            $amount = $tx['value'] / 1e6; // USDT = 6 decimals
            $from = strtolower($tx['from']);
            $to = strtolower($tx['to']);
            $blockTime = now()->setTimestamp($tx['timeStamp']);

            $wallet = EthWallet::where('address', $to)->with('user.account')->first();
            if (!$wallet || !$wallet->user || !$wallet->user->account) continue;

            $account = $wallet->user->account;

            $amount = round($amount, 3);

            // 👉 Calculate fee
            $fee = round($feeValue, 3);
            $netAmount = round($amount - $fee, 3);
            $amount = $netAmount;
            //ends here

            if (Transaction::where('signature', $signature)->exists()) continue;

            Transaction::create([
                'account_id' => $account->id,
                'type' => 'deposit',
                'signature' => $signature,
                'address' => $to,
                'sender' => $from,
                'receiver' => $to,
                'amount' => $amount,
                'profit' => $fee,
                'block_time' => $blockTime,
                'meta_data' => $tx,
            ]);

            $account->balance += $amount;
            $account->save();

            //save companyAccountProfit
            $com->balance += $fee;
            $com->save();
        }
    }
}
