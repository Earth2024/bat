<?php

namespace Database\Seeders;

use App\Models\CompanyAccount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyAccount::firstOrCreate(
            ['email' => 'nigakool@gmail.com'],
            [
                'email' => 'nigakool@gmail.com',
                'balance' => 0.00,
            ]
        );
    }
}
