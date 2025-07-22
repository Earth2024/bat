<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BnbWallet;
use App\Models\ReferralAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'nigakool@gmail.com'],
            [
                'firstName' => 'Ibrahim',
                'lastName' => 'Yusuf',
                'country' => 'Canada',
                'email' => 'nigakool@gmail.com',
                'terms' => 1,
                'password' => Hash::make('123456@Nma.1'),
                'role' => 'admin',
                'referral_code' => 'BAITRADE',
            ]
        );

        $acc = ReferralAccount::create(['user_id' => $user->id]);

        $bnb = app()->call('App\\Services\\Wallets\\BnbWallet@generateBnbWallet');

            $bnb['user_id'] = $user->id;

            BnbWallet::create($bnb);
    }
}
