<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            ['name' => 'Wi-Fi', 'description' => 'High-speed internet', 'price' => 0.00],
            ['name' => 'Breakfast', 'description' => 'Buffet breakfast', 'price' => 10.00],
            ['name' => 'Airport Pickup', 'description' => 'Pickup from airport', 'price' => 25.00],
        ]);
    }
}
