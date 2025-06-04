<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Str;

class HotelsTableSeeder extends Seeder
{
    public function run()
    {
        $countries = Country::pluck('id')->toArray();
        $cities = City::pluck('id')->toArray();

        $hotelNames = [
            'Sunshine Resort',
            'Mountain View Hotel',
            'City Lights Inn',
            'Seaside Escape',
            'Forest Retreat',
            'Lakeside Lodge',
            'Desert Oasis',
            'Skyline Hotel',
            'Garden Paradise',
            'Urban Stay'
        ];

        foreach ($hotelNames as $name) {
            Hotel::create([
                'name' => $name,
                'description' => 'A wonderful place to stay at ' . $name . '.',
                'city_id' => fake()->randomElement($cities),
                'country_id' => fake()->randomElement($countries),
                'rating' => fake()->randomFloat(1, 5, 10), // 5.0 - 10.0
                'price_per_night' => fake()->numberBetween(3000, 15000), // рубли
                'image' => $name . '.jpg',
            ]);
        }
    }
}
