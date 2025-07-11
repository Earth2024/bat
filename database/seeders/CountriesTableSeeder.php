<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/countries.json'));
        $countries = json_decode($json, true);
    
        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country['name'],
                'phoneCode' => $country['phonecode'],
                'code' => $country['iso2'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    
}
