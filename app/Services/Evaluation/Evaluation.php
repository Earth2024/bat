<?php

namespace App\Services\Evaluation;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\CompanyAccount;
use App\Models\EvaluationMetric;
use App\Models\EvaluationAccount;

class Evaluation{

    public static function makePayment(array $dataTwo, array $dataTransaction, array $dataAccount, array $dataCompanyAccount){
        self::storeEvaluationMetric($dataTwo);
        self::storeTransaction($dataTransaction);
        self::storeUpdateAccount($dataAccount);
        self::storeUpdateCompanyAccount($dataCompanyAccount);
    }

    public static function storeEvaluationAccount(array $data){
        return EvaluationAccount::create($data);
    }

    private static function storeEvaluationMetric(array $dataTwo){
        return EvaluationMetric::create($dataTwo);
    }

    public static function storeTransaction(array $dataTransaction){
        return Transaction::create($dataTransaction);
    }

    public static function storeUpdateAccount(array $dataAccount){
        $account = auth()->user()->account;
        return $account->update($dataAccount);
    }

    public static function storeUpdateCompanyAccount(array $dataCompanyAccount){

        return CompanyAccount::where('email', 'nigakool@gmail.com')->first()
        ->update($dataCompanyAccount);
    }

}