<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'New York', 'country_code' => 'US'],
            ['name' => 'Moscow', 'country_code' => 'RU'],
            ['name' => 'Paris', 'country_code' => 'FR'],
        ];

        foreach ($cities as $city) {
            // Получаем id страны по коду
            $country = Country::where('code', $city['country_code'])->first();

            if ($country) {
                City::updateOrCreate(
                    ['name' => $city['name'], 'country_id' => $country->id],
                    []
                );
            }
        }
    }
}
