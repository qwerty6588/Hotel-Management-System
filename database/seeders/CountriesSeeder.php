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
            ['code' => 'DE', 'name' => 'Germany'],
            ['code' => 'IT', 'name' => 'Italy'],
            ['code' => 'ES', 'name' => 'Spain'],
            ['code' => 'GB', 'name' => 'United Kingdom'],
            ['code' => 'CN', 'name' => 'China'],
            ['code' => 'JP', 'name' => 'Japan'],
            ['code' => 'IN', 'name' => 'India'],
            ['code' => 'BR', 'name' => 'Brazil'],
            ['code' => 'CA', 'name' => 'Canada'],
            ['code' => 'AU', 'name' => 'Australia'],
            ['code' => 'MX', 'name' => 'Mexico'],
            ['code' => 'AR', 'name' => 'Argentina'],
            ['code' => 'ZA', 'name' => 'South Africa'],
            ['code' => 'TR', 'name' => 'Turkey'],
            ['code' => 'SA', 'name' => 'Saudi Arabia'],
            ['code' => 'AE', 'name' => 'United Arab Emirates'],
            ['code' => 'UZ', 'name' => 'Uzbekistan'],
            ['code' => 'KZ', 'name' => 'Kazakhstan'],
            ['code' => 'UA', 'name' => 'Ukraine'],
            ['code' => 'CH', 'name' => 'Switzerland'],
            ['code' => 'NL', 'name' => 'Netherlands'],
            ['code' => 'SE', 'name' => 'Sweden'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                ['name' => $country['name']]
            );
        }
    }

}
