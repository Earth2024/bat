<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\User;
use App\Models\Account;
use App\Models\BnbWallet;
use App\Models\EthWallet;
use App\Models\SolWallet;
use App\Models\BotAccount;
use Illuminate\Http\Request;
use App\Models\OptionAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BinaryRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.page.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'country' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'upass' => $request->password,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'terms' => $request->terms,
            'country' => $request->country,
        ]);

        if($user){
            //account creation
            $acc = Account::create(['user_id' => $user->id]);
            OptionAccount::create(['account_id' => $acc->id]);
            BotAccount::create(['account_id' => $acc->id]);
            if($acc){
                Pin::create([
                    'account_id' => $acc->id, 
                    'pin' => Hash::make(0000),
                ]);
            }

            //wallet creation
            //$sol = app()->call('App\\Services\\Wallets\\SolanaWallet@generateSolanaWallet');
            $bnb = app()->call('App\\Services\\Wallets\\BnbWallet@generateBnbWallet');
            //$eth = app()->call('App\\Services\\Wallets\\EtherWallet@generateEthereumWallet');

           // $sol['user_id'] = $user->id;
            $bnb['user_id'] = $user->id;
           // $eth['user_id'] = $user->id;

            BnbWallet::create($bnb);
            //EthWallet::create($eth);
            //SolWallet::create($sol);
        }


        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
