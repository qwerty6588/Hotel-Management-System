<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::insert([
            ['name' => 'Single', 'description' => '1 bed, 1 person'],
            ['name' => 'Double', 'description' => '2 beds, 2 people'],
            ['name' => 'Suite', 'description' => 'Luxury suite for family'],
        ]);
    }
}
