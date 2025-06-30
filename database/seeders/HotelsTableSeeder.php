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
            'Urban Stay',
            'Royal Palace Hotel',
            'Golden Sands Resort',
            'Blue Lagoon Inn',
            'Amber Hills Lodge',
            'Emerald Bay Hotel',
            'The White Orchid',
            'Crystal Tower Hotel',
            'Grand Heritage Inn',
            'Ocean Breeze Resort',
            'Velvet Sunset'
        ];

        foreach ($hotelNames as $name) {
            $city = \App\Models\City::inRandomOrder()->with('country')->first();

            if (!$city || !$city->country) continue;

            \App\Models\Hotel::create([
                'name' => $name,
                'description' => 'A wonderful place to stay at ' . $name . '.',
                'city_id' => $city->id,
                'country_id' => $city->country_id,
                'rating' => fake()->randomFloat(1, 6.0, 9.9),
                'price_per_night' => fake()->numberBetween(3000, 25000),
                'stars' => rand(1, 5),
                'image' => $name . '.jpg',
            ]);
        }
    }

}
