<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['code' => 'US', 'name' => 'United States'],
            ['code' => 'RU', 'name' => 'Russia'],
            ['code' => 'FR', 'name' => 'France'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']], // условие поиска
                ['name' => $country['name']]
            );
        }
    }
}
