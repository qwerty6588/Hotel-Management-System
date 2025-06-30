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
            ['name' => 'Los Angeles', 'country_code' => 'US'],
            ['name' => 'Washington', 'country_code' => 'US'],

            ['name' => 'Moscow', 'country_code' => 'RU'],
            ['name' => 'Saint Petersburg', 'country_code' => 'RU'],
            ['name' => 'Kazan', 'country_code' => 'RU'],

            ['name' => 'Paris', 'country_code' => 'FR'],
            ['name' => 'Lyon', 'country_code' => 'FR'],
            ['name' => 'Marseille', 'country_code' => 'FR'],

            ['name' => 'Berlin', 'country_code' => 'DE'],
            ['name' => 'Munich', 'country_code' => 'DE'],
            ['name' => 'Hamburg', 'country_code' => 'DE'],

            ['name' => 'Rome', 'country_code' => 'IT'],
            ['name' => 'Milan', 'country_code' => 'IT'],
            ['name' => 'Venice', 'country_code' => 'IT'],

            ['name' => 'Madrid', 'country_code' => 'ES'],
            ['name' => 'Barcelona', 'country_code' => 'ES'],
            ['name' => 'Valencia', 'country_code' => 'ES'],

            ['name' => 'London', 'country_code' => 'GB'],
            ['name' => 'Manchester', 'country_code' => 'GB'],
            ['name' => 'Birmingham', 'country_code' => 'GB'],

            ['name' => 'Beijing', 'country_code' => 'CN'],
            ['name' => 'Shanghai', 'country_code' => 'CN'],
            ['name' => 'Guangzhou', 'country_code' => 'CN'],

            ['name' => 'Tokyo', 'country_code' => 'JP'],
            ['name' => 'Osaka', 'country_code' => 'JP'],
            ['name' => 'Kyoto', 'country_code' => 'JP'],

            ['name' => 'Delhi', 'country_code' => 'IN'],
            ['name' => 'Mumbai', 'country_code' => 'IN'],
            ['name' => 'Bangalore', 'country_code' => 'IN'],

            ['name' => 'Tashkent', 'country_code' => 'UZ'],
            ['name' => 'Samarkand', 'country_code' => 'UZ'],
            ['name' => 'Bukhara', 'country_code' => 'UZ'],
        ];

        foreach ($cities as $city) {
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
